
@extends('layouts.appFront')
@section('breadcrumb_title')
   Profile
@endsection
@section('content')
<style>
	select.form-control.gender-cl.profile_page{
		width: 295px;
	}
	input.form-control.pro-in.input-cl.pl-0.profile_page{
		width: 295px;
	}
</style>

<section id="My-Property">
	<div class="container box-row mt-5 pb-3">
		<div class="container" style="margin-top: 10px">
				<div class="row">
					<div class="col col-sm-2 col-12 mt-4" style="border-right: 1px solid #dcdcdc;">
						<ul class="nav nav-tabs nav-stacked pro-side" role="tablist" id="nav_profile">
							<li role="presentation" class="tab-col"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="active show">Profile</a></li>
							<!-- <li role="presentation" class="tab-col"><a href="#profile" class="tab-col" aria-controls="profile" role="tab" data-toggle="tab">Favourite</a></li> -->
							<!--li role="presentation" class="tab-col "><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Settings</a></li-->
						</ul>
					</div>
					<div class="col col-sm-10 col-12 mt-4">
						<div class="row tab-content">
							<div role="tabpanel" class="tab-pane container active in" id="home">
								<form method='post' action="{{url('saveProfile')}}" enctype="multipart/form-data">
									{{csrf_field()}}
								<div class="row text-center">
									<div class="profil-rounded mt-4 ml-4 mx-auto">
										 	<div class="product-upload">
					              <div class="product-edit">
					                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="userimage" />
					              </div>
					              <div class="product-preview">
					              	@if(isset(Auth::user()->profile_image) && Auth::user()->profile_image != '')
					                <div id="imagePreview" style="background-image: url('{{ URL::asset('uploads/'.Auth::user()->profile_image) }}');">
					                </div>
					                @else
					                <div id="imagePreview" style="background-image: url('{{ URL::asset('uploads/default.png') }}');">
					                </div>
					                @endif
					                <input type="hidden" id="old_image_name" name="old_image_name" value="{{Auth::user()->profile_image}}">
					              </div>
					            </div>
									   <span class="edit-pro pl-3 font-weight-bold"><a href="#" id='edit_user_image'>Edit</a></span>
									   <span class="remove-pro pl-3 font-weight-bold"><a href="#" id='remove_user_image' data-id="{{Auth::user()->id}}">Remove</a></span>
									</div>
								</div>
								
								<div class="row pt-5 pl-3 pr-3">
									<div class="col-lg-6">
										<div class="form-group">
											<div class="input-group mb-2">
												<div class="input-group-prepend">
													<div class="input-group-text"><img src="images/icon/name-icon.png" draggable="false"></div>
												</div>
												<div class="form-group">
													<label for="username" class="age-title profile-i-label mb-0">Name</label>
													<input type="text" class="form-control pro-in input-cl pl-0 profile_page" id="username" maxlength="100" name="username" aria-describedby="" placeholder="{{Auth::user()->name}}" value="{{Auth::user()->name}}" required>
												</div>
											</div>
										</div>	
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<div class="input-group mb-2">
												<div class="input-group-prepend">
													<div class="input-group-text"><img src="images/icon/email-icon.png" draggable="false"></div>
												</div>
												<div class="form-group">
													<label for="useremail" class="age-title profile-i-label mb-0">Email</label>
													<input type="email" class="form-control pro-in input-cl pl-0 profile_page" maxlength="100" id="useremail" name='useremail' aria-describedby="" placeholder="{{Auth::user()->email}}" value="{{Auth::user()->email}}">
												</div>
											</div>
										</div>	
									</div>
								</div>
								<div class="row pt-3 pl-3 pr-3">
									<div class="col-lg-6">
										<div class="form-group">
											<div class="input-group mb-2">
												<div class="input-group-prepend">
													<div class="input-group-text"><img src="images/icon/phone-icon.png" draggable="false"></div>
												</div>
												<div class="form-group">
													<label for="userphone" class="age-title profile-i-label mb-0">Phone</label>
													<input type="text" class="form-control pro-in input-cl pl-0 profile_page" id="userphone" readOnly="true" name='userphone' aria-describedby="" placeholder="+91 {{Auth::user()->phone}}" value="{{Auth::user()->phone}}" required>
												</div>
											</div>
										</div>	
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<div class="input-group mb-2">
												<div class="input-group-prepend">
													<div class="input-group-text"><img src="images/icon/gender-icon.png" draggable="false"></div>
												</div>
												<div class="form-group">
													<label for="usergender" class="age-title profile-i-label mb-0">Gender</label>
													<select class="form-control gender-cl pl-0 profile_page" id="usergender" placeholder="Matching" name='usergender'>
														<option value="{{Auth::user()->gender}}" {{Auth::user()->gender == 1? 'selected': ''}}> Male </option>
														<option value="{{Auth::user()->gender}}" {{Auth::user()->gender == 2? 'selected': ''}}> Female </option>
													</select>
												</div>
											</div>
										</div>	
									</div>
								</div>
								<div class="row pl-5">
									<button class="btn top-listing-btn white-color px-4 mt-4" type="submit">Save Changes</button>
									<!-- <button class="btn see-more-btn white-color px-4 mt-4 ml-2" type="button" onclick="window.location.reload();">Cancel</button> -->
								</div>
								</form>
							</div>
							<!-- <div role="tabpanel" class="tab-pane fade w-100" id="profile">
								<div class="row">
									if(count($favourites) > 0)
									foreach($favourites as $favourite)
									<div class="col-lg-4 col-md-6 col-12 mt-4">
										<div class="card">
											<div class="list_tile" data-id="$favourite->shelter_id}}" >
												<div class="card-head list_tile" id="bx-ht">
													<img id="bx-ht-hght" src="uploads/$favourite->images[0]}}" draggable="false" height="220px" style="max-width: 100%;">
												</div>
											</div>
											<div class="card-body pl-0 pr-0">
												<span class=" pb-3 font-weight-bold">
													<p class="addres mt-3 pb-0 font-weight-bold">
														<span>$favourite->flat_type}} BHK </span><span class="pl-3">$favourite->street}} $favourite->locality}} $favourite->city}}</span>
													</p>
													<p>
														<span class="blue-title font-weight-bold">&#x20B9; $favourite->expected_rent}} /  MONTH</span>
													</p>
													<button class="btn delete-more-btn white-color px-4 favUnfav" type="button" data-shelter="$favourite->shelter_id}}" data-user="{{Auth::user()->id}}" data-status="1">Remove</button>
											</div>
										</div>
									</div>
									endforeach
									else
									<div class="col-lg-4 col-md-6 col-12 mt-4">
									<h3 class='text-center'>No favourites added</h3>
									</div>
									endif
									<div class="col-lg-12">
										<div class="col-12 mx-auto" style="margin-bottom: 20px;">
											<div></div>
										</div>
									</div>
								</div>
							</div> -->
							<div role="tabpanel" class="tab-pane fade" id="messages">
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
							</div>
						</div>
					</div>
				</div>
			</div>	
	</div>
</section>

@include('layouts.footer')

@endsection
