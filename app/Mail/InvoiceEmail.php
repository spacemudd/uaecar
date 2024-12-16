<?php


namespace App\Mail;

use Illuminate\Mail\Mailable;

class InvoiceEmail extends Mailable
{
    public $invoice;
    public $pdfPath;

    public function __construct($invoice, $pdfPath)
    {
        $this->invoice = $invoice;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->view('emails.invoice')  // تأكد من أنك قد أنشأت هذه الـ View
                    ->subject('Your Invoice from RentLuxuria')
                    ->with([
                        'invoice' => $this->invoice,
                    ])
                    ->attach($this->pdfPath, [
                        'mime' => 'application/pdf',
                    ]);
    }
    
}
