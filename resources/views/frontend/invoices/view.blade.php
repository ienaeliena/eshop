
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
                                $whatssAppMsg = "Enquiry Invoice : ".$invoice->invoice_no;
                                $whatsAppUrl = "https://wa.me/+60133431203?text=".$whatssAppMsg;
                            @endphp
                                <a href="{{ $whatsAppUrl }}" target="_blank" class="btn btn-success pull-right"><i class="fa-brands fa-whatsapp"></i> &nbsp; Contact Seller</a>

                            </div>
                    </div>
                </div>
            </div>


                        {{-- <div style="background-color: #FFF; border: 1px solid #CCC; margin:10px; margin-top: 20px; margin-bottom: 80px; padding: 20px; " id="paymentForm">
                <div class="row">

                    <div class="col-md-12">

                        <form method="POST" action="https://mrzai.kiah.store/155353/18qvidhm4x/payment" enctype="multipart/form-data" id="paymentFormID">
                        <input type="hidden" name="_token" value="TemKD2n0LGK5ZgufB4aOsh6xCZplJGqkiG7DuUBU">
                        <h3>Pembayaran</h3>

                        Pilih Jenis Pembayaran &nbsp;
                        <select id="paymentmethod">
                                                        <option value="4">SecurePay (FPX)</option>
                                                                                    <option value="3">ToyyibPay (FPX)</option>
                                                                                    <option value="1">Manual / Online Transfer</option>
                                                                                    <option value="2">Cash on Delivery (COD)</option>
                                                    </select>

                        <hr>

                                                <div class="resources resources1" style="display: none;">

                                                        <div style="margin-bottom: 10px;">
                                <span style="font-size: 16px; color: #33c45a;"><strong>Sila buat pembayaran ke salah satu akaun berikut:</strong></span>
                            </div>

                            <div class="row">
                                                                <div class="col-xs-6">
                                    <div style="background-color: #e8faed; padding: 5px;">
                                        <span style="color: #336699;">Bank Rakyat</span><br>
                                        <span style="font-size: 16px;"><strong>21312111123</strong></span><br>
                                        <small><i>laina ahmad</i></small>
                                    </div>
                                </div>
                                                                <div class="col-xs-6">
                                    <div style="background-color: #e8faed; padding: 5px;">
                                        <span style="color: #336699;">Al Rajhi Bank</span><br>
                                        <span style="font-size: 16px;"><strong>2131 12312312</strong></span><br>
                                        <small><i>rehat shaja</i></small>
                                    </div>
                                </div>
                                                            </div>

                            <br><br>
                            <span style="font-size: 16px;"><strong>Masukkan maklumat jika pembayaran telah dibuat</strong></span><br>

                            <table class="table table-condensed">
                                <tr>
                                    <td>
                                        Bank
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm" name="proof_bank">
                                                                                            <option >Bank Rakyat</option>
                                                                                            <option >Al Rajhi Bank</option>
                                                                                    </select>
                                                                            </td>
                                </tr>
                                <tr>
                                    <td>
                                        Jumlah (RM)
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" name="proof_amount" placeholder="0.00" value="">
                                                                            </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tarikh
                                    </td>
                                    <td>
                                        <input type="date" class="form-control form-control-sm" name="proof_date" placeholder="" style="line-height: 1.4;" value="">
                                                                            </td>
                                </tr>
                                <tr>
                                    <td>
                                        Masa
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" name="proof_time" placeholder="hh:mm:ss" value="">
                                                                            </td>
                                </tr>
                                <tr>
                                    <td>
                                        #Referrence
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" name="proof_ref" placeholder="" value="">
                                                                            </td>
                                </tr>
                                <tr>
                                    <td>
                                        Bukti/Slip
                                    </td>
                                    <td>
                                        <input type="file" class="form-control form-control-sm" name="proof">
                                                                            </td>
                                </tr>
                            </table>
                            <button onclick="fbq('track', 'AddPaymentInfo');" class="btn btn-primary pull-right" name="paymentmods_btn" value="1"><i class="fa fa-save"></i> &nbsp; Hantar</button>


                        </div>

                                                <div class="resources resources2" style="display: none;">
                            <br>
                            <div style="margin-bottom: 10px; background-color: #e3f6ff; padding: 5px;">
                                <span style="font-size: 16px;"><strong>Cash On Delivery (COD)</strong></span><br>
                                <span>Bayaran akan dibuat semasa penghantaran. Sila klik butang untuk memilih pembayaran secara COD.</span>
                            </div>
                            <button onclick="fbq('track', 'AddPaymentInfo');" class="btn btn-primary pull-right" name="paymentmods_btn" value="2"><i class="fa fa-check"></i> &nbsp; Saya mahu COD &nbsp; </button>
                            <br><br><br><br>
                        </div>

                                                <div class="resources resources3" style="display: none;">

                            <br>
                            <img src="https://mrzai.kiah.store/images/toyyibpay.jpg" style="width: 100%;">

                            <br><br><br>

                            <span style="font-size: 16px; line-height: 16px;"><strong>Toyyibpay</strong></span><br>
                            Gerbang pembayaran melalui FPX dan Kad Kredit. Klik butang "Bayar Sekarang" untuk teruskan dengan pembayaran.<br><br>

                            <button onclick="fbq('track', 'AddPaymentInfo');" class="btn btn-primary" name="paymentmods_btn" value="3"><i class="fa fa-check"></i> &nbsp; Bayar Sekarang &nbsp; </button>
                            <br><br><br><br>

                        </div>

                                                <div class="resources resources4" style="display: none;">

                            <br>
                            <img src="https://mrzai.kiah.store/images/securepay.jpg" style="width: 100%;">

                            <br><br><br>

                            <span style="font-size: 16px; line-height: 16px;"><strong>SecurePay</strong></span><br>
                            Gerbang pembayaran melalui FPX. Klik butang "Bayar Sekarang" untuk teruskan dengan pembayaran.<br><br>

                            <button onclick="fbq('track', 'AddPaymentInfo');" class="btn btn-primary" name="paymentmods_btn" value="4"><i class="fa fa-check"></i> &nbsp; Bayar Sekarang &nbsp; </button>
                            <br><br><br><br>

                        </div>

                        </form>

                    </div>

                </div>

            </div> --}}


            <div style="text-align: center;">
                Generated by <a href="{{ url('/') }}" target="_blank">{{ $url }}</a>
                <br><br><br>
            </div>

        </div>
        <!-- end wrapper page -->


    </body>
</html>
