<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Exceptions\NodeSystemException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    /**
     * Handle the car submission formm.
     */
    public function submit(Request $request)
    {
        session(['new_id' => $request->input('car_id')]);
        $plateNumber = preg_replace('/^(?:[A-Z]-|CC-)/', '', $request->input('plate_number'));

        $token = $this->getAuthToken();
        $car = $this->getCarDetailsByPlateNumber($plateNumber, $token);

        return $this->respondCarStatus($car, $plateNumber, $request);
    }

    /**
     * Retrieve the authentication token from cache or generate a new one.
     */
    private function getAuthToken()
    {
        $token = Cache::get('node_api_token');
        return $token ?: $this->authenticate();
    }

    /**
     * Authenticate with the API and cache the token.
     */
    private function authenticate()
    {
        $username = 'info@rentluxuria.com';
        $password = ')ixLj(CQYSE84MRMqm*&dega';

        $response = Http::post('https://luxuria.crs.ae/api/v1/auth/jwt/token', [
            'username' => $username,
            'password' => $password,
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            if (isset($responseData['token'])) {
                $token = $responseData['token'];
                Cache::put('node_api_token', $token, now()->addHours(1));
                return $token;
            }
            throw new NodeSystemException('Authentication failed: Token not found.');
        }

        throw new NodeSystemException('Authentication failed: ' . ($response->json()['message'] ?? 'Unknown error.'));
    }

    /**
     * Fetch car details by its plate number.
     */
    private function getCarDetailsByPlateNumber($plateNumber, $token)
    {
        $this->checkIfCarIsReserved($plateNumber, $token);

        $vehicleListResponse = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('https://luxuria.crs.ae/api/v1/vehicles');

        if (!$vehicleListResponse->successful()) {
            throw new NodeSystemException('Failed to communicate with the Node system.');
        }

        $vehicles = $vehicleListResponse->json()['data'];
        return collect($vehicles)->firstWhere('plate_number', $plateNumber);
    }

    /**
     * Check if the car is already reserved with a confirmed status.
     */
    private function checkIfCarIsReserved($plateNumber, $token)
    {
        $reservationResponse = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('https://luxuria.crs.ae/api/v1/reservations/');

        if (!$reservationResponse->successful()) {
            throw new NodeSystemException('Failed to communicate with the Reservations API.');
        }

        $reservations = $reservationResponse->json()['data'];
        foreach ($reservations as $reservation) {
            if ($reservation['status'] === 'Confirmed' &&
                isset($reservation['vehicle_hint']) &&
                str_contains($reservation['vehicle_hint'], $plateNumber)) {
                throw new NodeSystemException('This car is already reserved with a confirmed status.');
            }
        }
    }

    /**
     * Handle the response based on car status and availability.
     */
    private function respondCarStatus($car, $plateNumber, $request)
    {
        if (!$car) {
            return redirect()->back()->with('node_error_message', 'Car not found in the Node system. Plate number: ' . $plateNumber);
        }

        if ($car['status'] === 'Available') {
            session($this->prepareSessionData($car, $request));
            return redirect()->route('cars.checkout', ['id' => $request->input('car_id')]);
        }

        $this->fetchAndStoreAvailableCars($request);

        return redirect()->route('index')->with('error_message', 'Car is not available for booking at the moment.')
            ->with('car_picture', session('car_picture'))
            ->with('existing_cars', session('existing_cars'));
    }

    /**
     * Fetch available cars and store in the session.
     */
    private function fetchAndStoreAvailableCars($request)
    {
        $token = $this->getAuthToken();
        $response = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('https://luxuria.crs.ae/api/v1/vehicles');

        if ($response->successful()) {
            $vehicles = $response->json()['data'] ?? [];
            $availableCars = $this->filterAvailableCars($vehicles, $request->input('price_daily'));

            session($this->prepareAvailableCarsSessionData($availableCars));
        }
    }

    /**
     * Filter available cars based on price range.
     */
    private function filterAvailableCars($vehicles, $priceDaily)
    {
        $filtered = array_filter($vehicles, function ($vehicle) use ($priceDaily) {
            return isset($vehicle['status'], $vehicle['price_daily']) &&
                $vehicle['status'] === 'Available' &&
                abs($vehicle['price_daily'] - $priceDaily) <= 100;
        });

        return count($filtered) < 3 ? $this->getFallbackAvailableCars($vehicles) : $filtered;
    }

    /**
     * Get fallback available cars if initial filtering is insufficient.
     */
    private function getFallbackAvailableCars($vehicles)
    {
        $fallback = array_filter($vehicles, fn($vehicle) => $vehicle['status'] === 'Available');
        shuffle($fallback);
        return array_slice($fallback, 0, 3);
    }

    /**
     * Prepare session data for the selected car.
     */
    private function prepareSessionData($car, $request)
    {
        return [
            'pickup_date' => $request->input('pickup_date'),
            'return_date' => $request->input('return_date'),
            'rate_daily' => $request->input('price_daily'),
            'pickup_location' => '71',
            'return_location' => '71',
            'status' => 'pending_updates',
            'vehicle_hint' => $request->input('carName'),
            'customer_name' => $request->input('name'),
            'customer_mobile' => $request->input('phone'),
            'customer_email' => $request->input('email'),
            'pickup_city' => $request->input('pickup_city'),
            'car_image' => $car['image_url'] ?? null,
            'new_id' => $request->input('car_id')
        ];
    }

    /**
     * Prepare session data for available cars.
     */
    private function prepareAvailableCarsSessionData($availableCars)
    {
        $plateNumbers = array_column($availableCars, 'plate_number');
        $cleanedPlateNumbers = array_map(fn($plate) => preg_replace('/[^0-9]/', '', $plate), $plateNumbers);

        $existingCars = DB::table('cars')
            ->whereIn(DB::raw('REGEXP_REPLACE(plate_number, "[^0-9]", "")'), $cleanedPlateNumbers)
            ->get(['id', 'plate_number', 'car_name', 'price_daily', 'car_picture', 'model', 'year']);

        session(['existing_cars' => $existingCars]);

        return [
            'car_picture' => session('car_picture'),
            'available_car_plate_numbers' => $plateNumbers,
        ];
    }
}
