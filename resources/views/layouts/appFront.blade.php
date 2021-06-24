<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta name="google-site-verification" content="k7bI21FzmCewSnfMmQHBQfI4NHOTP0kCYi6LAevL62k" />
    <title>Shellpar</title>
    <link rel="icon" href="{{URL::asset('images/favicon.png')}}" type="image/gif" sizes="16x16">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
    <!-- Carousel Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/customWebStyles.css')}}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert CSS -->
    <link rel=”stylesheet” href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css'>

    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&key=<?php echo env('GOOGLE_MAPS_KEY'); ?>"&sensor=false&callback=initializeMap&libraries=places"></script>


</head>

<body>
    @section('breadcrumb')
    @yield('breadcrumb_title')
    @endsection
    @if(Request::path() === '/')
    @include('layouts.header_home')
    @else
    @include('layouts.header_rest')
    @endif
    @yield('content')
    <div class="overlay-loader" id="loaderDiv">
        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
              toastr.options.preventDuplicates = true;
              toastr.options.progressBar = true;
              toastr.options.newestOnTop = true;
        });
        @if (Session:: has('success'))
            toastr.success('', "{{Session::get('success')}}", {displayDuration: 2000, timeOut: 2000, position: 'top-right'});
        @endif
        @if (Session:: has('error'))
            toastr.error('', "{{Session::get('error')}}", {displayDuration: 2000, timeOut: 2000, position: 'top-right'});
        @endif
    </script>
</body>

</html>