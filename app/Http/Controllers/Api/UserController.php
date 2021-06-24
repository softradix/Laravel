<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Shelter;
use App\DeviceToken;
use DB;
use App\Helpers\OtpHelper;
use App\Countries;
use App\State;
use App\City;

class UserController extends Controller
{
	/* Signup API */
	/*protected function signup(Request $request){
		$data = $request->all();
		$validation = Validator::make($data, [
        	'email' => 'email|max:255|unique:users',
        	'password' => 'required|min:4',
        	'phone' => 'required|unique:users',
        	'device_token' => 'required',
        	'device_type' => 'required',
    	]);
        if ( $validation->fails() ) {
        	if($validation->messages()->first('email') != ''){
		        $ret = array('success'=>false, 'message'=>$validation->messages()->first('email'));
		        echo json_encode($ret);
        	}elseif($validation->messages()->first('password')){
		        $ret = array('success'=>false, 'message'=>$validation->messages()->first('password'));
		        echo json_encode($ret);
        	}elseif($validation->messages()->first('phone')){
		        $ret = array('success'=>false, 'message'=>$validation->messages()->first('phone'));
		        echo json_encode($ret);
        	}elseif($validation->messages()->first('device_token')){
		        $ret = array('success'=>false, 'message'=>$validation->messages()->first('device_token'));
		        echo json_encode($ret);
        	}elseif($validation->messages()->first('device_type')){
		        $ret = array('success'=>false, 'message'=>$validation->messages()->first('device_type'));
		        echo json_encode($ret);
        	}
        }else{
        	$data['password'] = bcrypt($data['password']);
    		$digits = 4;
			$data['otp'] = rand(pow(10, $digits-1), pow(10, $digits)-1);
			date_default_timezone_set(env('DEFAULT_TIMEZONE'));
			$data['otp_expiry'] = date("Y-m-d H:i:s", strtotime('+'.env('OTP_EXPIRY_TIME').' hours'));
			if($user = User::create($data)){
		        $ret = array('success'=>true, 'message'=>'User created successsfully!', 'otp'=>$data['otp']);
		        echo json_encode($ret);
			}else{
		        $ret = array('success'=>false, 'message'=>'Something went wrong!');
		        echo json_encode($ret);
			}
		}
	}*/
	/* Signup API Ends*/

	/* Login API */
	/*protected function login(Request $request){
		$data = $request->all();
		$validation = Validator::make($data, [
        	'phone' => 'required',
        	'device_token' => 'required',
        	'device_type' => 'required',
    	]);
        if ( $validation->fails() ) {
			if($validation->messages()->first('phone')){
		        $ret = array('success'=>false, 'message'=>$validation->messages()->first('phone'));
		        echo json_encode($ret);
        	}elseif($validation->messages()->first('device_token')){
		        $ret = array('success'=>false, 'message'=>$validation->messages()->first('device_token'));
		        echo json_encode($ret);
        	}elseif($validation->messages()->first('device_type')){
		        $ret = array('success'=>false, 'message'=>$validation->messages()->first('device_type'));
		        echo json_encode($ret);
        	}
        }else{
        	$user = User::where('phone',$data['phone'])->first();
        	if($user){
        		$digits = 4;
				$otp = rand(pow(10, $digits-1), pow(10, $digits)-1);
				date_default_timezone_set(env('DEFAULT_TIMEZONE'));
				$otp_expiry = date("Y-m-d H:i:s", strtotime('+'.env('OTP_EXPIRY_TIME').' hours'));
				$uData = array('otp'=>$otp,'otp_expiry'=>$otp_expiry);
				User::where('id',$user->id)->update($uData);
		        $ret = array('success'=>true, 'message'=>'Phone no validated', 'otp'=>$otp);
		        echo json_encode($ret);
        	}else{
		        $ret = array('success'=>false, 'message'=>'You are not registered with us');
		        echo json_encode($ret);
        	}
        }
	}*/
	/* Login API Ends*/

	/* Phone Validation API */
	protected function phoneValidate(Request $request){
		$data = $request->all();
		$app_share_url='https://tinyurl.com/y4v4fuf6';
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
	 				$otp = $this->generateOtp();
	 				date_default_timezone_set(env('DEFAULT_TIMEZONE'));
					$otp_expiry = date("Y-m-d H:i:s", strtotime('+'.env('OTP_EXPIRY_TIME').' hours'));

					$uData = array('otp'=>$otp,'otp_expiry'=>$otp_expiry);
					User::where('id',$user->id)->update($uData);
			        $ret = array('success'=>true,'app_share_url'=>$app_share_url,'message'=>'Phone no validated', 'otp'=>$otp);
			        echo json_encode($ret);
			        $message="Your OTP is ".$otp;
			        OtpHelper::sendOtp($otp,$data['phone'],$message);
	        	}else{
	 				$data['otp'] = $this->generateOtp();
					date_default_timezone_set(env('DEFAULT_TIMEZONE'));
					$data['otp_expiry'] = date("Y-m-d H:i:s", strtotime('+'.env('OTP_EXPIRY_TIME').' hours'));
					if($user = User::create($data)){
				        $ret = array('success'=>true,'app_share_url'=>$app_share_url,'message'=>'User created successsfully!', 'otp'=>$data['otp']);
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
	protected function otpValidate(Request $request){
		$data = $request->all();
		$validation = Validator::make($data, [
        	'phone' => 'required',
        	'otp' => 'required',
        	'device_token' => 'required',
        	'device_type' => 'required',
        	'device_id' => 'required',
    	]);
        if ( $validation->fails() ) {
			if($validation->messages()->first('phone')){
		        $ret = array('success'=>false, 'message'=>$validation->messages()->first('phone'));
		        echo json_encode($ret);
        	}elseif($validation->messages()->first('device_token')){
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
        	if($this->validatePhone(array('phone'=>$data['phone']))){
	        	$user = User::where('phone',$data['phone'])->first();
	        	if($user){
	        	// print_r($user->toArray());
	        	// exit;
							/*date_default_timezone_set(env('DEFAULT_TIMEZONE'));
							$curTime = date("Y-m-d H:i:s");
							$auth_token = $data['device_token'].$user->id.$data['device_id'];
							$user->otp = '';
							$user->save();
							//$uData = array('otp'=>'');
							//User::where('id',$user->id)->update($uData);
							$tokenData = array(
								"user_id" => $user->id,
								"device_id" => $data["device_id"],
								"device_token" => $data["device_token"],
								"device_type" => $data["device_type"],
								"auth_token" => $auth_token
							);

							DeviceToken::updateOrCreate(["device_token"=>$data["device_token"]],$tokenData);
							$user->tokens;
			        $ret = array('success'=>true, 'message'=>'OTP Validated!', 'user'=>$user);
			        echo json_encode($ret);*/

		        	$otpMatch = User::where('phone',$data['phone'])->where('otp',$data['otp'])->count();
		        	if($otpMatch == 1){
								date_default_timezone_set(env('DEFAULT_TIMEZONE'));
								$curTime = date("Y-m-d H:i:s");
								if(strtotime($curTime) <= strtotime($user->otp_expiry)){
									$auth_token = $data['device_token'].$user->id.$data['device_id'];
									$user->otp = '';
									$user->save();
									$user->device_token = $data['device_token'];
									$users_shelter_count = Shelter::where('user_id',$user->id)->where('is_active',1)->count();
									//$uData = array('otp'=>'');
									//User::where('id',$user->id)->update($uData);
									DeviceToken::where('device_token', $data['device_token'])->delete();
									$tokenData = array(
										"user_id" => $user->id,
										"device_id" => $data["device_id"],
										"device_token" => $data["device_token"],
										"device_type" => $data["device_type"],
										"auth_token" => $auth_token
									);
									DeviceToken::create($tokenData);
									$user->tokens;
									$user->shelter_counts = $users_shelter_count;
					        $ret = array('success'=>true, 'message'=>'OTP Validated!', 'user'=>$user);
					        echo json_encode($ret);
								}else{
					        $ret = array('success'=>false, 'message'=>'OTP expired');
					        echo json_encode($ret);
								}
		        	}else{
				        $ret = array('success'=>false, 'message'=>'OTP does not match');
				        echo json_encode($ret);
		        	}
	        	}else{
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

	/*** User Details ***/

	protected function usersDetails(Request $request){
		$data = $request->all();
		$authToken = $request->header('X-Access-Token');
		$user = DeviceToken::where('auth_token', $authToken)->first();
		if($user){
			$userdetails = User::where('id',$user->user_id)->first();
			$ret = array('success'=>true, 'message'=>'Users Details','data'=>$userdetails);
			echo json_encode($ret);			
		}else{
			$ret = array('success'=>false, 'message'=>'You are not an authorized user');
			echo json_encode($ret);
		}
	}

	/*** End ***/

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
				//$destinationPath = 'public/uploads';
				$destinationPath = 'uploads';
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

	protected function editProfile(Request $request){
		$data = $request->all();
		$authToken = $request->header('X-Access-Token');
		$user = DeviceToken::where('auth_token', $authToken)->first();
		if($user){
			$data_to_update = [];
			if(isset($data['name'])){
				$data_to_update["name"] = $data['name'];
			}else{
				$data_to_update["name"]="";
			}
			if(isset($data['email'])){
				$existingEmail = User::where('email',$data['email'])->where('id','!=',$user->user_id)->count();
				if( $existingEmail > 0 ){
					$ret = array('success'=>false, 'message'=>'The email has already been taken.');
					echo json_encode($ret);
					exit;
				}else{
					$data_to_update["email"] = $data['email'];
				}
			}else{
				$data_to_update["email"]="";
			}

			if(isset($data['gender'])){
				if($data['gender'] == "1" || $data['gender'] == "2"){
					$data_to_update["gender"] = $data['gender'];
				}else{
					$ret = array('success'=>false, 'message'=>'Invalid value in gender field');
					echo json_encode($ret);
					exit;
				}
			}

			if(isset($data['profile_image'])){
				$data_to_update["profile_image"] = $data['profile_image'];
			}else{
				$data_to_update["profile_image"]="";
			}

			if(User::where('id',$user->user_id)->update($data_to_update)){
				$user_details = User::where('id',$user->user_id)->first();
				$ret = array('success'=>true, 'message'=>'Data successfully updated', 'updated_user_details'=>$user_details);
				echo json_encode($ret);
			}else{
				$ret = array('success'=>false, 'message'=>'Error while updating data');
				echo json_encode($ret);
			}
		}
		else{
			$ret = array('success'=>false, 'message'=>'You are not an authorized user');
			echo json_encode($ret);
		}
	}

	protected function getstates(Request $request){
		$data = $request->all();
		$authToken = $request->header('X-Access-Token');
		$user = DeviceToken::where('auth_token', $authToken)->first();
		if($user){
			$statelist=State::where('country_id',101)->get();
			$ret = array('success'=>true,'statelist'=>$statelist,'message'=>'State list');
			echo json_encode($ret);	
		}else{
			$ret = array('success'=>false, 'message'=>'You are not an authorized user');
			echo json_encode($ret);
		}
	}

	protected function getStateCities(Request $request){
		$data = $request->all();
		$authToken = $request->header('X-Access-Token');
		$user = DeviceToken::where('auth_token', $authToken)->first();
		if($user){
			$cities=City::where('state_id',$data['state_id'])->get();
			$ret = array('success'=>true,'citylist'=>$cities,'message'=>'City list');
			echo json_encode($ret);	
		}else{
			$ret = array('success'=>false, 'message'=>'You are not an authorized user');
			echo json_encode($ret);
		}
	}
}
