<?php

namespace App\Models\Travels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripUsefulModel extends Model
{
    use HasFactory;
    protected $table = 'cl_trip_useful';
    protected $fillable = ['trip_detail_id','title','description','ordering'];
}
