@extends('layouts.appFront')
@section('breadcrumb_title')
Favourites
@endsection
@section('content')
<style>
  .box-row {
		padding-bottom: 20px;
	}
	.my-properties-title{
		font-size:20px;
	}
</style>
<section id="My-Property">
  <div class="container box-row mt-5">
    <div class="col-lg-12">
      <p class="font-weight-bold pt-5 my-properties-title">Favourites</p>
    </div>
    <div class="row mt-4">
      @if(count($favourites) > 0)
      @foreach($favourites as $favourite)
      <div class="col-lg-4 col-md-6 col-12 mt-4">
        <div class="card">
          <div class="list_tile" data-id="{{$favourite->shelter_id}}">
            <div class="card-head list_tile" id="bx-ht">
            @if(file_exists(public_path('/uploads/').$favourite->img) && $favourite->img!='')
            <img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads')}}/{{$favourite->img ? $favourite->img : 'default-shelter.png'}}"
              draggable="false" height="220px">
            @else
            <img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads/default-shelter.png')}}" draggable="false" height="220px">
            @endif
            </div>
          </div>
          <div class="card-body pl-0 pr-0">
            <span class=" pb-3 font-weight-bold">
              <p class="addres mt-3 pb-0 font-weight-bold">
                <span>{{$favourite->flat_type}} BHK </span><span class="pl-3">{{$favourite->street}}
                  {{$favourite->locality}} {{$favourite->city}}</span>
              </p>
              <p>
                <span class="blue-title font-weight-bold">&#x20B9; {{$favourite->expected_rent}} / MONTH</span>
              </p>
              <button class="btn delete-more-btn white-color px-4 favUnfav" type="button" data-shelter="{{$favourite->shelter_id}}"
                data-user="{{Auth::user()->id}}" data-status="1">Remove</button>
          </div>
        </div>
      </div>
      @endforeach
      @else
        <img src="{{URL::asset('images/no_properties.jpg')}}" class="img-appooint ml-auto mr-auto">
      
      @endif
      <div class="col-lg-12">
        <div class="col-12 mx-auto" style="margin-bottom: 20px;">
          <div></div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 pb-5">
      <div class="col-12 mx-auto" style="margin-bottom: 20px;">
        <div>{{ $favourites->links() }}</div>
      </div>
    </div>
  </div>
</section>@include('layouts.footer') @endsection