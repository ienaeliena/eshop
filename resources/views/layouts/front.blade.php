<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>
      @yield('title')
  </title>

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


  <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/css/bootstrap5.css') }}" rel="stylesheet">

  <!--     Own Carousel     -->
  <link href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/css/owl.theme.default.min.css') }}" rel="stylesheet">

  <!--     Google Font     -->
  <link rel="preconnect" href="https://fonts.gstatic.com" >
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

  <!--     Font Awesome      -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">

 <style>
      a{
          text-decoration: none !important;
      }
      img.card {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 200px;
            height:200px;
      }
      img.card:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
      }


  </style>
</head>
<body>
    @include('layouts.inc.frontnavbar')
    <div class="content">
    @yield('content')
    </div>
    <div class="footer">
        @include('layouts.inc.front_footer')
    </div>

    <div class="whatsapp-chat">
        @php
            $url = url('/');
            $url = str_replace('http://', '', $url);
            $whatssAppMsg = "Enquiry  : ".$url;
            $whatsAppUrl = "https://wa.me/+60133431203?text=".$whatssAppMsg;
        @endphp
        <a href="{{ $whatsAppUrl }}" target="_blank">
            <img src="{{ asset('assets/images/whatsapp-icon.png') }}" alt="whatsapp icon" width="80px" height="80px">
        </a>
    </div>

<!-- Scripts -->

  <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}" ></script>
  <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" ></script>
  <script src="{{ asset('frontend/js/owl.carousel.min.js') }}" ></script>
  <script src="{{ asset('frontend/js/custom.js') }}" ></script>
  <script src="{{ asset('frontend/js/checkout.js') }}" ></script>
  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/62318cf61ffac05b1d7ed1b2/1fu8ot9fq';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
  </script>
        <!--End of Tawk.to Script-->



  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script>

      var availableTags = [];
      $.ajax({
          method: 'GET',
          url: '/product-list',
          success: function(response) {
            //   console.log(response);
              startAutocomplete(response);
          }
      });


      function startAutocomplete(availableTags) {
        $( "#search_product" ).autocomplete({
        source: availableTags
        });
      }

    </script>



  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @if (session('status'))
   <script>
       swal("{{ session('status') }}");
   </script>

  @endif

  @stack('addScripts')
</body>
</html>
