<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmissionMail;
use App\Models\Car;
use App\Models\BookingRequest;

use App\Mail\ContactMail;

class FormController extends Controller
{


    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'carID' => 'required|integer',
            'carName' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'pickup_city' => 'required|string',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date',
            'message' => 'nullable|string|max:500',
            'daily_car_price' => 'required|string|max:255'
        ]);

        $car = Car::find($validatedData['carID']);

        $booking = BookingRequest::create([
            'request_number' => BookingRequest::count() + 100, // Request number starting from 100
            'car_id' => $car->id,
            'car_name' => $validatedData['carName'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'pickup_city' => $validatedData['pickup_city'],
            'pickup_date' => $validatedData['pickup_date'],
            'return_date' => $validatedData['return_date'],
            'message' => $validatedData['message'],
            'daily_car_price' => $validatedData['daily_car_price']
        ]);

        $carDetailsUrl = route('cars.show', ['id' => $car->id]);

        Mail::to('abdelrahmanyouseff@gmail.com')->send(new FormSubmissionMail($validatedData, $carDetailsUrl));

        return redirect()->back()->with('message', 'Your booking has been successfully submitted!');
    }



    public function sendContactEmail(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:15',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'subject' => $request->subject,
        'message' => $request->message,
    ];

    Mail::to('abdelrahman.yousef@hadaf-hq.com')->send(new ContactMail($data)); // Change the recipient

    return redirect()->back()->with('success', 'Your message has been sent successfully!');
}

}
