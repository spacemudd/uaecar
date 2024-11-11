<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\BookingRequest;

class FormSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingRequest;
    public $carDetailsUrl;
    public $subject;

    public function __construct(BookingRequest $bookingRequest, $carDetailsUrl, $subject)
    {
        $this->bookingRequest = $bookingRequest;
        $this->carDetailsUrl = $carDetailsUrl;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->view('emails.form-submition')
                    ->subject($this->subject)  // Set the subject dynamically
                    ->with([
                        'bookingRequest' => $this->bookingRequest,
                        'carDetailsUrl' => $this->carDetailsUrl
                    ])
                    ->from('info@rentluxuria.com', 'LUXURIA CARS')
                    ->replyTo('info@rentluxuria.com');
    }
}
