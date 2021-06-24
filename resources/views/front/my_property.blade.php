@extends('layouts.appFront')
@section('breadcrumb_title')
My Shelter 
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
       		<p class="font-weight-bold pt-5 my-properties-title">My Shelters</p>
      	</div>
		<div class="row mt-4">
			@if(count($myshelters)>0)			
				@foreach($myshelters as $shelter)
				<div class="col-lg-4 col-md-6 col-sm-12 mt-4 align-items-center">
					<div class="card">
						@if(isset($shelter->img))
						<div class="card-head list_tile" id="bx-ht" data-id="{{$shelter->id}}">
							@if(file_exists(public_path('/uploads/').$shelter->img) && $shelter->img!='')
							<img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads')}}/{{$shelter->img ? $shelter->img : 'default-shelter.png'}}"
								draggable="false" height="220px">
							@else
							<img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads/default-shelter.png')}}" draggable="false" height="220px">
							@endif
						</div>
						@else
						<div class="card-head list_tile" id="bx-ht" data-id="{{$shelter->id}}">
							<img id="bx-ht-hght" src="{{URL::asset('uploads/default-shelter.png')}}" draggable="false" height="220px" class="list_tile" data-id="{{$shelter->id}}" >
						</div>
						@endif						
						<div class="card-body pl-0 pr-0">
							@if($shelter->property_type == 'House/Flat')
								<span class="green-title pb-3 font-weight-bold">
									@if($shelter->is_verified == '1')
										<img src="{{URL::asset('images/verified_icon.png')}}" alt="Logo" class="shield-img pr-2" draggable="false">
										Verified
										<span class="dot pl-2 pr-2">&bull;</span>
									@endif
									{{$shelter->flat_type}} BHK
									<span class="dot pl-2 pr-2">.</span>{{$shelter->property_feature == 1 ? 'Independent Floor' : ($shelter->property_feature == 2 ? 'Appartment' :($shelter->property_feature == 3 ? 'Independent Villa' : ($shelter->property_feature == 4 ? $shelter->other_property_feature : '')))}}
									@if($shelter->flat_size != NULL)
										<span class="dot pl-2 pr-2">&bull;</span>{{$shelter->flat_size}} Sq.ft
									@endif
								</span>
								<p class="addres mt-3 pb-0 font-weight-bold">
									<span>{{$shelter->flat_type}} BHK </span>
									<span>{{$shelter->street}} {{$shelter->locality}}, {{$shelter->city}}</span>
								</p>
								<p>
									<span class="blue-title font-weight-bold">&#x20B9; {{$shelter->expected_rent}} / MONTH</span>
								</p>
							@else
							<span class="green-title pb-3 font-weight-bold">
								@if($shelter->is_verified == '1')
									<img src="{{URL::asset('images/verified_icon.png')}}" alt="Logo" class="shield-img pr-2" draggable="false">
									Verified
									<span class="dot pl-2 pr-2">&bull;</span>
								@endif
								{{$shelter->sharing_type}} BED <span class="dot pl-2 pr-2">.</span><span>PG/Room </span>
								@if($shelter->flat_size != NULL)
									<span class="dot pl-2 pr-2">&bull;</span>{{$shelter->flat_size}} Sq.ft
								@endif
							</span>
							<p class="addres mt-3 pb-0 font-weight-bold">
								<span>{{$shelter->sharing_type}} BED </span>
								<span>{{$shelter->street}} {{$shelter->locality}}, {{$shelter->city}}</span>
							</p>
							<p>
								<span class="blue-title font-weight-bold">&#x20B9; {{$shelter->expected_rent}} / MONTH</span>
							</p>
							@endif
							<button data-shelter="{{$shelter->id}}" data-user="{{Auth::user()->id}}" class="btn edit-more-btn white-color px-4 editProperty" type="button">Edit</button>
							<button class="btn edit-more-btn white-color px-1 ml-4 publishUnpublish" data-shelter="{{$shelter->id}}" data-publish="{{$shelter->publish}}" data-user="{{Auth::user()->id}}" type="button">{{$shelter->publish == 0 ? 'Publish' : 'Unpublish'}}</button>
							<button class="btn delete-more-btn white-color px-4 ml-4 deletemyproperty" data-shelter="{{$shelter->id}}" data-user="{{Auth::user()->id}}"  type="button">Delete</button>
						</div>
					</div>
				</div>				
				@endforeach				
			@else
				<img src="{{URL::asset('images/no_properties.jpg')}}" class="img-appooint ml-auto mr-auto">
			@endif
		</div>
		<div class="col-lg-12 pb-5">
			<div class="col-12 mx-auto" style="margin-bottom: 20px;">
				<div>{{ $myshelters->links() }}</div>
			</div>
		</div>
	</div>
</section>@include('layouts.footer') @endsection