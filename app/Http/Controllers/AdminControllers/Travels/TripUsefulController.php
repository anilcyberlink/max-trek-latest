<?php

namespace App\Http\Controllers\AdminControllers\Travels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travels\TripUsefulModel;

class TripUsefulController extends Controller
{
    public function index($id)
    {
        $data = TripUsefulModel::where('trip_detail_id', $id)->orderBy('ordering', 'desc')->get();
        return view('admin.itinerary.index', compact('data'));
    }

    public function create()
    {
        $ordering = 0;
        $ord = TripUsefulModel::max('ordering');
        $ordering += $ord + 1;
        return view('admin.itinerary.create', compact('ordering'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
        $data = $request->all();

        $result = TripUsefulModel::create($data);
        return redirect()->back()->with('success', 'Successfully added.');
    }

    public function show($id)
    {
        //
    }

    public function edit($trip_id, $id)
    {
        $data = TripUsefulModel::find($id);
        return view('admin.itinerary.edit', compact('data'));
    }

    public function update(Request $request, $trip_id, $id)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $data = TripUsefulModel::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->days = $request->days;
        $data->ordering = $request->ordering;

        if ($data->save()) {
            return redirect()->back()->with('success', 'Update Sucessfully.');
        }
    }

    public function destroy($id, $info_id)
    {
        $data = TripUsefulModel::find($info_id);
        $data->delete();
        return response()->json([
            "errors" => ["Delete Successful."]
        ]);
    }
}
