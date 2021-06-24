
<!-- Sign In Modal -->

<div class="modal fade" id="SignIN" tabindex="-1" role="dialog" aria-labelledby="SignIN" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header d-block text-center">
        <h4 class="modal-title semi-bold" id="SignIN">Sign In</h4>
      </div>
      <div class="modal-body">
        <div class="container"> 
          <div class="row">
            <div class="col-lg-12">
              <div class="d-block mt-4">
                <label class="pn-label-color" for="phone-number">Phone Number</label>
                <div class="input-group si-ig mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text pl-0" id="phone-signin">+91</span>
                  </div>
                  <input type="number" class="number-si" placeholder="" name="phone-number" id="phone_number" onKeyPress="if(this.value.length==10) return false;" autocomplete="off"/>
                </div>
                <h6><small class="phone_error text-danger"></small></h6>
                <small class="pn-label-color">We will send you an OTP on your number.</small>
                <p class="d-block py-3"><input class="pn-label-color pl-3" id="agree" type="checkbox" >&nbsp;I, agree the <a data-toggle="modal" data-target="#termsncondition" href="javasvript:void(0)">Terms and Conditions</a> & <a data-toggle="modal" data-target="#privacypolicyy" href="javasvript:void(0)">Privacy Policy.</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn top-listing-btn white-color mx-auto px-4" type="button" id='send_otp' disabled>Continue</button>
      </div>
    </div>
  </div>
</div>
<!-- OTP Modal -->
<div class="modal fade" id="enterOTP" tabindex="-1" role="dialog" aria-labelledby="enterOTP" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header d-block text-center">
        <h4 class="modal-title semi-bold" id="enterOTP">
          <span class="float-left backToMobile"> <i class="fas fa-arrow-circle-left"></i> </span>
          Enter OTP
        </h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="d-block mt-4">
                <div class="form-group otp-form text-center mb-5">
                  <label for="otp-m" class="semi-bold mb-5">Please enter pin sent on <span id="mobileNo"></span>.</label>
                  <div class="mx-0 mx-md-3 px-0 px-md-3">
                    <div class="row">
                      <div class="col">
                        <input type="number" data-digit="1" class="number-si otp_digit" placeholder="" name="otp-m" id='digit1' min="1" max="1" onkeyup="onKeyUpEvent(1,event)" onKeyPress="if(this.value.length==1) return false;" onfocus="onFocusEvent(1)"/>
                      </div>
                      <div class="col">
                        <input type="number" data-digit="2" class="number-si otp_digit" placeholder="" name="otp-m" id='digit2' onKeyPress="if(this.value.length==1) return false;" min="1" max="1" onkeyup="onKeyUpEvent(2,event)" onfocus="onFocusEvent(2)"/>
                      </div>
                      <div class="col">
                        <input type="number" data-digit="3" class="number-si otp_digit" placeholder="" name="otp-m" id='digit3' min="1" max="1" onkeyup="onKeyUpEvent(3,event)" onfocus="onFocusEvent(3)"/>
                      </div>
                      <div class="col">
                        <input type="number" data-digit="4" class="number-si otp_digit" placeholder="" name="otp-m" id='digit4' min="1" max="1" onkeyup="onKeyUpEvent(4,event)" onfocus="onFocusEvent(4)"/>
                      </div>
                      <div class="col">
                        <input type="number" data-digit="5" class="number-si otp_digit" placeholder="" name="otp-m" id='digit5' min="1" max="1" onkeyup="onKeyUpEvent(5,event)" onfocus="onFocusEvent(5)"/>
                      </div>
                      <div class="col">
                        <input type="number" data-digit="6" class="number-si otp_digit" placeholder="" name="otp-m" id='digit6' min="1" max="1" onkeyup="onKeyUpEvent(6,event)" onfocus="onFocusEvent(6)"/>
                      </div>
                    </div>
                  </div>
                  <h6 class="mt-2"><small class="otp_error text-danger"></small></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn top-listing-btn white-color mx-auto px-4" id='sign_in' type="button">Take Me In</button>
      </div>
    </div>
  </div>
</div>