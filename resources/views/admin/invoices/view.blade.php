
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistem Pengkalan Data dan Borang Whatsapp">
        <meta name="author" content="Azbahri">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/invoice-icon.ico') }}">

        <!-- App title -->
        @php
            $url = url('/');
            $url = str_replace('http://', '', $url);
        @endphp
        <title>{{ $invoice->invoice_no }} - {{ $url }}</title>


        <!-- App CSS -->
        <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


        <style type="text/css">
            .account-pages {
                background: #EEE !important;
            }
        </style>



    </head>


    <body>


        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page" style="margin:0px auto;">

            <div class="hidden-mobile" style="height: 30px;"></div>

        	<div style="background-color: #FFF; border: 1px solid #CCC; margin:10px; padding: 20px;">
                <div class="row">
                    <div class="col-md-12">
                                            </div>
                    <div class="col-md-5">
                        <div style="">
                            <h1>Invoice</h1>
                        </div>
                    </div>
                    <div class="col-md-7" style="font-size: 12px;">
                        <table border="1" cellspacing="0" cellpadding="5" width="100%">
                            <tr>
                                <td style="padding: 2px;">Invoice No.</td>
                                <td style="padding: 2px;"><strong>{{ $invoice->invoice_no }}</strong></td>
                            </tr>
                            <tr>
                                <td style="padding: 2px;">Date</td>
                                <td style="padding: 2px;"><strong>{{ $invoice->created_at }}</strong></td>
                            </tr>
                            <tr>
                                <td style="padding: 2px;">Order Status</td>
                                <td style="padding: 2px;">
                                    @php
                                       if($invoice->orders->order_status == 0)
                                       {
                                           $statusPesanan = 'BARU';
                                       }
                                       elseif($invoice->orders->order_status == 1)
                                       {
                                           $statusPesanan = 'PROCESSING';
                                       }
                                       elseif($invoice->orders->order_status == 2)
                                       {
                                           $statusPesanan = 'SHIPPED';
                                       }
                                       elseif($invoice->orders->order_status == 3)
                                       {
                                           $statusPesanan = 'DELIVERED';
                                       }
                                    @endphp
                                    <span class="text-{{ $invoice->orders->order_status == 0 ? 'danger':'default' }}" style="font-weight: bold;">{{ $statusPesanan }}</span>
                                    </td>
                            </tr>
                            <tr>
                                <td style="padding: 2px;">Payment Method</td>
                                <td style="padding: 2px;">
                                    <span class="text-default" style="font-weight: bold;">{{ $invoice->orders->payment_mode }}</span>
                                 </td>
                            </tr>
                            <tr>
                                @php
                                    if($invoice->orders->payment_mode == "COD"){
                                        if($invoice->orders->payment_status == 0){
                                            $paymentStatus = "Pending - COD";

                                        }elseif($invoice->orders->payment_status == 1){
                                            $paymentStatus = "Paid - COD";
                                        }
                                    }else{
                                        if($invoice->orders->payment_status == 0){
                                            $paymentStatus = "Pending";
                                        }elseif($invoice->orders->payment_status == 1){
                                            $paymentStatus = "Paid";
                                        }
                                    }
                                @endphp

                                <td style="padding: 2px;">Payment Status</td>
                                <td style="padding: 2px;">
                                <span class="text-default" style="font-weight: bold;">{{ $paymentStatus }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br>
                <div class="row">

                    <div class="col-md-12" style="font-size: 11px;">

                        <span style="font-size: 14px;"><b>Invoice To: </b></span>
                        <table width="100%">
                            <tr>
                                <td valign="top" style="width: 50px;">Name: </td>
                                <td><b>{{ $invoice->orders->fname }}</b></td>
                            </tr>
                            <tr>
                                <td valign="top">Phone: </td>
                                <td>{{ $invoice->orders->phone }}</td>
                            </tr>
                                                        <tr>
                                <td valign="top">Email: </td>
                                <td>{{ $invoice->orders->email }}</td>
                            </tr>
                                                                                    <tr>
                                <td valign="top">Address: </td>
                                <td>
                                    {{ $invoice->orders->address1 }},<br>
                                    {{ $invoice->orders->address2 }}, <br>
                                    {{ $invoice->orders->pincode }} {{ $invoice->orders->city }} <br>
                                    {{ $invoice->orders->state }}, {{ $invoice->orders->country }}

                                </td>
                            </tr>

                        </table>

                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <table border="1" cellspacing="0" cellpadding="5" width="100%">
                            <tr style="background-color: #EEE;">
                                <td valign="top" style="text-align: center; padding: 5px;"><b>No</b></td>
                                <td valign="top" style=" padding: 5px;"><b>Perkara</b></td>
                                <td valign="top" style="text-align: right; padding: 5px;"><b>Quantity</b></td>
                                <td valign="top" style="text-align: right; padding: 5px;"><b>Total<br>(RM)</b></td>
                            </tr>
                            @php
                                $totalPrice = 0;
                            @endphp
                            @foreach ($invoice->orderItems as $item)
                            @php
                                $totalPrice = $totalPrice + ($item->price * $item->qty);
                            @endphp
                            <tr>
                                <td valign="top" align="center" style=" padding: 5px;">1</td>
                                <td valign="top" style=" padding: 5px;">
                                    <b>
                                    {{ $item->products->name }}
                                    </b>
                                    <div style="font-size: 12px; font-weight: bold; color: red;">RM {{ $item->products->selling_price }}</div>
                                                                    </td>
                                <td style="text-align: right; padding: 5px;" valign="top">
                                    <b>{{ $item->qty }}</b>
                                </td>
                                <td style="text-align: right; padding: 5px;" valign="top">
                                    <b>{{ $item->qty * $item->price }}</b>
                                </td>
                            </tr>
                            @endforeach

                            <tr>
                                <td colspan="3" style="text-align: right; padding: 5px;"><b>Delivery Charge: </b>
                                <br> (Quantity)                                                                 </td>
                                <td style="text-align: right; padding: 5px;"><b>-</b></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: right; padding: 5px;"><b>Total: </b></td>
                                <td style="text-align: right; padding: 5px;"><b>{{ $totalPrice }}</b></td>
                            </tr>

                        </table>
                        <div style="padding-top: 20px;">
                            @php
                                $msisdn = $invoice->orders->phone;
                                $whatssAppMsg = "Enquiry Invoice : ".$invoice->invoice_no;
                                $whatsAppUrl = "https://wa.me/+6".$msisdn."?text=".$whatssAppMsg;
                            @endphp
                                <a href="{{ $whatsAppUrl }}" target="_blank" class="btn btn-success pull-right"><i class="fa-brands fa-whatsapp"></i> &nbsp; Contact Buyyer</a>

                            </div>
                    </div>
                </div>
            </div>





            <div style="text-align: center;">
                Generated by <a href="{{ url('/') }}" target="_blank">{{ $url }}</a>
                <br><br><br>
            </div>

        </div>
        <!-- end wrapper page -->


    </body>
</html>
