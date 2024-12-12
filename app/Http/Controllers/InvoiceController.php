<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class InvoiceController extends Controller
{
    public function show($id){
        $invoice = Invoice::findOrFail($id); // اجلب الفاتورة من قاعدة البيانات
        return view('front.pages.stripe.invoice', compact('invoice'));
    }

    public function view($id){
        $invoice = Invoice::findOrFail($id); 

    // Generate the PDF
         $pdf = PDF::loadView('back.pages.invoiceview', compact('invoice'));

    // Return the PDF as a response
    return $pdf->download('invoice_' . $invoice->id . '.pdf');
    }


    public function invoiceList(){
        $invoicelist = Invoice::all();
        return view('back.pages.invoicelist', compact('invoicelist'));
    }

}
