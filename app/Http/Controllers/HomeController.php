<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\DeviceToken;
use App\Shelter;
use App\Amenities;
use App\Rules;
use App\FavouriteShelter;
use App\ShelterAppointment;
use DB,Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $user = Auth::user();        
        if($user){           
            $user = $user->id;
        }else{            
            $user = 0;
        }        

        $featuredroomscount = Shelter::where('publish',1)->where('is_featured',1)->where('user_id','!=',$user)->where('is_active',1)->count();
        if($featuredroomscount>0){
            $featuredrooms = Shelter::where('publish',1)->where('is_featured',1)->where('user_id','!=',$user)->where('is_active',1)->paginate(15);    
        }else{
            $featuredrooms = Shelter::where('user_id','!=',$user)->where('publish',1)->where('is_active',1)->paginate(15);
            $featuredroomscount = $featuredrooms->count();   
        }
        foreach($featuredrooms as $sh){
            /*$img = explode(',',$sh->images);
            if(count($img)>0){
                $sh->img=$img[0];
            }else{
                $sh->img="";
            } */
            $sh->img=$sh->featuredimage;
        }        

        $topplacescount = Shelter::where('publish',1)->where('is_top_places',1)->where('user_id','!=',$user)->where('is_active',1)->count();

        if($topplacescount>0){
            $topplaces = Shelter::where('publish',1)->where('is_top_places',1)->where('user_id','!=',$user)->where('is_active',1)->paginate(15);    
        }else{
            $topplaces = Shelter::where('publish',1)->where('user_id','!=',$user)->where('is_active',1)->paginate(15);
            $topplacescount  = $topplaces->count();    
        }

        foreach($topplaces as $sh){
            /*$img = explode(',',$sh->images);
            if(count($img)>0){
                $sh->img=$img[0];
            }else{
                $sh->img="";
            } */
            $sh->img=$sh->featuredimage;
        } 

        //print'<pre>';print_R($featuredrooms);exit;

        return view('welcome')->with('featuredrooms', $featuredrooms)->with('featuredroomscount', $featuredroomscount)->with('topplaces', $topplaces)->with('topplacescount', $topplacescount);
    }
}
