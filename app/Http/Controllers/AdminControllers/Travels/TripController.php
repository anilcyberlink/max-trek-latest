<?php

namespace App\Http\Controllers\AdminControllers\Travels;

use App\Models\Travels\TripUsefulModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Travels\TripModel;
use App\Models\Travels\RegionModel;
use App\Http\Controllers\Controller;
use App\Models\Travels\ActivityModel;
use App\Models\Travels\TripGearModel;
use App\Models\Travels\TripTypeModel;
use Intervention\Image\Facades\Image;
use App\Models\Cost\CostExcludesModel;
use App\Models\Cost\CostIncludesModel;
use App\Models\Travels\TripGradeModel;
use App\Models\Travels\TripGroupModel;
use Illuminate\Support\Facades\Validator;
use App\Models\Travels\TripItineraryModel;
use App\Models\Travels\TripScheduleModel;
use App\Models\Destinations\DestinationModel;

class TripController extends Controller
{

    public function __construct()
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TripModel::orderBy('id', 'desc')->get();
        foreach($data as $row){
            if (is_array($row->tripstype)){
                foreach($row->tripstype as $value){
                    $test = $value->tripstype;
                    // dd($test->trip_type);
                }
            }
            else{

                $test = $row->tripstype;
                // dd($test->trip_type);
            }
        }
        $popular_trip = TripGroupModel::where('id',1)->orderBy('ordering','asc')->first();
        return view('admin.trips.index', compact('data','popular_trip'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinations = DestinationModel::all();
        $regions = RegionModel::all();
        $activities = ActivityModel::all();
        $trip_groups = TripGroupModel::all();      
        $ordering = TripModel::max('ordering');       
        $ordering += 1;
        $all_trips = TripModel::get();
        $grades = TripGradeModel::all();
        $trip_type = TripTypeModel::get();
        $trek=TripGradeModel::get();

        return view('admin.trips.create', compact('trek','all_trips', 'trip_type', 'grades', 'ordering', 'destinations', 'regions', 'activities', 'trip_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
              'trip_title' => 'required|unique:cl_trip_details,trip_title',
              'starting_price' => 'numeric|nullable',
              'discount' => 'numeric|nullable'

            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()->all()
                ]);
            }

            $data = $request->all();

            /*************Banner Upload************/
            $file = $request->file('banner');
            $banner_name = '';
            if ($request->hasfile('banner')) {
                $banner = $request->file('banner')->getClientOriginalName();
                $extension = $request->file('banner')->getClientOriginalExtension();
                $banner = explode('.', $banner);
                $banner_name = Str::slug($banner[0]) . '-' . Str::random(5) . '.' . $extension;

                $destinationPath = public_path('uploads/banners');

                $banner_picture = Image::make($file->getRealPath());                
                $banner_picture->save($destinationPath . '/' . $banner_name);
            }

            /******Upload Thumbnail******/
            $thumb_file = $request->file('thumbnail');
            $thumbnail_name = '';
            if ($request->hasfile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')->getClientOriginalName();
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $thumbnail = explode('.', $thumbnail);
                $thumbnail_name = Str::slug($thumbnail[0]) . '-' . Str::random(5) . '.' . $extension;

                $destinationPath = public_path('uploads/original');

                $thumbnail_picture = Image::make($thumb_file->getRealPath());
                $width = Image::make($thumb_file->getRealPath())->width();
                $height = Image::make($thumb_file->getRealPath())->height();
                $thumbnail_picture->save($destinationPath . '/' . $thumbnail_name);
            }
            /*************PDF****************/
            $pdf_file = $request->file('upload_pdf');
            $pdf_name = '';
            if ($request->hasfile('upload_pdf')) {
                $pdf = $request->file('upload_pdf')->getClientOriginalName();
                $extension = $request->file('upload_pdf')->getClientOriginalExtension();
                $pdf = explode('.', $pdf);
                $pdf_name = Str::slug($pdf[0]) . '-' . Str::random(5) . '.' . $extension;
                $destinationPath = public_path('uploads/pdf');  
                $pdf_file->move($destinationPath, $pdf_name);
            }
                
            $data['trip_pdf'] = $pdf_name;

            /******Upload Trip Map******/
            $map_file = $request->file('trip_map');
            $map_file_name = '';
            if ($request->hasfile('trip_map')) {
                $map_thumbnail = $request->file('trip_map')->getClientOriginalName();
                $map_extension = $request->file('trip_map')->getClientOriginalExtension();
                $map_thumbnail = explode('.', $map_thumbnail);
                $map_file_name = time() . '_' . Str::slug($map_thumbnail[0]) . '-' . Str::random(5) . '.' . $map_extension;

                $map_destinationPath = public_path('uploads/original');

                $map_thumbnail_picture = Image::make($map_file->getRealPath());
                $map_width = Image::make($map_file->getRealPath())->width();
                $map_height = Image::make($map_file->getRealPath())->height();
                $map_thumbnail_picture->resize($map_width, $map_height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($map_destinationPath . '/' . $map_file_name);
            }
            /*****************************/

            /******Upload Trip Altitude Chart******/
            $chart_file = $request->file('trip_chart');
            $chart_file_name = '';
            if ($request->hasfile('trip_chart')) {
                $chart_thumbnail = $request->file('trip_chart')->getClientOriginalName();
                $chart_extension = $request->file('trip_chart')->getClientOriginalExtension();
                $chart_thumbnail = explode('.', $chart_thumbnail);
                $chart_file_name = time() . '_' . Str::slug($chart_thumbnail[0]) . '-' . Str::random(5) . '.' . $chart_extension;

                $chart_destinationPath = public_path('uploads/original');

                $chart_thumbnail_picture = Image::make($chart_file->getRealPath());
                $chart_width = Image::make($chart_file->getRealPath())->width();
                $chart_height = Image::make($chart_file->getRealPath())->height();
                $chart_thumbnail_picture->resize($chart_width, $chart_height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($chart_destinationPath . '/' . $chart_file_name);
            }
            /*****************************/

            if ($request->trip_code == NULL) {
                $data['trip_code'] = rand() . '-' . time();
            }

            $data['uri'] = Str::slug($request->uri);
            $data['banner'] = $banner_name;
            $data['thumbnail'] = $thumbnail_name;
            $data['trip_map'] = $map_file_name;
            $data['trip_chart'] = $chart_file_name;

            $is_draft = '0';
            if ($request->submit == 'publish') {
                $is_draft = '0';
            } else if ($request->submit == 'draft') {
                $is_draft = '1';
            }
            $data['is_draft'] = $is_draft;
            $result = TripModel::create($data);
            $last_id = $result->id;

            // Insert into itinerary
              if(isset($request->itinerary_ordering)){
                $keys = array_keys($request->itinerary_ordering);   
                $sn_itinerary = 1;
              $sn_itinerary_count = count($request->itinerary_ordering);
                foreach($keys as $key){
                  if( $key + 1 >= $sn_itinerary_count ){
                    continue;
                  }
                  $tripItinerary = new TripItineraryModel();
                  $tripItinerary->trip_detail_id = $last_id;
                  $tripItinerary->ordering = $request->itinerary_ordering[$key];  
                  $tripItinerary->days = $request->itinerary_days[$key];
                  $tripItinerary->title = $request->itinerary_title[$key];
                  $tripItinerary->meals = $request->itinerary_meals[$key];
                  $tripItinerary->accommodation = $request->itinerary_accommodation[$key];
                  $tripItinerary->content = $request->itinerary_content[$key];          
                  $tripItinerary->save(); 
                  $sn_itinerary++;     
                }
              }            

            // Insert Photo Videos
            if (isset($request->gear_ordering)) {
                $gear_keys = array_keys($request->gear_ordering);
                $sn_gear = 1;
                $sn_gear_count = count($request->gear_ordering);
                foreach ($gear_keys as $key => $value) {
                    if ($key + 1 >= $sn_gear_count) {
                        continue;
                    }
                    $gearData = new TripGearModel();
                    $gearData->trip_detail_id = $last_id;
                    $thumb_file = $request->file('gear_thumbnail');
                    if (isset($thumb_file[$value])) {
                        $thumb = time() . '-' . Str::random(5) . $thumb_file[$value]->getClientOriginalName();
                        $destinationPath = public_path('uploads/original');
                        $thumb_file[$value]->move($destinationPath, $thumb);
                        $gearData->thumbnail = $thumb;
                    }
                    $gearData->ordering = $request->gear_ordering[$key];
                    $gearData->title = $request->gear_title[$key];
                    // $gearData->content = $request->gear_content[$key];
                    $gearData->video = $request->gear_video[$key];
                    $gearData->save();
                    $sn_gear++;
                }
            }           

 
             // Insert into testimonial
              if(isset($request->testimonial_ordering)){
                $testimonial_keys = array_keys($request->testimonial_ordering);   
                $sn_testimonial = 1;
                $sn_testimonial_count = count($request->testimonial_ordering);
                foreach($testimonial_keys as $key){
                  if( $key + 1 >= $sn_testimonial_count ){ 
                    continue;
                  }
                  $tripTestimonial = new CostIncludesModel();
                  $tripTestimonial->trip_detail_id = $last_id;       
                  $tripTestimonial->ordering = $request->testimonial_ordering[$key];   
                  $tripTestimonial->title = $request->testimonial_title[$key];    
                  $tripTestimonial->save(); 
                  $sn_testimonial++;     
                }
              }
              // Insert into schedule
                if (isset($request->schedule_ordering)) {
                    $schedule_keys = array_keys($request->schedule_ordering);
                    $sn_schedule = 1;
                    $sn_schedule_count = count($request->schedule_ordering);
                    foreach ($schedule_keys as $key) {
                        if ($key + 1 >= $sn_schedule_count) {
                            continue;
                        }
                        $tripSchedule = new TripScheduleModel();
                        $tripSchedule->trip_detail_id = $last_id;
                        $tripSchedule->start_date = $request->schedule_start_date[$key];
                        $tripSchedule->end_date = $request->schedule_end_date[$key];
                        $tripSchedule->group_size = $request->schedule_group_size[$key];
                        $tripSchedule->availability = $request->schedule_availability[$key];
                        // $tripSchedule->price = $request->schedule_price[$key];
                        $tripSchedule->remarks = $request->schedule_remarks[$key];
                        $tripSchedule->ordering = $request->schedule_ordering[$key];
                        $tripSchedule->save();
                        $sn_schedule++;
                    }
                }
                // Insert into useful information
                if (isset($request->useful_ordering)) {
                    $useful_keys = array_keys($request->useful_ordering);
                    $sn_useful = 1;
                    $sn_useful_count = count($request->useful_ordering);
                    foreach ($useful_keys as $key) {
                        if ($key + 1 >= $sn_useful_count) {
                            continue;
                        }
                        $tripUseful = new TripUsefulModel();
                        $tripUseful->trip_detail_id = $last_id;
                        $tripUseful->title = $request->useful_title[$key];
                        $tripUseful->description = $request->useful_description[$key];
                        $tripUseful->ordering = $request->useful_ordering[$key];
                        $tripUseful->save();
                        $sn_useful++;
                    }
                }
              // Insert into Info
              if(isset($request->info_ordering)){
                $info_keys = array_keys($request->info_ordering);   
                $sn_info = 1;
                $sn_info_count = count($request->info_ordering);
                foreach($info_keys as $key){
                  if( $key + 1 >= $sn_info_count ){
                    continue;
                  }
                  $tripInfo = new CostExcludesModel();
                  $tripInfo->trip_detail_id = $last_id;       
                  $tripInfo->ordering = $request->info_ordering[$key];   
                  $tripInfo->title = $request->info_title[$key];    
                  $tripInfo->save(); 
                  $sn_info++;     
                }
              }            

        /************Attach******************/
        $_data = TripModel::find($last_id);
        $_data->destinations()->attach($request->destination);
        $_data->regions()->attach($request->region);
        $_data->activities()->attach($request->activity);
        $_data->tripgroups()->attach($request->tripgroup);      
       
        /************************************/
        return response()->json(['status' => 'success', 'message' => 'Trip Added Successfully']);
    }
    return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TripModel::find($id);
        $checked_destinations = array();
        $checked_regions = array();
        $checked_activities = array();
        $checked_tripgroups = array();
       
       
        foreach ($data->destinations as $value) {
            $checked_destinations[] = $value->pivot->destination_id;
        }
        foreach ($data->regions as $value) {
            $checked_regions[] = $value->pivot->region_id;
        }
        foreach ($data->activities as $value) {
            $checked_activities[] = $value->pivot->activity_id;
        }
        foreach ($data->tripgroups as $value) {
            $checked_tripgroups[] = $value->pivot->group_id;
        }

        $destinations = DestinationModel::all();
        $regions = RegionModel::all();
        $activities = ActivityModel::all();
        $trip_groups = TripGroupModel::all();
        $schedules = $data->schedules()->orderBy('ordering','asc')->get();
        $itineraries = $data->itineraries()->get();
        $useful_info = $data->useful_infos()->get();
        $gears = $data->gears()->get();
        $costincludes = $data->costincludes()->get();
        $costexcludes = $data->costexcludes()->get();
        $all_trips = TripModel::get();
        $grades = TripGradeModel::all();
        $trip_type = TripTypeModel::get();
        $trek=TripGradeModel::get();
        // dd($schedules);
        return view('admin.trips.edit', compact(
          'trek',
            'all_trips',
            'data',
            'trip_type',
            'destinations',
            'regions',
            'activities',
            'trip_groups',
            'checked_destinations',
            'checked_regions',
            'checked_activities',
            'checked_tripgroups', 
            'itineraries',
            'gears',
            'schedules',
            'costincludes',
            'costexcludes',
            'grades','useful_info'
         ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $validator = Validator::make($request->all(), [
                'trip_title' => 'required|unique:cl_trip_details,trip_title,' . $id,
               'starting_price' => 'numeric|nullable',
              'discount' => 'numeric|nullable'
                
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()->all()
                ]);
            }


        if ($request->ajax()) {
            $is_draft = 0;
            if ($request->submit == 'publish') {
                $is_draft = 0;
            } else if ($request->submit == 'draft') {
                $is_draft = 1;
            }

            $data = TripModel::find($id);

            $file = $request->file('banner');
            $thumbnail_file = $request->file('thumbnail');
            $tripmap_file = $request->file('trip_map');
            $tripchart_file = $request->file('trip_chart');
            $banner_name = '';
            $thumbnail_name = '';
            $trip_map_name = '';
            if ($request->hasfile('banner')) {
                $data = TripModel::find($id);
                if ($data->banner) {
                    if (file_exists(env('PUBLIC_PATH') . 'uploads/banners/' . $data->banner)) {
                        unlink(env('PUBLIC_PATH') . 'uploads/banners/' . $data->banner);
                    }
                }
                $banner = $request->file('banner')->getClientOriginalName();
                $extension = $request->file('banner')->getClientOriginalExtension();
                $banner = explode('.', $banner);
                $banner_name = Str::slug($banner[0]) . '-' . Str::random(5) . '.' . $extension;
                $destinationPath = public_path('uploads/banners');
                $banner_picture = Image::make($file->getRealPath());
                $width = Image::make($file->getRealPath())->width();
                $height = Image::make($file->getRealPath())->height();

                $banner_picture->save($destinationPath . '/' . $banner_name);
                $data->banner = $banner_name;
                $data->save();
            }
            /******PDF*********/
            $pdf_file = $request->file('upload_pdf');
            $pdf_name = '';
            if($request->hasfile('upload_pdf')){
                $data = TripModel::find($id);
                if ($data->upload_pdf) {
                    if (file_exists(env('PUBLIC_PATH') . 'uploads/pdf/' . $data->upload_pdf)) {
                        unlink(env('PUBLIC_PATH') . 'uploads/pdf/' . $data->upload_pdf);
                    }
                }
                $pdf = $request->file('upload_pdf')->getClientOriginalName();
                $extension = $request->file('upload_pdf')->getClientOriginalExtension();
                $pdf = explode('.', $pdf);
                $pdf_name = time() . '_' . Str::slug($pdf[0]) . '-' . Str::random(5) . '.' . $extension;
                $destinationPath = public_path('uploads/pdf');
                $pdf_file->move($destinationPath, $pdf_name);
                $data->trip_pdf = $pdf_name;
                $data->save();
            }
           
            /*****Thumbnail*****/
            if ($request->hasfile('thumbnail')) {
                $data = TripModel::find($id);
                if ($data->thumbnail) {
                    if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail)) {
                        unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail);
                    }
                }
                $thumbnail = $request->file('thumbnail')->getClientOriginalName();
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $thumbnail = explode('.', $thumbnail);
                $thumbnail_name = time() . '_' . Str::slug($thumbnail[0]) . '-' . Str::random(5) . '.' . $extension;
                $destinationPath = public_path('uploads/original');
                $thumbnail_picture = Image::make($thumbnail_file->getRealPath());
                $width = Image::make($thumbnail_file->getRealPath())->width();
                $height = Image::make($thumbnail_file->getRealPath())->height();

                $thumbnail_picture->save($destinationPath . '/' . $thumbnail_name);
                $data->thumbnail = $thumbnail_name;
                $data->save();
            }

            /************Trip Map*************/
            if ($request->hasfile('trip_map')) {
                $data = TripModel::find($id);
                if ($data->trip_map) {
                    if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->trip_map)) {
                        unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->trip_map);
                    }
                }
                $trip_map = $request->file('trip_map')->getClientOriginalName();
                $extension = $request->file('trip_map')->getClientOriginalExtension();
                $trip_map = explode('.', $trip_map);
                $trip_map_name = Str::slug($trip_map[0]) . '-' . Str::random(5) . '.' . $extension;
                $destinationPath = public_path('uploads/original');
                $trip_map_picture = Image::make($tripmap_file->getRealPath());
                $width = Image::make($tripmap_file->getRealPath())->width();
                $height = Image::make($tripmap_file->getRealPath())->height();

                $trip_map_picture->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $trip_map_name);
                $data->trip_map = $trip_map_name;
                 $data->save();
            }
            /************Trip Chart*************/
            if ($request->hasfile('trip_chart')) {
                $data = TripModel::find($id);
                if ($data->trip_chart) {
                    if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->trip_chart)) {
                        unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->trip_chart);
                    }
                }
                $trip_chart = $request->file('trip_chart')->getClientOriginalName();
                $extension = $request->file('trip_chart')->getClientOriginalExtension();
                $trip_chart = explode('.', $trip_chart);
                $trip_chart_name = Str::slug($trip_chart[0]) . '-' . Str::random(5) . '.' . $extension;
                $destinationPath = public_path('uploads/original');
                $trip_chart_picture = Image::make($tripchart_file->getRealPath());
                $width = Image::make($tripchart_file->getRealPath())->width();
                $height = Image::make($tripchart_file->getRealPath())->height();

                $trip_chart_picture->save($destinationPath . '/' . $trip_chart_name);
                $data->trip_chart = $trip_chart_name;
                 $data->save();
            }
            $data->trip_title = $request->trip_title;
            $data->sub_title = $request->sub_title;
            $data->duration = $request->duration;
            $data->start_location = $request->start_location;
            $data->end_location = $request->end_location;
            $data->max_altitude = $request->max_altitude;
            $data->best_season = $request->best_season;
            $data->walking_per_day = $request->walking_per_day;
            $data->group_size = $request->group_size;
            $data->accommodation = $request->accommodation;
            $data->meal = $request->meal;
            $data->route = $request->route;
            $data->trip_highlight = $request->trip_highlight;
            $data->peak_name = $request->peak_name;
            $data->trip_type = $request->trip_type;
            $data->starting_price = $request->starting_price;
            $data->trip_video = $request->trip_video;
            $data->trip_excerpt = $request->trip_excerpt;
            $data->trip_content = $request->trip_content;
            $data->trip_grade = $request->trip_grade ? $request->trip_grade : '';
            $data->status_text = $request->status_text;
            $data->uri = Str::slug($request->uri);
            $data->ordering = $request->ordering;
            $data->trip_code = $request->trip_code;
            $data->meta_key = $request->meta_key;
            $data->meta_description = $request->meta_description;
            $data->is_draft = $is_draft;
            // $data->is_menu = $request->is_menu;
            $data->video_status=$request->video_status;
            $data->start_date = $request->start_date;
            $data->guided_group = $request->guided_group;
            $data->discount = $request->discount;
           
            $_data = TripModel::find($id);
            $_data->destinations()->detach();
            $_data->destinations()->attach($request->destination);
            $_data->regions()->detach();
            $_data->regions()->attach($request->region);
            $_data->activities()->detach();
            $_data->activities()->attach($request->activity);
            $_data->tripgroups()->detach();
            $_data->tripgroups()->attach($request->tripgroup);
            $_data->relatedtrips()->detach();
            $_data->relatedtrips()->attach($request->related_trips);
            
            // Update Schedule
            if (isset($request->schedule_ordering)) {
                $schedule_keys = array_keys($request->schedule_ordering);
                $sn_schedule = 1;
                $sn_schedule_count = count($request->schedule_ordering);
                foreach ($schedule_keys as $key => $value) {
                    if ($key + 1 >= $sn_schedule_count) {
                        continue;
                    }
                    if ($request->schedule_id[$value] == "") {
                        $scheduleData = new TripScheduleModel();
                        $scheduleData->trip_detail_id = $data->id;
                        $scheduleData->ordering = $request->schedule_ordering[$key];
                        $scheduleData->start_date = $request->schedule_start_date[$key];
                        $scheduleData->end_date = $request->schedule_end_date[$key];
                        $scheduleData->group_size = $request->schedule_group_size[$key];
                        $scheduleData->availability = $request->schedule_availability[$key];
                        // $scheduleData->price = $request->schedule_price[$key];
                        $scheduleData->remarks = $request->schedule_remarks[$key];
                        $scheduleData->save();
                    } else if ($request->schedule_id[$value] !== null && $request->schedule_id[$value] !== "") {
                        $schedule_id = $request->schedule_id[$value];
                        $scheduleData = TripScheduleModel::find($schedule_id);
                        $scheduleData->trip_detail_id = $data->id;
                        $scheduleData->ordering = $request->schedule_ordering[$key];
                        $scheduleData->start_date = $request->schedule_start_date[$key];
                        $scheduleData->end_date = $request->schedule_end_date[$key];
                        $scheduleData->group_size = $request->schedule_group_size[$key];
                        $scheduleData->availability = $request->schedule_availability[$key];
                        // $scheduleData->price = $request->schedule_price[$key];
                        $scheduleData->remarks = $request->schedule_remarks[$key];
                        $scheduleData->save();
                    }
                    $sn_schedule++;
                }
            }
            // Update itinerary
            if (isset($request->itinerary_ordering)) {
                $keys = array_keys($request->itinerary_ordering);
                $sn_itinerary = 1;
                $sn_itinerary_count = count($request->itinerary_days);
                foreach ($keys as $key => $value) {
                    if ($key + 1 >= $sn_itinerary_count) {
                        continue;
                    }
                    if($request->itinerary_content[$value] == NULL && $request->itinerary_title[$value] == NULL){
                        continue;
                    }
                    if ($request->itinerary_id[$value] == "") {
                        $itineraryData = new TripItineraryModel();
                        $itineraryData->trip_detail_id = $data->id;
                        $itineraryData->ordering = $request->itinerary_ordering[$key];
                        $itineraryData->days = $request->itinerary_days[$key];
                        $itineraryData->title = $request->itinerary_title[$key];
                        $itineraryData->meals = $request->itinerary_meals[$key];
                        $itineraryData->accommodation = $request->itinerary_accommodation[$key];
                        $itineraryData->content = $request->itinerary_content[$key];
                        $itineraryData->save();
                    } else if ($request->itinerary_id[$value] !== null && $request->itinerary_id[$value] !== "") {
                        $itinerary_id = $request->itinerary_id[$value];
                        $itineraryData = TripItineraryModel::find($itinerary_id);
                        $itineraryData->trip_detail_id = $data->id;
                        $itineraryData->ordering = $request->itinerary_ordering[$key];
                        $itineraryData->days = $request->itinerary_days[$key];
                        $itineraryData->title = $request->itinerary_title[$key];
                        $itineraryData->meals = $request->itinerary_meals[$key];
                        $itineraryData->accommodation = $request->itinerary_accommodation[$key];
                        $itineraryData->content = $request->itinerary_content[$key];
                        $itineraryData->save();
                    }
                    $sn_itinerary++;
                }
            }

            // Update Photos Videos

            if (isset($request->gear_id)) {
                $gear_keys = array_keys($request->gear_id);
                $sn_gear = 1;
                $sn_gear_count = count($request->gear_id);

                foreach ($gear_keys as $key => $value) {
                    if ($key + 1 >= $sn_gear_count) {
                        continue;
                    }
                    if ($request->gear_id[$value] == "") {
                        $gearData = new TripGearModel();
                        $gearData->trip_detail_id = $data->id;
                        $thumb_file = $request->file('gear_thumbnail');
                        if (isset($thumb_file[$value])) {
                            $thumb = time() . '-' . Str::random(5) . $thumb_file[$value]->getClientOriginalName();
                            $destinationPath = public_path('uploads/original');
                            $thumb_file[$value]->move($destinationPath, $thumb);
                            $gearData->thumbnail = $thumb;
                        }
                        $gearData->ordering = $request->gear_ordering[$key];
                        $gearData->title = $request->gear_title[$key];
                        // $gearData->content = $request->gear_content[$key];
                        $gearData->video = $request->gear_video[$key];
                        $gearData->save();
                    } else if ($request->gear_id[$value] !== null && $request->gear_id[$value] !== "") {
                        $gear_id = $request->gear_id[$value];
                        $gearData = TripGearModel::find($gear_id);

                        $thumb_file = $request->file('gear_thumbnail');
                        if (isset($thumb_file[$key])) {

                            if ($gearData->thumbnail) {
                                if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $gearData->thumbnail)) {
                                    unlink(env('PUBLIC_PATH') . 'uploads/original/' . $gearData->thumbnail);
                                }
                            }
                            $thumb = time() . '-' . Str::random(5) . $thumb_file[$key]->getClientOriginalName();
                            $destinationPath = public_path('uploads/original');
                            $thumb_file[$key]->move($destinationPath, $thumb);
                            $gearData->thumbnail = $thumb;
                        }
                        $gearData->trip_detail_id = $data->id;
                        $gearData->ordering = $request->gear_ordering[$key];
                        $gearData->title = $request->gear_title[$key];
                        // $gearData->content = $request->gear_content[$key];
                        $gearData->video = $request->gear_video[$key];
                        $gearData->save();
                    }

                    $sn_gear++;
                }
            }

            

            // Update cost includes
            if (isset($request->testimonial_ordering)) {
                $costincludes_keys = array_keys($request->testimonial_ordering);
                $sn_testimonial = 1;
                $sn_testimonial_count = count($request->testimonial_ordering);
                foreach ($costincludes_keys as $key => $value) {
                    if ($key + 1 >= $sn_testimonial_count) {
                        continue;
                    }
                    if ($request->testimonial_id[$value] == "") {
                        $testimonialData = new CostIncludesModel();
                        $testimonialData->trip_detail_id = $data->id;
                        $testimonialData->ordering = $request->testimonial_ordering[$key];
                        $testimonialData->title = $request->testimonial_title[$key];
                        // $testimonialData->content = $request->testimonial_content[$key];
                        $testimonialData->save();
                    } else if ($request->testimonial_id[$value] !== null && $request->testimonial_id[$value] !== "") {
                        $testimonial_id = $request->testimonial_id[$value];
                        $testimonialData = CostIncludesModel::find($testimonial_id);
                        $testimonialData->trip_detail_id = $data->id;
                        $testimonialData->ordering = $request->testimonial_ordering[$key];
                        $testimonialData->title = $request->testimonial_title[$key];
                        // $testimonialData->content = $request->testimonial_content[$key];
                        $testimonialData->save();
                    }
                    $sn_testimonial++;
                }
            }

            // Update Useful Info
            if (isset($request->useful_ordering)) {
                $useful_keys = array_keys($request->useful_ordering);
                $sn_useful = 1;
                $sn_useful_count = count($request->useful_ordering);
                foreach ($useful_keys as $key => $value) {
                    if ($key + 1 >= $sn_useful_count) {
                        continue;
                    }
                    if ($request->useful_id[$value] == "") {
                        $usefulData = new TripUsefulModel();
                        $usefulData->trip_detail_id = $data->id;
                        $usefulData->ordering = $request->useful_ordering[$key];
                        $usefulData->title = $request->useful_title[$key];
                        $usefulData->description = $request->useful_description[$key];
                        $usefulData->save();
                    } else if ($request->useful_id[$value] !== null && $request->useful_id[$value] !== "") {
                        $useful_id = $request->useful_id[$value];
                        $usefulData = TripUsefulModel::find($useful_id);
                        $usefulData->trip_detail_id = $data->id;
                        $usefulData->ordering = $request->useful_ordering[$key];
                        $usefulData->title = $request->useful_title[$key];
                        $usefulData->description = $request->useful_description[$key];
                        $usefulData->save();
                    }
                    $sn_useful++;
                }
            }
            // Update cost excludes
            if (isset($request->info_id)) {
                $info_keys = array_keys($request->info_id);
                $sn_info = 1;
                $sn_info_count = count($request->info_id);
                foreach ($info_keys as $key => $value) {
                    if ($key + 1 >= $sn_info_count) {
                        continue;
                    }
                    if ($request->info_id[$value] == "") {
                        $infoData = new CostExcludesModel();
                        $infoData->trip_detail_id = $data->id;
                        $infoData->ordering = $request->info_ordering[$key];
                        $infoData->title = $request->info_title[$key];
                        // $infoData->content = $request->info_content[$key];
                        $infoData->save();
                    } else if ($request->info_id[$value] !== null && $request->info_id[$value] !== "") {
                        $info_id = $request->info_id[$value];
                        $infoData = CostExcludesModel::find($info_id);
                        $infoData->trip_detail_id = $data->id;
                        $infoData->ordering = $request->info_ordering[$key];
                        $infoData->title = $request->info_title[$key];
                        // $infoData->content = $request->info_content[$key];
                        $infoData->save();
                    }
                    $sn_info++;
                }
            }
            
                   $data->is_menu = '0';
               if($request->is_menu == '1'){
                   
                  $old_banner = TripModel::where('is_menu','1')->orderBy('ordering','desc')->first();
                  $count =  TripModel::where('is_menu','1')->count();
                  if( $old_banner && $count > 5){
                  $oldid = $old_banner->id;
                  $old_data = TripModel::find($oldid);
                  $old_data->is_menu = '0';
                  $old_data->save();
                  }
                  $data->is_menu = $request->is_menu;
                  
            }


            $data->save();
            return response()->json(['status' => 'success', 'message' => 'Trip Update Successful!']);
        }
        return false;
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TripModel::find($id);

        if ($data->banner) {
            if (file_exists(env('PUBLIC_PATH') . 'uploads/banners/' . $data->banner)) {
                unlink(env('PUBLIC_PATH') . 'uploads/banners/' . $data->banner);
            }
        }
        if ($data->thumbnail) {
             if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail)) {
                 unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail);
             }
         }
          if ($data->trip_map) {
             if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->trip_map)) {
                 unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->trip_map);
             }
         }
          if ($data->trip_chart) {
             if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->trip_chart)) {
                 unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->trip_chart);
             }
         }
          if ($data->trip_pdf) {
             if (file_exists(env('PUBLIC_PATH') . 'uploads/pdf/' . $data->trip_pdf)) {
                 unlink(env('PUBLIC_PATH') . 'uploads/pdf/' . $data->trip_pdf);
             }
         }

        $data->destinations()->detach();         
        $data->regions()->detach();        
        $data->activities()->detach();      
        $data->tripgroups()->detach();          
        $data->itineraries()->delete();        
        $data->costincludes()->delete();
        $data->costexcludes()->delete();
        $data->schedules()->delete();
        $data->gears()->delete();
        
        $data->delete();
        return 'Delete Successful';
    }

   // Delete Trip Thumbnail
     public function delete_trip_thumb(TripModel $tripModel, $id)
     {
         $data = TripModel::find($id);
         if ($data->thumbnail) {
             if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail)) {
                 unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail);
             }
         }
         $data->thumbnail = null;
         $data->save();
         return response()->json([
          "errors"=>["Delete Successful."]
        ]);
     }
 
     // Delete Trip Banner
     public function delete_trip_banner(TripModel $tripModel, $id)
     {
         $data = TripModel::find($id);
         if ($data->banner) {
             if (file_exists(env('PUBLIC_PATH') . 'uploads/banners/' . $data->banner)) {
                 unlink(env('PUBLIC_PATH') . 'uploads/banners/' . $data->banner);
             }
         }
         $data->banner = null;
         $data->save();
        return response()->json([
          "errors"=>["Delete Successful."]
        ]);
     }
 
     // Delete Map 
     public function delete_map(TripModel $tripModel, $id)
     {
         $data = TripModel::find($id);
         if ($data->trip_map) {
             if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->trip_map)) {
                 unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->trip_map);
             }
         }
         $data->trip_map = null;
         $data->save();
         return response()->json([
          "errors"=>["Delete Successful."]
        ]);
     }
 
     public function delete_chart(TripModel $tripModel, $id)
     {
         $data = TripModel::find($id);
         if ($data->trip_chart) {
             if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->trip_chart)) {
                 unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->trip_chart);
             }
         }
         $data->trip_chart = null;
         $data->save();
         return response()->json([
          "errors"=>["Delete Successful."]
        ]);
     }
 
     public function delete_pdf(TripModel $tripModel, $id)
     {
         $data = TripModel::find($id);
         if ($data->trip_pdf) {
             if (file_exists(env('PUBLIC_PATH') . 'uploads/pdf/' . $data->trip_pdf)) {
                 unlink(env('PUBLIC_PATH') . 'uploads/pdf/' . $data->trip_pdf);
             }
         }
         $data->trip_pdf = null;
         $data->save();
         return response()->json([
          "errors"=>["Delete Successful."]
        ]);
     }
     
      public function tripstatus($id){
        $data = TripModel::find($id);
        if($data->status == '1'){
          $data->status = '0';
          $data->save();
          return 'Success';
        }else if($data->status == '0'){
          $data->status = '1';
          $data->save();
          return 'Success';
        }
        return 'Not success';
      }
      
      public function banner_trip(){
        $data = TripModel::where('is_menu','1')->get();
      return view('admin.trips.banner', compact('data'));
      }
       
    }
