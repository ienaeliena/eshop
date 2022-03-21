<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
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
    public function updateProfile()
    {
        $user = User::where('id',Auth::id())->first();
        return view('frontend.user.edit', compact('user'));

    }
}
