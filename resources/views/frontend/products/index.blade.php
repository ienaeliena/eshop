@extends('layouts.front')

@section('title')
{{ $category->name }}
@endsection

@section('content')

<div class="pt-5 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0 py-3">
            <a href="{{ url('/') }}">
                Collections
            </a>
             /
            {{ $category->name }}
        </h6>
    </div>
</div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>{{ $category->name }}</h2>
                @foreach ($products as $prod)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <a href="{{ url('category/'.$category->slug.'/'.$prod->slug) }}">
                                <img class="card" src="{{ asset('storage/'.$prod->image) }}" alt="product image">
                                <div class="card-body">
                                    <h5>{{ $prod->name }}</h5>
                                    <span class="float-start">{{ $prod->selling_price }}</span>
                                    <span class="float-end"><s>{{ $prod->original_price }}</s></span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

