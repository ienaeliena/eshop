<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class AdminInvoiceController extends Controller
{
    public function view($id)
    { 
        $invoice = Invoice::where('order_id',$id)->first();
        return view('admin.invoices.view',compact('invoice'));

    }
}
