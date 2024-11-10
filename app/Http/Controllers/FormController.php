<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmissionMail;
use App\Models\Car;
use App\Models\BookingRequest;
use App\Mail\ContactMail;
use Carbon\Carbon;

class FormController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the incoming booking request data
        $validatedData = $this->validateBookingRequest($request);

        // Use Carbon::parse() to automatically handle date parsing
        $pickupDate = Carbon::parse($validatedData['pickup_date'])->format('Y-m-d');
        $returnDate = Carbon::parse($validatedData['return_date'])->format('Y-m-d');

        // Find the car based on the car ID
        $car = Car::findOrFail($validatedData['carID']);

        // Create a new booking request record in the database
        $booking = BookingRequest::create([
            'request_number' => BookingRequest::count() + 100,  // Generate a unique request number
            'car_id' => $car->id,
            'car_name' => $validatedData['carName'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'pickup_city' => $validatedData['pickup_city'],
            'pickup_date' => $pickupDate,  // Store the formatted pickup date
            'return_date' => $returnDate,  // Store the formatted return date
            'message' => $validatedData['message'],
            'daily_car_price' => $validatedData['daily_car_price'],
        ]);

        // Send the form submission email with car details URL
        $carDetailsUrl = route('cars.show', ['id' => $car->id]);
        Mail::to('info@rentluxuria.com')->send(new FormSubmissionMail($validatedData, $carDetailsUrl));

        // Return a success view after processing the form
        return view('front.pages.successView');
    }

    public function sendContactEmail(Request $request)
    {
        // Validate the contact request data
        $validatedData = $this->validateContactRequest($request);

        // Prepare the contact email data
        $data = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'subject' => $validatedData['subject'],
            'message' => $validatedData['message'],
        ];

        // Send the contact email
        Mail::to('abdelrahman.yousef@hadaf-hq.com')->send(new ContactMail($data));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    // Validation for booking requests
    protected function validateBookingRequest(Request $request)
    {
        return $request->validate([
            'carID' => 'required|integer|exists:cars,id',
            'carName' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'pickup_city' => 'required|string',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date',
            'message' => 'nullable|string|max:500',
            'daily_car_price' => 'required|string|max:255',
        ]);
    }

    // Validation for contact requests
    protected function validateContactRequest(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
    }
}
