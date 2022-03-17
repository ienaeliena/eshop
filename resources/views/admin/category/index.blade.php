@extends('layouts.admin')

@section('content')
<div class="row p-1">&nbsp;</div>
<div class="card mx-3">
    <div class="card-header">
        <h4>Category Page</h4>
        <hr>

    </div>
    <div class="card-body">
        <table class="table table-primary table-bordered table-striped">
            <thead>
                <tr class="bg-primary">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $item)
                <tr>
                    <td>{{ $item->id }} </td>
                    <td>{{ $item->name }} </td>
                    <td>{{ $item->description }} </td>
                    <td>
                       <img src="{{ asset('storage/'.$item->image) }}" alt="image here" class="cate-image">
                    </td>
                    <td>
                        <a href="{{ url('edit_category/'.$item->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('delete_category/'.$item->id) }}" class="btn btn-danger">Delete</a>
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
