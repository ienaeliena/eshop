<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function add($product_slug)
    {
        $product = Product::where('slug',$product_slug)->where('status','0')->first();

        if($product)
        {
            $product_id = $product->id;
            $review = Review::where('user_id',Auth::id())->where('prod_id',$product_id)->first();

            if($review){
                return view('frontend.reviews.edit',compact('review'));
            }
            else{
                $verified_purchase = Order::where('orders.user_id',Auth::id())
                   ->join('order_items','orders.id','order_items.order_id')
                   ->where('order_items.prod_id',$product_id)->get();

                return view('frontend.reviews.index',compact('product','verified_purchase'));
            }



        }
        else
        {
            return redirect()->back()->with('status',"The link you followed was broken");

        }

    }

    public function create(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::where('id',$product_id)->where('status','0')->first();
        $category_slug = $product->category->slug;
        $prod_slug = $product->slug;


        if($product)
        {
            $user_review = $request->user_review;
            $existing_review = Review::where('prod_id',$product_id)->where('user_id',Auth::id())->first();

            if($existing_review)
            {
                $existing_review->user_review = $user_review;
                $existing_review->updated_at = Carbon::now();
                $existing_review->update();
                return redirect('category/'.$category_slug.'/'.$prod_slug)->with('status',"Thank you, your review has been updated ");
            }
            else
            {
                $new_review = Review::create([
                    'user_id' => Auth::id(),
                    'prod_id' => $product_id,
                    'user_review' => $user_review
                ]);

                if($new_review)
                {
                    return redirect('category/'.$category_slug.'/'.$prod_slug)->with('status',"Thank you for writing a review ");

                }

            }

        }
        else
        {
            return redirect()->back()->with('status',"The link you followed was broken");

        }

    }

    public function edit($product_slug)
    {
        $product = Product::where('slug',$product_slug)->where('status','0')->first();
        if($product)
        {
            $productId = $product->id;
            $review = Review::where('user_id',Auth::id())->where('prod_id',$productId)->first();
            if($review)
            {
                return view('frontend.reviews.edit',compact('review'));
            }
            else
            {
                return redirect()->back()->with('status',"The link you followed was broken");
            }

        }
        else
        {
            return redirect()->back()->with('status',"The link you followed was broken");

        }

    }

    public function update(Request $request)
    {
        $user_review = $request->user_review;
        if($user_review != '')
        {
            $review = review::where('id',$request->review_id)->first();
            if($review){
                $review->user_review = $user_review;
                $review->updated_at =  Carbon::now();
                $review->update();
                $prod_slug = $review->product->slug;
                $category = Category::find($review->product->cate_id);
                $category_slug = $category->slug;
                return redirect('category/'.$category_slug.'/'.$prod_slug)->with('status',"Thank you, your review has been updated ");

            }
            else
            {
                return redirect()->back()->with('status',"The link you followed was broken");
            }

        }
        else
        {
            return redirect()->back()->with('status',"You cannot submit an empty review");
        }



    }
}
