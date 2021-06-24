<style>
.header {
    position: relative;
    background: #ffffff;
}
button.navbar-toggler.toggle-color {
    background-image: linear-gradient(to left,#3C23F1, #62bcfa);
}
.header-inner {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}

.navigation {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 66.666667%;
    flex: 0 0 66.666667%;
    max-width: 66.666667%;
}

.navigation ul {
    float: right;
    margin: 0;
    padding: 0;
    list-style: none;
}

.navigation li {
    float: left;
    margin-right: 15px;
}

.navigation li:last-child {
    margin-right: 0;
}

.navigation a {
    position: relative;
    display: block;
    padding: 5px 0;
    font-size: 14px;
    color: #888888;
    font-weight: 700;
}

.sticky-header {
    position: fixed;
    width: 100%;
    left: 0;
  background: #ffffff;
  -webkit-transition: opacity 0.8s ease, transform 0.8s ease;
    -webkit-transition: opacity 0.8s ease, -webkit-transform 0.8s ease;
    transition: opacity 0.8s ease, -webkit-transform 0.8s ease;
    -o-transition: opacity 0.8s ease, transform 0.8s ease;
    transition: opacity 0.8s ease, transform 0.8s ease;
    transition: opacity 0.8s ease, transform 0.8s ease, -webkit-transform 0.8s ease;
  -webkit-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
  transform: translateY(-100%);
    opacity: 0;
  z-index: 99;
}

body.show-header .sticky-header {
  -webkit-transform: translateY(0);
  -ms-transform: translateY(0);
  transform: translateY(0);
  opacity: 1;
}

.floating-header {
  -webkit-box-shadow: 0px 3px 3px -2px rgba(0, 0, 0, 0.15);
  box-shadow: 0px 3px 3px -2px rgba(0, 0, 0, 0.15);
}

.sticky-header .branding,
.sticky-header .navigation {
    padding-top: 5px;
    padding-bottom: 5px;
}
a.navbar-brand img {
    height: 50px;
}

</style>
<header class="header">
  <div class="container-fluid">
    <div class="header-inner">
    <nav class="navbar navbar-expand-lg navbar-dark w-100">
      <a class="navbar-brand" href="#">
        <img src="{{URL::asset('images/logo.png')}}" alt="Logo" draggable="false">
      </a>
      <!-- <ul class="navbar-nav mr-auto hide-responsive">
        <li class="nav-item ml-5">
          @auth
          <a data-scroll class="nav-link white-color" href="{{url('/appointments')}}">Appointments</a>
          @else
          <a data-scroll class="nav-link white-color appt" href="javascript:void(0)">Appointments</a>
          @endauth
        </li>
        <li class="nav-item ml-5">
          @auth
          <a data-scroll class="nav-link white-color" href="{{url('/profile')}}">Profile</a>
          @else
          <a data-scroll class="nav-link white-color profile" href="javascript:void(0)">Profile</a>
          @endauth  
          
        </li>
      </ul> -->
      <button class="navbar-toggler toggle-color" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto text-right text-lg-left">
          <!-- <li class="nav-item ml-5 disply-none">
            @auth
            <a data-scroll class="nav-link dark-color" href="{{url('/appointments')}}">Appointments</a>
            @else
            <a data-scroll class="nav-link dark-color appt" href="javascript:void(0)">Appointments</a>
            @endauth
          </li>
          <li class="nav-item ml-5 disply-none">
            @auth
            <a data-scroll class="nav-link dark-color" href="{{url('/profile')}}">Profile</a>
            @else
            <a data-scroll class="nav-link dark-color profile" href="javascript:void(0)">Profile</a>
            @endauth  
          </li> -->
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
            <!--div class="dropdown">
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
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item user-name" href="#">{{isset(Auth::user()->name)?Auth::user()->name : "User Name"}}</a>
                <a class="dropdown-item" href="{{url('/profile')}}">Profile</a>
                <!--a class="dropdown-item" href="{{url('/add-shelter')}}">Add Shelter</a-->
                <a class="dropdown-item" href="{{url('/my-property')}}">My Shelter</a>
                <!-- <a class="dropdown-item" href="{{url('/appointments')}}">Appointments</a> -->
                <!--a class="dropdown-item" href="{{url('/favourites')}}">Favourites</a-->
                <a class="dropdown-item" href="{{url('/sign-out')}}">Log out</a>
              </div>
            </div>
          </li>
          @else
          <li class="nav-item mr-lg-4 mr-0 my-lg-2 my-0">
            <a id="signin_menu" data-scroll class="nav-link white-color" data-toggle="modal" data-target="#SignIN">Sign
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
              <a id="signin_menu" data-scroll class="nav-link white-color" data-toggle="modal" data-target="#SignIN">
                <button class="btn top-listing-btn ml-auto ml-lg-0 white-color" type="button">Add Shelter</button>
              </a>
            @endauth
            
          </form>
          @endif

        </ul>
      </div>
    </nav>
  </div>
  </div>
</header>
<div class="container-fluid back-img">
    <div class="row">
      <div class="col-lg-8 mx-auto my-5 text-center">
        <h1 class="white-color semi-bold d-none d-md-block">Find best to live and list<br>your shelter</h1>
        <span class="hero-subtext pt-4 d-block">Find the right stay of your dreams</span>

        <form class="hero-search d-block pt-3 mt-3" method='GET' action="{{url('listing')}}" >
          <div class="input-group" style="display: block;">
            <!-- <div class="input-group-prepend">
              <span class="input-group-text pl-3" id="search">
                <img src="{{URL::asset('images/search-magnifier.png')}}" width="70%"
                  draggable="false">
              </span>
            </div> -->
            <button class="search_icon" style="right:unset; margin:3px;">
              <img src="{{URL::asset('images/search-magnifier.png')}}" width="70%" draggable="false">  
            </button>
            <input style="padding-left:35px;" type="text" value="Mohali" readonly placeholder="Enter a location" required name="location" />
            <button class="btn top-listing-btn white-color px-4" type="submit">
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script type="text/javascript">
      var $header = $('.header'),
          $clone = $header.before($header.clone().addClass('sticky-header'));

      $(window).on('scroll', function() {
          var fromTop = $(window).scrollTop();
          $('body').toggleClass('show-header', (fromTop > 200));
          if ( fromTop > 200 ) {
              $('.sticky-header').addClass('floating-header');
          } else {
              $('.sticky-header').removeClass('floating-header');
          }
      });
</script>

