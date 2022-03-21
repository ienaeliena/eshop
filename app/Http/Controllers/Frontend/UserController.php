<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id',Auth::id())->get();
        return view('frontend.orders.index',compact('orders'));
    }
    public function view($id)
    {
        $orders = Order::where('id',$id)->where('user_id',Auth::id())->first();
        return view('frontend.orders.view', compact('orders'));

    }
    public function viewProfile()
    {
        $user = User::where('id',Auth::id())->first();
        return view('frontend.user.view', compact('user'));

    }
    public function editProfile()
    {
        $user = User::where('id',Auth::id())->first();
        return view('frontend.user.edit', compact('user'));

    }
    public function updateProfile(request $request)
    {
        if(Auth::check())
        {
            $user = User::where('id',Auth::id())->first();
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address1 = $request->address1;
            $user->address2 = $request->address2;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->pincode = $request->pincode;
            $user->updated_at = Carbon::now();
            $user->update();

            return redirect('my-profile')->with('status','Successfully Updated user Profile');


        }



    }
}
