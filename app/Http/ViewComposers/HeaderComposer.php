<?php

namespace App\Http\ViewComposers;

use App\Models\Travels\TripModel;
use App\Models\Pages\PageTypeModel;
use App\Models\Posts\PostModel;
use App\Models\Posts\PostTypeModel;
use App\Models\Travels\RegionModel;
use Illuminate\Contracts\View\view;
use App\Models\Travels\ActivityModel;
use App\Models\Travels\TripGroupModel;
use App\Models\Destinations\DestinationModel;

class HeaderComposer{

	 public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

	public function compose(View $view){
		$view->with('navigations', PostTypeModel::where(['is_menu'=>'1'])->orderBy('ordering','asc')->get());
		$view->with('blogs', PostTypeModel::where(['id'=>'8'])->first());
		$view->with('contact', PostTypeModel::where(['id'=>'2'])->first());
		// $view->with('nav_trekkings', PostTypeModel::where(['is_menu'=>'1'])->where(['id'=>'3'])->first());
		// $view->with('nav_expeditions', PostTypeModel::where(['is_menu'=>'1'])->where(['id'=>'2'])->first());
		$view->with('nav_about_us', PostTypeModel::where(['is_menu'=>'1'])->where(['id'=>'1'])->first());
		$view->with('contact_us', PostTypeModel::where(['is_menu'=>'1'])->where(['id'=>'2'])->first());
		$view->with('about_us', PostModel::where(['post_type' => '1', 'post_parent' => 0, 'status' => '1'])->orderBy('post_order', 'asc')->get());
		$view->with('expeditions',DestinationModel::orderBy('ordering','desc')->get()); //->expeditions in header
		$view->with('regions',RegionModel::orderBy('ordering','asc')->take(6)->get()); //->regions in header

		$view->with('pagetypes',PageTypeModel::whereHas('page_data')->whereHas('page_details')->where(['is_menu'=>'1'])->orderBy('ordering','asc')->get()); //->pagetypes


		$view->with('activities', ActivityModel::orderBy('ordering','asc')->get());			
		$view->with('random_tour', TripModel::where('status','1')->inRandomOrder()->first());		
	}
}