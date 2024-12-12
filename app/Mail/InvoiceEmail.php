<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceEmail extends Mailable
{
    use SerializesModels;

    public $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function build()
    {
        return $this->view('email.invoice') // استخدم اسم الـ view هنا
                    ->with('invoice', $this->invoice); // تمرير المتغير إلى الـ view
    }
}
