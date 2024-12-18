<?php

namespace App\Jobs;

use App\Mail\InvoiceEmail;
use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class SendInvoiceEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $invoice;

    /**
     * Create a new job instance.
     *
     * @param Invoice $invoice
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $pdf = SnappyPdf::loadView('emails.invoice', ['invoice' => $this->invoice]);

            $pdfPath = storage_path("invoices/invoice_{$this->invoice->id}.pdf");
            $pdf->save($pdfPath);

            Mail::to($this->invoice->customer_email)->send(new InvoiceEmail($this->invoice, $pdfPath));

            Log::info("Email sent successfully to {$this->invoice->customer_email}");
        } catch (\Exception $e) {
            Log::error("Error in SendInvoiceEmailJob: {$e->getMessage()}");
        }
    }
}
