<?php

namespace App\Http\Controllers\AdminControllers\Travels;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Travels\TripModel;
use App\Http\Controllers\Controller;
use App\Models\Travels\ActivityModel;
use Intervention\Image\Facades\Image;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ActivityModel::orderBy('id','desc')->get();
        dd('test');
        return view('admin.activities.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // List Activity Template
      $fileList = scandir(resource_path('views/themes/default/'));
      $filterArray = $this->filter_activity_template($fileList);
      $filename = array();
      foreach ($filterArray as $filterArr) {
        $filename[] = $this->remove_extention($filterArr);
      }
      $file1 = array('triplist'=>'Choose Template');
      foreach ($filename as $file) {
        $file1[$file] = $file;
      }
      $templates = $file1; 

      /*********/

        $ordering = 0;
        $ord = ActivityModel::max('ordering');
        $ordering += $ord + 1;       
        return view('admin.activities.create', compact('ordering','templates'));
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
        'title'=>'required',
         'uri' => 'required|unique:cl_trip_activities',        
        ]);

        $data = $request->all();        
        $file =  $request->file('banner');
        $banner_name = '';

        if($request->hasfile('banner')){
        $banner = $request->file('banner')->getClientOriginalName();
        $extension = $request->file('banner')->getClientOriginalExtension();
        $banner = explode('.', $banner);
        $banner_name = Str::slug($banner[0]) . '-' . Str::random(40) . '.' . $extension;

        $destinationPath = public_path('uploads/banners');

        $banner_picture = Image::make($file->getRealPath());         

        $banner_picture->save($destinationPath .'/'. $banner_name ); 

      }
      $icon_file = $request->file('icon');
      $icon_name = '';
      if ($request->hasfile('icon')) {
          $icon = $request->file('icon')->getClientOriginalName();
          $extension = $request->file('icon')->getClientOriginalExtension();
          $icon = explode('.', $icon);
          $icon_name = Str::slug($icon[0]) . '-' . Str::random(40) . '.' . $extension;

          $destinationPath = public_path('uploads/icon');

          $icon_picture = Image::make($icon_file->getRealPath());
          $width = Image::make($icon_file->getRealPath())->width();
          $height = Image::make($icon_file->getRealPath())->height();
          $icon_picture->save($destinationPath . '/' . $icon_name);
      }
      $data['thumbnail'] = $icon_name;
      $data['banner'] = $banner_name; 
      $data['uri'] = Str::slug($request->uri);
  
      $isChecked = $request->has('status');
      $data['status'] = ($isChecked) ? '1' : '0'; 
      // $data['template'] = $request->template;           
      $result = ActivityModel::create($data);
      $last_id = $result->id;
      /************/
      $_data = ActivityModel::find($last_id);     
      /************/

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
      
      // List Activity Template
      $fileList = scandir(resource_path('views/themes/default/'));
      $filterArray = $this->filter_activity_template($fileList);

      $filename = array();
      foreach ($filterArray as $filterArr) {
        $filename[] = $this->remove_extention($filterArr);
      }
      $file1 = array('triplist'=>'Choose Template');
      foreach ($filename as $file) {
        $file1[$file] = $file;
      }
      $templates = $file1; 

      /*********/      

        $data = ActivityModel::find($id);
        
        return view('admin.activities.edit', compact('data','templates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'title'=>'required',
         'uri' => 'required|unique:cl_trip_activities,uri,'.$id,
      ]);
     
      $data = ActivityModel::find($id);  
      $file = $request->file('banner'); 
      $banner_name = '';
      if($request->hasfile('banner')){
        $data = ActivityModel::find($id); 
        if($data->banner){
          if(file_exists(env('PUBLIC_PATH').'uploads/banners/' . $data->banner)){
            unlink(env('PUBLIC_PATH').'uploads/banners/' . $data->banner);
          }
        }
        $banner = $request->file('banner')->getClientOriginalName();
        $extension = $request->file('banner')->getClientOriginalExtension();
        $banner = explode('.', $banner);
        $banner_name = Str::slug($banner[0]) . '-' . Str::random(40) . '.' . $extension;

        $destinationPath = public_path('uploads/banners');

        $banner_picture = Image::make($file->getRealPath());
          
        $banner_picture->save($destinationPath .'/'. $banner_name ); 

        $data->banner = $banner_name;
      }
      $i_file = $request->file('thumbnail'); 
      $icon_name = '';
      if($request->hasfile('thumbnail')){
        $data = ActivityModel::find($id); 
        if($data->icon){
          if(file_exists(env('PUBLIC_PATH').'uploads/icon/' . $data->thumbnail)){
            unlink(env('PUBLIC_PATH').'uploads/icon/' . $data->thumbnail);
          }
        }
        $icon = $request->file('thumbnail')->getClientOriginalName();
        $extension = $request->file('thumbnail')->getClientOriginalExtension();
        $icon = explode('.', $icon);
        $icon_name = Str::slug($icon[0]) . '-' . Str::random(40) . '.' . $extension;

        $destinationPath = public_path('uploads/icon');

        $icon_picture = Image::make($i_file->getRealPath());
         
        $icon_picture->save($destinationPath .'/'. $icon_name ); 

        $data->thumbnail = $icon_name;
      }        
         
      $data->title = $request->title;
      $data->sub_title = $request->sub_title;
      $data->template = $request->template;
      $data->excerpt = $request->excerpt;  
      $data->content = $request->content;
      $data->uri = Str::slug($request->uri);    
      $data->ordering = $request->ordering;            
      $data->meta_keyword = $request->meta_keyword;
      $data->meta_description = $request->meta_description;   
      $data->category_video = $request->category_video;    
      $isChecked = $request->has('status');
      $data->status = ($isChecked)?'1':'0';

      /************/
      $_data = ActivityModel::find($id);
    
      /************/
     
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
      $data = ActivityModel::find($id);
      if($data->banner  != NULL){
        if(file_exists(env('PUBLIC_PATH').'uploads/banners/' . $data->banner)){
          unlink(env('PUBLIC_PATH').'uploads/banners/' . $data->banner);
        }
      }
      if($data->thumbnail  != NULL){
        if(file_exists(env('PUBLIC_PATH').'uploads/icon/' . $data->thumbnail)){
          unlink(env('PUBLIC_PATH').'uploads/icon/' . $data->thumbnail);
        }
      }
      $data->delete();
      return 'Are you sure to delete?';
    }

    // Filter Template Child
    private function filter_activity_template($template){
      $tmpl2 = array();
      if(!empty($template)){
        foreach($template as $tmpl){
          if(strpos($tmpl, "Activity") !== false){
            $tmpl2[] = $tmpl;
          }   
        }
      }
      return $tmpl2;
    }

    // Remove Extention
    private function remove_extention($filename){
      $exp = explode('.',$filename);
      $file = $exp[0];
      return $file;
    }

    
     // Delete  Thumbnail
     function delete_activity_thumb(ActivityModel $activityModel, $id){
      $data = ActivityModel::find($id);
      if($data->banner){
       if(file_exists(env('PUBLIC_PATH').'uploads/banners/' . $data->banner)){
         unlink(env('PUBLIC_PATH').'uploads/banners/' . $data->banner);
       }
     }
     $data->banner = NULL;
     $data->save();
     return response('Delete Successful.');
   }

   function delete_activity_icon(ActivityModel $activityModel, $id){
    $icon_data = ActivityModel::find($id);
    if($icon_data->thumbnail){
     if(file_exists(env('PUBLIC_PATH').'uploads/icon/' . $icon_data->thumbnail)){
       unlink(env('PUBLIC_PATH').'uploads/icon/' . $icon_data->thumbnail);
     }
   }
   $icon_data->thumbnail = NULL;
   $icon_data->save();
   return response('Delete Successful.');
 }
 public function isdefault(Request $request)
    {  
      $data = ActivityModel::find($request->id);      
       $default = ActivityModel::where('id','!=', $data->id)->get();
    if($data->isdefault == '1'){
      $data->isdefault = '0';   
      $data->save();  
      return back();
    }else if($data->isdefault == '0'){
       foreach($default as $row) {       
        if ( $row->isdefault == '1' ) {
             $default = ActivityModel::where('id',$row->id)->update(['isdefault'=> '0']);
        }
    }
      $data->isdefault = '1';      
      $data->save();  
      return back();
    }
    return back();  
  }
}
