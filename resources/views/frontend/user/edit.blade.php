@extends('layouts.front')

@section('title')
   Update Profile
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
    <form action="{{ url('update-profile') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Basic Details</h6>
                        <hr>
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="firstName">First Name</label>
                                <input type="text" name="fname" required class="form-control firstname" placeholder="Enter First Name" value="{{ Auth::user()->fname }}">
                                <span id="fname_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName">Last Name</label>
                                <input type="text" name="lname" required class="form-control lastname" placeholder="Enter Last Name" value="{{ Auth::user()->lname }}">
                                <span id="lname_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="email">Email</label>
                                <input type="text" name="email" required class="form-control email" placeholder="Enter Email" value="{{ Auth::user()->email }}">
                                <span id="email_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" name="phone" required class="form-control phone" placeholder="Enter Phone Number" value="{{ Auth::user()->phone }}">
                                <span id="phone_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="address1">Address 1</label>
                                <input type="text" name="address1" required class="form-control address1" placeholder="Enter Address 1" value="{{ Auth::user()->address1 }}">
                                <span id="address1_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="Address2">Address 2</label>
                                <input type="text" name="address2" required class="form-control address2" placeholder="Enter Address 2" value="{{ Auth::user()->address2 }}">
                                <span id="address2_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="city">City</label>
                                <input type="text" name="city" required class="form-control city" placeholder="Enter City" value="{{ Auth::user()->city }}">
                                <span id="city_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="state">State</label>
                                <input type="text" name="state" required class="form-control state" placeholder="Enter State" value="{{ Auth::user()->state }}">
                                <span id="state_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="country">Country</label>
                                <input type="text" name="country" required class="form-control country" placeholder="Enter Country" value="{{ Auth::user()->country }}">
                                <span id="country_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="pincode">Pin Code</label>
                                <input type="text" name="pincode" required class="form-control pincode" placeholder="Enter >Pin Code" value="{{ Auth::user()->pincode }}">
                                <span id="pincode_error" class="text-danger"></span>
                            </div>

                        </div>
                        <div class="row py-3 d-flex justify-content-center">
                            <hr>
                            <button type="submit" class="btn btn-success w-50">Update Profile</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </form>
</div>
@endsection
