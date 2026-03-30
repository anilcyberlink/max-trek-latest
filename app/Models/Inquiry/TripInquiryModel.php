<?php

namespace App\Models\Inquiry;

use Illuminate\Database\Eloquent\Model;

class TripInquiryModel extends Model
{
    protected $table = 'trip_inquiries';
    protected $fillable = [
        'title',
        'trip_id',
        'name',
        'email',
        'number',
        'review',
        'group_size',
        'duration',
        'country',
        'trip_start_date'
    ];
}
