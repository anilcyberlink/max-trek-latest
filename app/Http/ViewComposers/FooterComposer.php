<?php

namespace App\Http\ViewComposers;

use App\Models\Posts\PostModel;
use App\Models\Travels\TripModel;
use App\Models\Banners\BannerModel;
use App\Models\Pages\PageTypeModel;
use App\Models\Posts\PostTypeModel;
use App\Models\Travels\RegionModel;
use Illuminate\Contracts\View\view;
use App\Models\Settings\SettingModel;
use App\Models\Travels\ActivityModel;
use App\Models\Destinations\DestinationModel;

class FooterComposer{

	 public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

	public function compose(View $view){
		$view->with('footer', PostTypeModel::where(['status'=>'1'])->get());
		$view->with('partners', BannerModel::where('status','1')->get());
		$view->with('expeditions',DestinationModel::orderBy('ordering','desc')->get());
		$view->with('regions',RegionModel::orderBy('ordering','asc')->take(6)->get());


		$view->with('pagetypes',PageTypeModel::whereHas('page_data')->whereHas('page_details')->where(['is_menu'=>'1'])->orderBy('ordering','asc')->get());
		$view->with('activities', ActivityModel::orderBy('ordering','asc')->take(6)->get());
		$view->with('terms', PostModel::where(['post_type'=>'16','post_parent'=>'0','status'=>'1'])->orderBy('post_order','asc')->take(2)->get());	
		$view->with('trip_footer',TripModel::all());
		$view->with('contact_us', PostTypeModel::where(['is_menu'=>'1'])->where(['id'=>'2'])->first());
		$view->with('about_us', PostModel::where(['post_type' => '1', 'post_parent' => 0, 'status' => '1'])->orderBy('post_order', 'asc')->get());
	
	}
}