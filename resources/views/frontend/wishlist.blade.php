@extends('layouts.front')

@section('title')
    My Cart
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('/') }}">
                Home
            </a>
             /
             <a href="{{ url('wishlist') }}">
                Whishlist
            </a>
            </h6>
    </div>
</div>

<div class="container my-5">
    <div class="card shadow wishlistItems">
        <div class="card-body">
            @if ($wishlist->count() > 0)
                    @foreach ($wishlist as $item)
                        <div class="row product_data">
                            <div class="col-md-2 my-auto">
                                <img src="{{ asset('storage/'.$item->products->image) }}" height="70px" weight="70px" alt="image here">
                            </div>
                            <div class="col-md-2 my-auto">
                                <h6>{{ $item->products->name }}</h6>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h6>RM {{ $item->products->selling_price }}</h6>
                            </div>
                            <div class="col-md-2 my-auto">
                                <input type="hidden" class="prod_id" value="{{ $item->prod_id }}"> 
                                @if ($item->products->qty >= $item->prod_qty)
                                <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3" style="width:130px;">
                                        <button class="input-group-text decrement-btn">-</button>
                                        <input type="text" name="quantity" class="form-control qty-input text-center" value="1">
                                        <button class="input-group-text increment-btn">+</button>
                                    </div>
                                @else
                                <h6>Out Of Stock</h6>
                                @endif
                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-success addToCartBtn"> <i class="fa fa-shopping-cart"></i> Add To Cart</button>
                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-danger remove-wishlist-item"> <i class="fa fa-trash-can"></i> Remove</button>
                            </div>
                        </div>
                    @endforeach
            @else

            <h4>There's no product in your whishlist</h4>

            @endif

        </div>

    </div>
</div>

@endsection
