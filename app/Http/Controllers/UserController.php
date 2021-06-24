<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\DeviceToken;
use App\NewsLetterSubscription;
use DB, Session;
use \Auth;
use App\FavouriteShelter;
use App\Helpers\OtpHelper;

class UserController extends Controller
{
	/* Phone Validation API */
	public function phoneValidate(Request $request){
		$data = $request->all();
		$validation = Validator::make($data, [
        	'phone' => 'required',
    	]);
        if ( $validation->fails() ) {
			if($validation->messages()->first('phone')){
		        $ret = array('success'=>false, 'message'=>$validation->messages()->first('phone'));
		        echo json_encode($ret);
        	}
        }else{
        	if($this->validatePhone(array('phone'=>$data['phone']))){
	        	$user = User::where('phone',$data['phone'])->first();
	        	if($user){
	 				// $otp = $this->generateOtp();
	 				$otp = '123456';
	 				date_default_timezone_set(env('DEFAULT_TIMEZONE'));
					$otp_expiry = date("Y-m-d H:i:s", strtotime('+'.env('OTP_EXPIRY_TIME').' hours'));

					$uData = array('otp'=>$otp,'otp_expiry'=>$otp_expiry);
					User::where('id',$user->id)->update($uData);
			        $ret = array('success'=>true, 'message'=>'Phone no validated');
			        echo json_encode($ret);
			        $message="Your OTP is ".$otp;
			        OtpHelper::sendOtp($otp,$data['phone'],$message);
	        	}else{
	 				// $data['otp'] = $this->generateOtp();
	 				$data['otp'] = '123456';
					date_default_timezone_set(env('DEFAULT_TIMEZONE'));
					$data['otp_expiry'] = date("Y-m-d H:i:s", strtotime('+'.env('OTP_EXPIRY_TIME').' hours'));
					if($user = User::create($data)){
				        $ret = array('success'=>true, 'message'=>'User created successfully!');
				        echo json_encode($ret);
				        $message="Your OTP is ".$data['otp'];
				        OtpHelper::sendOtp($data['otp'],$data['phone'],$message);
					}else{
				        $ret = array('success'=>false, 'message'=>'Something went wrong!');
				        echo json_encode($ret);
					}
	        	}
	        }else{
		        $ret = array('success'=>false, 'message'=>'Invalid Phone number');
		        echo json_encode($ret);
			}
        }

	}
	/* Phone Validation API Ends*/

	/* OTP Validation API */
	public function otpValidate(Request $request){
			$data = $request->all();
			$validation = Validator::make($data, [
					// 'phone' => 'required|regex:/[0-9]{10}/|digits:10',
					'phone' => 'required',
					'otp' => 'required'
			]);
			if ( $validation->fails() ) {
					if($validation->messages()->first('phone')){
						$ret = array('success'=>false, 'message'=>$validation->messages()->first('phone'));
						echo json_encode($ret);
					}
					elseif($validation->messages()->first('otp')){
						$ret = array('success'=>false, 'message'=>$validation->messages()->first('otp'));
					}
			}
			else{
					if($this->validatePhone(array('phone'=>$data['phone']))){
						$user = User::where('phone',$data['phone'])->first();
						if($user){
							$otpMatch = User::where('phone',$data['phone'])->where('otp',$data['otp'])->count();
							if($otpMatch == 1){
								date_default_timezone_set(env('DEFAULT_TIMEZONE'));
								$curTime = date("Y-m-d H:i:s");
								if(strtotime($curTime) <= strtotime($user->otp_expiry)){
									if(Auth::loginUsingId($user->id)){
										$user->otp = '';
										$user->save();
										$ret = array('success'=>true, 'message'=>'OTP Validated!', 'user'=>$user);
										\Session::flash('success','Successfully logged in');
										echo json_encode($ret);
									}
									else{
										$ret = array('success'=>false, 'message'=>'Login failed');
											echo json_encode($ret);
									}
								}else{
											$ret = array('success'=>false, 'message'=>'OTP expired');
											echo json_encode($ret);
								}
							}
							else{
								$ret = array('success'=>false, 'message'=>'OTP does not match');
								echo json_encode($ret);
							}
						}
						else{
							$ret = array('success'=>false, 'message'=>'You are not registered with us');
							echo json_encode($ret);
						}
					}else{
						$ret = array('success'=>false, 'message'=>'Invalid Phone number');
						echo json_encode($ret);
					}
			}	
	}
	/* OTP Validation API Ends*/

	/* Logout API */
	protected function logout(Request $request){
		$data = $request->all();
		$validation = Validator::make($data, [
        	'device_token' => 'required',
        	'device_type' => 'required',
        	'device_id' => 'required',
    	]);
        if ( $validation->fails() ) {
			if($validation->messages()->first('device_token')){
		        $ret = array('success'=>false, 'message'=>$validation->messages()->first('device_token'));
		        echo json_encode($ret);
        	}elseif($validation->messages()->first('device_type')){
		        $ret = array('success'=>false, 'message'=>$validation->messages()->first('device_type'));
		        echo json_encode($ret);
        	}elseif($validation->messages()->first('device_id')){
		        $ret = array('success'=>false, 'message'=>$validation->messages()->first('device_id'));
		        echo json_encode($ret);
        	}
        }else{
        	$tokenUser = DeviceToken::where('device_id',$data['device_id'])->where('device_type',$data['device_type'])->where('device_token',$data['device_token'])->first();
        	if($tokenUser){
        		DeviceToken::where('id',$tokenUser->id)->delete();
		        $ret = array('success'=>true, 'message'=>'Logged out');
		        echo json_encode($ret);
        	}else{
		        $ret = array('success'=>false, 'message'=>'You are not signed in!');
		        echo json_encode($ret);

        	}
        }
	}
	/* Logout API Ends*/

	/* generate otp */
	function generateOtp(){
		$digits = 6;
		return rand(pow(10, $digits-1), pow(10, $digits)-1);
	}
	/* generate otp ends */

	/* phone validation */
	function validatePhone($phone){
		$validator = Validator::make($phone,[
        	'phone' => "phone:IN"
        ]);
		if($validator->fails()){
			return false;
        }
        return true;
   	}
	/* phone validation ends */

	/* upload image api */
	public function uploadImage(Request $request){
		$data = $request->all();
        if(isset($data['image'])){
        	$image = $data['image'];
			if(substr($image->getMimeType(), 0, 5) == 'image') {
		    	$name = time().str_replace(' ','_',$image->getClientOriginalName());
		    	$destinationPath = 'public/uploads';
			    $image->move($destinationPath,$name);
		        $ret = array('success'=>true,'message'=>'Image uploaded.','name'=>$name);
	            echo json_encode($ret);
			}else{
		        $ret = array('success'=>false,'message'=>'Please upload valid image.');
		        echo json_encode($ret); 
			}
        }else{
	        $ret = array('success'=>false,'message'=>'Image not found.');
	        echo json_encode($ret); 
        }
	}
	/* upload image api ends */

	/* Sign out from web */
	public function signout(){
		Auth::logout();
		\Session::flash('success','Successfully logged out');
		return redirect()->back();
	}
	/* End Sign out from web */

	// Fetch Profile data
	public function profile(){
		if(Auth::check())
		{

			// $favourites = FavouriteShelter::where('favourite_shelter.user_id',Auth::user()->id)->whereNull('shelters.deleted_at')->join('shelters','shelters.id','favourite_shelter.shelter_id' )->select('favourite_shelter.*', 'shelters.flat_type', 'shelters.city', 'shelters.locality','shelters.street', 'shelters.expected_rent', 'shelters.images')->get();
		
			// 	foreach($favourites as $favourite){
			// 		$favourite->images = explode(',',$favourite->images);
			// 	}
			return view('front.profile');//->with('favourites', $favourites);
		}
		else{
			return redirect('/');
		}
	}
	// Fetch Profile data Ends

	function subscribenewsletter(Request $request){
		$data = $request->all();
		$validation = Validator::make($data, [
				'email' => 'required|email'
		]);
		if ( $validation->fails() ){
			return redirect()->back()->with('error', 'Please provide a valid email address');
		}
		$email=$data['email'];
		$subscribe = NewsLetterSubscription::updateOrCreate(["email" => $email],['email'=>$email]);
		\Session::flash('success','Successfully subscribed');
		return redirect('/');	
	}



	//Save Profile Data
	public function saveProfile(Request $request){		
		$data = $request->all();
		$flag = 0;
		$validator = Validator::make($data, [
			'username' => 'string',
			'userimage' => 'image|mimes:jpeg,png,jpg,gif,svg'
		]);	
		if($validator->fails()){
			return redirect()->back()->withInput()->with('error',$validator->messages()->first());
		}

		if(isset($data['useremail']) && $data['useremail']!=""){
			$useremail = User::where('email',$data['useremail'])->where('phone','!=',$data['userphone'])->get();
			if(count($useremail) > 0){
				return redirect()->back()->with('error','Email must be unique');
			}
		}		

		$userimage = $request->file('userimage');
		if($request->hasFile( 'userimage' )){
	        $imagename = $userimage->getClientOriginalName();
	        $imagename = time().'_'.$imagename;
	        $imagepath = public_path('/uploads');
	        $flag = 1;
    	}

	    $attr = [
	    	"phone" => $data['userphone']
	    ];

	    if($data['useremail']==""){
			$data['useremail']=NULL;
		}
	    
	    $val = [
	    	"name" => $data['username'],
	    	"email" => $data['useremail'],
	    	"gender" => $data['usergender'],
	    ];

	    if($flag == 1){
	    	$val["profile_image"] = $imagename;
	    }

    	if(User::where($attr)->update($val)){
    		if($flag == 1){
          		// Upload images in the mentioned folder
         		$userimage->move( $imagepath, $imagename );
          		//Deleting Previous File
          		if(isset($data['old_image_name']) && $data['old_image_name']!= ''){
              		$old_image = public_path('/uploads/').$data['old_image_name'];
              		if(file_exists($old_image)){
                  		unlink($old_image);
              		}
          		}
      		}
    		return redirect()->back()->with('success','Profile updated successfully');
    	}
    else{
    	return redirect()->back()->with('error','Error while updating profile');
    }

	}
	//Save Profile Data ends

	public function updateuserprofile(Request $request){
		$data = $request->all();
		if($data['email']==""){
			$data['email']=NULL;
		}
		/*$useremail = User::where('email',$data['email'])->where('phone','!=',$data['phone'])->get();
		if(count($useremail) > 0){
			$ret = array('success'=>0,'message'=>'Email Already Exist');
			echo json_encode($ret);
			exit;  
		}*/
		$val = [
			"name"   => $data['username'],
			"email"  => $data['email'],
			"gender" => $data['usergender']
		];
		if(User::where('phone',$data['phone'])->update($val)){
			$ret = array('success'=>1,'message'=>'successfully updated');
			echo json_encode($ret);			
		}else{
			$ret = array('success'=>2,'message'=>'something went wrong, please try later');
			echo json_encode($ret);			
		}
	}

	//Remove Profile Image
		public function removeProfileImage(Request $request){
			$data = $request->all();
			if(User::where('id',$data['id'])->update(['profile_image' => ''])){
				if(isset($data['old_image']) && $data['old_image']!= ''){
            $old_image = public_path('/uploads/').$data['old_image'];
            if(file_exists($old_image)){
                unlink($old_image);
            }
        }
        $ret = array('success'=>true,'message'=>'Image Successfully Removed');
	      echo json_encode($ret);  
			}
			else{
				$ret = array('success'=>false,'message'=>'Error Occured');
	      echo json_encode($ret);
			}

		}
	//Remove Profile ImageEnds

}
