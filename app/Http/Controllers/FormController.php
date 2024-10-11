<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmissionMail;
use App\Models\Car;
use App\Mail\ContactMail;

class FormController extends Controller
{


    public function submit(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'pickup_city' => 'required|string',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after:pickup_date',
            'message' => 'nullable|string',
        ]);

        //   $car = Car::find($validatedData['car_id']);
        //   $validatedData['car_name'] = $car ? $car->name : 'Unknown Car';

        // Send the email
        Mail::to('abdelrahmanyouseff@gmail.com')->send(new FormSubmissionMail($validatedData));

        // Return a response
        return redirect()->back()->with('message', 'Your booking has been successfully submitted!');
        }



    public function sendContactEmail(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:15',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // Prepare the data for the email
    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'subject' => $request->subject,
        'message' => $request->message,
    ];

    // Send the email
    Mail::to('abdelrahman.yousef@hadaf-hq.com')->send(new ContactMail($data)); // Change the recipient

    // Redirect back with success message
    return redirect()->back()->with('success', 'Your message has been sent successfully!');
}

}
