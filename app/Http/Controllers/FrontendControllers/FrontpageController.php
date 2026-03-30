<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Mail\SendMail;
use App\Model\Contact;
use App\Mail\VerifyMail;
use App\Model\Subscriber;
use App\Model\TripReview;
use App\Model\VerifyUser;
use App\Model\TravelGuide;
use App\Model\TripBooking;
use Illuminate\Support\Str;
use App\Model\VerifyContact;
use Illuminate\Http\Request;
use App\Mail\BookingComplete;
use App\Mail\SendMailContact;
use App\Mail\AdminBookingMail;
use App\Mail\AdminInquiryMail;
use App\Models\Team\TeamModel;
use App\Models\Pages\PageModel;
use App\Models\Posts\PostModel;
use App\Models\Pages\PageDetails;
use App\Models\Travels\TripModel;
use App\Models\Settings\SettingModel;
use App\Models\Pages\PageTypeModel;
use App\Models\Posts\PostTypeModel;
use App\Models\Posts\PostImageModel;
use App\Models\Travels\RegionModel;
use App\Http\Controllers\Controller;
use App\Models\Inquiry\BookingModel;
use App\Models\Travels\TripDocModel;
use Illuminate\Support\Facades\Mail;
use App\Models\Travels\ActivityModel;
use App\Models\Travels\TripGearModel;
use App\Models\Cost\CostExcludesModel;
use App\Models\Cost\CostIncludesModel;
use App\Models\Inquiry\CustomizeModel;
use App\Models\Travels\TripGroupModel;
use App\Models\Inquiry\TripInquiryModel;
use App\Models\Posts\AssociatedPostModel;
use Illuminate\Support\Facades\Validator;
use App\Models\Destinations\DestinationModel;
use Session;


class FrontpageController extends Controller
{
    public function test_booking()
    {
        return view('themes.default.test-booking');
    }

    public function index()
    {
        $banners = TripModel::where(['status' => '1', 'is_menu' => '1'])->orderBy('ordering', 'asc')->limit(6)->get();
        $about = PostTypeModel::where('id', 1)->first();
        $blog = PostTypeModel::where('id', 8)->first();
        $contact = PostTypeModel::where('id', 2)->first();
        $blogs = PostModel::where('post_type', $blog->id)->orderBy('post_order', 'asc')->take(2)->get();
        $expeditions = TripModel::where('trip_type', '2')
            ->whereHas('tripgroups', function ($q) {
                $q->where('group_id', 1);
            })->orderBy('ordering', 'asc')->get();
        $trekRegion = RegionModel::orderBy('ordering', 'asc')->get();
        $trekking = TripModel::where('trip_type', '1')
            ->whereHas('tripgroups', function ($q) {
                $q->where('group_id', 1);
            })->orderBy('ordering', 'asc')->take(8)->get();
        $reviews = TripReview::where('status', 1)->orderBy('id', 'desc')->get();

        $setting = SettingModel::first();
        // dd($banners);
        return view('themes.default.frontpage', compact('banners', 'about', 'contact', 'blog', 'blogs', 'expeditions', 'trekRegion', 'trekking', 'reviews'));
    }


    public function posttype(Request $request, $uri)
    {
        if (!check_posttype_uri($uri)) {
            abort(404);
        }
        $trekkings = RegionModel::where(['status' => '1'])->orderBy('ordering', 'asc')->paginate(9);
        $expeditions = DestinationModel::where(['status' => '1'])->orderBy('ordering', 'asc')->paginate(9);
        $data = PostTypeModel::where('uri', $uri)->first();
        $tmpl['template'] = 'page';
        if ($tmpl['template']) {
            $data['template'] = $data['template'];
        }
        if ($data) {
            $posts = PostModel::where(['post_type' => $data->id, 'status' => '1', 'post_parent' => '0'])->with('associated_posts')->orderBy('post_order', 'asc')->paginate(8);
        }
        $items = PostModel::where(['post_type' => $data->id, 'post_parent' => '0'])->orderBy('post_order', 'asc')->get();

        // dd($data,$posts);
        return view('themes.default.' . $data['template'] . '', compact('trekkings', 'expeditions', 'data', 'posts', 'items'));
    }


    public function pagedetail($uri)
    {
        if (!check_uri($uri)) {
            abort(404);
        }
        $data['template'] = 'single';
        $data = PostModel::where('uri', $uri)->orWhere('page_key', $uri)->first();
        $associated_posts = array();
        if ($data) {
            $associated_posts = AssociatedPostModel::where('post_id', $data['id'])->get();
        }
        if ($data['template']) {
            $data['template'] = $data['template'];
        }

        $post = PostModel::where('uri', $uri)->first();
        $post_type_id = intval($post->post_type);
        $post_type = PostTypeModel::where('id', $post_type_id)->first();
        $local = PostTypeModel::whereIn('id', ['20', '19'])->get();
        $related = PostModel::where('post_type', $data->post_type)->where('id', '!=', $data->id)->orderBy('post_order', 'desc')->take(5)->get();
        $trip_review = TripReview::where('status', 1)->orderBy('id', 'desc')->paginate(10);
        $team = TeamModel::where(['status' => '1'])->paginate(12);
        $terms_policy = PostModel::where(['post_type' => '16', 'status' => '1', 'post_parent' => '0'])->get();
        // $data_child = PostModel::where(['post_parent'=> $data['id'],'status'=>'1'])->paginate(12);
        $data_child = PostModel::where(['post_parent' => $data['id'], 'status' => '1'])->take(3)->get();

        $data_child_associated_post = [];
        $data_child_images = [];
        foreach ($data_child as $row) {
            // $data_child_associated_post = $row->associated_posts;
            $associated_posts = $row->associated_posts;
            $data_child_associated_post[$row->id] = $associated_posts;
            $data_child_images = PostImageModel::where('post_id', $row['id'])->get();
        }
        // dd($data);
        return view('themes.default.' . $data['template'] . '', compact('data', 'data_child', 'related', 'associated_posts', 'trip_review', 'team', 'local', 'post_type', 'terms_policy', 'data_child_associated_post', 'data_child_images'));
    }

    public function pagedetail_child($parenturi, $uri)
    {
        $data = PostModel::where('uri', $uri)->orWhere('page_key', $uri)->first();
        $tmpl['template'] = 'single';
        if ($tmpl['template']) {
            $data['template'] = $data['template'];
        }
        $data_child = PostModel::where('id', $data['post_parent'])->first();
        if ($data_child) {

            $data['template'] = $data_child['template_child'];
        }
        $associated_posts = array();
        if ($data) {
            $associated_posts = AssociatedPostModel::where('post_id', $data['id'])->get();
        }

        return view('themes.default.' . $data['template'] . '', compact('data', 'data_child', 'associated_posts'));
    }


    /***********************************
     ******** Root Navigation ***********
     ************************************/


    public function tripdetail($uri)
    {
        $data = TripModel::where('uri', $uri)->orWhere('trip_code', $uri)->first();
        $contact_us_post_info = PostTypeModel::where(['is_menu' => '1'])->where(['id' => '2'])->first();

        if ($data->id) {
            $itinerary = $data->itineraries()->orderBy('ordering', 'asc')->get();
            $schedules = $data->schedules()->orderBy('ordering', 'asc')->get();
            $usefulInfo = $data->useful_infos()->orderBy('ordering', 'asc')->get();
            $cost_includes = CostIncludesModel::where('trip_detail_id', $data->id)->orderBy('ordering', 'asc')->get();
            $cost_excludes = CostExcludesModel::where('trip_detail_id', $data->id)->orderBy('ordering', 'asc')->get();
            $photo_videos = TripGearModel::where('trip_detail_id', $data->id)->orderBy('ordering', 'asc')->get();
            $photos = TripGearModel::where('trip_detail_id', $data->id)->where('thumbnail', '!=', 'NULL')->orderBy('ordering', 'asc')->get();
            $videos = TripGearModel::where('trip_detail_id', $data->id)->where('video', '!=', 'NULL')->orderBy('ordering', 'asc')->get();
            $trip_docs = TripDocModel::where('trip_id', $data->id)->take(6)->get();
            $guide = TravelGuide::where('trip_id', $data->id)->where('category', '=', 'guide')->get();
            $gear_insurance = TravelGuide::where('trip_id', $data->id)->where('category', '=', 'insurance')->get();
            $gear_payment = TravelGuide::where('trip_id', $data->id)->where('category', '=', 'payment')->get();
            $visiter = $data->visiter + 1;
            $data->visiter = $visiter;
            $data->save();
            $reviews = TripReview::where('status', 1)->where('trip_id', $data->id)->orderBy('id', 'desc')->get();
        }
        // $similar_trips = $data->relatedtrips()->orderBy('ordering', 'asc')->take(4)->get();
        $similar_tripsId = $data->relatedtrips()->pluck('related_trip_id');
        if ($similar_tripsId->isNotEmpty()) {
            $similar_trips = TripModel::with('destinations')->whereIn('id', $similar_tripsId)->take(4)->get();
        } else {
            $similar_trips = TripModel::with('destinations')->where('uri', '!=', $uri)->orderBy('ordering', 'desc')->take(4)->get();
        }
        // dd($data,$reviews);
        return view('themes.default.tripdetail', compact(
            'data',
            'contact_us_post_info',
            'schedules',
            'cost_includes',
            'cost_excludes',
            'itinerary',
            'photo_videos',
            'similar_trips',
            'photos',
            'videos',
            'reviews',
            'trip_docs',
            'gear_insurance',
            'gear_payment',
            'guide',
            'usefulInfo'
        ));
    }

    public function post_review(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'trip_id' => 'required|integer',
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'cname' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
                'comments' => 'nullable|string',
                'rating' => 'nullable'
            ]);
            $filename = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('reviews', $filename, 'public');
            }

            TripReview::create([
                'trip_id' => $request->trip_id,
                'name' => $request->fname,
                'last_name' => $request->lname,
                'sub_title' => $request->cname,
                'rating' => $request->rating,
                'content' => $request->comments,
                'image' => $filename,
            ]);

            return back()->with('success', 'Saved successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }
    //<------------------------------------------Activity Frontend---------------------------------------------->

    public function travellist($uri)
    {
        $data = ActivityModel::where('uri', $uri)->first();
        $template = $data->template;
        $trips = ActivityModel::find($data->id)->trips()->paginate(12);
        $trips_activity = ActivityModel::find($data->id)->trips()->get();
        $regions_list = RegionModel::paginate(9);
        return view('themes.default.' . $template, compact('data', 'trips', 'trips_activity', 'regions_list'));
    }

    public function regionlist($uri)
    {
        $data = RegionModel::where('uri', $uri)->first();
        $template = $data->template;
        $trips = RegionModel::find($data->id)->trips()->paginate(8);
        // dd($data,$trips);
        return view('themes.default.trekking-regionlist', compact('data', 'trips'));
    }
    public function populartriplist()
    {
        $trips = TripModel::where('trip_type', '1')
            ->whereHas('tripgroups', function ($q) {
                $q->where('group_id', 1);
            })->orderBy('ordering', 'asc')->paginate(8);
        // dd($trips);
        return view('themes.default.trekking-popularlist', compact('trips'));
    }

    public function destinationlist($uri)
    {
        $data = DestinationModel::where('uri', $uri)->first();
        $expeditions = DestinationModel::where('id', '<>', $data->id)->get();
        $trips = DestinationModel::find($data->id)->trips()->paginate(8);
        // dd($data,$expeditions,$trips);
        return view('themes.default.expeditions-trip', compact('data', 'trips', 'expeditions'));
    }

    public function luxuryTrip($value)
    {
        $data = TripGroupModel::where('id', '3')->first();
        $trips = TripGroupModel::find($data->id)->trips()->paginate(9);
        return view('themes.default.luxury-trip-list', compact('trips', 'data'));
    }

    public function teamdetail($uri)
    {
        $data = TeamModel::where('uri', $uri)->orWhere('team_key', $uri)->first();

        return view('themes.default.team-single', compact('data'));
    }

    //  <! ---Booking a Trip Controller--- !>
    public function post_tripbooking(Request $request)
    {
        $g_recaptcha_response = $request->input('g-captcha-response');
        $result = $this->getCaptcha($g_recaptcha_response);

        if (!$result->success) {
            return back()->with('error', 'You are a robot');
        }

        if ($request->isMethod('post')) {
            // dd($request->all(),'test 22');
            $request->validate([
                'trip_id' => 'required|integer|exists:cl_trip_details,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'num_people' => 'required|string',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'dob' => 'required|date',
                'country' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:25',
                'comments' => 'nullable|string|max:2000',
                'terms_conditions' => 'accepted',
            ]);

            try {
                $create = BookingModel::create([
                    'trip_id' => $request->trip_id,
                    'schedule_id' => $request->schedule_id ?? null,
                    'title' => $request->title ?? null,
                    'full_name' => $request->first_name . ' ' . $request->last_name,
                    'country' => $request->country,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'departure_date' => $request->departure_date ?? null,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'comments' => $request->comments,
                    'terms_conditions' => $request->terms_conditions,
                    'status' => $request->status,
                    'num_people' => $request->num_people,
                ]);
                dd($request->all(), 'test 22');

                if ($create) {
                    // Mail::send(new \App\Mail\AdminBookingMail($request->email));
                    // return redirect()->route('page.bookingsuccess')->with('success', 'Booking completed successfully');
                    $response = [
                        'success' => true,
                        'message' => 'Booking completed successfully.'
                    ];
                    return redirect()->route('page.bookingsuccess')->with('response', $response);
                } else {
                    return back()->with('error', 'Failed to save booking. Please try again.');
                }

            } catch (\Exception $e) {
                // Log the error for debugging
                \Log::error('Booking save error: ' . $e->getMessage());

                return back()->with('error', 'An error occurred while saving your booking: ' . $e->getMessage());
            }
        }
    }

    public function post_inquiry(Request $request)
    {
        // dd($request->all());
        if ($request->isMethod('post')) {
            $g_recaptcha_response = $request->input('g_recaptcha_response');
            $result = $this->getCaptcha($g_recaptcha_response);
            if ($result->success == true) {
                $request->validate([
                    'trip_id'    => 'required|integer',
                    'full_name' => 'required|string|max:100',
                    'email'      => 'required|email|max:150',
                    'phone'      => 'required|string|max:20',
                    'country'    => 'nullable|string|max:100',
                    'people'     => 'nullable|integer|min:1',
                    'stay'       => 'nullable|integer|min:1',
                    'comments'   => 'nullable|string',
                    'trip_start_date' => 'nullable|date',
                ]);

                try {
                    $data = [
                        'title' => $request->title ?? null,
                        'trip_id' => $request->trip_id,
                        'name' => $request->full_name,
                        'email' => $request->email,
                        'number' => $request->phone,
                        'review' => $request->comments,
                        'group_size' => $request->people,
                        'duration' => $request->stay,
                        'country' => $request->country,
                        'trip_start_date' => $request->trip_start_date,
                    ];
                    TripInquiryModel::create($data);

                    return back()->with('response', [
                        'success' => true,
                        'message' => 'Inquiry sent successfully.'
                    ]);

                } catch (\Exception $e) {
                    return back()->with('response', [
                        'success' => false,
                        'message' => 'Something went wrong. Please try again.'
                    ]);
                }
            } else {
                return back()->with([
                    'error' => true,
                    'message' => 'You are robot.'
                ]);
            }
        }
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers,email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()->all()
            ]);
        }

        // $check=Subscriber::where('email',$request->email)->first();
        // dd($check);
        // if ($check->verified==1)
        // {
        //     return back()->with('error', 'You have already subscribed');

        // }

        $user = Subscriber::create([
            'email' => $request->email,
            'verified' => 0,
        ]);
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => Str::random(20)
        ]);

        if ($user && $verifyUser) {
            //   Session::flash('message', 'Please verify your email to complete registration process');
            // return response()->json(['message'=>'Please verify your email to complete registration process','status'=>'success']);

            $response = [
                'success' => true,
                'message' => 'Please verify your email to complete registration process.'
            ];
            return response()->json($response);

            //   return redirect()->back()->with('message', 'Please verify your email to complete registration process');

            return new VerifyMail($verifyUser->token, $user->id, $user->name);
            // Mail::send(new VerifyMail($verifyUser->token, $user->id, $user->name));

        }


    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if (isset($verifyUser)) {
            $user = $verifyUser->users;
            if (!$user->verified) {
                $verifyUser->users->verified = 1;
                $verifyUser->users->save();
                $status = "Your e-mail is verified. You can now login.";
            } else {
                $status = "Your e-mail is already verified. You can now login.";
            }
        } else {
            // return redirect()->intended(url('/'))->with('warning', "Sorry your email cannot be identified.");
            $response = [
                'warning' => true,
                'message' => 'Sorry your email cannot be identified.'
            ];
            return redirect()->intended(url('/'))->with('response', $response);
        }

        $response = [
            'success' => true,
            'message' => $status
        ];

        return redirect()->intended(url('/'))->with('response', $response);
    }

    public function contact_us(Request $request)
    {
        $g_recaptcha_response = $request->input('g_recaptcha_response');
        $result = $this->getCaptcha($g_recaptcha_response);
        if ($result->success == true) {
            $request->validate([
                'first_name' => 'required',
                'email' => 'required|email',
                'number' => 'required',
                'country' => 'required',
                'comments' => 'nullable|string'
            ]);
            // dd($request->all());

            if ($request->isMethod('post')) {

                $create = Contact::create([
                    'full_name' => $request->first_name,
                    'email' => $request->email,
                    'number' => $request->number,
                    'message' => $request->comments,
                    'country' => $request->country
                ]);
                //   return new \App\Mail\AdminContactMail($request->email);
                // Mail::send(new \App\Mail\Contact($request->email));
                return back()->with('message', 'Contact Form submitted successfully');
            }
        } else {
            return back()->with([
                'error' => true,
                'message' => 'You are robot.'
            ]);
        }
    }


    public function verifyContact($token)
    {
        $verifyUser = VerifyContact::where('token', $token)->first();
        if (isset($verifyUser)) {
            $user = $verifyUser->users;
            if (!$user->verified) {
                $verifyUser->users->verified = 1;
                $verifyUser->users->save();
                $status = "Your e-mail is verified. You can now login.";
            } else {
                $status = "Your e-mail is already verified. You can now login.";
            }
        } else {
            return redirect()->intended(url('/'))->with('warning', "Sorry your email cannot be identified.");
        }

        return redirect()->intended(url('/'))->with('success', $status);
    }

    public function show_search_form(Request $request)
    {
        // dd($trips = TripModel::where('trip_title', 'like', '%' . $request->search . '%')->get());

        // $data = RegionModel::where('uri', $uri)->first();
        // $template = $data->template;
        // $trips = RegionModel::find($data->id)->trips()->paginate(6);
        if ($request->isMethod('post')) {
            // $day=int($request->days);
            $request->validate([
                'search' => 'required',
                // 'g-captcha-response' => 'required',
            ]);
            $datas = $request->search;
            if ($datas != NULL) {
                $trips = TripModel::where('status', '=', '1')
                    ->where('trip_title', 'like', '%' . $datas . '%')
                    ->orWhere('duration', '=', $datas)
                    ->paginate(10);
                return view('themes.default.search-trip', compact('trips'));
            } else {
                // return back()->with('error','Please enter the number of days.');
                $response = [
                    'error' => true,
                    'message' => 'Please enter the number of days.'
                ];
                return back()->with('response', $response);
            }
        }
    }

    public function showbooking($uri)
    {
        $trip = TripModel::where('uri', $uri)->first();
        $terms = PageTypeModel::where('id', '1')->first();
        // dd($booking);
        return view('themes.default.booking', compact('trip', 'terms'));
    }
    public function fixed_booking(Request $request, $uri)
    {
        $booking = TripModel::where('uri', $uri)->first();
        $schedule = $request->schedule_id ? $booking->schedules()->where('id', $request->schedule_id)->first() : null;
        $terms = PageTypeModel::where('id', '1')->first();
        // dd($request->all(),$uri,$booking,$schedule);
        return view('themes.default.fixed-booking', compact('booking', 'terms', 'schedule'));
    }


    public function showbookingsuccess()
    {
        return view('themes.default.booking-success');
    }

    public function customize_trip(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'comments' => 'required',
                'country' => 'required',
                'trip_start_date' => 'required',
                'h-captcha-response' => 'required|HCaptcha',
            ]);
            $data = $request->all();
            $result = CustomizeModel::create($data);
            if ($result) {
                // return new AdminInquiryMail($request->email);
                // Mail::send(new SendInquiry($request->email));
                return redirect()->back()->with('message', 'Inquiry message sent successfully.');
            }
        }
    }

    // public function usefulInfo($uri)
    // {
    //     if(!check_pagetype_uri($uri)){
    //         abort(404);
    //       }
    //     $pages = PageTypeModel::where(['uri' => $uri])->first();
    //     if($pages){
    //         $data = PageModel::where(['page_type' => $pages->id, 'status' => '1'])->orderBy('page_order', 'asc')->paginate(9);
    //         return view('themes.default.usefulinfo', compact('data', 'pages'));
    //     }
    //     // return abort(404);
    // }

    public function usefulInfo($uri)
    {
        if (!check_pagetype_uri($uri)) {
            abort(404);
        }
        $pages = PageTypeModel::where(['uri' => $uri])->first();
        $allpages = PageTypeModel::whereHas('page_data')->whereHas('page_details')->where(['is_menu' => '1'])->orderBy('ordering', 'asc')->get();
        if ($pages) {
            $data = PageModel::where(['page_type' => $pages->id, 'status' => '1'])->orderBy('page_order', 'asc')->first();
            $detail = PageDetails::where('page_id', $data->id)->orderBy('id', 'asc')->get();
            $sorted = $detail->collect();
            $details = $sorted->sortBy('ordering');
            if ($pages->id == 2) {
                return view('themes.default.faqs', compact('data', 'pages', 'allpages', 'details'));
            }
            return view('themes.default.usefulinfo', compact('data', 'pages', 'allpages', 'details'));
        }
        // return abort(404);
    }

    public function usefulInfoDetails($parenturi, $uri)
    {
        $data = PageModel::where('uri', $uri)->orWhere('page_key', $uri)->first();
        $detail = PageDetails::where('page_id', $data->id)->orderBy('id', 'asc')->get();
        $sorted = $detail->collect();
        $details = $sorted->sortBy('ordering');
        $links = PageTypeModel::where(['is_menu' => '1'])->orderBy('ordering', 'asc')->get();

        return view('themes.default.usefulinfo-detail', compact('data', 'details', 'links'));
    }

    //Show Popular Trips List Page
    public function popular_trips_list()
    {
        $popular_trip = TripGroupModel::where('id', 1)->orderBy('ordering', 'asc')->first();
        $popular_trips = $popular_trip->trips()->paginate(9);
        return view('themes.default.common.triplist-popular', compact('popular_trips'));
    }
    private function getCaptcha($secretKey)
    {
        $secret_key = env('SECRET_KEY');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response={$secretKey}");
        $result = json_decode($response);
        return $result;
    }

    // public function redirect_arnold(){
    //     $sessionName = $request->session()->getName();
    //     // Session::put('book_url', request()->fullUrl());
    //     // $d = Session('book_url');
    //     // $r = explode("/",$d);
    //     return redirect('https://demo7.lakhetech.com');
    // }
}

