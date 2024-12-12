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

    public function view($id){
        $invoice = Invoice::findOrFail($id); 
        return view('back.pages.invoiceview', compact('invoice'));
    }


    public function invoiceList(){
        $invoicelist = Invoice::all();
        return view('back.pages.invoicelist', compact('invoicelist'));
    }

}
