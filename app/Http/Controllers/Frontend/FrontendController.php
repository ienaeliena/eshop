<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('status','1')->where('trending','1')->take('15')->get();
        $trendingCategory = Category::where('popular','1')->take('15')->get();
        return view('frontend.index',compact('featuredProducts','trendingCategory'));

    }

    public function category()
    {
        $category = Category::where('status','0')->get();
        return view('frontend.category',compact('category'));
    }

    public function viewCategory($slug)
    {
        if(Category::where('slug',$slug)->exists()){
            $category = Category::where('slug',$slug)->first();
            $products = Product::where('cate_id',$category->id)->where('status','0')->get();
            return view('frontend.products.index',compact('category','products'));

        }else{
            return redirect('/')->with('status','Slug does not exists');
        }


    }
    public function productView($cate_slug, $prod_slug)
    {
        if(Category::where('slug',$cate_slug)->exists())
        {
            if(Product::where('slug',$prod_slug)->exists())
            {
                $products = Product::where('slug',$prod_slug)->first();
                $ratings = Rating::where('prod_id',$products->id)->get();
                $rating_sum = Rating::where('prod_id',$products->id)->sum('stars_rated');
                $user_rating = Rating::where('prod_id',$products->id)->where('user_id',Auth::id())->first();
                $reviews = Review::where('prod_id',$products->id)->get();
                 //dd($reviews);

                if($ratings->count() > 0)
                {
                    $rating_value = $rating_sum/$ratings->count();

                }else
                {
                    $rating_value = '0';
                }

                 return view('frontend.products.view',compact('products','ratings','reviews','rating_value','user_rating'));

            }
            else{
                return redirect('/')->with('status','The link was broken');

            }


        }
        else{
            return redirect('/')->with('status','No Such Category Found');
        }


    }

    public function productListAjax()
    {
        $products = Product::select('name')->where('status','0')->get();
        $data = [];

        foreach($products as $item)
        {
            $data[] = $item['name'];

        }

        return $data;

    }

    public function searchProduct(Request $request)
    {
        $searchedProduct = $request->product_name;
        if($searchedProduct != ""){
            $product = Product::where('name','LIKE',"%$searchedProduct%")->where('status','0')->first();
            if($product){
                return redirect('category/'.$product->category->slug.'/'.$product->slug);

            }
            else{
                return redirect()->back()->with('status',"No product matched your search");
            }
        }
        else{
            return redirect()->back();
        }

    }
}
