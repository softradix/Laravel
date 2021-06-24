<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ URL::asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ URL::asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- this page js -->
<script>
	$('[data-toggle="tooltip"]').tooltip();
	$(".preloader").fadeOut();
	// ============================================================== 
	// Login and Recover Password 
	// ============================================================== 
	$('#to-recover').on("click", function() {
	    $("#loginform").slideUp();
	    $("#recoverform").fadeIn();
	});
	$('#to-login').click(function(){
	    
	    $("#recoverform").hide();
	    $("#loginform").fadeIn();
	});
</script>


