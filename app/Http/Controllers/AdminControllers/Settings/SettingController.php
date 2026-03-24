<?php

namespace App\Http\Controllers\AdminControllers\Settings;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\SettingModel;
use Intervention\Image\Facades\Image;


class SettingController extends Controller
{
    public function index()
    {
        $data = SettingModel::where('id', 1)->first();
        return view('admin.settings.setting', compact('data'));
    }

    public function store(Request $request)
    {
        return $request;
    }

    public function edit(Request $request)
    {
        $data = SettingModel::where('id', 1)->first();
        return view('admin.settings.setting');
    }

     public function update(Request $request, $id){

      $medium_width = 168;
      $medium_height = 57;
      
      $original_width=1366;
      $original_height=216;
      
      $mobile_width=515;
      $mobile_height=297;

      $data = SettingModel::where('id',$id)->first();

      $file =  $request->file('logo');
      $logo_name = '';
      if($request->hasfile('logo')){
        $data = SettingModel::find($id);
        if($data->logo){
          if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->logo)){
            unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->logo);
          }
          if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->logo)){
            unlink(env('PUBLIC_PATH').'uploads/original/' . $data->logo);
          }
        }
        $logo = $request->file('logo')->getClientOriginalName();
        $extension = $request->file('logo')->getClientOriginalExtension();
        $logo = explode('.', $logo);
        $logo_name = Str::slug($logo[0]) . '-' . time() . '.' . $extension;

        $destinationPath_medium = public_path('uploads/medium');
        $destinationOriginal = public_path('uploads/original');

        $logo_picture = Image::make($file->getRealPath());
        $width = Image::make($file->getRealPath())->width();
        $height = Image::make($file->getRealPath())->height();

        $logo_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $logo_name );

        /*Upload Original Image*/
        $logo_picture->resize($width, $height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationOriginal .'/'. $logo_name );

        $data->logo = $logo_name;
      }

         $file =  $request->file('worked_with');
         $logo_name = '';
         if($request->hasfile('worked_with')){
             $data = SettingModel::find($id);
             if($data->worked_with){
                 if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->worked_with)){
                     unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->worked_with);
                 }
                 if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->worked_with)){
                     unlink(env('PUBLIC_PATH').'uploads/original/' . $data->worked_with);
                 }
             }
             $logo = $request->file('worked_with')->getClientOriginalName();
             $extension = $request->file('worked_with')->getClientOriginalExtension();
             $logo = explode('.', $logo);
             $logo_name = Str::slug($logo[0]) . '-' . time() . '.' . $extension;

             $destinationPath_medium = public_path('uploads/medium');
             $destinationOriginal = public_path('uploads/original');

             $logo_picture = Image::make($file->getRealPath());
             $width = Image::make($file->getRealPath())->width();
             $height = Image::make($file->getRealPath())->height();

             /*Upload Original Image*/
             $logo_picture->resize($original_width, $original_height, function($constraint){
                 $constraint->aspectRatio();
             })->save($destinationOriginal .'/'. $logo_name );

             $data->worked_with = $logo_name;
         }

         $file =  $request->file('affililiated_with');
         $logo_name = '';
         if($request->hasfile('affililiated_with')){
             $data = SettingModel::find($id);
             if($data->affililiated_with){
                 if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->affililiated_with)){
                     unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->affililiated_with);
                 }
                 if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->affililiated_with)){
                     unlink(env('PUBLIC_PATH').'uploads/original/' . $data->affililiated_with);
                 }
             }
             $logo = $request->file('affililiated_with')->getClientOriginalName();
             $extension = $request->file('affililiated_with')->getClientOriginalExtension();
             $logo = explode('.', $logo);
             $logo_name = Str::slug($logo[0]) . '-' . time() . '.' . $extension;

             $destinationPath_medium = public_path('uploads/medium');
             $destinationOriginal = public_path('uploads/original');

             $logo_picture = Image::make($file->getRealPath());
             $width = Image::make($file->getRealPath())->width();
             $height = Image::make($file->getRealPath())->height();

         
             /*Upload Original Image*/
             $logo_picture->resize($mobile_width, $mobile_height, function($constraint){
                 $constraint->aspectRatio();
             })->save($destinationOriginal .'/'. $logo_name );

             $data->affililiated_with = $logo_name;
         }
        if($data){
            $data->site_name = $request->site_name;
            $data->phone = $request->phone;
            $data->fax = $request->fax;
            $data->skype = $request->skype;
            $data->email_primary = $request->email_primary;
            $data->email_secondary = $request->email_secondary;
            $data->address = $request->address;
            $data->facebook_link = $request->facebook_link;
            $data->linkedin_link = $request->linkedin_link;
            $data->youtube_link = $request->youtube_link;
            $data->twitter_link = $request->twitter_link;
            $data->instagram_link = $request->instagram_link;
            $data->tripadvisor_link = $request->tripadvisor_link;
            $data->caption = $request->caption;
            $data->meta_key = $request->meta_key;
            $data->meta_description = $request->meta_description;
            $data->google_map = $request->google_map;
            $data->google_map2 = $request->google_map2;
            $data->copyright_text = $request->copyright_text;   
        }
        else{
            $data = new SettingModel;
            $data->site_name = $request->site_name;
            $data->phone = $request->phone;
            $data->fax = $request->fax;
            $data->skype = $request->skype;
            $data->email_primary = $request->email_primary;
            $data->email_secondary = $request->email_secondary;
            $data->address = $request->address;
            $data->facebook_link = $request->facebook_link;
            $data->linkedin_link = $request->linkedin_link;
            $data->youtube_link = $request->youtube_link;
            $data->twitter_link = $request->twitter_link;
            $data->instagram_link = $request->instagram_link;
            $data->tripadvisor_link = $request->tripadvisor_link;
            $data->caption = $request->caption;
            $data->meta_key = $request->meta_key;
            $data->meta_description = $request->meta_description;
            $data->google_map = $request->google_map;
            $data->google_map2 = $request->google_map2;
            $data->copyright_text = $request->copyright_text; 
        }

        if($data->save()){
            return redirect()->back()->with('success','Update Sucessfully.');
        }

    }

      // Delete Logo
      function destroy($id){
        $data = SettingModel::find($id);
        if($data->logo){
         if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->logo)){
           unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->logo);
         }
         if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->logo)){
           unlink(env('PUBLIC_PATH').'uploads/original/' . $data->logo);
         }
       }
       $data->logo = NULL;
       $data->save();
       return response('Delete Successful.');
     }

    public function banner_destroy($id){
        $data = SettingModel::find($id);
        if($data->worked_with){
            if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->worked_with)){
                unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->worked_with);
            }
            if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->worked_with)){
                unlink(env('PUBLIC_PATH').'uploads/original/' . $data->worked_with);
            }
        }
        $data->worked_with = NULL;
        $data->save();
        return response('Delete Successful.');
    }

    public function mobile_banner_destroy($id){
        $data = SettingModel::find($id);
        if($data->affililiated_with){
            if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->affililiated_with)){
                unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->affililiated_with);
            }
            if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->affililiated_with)){
                unlink(env('PUBLIC_PATH').'uploads/original/' . $data->affililiated_with);
            }
        }
        $data->affililiated_with = NULL;
        $data->save();
        return response('Delete Successful.');
    }
}
