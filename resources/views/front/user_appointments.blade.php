@extends('layouts.appFront')
@section('breadcrumb_title')
Appointments
@endsection
@section('content')

<section id="Appointments">
  <div class="container box-row mt-5 pb-3">
    <div class="row">
      <div class="col-lg-12">
        <p class="font-weight-bold pl-5 pt-5">New Appointments</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        @if(count($upcommingAppointments) > 0)
        <ul class="timeline">
          @foreach($upcommingAppointments as $new)
          <li>
            <div class="row">
              <div class="timeline-col">
                <div class="container-fluid">
                  <div class="row text-size-appoint align-items-center p-3">
                    <div class="col-lg-6 pl-0 list_tile" data-id="{{$new['shelter_id']}}">
                      <div class="container-fluid">
                        <div class="row align-items-center">
                          <div class="col-lg-2 col-md-2 col-3">
                            <span class="timeline-img-title"><img src="{{URL::asset('/uploads')}}/{{$new['profile_image'] ? $new['profile_image'] : 'default.png'}}"
                                draggable="false"></span>
                          </div>
                          <div class="col-lg-10 col-md-10 col-9">
                            <p class="m-0">{{$new['name']}}</p>
                            <p class="m-0">Property - {{$new['flat_type']}}BHK {{$new['street']}} {{$new['locality']}}
                              {{$new['city']}}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 mt-lg-0 mt-md-2 col-6">
                      @php $date = date('Y-m-d'); @endphp
                      <span class="font-weight-bold pr-2">
                        @if($new['appointment_date'] == $date)
                        Today
                        @else
                        @if($new['appointment_date'] == date('Y-m-d', strtotime('+1 day')))
                        Tomorrow
                        @else
                        {{$new['appointment_date']}}
                        @endif
                        @endif
                      </span>
                      <span>{{date('h:i A', strtotime($new['start_time']))}} to {{date('h:i A',
                        strtotime($new['end_time']))}}</span>
                      <br>
                      <!-- if($new['shelter_user_id'] == Auth::user()->id && $new['status']!=2)
                      <span class="d-block mt-2"><a href='' data-user_id="{{$new['user_id']}}" data-shelter_id="{{$new['shelter_id']}}"
                          data-shelter_user_id="{{$new['shelter_user_id']}}" data-toggle="modal" data-target="#RescheduleAppointment"
                          class="Reschedule-cl">Reschedule</a></span>
                      else
                      if($new['user_id'] == Auth::user()->id)
                      <span class="d-block"><a href="#" class="cancel-cl">Cancel</a></span>
                      endif
                      endif -->
                    </div>
                    @if($new['shelter_user_id'] == Auth::user()->id)
                    @if($new['status'] == 0)
                    <div class="col-lg-3 text-right">
                      <div class="container-fluid">
                        <div class="row align-items-center">
                          <div class="col-4 text-center offset-4">
                            <a href="#" class="btn-hov actionAccept" data-id="{{$new['id']}}"><img src="images/icon/Accept_icon.png"
                                draggable="false"></a>
                            <span>Accept</span>
                          </div>
                          <div class="col-4 text-left text-md-right">
                            <a href="#" class="btn-hov actionReject" data-target="#rejectAppointmentModal" data-toggle="modal" data-id="{{$new['id']}}"><img src="images/icon/reject_icon.png"
                                draggable="false"></a>
                            <span>Reject</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif

                    @if($new['status'] == 1)
                    <div class="col-lg-3 col-6 text-left text-md-right">
                      <a class="btn Approved white-color px-3 mr-1">Accepted</a>
                    </div>
                    @endif
                    @if($new['status'] == 2)
                    <div class="col-lg-3 col-6 text-left text-md-right">
                      <a class="btn Rejected white-color px-3 mr-1">Rejected</a>
                    </div>
                    @endif
                    @endif

                    @if($new['user_id'] == Auth::user()->id)
                    @if($new['status'] == 0)
                    <div class="col-lg-3 col-6 text-left text-md-right">
                      <a class="btn Pending white-color px-3 mr-1">Pending</a>
                    </div>
                    @endif
                    @if($new['status'] == 1)
                    <div class="col-lg-3 col-6 text-left text-md-right">
                      <a class="btn Approved white-color px-3 mr-1">Accepted</a>
                    </div>
                    @endif
                    @if($new['status'] == 2)
                    <div class="col-lg-3 col-6 text-left text-md-right">
                      <a class="btn Rejected white-color px-3 mr-1">Rejected</a>
                    </div>
                    @endif
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
        @else
        <div class="row">
          <div class="col-md-12">
            <h4 class="text-center text-muted">No New Appointments</h4>
          </div>
        </div>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <p class="font-weight-bold pl-5 pt-5">Previous Appointments</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        @if(count($previous_appointments) > 0)
        <ul class="timeline">
          @foreach($previous_appointments as $old)
          <li>
            <div class="row">
              <div class="timeline-col">
                <div class="container-fluid">
                  <div class="row text-size-appoint align-items-center p-3">
                    <div class="col-lg-6 pl-0 list_tile" data-id="{{$old['shelter_id']}}">
                      <div class="container-fluid">
                        <div class="row align-items-center">
                          <div class="col-lg-2 col-md-2 col-3">
                            <span class="timeline-img-title"><img src="{{URL::asset('uploads')}}/{{$old['user_details']['profile_image'] ? $old['user_details']['profile_image'] : 'default.png'}}"
                                draggable="false"></span>
                          </div>
                          <div class="col-lg-10 col-md-10 col-9">
                            <p class="m-0">{{$old['user_details']['name']}}</p>
                            <p class="m-0">Property - {{$old['flat_type']}}BHK {{$old['street']}} {{$old['locality']}}
                              {{$old['city']}}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 mt-lg-0 mt-md-2 col-6">
                      <span class="font-weight-bold pr-2">
                        @php $date = date('Y-m-d'); @endphp
                        @if($old['appointment_date'] == $date)
                        Today
                        @else
                        @if($old['appointment_date'] == date('Y-m-d', strtotime('-1 day')))
                        Yesterday
                        @else
                        {{$old['appointment_date']}}
                        @endif
                        @endif
                      </span>
                      <span>{{date('h:i A', strtotime($old['start_time']))}} to {{date('h:i A',
                        strtotime($old['end_time']))}}</span>
                      <br>
                    </div>
                    @if($old['status'] == 0)
                    <div class="col-lg-3 col-6 text-left text-md-right">
                      <a class="btn Pending white-color px-3 mr-1">Pending</a>
                    </div>
                    @endif
                    @if($old['status'] == 1)
                    <div class="col-lg-3 col-6 text-left text-md-right">
                      <a class="btn Approved white-color px-3 mr-1">Accepted</a>
                    </div>
                    @endif
                    @if($old['status'] == 2)
                    <div class="col-lg-3 col-6 text-left text-md-right">
                      <a class="btn Rejected white-color px-3 mr-1">Rejected</a>
                    </div>
                    @endif                    
                  </div>
                </div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
        @else
        <div class="row">
          <div class="col-md-12">
            <h4 class="text-center text-muted">No Appointment History Available</h4>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>

<!-- <div class="modal fade" id="RescheduleAppointment" tabindex="-1" role="dialog" aria-labelledby="SignIN" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header d-block text-center">
        <h4 class="modal-title semi-bold" id="SignIN">Reschedule Appointment</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="d-block mt-4">
                <form class="pl-4 pt-5 pr-4" method="post" action="{{URL('/rescheduleAppointment')}}">
                  {{csrf_field()}}
                  <label>Select Day</label>
                  <input id="datepicker" name="appointment_date" min="{{date('m/d/Y')}}" required />
                  <br>
                  <label>Start Time</label>
                  <input class="timepicker1" id="start_time" name="start_time" required />
                  <br>
                  <label>End Time</label>
                  <input class="timepicker2" id="end_time" name="end_time" required />
                  <input type="hidden" name="shelter_id" value="">
                  <input type="hidden" name="user_id" value="">
                  <input type="hidden" name="shelter_user_id" value="">
                  <button class="btn top-listing-btn ml-auto ml-lg-0 white-color pl-5 pr-5 mt-4" type="submit"
                    data-toggle="modal" data-target="#">Book</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->

@include('layouts.footer')
<div class="modal fade" id="rejectAppointmentModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reject Appointment</h4>
        <button type="button" class="reject close pull-right" data-dismiss="modal">&times;</button>
      </div>
      <form class='form-group'>
        <div class="modal-body">
        <p>Do you want to reject this appointment ?</p>
          <input type="hidden" name="data-id" id="data-id" class="form-control" value="">
          <input type="text" name="reason" id="reason" class="form-control" placeholder="Reason to reject the appointment" required>
        </div>
        <div class="modal-footer">
          <input type="submit" name="rejectButton" id="rejectButton" class="btn btn-danger" value="Reject" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>

  </div>
</div>

<!-- <script type="text/javascript">

  $('.Reschedule-cl').click(function () {
    var user_id = $(this).data('user_id');
    var shelter_user_id = $(this).data('shelter_user_id');
    var shelter_id = $(this).data('shelter_id');

    $("#RescheduleAppointment input[name='shelter_id']").val(shelter_id);
    $("#RescheduleAppointment input[name='user_id']").val(user_id);
    $("#RescheduleAppointment input[name='shelter_user_id']").val(shelter_user_id);

  });

</script> -->


@endsection