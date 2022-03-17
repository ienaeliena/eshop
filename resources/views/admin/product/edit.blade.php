@extends('layouts.admin')

@section('content')
<div class="row p-1">&nbsp;</div>
<div class="card mx-3">
    <div class="card-header">
        <h1>Update Product</h1>

    </div>
    <div class="card-body">
        <form action="{{ url('update_product/'.$products->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12 mb-3">
                    <select class="form-select" name="cate_id">
                        <option value="" selected>Select a Category</option>
                        @foreach ($category as $item)
                             <option value="{{ $item->id }}" {{ $item->id == $products->cate_id ? 'selected':'' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $products->name }}">
                    @error('name')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                {{-- <div class="com-md-6 mb-3">
                    <label for="">Slug</label>
                    <input type="text" class="form-control" name="slug">
                </div> --}}
                <div class="col-md-12 mb-3">
                    <label for="">Small Description</label>
                    <textarea name="small_description" id="" rows="5" class="form-control">{{ $products->small_description }}</textarea>
                    @error('description')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea name="description" id="" rows="5" class="form-control">{{ $products->description }}</textarea>
                    @error('description')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Original Price</label>
                    <input type="number" class="form-control" name="original_price" value="{{ $products->original_price }}">
                    @error('original_price')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Selling Price</label>
                    <input type="number" class="form-control" name="selling_price" value="{{ $products->selling_price }}">
                    @error('selling_price')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Tax</label>
                    <input type="number" class="form-control" name="tax" value="{{ $products->tax }}">
                    @error('tax')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Quantity</label>
                    <input type="number" class="form-control" name="qty" value="{{ $products->qty }}">
                    @error('qty')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Status</label>
                    <input type="checkbox" class="form-control" name="status" {{ $products->status == "1" ? 'checked':'' }}>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Trending</label>
                    <input type="checkbox" class="form-control" name="trending" {{ $products->trending == "1" ? 'checked':'' }}>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title" value="{{ $products->meta_title }}">
                    @error('meta_title')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Meta Keywords</label>
                    <textarea name="meta_keywords" id="" rows="5" class="form-control">{{ $products->meta_keywords }}</textarea>
                    @error('meta_keywords')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Meta Description</label>
                    <textarea name="meta_description" id="" rows="5" class="form-control">{{ $products->meta_description }}</textarea>
                    @error('meta_description')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                @if ($products->image)
                <img src="{{ asset('storage/'.$products->image) }}" alt="image here" class="cate-image">

                @endif
                <div class="col-md-12">
                    <input type="file" name="image" id='image' class="form-control">
                    @error('image')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-lg">Update</button>
                </div>

            </div>

        </form>
    </div>
</div>

@endsection

@section('scripts')

@endsection
