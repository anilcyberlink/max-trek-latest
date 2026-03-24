<?php

namespace App\Models\Destinations;

use Illuminate\Database\Eloquent\Model;

class DestinationModel extends Model
{
    protected $table = 'cl_trip_destinations';
    protected $fillable = ['title', 'sub_title','excerpt','uri', 'content', 'thumbnail', 'ordering', 'status','banner','video'];

    public function trips()
    {
    return $this->belongsToMany('App\Models\Travels\TripModel', 'cl_trip_destination_rel', 'destination_id', 'trip_id')->where('status','1');
    }


}
