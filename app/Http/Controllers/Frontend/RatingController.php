<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->product_id;
        $starsRated = $request->product_rating;

        $productCheck = Product::where('id',$productId)->where('status','0')->first();
        if($productCheck)
        {
            $verifiedPurchase = Order::where('orders.user_id',Auth::id())
              ->join('order_items','orders.id','order_items.order_id')
              ->where('order_items.prod_id',$productId)->get();

            if($verifiedPurchase->count() > 0)
            {
                $existingRating = Rating::where('user_id',Auth::id())->where('prod_id',$productId)->first();
                if($existingRating)
                {
                    $existingRating->stars_rated = $starsRated;
                    $existingRating->update();

                }
                else
                {
                    Rating::create([
                        'user_id' => Auth::id(),
                        'prod_id' => $productId,
                        'stars_rated' => $starsRated
                    ]);

                }
                return redirect()->back()->with('status',"Thank you for rating this product");
            }
            else
            {
                return redirect()->back()->with('status',"You cannot rate a product without purchase");

            }

        }
        else
        {
            return redirect()->back()->with('status',"The link you followed was broken");

        }
    }
}
