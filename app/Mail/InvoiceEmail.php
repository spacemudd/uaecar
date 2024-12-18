<?php

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\SerializesModels;

class InvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $pdfPath;

    /**
     * Create a new message instance.
     *
     * @param Invoice $invoice
     * @param string $pdfPath
     * @return void
     */
    public function __construct(Invoice $invoice, $pdfPath)
    {
        $this->invoice = $invoice;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.invoice')
                    ->attach($this->pdfPath, [
                        'as' => 'invoice.pdf',
                        'mime' => 'application/pdf',
                    ])
                    ->subject('Luxuria Invoice #'. $this->invoice->id);
    }
}
