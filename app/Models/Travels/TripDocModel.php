<?php

namespace App\Models\Travels;

use Illuminate\Database\Eloquent\Model;

class TripDocModel extends Model
{
    protected $table = 'cl_trip_docs';
    protected $fillable = ['trip_id', 'key_string', 'title', 'document', 'ordering','thumbnail'];
}
