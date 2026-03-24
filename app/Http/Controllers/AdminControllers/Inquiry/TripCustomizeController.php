<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\AdminControllers\Inquiry;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inquiry\CustomizeModel;

class TripCustomizeController extends Controller
{
    //
    public function index(){
            $customize=CustomizeModel::orderby('id','desc')->get();
            return view('admin.trip-customize.index',compact('customize'));
    }
    public function destroy($id){
        $del=CustomizeModel::findorfail($id);
        if($del->delete())
        {
            return redirect()->back()->with('success',' Deleted  successfully');
        }
    }
}
