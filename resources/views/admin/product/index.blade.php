@extends('layouts.admin')

@section('content')
<div class="row p-1">&nbsp;</div>
<div class="card mx-3">
    <div class="card-header">
        <h4>Product Page</h4>
        <hr>

    </div>
    <div class="card-body">
        <table class="table table-primary table-bordered table-striped">
            <thead>
                <tr class="bg-primary">
                    <th>Id</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Original Price</th>
                    <th>Selling Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                <tr>
                    <td>{{ $item->id }} </td>
                    <td>{{ $item->category->name }} </td>
                    <td>{{ $item->name }} </td>
                    <td>{{ $item->description }} </td>
                    <td>{{ $item->original_price }} </td>
                    <td>{{ $item->selling_price }} </td>
                    <td>
                       <img src="{{ asset('storage/'.$item->image) }}" alt="image here" class="cate-image">
                    </td>
                    <td>
                        <a href="{{ url('edit-product/'.$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ url('delete-product/'.$item->id) }}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection

@section('scripts')

@endsection
