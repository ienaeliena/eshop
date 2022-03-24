@extends('layouts.admin')

@section('content')
<div class="row p-1">&nbsp;</div>
<div class="card mx-3">
    <div class="card-header">
        <h1>Edit/Update Category</h1>

    </div>
    <div class="card-body">
        <form action="{{ url('update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                    @error('name')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                {{-- <div class="com-md-6 mb-3">
                    <label for="">Slug</label>
                    <input type="text" class="form-control" name="slug">
                </div> --}}
                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea name="description" id="" rows="5" class="form-control">{{ $category->description }}</textarea>
                    @error('description')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Status</label>
                    <input type="checkbox" class="form-control" name="status" {{ $category->status == "1" ? 'checked':'' }}>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Popular</label>
                    <input type="checkbox" class="form-control" name="popular" {{ $category->popular == "1" ? 'checked':'' }}>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title" value="{{ $category->meta_title }}">
                    @error('meta_title')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Meta Keywords</label>
                    <textarea name="meta_keywords" id="" rows="5" class="form-control">{{ $category->meta_keywords }}</textarea>
                    @error('meta_keywords')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Meta Description</label>
                    <textarea name="meta_descrip" id="" rows="5" class="form-control">{{ $category->meta_descrip }}</textarea>
                    @error('meta_description')
                    <p style="color:red; margin-bottom:25px">{{ $message }} </p>
                    @enderror
                </div>
                @if ($category->image)
                <img src="{{ asset('storage/'.$category->image) }}" alt="image here" class="cate-image">

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
