<footer>
  <div class="container" style="margin-top: 3rem;">
    <div class="row footer-row pb-3">
      <div class="col-4 f-left mt-4">
        <h6 class="semi-bold d-inline-block">SHELLPAR</h6>
        <span class="d-inline-block ml-lg-5 ml-md-5 ml-0">&copy; @php echo date("Y");@endphp-@php echo date("Y",strtotime("+1 year")); @endphp</span>
      </div>
      <div class="col-4 mt-4 text-center desktop-view">
        <span class="dwn-app">Download App</span>
      <a href="{{url('https://play.google.com/store/apps/details?id=com.softradix.shiftingshelters&hl=en')}}" target="_blank"><img src="{{URL::asset('images/play-store.png')}}" alt="Logo" class="shield-img pl-md-3 pr-md-2" draggable="false"
          height="26px"></a>
        <!--img src="{{URL::asset('images/apple.png')}}" alt="Logo" class="shield-img pr-md-2 d-none" draggable="false" height="26px"-->
      </div>
      
      <div class="col-4 mt-4 f-right text-right about-terms-desktop-view">
        <div class="row">
          <div class="col-lg-12">
            <a data-toggle="modal" data-target="#aboutus"><span class="about-text semi-bold">About</span></a>
            <a data-toggle="modal" data-target="#termsncondition"><span class="semi-bold">Terms and Conditions</span></a>
          </div>
          <div class="col-lg-12">
          <a  data-toggle="modal" data-target="#contactus"><span class="Contact-text  semi-bold">Contact</span></a>
          <a data-toggle="modal" data-target="#privacypolicyy"><span class="privacy-pol semi-bold">Privacy Policy</span></a>
          </div>
        </div>
      </div>
      <div class="col-8 mt-4 f-right text-right about-terms-mobile-view">
        <div class="row">
          <div class="col-lg-12">
            <a data-toggle="modal" data-target="#aboutus"><span class="about-text semi-bold">About</span></a>
            <a data-toggle="modal" data-target="#termsncondition"><span class="semi-bold">Terms and Conditions</span></a>
          </div>
          <div class="col-lg-12">
            <a data-toggle="modal" data-target="#contactus"><span class="Contact-text mobile-view  semi-bold" >Contact</span></a>
            <a data-toggle="modal" data-target="#privacypolicyy"><span class="privacy-pol semi-bold">Privacy Policy</span></a>
          </div>
        </div>
      </div>
      <div class="col-12 mt-4 text-center mobile-view">
        <span class="dwn-app">Download App</span>
        <a href="{{url('https://play.google.com/store/apps/details?id=com.softradix.shiftingshelters&hl=en')}}" target="_blank"><img src="{{URL::asset('images/play-store.png')}}" alt="Logo" class="shield-img pl-md-3 pr-md-2" draggable="false"
          height="26px"></a>
        <!--img src="{{URL::asset('images/apple.png')}}" alt="Logo" class="shield-img pr-md-2 d-none" draggable="false" height="26px"-->
      </div>
    </div>
  </div>
</footer>

<!-- The scroll to top feature -->
<div class="scroll-top-wrapper ">
  <span class="scroll-top-inner">
    <!-- <i class="fa fa-2x fa-arrow-circle-up"></i> -->
    <i class="fas fa-arrow-up"></i>
  </span>
</div>

@include('layouts.signin_modal')

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
  crossorigin="anonymous"></script>
<!-- Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
<script src="{{URL::asset('js/custom.js')}}"></script>
<script src="{{URL::asset('js/webscripts.js')}}"></script>
<script src="{{URL::asset('js/script.js')}}"></script>
<script src="{{URL::asset('js/jquery.copy-to-clipboard.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="js/jquery.steps.js"></script>
<!-- <script src="js/uploadHBR.min.js"></script> -->
<!-- Scripts -->
<script>
  $('.timepicker1').timepicker({
    uiLibrary: 'bootstrap4'
  });
  $('.timepicker2').timepicker({
    uiLibrary: 'bootstrap4'
  });
  $('.timepicker3').timepicker({
    uiLibrary: 'bootstrap4'
  });
  $('.timepicker4').timepicker({
    uiLibrary: 'bootstrap4'
  });

  $('#datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    minDate: function () {
      var date = new Date();
      date.setDate(date.getDate());
      return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    }
  });

  $('.list_tile').on('click', function () {
    var id = $(this).data('id');
    window.location = `{{url('/listing-details/${id}')}}`;
  }); 

  $(document).on('change', '.pro-chx', function (e) {
    if ($(this).prop('checked') == true) {
      $(this).next(".clab").find('.img-ameni-white').removeClass("d-none")
      $(this).next(".clab").find('.img-ameni').addClass("d-none")
    } else {
      $(this).next(".clab").find('.img-ameni').removeClass("d-none")
      $(this).next(".clab").find('.img-ameni-white').addClass("d-none")
    }
  });

  $(function () {
    $("#form-total").steps({
      headerTag: "h2",
      bodyTag: "section",
      transitionEffect: "fade",
      enableAllSteps: true,
      autoFocus: true,
      transitionEffectSpeed: 500,
      enablePagination: false,
      titleTemplate: '<span class="title">#title#</span>',
      labels: {
        previous: 'Previous',
        next: 'Save & Continue',
        finish: 'Save & Publish',
        current: ''
      }
    });

  });
</script>
<div class="modal fade" id="contactus" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header contact-us">
        <h4 class="modal-title text-center">Contact Us</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-3 offset-md-1  text-left">
                 <p><strong>Email : </strong>  &nbsp;</p>
            </div>
            <div class="col-lg-6 offset-md-1 text-left">
                <p>
                support@shellpar.com</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 offset-md-1 text-left">
                 <p><strong>Phone Number : </strong>  &nbsp;</p>
            </div>
            <div class="col-lg-6 text-left">
                <p>+91 9716696166</p>
            </div>
        </div>
  </div>
     
    </div>
 </div>
</div>
<!-- <div class="modal fade" id="contactus" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">      
      <div class="modal-body toalign">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="text-center modal-title">Contact Us</h3>
        <p class="text-center"><strong>Phone Number : </strong>&nbsp;  +91-9716696166</p>
        <p class="text-center"><strong>Email : </strong>  &nbsp;support@shellpar.com</p>
      </div>      
    </div>
  </div>
</div>
 -->
<div class="modal fade" id="aboutus" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">      
      <div class="modal-body toalign">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="text-center">About US</h3>
        <p>SHELLPAR is a platform that provides list of PG/Flat available for Rent in Mohali. It came into process to remove the pain of searching by providing detailed information of Shelter, so that USER can get an idea of the Shelter before visiting it. And it also makes it easy for OWNER to list their Shelter.</p>
      </div>      
    </div>
  </div>
</div>
<style>
  .modal-header.contact-us {
    display: flow-root;
}
  .close:not(:disabled):not(.disabled) {
    cursor: pointer;
    position: absolute;
    right: 10px;
    top: 5px;
}
  .toalign p{text-align: justify;}
  #contactus .modal-dialog {
    max-width: 500px;
    margin: 14rem auto;
}
 #aboutus .modal-dialog {
    max-width: 800px;
    margin: 14rem auto;
}
</style>
<div class="modal fade" id="termsncondition" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="overflow-y: scroll;height: 500px;" >      
      <div class="modal-body toalign">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="text-center">BRIEF</h3>
        <p>shellpar.com and mobile application collectively as SHELLPAR provides service to user/owner that solve their issue to find their desired shelter/tenant through their website (https://www.shellpar.com) and mobile application (Shellpar). For using the services provided by the SHELLPAR, you should first accept and follow the terms and condition. Please do not use the service if you are not agree with the terms and condition and privacy policies.</p>
        <h3 class="text-center">SERVICE SUMMARY</h3>
        <p>SHELLPAR provides you a platform from where you can find and list your shelter. While providing you information we try to give you precise information but we do not say or authorise that the information is precise, updated or reliable. The SHELLPAR has right to update the terms, condition and privacy policies including introducing any charges for a service without any notice to owner/user and we have right to stop any service or function any time.SHELLPER also contains copyright content including software, images, text user/owner cannot not use or modify it. And user/owner will agree to use SHELLPAR at its individual risk.</p>
        <h3 class="text-center">For User and Owner</h3>
        <p>We refer user as the one who use our service to find a shelter and we refer
        owner as one who list its shelter with us for rent here we can mention user and owner as you.</p>
        <p>
          1. SHELLPAR is a platform that allows all to find a shelter that match your
          requirement and list a shelter, so we have no role in the agreement between owner and user and we are not responsible for any misbehaving, any dispute on rent and change in there details or any issue between owner and user.
        </p>
        <p>2. It is your responsibility to fully check the owner/tenant before finalising it and it is user’s responsibility to give their rent on time.</p>
        <p>3. You should take responsibility for the data you posted in any form it maybe any text or images, it should not be offensive, vulgar, unlawful,defame or anything that may give rise to criminal activity.</p>
        <p>4. You should take care of contact number registered as it will be used every time you log-in to use SHELLPAR service.</p>
        <p>5. When you provide us with your telephone numbers then you may receive text message and phone calls from us related to any future updates or details.</p>
        <p>6. SHELLPAR has can to review its data of user/owner and has right to dismiss any user/owner from using the services.</p>
        <p>7. User should thoroughly check the details provided by the owner and it found suitable then only user should rent it.</p>
        <p>8. User should log-in first to get Owner details.</p>
        <p>9. SHELLPAR does not authorize the information filled by the owner and in some case it shows “verified”, in such case also we have not done any personal verification it is done on behalf of certain conditions.</p>
        <p>10. Owner should also check and verify the tenant before giving them space in their shelter as SHELLPAR does not authorize the person coming in the form of user or tenant. </p>
        <p>11. Owner should post his/her own shelter/property. He/she should not post other owner’s property.</p>
        <p>12. All information shared by owner should be precise and updated and by listing on SHELLPAR we have rights to share your shelter details.</p>
        <p>13. You can contact us at hello@shellpar.com</p>
        <h3 class="text-center">Data we collect</h3>
        <p>SHELLPAR collects data from all who uses its services. Some information is loaded includes your IP address, device, operating system, location details, emails and we are not responsible for data used by third party. Cookies may also be formed to keep you logged in and some browser automatically makes cookies, so we are not responsible for any loss of data, virus, and theft due to cookies or by using SHELLPAR services. We use your data to provide you more precise search and result.</p>
        <h3 class="text-center">General Disclaimer</h3>
        <p>1. The information related to your account should be confidential and it is your responsibility to keep it secured so take caution while sharing your personal information to avoid any misuse.</p>
        <p>2. Only the one who made the profile has right to use the profile you cannot transfer it to anyone else and you are responsible for any activity done from your profile and if you find any wrong use of your profile then please inform us immediately.</p>
        <p>3. SHELLPAR may contain external link and on clicking on these links you would be directed to other website, so SHELLPAR is not responsible for any harm or loss of your information.</p>
        <p>4. We are not responsible if any loss, damage, health issues, injury and costs and hence owner/user agrees to keep the company harmless.</p>
        <p>5. We are not responsible for any service provided by third party links on SHELLPAR, make sure you check it before use.</p>
        <p>6. The Verified owner’s are not verified by their documents or by meeting,it is done with different methods and it may involve charges for being verified.</p>
        <p>7. In case of any dispute the place of jurisdiction and arbitration shall be Mohali, Punjab</p>
      </div>      
    </div>
  </div>
</div>

<div class="modal fade" id="privacypolicyy" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">      
      <div class="modal-body toalign">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="text-center">Privacy Policies</h3>
        <ul>
        <p><li>For using the services provided by the SHELLPAR you have to accept the privacy policy, terms and conditions and this policy is applicable to all who uses the services..</li></p>
        <p><li>For creating your account, it is required to fill your own Mobile Number which will be verified by SHELLPAR by sending a onetime password and you have to create your account and fill your Personal details including your Name, Gender, E-mail and your image because some part of SHELLPAR is limited to Registered Owner/User. All the personal details uploaded will be viewed by other Owner/User and you are requested to keep your information up-to-date.</li></p>
        <p><li>SHELLPAR may use your details to provide optimize advertisements and we may also call you for upgrade or other services and the call will not be considered under National Do Not Call Registry.</li></p>
        <p><li>SHELLPAR may also send you promotional E-mails at your registered e-mail address.</li></p>
        <p><li>SHELLPAR has right to change or introduce any process, terms and policies included in SHELLPAR anytime without any information and it also includes introducing cost to use any service of SHELLPAR.</li></p>
      </ul>
      </div>      
    </div>
  </div>
</div>