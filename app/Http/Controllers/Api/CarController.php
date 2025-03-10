<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Car;
use App\Models\Booking;
use App\Models\Prebooking;

use App\Models\MobileInvoice;


use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all(); 
        return response()->json([
            'status' => true,
            'message' => 'Car list retrieved successfully',
            'data' => $cars
        ], 200);
    }

    public function luxury_cars()
    {
        $cars = Car::where('categories', 'Luxury')->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Luxury car list retrieved successfully',
            'data' => $cars
        ], 200);
    }

    public function mid_rang_cars()
    {
        $cars = Car::where('categories', 'Mid Range')->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Mid Rang car list retrieved successfully',
            'data' => $cars
        ], 200);
    }

    public function economy_cars()
    {
        $cars = Car::where('categories', 'Economy')->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Economy car list retrieved successfully',
            'data' => $cars
        ], 200);
    }

    public function sport_cars()
    {
        $cars = Car::where('categories', 'Sports and Exotics')->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Sports car list retrieved successfully',
            'data' => $cars
        ], 200);
    }


    public function vans_cars()
    {
        $cars = Car::where('categories', 'Vans and Buses')->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Vans car list retrieved successfully',
            'data' => $cars
        ], 200);
    }



   
    public function authenticate()
    {
        $credentials = [
            'username' => 'info@rentluxuria.com',
            'password' => ')ixLj(CQYSE84MRMqm*&dega',
        ];
    
        $response = Http::post('https://luxuria.crs.ae/api/v1/auth/jwt/token', $credentials);
        Log::info('Auth Response:', $response->json());
    
        if ($response->successful()) {
            $token = $response->json()['token'];
            Session::put('auth_token', $token);
            return $token;
        }
    
        return null;
    }
    




    public function getVehicleIdByPlateNumber(Request $request)
    {
        // دالة المصادقة مضمنة هنا
        $credentials = [
            'username' => 'info@rentluxuria.com',
            'password' => ')ixLj(CQYSE84MRMqm*&dega',
        ];
    
        $response = Http::post('https://luxuria.crs.ae/api/v1/auth/jwt/token', $credentials);
        Log::info('Auth Response:', $response->json());
    
        if ($response->successful()) {
            $token = $response->json()['token'];
            Session::put('auth_token', $token);
        } else {
            return response()->json(['status' => false, 'message' => 'Unauthorized: Authentication failed.'], 401);
        }
    
        // استخرج رقم اللوحة من الطلب
        $plateNumber = $request->input('plate_number');
    
        // استخدم التوكن للحصول على معلومات السيارة
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->get('https://luxuria.crs.ae/api/v1/vehicles');
        Log::info('Vehicle API Response:', $response->json());
    
        if ($response->successful()) {
            $vehicle = collect($response->json()['data'])->firstWhere('plate_number', $plateNumber);
    
            if ($vehicle) {
                return $this->getReservationByVehicleId($vehicle['id']);
            }
    
            return response()->json(['status' => false, 'message' => 'Vehicle not found'], 404);
        }
    
        return response()->json(['status' => false, 'message' => 'Failed to retrieve vehicles', 'error' => $response->json()], $response->status());
    }



    public function checkVehicleAvailability(Request $request)
    {
        // تحقق من وجود حقل plate_number في الطلب
        $request->validate([
            'plate_number' => 'required|string',
        ]);
    
        // دالة المصادقة مضمنة هنا
        $credentials = [
            'username' => 'info@rentluxuria.com',
            'password' => ')ixLj(CQYSE84MRMqm*&dega',
        ];
    
        // الحصول على التوكن
        $response = Http::post('https://luxuria.crs.ae/api/v1/auth/jwt/token', $credentials);
        Log::info('Auth Response:', $response->json());
    
        if ($response->successful()) {
            $token = $response->json()['token'];
            Session::put('auth_token', $token);
        } else {
            return response()->json(['status' => false, 'message' => 'Unauthorized: Authentication failed.'], 401);
        }
    
        // استخرج رقم اللوحة من الطلب
        $plateNumber = $request->input('plate_number');
    
        // استخدم التوكن للحصول على معلومات السيارة
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->get('https://luxuria.crs.ae/api/v1/vehicles');
        Log::info('Vehicle API Response:', $response->json());
    
        if ($response->successful()) {
            $vehicle = collect($response->json()['data'])->firstWhere('plate_number', $plateNumber);
    
            if ($vehicle) {
                // تحقق من حالة توفر السيارة باستخدام الحقل 'status'
                if (isset($vehicle['status']) && $vehicle['status'] === 'Available') {
                    // احفظ vehicle_id في الجلسة
                    session(['vehicle_id' => $vehicle['id']]); // تأكد من أن لديك الحقل 'id' في البيانات
            
                    return response()->json(['status' => true, 'message' => 'Vehicle is available']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Vehicle is not available']);
                }
            }
    
            return response()->json(['status' => false, 'message' => 'Vehicle not found'], 404);
        }
    
        return response()->json(['status' => false, 'message' => 'Failed to retrieve vehicles', 'error' => $response->json()], $response->status());
    }
    

    

    
    public function getReservationByVehicleId($vehicleId)
    {
        $token = Session::get('auth_token') ?? $this->authenticate();
    
        if (!$token) {
            return response()->json(['status' => false, 'message' => 'Unauthorized: Authentication failed.'], 401);
        }
    
        $response = Http::withToken($token)->get('https://luxuria.crs.ae/api/v1/vehicles');
    
        if ($response->successful()) {
            $vehicle = collect($response->json()['data'])->firstWhere('id', $vehicleId);
    
            if ($vehicle) {
                if (in_array($vehicle['status'], ['Available', 'Completed', 'Canceled'])) {
                    return $this->createReservation($vehicle);
                }
    
                return response()->json(['status' => false, 'message' => 'The vehicle is not available for booking.'], 403);
            }
    
            return response()->json(['status' => false, 'message' => 'Vehicle not found.'], 404);
        }
    
        return response()->json(['status' => false, 'message' => 'Error retrieving vehicle status: ' . $response->body()], $response->status());
    }




    
    protected function createReservation($vehicle)
    {
        $pickupDate = now()->format('Y-m-d H:i:s'); 
        $returnDate = now()->addDays(1)->format('Y-m-d H:i:s'); 
        $customerName = request()->input('customer_name', 'Test');
        $customerNationality = request()->input('customer_nationality', 'ARE');
        $customerMobile = request()->input('customer_mobile', '971501234567');
        $customerEmail = request()->input('customer_email', 'test@node.ae');
        $pickupLocation = request()->input('pickup_location', '71');
        $returnLocation = request()->input('return_location', '71');
    
        $demoData = [
            'customer_name' => $customerName,
            'customer_nationality' => $customerNationality,
            'customer_mobile' => $customerMobile,
            'customer_email' => $customerEmail,
            'vehicle_id' => $vehicle['id'],
            'vehicle_hint' => 'Toyota Corolla 2013',
            'pickup_date' => $pickupDate,
            'pickup_location' => $pickupLocation,
            'return_date' => $returnDate,
            'return_location' => $returnLocation,
            'rate_daily' => $vehicle['rate_daily'],
            'status' => 'pending_updates',
        ];
    
        $token = Session::get('auth_token') ?? $this->authenticate();
        $reservationResponse = Http::withToken($token)->post('https://luxuria.crs.ae/api/v1/reservations', $demoData);
        
        if ($reservationResponse->successful()) {
            return response()->json([
                'status' => true,
                'message' => 'Vehicle reserved successfully.',
                'reservation' => $reservationResponse->json(),
            ]);
        }
    
        return response()->json(['status' => false, 'message' => 'Error creating reservation: ' . $reservationResponse->body()], $reservationResponse->status());
    }


    public function createStripeCheckoutSession(Request $request)
    {
        // تحقق من المدخلات
        $request->validate([
            'total_amount' => 'required|numeric',
            'booking_id' => 'required|string', // التحقق من معرف الحجز كـ string
        ]);
    
        // الحصول على المبلغ الإجمالي ومعرف الحجز من الطلب
        $totalAmount = $request->input('total_amount');
        $bookingId = $request->input('booking_id'); // استلام booking_id
    
        // إعداد بيانات Stripe
        $stripeData = [
            'payment_method_types[]' => 'card',
            'line_items' => [[
                'price_data' => [
                    'currency' => 'AED', // العملة
                    'product_data' => [
                        'name' => 'Rental Car', // اسم المنتج
                    ],
                    'unit_amount' => intval($totalAmount * 100), // تحويل المبلغ إلى وحدة الـ cents
                ],
                'quantity' => 1, // عدد الكمية
            ]],
            'mode' => 'payment', // وضع الدفع
            'success_url' => route('payment.success', ['booking_id' => $bookingId]),
            'cancel_url' => 'https://your-domain.com/cancel', 
        ];
    
        // إرسال الطلب إلى Stripe
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('STRIPE_SECRET_KEY'), // استخدام مفتاح سري لـ Stripe
        ])->asForm()->post('https://api.stripe.com/v1/checkout/sessions', $stripeData);
    
        // معالجة الاستجابة
        if ($response->successful()) {
            return response()->json([
                'status' => true,
                'message' => 'Checkout session created successfully.',
                'session_id' => $response->json()['id'], // معرف الجلسة
                'checkout_url' => $response->json()['url'], // رابط الدفع
            ], 200);
        }
    
        // معالجة الأخطاء في حال عدم نجاح الطلب
        return response()->json(['status' => false, 'message' => 'Error creating checkout session: ' . $response->body()], $response->status());
    }
    
    
    public function paymentSuccess(Request $request)
{
    // استرجاع معرف الحجز من الطلب
    $bookingId = $request->input('booking_id');
    dd($bookingId); // طباعة booking_id للتحقق من قيمته

    // البحث عن الحجز في قاعدة البيانات
    $booking = Booking::find($bookingId);

    if (!$booking) {
        return response()->json(['status' => false, 'message' => 'Booking not found.'], 404);
    }

    // استخراج بيانات السيارة
    $vehicle = [
        'id' => $booking->car_id,
        'rate_daily' => $booking->total_amount / max($booking->total_days, 1), // احتساب المعدل اليومي إذا لم يكن موجودًا
    ];

    // استدعاء createReservation وتمرير بيانات السيارة
    $reservationResponse = $this->createReservation($vehicle);

    // إذا نجح الحجز، إنشاء الفاتورة
    if ($reservationResponse->getData()->status) {
        try {
            $invoice = MobileInvoice::create([
                'user_id' => $booking->user_id,
                'car_id' => $booking->car_id,
                'total_amount' => $booking->total_amount,
                'total_days' => $booking->total_days,
                'pickup_date' => $booking->pickup_date,
                'return_date' => $booking->return_date,
            ]);

            // طباعة رسالة عند إنشاء الفاتورة
            dd('تم إنشاء الفاتورة بنجاح', $invoice); // يمكنك إضافة أي معلومات إضافية هنا

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to create invoice: ' . $e->getMessage()], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Invoice and reservation created successfully.',
            'reservation' => $reservationResponse->getData(),
        ]);
    }

    return response()->json([
        'status' => false,
        'message' => 'Reservation failed: ' . $reservationResponse->getData()->message,
    ]);
}


    public function bookings(Request $request)
    {
        // التحقق من صحة البيانات
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'car_id' => 'required|integer|exists:cars,id',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after:pickup_date',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $totalDays = "5"; 
        $totalAmount = "500"; 
    
        try {
            // إنشاء الحجز مع حالة "pending"
            $booking = Booking::create([
                'user_id' => $request->user_id,
                'car_id' => $request->car_id,
                'pickup_date' => $request->pickup_date,
                'return_date' => $request->return_date,
                'total_days' => $totalDays,
                'total_amount' => $totalAmount,
                'status' => 'pending', // تعيين الحالة إلى "pending"
            ]);
    
            // تخزين معرف الحجز في الجلسة
    
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    
        return response()->json([
            'message' => 'Booking created successfully.',
            'booking_id' => $booking->id, // أضف معرف الحجز إلى الاستجابة
        ], 201);
    }
    
    public function getBookingsByUser($user_id)
    {
        $validator = Validator::make(['user_id' => $user_id], [
            'user_id' => 'required|integer|exists:users,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        try {
            // جلب الحجوزات الخاصة بالمستخدم
            $bookings = Booking::where('user_id', $user_id)->get();
    
            if ($bookings->isEmpty()) {
                return response()->json(['message' => 'No bookings found for this user.'], 404);
            }
    
            return response()->json([
                'message' => 'Bookings retrieved successfully.',
                'bookings' => $bookings,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function deleteBooking($booking_id)
    {
        // Validate the booking_id as an integer and ensure it exists
        $validator = Validator::make(['booking_id' => $booking_id], [
            'booking_id' => 'required|integer|exists:bookings,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        try {
            // Use findOrFail to automatically handle missing bookings
            $booking = Booking::findOrFail($booking_id);
    
            // Delete the booking
            $booking->delete();
    
            return response()->json(['message' => 'Booking deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete booking: ' . $e->getMessage()], 500);
        }
    }
    



}
