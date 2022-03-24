@extends('layouts.admin')
@section('title')
Orders
@endsection

@section('content')
<div class="container pt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Orders History</h4>
                    <a href="{{ url('orders') }}"  class="btn btn-warning float-right">New Order </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tracking Number</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                @php
                                if($item->order_status == 0)
                                {
                                    $orderStatus = "Pending";
                                }elseif($item->order_status == 1)
                                {
                                    $orderStatus = "Processing";
                                }elseif($item->order_status == 2)
                                {
                                    $orderStatus = "Shipped";
                                }elseif($item->order_status == 3)
                                {
                                    $orderStatus = "Delivered";
                                }else{
                                    $orderStatus = "N/A";
                                }
                                @endphp
                                <tr>
                                    <td>{{ $item->tracking_no }}</td>
                                    <td>{{ $item->total_price }}</td>
                                    <td>{{ $orderStatus }}</td>
                                    <td><a href="{{ url('admin/view-order/'.$item->id) }}" class="btn btn-primary">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection


