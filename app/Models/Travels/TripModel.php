<?php

namespace App\Models\Travels;

use Illuminate\Database\Eloquent\Model;

class TripModel extends Model
{
    protected $table = 'cl_trip_details';
    protected $fillable = [
        'trip_title',
        'sub_title',
        'duration',
        'start_location',
        'end_location',
        'max_altitude',
        'best_season',
        'walking_per_day',
        'group_size',
        'accommodation',
        'meal',
        'route',
        'trip_highlight',
        'peak_name',
        'trip_type',
        'starting_price',
        'trip_map',
        'trip_video',
        'trip_chart',
        'trip_excerpt',
        'trip_content',
        'trip_grade',
        'status_text',
        'uri',
        'ordering',
        'trip_code',
        'meta_key',
        'meta_description',
        'banner',
        'thumbnail',
        'trip_pdf',
        'visiter',
        'video_status',
        'start_date',
        'is_menu',
        'guided_group',
        'discount'
    ];

    /* The destinations that belongs to the trip */
    public function destinations()
    {
        return $this->belongsToMany('App\Models\Destinations\DestinationModel', 'cl_trip_destination_rel', 'trip_id', 'destination_id');
    }

    // Related Trips
    public function relatedtrips()
    {
        return $this->belongsToMany('App\Models\Travels\TripModel', 'cl_related_trip_rel', 'trip_id', 'related_trip_id')->where('status', '1');
    }

    /* The regions that belongs to the trip */
    public function regions()
    {
        return $this->belongsToMany('App\Models\Travels\RegionModel', 'cl_trip_region_rel', 'trip_id', 'region_id');
    }

    /* The activities that belongs to the trip */
    public function activities()
    {
        return $this->belongsToMany('App\Models\Travels\ActivityModel', 'cl_trip_activity_rel', 'trip_id', 'activity_id');
    }

    /* The trip groups that belongs to the trip */
    public function tripgroups()
    {
        return $this->belongsToMany('App\Models\Travels\TripGroupModel', 'cl_trip_group_rel', 'trip_id', 'group_id');
    }

    public function gears()
    {
        return $this->hasMany('App\Models\Travels\TripGearModel', 'trip_detail_id');
    }

    public function costincludes()
    {
        return $this->hasMany('App\Models\Cost\CostIncludesModel', 'trip_detail_id')->orderBy('ordering');
    }

    public function costexcludes()
    {
        return $this->hasMany('App\Models\Cost\CostExcludesModel', 'trip_detail_id')->orderBy('ordering');
    }

    public function itineraries()
    {
        return $this->hasMany('App\Models\Travels\TripItineraryModel', 'trip_detail_id')->orderBy('ordering');
    }
    public function schedules()
    {
        return $this->hasMany('App\Models\Travels\TripScheduleModel', 'trip_detail_id')->orderby('ordering', 'asc');
    }
    public function useful_infos()
    {
        return $this->hasMany('App\Models\Travels\TripUsefulModel', 'trip_detail_id')->orderby('ordering', 'asc');
    }

    public function get_trip_grade_data()
    {
        return $this->belongsTo(TripGradeModel::class, 'trip_grade');
    }

    public function tripsType()
    {
        return $this->belongsTo(TripTypeModel::class, 'trip_type');
    }
}
