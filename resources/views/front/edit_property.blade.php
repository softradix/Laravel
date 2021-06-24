@extends('layouts.appFront')
@section('breadcrumb_title')
Edit Property
@endsection
@section('content')
<style>
  .error{
    border : 1px solid #ff0000 !important;
  } 
</style>
<section id="My-Property">
  <div class="container box-row mt-5 pb-4">
    <div class="row">
      <div class="col-lg-12">
        <h4 class="font-weight-bold text-center pt-5">Edit Your Shelter</h4>
      </div>
    </div>

    <form name="addShelterForm" class="form-register" action="{{url('/editShelter')}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <input type="hidden" name="shelterId" value="{{$shelter->id}}">
      <div id="form-total">
        <div class="row">
          <div class="col-lg-12">
            <p class="font-weight-bold text-center">Shelter Details</p>
          </div>
        </div>
        <!-- SECTION 1 -->
        <h2></h2>
        <section>
          <div class="inner">
            <div class="row pl-3">
              <div class="col-lg-12 mt-4">
                <p class=" font-weight-bold">Shelter Type<span class="text-danger font-weight-bold"> * </span></p>
              </div>
            </div>
            <div class="row pl-3">
              <div class="col-lg-12">
                <div class="stv-radio-buttons-wrapper">
                  <input type="radio" class="stv-radio-button" name="property_type" value="House/Flat" id="house_flat"
                    {{ $shelter->property_type == 'House/Flat' ? 'checked' : ''}} />
                  <label for="house_flat">Flat/House</label>
                  <input type="radio" class="stv-radio-button" name="property_type" value="Pg/Room" id="pg_room"
                    {{ $shelter->property_type == 'Pg/Room' ? 'checked' : ''}} />
                  <label for="pg_room">PG/Room</label>
                </div>
              </div>
            </div>

            <div class="row pl-3 hf">
              <div class="col-lg-12 mt-4">
                <p class=" font-weight-bold">Flat Type<span class="text-danger font-weight-bold"> * </span></p>
              </div>
            </div> 
            <div class="row pl-3 hf">
              <div class="col-lg-12">
                <div class="stv-radio-buttons-wrapper">
                  <input type="radio" class="stv-radio-button" name="property_feature" value="5" id="button7"
                    {{ isset($shelter->property_feature) && $shelter->property_feature == '5' ? 'checked' : ''}} />
                  <label for="button7">Independent Room</label>
                  <input type="radio" class="stv-radio-button" name="property_feature" value="2" id="button3"
                    {{ isset($shelter->property_feature) && $shelter->property_feature == '2' ? 'checked' : ''}} />
                  <label for="button3">Appartment</label>
                  <input type="radio" class="stv-radio-button" name="property_feature" value="1" id="button4"
                    {{ isset($shelter->property_feature) && $shelter->property_feature == '1' ? 'checked' : ''}} />
                  <label for="button4">Independent Floor</label>
                  <input type="radio" class="stv-radio-button" name="property_feature" value="3" id="button5"
                    {{ isset($shelter->property_feature) && $shelter->property_feature == '3' ? 'checked' : ''}} />
                  <label for="button5">Independent Villa</label>
                  <input type="radio" class="stv-radio-button" name="property_feature" value="4" id="button6"
                    {{ isset($shelter->property_feature) && $shelter->property_feature == '4' ? 'checked' : ''}} />
                  <label for="button6">Other</label>
                </div>
              </div>
            </div>
            <div class="row pl-3 {{isset($shelter->property_feature) && $shelter->property_feature == '4' && isset($shelter->other_property_feature)? '' : 'd-none'}} hf hf-other mt-4">
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="other_property_feature" class="age-title">Mention other shelter feature here<span class="text-danger font-weight-bold">
                      * </span></label>
                  <input type="text" class="form-control input-cl pl-0" name="other_property_feature" id="other_property_feature"
                    placeholder="Other Property Feature" value="{{isset($shelter->other_property_feature) ? $shelter->other_property_feature : ''}}">
                </div>
              </div>
            </div>
            <div class="row pl-3">
              <div class="col-lg-12 mt-5">
                <p class=" font-weight-bold mb-0">Looking For<span class="text-danger font-weight-bold"> * </span></p>
              </div>
            </div>
            <div class="row pl-3">
              <div class="col-lg-4 mt-4">
                <div class="stv-radio-buttons-wrapper">
                  <input type="radio" class="stv-radio-button" name="looking_for" value="1" id="button11"
                    {{ isset($shelter->looking_for) && $shelter->looking_for == '1' ? 'checked' : ''}} />
                  <label for="button11">Male</label>
                  <input type="radio" class="stv-radio-button" name="looking_for" value="2" id="button21"
                    {{ isset($shelter->looking_for) && $shelter->looking_for == '2' ? 'checked' : ''}} />
                  <label for="button21">Female</label>
                  <input type="radio" class="stv-radio-button" name="looking_for" value="3" id="button31"
                    {{ isset($shelter->looking_for) && $shelter->looking_for == '3' ? 'checked' : ''}} />
                  <label for="button31" class="hf">Family</label>
                </div>
              </div>
              <div class="col-lg-4 mt-3 mt-lg-0">
                <div class="form-group">
                  <label for="exampleInputEmail1" class="age-title">Age of building</label><label class="year-title">Years</label>
                  @php $i = 0; @endphp
                  <select name="building_age" id="building_age" class="form-control input-cl pl-0">
                    <option value="" disabled>Select building age</option>
                    <option value="0"
                      {{isset($shelter->building_age) && $shelter->building_age == $i ? 'selected' : ''}}>Below 1 year</option>
                    @while(++$i < 100) <option value="{{$i}}"
                      {{isset($shelter->building_age) && $shelter->building_age == $i ? 'selected' : ''}}>{{$i}}</option>
                      @endwhile
                  </select>
                  <!-- <input type="number" class="form-control input-cl pl-0" name="building_age" id="building_age" value="{isset($shelter->building_age) ? $shelter->building_age : ''}}"
                    placeholder="8"> -->
                </div>
              </div>
              <div class="col-lg-4 ">
                <div class="form-group">
                  <label class="d-block">Floor Number</label>
                  <div class="stv-radio-buttons-wrapper">
                    <input type="radio" class="stv-radio-button" name="no_of_floor" value="0" id="button210"
                      {{ isset($shelter->no_of_floor) && $shelter->no_of_floor == '0' ? 'checked' : ''}} />
                    <label for="button210">0</label>
                    <input type="radio" class="stv-radio-button" name="no_of_floor" value="1" id="button123"
                      {{ isset($shelter->no_of_floor) && $shelter->no_of_floor == '1' ? 'checked' : ''}} />
                    <label for="button123">1</label>
                    <input type="radio" class="stv-radio-button" name="no_of_floor" value="2" id="button213"
                      {{ isset($shelter->no_of_floor) && $shelter->no_of_floor == '2' ? 'checked' : ''}} />
                    <label for="button213">2</label>
                    <input type="radio" class="stv-radio-button" name="no_of_floor" value="3" id="button313"
                      {{ isset($shelter->no_of_floor) && $shelter->no_of_floor == '3' ? 'checked' : ''}} />
                    <label for="button313">3</label>
                    <input type="radio" class="stv-radio-button" name="no_of_floor" value="4" id="button314"
                      {{ isset($shelter->no_of_floor) && $shelter->no_of_floor == '4' ? 'checked' : ''}} />
                    <label for="button314">4</label>
                    <input type="radio" class="stv-radio-button" name="no_of_floor" value="5" id="button315"
                      {{ isset($shelter->no_of_floor) && $shelter->no_of_floor == '5' ? 'checked' : ''}} />
                    <label for="button315">5</label>
                    <input type="radio" class="stv-radio-button" name="no_of_floor" value="6" id="button316"
                      {{ isset($shelter->no_of_floor) && $shelter->no_of_floor == '6' ? 'checked' : ''}} />
                    <label for="button316">6</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row pl-3 hf">
              <div class="col-lg-12 mt-3">
                <p class=" font-weight-bold mb-0">Flat Layout<span class="text-danger font-weight-bold"> * </span></p>
              </div>
            </div>
            <div class="row pl-3">
              <div class="col-lg-4 mt-4 hf">
                <div class="stv-radio-buttons-wrapper">
                  <input type="radio" class="stv-radio-button" name="flat_type" value="5" id="button1bk"
                    {{ isset($shelter->flat_type) && $shelter->flat_type == '5' ? 'checked' : ''}} />
                  <label for="button1bk">1 BK</label>
                  <input type="radio" class="stv-radio-button" name="flat_type" value="1" id="button1bhk"
                    {{ isset($shelter->flat_type) && $shelter->flat_type == '1' ? 'checked' : ''}} />
                  <label for="button1bhk">1 BHK</label>
                  <input type="radio" class="stv-radio-button" name="flat_type" value="2" id="button2bhk"
                    {{ isset($shelter->flat_type) && $shelter->flat_type == '2' ? 'checked' : ''}} />
                  <label for="button2bhk">2 BHK</label>
                  <input type="radio" class="stv-radio-button" name="flat_type" value="3" id="button3bhk"
                    {{ isset($shelter->flat_type) && $shelter->flat_type == '3' ? 'checked' : ''}} />
                  <label for="button3bhk">3 BHK</label>
                  <input type="radio" class="stv-radio-button" name="flat_type" value="4" id="button4bhk"
                    {{ isset($shelter->flat_type) && $shelter->flat_type == '4' ? 'checked' : ''}} />
                  <label for="button4bhk">4 BHK</label>
                </div>
              </div>
              <div class="col-lg-4 mt-3 mt-lg-0 hf">
                <div class="form-group">
                  <label for="flat_size" class="age-title">Size of flat<span class="text-danger font-weight-bold">
                  </span></label><label class="year-title">Sq
                    ft.</label>
                  <input type="number" class="form-control input-cl pl-0" name="flat_size" id="flat_size" value="{{isset($shelter->flat_size) ? $shelter->flat_size : ''}}"
                    placeholder="8">
                </div>
              </div>
              <div class="col-lg-4 ">
                <div class="form-group hf">
                  <label class="d-block">Number of Washroom</label>
                  <div class="stv-radio-buttons-wrapper">
                    <input type="radio" class="stv-radio-button" name="no_of_washroom" value="1" id="button323"
                      {{ isset($shelter->no_of_washroom) && $shelter->no_of_washroom == '1' ? 'checked' : ''}} />
                    <label for="button323">1</label>
                    <input type="radio" class="stv-radio-button" name="no_of_washroom" value="2" id="button3333"
                      {{ isset($shelter->no_of_washroom) && $shelter->no_of_washroom == '2' ? 'checked' : ''}} />
                    <label for="button3333">2</label>
                    <input type="radio" class="stv-radio-button" name="no_of_washroom" value="3" id="button413"
                      {{ isset($shelter->no_of_washroom) && $shelter->no_of_washroom == '3' ? 'checked' : ''}} />
                    <label for="button413">3</label>
                    <input type="radio" class="stv-radio-button" name="no_of_washroom" value="4" id="button514"
                      {{ isset($shelter->no_of_washroom) && $shelter->no_of_washroom == '4' ? 'checked' : ''}} />
                    <label for="button514">4</label>
                    <input type="radio" class="stv-radio-button" name="no_of_washroom" value="5" id="button614" />
                    <label for="button614">5</label>
                    <input type="radio" class="stv-radio-button" name="no_of_washroom" value="6" id="button714" />
                    <label for="button714">6</label>
                  </div>
                </div>

              </div>
            </div>
            <div class="row pl-3">
              <div class="col-lg-4 mt-4 hf">
                <p class="font-weight-bold">Furniture<span class="text-danger font-weight-bold"> *
                  </span></p>
                <div class="stv-radio-buttons-wrapper">
                  <input type="radio" class="stv-radio-button" name="furniture" value="1" id="furniture"
                    {{ isset($shelter->furniture) && $shelter->furniture == '1' ? 'checked' : ''}} />
                  <label for="furniture">Furnished</label>
                  <input type="radio" class="stv-radio-button" name="furniture" value="3" id="buttonSemi-Furnished"
                    {{ isset($shelter->furniture) && $shelter->furniture == '3' ? 'checked' : ''}} />
                  <label for="buttonSemi-Furnished">Semi - Furnished</label>
                  <input type="radio" class="stv-radio-button" name="furniture" value="2" id="buttonNon-Furnished"
                    {{ isset($shelter->furniture) && $shelter->furniture == '2' ? 'checked' : ''}} />
                  <label for="buttonNon-Furnished">Non - Furnished</label>
                </div>
              </div>
              <div class="col-lg-4 mt-4 family-select">
                <p class="font-weight-bold">Preferred Guest<span class="text-danger font-weight-bold"> *
                  </span></p>
                <div class="stv-radio-buttons-wrapper">
                  <input type="radio" class="stv-radio-button" name="guest_preferred" value="1" id="buttonStudent"
                    {{ isset($shelter->guest_preferred) && $shelter->guest_preferred == '1' ? 'checked' : ''}} />
                  <label for="buttonStudent">Student</label>
                  <input type="radio" class="stv-radio-button" name="guest_preferred" value="2" id="buttonProfessional"
                    {{ isset($shelter->guest_preferred) && $shelter->guest_preferred == '2' ? 'checked' : ''}} />
                  <label for="buttonProfessional">Professional</label>
                  <input type="radio" class="stv-radio-button" name="guest_preferred" value="3" id="buttonFamily"
                    {{ isset($shelter->guest_preferred) && $shelter->guest_preferred == '3' ? 'checked' : ''}} />
                  <label for="buttonFamily">Both</label>
                </div>
              </div>
              <div class="col-lg-4 mt-4 pgr">
                <div class="form-group">
                  <label class="d-block">Type of sharing</label>
                  <div class="stv-radio-buttons-wrapper">
                    <input type="radio" class="stv-radio-button" name="sharing_type" value="1" id="button1232"
                      {{ isset($shelter->sharing_type) && $shelter->sharing_type == '1' ? 'checked' : ''}} />
                    <label for="button1232">1 bed</label>
                    <input type="radio" class="stv-radio-button" name="sharing_type" value="2" id="button2132"
                      {{ isset($shelter->sharing_type) && $shelter->sharing_type == '2' ? 'checked' : ''}} />
                    <label for="button2132">2 bed</label>
                    <input type="radio" class="stv-radio-button" name="sharing_type" value="3" id="button3132"
                      {{ isset($shelter->sharing_type) && $shelter->sharing_type == '3' ? 'checked' : ''}} />
                    <label for="button3132">3 bed</label>
                    <input type="radio" class="stv-radio-button" name="sharing_type" value="4" id="button3142"
                      {{ isset($shelter->sharing_type) && $shelter->sharing_type == '4' ? 'checked' : ''}} />
                    <label for="button3142">4 bed</label>
                    <input type="radio" class="stv-radio-button" name="sharing_type" value="5" id="button3152"
                      {{ isset($shelter->sharing_type) && $shelter->sharing_type == '5' ? 'checked' : ''}} />
                    <label for="button3152">5 bed</label>
                    <input type="radio" class="stv-radio-button" name="sharing_type" value="6" id="button3162"
                      {{ isset($shelter->sharing_type) && $shelter->sharing_type == '6' ? 'checked' : ''}} />
                    <label for="button3162">6 bed</label>
                  </div>
                </div>
              </div>
              <input type="hidden" class="stv-radio-button" name="no_of_beds" value="0" id="no_of_bed1" />
              <!--div class="col-lg-4 mt-4 pgr">
                <div class="form-group">
                  <label class="d-block">Number of Beds Available</label>
                  <div class="stv-radio-buttons-wrapper">
                    <input type="radio" class="stv-radio-button" name="no_of_beds" value="1" id="no_of_bed1"
                      {{ isset($shelter->no_of_beds) && $shelter->no_of_beds == '1' ? 'checked' : ''}} />
                    <label for="no_of_bed1">1 bed</label>
                    <input type="radio" class="stv-radio-button" name="no_of_beds" value="2" id="no_of_bed2"
                      {{ isset($shelter->no_of_beds) && $shelter->no_of_beds == '2' ? 'checked' : ''}} />
                    <label for="no_of_bed2">2 bed</label>
                    <input type="radio" class="stv-radio-button" name="no_of_beds" value="3" id="no_of_bed3"
                      {{ isset($shelter->no_of_beds) && $shelter->no_of_beds == '3' ? 'checked' : ''}} />
                    <label for="no_of_bed3">3 bed</label>
                    <input type="radio" class="stv-radio-button" name="no_of_beds" value="4" id="no_of_bed4"
                      {{ isset($shelter->no_of_beds) && $shelter->no_of_beds == '4' ? 'checked' : ''}} />
                    <label for="no_of_bed4">4 bed</label>
                    <input type="radio" class="stv-radio-button" name="no_of_beds" value="5" id="no_of_bed5"
                      {{ isset($shelter->no_of_beds) && $shelter->no_of_beds == '5' ? 'checked' : ''}} />
                    <label for="no_of_bed5">5 bed</label>
                    <input type="radio" class="stv-radio-button" name="no_of_beds" value="6" id="no_of_bed6"
                      {{ isset($shelter->no_of_beds) && $shelter->no_of_beds == '6' ? 'checked' : ''}} />
                    <label for="no_of_bed6">6 bed</label>
                  </div>
                </div>
              </div-->
            </div>

            <div class="row pl-3">
              <div class="col-lg-4 mt-4 pgr">
                <div class="form-group pgr">
                  <p class="font-weight-bold">Food<span class="text-danger font-weight-bold"> * </span></p>
                  <div class="stv-radio-buttons-wrapper">
                    <input type="radio" class="stv-radio-button" name="food" value="1" id="buttonfood"
                      {{ isset($shelter->food) && $shelter->food == '1' ? 'checked' : ''}} />
                    <label for="buttonfood">With food</label>
                    <input type="radio" class="stv-radio-button" name="food" value="0" id="buttonWithout"
                      {{ isset($shelter->food) && $shelter->food == '0' ? 'checked' : ''}} />
                    <label for="buttonWithout">Without food</label>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mt-4 hf">
                <div class="form-group">
                  <label for="member_allowed" class="age-title">Members allowed</label>
                  <input type="number" class="form-control input-cl pl-0" id="member_allowed" name="member_allowed"
                    value="{{isset($shelter->member_allowed) ? $shelter->member_allowed : ''}}" placeholder="4">
                </div>
              </div>
              <div class="col-lg-4 mt-4">
                <div class="form-group">
                  <label for="expected_rent" class="age-title">Expected Rent ( &#8377; )<span class="text-danger font-weight-bold">
                      * </span></label>
                  <input type="number" class="form-control input-cl pl-0" id="expected_rent" name="expected_rent" value="{{isset($shelter->expected_rent) ? $shelter->expected_rent : ''}}"
                    placeholder="4500" required>
                </div>
              </div>
              <div class="col-lg-4 mt-4">
                <div class="form-group">
                  <label for="security_deposit" class="age-title">Security Deposit( &#8377; )<span class="text-danger font-weight-bold">
                      * </span></label>
                  <input type="number" class="form-control input-cl pl-0" id="security_deposit" name="security_deposit"
                    value="{{isset($shelter->security_deposit) ? $shelter->security_deposit : ''}}" placeholder="4500"
                    required>
                </div>
              </div>
            </div>
            <!-- <div class="row pl-3 d-none">
              
              <div class="col-lg-4 mt-4 d-none">
                <div class="form-group payment_month">
                  <label for="payment_month" class="age-title">Date of payment/month</label>
                  <input class="form-control input-cl pl-0" id="payment_month" name="payment_month" value="{{isset($shelter->payment_month) ? date('m/d/Y',strtotime($shelter->payment_month)) : ''}}"
                    placeholder="Every 5th of a month">
                </div>
              </div>
            </div> -->
            <input type="hidden" id="latitude" name="latitude" value="{{$shelter->latitude}}">
            <input type="hidden" id="longitude" name="longitude" value="{{$shelter->longitude}}">
            <input type="hidden" id="location_details" name="location_details" value="">

            <div class="row pl-3">
              <div class="col-lg-12 mt-3">
                <p class=" font-weight-bold mb-0">Locality Details<span class="text-danger font-weight-bold"> * </span></p>
              </div>
            </div>

            <div class="col-lg-12" style="padding-top:20px;">
              <div class="row" id="map_row" style="width:100%; height:300px; margin: 0 auto;" aria-hidden="true" data-toggle="modal" data-target="#myModal" data-lat='{{$shelter->latitude}}' data-lng='{{$shelter->longitude}}'> 
              </div>
            </div>

            {{-- <div class="col-lg-12 mt-4">
              <div class="form-group">
              <div class="row">
               <div class="col-lg-4">
                  <input type="text" class="form-control input-cl pl-0" id="location_ph" name="location_details"
               placeholder="Select Your Location" value="{{$shelter->location_details}}"/>    
                </div>
                <div class="col-sm-1 pl-0">
                  <i class="fa fa-map-marker-alt fa-lg" aria-hidden="true" data-toggle="modal" data-target="#myModal" data-lat='{{$shelter->latitude}}' data-lng='{{$shelter->longitude}}' style="cursor: pointer; color:blue"></i>
                </div>
               </div>
              </div>
            </div> --}}
            
                  <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Point Your Location</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12 modal_body_map">
                        <div class="location-map" id="location-map">
                          <div style="width: 600px; height: 400px;" id="map_canvas"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <h4 class="modal-title"><button class="btn btn-primary" data-dismiss="modal" id ="save_map">Save</button></h4>
                  </div>
                </div>
              </div>
            </div>


            <div class="row pl-3">
              <div class="col-lg-4 mt-4">
                <div class="form-group">
                  <label for="states" class="age-title">State<span class="text-danger font-weight-bold"> * </span></label>
                  <select class="js-example-basic-single form-control input-cl pl-0" required name="states" id="states"
                    data-live-search="true">
                    <option value="" selected disabled>Select State</option>
                    <option value="Punjab" selected>Punjab</option>
                    <!-- foreach ($states as $state)
                        if($state->name== 'Kenmore' || $state->name== 'Narora' || $state->name== 'Natwar' || $state->name== 'Paschim Medinipur' || $state->name== 'Vaishali')
                          continue;
                        endif
                          <option value="{ $state->name }}" { $state->name == $shelter->states ? 'selected' : '' }}>{ $state->name }}</option>
                      endforeach -->
                  </select>
                </div>
              </div>
              <div class="col-lg-4 mt-4">
                <div class="form-group">
                  <label for="city" class="age-title">City<span class="text-danger font-weight-bold"> * </span></label><br>
                  <select class="js-example-basic-single form-control input-cl pl-0 " required id="city" name="city"
                    data-live-search="true">
                    <option value="Mohali" selected>Mohali</option>
                    <!-- <option value="{$shelter->city}}" selected>{$shelter->city}}</option> -->
                  </select>

                </div>
              </div>
              <div class="col-lg-4 mt-4">
                <div class="form-group">
                  <label for="locality" class="age-title">Locality<span class="text-danger font-weight-bold"> * </span></label>
                  <input type="text" class="form-control input-cl pl-0" id="locality" name="locality" value="{{isset($shelter->locality) ? $shelter->locality : ''}}"
                    placeholder="Shaam Nagar" required>
                </div>
              </div>
              <div class="col-lg-4 mt-4">
                <div class="form-group">
                  <label for="street" class="age-title">Street/Area<span class="text-danger font-weight-bold"> * </span></label>
                  <input type="text" class="form-control input-cl pl-0" id="street" name="street" value="{{isset($shelter->street) ? $shelter->street : ''}}"
                    placeholder="Sham Nagar" required>
                </div>
              </div>
              <div class="col-lg-4 mt-4">
                <div class="form-group">
                  <label for="pincode" class="age-title">Pin Code</label>
                  <input type="number" class="form-control input-cl pl-0" id="pincode" name="pincode" value="{{isset($shelter->pincode) ? $shelter->pincode : ''}}"
                    placeholder="132103" min="100000" max="999999" onKeyPress="if(this.value.length==6) return false;">
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- SECTION 2 -->
        <h2></h2>
        <section>
          <div class="inner">
            <div class="row pl-3">
              <div class="col-lg-12 mt-3">
                <p class=" font-weight-bold mb-0">Amenities</p>
              </div>
            </div>
            <div class="row mt-4 pl-4">
              <div class="col-lg-3 col-6 nonfur-select">
                <ul class="chec-radio pl-0">
                  <li class="pz">
                    <label class="radio-inline">
                      <input type="checkbox" id="pro-chx-residential" name="amenities[]" class="pro-chx" value="1"
                        {{isset($shelter->amenities) && in_array('1',$shelter->amenities) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/cupboard.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
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
                      <input type="checkbox" id="pro-chx-residential" name="amenities[]" class="pro-chx" value="2"
                        {{isset($shelter->amenities) && in_array('2',$shelter->amenities) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/lift.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
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
                      <input type="checkbox" id="pro-chx-residential" name="amenities[]" class="pro-chx" value="3"
                        {{isset($shelter->amenities) && in_array('3',$shelter->amenities) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/bath.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
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
                      <input type="checkbox" id="pro-chx-residential" name="amenities[]" class="pro-chx" value="4"
                        {{isset($shelter->amenities) && in_array('4',$shelter->amenities) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/geyser.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
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
                      <input type="checkbox" id="pro-chx-residential" name="amenities[]" class="pro-chx" value="5"
                        {{isset($shelter->amenities) && in_array('5',$shelter->amenities) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/ac.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
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
                      <input type="checkbox" id="pro-chx-residential" name="amenities[]" class="pro-chx" value="6"
                        {{isset($shelter->amenities) && in_array('6',$shelter->amenities) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/tv.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
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
                      <input type="checkbox" id="pro-chx-residential" name="amenities[]" class="pro-chx" value="7"
                        {{isset($shelter->amenities) && in_array('7',$shelter->amenities) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/wifi.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
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
                      <input type="checkbox" id="pro-chx-residential" name="amenities[]" class="pro-chx" value="8"
                        {{isset($shelter->amenities) && in_array('8',$shelter->amenities) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/laundary.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
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
                      <input type="checkbox" id="pro-chx-residential" name="amenities[]" class="pro-chx" value="9"
                        {{isset($shelter->amenities) && in_array('9',$shelter->amenities) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/ro-water.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
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
                      <input type="checkbox" id="pro-chx-residential" name="amenities[]" class="pro-chx" value="10"
                        {{isset($shelter->amenities) && in_array('10',$shelter->amenities) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/parking.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
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
                      <input type="checkbox" id="pro-chx-residential" name="amenities[]" class="pro-chx" value="11"
                        {{isset($shelter->amenities) && in_array('11',$shelter->amenities) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/cooler.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
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
                      <input type="checkbox" id="pro-chx-residential" name="amenities[]" class="pro-chx" value="12"
                        {{isset($shelter->amenities) && in_array('12',$shelter->amenities) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/sleeping-mattress.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
                          <img src="{{URL::asset('images/icon/icon-white/sleeping-mattress-white.png')}}" draggable="false">
                        </div>
                      </div>
                      <span class="title-ameni pl-3">Sleeping Matress</span>
                    </label>
                  </li>
                </ul>
              </div>

              <div class="col-lg-3 col-6 nonfur-select">
                <ul class="chec-radio pl-0">
                  <li class="pz">
                    <label class="radio-inline">
                      <input type="checkbox" id="pro-chx-residential" name="amenities[]" class="pro-chx" value="13"
                        {{isset($shelter->amenities) && in_array('13',$shelter->amenities) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/power.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
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
                      <input type="checkbox" id="pro-chx-residential" name="amenities[]" class="pro-chx" value="14"
                        {{isset($shelter->amenities) && in_array('14',$shelter->amenities) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/balcony.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
                          <img src="{{URL::asset('images/icon/icon-white/balcony-white.png')}}" draggable="false">
                        </div>
                      </div>
                      <span class="title-ameni pl-3">Balcony</span>
                    </label>
                  </li>
                </ul>
              </div>
            </div>
            <div class="row pl-3 pgr">
              <div class="col-lg-12 mt-3">
                <p class=" font-weight-bold mb-0">Extra charges including rent</p>
              </div>
            </div>
            <div class="row pl-3">
              <div class="col-lg-4 mt-4 hf">
                <div class="form-group">
                  <div class="form-check form-check-inline">
                    <label class="check ">
                      <input type="checkbox" name="electricity_charge" id="electricity_charge" value=""
                        {{$shelter->electricity_charge!='' ? 'checked' : ''}}>
                      <span class="checkmark"></span>
                    </label>
                    <label class="form-check-label" for="electricity_charge">Electricity Charges <small>(as per unit)</small></label>
                  </div>
                  <!-- <label for="electricity_charge" class="age-title">Electricity ( &#8377; )</label>
                  <input type="number" class="form-control input-cl pl-0" id="electricity_charge" name="electricity_charge"
                    value="{isset($shelter->electricity_charge) ? $shelter->electricity_charge : ''}}" placeholder="500"> -->
                </div>
              </div>
              <div class="col-lg-4 mt-4 pgr">
                <div class="form-group">
                  <label for="cleaning_charge" class="age-title">Cleaning ( &#8377; )</label>
                  <input type="number" class="form-control input-cl pl-0" id="cleaning_charge" name="cleaning_charge"
                    value="{{isset($shelter->cleaning_charge) ? $shelter->cleaning_charge : ''}}" placeholder="4500">
                </div>
              </div>
              <div class="col-lg-4 mt-4 pgr">
                <div class="form-group">
                  <label for="wifi_charge" class="age-title">Wifi ( &#8377; )</label>
                  <input type="number" class="form-control input-cl pl-0" id="wifi_charge" name="wifi_charge" value="{{isset($shelter->wifi_charge) ? $shelter->wifi_charge : ''}}"
                    placeholder="500">
                </div>
              </div>
            </div>
            <div class="row pl-3">
              <div class="col-lg-4 mt-4 pgr">
                <div class="form-group">
                  <label for="other_service" class="age-title">Service Name</label>
                  <input type="text" class="form-control input-cl pl-0" id="other_service" name="other_service" value="{{isset($shelter->other_service) ? $shelter->other_service : ''}}"
                    placeholder="Lorem">
                </div>
              </div>
              <div class="col-lg-4 mt-4 pgr">
                <div class="form-group">
                  <label for="other_services_charges" class="age-title">Price ( &#8377; )</label>
                  <input type="number" class="form-control input-cl pl-0" id="other_services_charges" name="other_services_charges"
                    value="{{isset($shelter->other_services_charges) ? $shelter->other_services_charges : ''}}"
                    placeholder="">
                </div>
              </div>
              @if($shelter->property_type == 'Pg/Room')
              <div class="col-lg-4 mt-4 pgr-cylinder">
                <p class=" font-weight-bold mb-0">Cylinder</p>
                <div class="form-check form-check-inline">
                  <label class="check ">
                    <input type="radio" name="cylinder" value='1'
                      {{ isset($shelter->cylinder) && $shelter->cylinder == '1' ? 'checked' : ''}}>
                    <span class="checkmark"></span>
                  </label>
                  <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                </div>
                <div class="form-check form-check-inline mt-3">
                  <label class="check ">
                    <input type="radio" name="cylinder" value='0'
                      {{ isset($shelter->cylinder) && $shelter->cylinder == '0' ? 'checked' : ''}}>
                    <span class="checkmark"></span>
                  </label>
                  <label class="form-check-label" for="inlineCheckbox1">No</label>
                </div>
              </div>
              @endif
            </div>
            <div class="row pl-3">
              <div class="col-lg-12 mt-5 mb-3 mb-lg-0 mt-lg-3">
                <p class=" font-weight-bold mb-0">Rules</p>
              </div>
            </div>
            <div class="row pl-4">
              <div class="col-lg-3 col-6">
                <ul class="chec-radio pl-0">
                  <li class="pz">
                    <label class="radio-inline">
                      <input type="checkbox" id="pro-chx-residential" name="rules[]" class="pro-chx" value="1"
                        {{isset($shelter->rules) && in_array('1',$shelter->rules) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/non-smoking')}}.png" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
                          <img src="{{URL::asset('images/icon/icon-white/non-smoking-white.png')}}" draggable="false">
                        </div>
                      </div>
                      <span class="title-ameni pl-3">Non Smoking</span>
                    </label>
                  </li>
                </ul>
              </div>
              <div class="col-lg-3 col-6">
                <ul class="chec-radio pl-0">
                  <li class="pz">
                    <label class="radio-inline">
                      <input type="checkbox" id="pro-chx-residential" name="rules[]" class="pro-chx" value="2"
                        {{isset($shelter->rules) && in_array('2',$shelter->rules) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/gate.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
                          <img src="{{URL::asset('images/icon/icon-white/gate-white.png')}}" draggable="false">
                        </div>
                      </div>
                      <span class="title-ameni pl-3">Fixed Gate closing time</span>
                    </label>
                  </li>
                </ul>
              </div>
              <div class="col-lg-3 col-6">
                <ul class="chec-radio pl-0">
                  <li class="pz">
                    <label class="radio-inline">
                      <input type="checkbox" id="pro-chx-residential" name="rules[]" class="pro-chx" value="3"
                        {{isset($shelter->rules) && in_array('3',$shelter->rules) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/guardian')}}.png" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
                          <img src="{{URL::asset('images/icon/icon-white/guardian-white')}}.png" draggable="false">
                        </div>
                      </div>
                      <span class="title-ameni pl-3">No Guardian Stay</span>
                    </label>
                  </li>
                </ul>
              </div>
              <div class="col-lg-3 col-6">
                <ul class="chec-radio pl-0">
                  <li class="pz">
                    <label class="radio-inline">
                      <input type="checkbox" id="pro-chx-residential" name="rules[]" class="pro-chx" value="4"
                        {{isset($shelter->rules) && in_array('4',$shelter->rules) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/no-drinking.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
                          <img src="{{URL::asset('images/icon/icon-white/no-drinking-white.png')}}" draggable="false">
                        </div>
                      </div>
                      <span class="title-ameni pl-3">No Drinking</span>
                    </label>
                  </li>
                </ul>
              </div>
            </div>
            <div class="row pl-4">
              <!-- <div class="col-lg-3 col-6">
                <ul class="chec-radio pl-0">
                  <li class="pz">
                    <label class="radio-inline">
                      <input type="checkbox" id="pro-chx-residential" name="rules[]" class="pro-chx" value="5"
                        {isset($shelter->rules) && in_array('5',$shelter->rules) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/girl-boy')}}.png" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
                          <img src="{{URL::asset('images/icon/icon-white/girl-boy-white')}}.png" draggable="false">
                        </div>
                      </div>
                      <span class="title-ameni pl-3">Girl/Boy entry</span>
                    </label>
                  </li>
                </ul>
              </div> -->
              <div class="col-lg-3 col-6">
                <ul class="chec-radio pl-0">
                  <li class="pz">
                    <label class="radio-inline">
                      <input type="checkbox" id="pro-chx-residential" name="rules[]" class="pro-chx" value="6"
                        {{isset($shelter->rules) && in_array('6',$shelter->rules) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/non-veg')}}.png" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
                          <img src="{{URL::asset('images/icon/icon-white/non-veg-white')}}.png" draggable="false">
                        </div>
                      </div>
                      <span class="title-ameni pl-3">No Non-veg</span>
                    </label>
                  </li>
                </ul>
              </div>
              <!-- <div class="col-lg-3 col-6 d-none">
                <ul class="chec-radio pl-0">
                  <li class="pz">
                    <label class="radio-inline">
                      <input type="checkbox" id="pro-chx-residential" name="rules[]" class="pro-chx" value="7"
                        {{isset($shelter->rules) && in_array('7',$shelter->rules) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/iron.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
                          <img src="{{URL::asset('images/icon/icon-white/iron-white.png')}}" draggable="false">
                        </div>
                      </div>
                      <span class="title-ameni pl-3">No Iron</span>
                    </label>
                  </li>
                </ul>
              </div>
              <div class="col-lg-3 col-6 d-none">
                <ul class="chec-radio pl-0">
                  <li class="pz">
                    <label class="radio-inline">
                      <input type="checkbox" id="pro-chx-residential" name="rules[]" class="pro-chx" value="8"
                        {{isset($shelter->rules) && in_array('8',$shelter->rules) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/heater.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
                          <img src="{{URL::asset('images/icon/icon-white/heater-white.png')}}" draggable="false">
                        </div>
                      </div>
                      <span class="title-ameni pl-3">Heater</span>
                    </label>
                  </li>
                </ul>
              </div>
              <div class="col-lg-3 col-6 d-none">
                <ul class="chec-radio pl-0">
                  <li class="pz">
                    <label class="radio-inline">
                      <input type="checkbox" id="pro-chx-residential" name="rules[]" class="pro-chx" value="9"
                        {{isset($shelter->rules) && in_array('9',$shelter->rules) ? 'checked' : ''}}>
                      <div class="clab">
                        <div class="img-ameni">
                          <img src="{{URL::asset('images/icon/icon-black/stove.png')}}" draggable="false">
                        </div>
                        <div class="img-ameni-white d-none">
                          <img src="{{URL::asset('images/icon/icon-white/stove-white.png')}}" draggable="false">
                        </div>
                      </div>
                      <span class="title-ameni pl-3">Electric Stove</span>
                    </label>
                  </li>
                </ul>
              </div> -->
            </div>
            <div class="row mt-4 pl-3 pr-2">
              <div class="col-lg-12">
                <div class="form-group col-lg-4 pl-0">
                  <!-- <label for="title">Title</label> -->
                  <input class="form-control" type="hidden" id="title" name="title" placeholder="Lorem ipsum" value="{{isset($shelter->title) ? $shelter->title : 'dummy title'}}"
                    required>
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="4" placeholder="Lorem ipsum"> {{isset($shelter->description) ? $shelter->description : ''}}</textarea>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- SECTION 3 -->
        <h2></h2>
        <section>
          <div class="inner">
            <div class="row pl-3">
              <div class="col-lg-4 mt-4">
                <div class="form-group">
                  <label for="owner_name" class="age-title font-weight-bold">Owner’s Name<span class="text-danger font-weight-bold">
                      * </span></label>
                  <input type="text" class="form-control input-cl pl-0" id="owner_name" name="owner_name" value="{{isset($shelter->owner_name) ? $shelter->owner_name : ''}}"
                    placeholder="John Doe" required>
                </div>
              </div>
              <div class="col-lg-4 mt-4">
                <div class="form-group">
                  <label for="contact_no" class="age-title font-weight-bold">Contact Number<span class="text-danger font-weight-bold">
                      * </span></label>
                  <input type="number" class="form-control input-cl pl-0" id="contact_no" name="contact_no" value="{{isset($shelter->contact_no) ? $shelter->contact_no : ''}}"
                    placeholder="9851357235" required>
                </div>
              </div>
              <div class="col-lg-4 mt-4">
                <div class="form-group">
                  <label for="email" class="age-title font-weight-bold">Email</label>
                  <input type="email" class="form-control input-cl pl-0" id="email" name="email" value="{{isset($shelter->email) ? $shelter->email : ''}}"
                    placeholder="asd@gmail.com">
                </div>
              </div>
            </div>
            <div class="row pl-3  pt-4">
              <div class="col-lg-4 mt-4">
                <div class="form-group available_date">
                  <label for="available_date" class="age-title font-weight-bold">Availability Date<span class="text-danger font-weight-bold">
                      * </span> &nbsp;&nbsp;<span class='availability-info' data-html="true" data-toggle="tooltip"
                      data-placement="top" title="Date from when this property is available">
                      ? </span>
                  </label>
                  <input type="text" class="form-control input-cl pl-0" id="available_date" name="available_date"
                    placeholder="Property Available from" required value="{{isset($shelter->available_date) ? date('m/d/Y',strtotime($shelter->available_date)) : ''}}">
                </div>
              </div>
            </div>
            <!--div class="col-md-4 pt-3 check-respon">
                <p class=" font-weight-bold mb-0">Appointment Details</p>
                <div class="form-check form-check-inline">
                  <label class="check">
                    <input type="radio" name="appointment" value="1"
                      {{ isset($shelter->appointment) && $shelter->appointment == '1' ? 'checked' : ''}}>
                    <span class="checkmark"></span>
                  </label>
                  <label class="form-check-label" for="inlineCheckbox1">Weekdays</label>
                </div>
                <div class="form-check form-check-inline mt-3">
                  <label class="check ">
                    <input type="radio" name="appointment" value="3"
                      {{ isset($shelter->appointment) && $shelter->appointment == '3' ? 'checked' : ''}}>
                    <span class="checkmark"></span>
                  </label>
                  <label class="form-check-label" for="inlineCheckbox1">Everyday</label>
                </div>
                <br>
                <div class="form-check form-check-inline">
                  <label class="check">
                    <input type="radio" name="appointment" value="2"
                      {{ isset($shelter->appointment) && $shelter->appointment == '2' ? 'checked' : ''}}>
                    <span class="checkmark"></span>
                  </label>
                  <label class="form-check-label" for="inlineCheckbox1">Weekend</label>
                </div>
                <div class="form-check form-check-inline mt-3">
                  <label class="check ">
                    <input type="radio" name="appointment" value="4"
                      {{ isset($shelter->appointment) && $shelter->appointment == '4' ? 'checked' : ''}}>
                    <span class="checkmark"></span>
                  </label>
                  <label class="form-check-label" for="inlineCheckbox1">Select day</label>
                </div>
              </div-->
            <div class="row pl-3  pt-4">
              <div class="col-lg-8 col-md-12">
                <div class="container-fluid">
                  <label class="age-title font-weight-bold">Featured Image<span class="text-danger font-weight-bold"> * </span></label>
                  <div class="row" onchange="galeryimage('featured')" id="feature_resultt">
                    <div class="col col-md-2 col-lg-2 mt-2">
                      <div class="form-group">
                        <label class="label upload-file">
                          <i class="fa fa-plus"></i>
                          <input type="file" accept=".png, .jpg, .jpeg" name="featuredimage" id="featuredimage"
                            required />
                        </label>
                      </div>
                    </div>
                    @if(isset($shelter->featuredimage) && $shelter->featuredimage != NULL && $shelter->featuredimage !=
                    '')
                    <div class="col col-md-2 col-lg-2 mt-2" id="feature_resulttfeatured">
                      <div class="img-upl1">
                        <!-- <i class="fa fa-times close-img"></i> -->
                        <img class="thumbnail" src="{{URL::asset('uploads')}}/{{$shelter->featuredimage}}" draggable="false">
                      </div>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-8 col-md-12">
                <div class="container-fluid">
                  <label class="age-title font-weight-bold">Gallery<span class="text-danger font-weight-bold"> * </span></label>
                  <div class="row">
                    @if(isset($shelter->images) && $shelter->images != '')
                    @php $j = 0; @endphp
                    @foreach($shelter->images as $image)
                    <div class="col col-md-2 col-lg-2 mt-2">
                      <div class="img-upll">
                        <i id="{{$j++}}" class="fa fa-times close-img"></i>
                        <img class="thumbnail" src="{{URL::asset('uploads')}}/{{$image}}" draggable="false">
                      </div>
                    </div>
                    @endforeach
                    @endif
                    </div>
                  <div class="row" onchange="galeryimage('0')" id="resultt">
                    <div class="col col-md-2 col-lg-2 mt-2">
                      <div class="form-group">
                        <label class="label upload-file">
                          <i class="fa fa-plus"></i>
                          <input type="file" accept=".png, .jpg, .jpeg" multiple name="images[]" id="images" />
                        </label>
                      </div>
                    </div> 
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-12" id="chaptAddon"></div>
            </div>
            <div class="alignbttn"><button class="btn btn-primary apnd" type=button style="margin-top: 20px;" id="chaprApnd">Add More Images</button></div>
            <!--div class="row pl-3  pt-4">
              <div class="col-lg-4 mt-4">
                <div class="form-group">
                  <label for="timings_from" class="age-title ">Timing From</label>
                  <input class="form-control input-cl pl-0" id="timings_from" name="timings_from" value="{{isset($shelter->timings_from) ? $shelter->timings_from : ''}}"
                    placeholder="From">
                </div>
              </div>
              <div class="col-lg-4 mt-4">
                <div class="form-group">
                  <label for="timings_to" class="age-title ">Timing To</label>
                  <input class="form-control input-cl pl-0" id="timings_to" name="timings_to" value="{{isset($shelter->timings_to) ? $shelter->timings_to : ''}}"
                    placeholder="To">
                </div>
              </div>
            </div-->
            <input type="hidden" name="removedImages" id="removedImages" value="">
            <div class="row pl-3">
              <div class="col-lg-4 mt-4">
                <div class="form-group">
                  <input type="submit" value="Save" id="editShelter" class="btn top-listing-btn white-color px-5">
                </div>
              </div>
            </div>

          </div>
        </section>
      </div>
    </form>
  </div>
</section>

@include('layouts.footer')

<script>
  $('#editShelter').on('click', function (e) {
    var numOfImages = $('div.img-upl').length;
    if (numOfImages > 0 || $('#images').val() != '') {
      $('#images').prop('required', false);
    }

    var numOfFeaturedImages = $('div.img-upl1').length;
    if (numOfFeaturedImages > 0 || $('#featuredimage').val() != '') {
      $('#featuredimage').prop('required', false);
    }
  });
  $(document).ready(function () {
    $('#payment_month').datepicker({
      uiLibrary: 'bootstrap4'
    });
    $('#available_date').datepicker({
      uiLibrary: 'bootstrap4',
      format: 'dd-mm-yyyy',
      // minDate: function () {
      //   var date = new Date();
      //   date.setDate(date.getDate());
      //   return new Date(date.getFullYear(), date.getMonth(), date.getDate());
      // }
    });

    // $('#timings_from').timepicker({
    //   uiLibrary: 'bootstrap4'
    // });

    // $('#timings_to').timepicker({
    //   uiLibrary: 'bootstrap4'
    // });

    $('.pgr').css('display', 'none');
    if ("{{$shelter->food}}" == 0) {
      $('.pgr-cylinder').show();
    } else {
      $('.pgr-cylinder').hide();
    }

    $('[data-toggle="tooltip"]').tooltip();

    if ($('#house_flat').prop('checked')) {
      $('.hf').show();
      $('.pgr').hide();
      // $('input[name="property_feature"]').click(function(e){
      //   var selected_id = $('input[name="property_feature"]:checked').attr('id')
      // });
      if ($('input[name="property_feature"]').prop('checked')) {
        if (this.value == "4") {
          $('.hf-other').removeClass('d-none');
        } else {
          $('.hf-other').addClass('d-none');
        }
      }

      // $(`#${selected_id}`).prop('checked',true);
      // $('#button1bhk').prop('checked',true);
    } else {
      $('.hf').hide();
      $('.pgr').show();
    }

    $('input[name="property_type"]').click(function (e) {
      if (e.target.id == "house_flat") {
        //Conditionally Required Fields
        $('input[name="property_feature"]').click(function (e) {
          if (e.target.value == "4") {
            $('#other_property_feature').attr('required', 'true');
          } else {
            $('#other_property_feature').removeAttr('required');
          }
        });
        $('.hf-other').addClass('d-none');
        if ($('input[name="property_feature"]').prop('checked')) {
          var selected_id = $('input[name="property_feature"]:checked').attr('id')
          $(`#${selected_id}`).prop('checked', true);
        } else {
          $('#button7').prop('checked', true);
        }

        if ($('input[name="flat_type"]').prop('checked')) {
          var selected_id = $('input[name="flat_type"]:checked').attr('id')
          $(`#${selected_id}`).prop('checked', true);
        } else {
          $('#button1bk').prop('checked', true);
        }

        // $('#button3').prop('checked',true);
        // $('#button1bhk').prop('checked',true);
        $('#buttonfood').prop('checked', false);
        $('#button1232').prop('checked', false);
        $('#buttonStudent').prop('checked', true);
        $('#furniture').prop('checked', true);
        
      } else {
        //Conditionally Required Fields
        if ($('input[name="buttonfood"]').prop('checked')) {
          var selected_id = $('input[name="buttonfood"]:checked').attr('id')
          $(`#${selected_id}`).prop('checked', true);
        } else {
          $('#buttonfood').prop('checked', true);
        }
        // $('#buttonfood').prop('checked',true);
        $('#other_property_feature').removeAttr('required');
        $('#button7').prop('checked', false);
        $('#button1bk').prop('checked', false);
        $('.nonfur-select').show();
        $('#button1232').prop('checked', true);
        $('#buttonStudent').prop('checked', false);
        $('#furniture').prop('checked', false);
      }
    });

    $('input[name="property_feature"]').click(function (e) {
      if (e.target.value == "4") {
        $('.hf-other').removeClass('d-none');
      } else {
        $('.hf-other').addClass('d-none');
      }
    });

    $('#buttonfood').click(function () {
      $('.pgr-cylinder').hide();
    });
    $('#buttonWithout').click(function () {
      $('.pgr-cylinder').show();
    });

    if ($('#buttonNon-Furnished').prop('checked')) {
      $('.nonfur-select').hide();
    }

    if ($('#button31').prop('checked')) {
      $('.family-select').hide();
    }

    $('input[name="looking_for"]').click(function (e) {
      if (e.target.value == "3") {
        $('.family-select').hide();
        $('#buttonStudent').prop('checked', false);
      } else {
        $('.family-select').show();
        $('#buttonStudent').prop('checked', true);
      }
    });

    $('input[name="furniture"]').click(function (e) {
      if (e.target.value == "2") {
        $('.nonfur-select').hide();
      } else {
        $('.nonfur-select').show();
      }
    });

  });

  if ($('#electricity_charge').prop('checked')) {
    $('#electricity_charge').val('As per units');
  }
  else {
    $('#electricity_charge').val('');
  }

  $('#electricity_charge').click(function () {
    if ($('#electricity_charge').prop('checked')) {
      $('#electricity_charge').val('As per units');
    }
    else {
      $('#electricity_charge').val('');
    }
  });
</script>
  <script>
    $(document).ready(function() {
    var map = null;
    var myMarker;
    var myLatlng;
    var newLatlng;
    var myMarker2;
    var map2;
    var newLat;
    var newLng;

    var latt = $('#map_row').attr('data-lat');
    var lngg = $('#map_row').attr('data-lng');

    function initializeGMapOnLoad(latt, lngg) {
       newLatlng = new google.maps.LatLng(latt ,lngg);
    var newOptions = {
        zoom: 17,
        zoomControl: true,
        center: newLatlng,
        disableDefaultUI: true,
        zoomControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };

      map2 = new google.maps.Map(document.getElementById("map_row"), newOptions);
      myMarker2 = new google.maps.Marker({
      position: newLatlng
      });
      myMarker2.setMap(map2);

    }

    initializeGMapOnLoad(latt,lngg);  

    function initializeGMap(lat, lng) {
      myLatlng = new google.maps.LatLng(lat, lng);
  
      var myOptions = {
        zoom: 17,
        zoomControl: true,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
  
      map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
      var geocoder = new google.maps.Geocoder(); 
  
      myMarker = new google.maps.Marker({
        position: myLatlng
      });
      
      myMarker.setMap(map);
      
      google.maps.event.addListener(map, 'click', function(event) {
  
        geocoder.geocode({
        'latLng': event.latLng
        }, function(results, status) { 
          if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
              $('#location_details').attr('value',results[0].formatted_address);
            }
          }
        }
        );
  
        document.getElementById("latitude").value = event.latLng.lat();
        document.getElementById("longitude").value = event.latLng.lng();
        newLat = event.latLng.lat();
        newLng = event.latLng.lng();
        $('#map_row').attr('data-lat', newLat);
        $('#map_row').attr('data-lng', newLng);
        placeMarker(event.latLng);
      }); 
      function placeMarker(location) {
  
      if (myMarker == undefined){
          myMarker = new google.maps.Marker({
              position: location,
              map: map, 
              animation: google.maps.Animation.DROP,
          });
      }
      else{
          myMarker.setPosition(location);
      }
      // map.setCenter(location);
  
    }
  }
    $("#save_map").on("click", function(event){
    newLatlng = new google.maps.LatLng(newLat ,newLng);
    var newOptions = {
          zoom: 17,
          zoomControl: true,
          center: newLatlng,
          disableDefaultUI: true,
          zoomControl: false,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map2 = new google.maps.Map(document.getElementById("map_row"), newOptions);
        myMarker2 = new google.maps.Marker({
        position: newLatlng
        });
        myMarker2.setMap(map2);
        $('#map_row').attr('data-lat', newLat);
        $('#map_row').attr('data-lng', newLng);
      
});

    // Re-init map before show modal
    $('#myModal').on('show.bs.modal', function(event) {

      // var button = $(event.relatedTarget);
      // initializeGMap(button.data('lat'), button.data('lng'));
      var latt = $('#map_row').attr('data-lat');
      var lngg = $('#map_row').attr('data-lng');
      initializeGMap(latt,lngg);
      $("#location-map").css("width", "100%");
      $("#map_canvas").css("width", "100%");
    });
  
    // Trigger map resize event after modal shown
    $('#myModal').on('shown.bs.modal', function() {
      google.maps.event.trigger(map, "resize");
      map.setCenter(myLatlng);
    });
    
  });
  </script>
@endsection