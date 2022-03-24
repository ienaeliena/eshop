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
            $productId = $product->id;
            $review = Review::where('user_id',Auth::id())->where('prod_id',$productId)->first();

            if($review){
                return view('frontend.reviews.edit',compact('review'));
            }
            else{
                $verifiedPurchase = Order::where('orders.user_id',Auth::id())
                   ->join('order_items','orders.id','order_items.order_id')
                   ->where('order_items.prod_id',$productId)->get();

                return view('frontend.reviews.index',compact('product','verifiedPurchase'));
            }



        }
        else
        {
            return redirect()->back()->with('status',"The link you followed was broken");

        }

    }

    public function create(Request $request)
    {
        $productId = $request->product_id;
        $product = Product::where('id',$productId)->where('status','0')->first();
        $categorySlug = $product->category->slug;
        $prodSlug = $product->slug;


        if($product)
        {
            $userReview = $request->user_review;
            $existingReview = Review::where('prod_id',$productId)->where('user_id',Auth::id())->first();

            if($existingReview)
            {
                $existingReview->user_review = $userReview;
                $existingReview->updated_at = Carbon::now();
                $existingReview->update();
                return redirect('category/'.$categorySlug.'/'.$prodSlug)->with('status',"Thank you, your review has been updated ");
            }
            else
            {
                $newReview = Review::create([
                    'user_id' => Auth::id(),
                    'prod_id' => $productId,
                    'user_review' => $userReview
                ]);

                if($newReview)
                {
                    return redirect('category/'.$categorySlug.'/'.$prodSlug)->with('status',"Thank you for writing a review ");

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
        $userReview = $request->user_review;
        if($userReview != '')
        {
            $review = review::where('id',$request->review_id)->first();
            if($review){
                $review->user_review = $userReview;
                $review->updated_at =  Carbon::now();
                $review->update();
                $prodSlug = $review->product->slug;
                $category = Category::find($review->product->cate_id);
                $categorySlug = $category->slug;
                return redirect('category/'.$categorySlug.'/'.$prodSlug)->with('status',"Thank you, your review has been updated ");

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
