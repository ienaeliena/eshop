@extends('layouts.front')

@section('title')
    My Orders
@endsection

@section('content')

<div class="container py-5">
    <div class="row mb-0 py-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Orders View
                        <a href="{{ url('my-orders') }}" class="btn btn-warning float-end">Back</a>
                    </h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <h4>Shipping Details</h4>
                        <hr>
                        <div class="col-md-6 order-details">
                            <label for="">First Name</label>
                            <div class="border"> {{ $orders->fname }}</div>
                            <label for="">Last Name</label>
                            <div class="border"> {{ $orders->lname }}</div>
                            <label for="">Email</label>
                            <div class="border"> {{ $orders->email }}</div>
                            <label for="">Contact Number</label>
                            <div class="border"> {{ $orders->phone }}</div>
                            <label for="">Shipping Address</label>
                            <div class="border">
                                {{ $orders->address1 }}, <br>
                                {{ $orders->address2 }},<br>
                                {{ $orders->city }},<br>
                                {{ $orders->state }},
                                {{ $orders->country }},
                            </div>
                            <label for="">Zip Code</label>
                            <div class="border"> {{ $orders->pincode }}</div>


                        </div>
                        <div class="col-md-6">
                            <h4>Order Details</h4>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->products->name }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->price * $item->qty  }}</td>
                                            <td>
                                                <img src="{{ asset('storage/'.$item->products->image) }}" width="50px" alt="{{ $item->products->name }}">

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4 class="px-2">Grand Total : <span class="float-end">{{ $orders->total_price }}</h4></span>
                            <h6 class="px-2">Payment Mode : {{ $orders->payment_mode     }}</h6>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
