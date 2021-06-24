//Global Variables
var Location_From = 0;
//If Location_From == 0, then Direct Click on Signin
//If Location_From == 1, then From Appointments
//If Location_From == 2, then From Profile
//If Location_From == 3, then From Add Shelter


$(".appt").click(function(e){
  e.preventDefault;
  Location_From = 1;
  $('#SignIN').modal('show');
});

$(".detaiListing").click(function(e){
  e.preventDefault;
  Location_From = 0;
  $('#SignIN').modal('show');
});

$(".profile").click(function(e){
  e.preventDefault;
  Location_From = 2;
  $('#SignIN').modal('show');
});

$('#signin_menu .top-listing-btn').click(function(e){
  e.preventDefault();
  Location_From = 3;
});

// For scroll to top feature
$(document).ready(function(){

$(function(){
 
    $(document).on( 'scroll', function(){
 
    	if ($(window).scrollTop() > 100) {
			$('.scroll-top-wrapper').addClass('show');
		} else {
			$('.scroll-top-wrapper').removeClass('show');
		}
	});
 
	$('.scroll-top-wrapper').on('click', scrollToTop);
});
 
function scrollToTop() {
	verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
	element = $('body');
	offset = element.offset();
	offsetTop = offset.top;
	$('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}

});

// For Mobile Verification & OTP sending Login Script
  $('#signin_menu').on('click', function(){
     Location_From = 0
     $('#phone_number').val('');
     $('#digit1').val('');
     $('#digit2').val('');
     $('#digit3').val('');
     $('#digit4').val('');
     $('#digit5').val('');
     $('#digit6').val('');
  });

  // $('#digit6').on('keyup',function(e){
  //   if($('#digit6').val() != ''){
  //     $('#sign_in').click();
  //   }
  //   // if(e.keyCode >= 48 && e.keyCode <= 57){
  //   // }
  // });

  // $('#digit6').on('blur',function(e){
  //   if($('#digit6').val() != ''){
  //     $('#sign_in').click();
  //   }
  //   // if(e.keyCode >= 48 && e.keyCode <= 57){
  //   // }
  // });

  function getCodeBoxElement(index) {
    return document.getElementById('digit' + index);
  }
  function onKeyUpEvent(index, event) {
    const eventCode = event.which || event.keyCode;
    if (getCodeBoxElement(index).value.length === 1) {
      if (index !== 6) {
        getCodeBoxElement(index+ 1).focus();
      } else {
        // getCodeBoxElement(index).blur();
        // Submit code
        $('#sign_in').click();
        // console.log('submit code ');
      }
    }
    if (eventCode === 8 && index !== 1) {
      getCodeBoxElement(index - 1).focus();
    }
  }
  function onFocusEvent(index) {
    for (item = 1; item < index; item++) {
      const currentElement = getCodeBoxElement(item);
      if (!currentElement.value) {
          currentElement.focus();
          break;
      }
    }
  }

  $('.backToMobile').click(function(){
    $('#enterOTP').modal('hide');
    $('#digit1').val('');
    $('#digit2').val('');
    $('#digit3').val('');
    $('#digit4').val('');
    $('#digit5').val('');
    $('#digit6').val('');
    $('#SignIN').modal('show');
    $('#phone_number').val($('#phone_number').val());
  });
  
  $('#phone_number').focus(function(){
    $('.phone_error').text('');
  });

  $('#phone_number').keydown(function(e){
    if(e.keyCode == 13){
      $('#send_otp').click();
    }
  });

  // $('.otp_digit').keypress(function(e){
  //   if(e.keyCode == 8 && this.value.length == 0){
  //     e.preventDefault();
  //     var digit = $(this).data('digit');
  //     if(digit != '1'){
  //       digit = Number(digit-1);
  //       $(`#digit${digit}`).focus();
  //     }
  //   }
  //   if(this.value.length > 0){
  //     e.preventDefault();
  //     var digit = $(this).data('digit');
  //     if(digit != '6'){
  //       digit = Number(digit+1);
  //       $(`#digit${digit}`).focus();
  //     }
  //   }
  // });

  // $('.otp_digit').keypress(function(e){
  //   if(e.keyCode==8 && e.keyCode==37){
  //     e.preventDefault();
  //     var digit = $(this).data('digit');
  //     if(digit != '1'){
  //       digit = Number(digit-1);
  //       $(`#digit${digit}`).focus();
  //     }
  //   }
  // });

  // $('.otp_digit').keyup(function(e){
  //   if(this.value.length>0){
  //     var digit = $(this).data('digit');
  //     if(digit!=6){
  //       digit = Number(digit+1);
  //       $(`#digit${digit}`).focus();
  //     }
  //   }
  // });

  // $('.otp_digit').keyup(function(e){
  //   if(this.value.length > 0){
  //     var digit = $(this).data('digit');
  //     if(e.keyCode==8 && e.keyCode==37){
  //       if(digit != '1'){
  //         digit = Number(digit-1);
  //         $(`#digit${digit}`).focus();
  //       }
  //     }else{
  //       digit = Number(digit+1);
  //       $(`#digit${digit}`).focus();
  //     }
  //     // if(digit == '6'){
  //     //   $('#sign_in').focus();
  //     // }else{
        
  //     // }
  //   }
  // });

  // $('.otp_digit').click(function(e){
  //   if(this.value.length > 0){
  //     $(this).select();
  //   }
  // });

  // $('.otp_digit').focus(function(e){
  //   if(this.value.length > 0){
  //     $(this).select();
  //   }
  // });
  
  $('#enterOTP').on('shown.bs.modal', function() {
    $('#digit1').focus();
  });

  /*** for state to city ***/
  $(document).on('change','#states',function(e){
      var id = $(this).val();
      $.ajax({
        type :'POST',
        url : '/getCities',
        dataType: 'json',
        data: {
          'id' : id
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        success:function(data){
          if(data){
            $('#city').html('');
            $('#city').append($("<option></option>").attr("value","").text('Select City'));
            $.each(data.cities, function(k,v){
              $('#city').append($("<option></option>").attr("value",v.name).text(v.name));
            });
          }
        }
      });
  });
  /*** End  ***/

  $(document).on('click','#send_otp',function(e){
      e.preventDefault();
      var phone = $('#phone_number').val();
      var reg = new RegExp('^\\d+$');
      if(!reg.test(phone)){
          $('.phone_error').text('Wrong Phone Number');
      }else if(phone.length!=10){
          $('.phone_error').text('Please enter 10 digit phone number');
      }else{          
          $.ajax({
              type :'POST',
              url : '/phoneValidate',
              dataType: 'json',
              data: {
                  'phone' : phone
              },
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }, 
              beforeSend: function() {
                  $("#loaderDiv").show();
              },
              success : function(result){
                if(result.success == true){
                    $("#loaderDiv").hide();
                    //toastr.success('Your OTP', result.otp , {displayDuration:2000,position: 'top-right'});
                    $('#SignIN').modal('hide');
                    $('#enterOTP').modal('show');
                    $('#mobileNo').text(phone);
                }else{
                    $("#loaderDiv").hide();
                    toastr.error('', result.message, {displayDuration:2000,position: 'top-right'});
                }
              },
              error : function(result){
                  $("#loaderDiv").hide();  
                  toastr.error('', "Unexpected Error Occured", {displayDuration:2000,position: 'top-right'});
              }
          });
      }
  });
  
  var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

  function searchshelter(type,value){
    var currenturllink=window.location.origin;
    if(type==1){
      if(window.location.pathname == '/listing'){
        window.location = currenturllink+'/listing';
      }else{
        window.location = currenturllink+'/listing-map';
      }
      // window.location = currenturllink+'/listing';
    }else if(type==2){
      var query="";
      query+='&searchtype='+value;      
      window.location = currenturllink+'/listing?'+query;
    }else{ 
      var query=""; 
      var urlchek=window.location.search;
      var strtocompare = "searchtype";
      if(urlchek.includes(strtocompare)){
        var searchtype = getUrlParameter('searchtype');
        query+='&searchtype='+searchtype;
      }

      if($('#headersearch').val()===undefined || $('#headersearch').val()===null || $('#headersearch').val()===""){
        
      }else{
        query+='&location='+$('#headersearch').val();
      }

      if($('#propertype').val()===undefined || $('#propertype').val()===null || $('#propertype').val()===""){
        
      }else{
        query+='&property_type='+$('#propertype').val();
      }

      if($('#lookingfor').val()===undefined || $('#lookingfor').val()===null || $('#lookingfor').val()===""){
        
      }else{
        query+='&looking_for='+$('#lookingfor').val();
      }
      
      if($('#occupation').val()===undefined || $('#occupation').val()===null || $('#occupation').val()===""){
        
      }else{
        query+='&tenant_type='+$('#occupation').val();
      }

      if($('#sharing').val()===undefined || $('#sharing').val()===null || $('#sharing').val()===""){
        
      }else{
        query+='&sharing='+$('#sharing').val();
      }

      if($('#rent').val()===undefined || $('#rent').val()===null || $('#rent').val()==""){
        
      }else{
        query+='&rent='+$('#rent').val();
      }

      if(type=='advance'){
        if($('#available_date').val()===undefined || $('#available_date').val()===null || $('#available_date').val()===""){
          
        }else{
          query+='&available_date='+$('#available_date').val();
        }

        /*if($("input[name='furniture']:checked").val() != undefined){
          query+='&furniture='+$("input[name='furniture']:checked").val();
        }*/

        if($('#buttonfood').prop('checked')){
          query+='&food='+$('#buttonfood').val();
        }else if($('#buttonWithout').prop('checked')){
          query+='&food='+$('#buttonWithout').val();
        }

        var amenities = [];
        $.each($("input[name='amenities']:checked"), function(){            
            amenities.push($(this).val());
        });
        if(amenities.length > 0){
          query+='&amenities='+ amenities.join(",");
        }

        var furniture = [];
        $.each($("input[name='furniture']:checked"), function(){            
            furniture.push($(this).val());
        });
        if(furniture.length > 0){
          query+='&furniture='+ furniture.join(",");
        }

        var property_feature = [];
        $.each($("input[name='property_feature']:checked"), function(){            
            property_feature.push($(this).val());
        });
        if(property_feature.length > 0){
          query+='&property_feature='+ property_feature.join(",");
        }

      }
      
      if(query!=""){
        query=query.substring(1);
        if(window.location.pathname == '/listing'){
          window.location = currenturllink+'/listing?'+query;
        }else{
          window.location = currenturllink+'/listing-map?'+query;
        }
      }else{
        if(window.location.pathname == '/listing'){
          window.location = currenturllink+'/listing';
        }else{
          window.location = currenturllink+'/listing-map';
        }
      } 
    }
  }

  $(document).on('click','#sign_in',function(e){
    var phone = $('#phone_number').val();
    var first = $('#digit1').val();
    var second = $('#digit2').val();
    var third = $('#digit3').val();
    var fourth = $('#digit4').val();
    var fifth = $('#digit5').val();
    var sixth = $('#digit6').val();

    var otp = first+second+third+fourth+fifth+sixth;
    if(otp == ''){
      $('.otp_error').text('Enter OTP');
    }
    var reg = new RegExp('^\\d+$');
    if(!reg.test(otp)){
        $('.otp_error').text('Wrong OTP');
    }else if(otp.length!=6){
        $('.otp_error').text('Please enter 6 digit otp number');
    }
    else{
        $.ajax({
              type :'POST',
              url : '/otpValidate',
              dataType: 'json',
              data: {
                  'phone' : phone,
                  'otp' : otp
              },
              beforeSend: function() {
                  $("#loaderDiv").show();
              },
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },  
              success : function(result){
                if(result.success == true){
                  $("#loaderDiv").hide();
                  if(Location_From == 1){
                      window.location.href = '/appointments';
                      Location_From = 0;                      
                  }else if(Location_From == 2){
                      window.location.href = '/profile';
                      Location_From = 0;
                  }else if(Location_From == 3){
                      window.location.href = '/add-shelter';
                      Location_From = 0;
                  }else{
                      window.location.reload();  
                      Location_From = 0;                    
                  }
                }else{
                    $("#loaderDiv").hide();
                    toastr.error('', result.message, {displayDuration:2000,position: 'top-right'});
                }
              },
              error : function(result){
                  $("#loaderDiv").hide();
                  toastr.error('', "Unexpected Error Occured", {displayDuration:2000,position: 'top-right'});
              }
        });
    }
  });

//For Mobile Verification & OTP sending Login Script Ends

    function getLocation() {
        if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
        }else { 
            console.log("Geolocation is not supported by this browser.");
        }
    }
    function showPosition(position) {
        // 30.7152522\n76.6816849
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        $.ajax({
                type :'POST',
                url : '/listing',
                dataType: 'json',
                data: {
                        'lat' : lat,
                        'lon' : lon
                },
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },  
                success : function(result){
                    // console.log(result)
                    if(result.success == true){
                        window.location = '/listing';
                    }
                },
                error : function(result){
                        toastr.error('', "Unexpected Error Occured", {displayDuration:2000,position: 'top-right'});
                }
        });
    }

    //For Favourite Unfavourite Shelters
    $('.favUnfav').click(function(e){
      e.preventDefault();
      var current_status = $(this).data('status');
      var shelter = $(this).data('shelter');
      var user = $(this).data('user');
      if(current_status == 0){
        var changed_status = 1;
        var title = "Add to Favourites?"
      }else{
        var changed_status = 0;
        var title = "Remove From Favourites?"
      }
      swal({
          buttons: {
              cancel: true,
              confirm: true,
          },
          title: title,
          text: "Do you really want to perform this action",
          })
          .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              type :'POST',
              url : '/favUnFav',
              dataType: 'json',
              data: {
                'status' : changed_status,
                'user_id' : user,
                'shelter_id' : shelter
              },
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },  
              success : function(result){
              if(result.success == true){
                swal({
                          title: result.message,
                          icon: "success",
                    });
               
                setInterval(() => {
                  window.location.reload();                      
                }, 1000);
              }else{
                toastr.error('', result.message, {displayDuration:2000,position: 'top-right'});
              }
              },
              error : function(result){
                  swal({
                          title: result.message,
                          icon: "error",
                      });
              }
            });
          }
        });
      
    }); 
    //End Favourite Unfavourite
    
    $('.editProperty').click(function(){
      var shelter = $(this).data('shelter');
      var user = $(this).data('user');
      console.log(shelter);
      window.location = `/edit-shelter/${shelter}/${user}`;
    });

    $('.deletemyproperty').click(function(){      
      var shelter = $(this).data('shelter');
      var user = $(this).data('user');
      var title = "Delete Shelter";      
      swal({
          buttons: {
              cancel: true,
              confirm: true,
          },
          title: title,
          text: "Do you really want to perform this action",
          })
          .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              type :'POST',
              url : '/deletemyproperty',
              dataType: 'json',
              data: {                
                'user_id' : user,
                'shelter_id' : shelter
              },
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },  
              success : function(result){
                if(result.success == true){
                  swal({
                    title: result.message,
                    icon: "success",
                  });                 
                  setInterval(() => {
                    window.location.reload();                      
                  }, 1000);
                }else{
                  toastr.error('', result.message, {displayDuration:2000,position: 'top-right'});
                }
              },
              error : function(result){
                  swal({
                    title: result.message,
                    icon: "error",
                  });
              }
            });
          }
        });      
    }); 

    $('.publishUnpublish').click(function(e){      
      var shelter = $(this).data('shelter');
      var user = $(this).data('user');
      var status = $(this).data('publish');
      if(status == 0){
        var title = "Publish Shelter";  
        var status_updated = 1;    
      }else{
        var title = "UnPublish Shelter";
        var status_updated = 0;      
      }
      swal({
          buttons: {
              cancel: true,
              confirm: true,
          },
          title: title,
          text: "Do you really want to perform this action",
          })
          .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              type :'POST',
              url : '/changePublishStatus',
              dataType: 'json',
              data: {                
                'user_id' : user,
                'shelter_id' : shelter,
                'status' : status_updated
              },
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },  
              success : function(result){
                if(result.success == true){
                  swal({
                    title: result.message,
                    icon: "success",
                  });                 
                  setInterval(() => {
                    if(e.target.id == "previewPublish"){
                      window.location = `/listing-details/${shelter}`
                    }else{
                      window.location.reload();                      
                    }
                  }, 1000);
                }else{
                  toastr.error('', result.message, {displayDuration:2000,position: 'top-right'});
                }
              },
              error : function(result){
                  swal({
                    title: result.message,
                    icon: "error",
                  });
              }
            });
          }
        });      
    });

    // Image Preview Jquery
    $('#edit_user_image').click(function(){
      //alert();
      $('#imageUpload').click();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageUpload").change(function() {
        readURL(this);
    });
    // Image Preview Jquery Ends

    //Remove User Profile Image
    $('#remove_user_image').click(function(){
        var id = $(this).data('id');
        var old_image = $('#old_image_name').val();
        swal({
          buttons: {
              cancel: true,
              confirm: true,
          },
          title: "Remove Image",
          text: "Do you really want to delete the Profile Pic",
          })
          .then((willDelete) => {
          if (willDelete) {
              $.ajax({
                  type :'POST',
                  url : '/remove-profile-image',
                  dataType: 'json',   
                  data: {
                    'id':id,
                    'old_image':old_image
                  },             
                  headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },  
                  success : function(result){
                      if (result.success == 1) {
                      swal({
                          title: result.message,
                          icon: "success",
                          });
                      setTimeout(() => {
                          window.location.reload(); 
                      }, 2000);
                      } else {
                      swal({
                          title: result.message,
                          icon: "error",
                          });
                      }
                  },
                  error : function(result){
                          toastr.error('', "Unexpected Error Occured", {displayDuration:2000,position: 'top-right'});
                  }
            });
          }
        });
        
    });
    //Remove User Profile Image ends

    //Accept Apointment
    $('.actionAccept').click(function(e){
      e.preventDefault();
      var id = $(this).data('id');
      swal({
        buttons: {
            cancel: true,
            confirm: true,
        },
        title: "Accept Appointment",
        text: "Do you want to accept this appointment",
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type :'POST',
                url : '/appointmentAppRej',
                dataType: 'json',   
                data: {
                  'id':id,
                  'status':1
                },             
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },  
                success : function(result){
                    if (result.success == 1) {
                    swal({
                        title: result.message,
                        icon: "success",
                        });
                    setTimeout(() => {
                        window.location.reload(); 
                    }, 2000);
                    } else {
                    swal({
                        title: result.message,
                        icon: "error",
                        });
                    }
                },
                error : function(result){
                        toastr.error('', "Unexpected Error Occured", {displayDuration:2000,position: 'top-right'});
                }
            });
          }
       });      
    });
    //Accept Apointment Ends

    //Reject Apointment
    $('.actionReject').click(function(e){
      e.preventDefault();
      var id = $(this).data('id');
      $('#data-id').val(id);     
    });

    $(document).on('click', '#rejectButton' ,function(e){
      
      var id = $('#data-id').val();
      var reason = $('#reason').val();
      var isValid = 0;
      if(reason!=''){
        e.preventDefault();
        isValid = 1;
      }
      if(isValid == 1){
        $.ajax({
              type :'POST',
              url : '/appointmentAppRej',
              dataType: 'json',   
              data: {
                'id':id,
                'status':2,
                'reason' : reason
              },             
              headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },  
              success : function(result){
                $('.reject.close').click();//reject close
                  if (result.success == 1) {
                  swal({
                      title: result.message,
                      icon: "success",
                      });
                  setTimeout(() => {
                      window.location.reload(); 
                  }, 2000);
                  } else {
                  swal({
                      title: result.message,
                      icon: "error",
                      });
                  }
              },
              error : function(result){
                      toastr.error('', "Unexpected Error Occured", {displayDuration:2000,position: 'top-right'});
              }
          });
      }
          
      // swal({
      //   buttons: {
      //       cancel: true,
      //       confirm: true,
      //   },
      //   title: "Reject Appointment",
      //   text: "Do you want to reject this appointment",
      // })
      // .then((willDelete) => {
      // if (willDelete) {
          
      //   }
      // });
    });

    //Reject Apointment Ends
    

    //Add and Edit Property
    $(document).on('click', '#house_flat', function () {
      $('.hf').show();
      $('.pgr').hide();
    });
    $(document).on('click', '#pg_room', function () {
      $('.hf').hide();
      $('.pgr').show();
    });

    window.onload = function () {
      var removed = [];
      //Check File API support
      if (window.File && window.FileList && window.FileReader) {
        $('#images').on("change", function (event) {
          while (removed.length) {
            removed.pop();
          }
          var files = event.target.files; //FileList object
          var output = document.getElementById("result");
          for (var i = 0; i < files.length; i++) {
            var file = files[i];            
            if (file.type.match('image.*')) {              
              var picReader = new FileReader();
              var j=0;
              picReader.addEventListener("load", function (event) {                
                var picFile = event.target;
                var div = document.createElement("div");
                div.className = "col col-md-2 col-lg-2 mt-2";
                 div.innerHTML = `<div class="img-upl">
                                            <i id="${j++}" class="fa fa-times close-img"></i>
                                             <img class="thumbnail" src="${picFile.result}" draggable="false">
                                           </div>`;                
                output.insertBefore(div, null);
              });
              //Read the image
              $('#result').show();
              picReader.readAsDataURL(file);             
            } else {
              alert("You can only upload image file.");
              $(this).val("");
            }
          }
        });

        $(document).on('click','.close-img',function(){
          removed.push($(this).attr('id'));
          console.log(removed);
        });

        $(document).on('click','#editShelter', function(){
          $('#removedImages').val(removed.join(','));
        });

        $(document).on('click','#addShelter', function(){
          $('#removedImages').val(removed.join(','));
        });
        $(document).on("change", '#featuredimageeee', function () {
        /*$('#featuredimage').on("change", function (event) {*/          
          var files = event.target.files; //FileList object
          var output = document.getElementById("feature_result");
          for (var i = 0; i < files.length; i++) {
            var file = files[i];            
            if (file.type.match('image.*')) {              
              var picReader = new FileReader();
              picReader.addEventListener("load", function (event) {
                var picFile = event.target;
                var div = document.createElement("div");
                div.className = "col col-md-2 col-lg-2 mt-2";
                div.id= 'featuredimgg';                
                div.innerHTML = `<div class="img-upl">
                                            <img class="thumbnail" src="${picFile.result}" draggable="false">
                                          </div>`;
                output.insertBefore(div, null);
              });              
              $('#feature_result').show();
              picReader.readAsDataURL(file);
            } else {
              alert("You can only upload image file.");
              $(this).val("");
            }
          }
        });
      }
      else {
        console.log("Your browser does not support File API");
      }
    }
   

    $(document).on("click", '#images', function () {
      $('.img-upl').closest('.mt-2').remove();
    });

    // $(document).on("click", '#featuredimage', function () {
    //   $('.img-upl1').closest('.mt-2').remove();
    // });

    $(document).on("click", '.close-img', function () {
       $(this).closest('.mt-2').remove();
    });


    $(document).on('blur','#pincode',function(){
      var pincode = $('#pincode').val();
      if(parseInt(pincode) < 999999 || parseInt(pincode) > 100000){
        $('#pincode').removeClass('error');
      }  
    })

    $(document).on('click', '#step2_next', function (e) {
      var expected_rent = $('#expected_rent').val();
      var security_deposit = $('#security_deposit').val();
      var city = $('#city').val();
      var locality = $('#locality').val();
      var street = $('#street').val();
      var location_ph = $('#hidenval').val();
      // var pincode = $('#pincode').val();

      // if(parseInt(pincode) > 999999 || parseInt(pincode) < 100000){
      //   $('#pincode').focus();
      //   $('#pincode').addClass('error');
      //   return false;
      // }  
      
      if (expected_rent != '' && security_deposit != '' && city != '' && locality != '' && street != '' && location_ph !='') {// && pincode != '') {
        e.preventDefault();
        $('#form-total-t-1').click();
      }
    });

    $(document).on('click', '#step3_next', function (e) {
      var title = $('#title').val();

      if (title != '') {
        e.preventDefault();
        $('#form-total-t-2').click();
      }
    });
    $(document).on('click', '#step1_previous', function (e) {
      $('#form-total-t-0').click();
    });
    $(document).on('click', '#step2_previous', function (e) {
      $('#form-total-t-1').click();
    });
    //Add and Edit Property Ends 

$( document ).ready(function() {
    $('#agree').click(function(){
      if ($('#agree').prop('checked')){
        $("#send_otp").prop("disabled", false);
      }else{
        $("#send_otp").prop("disabled", true);
      }
    });
});

/**** Append chapters  ***/
var chpt=0;
$(document).on('click', '#chaprApnd', function (e) {
    chpt++;
    var lol = `<div class="row d-block" id="chatapndiv${chpt}"><div class="col-md-12 col-lg-8">
                <div class="container-fluid">
                  <div class="row" onchange="galeryimage('${chpt}')" id="result${chpt}">
                    <div class="col col-md-2 col-lg-2 mt-2">
                      <div class="form-group">       
                      <button class="btn btn-primary pull-right apndrmv subj chapt toremove" type=button value="${chpt}" id="rmvchaptdiv${chpt}"><i class="fa fa-times close-imgg"></i></button>                 
                        <label class="label upload-file">
                          <i class="fa fa-plus"></i>
                          <input type="file" accept=".png, .jpg, .jpeg" name="images[]" id="images" required />
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>`;
    $('#chaptAddon').append(lol);

});
/*** To remove ***/

$(document ).ready(function() {
  $(document).on('click', '.chapt', function (e) {
    var val=$('#'+this.id).val();
    $('#chatapndiv'+val).remove(); 
    chpt--;
  });
});

/**** End ***/

$(document ).ready(function() {
  $(document).on('click', '.galimg', function (e) {
    var val=$('#'+this.id).val();
    var resVariable='img'+val;
    $('#'+resVariable+val).remove();    
  });
});

function galeryimagetochange(id){
    var resVariable='img'+id;
    var files = event.target.files;
    var output = document.getElementById(resVariable);
    for (var i = 0; i < files.length; i++) {
      var file = files[i];            
      if (file.type.match('image.*')) {              
        var picReader = new FileReader();
        picReader.addEventListener("load", function (event) {
          var picFile = event.target;
          $('#'+resVariable+id).remove();
          var div = document.createElement("div");
          div.className = "tocheckk"; 
          div.id= resVariable+id;            
          div.innerHTML = `<div class="img-upl2"><button class="toremovebtn galimg" type=button value="${id}" id="${id}"><i class="fa fa-times close-imgg2"></i></button>  
                        <img class="thumbnail" src="${picFile.result}" draggable="false">
                        </div>`;
          output.insertBefore(div, null);
        });              
        $('#'+resVariable).show();
        picReader.readAsDataURL(file);
      } else {
        alert("You can only upload image file.");
        $(this).val("");
      }
    }
}

function galeryimage(id){
   if(id==0){
    var resVariable='resultt';
    var files = event.target.files; //FileList object
    var output = document.getElementById(resVariable);
    $('.toremove').remove();
    for (var i = 0; i < files.length; i++) {
      var file = files[i];            
      if (file.type.match('image.*')) {              
        var picReader = new FileReader();
        picReader.addEventListener("load", function (event) {
          var picFile = event.target;
          
          var div = document.createElement("div");
          div.className = "col col-md-2 col-lg-2 mt-2 toremove";   
          div.id= resVariable+id;                       
          div.innerHTML = `<div class="img-upl1">
                                      <img class="thumbnail" src="${picFile.result}" draggable="false">
                                    </div>`;
          output.insertBefore(div, null);
        });              
        $('#'+resVariable).show();
        picReader.readAsDataURL(file);
      } else {
        alert("You can only upload image file.");
        $(this).val("");
      }
    }
   }else if(id=='featured'){    
    var resVariable='feature_resultt';
    var files = event.target.files; //FileList object
    var output = document.getElementById(resVariable);
    for (var i = 0; i < files.length; i++) {
      var file = files[i];            
      if (file.type.match('image.*')) {              
        var picReader = new FileReader();
        picReader.addEventListener("load", function (event) {
          var picFile = event.target;
          $('#'+resVariable+id).remove();
          var div = document.createElement("div");
          div.className = "col col-md-2 col-lg-2 mt-2";   
          div.id= resVariable+id;                       
          div.innerHTML = `<div class="img-upl3">
                                      <img class="thumbnail" src="${picFile.result}" draggable="false">
                                    </div>`;
          output.insertBefore(div, null);
        });              
        $('#'+resVariable).show();
        picReader.readAsDataURL(file);
      } else {
        alert("You can only upload image file.");
        $(this).val("");
      }
    }
   }else{
      var resVariable='result'+id;
      var files = event.target.files;
      var output = document.getElementById(resVariable);
      for (var i = 0; i < files.length; i++) {
        var file = files[i];            
        if (file.type.match('image.*')) {              
          var picReader = new FileReader();
          picReader.addEventListener("load", function (event) {
            var picFile = event.target;
            $('#'+resVariable+id).remove();
            var div = document.createElement("div");
            div.className = "col col-md-2 col-lg-2 mt-2"; 
            div.id= resVariable+id;            
            div.innerHTML = `<div class="img-upl1">
                                        <img class="thumbnail" src="${picFile.result}" draggable="false">
                                      </div>`;
            output.insertBefore(div, null);
          });              
          $('#'+resVariable).show();
          picReader.readAsDataURL(file);
        } else {
          alert("You can only upload image file.");
          $(this).val("");
        }
      }
    }
}

  