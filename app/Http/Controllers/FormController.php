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
        $validatedData = $this->validateBookingRequest($request);
    
        // Convert pickup_date and return_date to YYYY-MM-DD format using Carbon
        $pickupDate = Carbon::createFromFormat('m/d/Y', $validatedData['pickup_date'])->format('Y-m-d');
        $returnDate = Carbon::createFromFormat('m/d/Y', $validatedData['return_date'])->format('Y-m-d');
    
        $car = Car::findOrFail($validatedData['carID']);
    
        $booking = BookingRequest::create([
            'request_number' => BookingRequest::count() + 100,
            'car_id' => $car->id,
            'car_name' => $validatedData['carName'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'pickup_city' => $validatedData['pickup_city'],
            'pickup_date' => $pickupDate,  // Use the converted date
            'return_date' => $returnDate,  // Use the converted date
            'message' => $validatedData['message'],
            'daily_car_price' => $validatedData['daily_car_price'],
        ]);
    
        // Send email after booking is created
        $carDetailsUrl = route('cars.show', ['id' => $car->id]);
        Mail::to('abdelrahmanyouseff@gmail.com')->send(new FormSubmissionMail($validatedData, $carDetailsUrl));
    
        // Return success view after processing the form
        return view('front.pages.successView');
    }
    

    public function sendContactEmail(Request $request)
    {
        $validatedData = $this->validateContactRequest($request);

        $data = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'subject' => $validatedData['subject'],
            'message' => $validatedData['message'],
        ];

        Mail::to('abdelrahman.yousef@hadaf-hq.com')->send(new ContactMail($data));

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

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
