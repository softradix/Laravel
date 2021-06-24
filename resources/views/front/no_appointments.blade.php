
@extends('layouts.appFront')
@section('breadcrumb_title')
   	My Appointments
@endsection
@section('content')

<section id="Appointments">
	<div class="container box-row mt-5">
		<div class="row">
				<h4 class="title-places Appointments pt-4 pl-4">Appointments</h4>
		</div>
    <div class="row">
				<img src="{{URL::asset('images/No_Appointments.png')}}" class="img-appooint ml-auto mr-auto">
		</div>
	</div>
</section>

@include('layouts.footer')

@endsection
