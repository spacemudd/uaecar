<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function show($id){
        $invoice = Invoice::findOrFail($id); // اجلب الفاتورة من قاعدة البيانات
        return view('front.pages.stripe.invoice', compact('invoice'));
    }
}
