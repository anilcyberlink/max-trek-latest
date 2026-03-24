<?php

namespace App\Http\Controllers\AdminControllers\TravelGuide;

use App\Model\GuideImage;
use App\Model\TravelGuide;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Travels\TripModel;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class GuideController extends Controller
{

    public function index()
    {
        $guide = TravelGuide::where('category', 'guide')->get();
        $insurance = TravelGuide::where('category', 'insurance')->get();
        $payment = TravelGuide::where('category', 'payment')->get();
        return view('admin.travel-guide.index', compact('guide', 'insurance', 'payment'));
    }

    public function travel_guide(Request  $request)
    {
        
        if ($request->isMethod('get')) {
            $trip = TripModel::all();
            return view('admin.travel-guide.create', compact('trip'));
        }

        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'trip_name'=> 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()->all()
                ]);
            }
            $data = $request->all();

            /******Upload Thumbnail******/
            $thumb_file = $request->file('thumbnail');
            $thumbnail_name = '';
            if ($request->hasfile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')->getClientOriginalName();
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $thumbnail = explode('.', $thumbnail);
                $thumbnail_name = Str::slug($thumbnail[0]) . '-' . Str::random(40) . '.' . $extension;

                $destinationPath = public_path('uploads/original');

                $thumbnail_picture = Image::make($thumb_file->getRealPath());
                $width = Image::make($thumb_file->getRealPath())->width();
                $height = Image::make($thumb_file->getRealPath())->height();
                $thumbnail_picture->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $thumbnail_name);
            }
            $data['thumbnail'] = $thumbnail_name;
            /*****************************/

            /*************Banner Upload************/
            $file = $request->file('banner');
            $banner_name = '';
            if ($request->hasfile('banner')) {
                $banner = $request->file('banner')->getClientOriginalName();
                $extension = $request->file('banner')->getClientOriginalExtension();
                $banner = explode('.', $banner);
                $banner_name = Str::slug($banner[0]) . '-' . Str::random(40) . '.' . $extension;

                $destinationPath = public_path('uploads/banners');

                $banner_picture = Image::make($file->getRealPath());
                $width = Image::make($file->getRealPath())->width();
                $height = Image::make($file->getRealPath())->height();
                $banner_picture->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $banner_name);
            }

            $data['banner'] = $banner_name;
            $data['trip_id'] = $request->trip_name;
            $data['category'] = $request->category;
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['brief'] = $request->brief;
            $data['link'] = $request->link;
            $result = TravelGuide::create($data);
            $last_id = $result->id;

            if ($request->hasFile('gear_thumbnail')) {
                $thumb_file =  $request->file('gear_thumbnail');
                $sn_gear = 1;
                foreach ($request->file('gear_thumbnail') as $key => $image) {
                    $tripGear = new GuideImage();
                    $tripGear->guide_id = $last_id;
                    $tripGear->ordering = $request->gear_ordering[$key];
                    // Thumbnail upload
                    $thumbnail_name = time() . '-' . Str::random(15) . $image->getClientOriginalName();
                    $destinationPath = public_path('uploads/travel-guide');
                    $image->move($destinationPath . '/', $thumbnail_name);
                    $tripGear->image = $thumbnail_name;
                    $tripGear->save();
                    $sn_gear++;
                }
            }
            return response()->json(['status' => 'success', 'message' => 'Travel Guide Added Successfully']);
        }
    }

    public function edit($id)
    {
        $data = TravelGuide::find($id);
        $find = TravelGuide::findorfail($id);
        $trip = TripModel::all();
        return view('admin.travel-guide.edit', compact('find', 'trip', 'data'));
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()->all()
                ]);
            }
            $find = TravelGuide::findorfail($request->id);
            $data['trip_id'] = $request->trip_name;
            $data['category'] = $request->category;

            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['brief'] = $request->brief;
            $data['link'] = $request->link;
            $result = $find->update($data);

            $data = TravelGuide::find($request->id);

            $file = $request->file('banner');
            $thumbnail_file = $request->file('thumbnail');

            $banner_name = '';
            $thumbnail_name = '';
            if ($request->hasfile('banner')) {
                $data = TravelGuide::find($request->id);
                if ($data->banner) {
                    if (file_exists(env('PUBLIC_PATH') . 'uploads/banners/' . $data->banner)) {
                        unlink(env('PUBLIC_PATH') . 'uploads/banners/' . $data->banner);
                    }
                }
                $banner = $request->file('banner')->getClientOriginalName();
                $extension = $request->file('banner')->getClientOriginalExtension();
                $banner = explode('.', $banner);
                $banner_name = Str::slug($banner[0]) . '-' . Str::random(5) . '.' . $extension;
                $destinationPath = public_path('uploads/banners');
                $banner_picture = Image::make($file->getRealPath());
                $width = Image::make($file->getRealPath())->width();
                $height = Image::make($file->getRealPath())->height();

                $banner_picture->save($destinationPath . '/' . $banner_name);
                $data->banner = $banner_name;
                $data->save();
            }
            /*****Thumbnail*****/
            if ($request->hasfile('thumbnail')) {
                $data = TravelGuide::find($request->id);
                if ($data->thumbnail) {
                    if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail)) {
                        unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail);
                    }
                }
                $thumbnail = $request->file('thumbnail')->getClientOriginalName();
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $thumbnail = explode('.', $thumbnail);
                $thumbnail_name = time() . '_' . Str::slug($thumbnail[0]) . '-' . Str::random(5) . '.' . $extension;
                $destinationPath = public_path('uploads/original');
                $thumbnail_picture = Image::make($thumbnail_file->getRealPath());
                $width = Image::make($thumbnail_file->getRealPath())->width();
                $height = Image::make($thumbnail_file->getRealPath())->height();

                $thumbnail_picture->save($destinationPath . '/' . $thumbnail_name);
                $data->thumbnail = $thumbnail_name;
                $data->save();
            }



            if ($request->hasFile('gear_thumbnail')) {
                $thumb_file =  $request->file('gear_thumbnail');
                $sn_gear = 1;
                foreach ($request->file('gear_thumbnail') as $key => $image) {
                    $tripGear = new GuideImage();
                    $tripGear->guide_id = $find->id;
                    $tripGear->ordering = $request->gear_ordering[$key];
                    // Thumbnail upload
                    $thumbnail_name = time() . '-' . Str::random(15) . $image->getClientOriginalName();
                    $destinationPath = public_path('uploads/travel-guide');
                    $image->move($destinationPath . '/', $thumbnail_name);
                    $tripGear->image = $thumbnail_name;
                    $tripGear->save();
                    $sn_gear++;
                }
            }
            return response()->json(['status' => 'success', 'message' => 'Travel Guide updated successfully']);
        }
    }

//This is used- Delete Images
   public function delete_image($id)
    {
        $data = GuideImage::find($id);
        if ($data->file_name) {

            if (file_exists(public_path('uploads/travel-guide/' .  $data->file_name))) {
                unlink('uploads/travel-guide/' . $data->file_name);
            }
        }
        $data->delete();
        return response()->json([
          "errors"=>["Delete Successful."]
        ]);
    }


    public function delete($id)
    {
        $product = TravelGuide::findorfail($id);
        foreach ($product->images as $image) {
            $filename = $image->image;
            $deletePath = public_path('uploads/travel-guide/' . $image);
            if (file_exists($deletePath) && is_file($deletePath)) {
                unlink($deletePath);
            }
            $image->delete();
        }
        $product->delete();
        return response()->json([
          "errors"=>["Delete Successful."]
        ]);
    }

    //This is Used- Delete Guide Thumbnail
    public function delete_gear_guide_thumb($id)
    {
        $data = TravelGuide::find($id);
        if ($data->thumbnail) {
            if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail)) {
                unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail);
            }
        }
        $data->thumbnail = null;
        $data->save();
        return response()->json([
          "errors"=>["Delete Successful."]
        ]);
    }

    // Delete Trip Banner
    public function delete_gear_banner_thumb($id)
    {
        $data = TravelGuide::find($id);
        if ($data->banner) {
            if (file_exists(env('PUBLIC_PATH') . 'uploads/banners/' . $data->banner)) {
                unlink(env('PUBLIC_PATH') . 'uploads/banners/' . $data->banner);
            }
        }
        $data->banner = null;
        $data->save();
         return response()->json([
            'message' => 'Delete Successful!',
            'class_name' => 'alert-success'
        ]);
    }
}
