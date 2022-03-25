<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
Use illuminate\support\Str;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return view('admin.category.index',compact('category'));
    }

    public function add(){
        return view('admin.category.add');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_descrip' => 'required',
            'meta_keywords' => 'required',
            'image' => 'required | image'
        ]);
        $category = new Category();


        if($request->hasFile('image')){

            $ext = $request->file('image')->getClientOriginalExtension();
            $filename =  Str::slug($request->name,'-').'-'.time().'.'.$ext ;
            $imagePath = $request->file('image')->storeAs('category',$filename,'public');
            $category->image = $imagePath;
        }

        $category->name = $request->name;
        if(Category::latest()->first() !== null){
            $postId = Category::latest()->first()->id +1; // get lattest post id and plus 1
        }else{
            $postId = 1;
        }
        $category->slug = Str::slug($request->name,'-').'-'.$postId ; //convert the words
        $category->description = $request->description;
        $category->status = $request->status == TRUE ? '1':'0';
        $category->popular = $request->popular == TRUE ? '1':'0';
        $category->meta_title = $request->meta_title;
        $category->meta_descrip = $request->meta_descrip;
        $category->meta_keywords = $request->meta_keywords;
        $category->save();

        return redirect('categories')->with('status','Category Successfully Added');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));

    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_descrip' => 'required',
            'meta_keywords' => 'required',
            'image' => 'nullable | image'
        ]);

        $category = Category::find($id);

        if($request->hasFile('image')){

            $path = storage_path('app/public/'.$category->image);
            if(File::exists($path)){
                File::delete($path);
            }

            $ext = $request->file('image')->getClientOriginalExtension();
            $filename =  Str::slug($request->name,'-').'-'.time().'.'.$ext ;
            $imagePath = $request->file('image')->storeAs('category',$filename,'public');
            $category->image = $imagePath;

        }
        $category->name = $request->name;
        $category->slug = Str::slug($request->name,'-').'-'.$id ; //convert the words
        $category->description = $request->description;
        $category->status = $request->status == TRUE ? '1':'0';
        $category->popular = $request->popular == TRUE ? '1':'0';
        $category->meta_title = $request->meta_title;
        $category->meta_descrip = $request->meta_descrip;
        $category->meta_keywords = $request->meta_keywords;
        $category->save();

        return redirect('categories')->with('status','Category Successfully Updated');
    }
    public function delete($id){

        $category = Category::find($id);
        if($category->image)
        {
            $path = storage_path('app/public/'.$category->image);
            if(File::exists($path)){
                File::delete($path);
            }

        }
        $category->delete();
        return redirect('categories')->with('status','Category Successfully Deleted');

    }

}
