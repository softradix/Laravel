<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('assets/images/favicon.ico') }}">
    <title>Shifting Shelter - Super Admin</title>
    <!-- Font-Awesome-Icons -->
    <link href="{{ URL::asset('dist/css/icons/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css' rel="stylesheet"/>
    <link rel="stylesheet" href="{{URL::asset('css/customWebStyles.css')}}">
    <!-- Sweet Alert CSS -->
    <link rel=”stylesheet” href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css'>
    <!-- Custom CSS -->
    <link href="{{ URL::asset('dist/css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('css/lightbox.min.css')}}">
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        @yield('content')
    </div>
</body>
</html>