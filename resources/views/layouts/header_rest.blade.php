<!-- Header -->
<header class="search-shelter">
  <div class="container-fluid white-nav">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="/">
        <img src="{{URL::asset('images/logo-color.png')}}" alt="Logo" draggable="false">
      </a>
      <ul class="navbar-nav mr-auto hide-responsive">
       <!--li class="nav-item ml-5">
          @auth
          <a data-scroll class="nav-link dark-color" href="{{url('/appointments')}}">Appointments</a>
          @else
          <a data-scroll class="nav-link dark-color appt" href="javascript:void(0)">Appointments</a>
          @endauth
        </li-->
        
          @auth
          <li class="nav-item ml-5">
          <a data-scroll class="nav-link dark-color" href="{{url('/profile')}}">Profile</a>
          </li>
          <li class="nav-item ml-5">
          <a data-scroll class="nav-link dark-color" href="{{url('/favourites')}}">Favourites</a>
          </li>
          @endauth  
        
      </ul>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto text-right text-lg-left">
          <!--li class="nav-item ml-5 disply-none">
            @auth
            <a data-scroll class="nav-link dark-color" href="{{url('/appointments')}}">Appointments</a>
            @else
            <a data-scroll class="nav-link dark-color appt" href="javascript:void(0)">Appointments</a>
            @endauth
          </li-->
          @auth
            <li class="nav-item ml-5 disply-none">
              <a data-scroll class="nav-link dark-color" href="{{url('/profile')}}">Profile</a>
            </li>
            <li class="nav-item ml-5 disply-none">
              <a data-scroll class="nav-link dark-color" href="{{url('/favourites')}}">Favourites</a>
            </li>
         
          @endauth  
          
          @if(Auth::check())
          <form class="form-inline">
            <!-- <a href="{{url('/listing')}}">
              <button class="btn top-listing-btn ml-auto ml-lg-0 white-color" type="button" data-toggle="modal"
              data-target="#" onclick="getLocation()">Shelters Listing</button>
            </a> -->
            @auth
              <a href="{{url('/add-shelter')}}" class="add_shelter_menu_btn">
                <button class="btn top-listing-btn ml-auto ml-lg-0 white-color" type="button">Add Shelter</button>
              </a>
            @else
              <a id="signin_menu" data-scroll class="nav-link white-color add_shelter_menu_btn" data-toggle="modal" data-target="#SignIN">
                <button class="btn top-listing-btn ml-auto ml-lg-0 white-color" type="button">Add Shelter</button>
              </a>
            @endauth
          </form>
          <!--li class="nav-item">
            <div class="dropdown">
              <button class="btn dropdown-toggle noti-cl" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell bell mt-2"></i>
                <span class="count">4</span>
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </li-->
          <li class="nav-item">
            <div class="dropdown" >
              <button class="btn dropdown-toggle admin-user" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
              @if(isset(Auth::user()->profile_image) && Auth::user()->profile_image != '' && file_exists(public_path('/uploads/'.Auth::user()->profile_image)))
                <img class="img-xs rounded-circle" src="{{url::asset('uploads/')}}/{{Auth::user()->profile_image}}" alt="Profile image">
              @else
              <img class="img-xs rounded-circle" src="{{url::asset('uploads/default.png')}}" alt="Profile image">
              @endif
              </button>
              <div class="dropdown-menu dropdown-menu-right nav-design" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item user-name" href="#">{{isset(Auth::user()->name)?Auth::user()->name : "User Name"}}</a>
                <a class="dropdown-item" href="{{url('/profile')}}">Profile</a>
                <!--a class="dropdown-item" href="{{url('/add-shelter')}}">Add Shelter</a-->
                <a class="dropdown-item" href="{{url('/my-property')}}">My Shelter</a>
                <!--a class="dropdown-item" href="{{url('/appointments')}}">Appointments</a-->
                <!--a class="dropdown-item" href="{{url('/favourites')}}">Favourites</a-->
                <a class="dropdown-item" href="{{url('/sign-out')}}">Log out</a>
              </div>
            </div>
          </li>
          @else
          <li class="nav-item mr-lg-4 mr-0 my-lg-2 my-0">
            <a id="signin_menu" data-scroll class="nav-link dark-color" data-toggle="modal" data-target="#SignIN">Sign
              In</a>
          </li>
          <form class="form-inline">
            <!-- <a href="{{url('/listing')}}">
              <button class="btn top-listing-btn ml-auto ml-lg-0 white-color" type="button" data-toggle="modal"
              data-target="#" onclick="showPosition(1)">Shelters Listing</button>
            </a> -->
            @auth
              <a href="{{url('/add-shelter')}}" class="add_shelter_menu_btn">
                <button class="btn top-listing-btn ml-auto ml-lg-0 white-color" type="button">Add Shelter</button>
              </a>
            @else
              <a id="signin_menu" data-scroll class="nav-link white-color add_shelter_menu_btn" data-toggle="modal" data-target="#SignIN">
                <button class="btn top-listing-btn ml-auto ml-lg-0 white-color" type="button">Add Shelter</button>
              </a>
            @endauth
          </form>
          @endif

        </ul>
      </div>
    </nav>
  </div>
  <div class="container-fluid">
    <div class="row pt-3 blue-header">
      <div class="col-lg-10 pb-5 mx-auto">
        <span class="white-color"> <a href="{{url('/')}}" class='white-color'>  Home </a> > @yield('breadcrumb')</span>
      </div>
    </div>
  </div>
</header>

<section id="SearchShelter">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 mx-auto white-search-bg">
        @if(URL::current() == url('/listing-map'))
        <form class="hero-search d-block py-3 px-3" method='GET' action="{{url('listing-map')}}">
        @else
        <form class="hero-search d-block py-3 px-3" method='GET' action="{{url('listing')}}">
        @endif
          <div class="input-group">
            <!-- <input type="text" placeholder="Enter a location" value="@yield('address')" id="headersearch" required name="location" class="search-white-input" placeholder="Search a Shelter" name="search" autocomplete="off"/> -->
            <input type="text" placeholder="Enter a location" value="Mohali" readonly id="headersearch" required name="location" class="search-white-input" placeholder="Search a Shelter" name="search" autocomplete="off"/>
            <button class="btn top-listing-btn white-color px-4  px-md-5" type="submit">
            <span class='search-text'>Search</span>
            <span class='search-icon'>
              <i class="fa fa-search"></i>
            </span>
            </button>
          </div>
        </form>
      </div> 
    </div>
  </div>
</section>