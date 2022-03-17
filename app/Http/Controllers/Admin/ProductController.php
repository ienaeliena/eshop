<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
Use illuminate\support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index',compact('products'));
    }

    public function add()
    {
        $category = Category::all();
        return view('admin.product.add',compact('category'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cate_id' => 'required',
            'small_description' => 'required',
            'description' => 'required',
            'original_price' => 'required',
            'selling_price' => 'required',
            'qty' => 'required',
            'tax' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'image' => 'required | image'
        ]);
        $products = new Product();
        if($request->hasFile('image')){

            $ext = $request->file('image')->getClientOriginalExtension();
            $filename =  Str::slug($request->name,'-').'-'.time().'.'.$ext ;
            $imagePath = $request->file('image')->storeAs('products',$filename,'public');
            $products->image = $imagePath;

            // $file = $request->file('image');
            // $ext = $file->getClientOriginalExtension();
            // $filename = time().'.'.$ext ;
            // $file->move('assets/uploads/products/'.$filename);
            // $products->image = $filename;

        }
        $products->cate_id = $request->cate_id;
        $products->name = $request->name;
        if(Product::latest()->first() !== null){
            $postId = Product::latest()->first()->id +1; // get lattest post id and plus 1
        }else{
            $postId = 1;
        }
        $products->slug = Str::slug($request->name,'-').'-'.$postId ; //convert the words
        $products->small_description = $request->small_description;
        $products->description = $request->description;
        $products->original_price = $request->original_price;
        $products->selling_price = $request->selling_price;
        $products->qty = $request->qty;
        $products->tax = $request->tax;
        $products->status = $request->status == TRUE ? '1':'0';
        $products->trending = $request->trending == TRUE ? '1':'0';
        $products->meta_title = $request->meta_title;
        $products->meta_description = $request->meta_description;
        $products->meta_keywords = $request->meta_keywords;
        $products->save();

        return redirect('products')->with('status','Product Successfully Added');

    }

    public function edit($id)
    {
        $products = Product::find($id);
        $category = Category::all();
        return view('admin.product.edit',compact('products','category'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'cate_id' => 'required',
            'small_description' => 'required',
            'description' => 'required',
            'original_price' => 'required',
            'selling_price' => 'required',
            'qty' => 'required',
            'tax' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'image' => 'nullable | image'
        ]);

        $products = Product::find($id);
        if($request->hasFile('image')){
            $path = storage_path('app/public/'.$products->image);
            if(File::exists($path)){
                File::delete($path);
            }

            $ext = $request->file('image')->getClientOriginalExtension();
            $filename =  Str::slug($request->name,'-').'-'.time().'.'.$ext ;
            $imagePath = $request->file('image')->storeAs('category',$filename,'public');
            $products->image = $imagePath;

        }
        $products->cate_id = $request->cate_id;
        $products->name = $request->name;
        if(Product::latest()->first() !== null){
            $postId = Product::latest()->first()->id +1; // get lattest post id and plus 1
        }else{
            $postId = 1;
        }
        $products->slug = Str::slug($request->name,'-').'-'.$postId ; //convert the words
        $products->small_description = $request->small_description;
        $products->description = $request->description;
        $products->original_price = $request->original_price;
        $products->selling_price = $request->selling_price;
        $products->qty = $request->qty;
        $products->tax = $request->tax;
        $products->status = $request->status == TRUE ? '1':'0';
        $products->trending = $request->trending == TRUE ? '1':'0';
        $products->meta_title = $request->meta_title;
        $products->meta_description = $request->meta_description;
        $products->meta_keywords = $request->meta_keywords;
        $products->save();

        return redirect('products')->with('status','Product Successfully Updated');

    }

    public function destroy($id){

        $products = Product::find($id);
        if($products->image)
        {
            $path = storage_path('app/public/'.$products->image);
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $products->delete();
        return redirect('products')->with('status','Product Successfully Deleted');

    }
}
