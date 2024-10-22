<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $carDetailsUrl;

    public function __construct($data, $carDetailsUrl)
    {
        $this->data = $data;
        $this->carDetailsUrl = $carDetailsUrl;
    }

    public function build()
    {
        return $this->view('emails.form-submition')
                    ->subject('Kaiadmin')
                    ->with([
                        'data' => $this->data,
                        'carDetailsUrl' => $this->carDetailsUrl,
                    ]);
    }
}