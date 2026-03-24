<?php

namespace App\Http\Controllers;

use App\Model\Subscriber;
use App\Model\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
      public function index(Request $request)
    {
         return view('admin.dashboard');
    }

}
