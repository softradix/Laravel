<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/phoneValidate', 'Api\UserController@phoneValidate');
Route::post('/otpValidate', 'Api\UserController@otpValidate');
Route::post('/uploadImage', 'Api\UserController@uploadImage');
Route::get('/allappontments','Api\ShelterController@allappontments');

Route::group(['middleware' => 'UserAuth'], function(){
	Route::post('/addUserType', 'Api\UserController@addUserType');
	Route::post('/logout', 'Api\UserController@logout');

	/**** Users  ****/

	Route::post('/usersDetails', 'Api\UserController@usersDetails');
	/**** End  ****/
	

});
