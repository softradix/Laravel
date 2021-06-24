<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shelter extends Model
{	
	use SoftDeletes;
	protected $table = 'shelters';
	protected $dates = ['deleted_at'];
    protected $fillable = [

    	'user_id', 'title', 'images', 'property_type', 'looking_for', 'building_age', 'no_of_floor', 'flat_type', 'flat_size', 'no_of_washroom', 'furniture', 'guest_preferred', 'sharing_type', 'no_of_beds', 'member_allowed', 'expected_rent', 'security_deposit', 'payment_month', 'states' ,'city', 'locality', 'street', 'pincode', 'latitude', 'longitude', 'amenities', 'electricity_charge', 'cleaning_charge', 'wifi_charge', 'other_service', 'other_services_charges','cylinder', 'rules', 'description', 'owner_name', 'contact_no', 'email', 'available_date', 'appointment', 'selected_days', 'timings_from', 'timings_to', 'publish', 'approved', 'created_at', 'updated_at','food','property_feature','other_property_feature','is_top_places','is_featured','is_verified','featuredimage','location_details'
    ];

    public function usersdetails(){
        return $this->hasOne('App\User','id','user_id');
    }

}
