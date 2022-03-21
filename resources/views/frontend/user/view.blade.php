@extends('layouts.front')

@section('title')
   User Profile
@endsection

@section('content')
<div class="pt-5 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0 py-3">
            <a href="{{ url('/') }}">
                Home
            </a>
             /
            <a href="{{ url('my-orders') }}">
               Order
            </a>
        </h6>
    </div>
</div>
<div class="container mt-3">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>User Profile</h6>
                        <hr>
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="firstName">First Name : </label><span class="profile-details">{{ Auth::user()->fname }}</span>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName">Last Name : </label><span class="profile-details">{{ Auth::user()->lname }}</span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="email">Email : </label><span class="profile-details">{{ Auth::user()->email }}</span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="phoneNumber">Phone Number : </label><span class="profile-details">{{ Auth::user()->phone }}</span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="address1">Address 1 : </label><span class="profile-details">{{ Auth::user()->address1 }}</span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="Address2">Address 2 : </label><span class="profile-details">{{ Auth::user()->address2 }}</span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="city">City : </label><span class="profile-details">{{ Auth::user()->city }}</span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="state">State : </label><span class="profile-details">{{ Auth::user()->state }}</span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="country">Country : </label><span class="profile-details">{{ Auth::user()->country }}</span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="pincode">Pin Code : </label><span class="profile-details">{{ Auth::user()->pincode }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('edit-profile') }}" class="btn btn-outline-success float-end">
                            Update Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
