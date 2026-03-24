<?php

namespace App\Models\Travels;

use Illuminate\Database\Eloquent\Model;

class ActivityModel extends Model
{
    protected $table = 'cl_trip_activities';
    protected $fillable = ['title','sub_title','template','uri','thumbnail','banner','excerpt','content','meta_keyword','meta_description','ordering','status','isdefault','category_video'];

     public function trips(){
    	return $this->belongsToMany('App\Models\Travels\TripModel','cl_trip_activity_rel','activity_id','trip_id');
    }

    public function regions(){
        return $this->belongsToMany('App\Models\Travels\RegionModel','cl_trip_activity_region_rel','activity_id','region_id');
    }
}
