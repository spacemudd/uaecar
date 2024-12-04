<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use PDF;

class InvoiceController extends Controller
{
    public function show($id){
        $invoice = Invoice::findOrFail($id); // اجلب الفاتورة من قاعدة البيانات
        return view('front.pages.stripe.invoice', compact('invoice'));
    }

    // public function download($id)
    // {
    //     // Get the invoice data
    //     $invoice = Invoice::findOrFail($id);

    //     // Load the view and pass the invoice data
    //     $pdf = PDF::loadView('invoices.pdf', compact('invoice'));

    //     // Download the PDF file
    //     return $pdf->download('invoice_' . $invoice->id . '.pdf');
    // }
}
