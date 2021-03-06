<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('frontend.wishlist',compact('wishlist'));

    }

    public function add(Request $request)
    {
        if(Auth::check())
        {
            //$prodId = $request->product_id;
            $prodId = $request->input('product_id');
            if(Product::find($prodId))
            {
                $wish = new Wishlist();
                $wish->prod_id = $prodId;
                $wish->user_id = Auth::id();
                $wish->save();

                return response()->json(['status' => "Product Added to Wishlist"]);

            }
            else
            {
                return response()->json(['status' => "Product Does not Exist"]);
            }

        }
        else
        {
            return response()->json(['status' => "Please Login To Continue"]);

        }


    }

    public function deleteItem(Request $request)
    {
        if(Auth::check())
        {
            $prodId = $request->prod_id;
            if(Wishlist::where('prod_id', $prodId)->where('user_id', Auth::id())->exists())
            {
                $wish = Wishlist::where('prod_id', $prodId)->where('user_id', Auth::id())->first();
                $wish->delete();
                return response()->json(['status' =>"Item Removed Successfully From Wishlist"]);

            }

        }else
        {
            return response()->json(['status' =>"Login to continue"]);

        }


    }

    public function wishlistCount()
    {
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count' => $wishlistCount]);
    }
}
