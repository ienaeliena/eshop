<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $productId = $request->input('product_id');
        $productQty = $request->input('product_qty');

        if(Auth::check())
        {
            $prod_check = Product::where('id', $productId)->first();
            if($prod_check)
            {
                if(Cart::where('prod_id', $productId)->where('user_id', Auth::id())->exists())
                {
                    return response()->json(['status' => $prod_check->name." Already in Cart"]);
                }
                else
                {
                    $cartItem = new Cart();
                    $cartItem->prod_id = $productId;
                    $cartItem->prod_qty = $productQty;
                    $cartItem->user_id = Auth::id();
                    $cartItem->save();

                    if(Wishlist::where('user_id',Auth::id())->where('prod_id',$productId)->exists())
                    {
                        $wishlistCheck = Wishlist::where('user_id',Auth::id())->where('prod_id',$productId)->first();
                        $wishlistCheck->delete();

                    }

                    return response()->json(['status' => $prod_check->name." Added To Cart"]);
                }

            }

        }
        else
        {
            return response()->json(['status' => "Login to Continue"]);

        }
    }

    public function viewCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.cart',compact('cartItems'));
    }

    public function deleteProduct(Request $request)
    {
        if(Auth::check())
        {
            $prod_id = $request->prod_id;
            if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {
                $cartItem = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' =>"Product Deleted Successfully"]);

            }

        }else
        {
            return response()->json(['status' =>"Login to continue"]);

        }


    }

    public function updateCart(Request $request)
    {
        $prod_id = $request->prod_id;
        $prod_qty = $request->prod_qty;

        if(Auth::check())
        {
            if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {
                $cart = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cart->prod_qty = $prod_qty;
                $cart->save();
                return response()->json(['status' =>"Quantity    Updated"]);

            }


        }



    }

    public function cartCount()
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count' => $cartCount]);

    }
}
