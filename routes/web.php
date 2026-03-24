<?php
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontendControllers\FrontpageController@index');
Route::get('/booking', 'FrontendControllers\FrontpageController@test_booking');


// Route::get('/test-redirect', 'FrontendControllers\FrontpageController@redirect_arnold');

/* Authentication Routes... */
Route::get('adminisclient', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('adminisclient', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::redirect('/dashboard', '/admin/dashboard', 301);

//================== Frontend Routes=================//
Route::post('subscribe', 'FrontendControllers\FrontpageController@subscribe')->name('subscribe');
Route::get('/verify/{token}', 'FrontendControllers\FrontpageController@verifyUser')->name('verify-user');
Route::get('/contact-verify/{token}', 'FrontendControllers\FrontpageController@verifyContact')->name('verify-contact');

//Travel Guide template Routes
Route::get('travel-guide/{uri}','FrontendControllers\GuideController@travel_guide')->name('trip-guide');
Route::get('trip-insurance/{uri}','FrontendControllers\GuideController@trip_insurance')->name('trip_insurance');
Route::get('trip-payment/{uri}','FrontendControllers\GuideController@payment')->name('payment');

// Normal Pages
Route::get('{uri}.html', 'FrontendControllers\FrontpageController@pagedetail')->name('page.pagedetail');
Route::get('type-{uri}', 'FrontendControllers\FrontpageController@posttype')->name('page.posttype_detail');

// For pagetype
Route::delete('admin/pagetype/{id}', 'AdminControllers\Pages\PageTypeController@destroy')->name('type.pagetype.destroy');
Route::delete('delete_pagetype_thumb/{id}','AdminControllers\Pages\PageTypeController@delete_pagetype_thumb');

//For UsefulInfo
Route::get('info/{uri}','FrontendControllers\FrontpageController@usefulInfo')->name('info.list');
Route::get('info/{parenturi}/{uri}','FrontendControllers\FrontpageController@usefulInfoDetails')->name('info.details');

//Show Popular Trips List
Route::get('popular-trips', 'FrontendControllers\FrontpageController@popular_trips_list')->name('popular-trips');


// Trip Pages
Route::get('book/{uri}.html', 'FrontendControllers\FrontpageController@showbooking')->name('page.booking');
Route::any('fixed-book/{uri}.html', 'FrontendControllers\FrontpageController@fixed_booking')->name('page.fixed.booking');
Route::get('booking-success', 'FrontendControllers\FrontpageController@showbookingsuccess')->name('page.bookingsuccess');
Route::get('page/{uri}.html', 'FrontendControllers\FrontpageController@tripdetail')->name('page.tripdetail');
Route::get('activity/{uri}.html', 'FrontendControllers\FrontpageController@travellist')->name('page.activitydetail');
Route::get('region/{uri}.html', 'FrontendControllers\FrontpageController@regionlist')->name('page.regionlist');
Route::get('packages', 'FrontendControllers\FrontpageController@populartriplist')->name('page.packagelist');
Route::get('tours/{uri}.html', 'FrontendControllers\FrontpageController@destinationlist')->name('page.destinationlist');
Route::get('trips/{luxury}.html', 'FrontendControllers\FrontpageController@luxuryTrip')->name('page.luxurytriplist');
Route::any('search-trip', 'FrontendControllers\FrontpageController@show_search_form')->name('search-trip');
Route::post('trip-booking', 'FrontendControllers\FrontpageController@post_tripbooking')->name('post-trip');
Route::post('inquiry-now','FrontendControllers\FrontpageController@post_inquiry')->name('post-inquiry');
Route::post('contact','FrontendControllers\FrontpageController@contact_us')->name('contact');  
Route::get('team/{uri}','FrontendControllers\FrontpageController@teamdetail')->name('team.teamdetail');
Route::get('page/activities/{uri}', 'FrontendControllers\FrontpageController@activities')->name('page.activities');
Route::post('page/customize-trip', 'FrontendControllers\FrontpageController@customize_trip')->name('customize-trip');
Route::post('page/post-review', 'FrontendControllers\FrontpageController@post_review')->name('post-review');
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
//================================= Backend Routes ============================//
Route::middleware(['auth'])->group(function () {

    Route::get('admin/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('admin/userprofile', 'AdminControllers\Members\UserController@userprofile')->name('admin.userprofile');
    Route::put('admin/update_password', 'AdminControllers\Members\UserController@update_password')->name('admin.update_password');
    Route::get('admin/changepassword', 'AdminControllers\Members\UserController@changepassword')->name('admin.changepassword');


    Route::resources([
        'admin/user' => 'AdminControllers\Members\UserController',       
        'admin/partner' => 'AdminControllers\Banners\BannerController',
        'admin/postcategory' => 'AdminControllers\Posts\PostCategoryController',      
        'admin/settings' => 'AdminControllers\Settings\SettingController',      
        'admin/trip' => 'AdminControllers\Travels\TripController',
        'admin/region' => 'AdminControllers\Travels\RegionController',
        'admin/activity' => 'AdminControllers\Travels\ActivityController',        
        'admin/tripgroup' => 'AdminControllers\Travels\TripGroupController',
        'admin/tripgrade' => 'AdminControllers\Travels\TripGradeController',    
        'admin/expedition' => 'AdminControllers\Destinations\DestinationController',
        'admin/pagetype'=>'AdminControllers\Pages\PageTypeController',     
        'admin/teams'=>'AdminControllers\Teams\TeamController', 
        'admin.testimonials' => 'AdminControllers\Cost\CostIncludesController',
        'admin.trip-gear' => 'AdminControllers\Travels\TripGearController', 
        'admin.tripdocs' => 'AdminControllers\Travels\TripDocController',
        'trip-inquiry' => 'AdminControllers\Inquiry\TripInquiryController',
        'contact-us'=>'AdminControllers\Inquiry\TripBookingController',
        'trip-customize'=>'AdminControllers\Inquiry\TripCustomizeController',  
    ]);
        // Upload multiple image
        Route::get('adminimg/multiplephoto/{post_id}', 'AdminControllers\Posts\PostImageController@upload_form')->name('admin.multiplephoto');
        Route::post('multiplephoto/store', 'AdminControllers\Posts\PostImageController@store')->name('multiplephoto.store');
        Route::get('adminimg/multiplephoto/{post_id}/{id}/edit', 'AdminControllers\Posts\PostImageController@edit')->name('edit.multiplephoto');
        Route::put('adminimg/multiplephoto/{id}', 'AdminControllers\Posts\PostImageController@update')->name('multiplephoto.update');
        Route::delete('adminimg/multiplephoto/{id}', 'AdminControllers\Posts\PostImageController@destroy');
        
    Route::post('banner-isdefault/{id?}', 'AdminControllers\Banners\BannerController@isdefault')->name('banner.isdefault');
    Route::post('activity-isdefault/{id?}', 'AdminControllers\Travels\ActivityController@isdefault')->name('activity.isdefault');
    Route::get('admin/tour-trip/{id}','AdminControllers\Destinations\DestinationController@filter'); //Was trip-expedition
    Route::get('admin/trip-region/{id}','AdminControllers\Travels\RegionController@filter');
    Route::delete('admin/tour-trip/{id}','AdminControllers\Destinations\TripController@destroy'); //delete Trip
    Route::delete('admin/trip-region/{id}','AdminControllers\Travels\TripController@destroy');
    Route::put('tripstatus/{id}', 'AdminControllers\Travels\TripController@tripstatus')->name('admin.tripstatus');
    Route::get('admin/banner-trip', 'AdminControllers\Travels\TripController@banner_trip' )->name('banner.trip');
    
    // For posttype
    Route::get('type/{posttype}', 'AdminControllers\Posts\PostTypeController@index')->name('type.posttype.index');
    Route::get('type/{posttype}/create', 'AdminControllers\Posts\PostTypeController@create')->name('type.posttype.create');
    Route::post('type/{posttype}/store', 'AdminControllers\Posts\PostTypeController@store')->name('type.posttype.store');
    Route::put('type/{posttype}/{id}', 'AdminControllers\Posts\PostTypeController@update')->name('type.posttype.update');
    Route::get('type/{posttype}/{id}/edit', 'AdminControllers\Posts\PostTypeController@edit')->name('type.posttype.edit');
    Route::delete('type/{posttype}/{id}', 'AdminControllers\Posts\PostTypeController@destroy')->name('type.posttype.destroy');
    Route::delete('delete_posttype_thumb/{id}', 'AdminControllers\Posts\PostTypeController@delete_posttype_thumb');
    Route::delete('delete_posttype_banner/{id}', 'AdminControllers\Posts\PostTypeController@delete_posttype_banner');


    // For post
    Route::get('admin/{post}', 'AdminControllers\Posts\PostController@index')->name('admin.post.index');
    Route::get('admin/{post}/create', 'AdminControllers\Posts\PostController@create')->name('admin.post.create');
    Route::post('admin/{post}/store', 'AdminControllers\Posts\PostController@store')->name('admin.post.store');
    Route::put('admin/{post}/{id}', 'AdminControllers\Posts\PostController@update')->name('admin.post.update');
    Route::get('admin/{post}/{id}/edit', 'AdminControllers\Posts\PostController@edit')->name('admin.post.edit');
    Route::delete('admin/{post}/{id}', 'AdminControllers\Posts\PostController@destroy')->name('admin.post.destroy');
    Route::get('admin/{post}/{id}', 'AdminControllers\Posts\PostController@childlist')->name('post.childlist');

    // Delete Thumbnails, Banners, PDF
    Route::delete('delete_banner_thumb/{id}', 'AdminControllers\Posts\PostController@delete_banner_thumb');
    Route::delete('delete_post_thumb/{id}', 'AdminControllers\Posts\PostController@delete_post_thumb');
    Route::delete('thumbdelete/{id}','AdminControllers\Teams\TeamController@thumbdelete');
    Route::delete('bannerdelete/{id}','AdminControllers\Teams\TeamController@bannerdelete');
    Route::delete('delete_activity_thumb/{id}', 'AdminControllers\Travels\ActivityController@delete_activity_thumb');
    Route::delete('delete_activity_icon/{id}', 'AdminControllers\Travels\ActivityController@delete_activity_icon');
    Route::delete('delete_tripgroup_thumb/{id}', 'AdminControllers\Travels\TripGroupController@delete_tripgroup_thumb');
    Route::delete('delete_destination_banner/{id}', 'AdminControllers\Destinations\DestinationController@delete_banner')->name('delete-destination-banner');
    Route::delete('delete_destination_thumb/{id}', 'AdminControllers\Destinations\DestinationController@delete_thumb')->name('delete-destination-thumb');
    Route::delete('delete_region_banner/{id}', 'AdminControllers\Travels\RegionController@delete_region_banner');
    Route::delete('delete_region_thumb/{id}', 'AdminControllers\Travels\RegionController@delete_region_thumb');
    Route::delete('delete_gear_thumb/{id}', 'AdminControllers\Travels\TripGearController@delete_gear_thumb')->name('delete_gear_thumb');
    Route::delete('delete_trip_thumb/{id}', 'AdminControllers\Travels\TripController@delete_trip_thumb');
    Route::delete('delete_trip_banner/{id}', 'AdminControllers\Travels\TripController@delete_trip_banner');
    Route::delete('delete_map/{id}', 'AdminControllers\Travels\TripController@delete_map');
    Route::delete('delete_chart/{id}', 'AdminControllers\Travels\TripController@delete_chart');
    Route::delete('delete_pdf/{id}', 'AdminControllers\Travels\TripController@delete_pdf');
    Route::delete('delete_trip_banner_thumb/{id}', 'AdminControllers\Travels\TripController@delete_trip_banner_thumb');
    Route::delete('delete_map_thumb/{id}', 'AdminControllers\Travels\TripController@delete_map_thumb');
    Route::delete('delete_activity_banner/{id}', 'AdminControllers\Travels\ActivityGroupController@delete_activity_banner');
    Route::get('delete_worked_with/{id}','AdminControllers\Settings\SettingController@banner_destroy')->name('banner-destroy');
    Route::get('delete_affililiated_with/{id}','AdminControllers\Settings\SettingController@mobile_banner_destroy')->name('mob-banner-destroy');


// Associated post
    Route::get('admin/associated/{type}/{id}', 'AdminControllers\Posts\AssociatedPostController@associated_post')->name('associated.post.index');
    Route::get('admin/associated/{type}/{id}/create', 'AdminControllers\Posts\AssociatedPostController@create')->name('admin.associated.create');
    Route::post('admin/associated/{type}/{id}/store', 'AdminControllers\Posts\AssociatedPostController@store')->name('admin.associated.store');
    Route::delete('admin/associated/{type}/{id}', 'AdminControllers\Posts\AssociatedPostController@destroy')->name('admin.associated.destroy');
    Route::get('admin/associated/{type}/{id}/edit', 'AdminControllers\Posts\AssociatedPostController@edit')->name('admin.associated.edit');
    Route::put('admin/associated/{type}/{id}', 'AdminControllers\Posts\AssociatedPostController@update')->name('admin.associated.update');

    Route::delete('admin/schedule/{id}/{info_id}', 'AdminControllers\Travels\TripScheduleController@destroy')->name('schedule.destroy');
    Route::delete('admin/useful/{id}/{info_id}', 'AdminControllers\Travels\TripUsefulController@destroy')->name('useful.destroy');
    // cost excludes
    Route::delete('admin/trip/{id}/{info_id}', 'AdminControllers\Cost\CostExcludesController@destroy')->name('supporting-info.destroy');
    Route::delete('admin/itinerary/{id?}/{info_id?}', 'AdminControllers\Travels\TripItineraryController@destroy')->name('itinerary.destroy');
   
    Route::post('admin/gear_thumb_update/{id}', 'AdminControllers\Travels\TripGearController@gear_thumb_update')->name('gear_thumb_update');

     //Trip Review (Bibek)
    Route::get('admin-trip-review','AdminControllers\Review\TripReviewController@trip_review')->name('trip-review');
    Route::any('admin-trip-review/create-review','AdminControllers\Review\TripReviewController@post_trip_review')->name('post-trip-review');
    Route::post('admin-review-status','AdminControllers\Review\TripReviewController@review_status')->name('review-status');
    Route::get('admin-trip-edit-review/{id?}/edit','AdminControllers\Review\TripReviewController@edit_trip_review');
    Route::post('admin-trip-edit-review/{id?}','AdminControllers\Review\TripReviewController@edit_trip_review')->name('edit-trip-review');
    Route::get('admin-trip-delete-review/{id?}', 'AdminControllers\Review\TripReviewController@delete_trip_review')->name('delete-trip-review');

    //Trip Booking (Bibek)
    Route::get('admin-trip-booking','AdminControllers\Inquiry\TripBookingController@trip_booking')->name('trip-booking');
    Route::get('admin-trip-booking-delete/{id?}','AdminControllers\Inquiry\TripBookingController@trip_booking_delete')->name('delete-booking'); 

    // newsletter routes
    Route::get('send-newsletter', 'SendMailController@index')->name('send.newsletter');
    Route::post('users-send-email', 'SendMailController@sendEmail')->name('ajax.send.email');
    Route::get('newsletter-create', 'SendMailController@newsletter')->name('newsletter.create');
    Route::post('newsletters', 'SendMailController@newsletter')->name('newsletter.submit');
    Route::get('newsletter-index', 'SendMailController@newsindex')->name('newsletter.index');
    Route::get('newsletter-edit/{id?}', 'SendMailController@newsedit')->name('newsletter.edit');
    Route::post('newsletter-edit/{id?}', 'SendMailController@newsedit')->name('newsletter.edit');
    Route::get('newsletter-delete/{id?}', 'SendMailController@newsdelete')->name('newsletter.delete');
    Route::get('subscriber-create', 'SendMailController@usercreate')->name('subscriber.create');
    Route::post('subscriber-create', 'SendMailController@usercreate')->name('subscriber.submit');
    Route::get('subscriber-index', 'SendMailController@userindex')->name('subscriber.index');
    Route::get('subscriber-edit/{id?}', 'SendMailController@useredit')->name('subscriber.update');
    Route::post('subscriber-edit/{id?}', 'SendMailController@useredit')->name('subscriber.edit');
    Route::get('subscriber-delete/{id?}', 'SendMailController@userdelete')->name('user.delete');
    

    //For Pages
	Route::get('adminpages/{page}', 'AdminControllers\Pages\PageController@index')->name('admin.page.index');
	Route::get('adminpages/{page}/create', 'AdminControllers\Pages\PageController@create')->name('admin.page.create');
	Route::post('adminpages/{page}/store', 'AdminControllers\Pages\PageController@store')->name('admin.page.store');
	Route::put('adminpages/{page?}/{id?}', 'AdminControllers\Pages\PageController@update')->name('admin.page.update');
	Route::get('adminpages/{page}/{id}/edit', 'AdminControllers\Pages\PageController@edit')->name('admin.page.edit');
    Route::delete('adminpages/{page}/{id}', 'AdminControllers\Pages\PageController@destroy')->name('admin.page.destroy');
	Route::delete('adminpages/{page}/{id}/{info_id}', 'AdminControllers\Pages\PageController@detailsdestroy')->name('details.destroy');
    Route::put('pagestatus/{id}', 'AdminControllers\Pages\PageController@pagestatus')->name('admin.pagestatus');

    //Travel Guide
     Route::get('admin-travel-guide','AdminControllers\TravelGuide\GuideController@travel_guide')->name('travel_guide');
     Route::get('admin-travel-guide-index','AdminControllers\TravelGuide\GuideController@index')->name('travel_guide_index');
     Route::get('admin-travel-guide-edit/{id?}','AdminControllers\TravelGuide\GuideController@edit')->name('travel_guide_edit');
     Route::post('admin-travel-guide-update','AdminControllers\TravelGuide\GuideController@update')->name('travel_guide_update');
     Route::delete('admin-travel-guide-delete/{id?}','AdminControllers\TravelGuide\GuideController@delete_image')->name('travel_guide_delete');
     Route::post('admin-travel-guide','AdminControllers\TravelGuide\GuideController@travel_guide')->name('travel_guide_post');
     Route::delete('delete_gear_guide_thumb/{id}', 'AdminControllers\TravelGuide\GuideController@delete_gear_guide_thumb');


    //Delete Page Banner & Thumbnail
    Route::delete('delete_pagebanner_thumb/{id}', 'AdminControllers\Pages\PageController@delete_page_banner');
    Route::delete('delete_page_thumb/{id}', 'AdminControllers\Pages\PageController@delete_page_thumb');

    View::composer(['*'], function($view){
		$pagetype = App\Models\Pages\PageTypeModel::orderBy('ordering', 'asc')->get();
		$view->with('pagetype', $pagetype);
	});

    View::composer(['*'], function ($view) {
        $posttype = App\Models\Posts\PostTypeModel::orderBy('ordering', 'asc')->get();
        $view->with('posttype', $posttype);
    });
    
});

