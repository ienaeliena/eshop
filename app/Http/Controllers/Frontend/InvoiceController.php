<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function view($id){
        $invoice = Invoice::where('order_id',$id)->first();
        return view('frontend.invoices.view',compact('invoice'));

    }
}
