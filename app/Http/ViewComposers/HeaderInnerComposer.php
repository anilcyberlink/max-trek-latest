<?php

namespace App\Http\ViewComposers;

use App\Models\Travels\TripModel;
use App\Models\Posts\PostTypeModel;
use Illuminate\Contracts\View\view;
use App\Models\Travels\ActivityModel;
use App\Models\Travels\TripGroupModel;
use App\Models\Destinations\DestinationModel;

class HeaderInnerComposer{

	 public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

	public function compose(View $view){

		$view->with('navigations', PostTypeModel::where(['is_menu'=>'1'])
			->orderBy('ordering','asc')
			->get());

		$view->with('destinations',DestinationModel::orderBy('ordering','asc')->get());
		$view->with('activities', ActivityModel::orderBy('ordering','asc')->get());			
		$view->with('random_tour', TripModel::where('status','1')->inRandomOrder()->first());		
		$view->with('luxury_trip',TripGroupModel::find(3)->trips()->orderBy('ordering','asc')->paginate(4));
	}
	
}