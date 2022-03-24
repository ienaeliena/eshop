<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index()
    {
        $oldCartItems = Cart::where('user_id',Auth::id())->get();
        foreach($oldCartItems as $item)
        {
            if(!Product::where('id',$item->prod_id)->where('qty','>=',$item->prod_qty)->exists())
            {
                $removeItem = Cart::where('user_id',Auth::id())->where('prod_id',$item->prod_id)->first();
                $removeItem->delete();
            }

        }
        $cartItems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.checkout',compact('cartItems'));

    }
    public function placeOrder(Request $request)
    {
        if(Order::latest()->first() !== null){
            $invId = Order::latest()->first()->id +1 ; // get lattest order id
        }else{
            $invId = 1;
        }
        $invoiceNumber = "INV".Carbon::now()->format('ymd').$invId;

        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->fname;
        $order->lname = $request->lname;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address1 = $request->address1;
        $order->address2 = $request->address2;
        $order->city = $request->city;
        $order->country = $request->country;
        $order->state = $request->state;
        $order->pincode = $request->pincode;
        $order->payment_mode = $request->payment_mode;
        $order->payment_id = $request->payment_id;

        //TO calculate the total price
        $total = 0;
        $cartItems_total = Cart::where('user_id',Auth::id())->get();
        foreach($cartItems_total as $prod)
        {
            // $total += $prod->products->selling_price;
            $total += $prod->products->selling_price * $prod->prod_qty;
        }
        $order->total_price = $total;

        $order->tracking_no = 'iena'.rand(1111,9999);
        if($request->payment_mode == "Paid By Paypal")
        {
            $order->payment_status = 1;

        }else{
            $order->payment_mode = "COD";
            $order->payment_id = $invoiceNumber;
        }
        $order->save();

        //save invoice information

        $invoice = new Invoice();
        $invoice->invoice_no = $invoiceNumber;
        $invoice->order_id= $invId;
        $invoice->user_id= Auth::id();
        $invoice->save();

        $cartItems = Cart::where('user_id',Auth::id())->get();
        foreach($cartItems as $item)
        {
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->products->selling_price,
            ]);

            $prod = Product::where('id',$item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->update();
        }
        if(Auth::user()->address1 == NULL)
        {
            $user = User::where('id',Auth::id())->first();
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address1 = $request->address1;
            $user->address2 = $request->address2;
            $user->city = $request->city;
            $user->country = $request->country;
            $user->state = $request->state;
            $user->pincode = $request->pincode;
            $user->update();

        }

        $cartItems = Cart::where('user_id',Auth::id())->get();
        Cart::destroy($cartItems);

        if($request->payment_mode == "Paid By Paypal")
        {
            return response()->json(['status' => "Order Placed Successfully"]);

        }

        return redirect('my-orders')->with('status',"Order Placed Successfully");
    }

    // public function razorpaycheck(Request $request)
    // {
    //     $cartItems = Cart::where('user_id', Auth::id())->get();
    //     $total_price = 0;
    //     foreach($cartItems as $item)
    //     {
    //         $total_price += $item->products->selling_price * $item->prod_qty;
    //     }

    //     $firstname = $request->firstname;
    //     $lastname = $request->lastname;
    //     $email = $request->email;
    //     $phone = $request->phone;
    //     $address1 = $request->address1;
    //     $address2 = $request->address2;
    //     $city = $request->city;
    //     $state = $request->state;
    //     $country = $request->country;
    //     $pincode = $request->pincode;


    //     return response()->json([
    //         'firstname' => $firstname,
    //         'lastname' => $lastname,
    //         'email' => $email,
    //         'phone' => $phone,
    //         'address1' => $address1,
    //         'address2' => $address2,
    //         'city' => $city,
    //         'state' => $state,
    //         'country' => $country,
    //         'pincode' => $pincode,
    //         'total_price' => $total_price
    //     ]);


    // }
}
