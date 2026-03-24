<?php

namespace App\Models\Travels;

use Illuminate\Database\Eloquent\Model;

class TripItineraryModel extends Model
{
    protected $table = 'cl_trip_itinerary';
    protected $fillable = ['trip_detail_id','days', 'meals','accommodation','title','content','ordering'];
}
