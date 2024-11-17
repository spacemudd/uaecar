<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show the payment details page.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $car = $this->getCarById($id);

        // Retrieve session data
        $pickupDate = session('pickup_date');
        $returnDate = session('return_date');
        $rateDaily = session('rate_daily');

        // Calculate rental period and total cost
        $days = $this->calculateRentalDays($pickupDate, $returnDate);
        $total = $rateDaily * $days;

        // Pass data to the view
        return view('front.pages.payment', [
            'car' => $car,
            'pickup_date' => $pickupDate,
            'return_date' => $returnDate,
            'rate_daily' => $rateDaily,
            'days' => $days,
            'total' => $total,
            'pickup_location' => session('pickup_location'),
            'return_location' => session('return_location'),
            'status' => session('status'),
            'vehicle_hint' => session('vehicle_hint'),
            'customer_name' => session('customer_name'),
            'customer_mobile' => session('customer_mobile'),
            'customer_email' => session('customer_email')
        ]);
    }

    /**
     * Redirect to Stripe payment page with relevant details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passDatatoStripe($id)
    {
        $car = $this->getCarById($id);

        // Retrieve session data
        $pickupDate = session('pickup_date');
        $returnDate = session('return_date');
        $rateDaily = session('rate_daily');

        // Calculate rental period and total cost
        $days = $this->calculateRentalDays($pickupDate, $returnDate);
        $total = $rateDaily * $days;

        // Redirect to the Stripe payment route
        return redirect()->route('stripe.payment', [
            'car' => $car->id,
            'rate_daily' => $rateDaily,
            'days' => $days,
            'total' => $total,
            'pickup_date' => $pickupDate,
            'return_date' => $returnDate
        ]);
    }

    /**
     * Get the car details by ID.
     *
     * @param  int  $id
     * @return \App\Models\Car
     */
    private function getCarById($id)
    {
        return Car::findOrFail($id);  // Fetch the car or fail if not found
    }

    /**
     * Calculate the number of rental days.
     *
     * @param  string  $pickupDate
     * @param  string  $returnDate
     * @return int
     */
    private function calculateRentalDays($pickupDate, $returnDate)
    {
        $pickup = Carbon::parse($pickupDate);
        $return = Carbon::parse($returnDate);

        $days = $pickup->diffInDays($return);
        
        // Ensure a minimum of 1 day rental
        return max($days, 1);
    }
}
