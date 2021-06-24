@extends('layouts.appFront')
@section('breadcrumb_title')
Property for rent {{$address!='' ? 'in '.$address : ''}}
@endsection
@section('content')
<style>
  select.form-control{
    font-size: 13px;
  }
  .newone{height:850px;}     
</style> 
<section id="searchFilters">
  <div class="container my-5">
    <div class="row text-center dropdown-filter px-3">
      <div class="col-lg-2 drop-width px-0">
        <div class="dropdown">
          <div class="form-group">
            <select class="form-control drop-list-row" name="property_type" onchange="searchshelter('property_type',this.value)"
              id="propertype">
              <?php if(isset($_GET['property_type'])){ $val=$_GET['property_type'];}else{$val="";}  ?>
              <option <?php if($val=="" ){ echo 'selected' ;} ?> disabled value="" class="d-none">Select Property Type</option>
              <option <?php if($val=="House/Flat" ){ echo 'selected' ;} ?> value="House/Flat">House/Flat</option>
              <option <?php if($val=="Pg/Room" ){ echo 'selected' ;} ?> value="Pg/Room">Pg/Room</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-lg-2 drop-width px-0">
        <div class="form-group">
          <select class="form-control drop-list-row" name="looking_for" onchange="searchshelter('looking_for',this.value)"
            id="lookingfor">
            <?php if(isset($_GET['looking_for'])){ $val=$_GET['looking_for'];}else{$val="";}  ?>
            <option <?php if($val=="" ){ echo 'selected' ;} ?> disabled value="" class="d-none">Looking For</option>
            <option <?php if($val=="1" ){ echo 'selected' ;} ?> value="1">Male</option>
            <option <?php if($val=="2" ){ echo 'selected' ;} ?> value="2">Female</option>
            @if(isset($_GET['property_type']) && $_GET['property_type']!="Pg/Room")
            <!--option <?php if($val=="3" ){ echo 'selected' ;} ?> value="3">Family</option-->
            @endif
          </select>
        </div>
      </div>
      @if(!isset($_GET['looking_for']) || ($_GET['looking_for'] != 3) )
      <div class="col-lg-2 drop-width px-0">
        <div class="dropdown form-group">
          <select class="form-control drop-list-row" name="tenant_type" onchange="searchshelter('tenant_type',this.value)"
            id="occupation">
            <?php if(isset($_GET['tenant_type'])){ $val=$_GET['tenant_type'];}else{$val="";}  ?>
            <option <?php if($val=="" ){ echo 'selected' ;} ?> disabled value="" class="d-none">Tenant Type</option>
            <option <?php if($val=="1" ){ echo 'selected' ;} ?> value="1">Student</option>
            <option <?php if($val=="2" ){ echo 'selected' ;} ?> value="2">Professional</option>
            <!--option <?php if($val=="3" ){ echo 'selected' ;} ?> value="3">Family</option-->
          </select>
        </div>
      </div>
      @endif
      @if(isset($_GET['property_type']))
      @if($_GET['property_type'] == 'House/Flat')
      <div class="col-lg-2 drop-width px-0">
        <div class="dropdown form-group">
          <select class="form-control drop-list-row" name="sharing" onchange="searchshelter('sharing',this.value)" id="sharing">
            <?php if(isset($_GET['sharing'])){ $val=$_GET['sharing'];}else{$val="";}  ?>
            <option <?php if($val=="" ){ echo 'selected' ;} ?> disabled value="" class="d-none">Flat Layout</option>
            <option <?php if($val=="1" ){ echo 'selected' ;} ?> value="1">1 BHK</option>
            <option <?php if($val=="2" ){ echo 'selected' ;} ?> value="2">2 BHK</option>
            <option <?php if($val=="3" ){ echo 'selected' ;} ?> value="3">3 BHK</option>
            <option <?php if($val=="4" ){ echo 'selected' ;} ?> value="4">4 BHK</option>
          </select>
        </div>
      </div>
      @else
      <div class="col-lg-2 drop-width px-0">
        <div class="dropdown form-group">
          <select class="form-control drop-list-row" name="sharing" onchange="searchshelter('sharing',this.value)" id="sharing">
            <?php if(isset($_GET['sharing'])){ $val=$_GET['sharing'];}else{$val="";}  ?>
            <option <?php if($val=="" ){ echo 'selected' ;} ?> disabled value="" class="d-none">Sharing</option>
            <option <?php if($val=="1" ){ echo 'selected' ;} ?> value="1">1 Bed</option>
            <option <?php if($val=="2" ){ echo 'selected' ;} ?> value="2">2 Beds</option>
            <option <?php if($val=="3" ){ echo 'selected' ;} ?> value="3">3 Beds</option>
            <option <?php if($val=="4" ){ echo 'selected' ;} ?> value="4">4 Beds</option>
            <option <?php if($val=="5" ){ echo 'selected' ;} ?> value="5">5 Beds</option>
            <option <?php if($val=="6" ){ echo 'selected' ;} ?> value="6">6 Beds</option>
          </select>
        </div>
      </div>
      @endif
      @endif
      <div class="col-lg-2 drop-width px-0">
        <div class="dropdown form-group">
          <select class="form-control drop-list-row" name="rent" id="rent" onchange="searchshelter('rent',this.value)">
            <?php if(isset($_GET['rent'])){ $val=$_GET['rent'];}else{$val="";}  ?>
            <option <?php if($val=="" ){ echo 'selected' ;} ?> disabled value="" class="d-none">Monthly Budget</option>
            <option <?php if($val=="1" ){ echo 'selected' ;} ?> value="1">Below Rs.5000</option>
            <option <?php if($val=="2" ){ echo 'selected' ;} ?> value="2">Between Rs.5000 - Rs.10000</option>
            <option <?php if($val=="3" ){ echo 'selected' ;} ?> value="3">Between Rs.10000 - Rs.20000</option>
            <option <?php if($val=="4" ){ echo 'selected' ;} ?> value="4">Above Rs.20000</option>
          </select>
        </div>
      </div>
      <div class="col-lg-3 px-0">
        <button class="btn top-listing-btn white-color px-2" onclick="searchshelter('1','0')" type="button">Clear
          Filter</button>
        <span class="btn top-listing-btn white-color px-3" data-target="#advanceFilters" data-toggle="modal">
          Secondary filter
          <!-- <img src="{{URL::asset('images/filters.png')}}" alt="Filters"/> -->
        </span>
      </div>
    </div>
  </div>
</section>

<section id="mapView">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 pl-md-0">
				<h4 class="title-places">{{$listingtitle}}</h4>
			</div>
			<div class="col-lg-6 text-right">
				<form class="form">
					<div class="switch-field">
						<input type="radio" id="switch_left" name="switch_2" value="yes" />
						<label for="switch_left"><a id="listview" href="{{url('/listing')}}">List</a></label>
						<input type="radio" id="switch_right" name="switch_2" value="no" checked />
						<label for="switch_right"><a id="mapview" href="{{url('/listing-map')}}">Map</a></label>
					</div>
				</form>
			</div>
		</div>
		<div class="row mt-4">
			@if(count($shelters) > 0)
			<div class="col-lg-4 order-2 order-lg-1 pl-md-0 align-items-center" style="overflow-y:scroll; height:850px;">
			@php $locations = array(); @endphp
				@foreach($sortedshelter as $shelter)
					@php 
						array_push($locations,$shelter); 
						$i = count($locations)-1;
					@endphp
				<div class="card list_tile"  data-id="{{$shelter['id']}}" onmouseout="showme({{$i}})" onmouseover="showme({{$i}})"><span class="user-name-text">{{$shelter['uname']}}<img src="{{URL::asset('images/verified_icon.png')}}" alt="Logo"
						 class="shield-img pl-2" draggable="false"></span>
					<span class="pb-3">
					<div class="card-head" id="bx-ht">
						@if(file_exists(public_path('/uploads/').$shelter['img']) && $shelter['img']!='')
						<img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads')}}/{{$shelter['img'] ? $shelter['img'] : 'default-shelter.png'}}"
						 draggable="false" height="220px">
						@else
						<img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads/default-shelter.png')}}" draggable="false"
						 height="220px">
						@endif
					</div>
					<div class="card-body pl-0 pr-0"> <span class="green-title pb-3 font-weight-bold">
              @if($shelter['property_type'] == 'House/Flat')
              @if($shelter['is_verified'] == '1')
              <img src="{{URL::asset('images/verified_icon.png')}}" alt="Logo" class="shield-img pr-2" draggable="false">
              Verified
              <span class="dot pl-2 pr-2">&bull;</span>
              @endif
              {{$shelter['flat_type']}} BHK
              <span class="dot pl-2 pr-2">&bull;</span>{{$shelter['flat_size']}} Sq.ft
            </span>
            <p class="addres mt-3 pb-0 font-weight-bold">
              <span>{{$shelter['flat_type']}} BHK </span>
              <span>{{$shelter['street']}} {{$shelter['locality']}}, {{$shelter['city']}}</span>
            </p>
            <p>
              <span class="blue-title font-weight-bold">&#x20B9; {{$shelter['expected_rent']}} / MONTH</span>
              <span class="avil-cl float-right"> Available Now </span>
            </p>
            @else
            @if($shelter['is_verified'] == '1')
            <img src="{{URL::asset('images/verified_icon.png')}}" alt="Logo" class="shield-img pr-2" draggable="false">
            Verified
            <span class="dot pl-2 pr-2">&bull;</span>
            @endif
            {{$shelter['sharing_type']}} BED
            <span class="dot pl-2 pr-2">&bull;</span>{{$shelter['flat_size']}} Sq.ft</span>
            <p class="addres mt-3 pb-0 font-weight-bold">
              <span>{{$shelter['sharing_type']}} BED </span>
              <span>{{$shelter['street']}} {{$shelter['locality']}}, {{$shelter['city']}}</span>
            </p>
            <p>
              <span class="blue-title font-weight-bold">&#x20B9; {{$shelter['expected_rent']}} / MONTH</span>
              <span class="avil-cl float-right"> Available Now </span>
            </p>
            @endif
          </div>
				</div>
				@endforeach
			</div>      
			<div class="col-lg-8 order-1 order-lg-2">
				<section id="map-view">
					<div class="container mt-3 mb-3">
						<div id="googleMap" class="google-maps-mobile-fix newone"></div>
					</div>
				</section>
				<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3430.2652112649253!2d76.68422485034198!3d30.710943781554658!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390feff35b3eba27%3A0x8c87359c9e8547fe!2sSoft+Radix!5e0!3m2!1sen!2sin!4v1540369257613"
				 width="100%" height="850" frameborder="0" style="border:0" allowfullscreen></iframe> -->
			</div>
			@else
			<div class="col-lg-12">
				<h4 class="text-capitalize text-center text-muted">Sorry! No shelters found meeting this search criterion.</h4>
			</div>
			@endif
		</div>
		<div class="col-lg-12 pb-5">
      <div class="col-12 mx-auto mt-5" style="margin-bottom: 20px;">
        <div>{{ $shelters->appends(request()->query())->links() }}</div>
      </div>
    </div>
	</div>
</section>

<!-- <section>
	<div class="container">
		<div class="row ">
			<div class="col-lg-12 mt-4 mb-4">
				<div class="pegi-row ">
					<nav aria-label="...">
						<ul class="pagination justify-content-md-center">
							<li class="page-item disabled">
								<span class="page-link">&laquo;</span>
							</li>
							<li class="page-item active">
								<span class="page-link pegi-act">
									1
									<span class="sr-only">(current)</span>
								</span>
							</li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item">
								<a class="page-link" href="#">&raquo;</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section> -->

@include('layouts.footer')
<!-- Searching Modal -->
<div class="modal fade" id="advanceFilters" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Secondary Filters</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row px-3">
          @if(isset($_GET['property_type']) && $_GET['property_type']!='Pg/Room')
          <div class="col-lg-6 col-md-12 col-sm-12 mt-4">
            <section>
              <div class="inner">
                <p class="font-weight-bold">Furniture</p>
                <div class="stv-radio-buttons-wrapper">
                  <?php if(isset($_GET['furniture'])){ $fruniture=explode(',',$_GET['furniture']);}else{ $fruniture=array();}?>
                  <input type="checkbox" {{isset($fruniture) && in_array('1',$fruniture) ? 'checked' : ''}} class="stv-radio-button" name="furniture" value="1" id="furniture" />
                  <label for="furniture">Furnished</label>
                  <input type="checkbox" class="stv-radio-button" {{isset($fruniture) && in_array('3',$fruniture) ? 'checked' : ''}} name="furniture" value="3" id="buttonSemi-Furnished" />
                  <label for="buttonSemi-Furnished">Semi - Furnished</label>
                  <input type="checkbox" {{isset($fruniture) && in_array('2',$fruniture) ? 'checked' : ''}} class="stv-radio-button" name="furniture" value="2" id="buttonNon-Furnished" />
                  <label for="buttonNon-Furnished">Non - Furnished</label>
                </div>
              </div>
            </section>
          </div>
          <div class="col-lg-6 col-md-12 col-sm-12 mt-4 ">
            <section>
              <div class="inner">
                <div class="form-group pgr">
                  <p class="font-weight-bold">Flat Type</p>
                  <?php if(isset($_GET['property_feature'])){ $property_feature=explode(',',$_GET['property_feature']);}else{ $property_feature=array();}?>                  
                  <div class="stv-radio-buttons-wrapper">
                    <input type="checkbox" class="stv-radio-button" {{isset($property_feature) && in_array('2',$property_feature) ? 'checked' : ''}} name="property_feature" value="2" id="button3" />
                    <label for="button3">Appartment</label>
                    <input type="checkbox" class="stv-radio-button" {{isset($property_feature) && in_array('1',$property_feature) ? 'checked' : ''}} name="property_feature" value="1" id="button4" />
                    <label for="button4">Independent Floor</label>
                    <input type="checkbox" class="stv-radio-button" {{isset($property_feature) && in_array('3',$property_feature) ? 'checked' : ''}} name="property_feature" value="3" id="button5" />
                    <label for="button5">Independent Villa</label>
                    <input type="checkbox" class="stv-radio-button" {{isset($property_feature) && in_array('4',$property_feature) ? 'checked' : ''}} name="property_feature" value="4" id="button6" />
                    <label for="button6">Other</label> 
                  </div>
                </div>
              </div>
            </section>
          </div>
          @endif
          @if(isset($_GET['property_type']) && $_GET['property_type']=='Pg/Room')
          <div class="col-lg-6 col-md-12 col-sm-12 mt-4 pgr">
            <section>
              <div class="inner">
                <div class="form-group pgr">
                  <p class="font-weight-bold">Food</p>
                  <?php if(isset($_GET['food'])){ $food=explode(',',$_GET['food']);}else{ $food=array();}?>
                  <div class="stv-radio-buttons-wrapper">
                    <input type="radio" class="stv-radio-button" {{isset($food) && in_array('1',$food) ? 'checked' : ''}} name="food" value="1" id="buttonfood" />
                    <label for="buttonfood">With food</label>
                    <input type="radio" class="stv-radio-button" {{isset($food) && in_array('0',$food) ? 'checked' : ''}} name="food" value="0" id="buttonWithout" />
                    <label for="buttonWithout">Without food</label>
                  </div>
                </div>
              </div>
            </section>
          </div>
          @endif
          <div class="col-lg-12 col-md-12 col-sm-12 mt-4 pgr">
            <section>
              <div class="inner">
                <div class="row pl-3">
                  <div class="col-lg-12 mt-3">
                    <p class=" font-weight-bold mb-0">Amenities - <small class="text-muted"> (Select Amenities) </small></p>
                  </div>
                </div>
                <?php if(isset($_GET['amenities'])){ $amenities=explode(',',$_GET['amenities']);}else{ $amenities=array();}?>
                <div class="row mt-4 pl-0 pl-md-4">
                  <div class="col-lg-3 col-6 nonfur-select">
                    <ul class="chec-radio pl-0">
                      <li class="pz">
                        <label class="radio-inline">
                          <input type="checkbox" {{isset($amenities) && in_array('1',$amenities) ? 'checked' : ''}} id="pro-chx-residential" name="amenities" class="pro-chx" value="1">
                          <div class="clab">
                            <div class="img-ameni {{isset($amenities) && in_array('1',$amenities) ? 'd-none' : ''}}">
                              <img src="{{URL::asset('images/icon/icon-black/cupboard.png')}}" draggable="false">
                            </div>
                            <div class="img-ameni-white {{isset($amenities) && in_array('1',$amenities) ? '' : 'd-none'}}">
                              <img src="{{URL::asset('images/icon/icon-white/cupboard-white.png')}}" draggable="false">
                            </div>
                          </div>
                          <span class="title-ameni pl-3">Cupboard</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-6">
                    <ul class="chec-radio pl-0">
                      <li class="pz">
                        <label class="radio-inline">
                          <input type="checkbox" {{isset($amenities) && in_array('2',$amenities) ? 'checked' : ''}} id="pro-chx-residential" name="amenities" class="pro-chx" value="2">
                          <div class="clab">
                            <div class="img-ameni {{isset($amenities) && in_array('2',$amenities) ? 'd-none' : ''}}">
                              <img src="{{URL::asset('images/icon/icon-black/lift.png')}}" draggable="false">
                            </div>
                            <div class="img-ameni-white {{isset($amenities) && in_array('2',$amenities) ? '' : 'd-none'}}">
                              <img src="{{URL::asset('images/icon/icon-white/lift-white.png')}}" draggable="false">
                            </div>
                          </div>
                          <span class="title-ameni pl-3">Lift</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-6">
                    <ul class="chec-radio pl-0">
                      <li class="pz">
                        <label class="radio-inline">
                          <input type="checkbox" {{isset($amenities) && in_array('3',$amenities) ? 'checked' : ''}} id="pro-chx-residential" name="amenities" class="pro-chx" value="3">
                          <div class="clab">
                            <div class="img-ameni {{isset($amenities) && in_array('3',$amenities) ? 'd-none' : ''}}">
                              <img src="{{URL::asset('images/icon/icon-black/bath.png')}}" draggable="false">
                            </div>
                            <div class="img-ameni-white {{isset($amenities) && in_array('3',$amenities) ? '' : 'd-none'}}">
                              <img src="{{URL::asset('images/icon/icon-white/bath-white.png')}}" draggable="false">
                            </div>
                          </div>
                          <span class="title-ameni pl-3">Attach Bathroom</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-6 nonfur-select">
                    <ul class="chec-radio pl-0">
                      <li class="pz">
                        <label class="radio-inline">
                          <input type="checkbox" {{isset($amenities) && in_array('4',$amenities) ? 'checked' : ''}} id="pro-chx-residential" name="amenities" class="pro-chx" value="4">
                          <div class="clab">
                            <div class="img-ameni {{isset($amenities) && in_array('4',$amenities) ? 'd-none' : ''}}">
                              <img src="{{URL::asset('images/icon/icon-black/geyser.png')}}" draggable="false">
                            </div>
                            <div class="img-ameni-white {{isset($amenities) && in_array('4',$amenities) ? '' : 'd-none'}}">
                              <img src="{{URL::asset('images/icon/icon-white/geyser-white.png')}}" draggable="false">
                            </div>
                          </div>
                          <span class="title-ameni pl-3">Geyser</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-6 nonfur-select">
                    <ul class="chec-radio pl-0">
                      <li class="pz">
                        <label class="radio-inline">
                          <input type="checkbox" {{isset($amenities) && in_array('5',$amenities) ? 'checked' : ''}} id="pro-chx-residential" name="amenities" class="pro-chx" value="5">
                          <div class="clab">
                            <div class="img-ameni {{isset($amenities) && in_array('5',$amenities) ? 'd-none' : ''}}">
                              <img src="{{URL::asset('images/icon/icon-black/ac.png')}}" draggable="false">
                            </div>
                            <div class="img-ameni-white {{isset($amenities) && in_array('5',$amenities) ? '' : 'd-none'}}">
                              <img src="{{URL::asset('images/icon/icon-white/ac-white.png')}}" draggable="false">
                            </div>
                          </div>
                          <span class="title-ameni pl-3">AC</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-6 nonfur-select">
                    <ul class="chec-radio pl-0">
                      <li class="pz">
                        <label class="radio-inline">
                          <input type="checkbox" {{isset($amenities) && in_array('6',$amenities) ? 'checked' : ''}} id="pro-chx-residential" name="amenities" class="pro-chx" value="6">
                          <div class="clab">
                            <div class="img-ameni {{isset($amenities) && in_array('6',$amenities) ? 'd-none' : ''}}">
                              <img src="{{URL::asset('images/icon/icon-black/tv.png')}}" draggable="false">
                            </div>
                            <div class="img-ameni-white {{isset($amenities) && in_array('6',$amenities) ? '' : 'd-none'}}">
                              <img src="{{URL::asset('images/icon/icon-white/tv-white.png')}}" draggable="false">
                            </div>
                          </div>
                          <span class="title-ameni pl-3">TV</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-6 nonfur-select">
                    <ul class="chec-radio pl-0">
                      <li class="pz">
                        <label class="radio-inline">
                          <input type="checkbox" {{isset($amenities) && in_array('7',$amenities) ? 'checked' : ''}} id="pro-chx-residential" name="amenities" class="pro-chx" value="7">
                          <div class="clab">
                            <div class="img-ameni {{isset($amenities) && in_array('7',$amenities) ? 'd-none' : ''}}">
                              <img src="{{URL::asset('images/icon/icon-black/wifi.png')}}" draggable="false">
                            </div>
                            <div class="img-ameni-white {{isset($amenities) && in_array('7',$amenities) ? '' : 'd-none'}}">
                              <img src="{{URL::asset('images/icon/icon-white/wifi-white.png')}}" draggable="false">
                            </div>
                          </div>
                          <span class="title-ameni pl-3">Wifi</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-6 nonfur-select">
                    <ul class="chec-radio pl-0">
                      <li class="pz">
                        <label class="radio-inline">
                          <input type="checkbox" id="pro-chx-residential" {{isset($amenities) && in_array('8',$amenities) ? 'checked' : ''}} name="amenities" class="pro-chx" value="8">
                          <div class="clab">
                            <div class="img-ameni {{isset($amenities) && in_array('8',$amenities) ? 'd-none' : ''}}">
                              <img src="{{URL::asset('images/icon/icon-black/laundary.png')}}" draggable="false">
                            </div>
                            <div class="img-ameni-white {{isset($amenities) && in_array('8',$amenities) ? '' : 'd-none'}}">
                              <img src="{{URL::asset('images/icon/icon-white/laundary-white.png')}}" draggable="false">
                            </div>
                          </div>
                          <span class="title-ameni pl-3">Laundry (Machine)</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-6 nonfur-select">
                    <ul class="chec-radio pl-0">
                      <li class="pz">
                        <label class="radio-inline">
                          <input type="checkbox" {{isset($amenities) && in_array('9',$amenities) ? 'checked' : ''}} id="pro-chx-residential" name="amenities" class="pro-chx" value="9">
                          <div class="clab">
                            <div class="img-ameni {{isset($amenities) && in_array('9',$amenities) ? 'd-none' : ''}}">
                              <img src="{{URL::asset('images/icon/icon-black/ro-water.png')}}" draggable="false">
                            </div>
                            <div class="img-ameni-white {{isset($amenities) && in_array('9',$amenities) ? '' : 'd-none'}}">
                              <img src="{{URL::asset('images/icon/icon-white/ro-water-white.png')}}" draggable="false">
                            </div>
                          </div>
                          <span class="title-ameni pl-3">RO Water</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-6">
                    <ul class="chec-radio pl-0">
                      <li class="pz">
                        <label class="radio-inline">
                          <input type="checkbox" {{isset($amenities) && in_array('10',$amenities) ? 'checked' : ''}} id="pro-chx-residential" name="amenities" class="pro-chx" value="10">
                          <div class="clab">
                            <div class="img-ameni {{isset($amenities) && in_array('10',$amenities) ? 'd-none' : ''}}">
                              <img src="{{URL::asset('images/icon/icon-black/parking.png')}}" draggable="false">
                            </div>
                            <div class="img-ameni-white {{isset($amenities) && in_array('10',$amenities) ? '' : 'd-none'}}">
                              <img src="{{URL::asset('images/icon/icon-white/parking-white.png')}}" draggable="false">
                            </div>
                          </div>
                          <span class="title-ameni pl-3">Parking</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-6 nonfur-select">
                    <ul class="chec-radio pl-0">
                      <li class="pz">
                        <label class="radio-inline">
                          <input type="checkbox" {{isset($amenities) && in_array('11',$amenities) ? 'checked' : ''}} id="pro-chx-residential" name="amenities" class="pro-chx" value="11">
                          <div class="clab">
                            <div class="img-ameni {{isset($amenities) && in_array('11',$amenities) ? 'd-none' : ''}}">
                              <img src="{{URL::asset('images/icon/icon-black/cooler.png')}}" draggable="false">
                            </div>
                            <div class="img-ameni-white {{isset($amenities) && in_array('11',$amenities) ? '' : 'd-none'}}">
                              <img src="{{URL::asset('images/icon/icon-white/cooler-white.png')}}" draggable="false">
                            </div>
                          </div>
                          <span class="title-ameni pl-3">Cooler</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-6 nonfur-select">
                    <ul class="chec-radio pl-0">
                      <li class="pz">
                        <label class="radio-inline">
                          <input type="checkbox" {{isset($amenities) && in_array('12',$amenities) ? 'checked' : ''}} id="pro-chx-residential" name="amenities" class="pro-chx" value="12">
                          <div class="clab">
                            <div class="img-ameni {{isset($amenities) && in_array('12',$amenities) ? 'd-none' : ''}}">
                              <img src="{{URL::asset('images/icon/icon-black/sleeping-mattress.png')}}" draggable="false">
                            </div>
                            <div class="img-ameni-white {{isset($amenities) && in_array('12',$amenities) ? '' : 'd-none'}}">
                              <img src="{{URL::asset('images/icon/icon-white/sleeping-mattress-white.png')}}" draggable="false">
                            </div>
                          </div>
                          <span class="title-ameni pl-3">Sleeping Mattress</span>
                        </label>
                      </li>
                    </ul>
                  </div>

                  <div class="col-lg-3 col-6 nonfur-select">
                    <ul class="chec-radio pl-0">
                      <li class="pz">
                        <label class="radio-inline">
                          <input type="checkbox" {{isset($amenities) && in_array('13',$amenities) ? 'checked' : ''}} id="pro-chx-residential" name="amenities" class="pro-chx" value="13">
                          <div class="clab">
                            <div class="img-ameni {{isset($amenities) && in_array('13',$amenities) ? 'd-none' : ''}}">
                              <img src="{{URL::asset('images/icon/icon-black/power.png')}}" draggable="false">
                            </div>
                            <div class="img-ameni-white {{isset($amenities) && in_array('13',$amenities) ? '' : 'd-none'}}">
                              <img src="{{URL::asset('images/icon/icon-white/power-white.png')}}" draggable="false">
                            </div>
                          </div>
                          <span class="title-ameni pl-3">Power Backup</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-6">
                    <ul class="chec-radio pl-0">
                      <li class="pz">
                        <label class="radio-inline">
                          <input type="checkbox" {{isset($amenities) && in_array('14',$amenities) ? 'checked' : ''}} id="pro-chx-residential" name="amenities" class="pro-chx" value="14">
                          <div class="clab">
                            <div class="img-ameni {{isset($amenities) && in_array('14',$amenities) ? 'd-none' : ''}}">
                              <img src="{{URL::asset('images/icon/icon-black/balcony.png')}}" draggable="false">
                            </div>
                            <div class="img-ameni-white {{isset($amenities) && in_array('14',$amenities) ? '' : 'd-none'}}">
                              <img src="{{URL::asset('images/icon/icon-white/balcony-white.png')}}" draggable="false">
                            </div>
                          </div>
                          <span class="title-ameni pl-3">Balcony</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </section>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
            <section>
              <div class="inner">
                <?php if(isset($_GET['available_date'])){ $available_date=$_GET['available_date'];}else{ $available_date="";}?>                
                <label for="available_date" class="age-title"> Availability Date </label>
                <input type="text" value="{{$available_date}}" class="form-control input-cl pl-0" id="available_date" name="available_date"
                  placeholder="Property Available from" required>
              </div>
            </section>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary d-none" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary top-listing-btn" onclick="searchshelter('advance','0')">Search</button>
      </div>
    </div>
  </div>
</div>
<!-- Searching Modal Ends -->

<script>
  $('#available_date').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'dd-mm-yyyy',
  });
  // $('input[name="furniture"]').click(function (e) {
  //   if (e.target.value == "2") {
  //     $('.nonfur-select').hide();
  //   } else {
  //     $('.nonfur-select').show();
  //   }
  // });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s&callback=initialize"></script>
<script>
  var query = window.location.search;
  if(query != ""){
    $("#listview").attr("href", `{{url('/listing')}}${query}`);
  }
		var locations = <?php isset($locations)?print_r(json_encode($locations)):'' ?>;
    console.log(locations)
		var geocoder;
		var map;
		var markers = [];

		var icon1  = "{{URL::asset('images/price_tag.png')}}";
		var icon2  = "{{URL::asset('images/price_tag.png')}}";
		 var icon3 = "{{URL::asset('images/price_tag2.png')}}";
		function initialize() {
				map = new google.maps.Map(document.getElementById('googleMap'), {
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						center: new google.maps.LatLng(locations[0]['latitude'], locations[0]['longitude'])
				});
				var bounds = new google.maps.LatLngBounds();
        var prevInfowindow = '';
				locations.forEach(function (data, index, array) {
            var currentMark;

						var marker = new google.maps.Marker({
								position: new google.maps.LatLng(locations[index]['latitude'], locations[index]['longitude']),
								icon: icon2,
                label: {
                  text: `₹ ${locations[index]['expected_rent']}`,
                  color: '#fff',
                  fontSize: "9px"
                },
								map: map
						});
						markers.push(marker);
						bounds.extend(marker.position);
            if(window.location.protocol == "http:"){
										var url = `{{url('/listing-details')}}/${locations[index]['id']}`
									}else{
										var url = `{{secure_url('/listing-details')}}/${locations[index]['id']}`
									}
						google.maps.event.addListener(marker, 'click', function () {
              prevInfowindow&&prevInfowindow.close();
							infowindow.open(map, marker);
              prevInfowindow = infowindow;
              currentMark = this;
						});
            // var ad = new Date(`${locations[index]['available_date']}`)
            // ad  = new Date(Date.UTC(ad.getFullYear(), ad.getMonth(), ad.getDate()))
            // var options = { year: 'numeric', month: 'long', day: 'numeric' };
            // ad = ad.toLocaleString('en-US', options)
            // <p class="mb-2">Available From: <strong>${ad}</strong></p class="mb-2">
            var title="";
            if(locations[index]['property_type'] == "House/Flat"){
              title = locations[index]['flat_type']+ ' BHK';
            }else{
              title = locations[index]['sharing_type']+ ' Bed';
            }
						var infowindow = new google.maps.InfoWindow({
							content: `<div class="text-center">
                <img class="mb-2" src="{{URL::asset('uploads')}}/${locations[index]['img']}" style="max-height:70px" />
                  <p class="mb-2"><strong>${title} in ${locations[index]['locality']}, ${locations[index]['city']}</strong></p>
                  <p class="mb-2"><strong>₹ ${locations[index]['expected_rent']}/month</strong></p>
                  <a href="${url}" target="_blank">View Details</a>
              </div>`
						});
						// google.maps.event.addListener(marker, 'mouseover', function () {
      //         // infowindow.open(map, marker);
						// });
            google.maps.event.addListener(marker, 'click', function () {
                // infowindow.open(map, marker);
                for (var j = 0; j < markers.length; j++) {
                    markers[j].setIcon(icon2);
                }
                marker.setIcon(icon3);
            });
            google.maps.event.addListener(infowindow,'closeclick',function(){
                currentMark.setIcon(icon2);    
            });
						// google.maps.event.addListener(marker, 'mouseout', function () {
      //         // infowindow.close(map, marker);
						// });
				});
				map.fitBounds(bounds);

		}
		google.maps.event.addDomListener(window, "load", initialize);

		showme = function (index) {
				if (markers[index].getAnimation() != google.maps.Animation.BOUNCE) {
						markers[index].setAnimation(google.maps.Animation.BOUNCE);
						markers[index].setIcon(icon1);
				} else {
						markers[index].setAnimation(null);
						markers[index].setIcon(icon2);
				}
		}

	// 	function myMap(lat="30.70",long="76.71") {
	// 	var mapProp = {
	// 		center: new google.maps.LatLng(lat,long),
	// 		zoom: 16,
	// 	};
	// 	var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
	// 	var marker = new google.maps.Marker({
	// 		position: new google.maps.LatLng(lat,long),
	// 		animation: google.maps.Animation.DROP
	// 	});
	// 	marker.setMap(map);
	// 	var infowindow = new google.maps.InfoWindow({
	// 		content: `LatLong of this Location are ${lat}, ${long}`
	// 	});
	// 	google.maps.event.addListener(marker, 'click', function () {
	// 		infowindow.open(map, marker);
	// 	});
	// }
</script>

@endsection