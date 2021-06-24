@extends('layouts.appFront')
@section('breadcrumb_title')
Shelter Details
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
 integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
 integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
<style type="text/css">
	/*.owl-nav {
		display: none;
	}*/
	.owl-nav button span {
		font-size: 60px;
		position: absolute;
		left: 11px;
		z-index: 99;
		top: 38%;
		color: #fff;
	}

	.owl-nav button:nth-last-child(1) span {
		font-size: 60px;
		position: absolute;
		right: 11px;
		z-index: 99;
		top: 38%;
		color: #fff;
		text-align: right;
	}

	.owl-dots{
		display : none;
	}

	.card-body{
		padding: 0.25rem;
	}
	.owl-nav button:nth-last-child(1) span {	    
	    color: #545454;	    
	}
	.owl-nav button span {
		color: #545454;
	}
</style>
<section id="listing-detail">
	<div class="container px-md-0 mt-5">
		<div class="row">
			<button class="btn btn-primary demo-2 d-none">Execute copy command on button's text</button>
			<div class="col-lg-8 image-col">
				@php $shltrid=$shelter->id; @endphp
				@auth
				@if(Auth::user()->id != $shelter->user_id)
				@if($is_fav == 1)
				<a class="heart-icon favUnfav" data-shelter="{{$shelter->id}}" data-user="{{Auth::user()->id}}" data-status="{{$is_fav}}"
				 style="z-index:9;">
					<span class="heart-cl"><i class="fas fa-heart fav"></i></span>
				</a>
				@else
				<a class="heart-icon favUnfav" data-shelter="{{$shelter->id}}" data-user="{{Auth::user()->id}}" data-status="{{$is_fav}}"
				 style="z-index:9;">
					<span class="heart-cl"><i class="fas fa-heart h-hover"></i></span>
				</a>
				@endif
				<a class="upload-icon reportShelter" data-toggle="modal" data-target="#reportShelter" style="z-index:9;">
					<span class="upload-cl">

						@if(isset($is_reported) && $is_reported == 1)
						<!--i class="fa fa-flag" aria-hidden="true" data-toggle="tooltip" title="Already Reported"></i-->
						<i class="fas fa-exclamation-triangle" aria-hidden="true" data-toggle="tooltip" title="Already Reported"></i>
						@else
						<!-- <i class="fa fa-flag-checkered" aria-hidden="true" data-toggle="tooltip" title="Report Shelter"></i> -->
						<i class="fas fa-exclamation-triangle" aria-hidden="true" data-toggle="tooltip" title="Report Shelter"></i>
						@endif
					</span>
				</a>
				<a class="share-icon share" data-shelter="" onclick="copylink('{{$shelter->id}}')" aria-hidden="true" data-toggle="tooltip" title="Copy link to share"
				 style="z-index:9;">
					<span class="heart-cl"><i class="fa fa-share-alt"></i></span>
				</a>
				@endif
				@endauth

				@if($shelter->images)
				<div class="owl-carousel">
					@php $order = 0;$fet=0; @endphp
					@foreach($shelter->images as $image)
					@if($fet == '0')
					<a data-fancybox="gallery" href="{{URL::asset('uploads')}}/{{$shelter->featuredimage}}">
						<div class="card-head fancy-box-image" id="bx-ht">
							@if(file_exists(public_path('/uploads/').$shelter->featuredimage) && $shelter->featuredimage!=NULL)
							<img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads')}}/{{$shelter->featuredimage ? $shelter->featuredimage : 'default-shelter.png'}}" draggable="false" height="220px" style="pointer-events: none;">
							@else
							<img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads/default-shelter.png')}}" draggable="false" height="220px"  style="pointer-events: none;">
							@endif
							<!-- <img id="bx-ht-hght" src="{{URL::asset('uploads')}}/{{$image}}" class="img-fluid" draggable="false" style="pointer-events: none;"> -->
						</div>
					</a>
					@endif					
					<a data-fancybox="gallery" href="{{URL::asset('uploads')}}/{{$image}}">
						<div class="card-head fancy-box-image" id="bx-ht">
							@if(file_exists(public_path('/uploads/').$image) && $image!='')
							<img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads')}}/{{$image ? $image : 'default-shelter.png'}}" draggable="false" height="220px" style="pointer-events: none;">
							@else
							<img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads/default-shelter.png')}}" draggable="false" height="220px"  style="pointer-events: none;">
							@endif
							<!-- <img id="bx-ht-hght" src="{{URL::asset('uploads')}}/{{$image}}" class="img-fluid" draggable="false" style="pointer-events: none;"> -->
						</div>
					</a>
					@php $fet++; @endphp
					@endforeach
				</div>
				@endif
			</div>
			<div class="col-lg-4">
				@if($shelter->property_type == 'House/Flat')
				<div class="card-body pl-0 pr-0">
					@if($shelter->is_verified == '1')
						<span class="pb-3 font-weight-bold {{$shelter->approved == 1 ? 'green-title' : ''}}">
		            	<img src="{{URL::asset('images/verified_icon.png')}}" alt="Logo" class="shield-img pr-2" draggable="false">
		            	VERIFIED
		            	<span class="dot pl-2 pr-2">•</span>
	            	@endif
	            	{{$shelter->flat_type}} BHK
	            	
	            	<span class="dot pl-2 pr-2">.</span>{{$shelter->property_feature == 5 ? 'Independent Room' : ($shelter->property_feature == 1 ? 'Independent Floor' : ($shelter->property_feature == 2 ? 'Appartment' :
					($shelter->property_feature == 3 ? 'Independent Villa' : ($shelter->property_feature == 4 ? $shelter->other_property_feature : ''))))}}
					@if($shelter->flat_size != '' && $shelter->flat_size != NULL)
					<span class="dot pl-2 pr-2">.</span>{{$shelter->flat_size}} Sq.ft
					@endif
					<p class="addres mt-3 pb-0 font-weight-bold text-dark">
						<span>{{$shelter->flat_type}} BHK, </span>
						<span>{{$shelter->property_feature == 5 ? 'Independent Room' : ($shelter->property_feature == 1 ? 'Independent Floor' : ($shelter->property_feature == 2 ? 'Appartment' : ($shelter->property_feature == 3 ? 'Independent Villa' : ($shelter->property_feature == 4 ? $shelter->other_property_feature : ''))))}}</span>
						<span class="pl-3">{{$shelter->locality}}, {{$shelter->city}}</span>
					</p>
					<p>
						<span class="blue-title font-weight-bold">&#x20B9;{{$shelter->expected_rent}} / MONTH</span>
						<span class="avil-cl pl-5">
							@if($shelter->security_deposit != '' && $shelter->security_deposit != NULL)
							<small>&#x20B9; {{$shelter->security_deposit == NULL ? '-' : ($shelter->security_deposit)}}/Security Deposit</small>
							@endif
						</span>
					</p>
				</div>	
				@else
				<div class="card-body pl-0 pr-0">
					@if($shelter->is_verified == '1')
						<span class="pb-3 font-weight-bold {{$shelter->approved == 1 ? 'green-title' : ''}}">
		            	<img src="{{URL::asset('images/verified_icon.png')}}" alt="Logo" class="shield-img pr-2" draggable="false">
		            	VERIFIED
		            	<span class="dot pl-2 pr-2">•</span>
	            	@endif
	            	{{$shelter->sharing_type}} BED
	            	<span class="dot pl-2 pr-2">.</span><span>PG/Room </span>
                    @if($shelter['flat_size'] != NULL)
                    <span class="dot pl-2 pr-2">&bull;</span>{{$shelter['flat_size']}} Sq.ft
                    @endif				
					
					<p class="addres mt-3 pb-0 font-weight-bold text-dark">
						<span>{{$shelter->sharing_type}} BED, </span>
						<span>PG/Room </span>
						<span class="pl-3">{{$shelter->locality}}, {{$shelter->city}}</span>
					</p>
					<p>
						<span class="blue-title font-weight-bold">&#x20B9;{{$shelter->expected_rent}} / MONTH</span>
						@if($shelter->security_deposit != '' && $shelter->security_deposit != NULL)
						<span class="avil-cl pl-5"> <small> {{$shelter->security_deposit == NULL ? '-' : ($shelter->security_deposit)}}/Security Deposit</small></span>
						@endif
					</p>
				</div>
				@endif<div class="user-namte-col mt-3">
					<span class="pt-2 font-weight-bold">{{$shelter->uname}}
					<!--p class="addres mt-2 pb-0 ">
						<span class=""><img src="{{URL::asset('images/arrow.png')}}" alt="Logo" class="shield-img pr-2" draggable="false"
							 height="13px">
							32 <span class="dot">&bull;</span> Landlord</span>
					</p-->
				</div>
				<div class="avili-text mt-3">
					<p class="font-weight-bold mb-1 pt-2">Availabile From</p>
					<p class="addres mt-3 pb-0 ">
						<span>{{date('M d, Y',strtotime($shelter->available_date))}}</span>
					</p>
					<!-- <p class="addres mt-2 pb-0 ">
						Minimum stay 12 months
					</p>
					<p class="mb-1"></p>
					<p></p> -->
				</div>
				<div class="back_button mt-3 pt-2 float-left">
					@auth
					@if(Auth::user()->name === NULL)
					<input id="isupdate" type="hidden" value="0" />
					@else
					<input id="isupdate" type="hidden" value="1" />
					@endif
					<p class="text-right"><a class='btn top-listing-btn' style="color:#fff;" onclick="toshowtoggle()">Contact Owner</a></p>
					@endauth
					@guest
					<p class="text-right"><a class='btn white-color top-listing-btn detaiListing' style="color:#fff;">Contact Owner</a></p>
					@endauth
				</div>
			</div>
		</div>
	</div>
</section>
<section id="looking-for">
	<div class="container">
		<div class="row">
			@if($shelter->looking_for != '' && $shelter->looking_for != NULL)
			<div class="col-lg-4 col-6 mt-3">
				<h5 class=" font-weight-bold">Looking for</h5>
				<p>{{$shelter->looking_for == 1 ? 'Male' : ($shelter->looking_for == 2 ? 'Female' :
					($shelter->looking_for == 3 ? 'Family' : "Not Specified"))}}</p>
				<!-- <p>Minimum stay 12 months</p> -->
			</div>
			@endif	
			@if($shelter->property_type == 'House/Flat' || $shelter->property_type == 'Pg/Room')
				@if($shelter->looking_for != '3')
				<div class="col-lg-4 col-6 mt-3">
					<h5 class=" font-weight-bold">Preferred Guest</h5>
					<p>{{$shelter->guest_preferred == 1 ? 'Student' : ($shelter->guest_preferred == 2 ? 'Professional' :
					($shelter->guest_preferred == 3 ? 'Student and Professional' : "-"))}}</p>	
				</div>
				@endif
			@endif	
			@if($shelter->building_age != '' && $shelter->building_age != NULL)
			<div class="col-lg-4 col-6 mt-3">
				<h5 class=" font-weight-bold">Age Of Building</h5>				
				<p>{{$shelter->building_age == '0' ? 'Below 1 year' : ($shelter->building_age)}}</p>
				<!-- <p>Minimum stay 12 months</p> -->
			</div>
			@endif
			@if($shelter->no_of_floor != '' && $shelter->no_of_floor != NULL)
			<div class="col-lg-4 col-6 mt-3">
				<h5 class=" font-weight-bold">Floor Number</h5>
				<p>{{$shelter->no_of_floor == NULL ? '-' : ($shelter->no_of_floor)}}</p>				
			</div>
			@endif
			@if($shelter->property_type == 'Pg/Room')
				<div class="col-lg-4 col-6 mt-3">
					<h5 class=" font-weight-bold">Food</h5>
					<p>{{$shelter->food == 1 ? 'With Food' : ($shelter->food == 0 ? 'Without Food' :
						($shelter->food == NULL ? '-' : "-"))}}</p>
				</div>
			@endif
			@if($shelter->property_type != 'Pg/Room')
				<div class="col-lg-4 col-6 mt-3">
					<h5 class=" font-weight-bold">Furniture</h5>
					<p>{{$shelter->furniture == 1 ? 'Furnished' : ($shelter->furniture == 3 ? 'Semi-Furnished' :
						($shelter->furniture == 2 ? 'Non-Furnished' : "-"))}}</p>
				</div>
			@endif
			@if($shelter->property_type != 'Pg/Room')
				@if($shelter->no_of_washroom != '' && $shelter->no_of_washroom != NULL)
					<div class="col-lg-4 col-6 mt-3">
						<h5 class=" font-weight-bold">Wash Room</h5>
						<p>{{$shelter->no_of_washroom == NULL ? '-' : ($shelter->no_of_washroom)}}</p>	
					</div>
				@endif
			@endif
			@if($shelter->property_type != 'Pg/Room')
				@if($shelter->member_allowed != '' && $shelter->member_allowed != NULL)
				<div class="col-lg-4 col-6 mt-3">
					<h5 class=" font-weight-bold">Members Allowed</h5>
					<p>{{$shelter->member_allowed == NULL ? '-' : ($shelter->member_allowed)}}</p>	
				</div>
				@endif
			@endif			
		</div>
		<div class="row">
			<div class="col-lg-12 mt-3">
				@if(isset($shelter->description))
				<h5 class="font-weight-bold">Description</h5>
				<p>{{$shelter->description}}</p>
				@endif
				<h5 class="font-weight-bold mt-3">Shelter ID : {{$shelter->id}}</h5>
			</div>
		</div>
		<hr>
	</div>
</section>
@if(isset($shelter->amenities))
<section id="Amenities">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 mt-3">
				<h5 class=" font-weight-bold">Amenities</h5>
			</div>
		</div>
		<div class="row icon-with-text">
			@if(isset($shelter->amenities))
			@if(in_array('1',$shelter->amenities))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="amenities-icons"><img src="{{URL::asset('images/icon/icon-black/cupboard.png')}}" draggable="false"></span><span
				 class="pl-3">Cupboard</span>
			</div>
			@endif
			@if(in_array('2',$shelter->amenities))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="amenities-icons"><img src="{{URL::asset('images/icon/icon-black/lift.png')}}" draggable="false"></span><span
				 class="pl-3">Lift</span>
			</div>
			@endif
			@if(in_array('3',$shelter->amenities))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="amenities-icons"><img src="{{URL::asset('images/icon/icon-black/bath.png')}}" draggable="false"></span><span
				 class="pl-3">Attach
					Bathroom</span>
			</div>
			@endif
			@if(in_array('4',$shelter->amenities))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="amenities-icons"><img src="{{URL::asset('images/icon/icon-black/geyser.png')}}" draggable="false"></span><span
				 class="pl-3">Geyser</span>
			</div>
			@endif

			@if(in_array('5',$shelter->amenities))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="amenities-icons"><img src="{{URL::asset('images/icon/icon-black/ac.png')}}" draggable="false"></span><span
				 class="pl-3">AC</span>
			</div>
			@endif
			@if(in_array('6',$shelter->amenities))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="amenities-icons"><img src="{{URL::asset('images/icon/icon-black/tv.png')}}" draggable="false"></span><span
				 class="pl-3">TV</span>
			</div>
			@endif
			@if(in_array('7',$shelter->amenities))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="amenities-icons"><img src="{{URL::asset('images/icon/icon-black/wifi.png')}}" draggable="false"></span><span
				 class="pl-3">Wifi</span>
			</div>
			@endif
			@if(in_array('8',$shelter->amenities))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="amenities-icons"><img src="{{URL::asset('images/icon/icon-black/laundary.png')}}" draggable="false"></span><span
				 class="pl-3">Laundry
					(Machine)</span>
			</div>
			@endif

			@if(in_array('9',$shelter->amenities))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="amenities-icons"><img src="{{URL::asset('images/icon/icon-black/ro-water.png')}}" draggable="false"></span><span
				 class="pl-3">RO
					Water</span>
			</div>
			@endif
			@if(in_array('10',$shelter->amenities))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="amenities-icons"><img src="{{URL::asset('images/icon/icon-black/parking.png')}}" draggable="false"></span><span
				 class="pl-3">Parking</span>
			</div>
			@endif
			@if(in_array('11',$shelter->amenities))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="amenities-icons"><img src="{{URL::asset('images/icon/icon-black/cooler.png')}}" draggable="false"></span><span
				 class="pl-3">Cooler</span>
			</div>
			@endif
			@if(in_array('12',$shelter->amenities))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="amenities-icons"><img src="{{URL::asset('images/icon/icon-black/sleeping-mattress.png')}}" draggable="false"></span><span
				 class="pl-3">Sleeping Matress</span>
			</div>
			@endif

			@if(in_array('13',$shelter->amenities))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="amenities-icons"><img src="{{URL::asset('images/icon/icon-black/power.png')}}" draggable="false"></span><span
				 class="pl-3">Power
					Backup</span>
			</div>
			@endif
			@if(in_array('14',$shelter->amenities))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="amenities-icons"><img src="{{URL::asset('images/icon/icon-black/balcony.png')}}" draggable="false"></span><span
				 class="pl-3">Balcony</span>
			</div>
			@endif
			@else
			<div class="col-lg-12 col-md-12 mt-3">
				<strong class="text-capitalize"></strong>
			</div>
			@endif
		</div>
		<hr>
	</div>
</section>
@endif
@if(isset($shelter->rules))
<section id="rules">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 mt-3">
				<h5 class="font-weight-bold">Rules</h5>
			</div>
		</div>
		<div class="row">
			@if(isset($shelter->rules))
			@if(in_array('1',$shelter->rules))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="rules-icons"><img src="{{URL::asset('images/icon/icon-black/non-smoking.png')}}"></span><span class="pl-3">Non
					Smoking</span>
			</div>
			@endif
			@if(in_array('2',$shelter->rules))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="rules-icons"><img src="{{URL::asset('images/icon/icon-black/gate.png')}}"></span><span class="pl-3">Fixed Gate
					closing time</span>
			</div>
			@endif
			@if(in_array('3',$shelter->rules))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="rules-icons"><img src="{{URL::asset('images/icon/icon-black/guardian.png')}}"></span><span class="pl-3">No
					Guardian Stay</span>
			</div>
			@endif
			@if(in_array('4',$shelter->rules))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="rules-icons"><img src="{{URL::asset('images/icon/icon-black/no-drinking.png')}}"></span><span class="pl-3">No
					Drinking</span>
			</div>
			@endif

			<!-- if(in_array('5',$shelter->rules))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="rules-icons"><img src="{{URL::asset('images/icon/icon-black/girl-boy.png')}}"></span><span class="pl-3">Girl/Boy entry</span>
			</div>
			endif -->
			@if(in_array('6',$shelter->rules))
			<div class="col-lg-3 col-6 mt-3 mb-3">
				<span class="rules-icons"><img src="{{URL::asset('images/icon/icon-black/non-veg.png')}}"></span><span class="pl-3">No
					Non-veg</span>
			</div>
			@endif
			<!-- if(in_array('7',$shelter->rules))
			<div class="col-lg-3 col-6 mt-3 mb-3 d-none">
				<span class="rules-icons"><img src="{{URL::asset('images/icon/large-icons/no-iron.png')}}"></span><span class="pl-3">No Iron</span>
			</div>
			endif
			if(in_array('8',$shelter->rules))
			<div class="col-lg-3 col-6 mt-3 mb-3 d-none">
				<span class="rules-icons"><img src="{{URL::asset('images/icon/large-icons/heater.png')}}"></span><span class="pl-3">Heater</span>
			</div>
			endif

			if(in_array('9',$shelter->rules))
			<div class="col-lg-3 col-6 mt-3 mb-3 d-none">
				<span class="rules-icons"><img src="{{URL::asset('images/icon/large-icons/stove.png')}}"></span><span class="pl-3">Electric Stove</span>
			</div>
			endif -->
			@else
			<div class="col-lg-12 col-md-12 mt-3">
				<strong class="text-capitalize">no rules</strong>
			</div>
			@endif
		</div>
		<hr>
	</div>
</section>
@endif
@php $toshow = 0; @endphp
@if($shelter->electricity_charge)
@php $toshow++; @endphp
@endif
@if($shelter->cleaning_charge)
@php $toshow++; @endphp
@endif
@if($shelter->wifi_charge)
@php $toshow++; @endphp
@endif
@if($shelter->cylinder)
@php $toshow++; @endphp
@endif
<section id="other_services">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 mt-3">
				@if($toshow>0)
				<h5 class="font-weight-bold">Other Services Provided</h5>
				@endif
			</div>
		</div>
		<div class="row pl-3">
			@php $other_services = 0; @endphp	
			@if($shelter->electricity_charge)	
			<div class="col-lg-3 mt-3">
				<div class="form-group">
					<label>Electricity : </label>
					<strong>{{$shelter->electricity_charge != '' ? 'As per units' : 'N/A'}}</strong>
				</div>
			</div>
			@php $other_services = $other_services+1; @endphp
			@endif		
			
			@if($shelter->cleaning_charge)
			<div class="col-lg-3 mt-3">
				<div class="form-group">
					<label>Cleaning ( ₹ ) : </label>
					<strong>{{$shelter->cleaning_charge ? $shelter->cleaning_charge : '0'}}</strong>
				</div>
			</div>
			@php $other_services = $other_services+1; @endphp
			@endif
			
			@if($shelter->wifi_charge)
			<div class="col-lg-3 mt-3">
				<div class="form-group">
					<label>Wifi ( ₹ ) : </label>
					<strong>{{$shelter->wifi_charge ? $shelter->wifi_charge : '0'}}</strong>
				</div>
			</div>
			@php $other_services = $other_services+1; @endphp
			@endif
			
			@if($shelter->cylinder)
			<div class="col-lg-3 mt-3">
				<div class="form-group">
					<label>Cylinder : </label>
					<strong>{{$shelter->cylinder == 1? 'Yes' : ($shelter->cylinder === NULL ? 'N/A' : 'No')}}</strong>
				</div>
			</div>
			@php $other_services = $other_services+1; @endphp
			@endif			
			@if($other_services == 0)
			<div class="col-lg-6 mt-3">
				<div class="form-group">
					<label></label>
				</div>
			</div>
			@endif
		</div>
		<hr>
	</div>
</section>
@if($shelter->other_service)
<section id="other_services">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 mt-3">
				<h5 class="font-weight-bold">Extra Charges</h5>
			</div>
		</div>
		<div class="row pl-3">
			@if($shelter->other_service)
			<div class="col-lg-3 mt-3">
				<div class="form-group">
					<label>{{$shelter->other_service}} ( ₹ ) : </label>
					<strong>{{$shelter->other_services_charges}}</strong>
				</div>
			</div>			
			@endif
		</div>
		<hr>
	</div>
</section>
@endif

<section id="map-view">
	<div class="container mt-3 mb-3">
		<div id="googleMap" style="width:100%;height:300px;"></div>
	</div>
</section>

<!-- <section id="reviews">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 mt-4">
				<h5 class="font-weight-bold">Reviews</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="user-name pt-3">
					<sapn class="font-weight-bold">John Doe</span>
						<span class="days-cl float-right">2 days ago</span>
						<p class="review-contant pt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eis usmod tempor
							incididunt ut labore et dolore magna aliqua. Ut ele utis uenim ad minim veniam, quis nostrud exercitation
							ullamco laboris nisi <a href="#"> read more</a> </p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="user-name pt-3">
					<sapn class="font-weight-bold">Smith</span>
						<span class="days-cl float-right">3 days ago</span>
						<p class="review-contant pt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eis usmod tempor
							incididunt ut labore et dolore magna aliqua. Ut ele utis uenim ad minim veniam, quis nostrud exercitation
							ullamco laboris nisi <a href="#"> read more</a> </p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 mt-4">
				<p class="font-weight-bold">Write a Reviews</p>
				<div id="reviewStars-input">
					<input id="star-4" type="radio" name="reviewStars" />
					<label title="gorgeous" for="star-4"></label>

					<input id="star-3" type="radio" name="reviewStars" />
					<label title="good" for="star-3"></label>

					<input id="star-2" type="radio" name="reviewStars" />
					<label title="regular" for="star-2"></label>

					<input id="star-1" type="radio" name="reviewStars" />
					<label title="poor" for="star-1"></label>

					<input id="star-0" type="radio" name="reviewStars" />
					<label title="bad" for="star-0"></label>
				</div>
				<div class="form-group text-ar">
					<textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Write your comments here......"></textarea>
					<button class="btn top-listing-btn ml-auto ml-lg-0 white-color pl-5 pr-5 mt-4" type="button" data-toggle="modal"
					 data-target="#">Submit Review</button>
				</div>
			</div>
		</div>
		<br>
		<hr>
	</div>
</section> -->

<div class="modal fade" id="contactowner" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content pb-3">
			<div class="modal-header border-0">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div role="tabpanel" class="tab-pane container active in" id="home">
				<div class="modal-text text-center">
					<h3>Owner Information</h3>
					<p style="color:red"><sup>*</sup>SHELLPAR Recommends you to Contact Owner and verify details before visiting the Shelter</p>
				</div>
				<div class="row text-center">
					<div class="profil-rounded mt-4 ml-4 mx-auto">
						<div>
							<div>
								<img src="{{ URL::asset('images/image_phone.png') }}">
							</div>
						</div>
						<div class="modal-bottom-text text-center">
							<h5><strong>Name: </strong>{{$shelter->owner_name}}</h5>
							<h5><strong>Phone No: </strong>+91 {{$shelter->contact_no}}</h5>
							<h5><strong>Address: </strong>{{$shelter->street}},{{$shelter->locality}},{{$shelter->city}},{{$shelter->states}}-{{$shelter->pincode}},In </h5>							
							<!--h5>You Can Contact {{$shelter->owner_name}}</h5>
							<h5>+91 {{$shelter->contact_no}}</h5-->
						</div>
						<div class="row pl-5 justify-content-center">
							<button class="btn top-listing-btn white-color px-4 mt-4" data-dismiss="modal">Okay</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@if(isset($relatedPosts) && count($relatedPosts) > 0)
<section id="products-row" style="margin-top: 60px;">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 mt-3" style="margin-bottom: 30px;">
				<h5 class="font-weight-bold">Related Posts</h5>
			</div>
			<div class="col">          
          <!--div class="customNavigation pt-2 ml-2 d-md-none">
            <a id="prev2" class="btn prev"><img src="http://127.0.0.2/images/left-arrow.png"></a>
            <a id="next2" class="btn next"><img src="images/right-arrow.png"></a>
          </div-->
        </div>
		</div>
		<div class="container d-block d-md-block">
	<div class="owl-carousel oc-one">
      	@foreach($relatedPosts as $sh)
        <div class="card">
        	<div class="container-fluid">
        		<div class="row pb-3">
        			<div class="col">
        				<span class="user-name-text">{{$sh->username}}
        					<img src="{{URL::asset('images/verified_icon.png')}}" alt="Logo" class="shield-img d-inline w-auto pl-2 pb-1" draggable="false">        					
        			</div>
        		</div>
        	</div>
          <div class="card-head list_tile" id="bx-ht" data-id="{{$sh->id}}">
            @if(file_exists(public_path('/uploads/').$sh->img) && $sh->img!='')
            <img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads')}}/{{$sh->img ? $sh->img : 'default-shelter.png'}}"
              draggable="false" height="220px">
            @else
            <img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads/default-shelter.png')}}" draggable="false" height="220px">
            @endif
            </div>
            @if($sh->property_type == 'House/Flat')
	            <div class="card-body pl-0 pr-0"><span class="green-title pb-3 font-weight-bold">
	            	@if($sh->is_verified == '1')
	            	<img src="{{URL::asset('images/verified_icon.png')}}" alt="Logo" class="shield-img d-inline w-auto pb-1" draggable="false">
	            		VERIFIED
	            		<span class="dot pl-2 pr-2">•</span>
	            	@endif
	            	{{$sh->flat_type}} BHK	            	
                    <span class="dot pl-2 pr-2">.</span>{{$sh->property_feature == 1 ? 'Independent Floor' : ($sh->property_feature == 2 ? 'Appartment' :
                      ($sh->property_feature == 3 ? 'Independent Villa' : ($sh->property_feature == 4 ? $sh->other_property_feature : '')))}}
                    @if($sh->flat_size != NULL)
                      <span class="dot pl-2 pr-2">&bull;</span>{{$sh->flat_size}} Sq.ft
                    @endif
	            	<p class="addres mt-3 pb-0 font-weight-bold text-dark">
						<span>{{$sh->flat_type}} BHK </span>
						<span class="pl-3">{{$sh->street}} {{$sh->locality}}, {{$sh->city}}</span>
					</p>
					<p>
						<span class="blue-title font-weight-bold">₹ {{$sh->expected_rent}}</span>
						<span class="avil-cl float-right"> Available Now</span>
					</p>
				</div>  
			@else
				<div class="card-body pl-0 pr-0"><span class="green-title pb-3 font-weight-bold">
	            	@if($sh->is_verified == '1')
	            	<img src="{{URL::asset('images/verified_icon.png')}}" alt="Logo" class="shield-img d-inline w-auto pb-1" draggable="false">
	            		VERIFIED
	            		<span class="dot pl-2 pr-2">•</span>
	            	@endif
	            	{{$sh->sharing_type}} BED <span class="dot pl-2 pr-2">.</span><span>PG/Room </span>            	
	            	<p class="addres mt-3 pb-0 font-weight-bold text-dark">
						<span>{{$sh->sharing_type}} BEDS </span>
						<span class="pl-3">{{$sh->street}} {{$sh->locality}}, {{$sh->city}}</span>
					</p>
					<p>
						<span class="blue-title font-weight-bold">₹ {{$sh->expected_rent}}</span>
						<span class="avil-cl float-right"> Available Now</span>
					</p>
				</div> 
			@endif
        </div>  
        @endforeach
    </div>
</div> 
	</div>
	</div>
</section>
@endif
<script>
	function myMap() {

		var mapProp = {
			center: new google.maps.LatLng("{{$shelter->latitude}}", "{{$shelter->longitude}}"),
			zoom: 16,
		};
		var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

		var marker = new google.maps.Marker({
			position: new google.maps.LatLng("{{$shelter->latitude}}", "{{$shelter->longitude}}"),
			animation: google.maps.Animation.DROP
		});

		marker.setMap(map);

		var infowindow = new google.maps.InfoWindow({
			content: "LatLong of this Location are {{$shelter->latitude}}, {{$shelter->longitude}}"
		});

		google.maps.event.addListener(marker, 'click', function () {
			infowindow.open(map, marker);
		});

	}

	function copylink(id){		
		var currenturllink=window.location.origin;
		var link = currenturllink+'/listing-details/'+id;
		$('.demo-2').text(link);
		$('.demo-2').click();
	}


</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s&callback=myMap"></script>
@include('layouts.footer')

<div class="modal fade" id="reportShelter" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Report Shelter</h4>
				<button type="button" class="reject close pull-right" data-dismiss="modal">&times;</button>
			</div>
			@if(isset($is_reported) && $is_reported == 1)
			<div class="modal-body">
				<p>This shelter is already reported by you.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
			@else
			<form class='form-group' method="post" action="{{url('/report-shelter')}}">
				<div class="modal-body">
					<p>Please tell us why you want to report this shelter? </p>
					{{@csrf_field()}}
					<input type="hidden" name="user_id" id="report_userId" class="form-control" value="{{Auth::check()? Auth::user()->id : ''}}">
					<input type="hidden" name="shelter_id" id="report_shelterId" class="form-control" value="{{$shltrid}}">
					 <textarea required name="message" rows="5" placeholder="e.g. wrong information, report if broker, not available etc." cols="42"></textarea>
				</div>
				<div class="modal-footer">				

					<input type="submit" id="report" class="btn top-listing-btn white-color px-3  px-md-4" value="Report" />
					<!--button type="button" class="btn btn-default" data-dismiss="modal">Close</button-->
				</div>
			</form>
			@endif
		</div>

	</div>
</div>
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content pb-3">
			<div class="modal-header border-0">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div role="tabpanel" class="tab-pane container active in" id="home">
				<div class="modal-text text-center">
					<h3>Complete Your Profile First.</h3>
				</div>
				<form enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="row pt-5 pl-3 pr-3">
						<div class="col-lg-6">
							<div class="form-group">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><img src="{{URL::asset('images/icon/name-icon.png')}}" draggable="false"></div>
									</div>
									<div class="form-group">
										<label for="username" class="age-title profile-i-label mb-0">Name</label>
										<input type="text" class="form-control pro-in input-cl pl-0" id="username" name="username" aria-describedby=""
										 placeholder="{{Auth::check()? Auth::user()->name : ''}}" value="{{Auth::check()? Auth::user()->name : ''}}"
										 required>
										 <p class="text-danger" id="nameerror" style="margin-top: 2px;"></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><img src="{{URL::asset('images/icon/email-icon.png')}}" draggable="false"></div>
									</div>
									<div class="form-group">
										<label for="useremail" class="age-title profile-i-label mb-0">Email</label>
										<input type="email" required class="form-control pro-in input-cl pl-0" id="useremail" name='useremail'
										 aria-describedby="" placeholder="{{Auth::check()? Auth::user()->email : ''}}" value="{{Auth::check()? Auth::user()->email : ''}}"
										 required>
										<p class="text-danger" id="emailerror" style="margin-top: 2px;"></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row pt-3 pl-3 pr-3">
						<div class="col-lg-6">
							<div class="form-group">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><img src="{{URL::asset('images/icon/phone-icon.png')}}" draggable="false"></div>
									</div>
									<div class="form-group">
										<label for="userphone" class="age-title profile-i-label mb-0">Phone</label>
										<input type="text" class="form-control pro-in input-cl pl-0" id="userphone" readOnly="true" name='userphone'
										 aria-describedby="" placeholder="+91 {{Auth::check()? Auth::user()->phone : ''}}" value="{{Auth::check()? Auth::user()->phone : ''}}"
										 required>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><img src="{{URL::asset('images/icon/gender-icon.png')}}" draggable="false"></div>
									</div>
									<div class="form-group">
										<label for="usergender" class="age-title profile-i-label mb-0">Gender</label>
										<select class="form-control gender-cl pl-0 edit-fl" id="usergender" placeholder="Matching" name='usergender'>
											<option value="{{Auth::check() ? Auth::user()->gender : ''}}"
											 {{Auth::check() ? (Auth::user()->gender == 1 ? 'selected': '') : ''}}> Male </option>
											<option value="{{Auth::check() ? Auth::user()->gender : ''}}"
											 {{Auth::check() ? (Auth::user()->gender == 2 ? 'selected': '') : ''}}> Female </option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row pl-5 justify-content-center">
						<button class="btn top-listing-btn white-color px-4 mt-4" id="onupdateprofile" type="submit" style="width: 227px;">Save</button>
						<!-- <button class="btn see-more-btn white-color px-4 mt-4 ml-2" type="button" onclick="window.location.reload();">Cancel</button> -->
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function toshowtoggle() {
		var isupdate = $('#isupdate').val();
		if (isupdate == 0) {
			$('#myModal').modal('show');
		} else {
			$('#contactowner').modal('show');
		}
	}

	$(document).on('click', '#onupdateprofile', function (e) {
		var email = $('#useremail').val();
		var usergender = $('#usergender').val();
		var username = $('#username').val();
		var phone = $('#userphone').val();
		if (username == "") {
			$('#nameerror').html('Please enter your name');
			return false;
		}
		/*if (email == "") {
			$('#emailerror').html('Please enter your email');
			return false;
		}*/
		if (usergender == "0") {
			usergender = 1;
		}
		$.ajax({
			type: 'POST',
			url: '/updateuserprofile',
			dataType: 'json',
			data: {
				'email': email,
				'usergender': usergender,
				'username': username,
				'phone': phone
			},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function (result) {
				if (result.success == 0) {
					$('#emailerror').html('Email Already Exist');
				} else if (result.success == 1) {
					$('#contactowner').modal('show');
					$('#myModal .close').click();
					$('#isupdate').val(1);
				}
			},
			error: function (result) {
				toastr.error('Error Message', "Unexpected Error Occured", {displayDuration: 2000, position: 'top-right'});
			}
		});
		return false;
	});
</script>

<script>
 	$('.demo-2').click(function(){
        $(this).CopyToClipboard();
        toastr.success('', "Copied", {displayDuration: 300,timeOut: 100, position: 'top-right'});
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0="
 crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$(".owl-carousel").owlCarousel({
			loop: false,
			nav: true,
			margin: 10,
			items: 1,
			rewind: true

		});
	});
</script>
@endsection