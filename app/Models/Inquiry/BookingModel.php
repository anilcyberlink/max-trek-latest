<?php

namespace App\Models\Inquiry;

use Illuminate\Database\Eloquent\Model;

class BookingModel extends Model
{
    protected $table = 'cl_trip_booking';
    protected $fillable = ['trip_id', 'schedule_id', 'title', 'full_name', 'country', 'email', 'phone', 'departure_date', 'start_date', 'end_date', 'comments', 'terms_conditions', 'status', 'num_people'];

    public function bookTrips()
    {
        return $this->belongsTo('App\Models\Travels\TripModel', 'trip_id');
    }
}





