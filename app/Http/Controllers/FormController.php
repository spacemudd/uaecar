<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmissionMail;

class FormController extends Controller
{
    public function submit(Request $request)
    {
        $this->validateForm($request);

        $data = $request->only('full_name', 'email', 'phone', 'date_from', 'date_to', 'pickup_city', 'selected_car');

        return $this->sendEmail($data);
    }

    protected function validateForm(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'pickup_city' => 'required|string',
            'selected_car' => 'required|string',
        ]);
    }

    protected function sendEmail(array $data)
    {
        try {
            Mail::to('abdelrahman.yousef@hadaf-hq.com')->send(new FormSubmissionMail($data));

            return redirect()->route('submission.status')->with('success', 'Your booking has been submitted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('submission.status')->with('error', 'There was a problem sending your booking. Please try again later.');
        }
    }

    public function submissionStatus()
    {
        return view('submission-status');
    }
}
