@extends('layouts.front')

@section('title')
   Checkout
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('/') }}">
                Home
            </a>
             /
            <a href="{{ url('checkout') }}">
               Checkout
            </a>
        </h6>
    </div>
</div>
<div class="container mt-3">
    <form action="{{ url('place-order') }}" method="post">
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
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                    <h6> Order Details</h6>
                    <hr>
                    @if ($cartItems->count() > 0)
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td>Product</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach ($cartItems as $item)
                                <tr>
                                    <td>{{ $item->products->name }}</td>
                                    <td>{{ $item->prod_qty }}</td>
                                    <td>{{ $item->products->selling_price }}</td>
                                </tr>
                                @php $total += $item->products->selling_price * $item->prod_qty; @endphp
                                @endforeach
                            </tbody>
                        </table>
                       <h6 class="px-2">Grand Total <span class="float-end">{{ $total }}</span></h6>

                    <hr>
                    <button type="submit" class="btn btn-success w-100">Place Order | COD</button>
                    {{-- <button type="button" class="btn btn-primary w-100 mt-3 razorpay_btn">Pay With Razorpay</button> --}}
                    <div class="mt-3" id="paypal-button-container"></div>

                    @else
                    <div class="card-body text-center">d
                        <h2>No Products in Cart <i class="fa fa-shopping-cart"></i>  </h2>
                        <a href="{{ url('category') }}" class="btn btn-outline-primary w-100">Continue Shopping</a>

                    </div>

                    @endif

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@push('addScripts')
{{-- <script src="https://www.paypal.com/sdk/js?client-id=ASYOmh-gpF2-8pP7AtzswthVgrTBhmHialjCWUDCE68pOOyyu2d-mxggIcYxmLZyO6OED-6xkji6FhLv&currency=USD"></script> --}}

<script src="https://www.paypal.com/sdk/js?client-id=Ad2Uml8rpkOuEKsVpHxfq2IT1ojBV8W0tE-CjHgz1dURE2cEoXFZppap9qH34vj40TViKk7eurvX0DJI&currency=USD"></script>


<script>

    paypal.Buttons({


      // Sets up the transaction when a payment button is clicked
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '{{ $total }}' // Can reference variables or functions. Example: `value: document.getElementById('...').value`
            }
          }]
        });
      },


      // Finalize the transaction after payer approval
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
          // Successful capture! For dev/demo purposes:
              console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
              var transaction = orderData.purchase_units[0].payments.captures[0];
              alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

              var firstname = $('.firstname').val();
              var lastname = $('.lastname').val();
              var email = $('.email').val();
              var phone = $('.phone').val();
              var address1 = $('.address1').val();
              var address2 = $('.address2').val();
              var city = $('.city').val();
              var state = $('.state').val();
              var country = $('.country').val();
              var pincode = $('.pincode').val();

              var token   = $('meta[name="csrf-token"]').attr('content');
              
              $.ajax({
                  method:"POST",
                  url:'/place-order',
                  data:{
                      '_token':token,
                      'fname':firstname,
                      'lname':lastname,
                      'email':email,
                      'phone':phone,
                      'address1':address1,
                      'address2':address2,
                      'city':city,
                      'state':state,
                      'country':country,
                      'pincode':pincode,
                      'payment_mode':"Paid By Paypal",
                      'payment_id':orderData.id,
                  },
                  success:function(response){
                      console.log('iena ',response);
                      swal(response.status)
                      .then((value) => {
                        // window.location.href = "/my-orders";
                        });
                  }
              });
          // When ready to go live, remove the alert and show a success message within this page. For example:
          // var element = document.getElementById('paypal-button-container');
          // element.innerHTML = '';
          // element.innerHTML = '<h3>Thank you for your payment!</h3>';
          // Or go to another URL:  actions.redirect('thank_you.html');
        });
      }
    }).render('#paypal-button-container');
  </script>

@endpush
