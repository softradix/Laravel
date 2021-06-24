@extends('layouts.appFront')
@section('breadcrumb_title')
Property for rent {{$address!='' ? 'in '.$address : ''}}
@endsection
@section('content')
@section('address')
{{$address}}
@endsection
<style>
  select.form-control{
    font-size: 13px;
  }   
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
            <option <?php if($val=="3" ){ echo 'selected' ;} ?> value="3">Family</option>
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
            <!--option <?php if($val=="3" ){ echo 'selected' ;} ?> value="3">Both</option-->
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
            <input type="radio" id="switch_left" name="switch_2" value="yes" checked />
            <label for="switch_left"><a id="listview" href="{{url('/listing')}}">List</a>
            </label>
            <input type="radio" id="switch_right" name="switch_2" value="no" />
            <label for="switch_right"><a id="mapview" href="{{url('/listing-map')}}">Map</a>
            </label>
          </div>
        </form>
      </div>
    </div>
    @if(count($shelters) > 0)
    <div class="row mt-4">
      @foreach($sortedshelter as $shelter)
      <div class="col-lg-4  pl-md-0 align-items-center list_tile" data-id="{{$shelter['id']}}">
        <div class="card">
          <span class="user-name-text">{{$shelter['uname']}}
            <img src="{{URL::asset('images/verified_icon.png')}}"
              alt="Logo" class="shield-img pl-2" draggable="false">
          </span>
          
          <div class="card-head" id="bx-ht">
            @if(file_exists(public_path('/uploads/').$shelter['img']) && $shelter['img']!='')
            <img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads')}}/{{$shelter['img'] ? $shelter['img'] : 'default-shelter.png'}}"
              draggable="false" height="220px">
            @else
            <img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads/default-shelter.png')}}" draggable="false"
              height="220px">
            @endif
          </div>
          <div class="card-body pl-0 pr-0">            
                @if($shelter['property_type'] == 'House/Flat')
                <span class="green-title pb-3 font-weight-bold">
                    @if($shelter['is_verified'] == '1')
                        <img src="{{URL::asset('images/verified_icon.png')}}" alt="Logo" class="shield-img pr-2" draggable="false">
                        Verified
                        <span class="dot pl-2 pr-2">&bull;</span>
                    @endif
                    {{$shelter['flat_type']}} BHK
                    <span class="dot pl-2 pr-2">.</span>{{$shelter['property_feature'] == 1 ? 'Independent Floor' : ($shelter['property_feature'] == 2 ? 'Appartment' :
                      ($shelter['property_feature'] == 3 ? 'Independent Villa' : ($shelter['property_feature'] == 4 ? $shelter['other_property_feature'] : '')))}}
                    @if($shelter['flat_size'] != NULL)
                      <span class="dot pl-2 pr-2">&bull;</span>{{$shelter['flat_size']}} Sq.ft
                    @endif
                </span>
                <p class="addres mt-3 pb-0 font-weight-bold">
                    <span>{{$shelter['flat_type']}} BHK </span>
                    <span>{{$shelter['locality']}}, {{$shelter['city']}}</span>
                </p>
                <p>
                    <span class="blue-title font-weight-bold">&#x20B9; {{$shelter['expected_rent']}} / MONTH</span>
                    <span class="avil-cl float-right"> Available Now </span>
                </p>
                @else
                  <span class="green-title pb-3 font-weight-bold">
                    @if($shelter['is_verified'] == '1')
                          <img src="{{URL::asset('images/verified_icon.png')}}" alt="Logo" class="shield-img pr-2" draggable="false">
                          Verified
                          <span class="dot pl-2 pr-2">&bull;</span>
                    @endif
                    {{$shelter['sharing_type']}} BED <span class="dot pl-2 pr-2">.</span><span>PG/Room </span>
                    @if($shelter['flat_size'] != NULL)
                    <span class="dot pl-2 pr-2">&bull;</span>{{$shelter['flat_size']}} Sq.ft
                    @endif
                </span>
                    <p class="addres mt-3 pb-0 font-weight-bold">
                        <span>{{$shelter['sharing_type']}} BED </span>
                        <span>{{$shelter['locality']}}, {{$shelter['city']}}</span>
                    </p>
                    <p>
                        <span class="blue-title font-weight-bold">&#x20B9; {{$shelter['expected_rent']}} / MONTH</span>
                        <span class="avil-cl float-right"> Available Now </span>
                    </p>
                @endif
            </div>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <div class="row mt-4 mb-4">
      <div class="col">
        <h4 class="text-capitalize text-center text-muted">Sorry! No shelters found meeting this search criterion.</h4>
      </div>
    </div>
    @endif
    <div class="col-lg-12 pb-5">
      <div class="col-12 mx-auto" style="margin-bottom: 20px;">
        <div>{{ $shelters->appends(request()->query())->links() }}</div>
      </div>
    </div>
  </div>
</section>

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
  var query = window.location.search;
  if(query != ""){
    $("#mapview").attr("href", `{{url('/listing-map')}}${query}`);
  }
  /*$('#available_date').datepicker({
    uiLibrary: 'bootstrap4',
    minDate: function () {
      var date = new Date();
      date.setDate(date.getDate());
      return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    }
  }); */
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

@endsection