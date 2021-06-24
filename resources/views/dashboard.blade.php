@extends('layouts.dashboard_app')
@section('content')
@include('header')
@include('sidebar')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Painel de Controle</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                @include('flash-message')
            </div>
        </div>
        <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-cyan text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                        <a href="{{ url('/dashboard') }}"><h6 class="text-white">Painel de Controle</h6></a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                        <a href="{{ url('/company-list') }}"><h6 class="text-white">Empresas</h6></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footer_dash')
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert-success").alert('close');
        }, 2000);
    });
</script>
@endsection
