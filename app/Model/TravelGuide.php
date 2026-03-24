<?php

namespace App\Model;

use App\Models\Travels\TripModel;
use Illuminate\Database\Eloquent\Model;

class TravelGuide extends Model
{
   protected $fillable=['trip_id','category','title','description','brief','link','thumbnail','banner'];

   public function trips()
   {
       return $this->belongsTo('App\Models\Travels\TripModel','trip_id');
   }

   public function images()
   {
       return $this->hasMany('App\Model\GuideImage','guide_id');
   }
}
