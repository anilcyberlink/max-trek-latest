<?php

namespace App\Http\Controllers\AdminControllers\Teams;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Team\TeamModel;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data = TeamModel::orderBy('id','desc')->get();
        return view('admin.team.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ordering = TeamModel::max('ordering');
        $ordering = $ordering + 1;
        return view('admin.team.create', compact('ordering'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->ajax()) {
          $validator = Validator::make($request->all(), [
            'name'=>'required', 
          ]);
          if ($validator->fails()) {
              return response()->json([
                  'status' => 'error',
                  'errors' => $validator->errors()->all()
              ]);
          }

        $banner_width = env('BANNER_WIDTH');
        $banner_height = env('BANNER_HEIGHT');

        $data = $request->all();           

        /*************Banner Upload************/
        $file =  $request->file('banner');
        $banner_name = '';
        if($request->hasfile('banner')){
        $banner = $request->file('banner')->getClientOriginalName();
        $extension = $request->file('banner')->getClientOriginalExtension();
        $banner = explode('.', $banner);
        $banner_name = Str::slug($banner[0]) . '-' . Str::random(40) . '.' . $extension;

        $destinationPath = public_path('uploads/team');

        $banner_picture = Image::make($file->getRealPath());  
        $banner_picture->save($destinationPath .'/'. $banner_name ); 
      }

      /******Upload Thumbnail******/
      $thumb_file =  $request->file('thumbnail');
      $thumbnail_name = '';
        if($request->hasfile('thumbnail')){
        $thumbnail = $request->file('thumbnail')->getClientOriginalName();
        $extension = $request->file('thumbnail')->getClientOriginalExtension();
        $thumbnail = explode('.', $thumbnail);
        $thumbnail_name = Str::slug($thumbnail[0]) . '-' . Str::random(40) . '.' . $extension;

        $destinationPath = public_path('uploads/team');

        $thumbnail_picture = Image::make($thumb_file->getRealPath());
        $width = Image::make($thumb_file->getRealPath())->width();
        $height = Image::make($thumb_file->getRealPath())->height();     
        $thumbnail_picture->save($destinationPath .'/'. $thumbnail_name ); 
      }
      /*****************************/

      $data['team_key'] = time().rand(500,999);
      $data['uri'] = Str::slug($request->uri); 
      $data['banner'] = $banner_name;     
      $data['thumbnail'] = $thumbnail_name;    
      $isChecked = $request->has('show_in_home');
      $data['show_in_home'] = ($isChecked) ? '1' : '0'; 
      $result = TeamModel::create($data);
      $last_id = $result->id;

      return response()->json(['status' => 'success', 'message' => 'Member Added Successfully']);
    }
    return false;

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
         $data = TeamModel::find($id);     
        return view('admin.team.edit',compact('data'));
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
      if ($request->ajax()) { 
      
      $banner_width = env('BANNER_WIDTH');
      $banner_height = env('BANNER_HEIGHT');

      $data = TeamModel::find($id);  
      
      $file =  $request->file('banner');
      $thumbnail_file =  $request->file('thumbnail');    
      $banner_name = '';
      $thumbnail_name = '';
     
      if($request->hasfile('banner')){
        $data = TeamModel::find($id); 
        if($data->banner){
          if(file_exists(env('PUBLIC_PATH').'uploads/team/' . $data->banner)){
            unlink(env('PUBLIC_PATH').'uploads/team/' . $data->banner);
          }
        }
        $banner = $request->file('banner')->getClientOriginalName();
        $extension = $request->file('banner')->getClientOriginalExtension();
        $banner = explode('.', $banner);
        $banner_name = Str::slug($banner[0]) . '-' . Str::random(40) . '.' . $extension;
        $destinationPath = public_path('uploads/team');
        $banner_picture = Image::make($file->getRealPath());
        $width = Image::make($file->getRealPath())->width();
        $height = Image::make($file->getRealPath())->height();    

        $banner_picture->save($destinationPath .'/'. $banner_name ); 
        $data->banner = $banner_name;
      }  

      /*****Thumbnail*****/
      if($request->hasfile('thumbnail')){
        $data = TeamModel::find($id); 
        if($data->thumbnail){
          if(file_exists(env('PUBLIC_PATH').'uploads/team/' . $data->thumbnail)){
            unlink(env('PUBLIC_PATH').'uploads/team/' . $data->thumbnail);
          }
        }
        $thumbnail = $request->file('thumbnail')->getClientOriginalName();
        $extension = $request->file('thumbnail')->getClientOriginalExtension();
        $thumbnail = explode('.', $thumbnail);
        $thumbnail_name = Str::slug($thumbnail[0]) . '-' . Str::random(40) . '.' . $extension;
        $destinationPath = public_path('uploads/team');
        $thumbnail_picture = Image::make($thumbnail_file->getRealPath());
        $width = Image::make($thumbnail_file->getRealPath())->width();
        $height = Image::make($thumbnail_file->getRealPath())->height();    

        $thumbnail_picture->save($destinationPath .'/'. $thumbnail_name ); 
        $data->thumbnail = $thumbnail_name;
      } 

      $data->name = $request->name;
      $data->position = $request->position;     
      $data->phone = $request->phone;
      $data->email = $request->email;
      $data->highlights = $request->highlights; 
      $data->brief = $request->brief; 
      $data->facebook_url = $request->facebook_url; 
      $data->instagram_url = $request->instagram_url;
      $data->twitter_url = $request->twitter_url;
      $data->youtube_url = $request->youtube_url;
      $data->wikipedia_url = $request->wikipedia_url;
      $data->content = $request->content; 
      $data->ordering = $request->ordering;       
      $data->uri = Str::slug($request->uri);
      $isChecked = $request->has('show_in_home');
      $data->show_in_home = ($isChecked)?'1':'0';   
      $isChecked = $request->has('status');
      $data->status = ($isChecked)?'1':'0';     
     
      $_data = TeamModel::find($id);
      $data->save();
      return response()->json(['status' => 'success', 'message' => 'Member Updated Successful!']);
    }
    return false;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = TeamModel::find($id);
      if($data->banner){
        if(file_exists(env('PUBLIC_PATH').'uploads/team/' . $data->banner)){
          unlink(env('PUBLIC_PATH').'uploads/team/' . $data->banner);
        }
      }    
      if($data->thumbnail){      
      if(file_exists(env('PUBLIC_PATH').'uploads/team/' . $data->thumbnail)){
        unlink(env('PUBLIC_PATH').'uploads/team/' . $data->thumbnail);
      }
    }     
    
      $data->delete();
      return 'Are you sure to delete?';
    }


     public function thumbdelete($id)
    {
        $data = TeamModel::find($id);
     if($data->thumbnail){      
      if(file_exists(env('PUBLIC_PATH').'uploads/team/' . $data->thumbnail)){
        unlink(env('PUBLIC_PATH').'uploads/team/' . $data->thumbnail);
      }
    }
    $data->thumbnail = NULL;
    $data->save();
    return response('Delete Successful.');
    }

     public function bannerdelete($id)
    {
        $data = TeamModel::find($id);
     if($data->banner){      
      if(file_exists(env('PUBLIC_PATH').'uploads/team/' . $data->banner)){
        unlink(env('PUBLIC_PATH').'uploads/team/' . $data->banner);
      }
    }
    $data->banner = NULL;
    $data->save();
    return response('Delete Successful.');
    }
}
