@extends('layouts.appFront')
 
@section('content')

  <section id="featured-rooms" class="pt-5">
    <div class="container">
      <div class="row">
        <div class="col mb-5 mt-3 ml-2">
          <h5 class="top-heading-text semi-bold">Featured Shelters <?php if($featuredroomscount>0){ echo '('.$featuredroomscount.')'; } ?></h5>
        </div>
        <div class="col">
          
          <div class="customNavigation pt-2 ml-2">
            <a id="prev" class="btn prev"><img src="{{URL::asset('images/left-arrow.png')}}"></a>
            <a id="next" class="btn next"><img src="{{URL::asset('images/right-arrow.png')}}"></a>
          </div>
        </div>
      </div>
    </div> 
    
    <div class="container d-none d-md-none d-lg-block">
      @if($featuredroomscount > 4 || $featuredroomscount == 0)
      <div class="owl-carousel oc-one">
      @else
      <div class="row">
      @endif
        @foreach($featuredrooms as $shelter)
        @if($featuredroomscount > 4 || $featuredroomscount == 0)
        <div class="card">
        @else
           <div class="card col-md-3" style="margin-left:0px; margin-right:0px;">
        @endif
          <div class="card-head list_tile" id="bx-ht" data-id="{{$shelter->id}}">
            @if(file_exists(public_path('/uploads/').$shelter->img) && $shelter->img!='')
            <img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads')}}/{{$shelter->img ? $shelter->img : 'default-shelter.png'}}"
              draggable="false" height="220px">
            @else
            <img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads/default-shelter.png')}}" draggable="false" height="220px">
            @endif
          </div>
          <div class="card-body px-0 py-4">
            <div class="room-header">
              <h6 class="card-title mb-2">
              @if($shelter->property_type == 'House/Flat')
                  {{ $shelter->flat_type}} BHK Flat available in {{$shelter->city}}, {{$shelter->state}}
              @else
                  {{ $shelter->sharing_type}} beds sharing PG available in {{$shelter->city}}, {{$shelter->state}}
              @endif  
              </h6>
              <span class="card-subtitle">₹ {{$shelter->expected_rent}} / month</span>
            </div>
          </div>
        </div>  
        @endforeach
      </div>
    </div>    

    <div class="container d-block d-md-block d-lg-none">

      <div class="owl-carousel oc-one">

        @foreach($featuredrooms as $shelter)
        <div class="card">
          <div class="card-head list_tile" id="bx-ht" data-id="{{$shelter->id}}">
            @if(file_exists(public_path('/uploads/').$shelter->img) && $shelter->img!='')
            <img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads')}}/{{$shelter->img ? $shelter->img : 'default-shelter.png'}}"
              draggable="false" height="220px">
            @else
            <img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads/default-shelter.png')}}" draggable="false" height="220px">
            @endif
          </div>
          <div class="card-body px-0 py-4">
            <div class="room-header">
              <h6 class="card-title mb-2">
              @if($shelter->property_type == 'House/Flat')
                  {{ $shelter->flat_type}} BHK Flat available in {{$shelter->city}}, {{$shelter->state}}
              @else
                  {{ $shelter->sharing_type}} beds sharing PG available in {{$shelter->city}}, {{$shelter->state}}
              @endif  
              </h6>
              <span class="card-subtitle">₹ {{$shelter->expected_rent}} / month</span>
            </div>
          </div>
        </div>  
        @endforeach
      </div>
    </div>    

    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-12 mt-5 mx-auto text-center">
          @if($featuredroomscount > 0)
            <button class="btn see-more-btn white-color px-4" onclick="searchshelter('2','1')" type="button">See More Listings</button>
          @else
            <button class="btn see-more-btn white-color px-4" onclick="searchshelter('1','0')" type="button">See More Listings</button>
          @endif
        </div>
      </div>
    </div>
  </section>
  <section id="top-places" class="pt-3">
    <div class="container pt-3">
      <div class="row">
        <div class="col mb-5 mt-3 ml-2">
          <h5 class="top-heading-text semi-bold">Top Places <?php if($topplacescount>0){ echo '('.$topplacescount.')'; } ?></h5>
        </div>
        <div class="col">          
          <div class="customNavigation pt-2 ml-2">
            <a id="prev2" class="btn prev"><img src="{{URL::asset('images/left-arrow.png')}}"></a>
            <a id="next2" class="btn next"><img src="images/right-arrow.png"></a>
          </div>
        </div>
      </div>
    </div>
    <div class="container d-none d-md-none d-lg-block">
       @if($topplacescount > 4 || $topplacescount == 0)
      <div class="owl-carousel oc-two">
      @else
      <div class="row">
      @endif
        @foreach($topplaces as $top_shelter)
        @if($topplacescount > 4 || $topplacescount == 0)
        <div class="card">
        @else
           <div class="card col-md-3" style="margin-left:0px; margin-right:0px;">
        @endif
          <div class="card-head list_tile" id="bx-ht" data-id="{{$top_shelter->id}}">
            @if(file_exists(public_path('/uploads/').$top_shelter->img) && $top_shelter->img!='')
            <img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads')}}/{{$top_shelter->img ? $top_shelter->img : 'default-shelter.png'}}"
              draggable="false" height="220px">
            @else
            <img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads/default-shelter.png')}}" draggable="false" height="220px">
            @endif
          </div>
          <div class="card-body px-0 py-4">
            <div class="room-header">
              <h6 class="card-title mb-2">
                @if($top_shelter->property_type == 'House/Flat')
                  {{ $top_shelter->flat_type}} BHK Flat available in {{$top_shelter->city}}, {{$top_shelter->state}}
              @else
                  {{ $top_shelter->sharing_type}} beds sharing PG available in {{$top_shelter->city}}, {{$top_shelter->state}}
              @endif 
              </h6>
              <span class="card-subtitle">₹ {{$top_shelter->expected_rent}} / month</span>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <div class="container d-block d-md-block d-lg-none">
      <div class="owl-carousel oc-two">
      
        @foreach($topplaces as $top_shelter)
        <div class="card">
        
          <div class="card-head list_tile" id="bx-ht" data-id="{{$top_shelter->id}}">
            @if(file_exists(public_path('/uploads/').$top_shelter->img) && $top_shelter->img!='')
            <img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads')}}/{{$top_shelter->img ? $top_shelter->img : 'default-shelter.png'}}"
              draggable="false" height="220px">
            @else
            <img id="bx-ht-hght" class="img-rounded" src="{{URL::asset('uploads/default-shelter.png')}}" draggable="false" height="220px">
            @endif
          </div>
          <div class="card-body px-0 py-4">
            <div class="room-header">
              <h6 class="card-title mb-2">
                @if($top_shelter->property_type == 'House/Flat')
                  {{ $top_shelter->flat_type}} BHK Flat available in {{$top_shelter->city}}, {{$top_shelter->state}}
              @else
                  {{ $top_shelter->sharing_type}} beds sharing PG available in {{$top_shelter->city}}, {{$top_shelter->state}}
              @endif 
              </h6>
              <span class="card-subtitle">₹ {{$top_shelter->expected_rent}} / month</span>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-12 mt-5 mx-auto text-center">
          @if($topplacescount > 0)
            <button class="btn see-more-btn white-color px-4" onclick="searchshelter('2','2')" type="button">See More Listings</button>
          @else
            <button class="btn see-more-btn white-color px-4" onclick="searchshelter('1','0')" type="button">See More Listings</button>
          @endif
        </div>
      </div>
    </div>
  </section>
  <section id="how-it-works">
    <div class="container pt-5">
      <div class="row">
        <div class="col mb-5 mt-3 ml-2">
          <h5 class="top-heading-text semi-bold">How it Works</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 text-center text-lg-left">
          <img src="{{URL::asset('images/hiw-homes.png')}}" draggable="false" class="img-fluid">
        </div>
        <div class="col-lg-6 text-center text-lg-left">
          <div class="pt-5 pl-0 pl-lg-5 mt-5">
            <h5 class="search-nd-find semi-bold pt-4 mt-2">Search & Find Your Shelter</h5>
            <span class="d-block mt-4 pt-4">SHELLPAR provides you a convenient result on behalf of your search, so that you can find your shelter with all your essential requirements for FREE.</span>
            <button class="btn top-listing-btn white-color px-4 mt-4" onclick="searchshelter('1','0')" type="button">Search Listing</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="meet-landlord">
    <div class="container pt-5 text-center text-lg-left">
      <div class="row mt-5">
        <div class="col-lg-5 ml-auto order-lg-1 order-md-2 order-2">
          <div class="pt-5 mt-5">
            <h5 class="semi-bold pt-4 mt-2">Meet Owner</h5>
            <span class="d-block mt-4 pt-4">After selecting the shelter, then you can get owner details for FREE by signing In. Make sure you properly check and confirm details with owner before visiting and finalizing it.</span>
          </div>
        </div>
        <div class="col-lg-6 order-lg-2 order-md-1 order-1">
          <div class="container">
            <div class="row mt-5 justify-content-center">
              <div class="col-8">
                <div class="meet-shape">
                  <img src="{{URL::asset('images/meet-ll-icon.png')}}" draggable="false" />
                  <h4 class="search-nd-find semi-bold">Rohit Sharma</h4>
                  <button class="btn top-listing-btn white-color my-4 book-bt" type="button">Contact Owner</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="testimonials" style="display:none">
    <div class="container mt-5 pt-5">
      <div class="row">
        <div class="col-10 mx-auto">
          <div class="container-fluid">
            <div class="row">
              <div class="col">
                <h5 class="top-heading-text semi-bold">Testimonials</h5>
              </div>
            </div>
            <div class="row mt-5">
              <div class="test-img-container text-left pl-4 py-4">
                <div id="sync1" class="owl-carousel oc-three oc-test-img">
                  <div>
                    <img src="{{URL::asset('images/test-user.jpg')}}" draggable="false" />
                    <h5 class="semi-bold mt-4">Rohit Sharma</h5>
                    <span class="mt-2"><em>Tenant</em></span>
                  </div>
                  <div>
                    <img src="{{URL::asset('images/test-user.jpg')}}" draggable="false" />
                    <h5 class="semi-bold mt-4">Rohit Sharma</h5>
                    <span class="mt-2"><em>Tenant</em></span>
                  </div>
                  <div>
                    <img src="{{URL::asset('images/test-user.jpg')}}" draggable="false" />
                    <h5 class="semi-bold mt-4">Rohit Sharma</h5>
                    <span class="mt-2"><em>Tenant</em></span>
                  </div>
                  <div>
                    <img src="{{URL::asset('images/test-user.jpg')}}" draggable="false" />
                    <h5 class="semi-bold mt-4">Rohit Sharma</h5>
                    <span class="mt-2"><em>Tenant</em></span>
                  </div>
                </div>
              </div>
              <div class="test-content">
                <div id="sync2" class="owl-carousel oc-three">
                  <div>
                    <h6 class="semi-bold">Excellent App</h6>
                    <span>You made it so simple. This app is so much faster and easier to work. I look forward to have
                      more fun with it.<br>Thanks Guys! </span>
                  </div>
                  <div>
                    <h6 class="semi-bold">Excellent App</h6>
                    <span>You made it so simple. This app is so much faster and easier to work. I look forward to have
                      more fun with it.<br>Thanks Guys! </span>
                  </div>
                  <div>
                    <h6 class="semi-bold">Excellent App</h6>
                    <span>You made it so simple. This app is so much faster and easier to work. I look forward to have
                      more fun with it.<br>Thanks Guys! </span>
                  </div>
                  <div>
                    <h6 class="semi-bold">Excellent App</h6>
                    <span>You made it so simple. This app is so much faster and easier to work. I look forward to have
                      more fun with it.<br>Thanks Guys! </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="app-download" style="background:#f0f8ff;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-12 mx-auto">
          <div class="container-fluid">
            <div class="row pt-4 pb-4">
              <div class="col-12 col-lg-6 text-center text-lg-left">
                <img src="{{URL::asset('images/app-ss.png')}}" draggable="false" class="img-fluid">
              </div>
              <div class="col-12 col-lg-6">
                <div class="app-middle-align text-center text-md-center text-lg-center">
                  <h5 class="search-nd-find semi-bold pt-4 mt-2">Shellpar App available for Android.</h5>
                
                 <!--  <h3 class="search-nd-find semi-bold mar-top">Shifting Shellpar App available for Android.</h3> -->
                  <!--form class="hero-search d-block pt-5 mt-3">
                    <div class="input-group send-link-ig">
                      <div class="input-group-prepend">
                        <span class="input-group-text pl-3" id="search">+91</span>
                      </div>
                      <input type="text" class="send-link" placeholder="Search a Shelter" name="search" />
                      <button class="btn top-listing-btn white-color px-4" type="button">Send Link</button>
                    </div>
                  </form-->
                  <!--span class="d-block text-center py-5 or-find">OR FIND IN</span-->
                  <div class="container-fluid">
                    <div class="row justify-content-center mt-4">
                      <!--div class="col-6">
                        <a href="#"><img src="{{URL::asset('images/app-store.png')}}" draggable="false" width="145px" /></a>
                      </div-->
                      <div class="col-6">
                        <a href="{{url('https://play.google.com/store/apps/details?id=com.softradix.shiftingshelters&hl=en')}}" target="_blank"><img src="{{URL::asset('images/play-store.png')}}" draggable="false" width="145px" /></a>
                      </div>
                    </div>
                  </div>
                  <span class="d-block semi-bold mt-4 pt-4">Coming soon for Agents</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="list-miss">
    <div class="container mt-5 pt-5 mb-0 mb-md-0 mb-lg-5 pb-5">
      <div class="row">
        <div class="col-lg-6 mb-lg-0 mb-4">
          <div class="list-banner">
            <h4 class="white-color mb-3">List your property now.</h4>
            <span class="white-color">Share your property to maximum audience.</span>
            <!-- <button class="btn semi-bold px-5 mt-5 d-block" onclick="searchshelter('1','0')" type="button">Let's Begin</button> -->
             @auth
              <button class="btn semi-bold px-5 mt-5 d-block add_shelter_menu_btn" onclick='window.location = "/add-shelter";' type="button">Let's Begin</button>
            @else
              <button id="signin_menu" data-scroll class="btn semi-bold px-5 mt-5 d-block add_shelter_menu_btn" data-toggle="modal" data-target="#SignIN" type="button">Let's Begin</button>
            @endauth
            
          </div>
        </div>
        <div class="col-lg-6">
          <div class="n-miss-banner">
            <h4 class="white-color mb-3">Never miss an opportunity.</h4>
            <span class="white-color">Subscribe to our newsletter.</span>
            <form  method='post' action="{{url('subscribenewsletter')}}" class="d-block pt-5">
              {{ csrf_field() }}
              <div class="input-group">
                <input type="email" placeholder="Enter your email address" name="email"  required/>
                 <button class="search_icon"><i class="fa fa-paper-plane"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
	</section>
@include('layouts.footer')
@endsection