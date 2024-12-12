<?php


namespace App\Mail;

use Illuminate\Mail\Mailable;

class InvoiceEmail extends Mailable
{
    public $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function build()
    {
        return $this->view('emails.invoice')  // تأكد من أنك قد أنشأت هذه الـ View
                    ->subject('Your Invoice from RentLuxuria')
                    ->with([
                        'invoice' => $this->invoice,
                    ]);
    }
}
