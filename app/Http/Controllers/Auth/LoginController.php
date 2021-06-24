<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\Admin;
use Auth;
use DB, Session, Cache;
use Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function showLogin(){
        if(Auth::guard('admin')->check()){
            return redirect('/admin/users-list');
        }else{
            return view('auth.login');
        }
    }

    public function authenticateadmin(Request $request){
        if(Auth::guard('admin')->check()){
            return redirect('/admin/users-list');
        }
        $input = $request->all();
        $email = $input['email'];
        $password = $input['password'];
        $credentials = [
            "email" => $email,
            "password" => $password
        ];
        $admin = Auth::guard('admin')->attempt($credentials);
        if($admin){
            return redirect('/admin/users-list');
        }else{ 
            return back()->withInput()->with('warning','Please enter valid login details!');
        }
    }
    public function admin_logout(Request $request){
        Auth::guard('admin')->logout();
        Cache::flush();
        // $request->session()->flush();
        // $request->session()->regenerate();
        // echo '1-><pre>';print_r(Auth::guard('admin')->user());echo '</pre>';
        // $this->auth('admin')->logout(); 
        // $this->guard('admin')->logout();  
        // Auth::guard('admin')->logout();
        // echo '2-><pre>';print_r(Auth::guard('admin')->user());exit;
		return redirect('/admin');
	}
}
