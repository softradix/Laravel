<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\DeviceToken;

class UserAuthenticationToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $headerToken = $request->header('X-Access-Token');
        $exist = DeviceToken::where('auth_token',$headerToken)->first();
        if($exist){
            return $next($request);
        }else{
            $ret = array('success'=>false,'message'=>'You are not an authorized user');
            echo json_encode($ret); 
            die; 
        }
    }
}
