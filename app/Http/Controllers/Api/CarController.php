<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Car;
use App\Models\Booking;
use App\Models\Prebooking;
use App\Models\User;
use App\Models\Ad;

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
                        'name' => $bookingId, // اسم المنتج
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



    public function paymentSuccess($booking_id)
    {
        $booking = Booking::find($booking_id);
        if (!$booking) {
            return response()->json(['status' => false, 'message' => 'Booking not found.'], 404);
        }

        $user = User::find($booking->user_id);
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found.'], 404);
        }

        $car = Car::find($booking->car_id);
        if (!$car) {
            return response()->json(['status' => false, 'message' => 'Car not found.'], 404);
        }

        $reservationData = [
            'customer_name' => $user->name,
            'customer_nationality' => "ARE",
            'customer_mobile' => $user->phone_number,
            'customer_email' => $user->email_address,
            'vehicle_hint' => $car->make . ' ' . $car->model . ' ' . $car->year . ' ' . $car->plate_number,
            'pickup_date' => $booking->pickup_date,
            'pickup_location' => '71',
            'return_date' => $booking->return_date,
            'return_location' => '71',
            'rate_daily' => $car->price_daily,
            'status' => 'pending_updates',
        ];

        $token = $this->authenticate();
        if (!$token) {
            return response()->json(['status' => false, 'message' => 'Authentication failed.'], 401);
        }

        $client = new Client();
        $response = $client->post('https://luxuria.crs.ae/api/v1/reservations', [
            'json' => $reservationData,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);
        $statusCode = $response->getStatusCode();

        if (in_array($statusCode, [200, 201])) { // لو كود الاستجابة 200 أو 201
            $securityDeposit = ($car->price_daily <= 349) ? 1000 : 0;

            $pickupDate = \Carbon\Carbon::parse($booking->pickup_date);
            $returnDate = \Carbon\Carbon::parse($booking->return_date);

            // حساب الأيام الكاملة بين تاريخي الاستلام والإرجاع
            $totalDays = $pickupDate->diffInDays($returnDate);
            $totalDays = intval($totalDays); // تحويل الناتج إلى رقم صحيح

            $totalAmount = 0;

            if ($totalDays <= 6) {
                // حساب المبلغ اليومي إذا كانت الأيام أقل من أو تساوي 6
                $totalAmount = intval($totalDays * $car->price_daily); // تحويل الناتج إلى رقم صحيح
            } elseif ($totalDays >= 7 && $totalDays <= 29) {
                // حساب المبلغ الأسبوعي إذا كانت الأيام بين 7 و 29
                $dailyPrice = intval($car->price_weekly / 7);
                $totalAmount = intval($totalDays * $dailyPrice); // تحويل الناتج إلى رقم صحيح
            } elseif ($totalDays >= 30) {
                // حساب المبلغ الشهري إذا كانت الأيام 30 أو أكثر
                $dailyPrice = intval($car->price_monthly / 30);
                $totalAmount = intval($totalDays * $dailyPrice); // تحويل الناتج إلى رقم صحيح
            }

            $total = $totalAmount + $securityDeposit;


            $mobileInvoice = MobileInvoice::create([
                'user_id' => $user->id,
                'car_id' => $car->id,
                'total_amount' => $total,
                'total_days' => $totalDays,
                'security_deposit' => $securityDeposit,
                'pickup_date' => $booking->pickup_date,
                'return_date' => $booking->return_date,
            ]);

            return view('front.mobile.success', [
                'booking_id' => $booking->id,
                'invoice_id' => $mobileInvoice->id,
            ]);
        } else { // أي كود غير 200 أو 201
            return response()->json([
                'status' => false,
                'message' => 'فشل الحجز.',
                'error_details' => $responseData,
                'status_code' => $statusCode,
            ], $statusCode);
        }
    }




    public function bookings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'car_id' => 'required|integer|exists:cars,id',
            'pickup_date' => 'required|date_format:Y-m-d H:i:s', // تأكد من استخدام هذا
            'return_date' => 'required|date_format:Y-m-d H:i:s|after:pickup_date',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pickupDate = \Carbon\Carbon::parse($request->pickup_date);
        $returnDate = \Carbon\Carbon::parse($request->return_date);
        $totalDays = $pickupDate->diffInDays($returnDate);

        $car = Car::find($request->car_id);

        $totalAmount = 0; // تعيين قيمة ابتدائية للمبلغ الإجمالي

        if ($totalDays <= 6) {
            // حساب المبلغ اليومي إذا كانت الأيام أقل من أو تساوي 6
            $totalAmount = $totalDays * $car->price_daily;
        } elseif ($totalDays >= 7 && $totalDays <= 29) {
            // حساب المبلغ الأسبوعي إذا كانت الأيام بين 7 و 29
            $dailyPrice = $car->price_weekly / 7;
            $totalAmount = $totalDays * $dailyPrice;
        } elseif ($totalDays >= 30) {
            // حساب المبلغ الشهري إذا كانت الأيام 30 أو أكثر
            $dailyPrice = $car->price_monthly / 30;
            $totalAmount = $totalDays * $dailyPrice;
        }



        try {
            // إنشاء الحجز مع حالة "pending"
            $booking = Booking::create([
                'user_id' => $request->user_id,
                'car_id' => $request->car_id,
                'pickup_date' => $request->pickup_date,
                'pickup_time' => $request->pickup_time, // إضافة وقت الاستلام
                'return_date' => $request->return_date,
                'return_time' => $request->return_time, // إضافة وقت الإرجاع
                'total_days' => $totalDays,
                'total_amount' => $totalAmount,
                'status' => 'pending', // تعيين الحالة إلى "pending"
            ]);

            // تابع العملية حسب الحاجة...
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Booking creation failed: ' . $e->getMessage()], 500);
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


    public function getInvoicesByUser($user_id){
        $validator = Validator::make(['user_id' => $user_id], [
            'user_id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        try {
            $mobileInvoice = MobileInvoice::where('user_id', $user_id)->get();

            if ($mobileInvoice->isEmpty()) {
                return response()->json(['message' => 'No invoices found for this user.'], 404);
            }
            return response()->json([
                'message' => 'Invoices retrieved successfully.',
                'invoices' => $mobileInvoice,
            ], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function getInvoiceById($invoice_id)
{
    // تحقق من صحة invoice_id
    $validator = Validator::make(['invoice_id' => $invoice_id], [
        'invoice_id' => 'required|integer|exists:mobile_invoices,id', // تحقق من وجود الفاتورة في جدول mobile_invoices
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    try {
        // استرجاع الفاتورة باستخدام invoice_id
        $mobileInvoice = MobileInvoice::find($invoice_id);

        if (!$mobileInvoice) {
            return response()->json(['message' => 'Invoice not found.'], 404);
        }

        return response()->json([
            'message' => 'Invoice retrieved successfully.',
            'invoice' => $mobileInvoice,
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


public function getCarById($car_id)
{
    // تحقق من صحة car_id
    $validator = Validator::make(['car_id' => $car_id], [
        'car_id' => 'required|integer|exists:cars,id', // تحقق من وجود الفاتورة في جدول car
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    try {
        // استرجاع الفاتورة باستخدام car
        $cars = Car::find($car_id);

        if (!$cars) {
            return response()->json(['message' => 'car not found.'], 404);
        }

        return response()->json([
            'message' => 'car retrieved successfully.',
            'car' => $cars,
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

    public function getNoDepositCars(){
        $cars = Car::where('price_daily', '>', 349)->get();
        return response()->json($cars);

    }

    public function getAvailablePlateNumbers()
    {
        // بيانات المصادقة
        $credentials = [
            'username' => 'info@rentluxuria.com',
            'password' => ')ixLj(CQYSE84MRMqm*&dega',
        ];

        // طلب التوكن
        $response = Http::post('https://luxuria.crs.ae/api/v1/auth/jwt/token', $credentials);

        if (!$response->successful()) {
            return response()->json(['status' => false, 'message' => 'Authentication failed'], 401);
        }

        $token = $response->json()['token'];

        // جلب بيانات السيارات من API
        $vehicleResponse = Http::withToken($token)->get('https://luxuria.crs.ae/api/v1/vehicles');

        if (!$vehicleResponse->successful()) {
            return response()->json(['status' => false, 'message' => 'Failed to fetch vehicles'], 500);
        }

        $availablePlateNumbers = collect($vehicleResponse->json()['data'])
            ->filter(function ($vehicle) {
                return isset($vehicle['status']) && $vehicle['status'] === 'Available';
            })
            ->pluck('plate_number')
            ->values()
            ->toArray();

        // البحث في قاعدة البيانات عن تفاصيل السيارات المطابقة
        $cars = Car::whereIn('plate_number', $availablePlateNumbers)->get();

        return response()->json([
            'status' => true,
            'message' => 'Available car details retrieved successfully',
            'cars' => $cars,
        ]);
    }
}
