<?php

namespace App\Http\Controllers\AdminControllers\Travels;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Travels\TripGradeModel;
use Image;

class TripGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TripGradeModel::orderBy('id','desc')->get();
        return view('admin.tripgrade.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $ordering = 0;
        // $ord = TripGradeModel::max('ordering');
        // $ordering += $ord + 1;
        return view('admin.tripgrade.create');
      // return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'trip_grade'=>'required',
        'grade_message' => 'required',
        // 'uri' => 'required|unique:cl_trip_grade',    
        ]);

      // $data = $request->all();
      // $data['uri'] = Str::slug($request->uri);
      $data = new TripGradeModel;
      $data->trip_grade = $request->trip_grade;
      $data->grade_message = $request->grade_message;    
      $data->save();
      // $result = TripGradeModel::create($data);

      return redirect()->back()->with('success','Successfully added.');


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
        $data = TripGradeModel::find($id);
        return view('admin.tripgrade.edit', compact('data'));
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
      $request->validate([
        'trip_grade'=>'required',
        'grade_message' => 'required',
        //  'uri' => 'required|unique:cl_trip_grade,uri,'.$id, 
      ]); 

      $data = TripGradeModel::find($id);  
      $data->trip_grade = $request->trip_grade;
      $data->grade_message = $request->grade_message;    
      $data->save();
     
      if($data->save()){
        return redirect()->back()->with('success','Update Sucessfully.');
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = TripGradeModel::find($id);
      $data->delete();
      return response()->json([
        "errors"=>["Delete Successful."]
      ]);
    }
}
