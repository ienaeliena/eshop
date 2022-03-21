<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\ReviewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[FrontendController::class,'index']);
Route::get('home',[FrontendController::class,'index']); //iena tambah
Route::get('category',[FrontendController::class,'category']);
Route::get('view-category/{slug}',[FrontendController::class,'viewCategory']);
Route::get('category/{cate_slug}/{prod_slug}',[FrontendController::class,'productView']);

Route::get('product-list',[frontendController::class,'productListAjax']);
Route::post('search-product',[frontendController::class,'searchProduct']);

Auth::routes();

Route::get('load-cart-data',[CartController::class,'cartCount']);
Route::get('load-wishlist-data',[WishlistController::class,'wishlistCount']);


Route::post('add-to-cart',[CartController::class,'addProduct']);
Route::post('delete-cart-item',[CartController::class,'deleteProduct']);
Route::post('update-cart',[CartController::class,'updateCart']);
Route::post('add-to-wishlist',[WishlistController::class,'add']);
Route:: post('delete-wishlist-item',[WishlistController::class,'deleteItem']);

Route::middleware(['auth'])->group(function (){
    Route::get('cart',[CartController::class,'viewCart']);
    Route::get('checkout',[CheckoutController::class,'index']);
    route::post('place-order',[checkoutController::class,'placeOrder']);

    Route::get('my-orders',[UserController::class,'index']);
    Route::get('view-order/{id}',[UserController::class,'view']);
    Route::post('add-rating',[RatingController::class,'add']);
    Route::get('add-review/{product_slug}/userreview',[ReviewController::class,'add']);
    Route::post('add-review',[ReviewController::class,'create']);
    Route::get('edit-review/{product_slug}/userreview',[ReviewController::class,'edit']);
    Route::put('update-review',[ReviewController::class,'update']);
    Route::get('wishlist',[WishlistController::class,'index']);
    Route::post('proceed-to-pay',[CheckoutController::class,'razorpaycheck']);
    Route::get('my-profile',[UserController::class,'viewProfile']);
    Route::get('edit-profile',[UserController::class,'updateProfile']);

});

Route::middleware(['auth', 'isAdmin'])->group(function () {
     Route::get('/dashboard','Admin\FrontendController@index');

    Route::get('categories','Admin\CategoryController@index');
    Route::get('add_categories','Admin\CategoryController@add');
    Route::Post('insert_category','Admin\CategoryController@insert');
    Route::get('edit_category/{id}', [CategoryController::class,'edit']);
    Route::put('update_category/{id}',[CategoryController::class,'update']);
    Route::get('delete_category/{id}',[CategoryController::class,'destroy']);

    Route::get('products',[ProductController::class,'index']);
    Route::get('add_products',[ProductController::class,'add']);
    Route::post('insert_product',[ProductController::class,'insert']);
    Route::get('edit_product/{id}',[ProductController::class,'edit']);
    Route::put('update_product/{id}',[ProductController::class,'update']);
    Route::get('delete_product/{id}',[ProductController::class,'destroy']);

    Route::get('users',[FrontendController::class,'users']);

    Route::get('orders',[OrderController::class,'index']);
    Route::get('admin/view-order/{id}',[OrderController::class,'view']);
    Route::put('update-order/{id}',[OrderController::class,'updateOrder']);
    Route::get('order-history',[OrderController::class,'orderHistory']);

    Route::get('users',[DashboardController::class,'users']);
    Route::get('view-user/{id}',[DashboardController::class,'viewUser']);

 });
