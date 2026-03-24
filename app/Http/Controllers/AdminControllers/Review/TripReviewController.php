<?php

namespace App\Http\Controllers\AdminControllers\Review;

use App\Http\Controllers\Controller;
use App\Model\TripReview;
use App\Models\Travels\TripModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TripReviewController extends Controller
{
    public function trip_review(Request $request)
    {
        $review = TripReview::orderby('id', 'desc')->get();
        $trip = TripModel::all();
        return view('admin.trip-reviews.index', compact('review', 'trip'));
    }

    public function post_trip_review(Request $request)
    {
        if ($request->isMethod('get')) {
            $trip = TripModel::all();
            return view('admin.trip-reviews.create', compact('trip'));
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'content' => 'required',
            ]);
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('reviews', $name, 'public');
                $data['image'] = $name;
                // $image = $request->file('photo');
                // $name = time() . '.' . $image->getClientOriginalExtension();
                // $destinationPath = public_path('/uploads/reviews/');
                // $image->move($destinationPath, $name);
                // $data['image'] = $name;
            }
            $data['name'] = $request->name;
            $data['last_name'] = $request->lname;
            $data['sub_title'] = $request->sub_title;
            $data['trip_id'] = $request->trip_id;
            $data['brief'] = $request->brief;
            $data['content'] = $request->content;
            $create = TripReview::create($data);

            return redirect()->back()->with('success', 'Review posted successfully');
        }
    }

    public function delete_file($id)
    {
        $findData = TripReview::findorfail($id);
        $fileName = $findData->image;
        $deletePath = public_path('uploads/reviews/' . $fileName);
        if (file_exists($deletePath) && is_file($deletePath)) {
            unlink($deletePath);
        }
        return true;
    }

    public function edit_trip_review(Request $request, $id)
    {
        if ($request->isMethod('get')) {

            $trip = TripModel::all();
            $data = TripReview::findorfail($id);
            return view('admin.trip-reviews.edit', compact('trip', 'data'));
        }

        if ($request->isMethod('post')) {
            $id = $request->id;
            $request->validate([
                'name' => 'required',
                'content' => 'required',
            ]);
            $data['name'] = $request->name;
            $data['last_name'] = $request->lname;
            $data['sub_title'] = $request->sub_title;
            $data['brief'] = $request->brief;
            $data['content'] = $request->content;
            $edit = TripReview::findorfail($id);

            if ($request->hasFile('photo')) {
                if (!empty($edit->image) && Storage::disk('public')->exists('reviews/' . $edit->image)) {
                    Storage::disk('public')->delete('reviews/' . $edit->image);
                }
                $image = $request->file('photo');
                $name = time() . '.' . $image->getClientOriginalExtension();

                $image->storeAs('reviews', $name, 'public');
                $data['image'] = $name;
            }
            if ($edit->update($data)) {
                return redirect()->back()->with('success', 'Trip review updated successfully');
            }
        }
    }

    public function delete_trip_review(Request $request)
    {
        $id = $request->id;
        $review = TripReview::findOrFail($id);

        if (!empty($review->image) && Storage::disk('public')->exists('reviews/' . $review->image)) 
        {
            Storage::disk('public')->delete('reviews/' . $review->image);
        }
        $review->delete();

        return redirect()->back()->with('success', 'Review deleted  successfully');
        
    }

    public function review_status(Request $request)
    {
        $id = $request->status;

        $deal = TripReview::findorfail($id);

        if (isset($_POST['active'])) {
            $deal->status = 0;
        }
        if (isset($_POST['inactive'])) {
            $deal->status = 1;
        }
        $save = $deal->update();
        if ($save) {
            Session::flash('success', 'Status updated');
            return redirect()->back();
        }
    }

}
