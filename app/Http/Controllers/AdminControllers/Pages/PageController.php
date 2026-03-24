<?php

namespace App\Http\Controllers\AdminControllers\Pages;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Pages\PageModel;
use App\Models\Pages\PageDetails;
use App\Models\Pages\PageTypeModel;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;



class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uri)
    {
      $pagetype = PageTypeModel::where('uri',$uri)->first();     
      if($pagetype){
        $pagetypeId = $pagetype->id;        
        $data = PageModel::where(['page_type'=>$pagetypeId,'page_parent'=>0])->orderBy('page_order','asc')->get();
         
        return view('admin.page.index', compact('data')); 
      }
      return redirect('/dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get parent list by post type ID  
      $pagetype_uri = request()->segment(2); 
      $pagetype = $this->getPageTypeId($pagetype_uri);
      $pagetype_id = $pagetype->id;
        $ordering = PageModel::max('page_order');
        $ordering = $ordering + 1;
        return view('admin.page.create', compact('ordering'));
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
            'page_title' => 'required',
            
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
        $file =  $request->file('page_banner');
        $banner_name = '';
        if($request->hasfile('page_banner')){
        $banner = $request->file('page_banner')->getClientOriginalName();
        $extension = $request->file('page_banner')->getClientOriginalExtension();
        $banner = explode('.', $banner);
        $banner_name = Str::slug($banner[0]) . '-' . Str::random(40) . '.' . $extension;

        $destinationPath = public_path('uploads/banners');

        $banner_picture = Image::make($file->getRealPath());
           
        $banner_picture->save($destinationPath .'/'. $banner_name ); 
        $data['page_banner'] = $banner_name;
        
      }

      /******Upload Thumbnail******/
      $thumb_file =  $request->file('page_thumbnail');
      $thumbnail_name = '';
        if($request->hasfile('page_thumbnail')){
        $thumbnail = $request->file('page_thumbnail')->getClientOriginalName();
        $extension = $request->file('page_thumbnail')->getClientOriginalExtension();
        $thumbnail = explode('.', $thumbnail);
        $thumbnail_name = Str::slug($thumbnail[0]) . '-' . Str::random(40) . '.' . $extension;

        $destinationPath = public_path('uploads/original');

        $thumbnail_picture = Image::make($thumb_file->getRealPath());
        $width = Image::make($thumb_file->getRealPath())->width();
        $height = Image::make($thumb_file->getRealPath())->height();     
        $thumbnail_picture->save($destinationPath .'/'. $thumbnail_name ); 
         $data['page_thumbnail'] = $thumbnail_name;
      }
      /*****************************/

      $data['page_key'] = time().rand(500000,999999999);
      $pagetypeId = $this->getPageTypeId($request->page_type);    
      $data['page_type'] = $pagetypeId->id;
      $data['uri'] = Str::slug($request->uri); 
          
         
       
      
      $is_draft  = '0';
      if($request->submit == 'publish'){
        $is_draft = '0';
      }else if($request->submit == 'draft'){
        $is_draft = '1';
      }
      $data['is_draft'] = $is_draft; 
      $result = PageModel::create($data);
      $last_id = $result->id;

      
       // Insert into Details

      if(isset($request->ordering)){
        $info_keys = array_keys($request->ordering);   
        $sn_info = 1;
        $sn_info_count = count($request->ordering);
        foreach($info_keys as $key){
          if( $key + 1 >= $sn_info_count ){
            continue;
          }
          $PageDetails = new PageDetails();
          $PageDetails->page_id = $last_id;       
          $PageDetails->ordering = $request->ordering[$key];   
          $PageDetails->title = $request->title[$key];   
          $PageDetails->content = $request->content[$key]; 
          $PageDetails->save(); 
          $sn_info++;     
        }
      }

     
      /************************************/
      return response()->json(['status' => 'success', 'message' => 'Page Added Successfully']);
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
    public function edit(PageModel $pageModel, $pagetype, $id)
    {
       $data = PageModel::find($id);  
       $details = $data->details()->get(); 
       
        return view('admin.page.edit',compact('data','details'));

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
        $is_draft = 0;
        if($request->submit == 'publish'){
          $is_draft = 0;
        }else if($request->submit == 'draft'){
          $is_draft = 1;
        }
      
      $banner_width = env('BANNER_WIDTH');
      $banner_height = env('BANNER_HEIGHT');

      $data = PageModel::find($id);  
      
      $file =  $request->file('page_banner');
      $thumbnail_file =  $request->file('page_thumbnail');    
      $banner_name = '';
      $thumbnail_name = '';
     
      if($request->hasfile('page_banner')){
        $data = PageModel::find($id); 
        if($data->page_banner){
          if(file_exists(env('PUBLIC_PATH').'uploads/banners/' . $data->page_banner)){
            unlink(env('PUBLIC_PATH').'uploads/banners/' . $data->page_banner);
          }
        }
        $banner = $request->file('page_banner')->getClientOriginalName();
        $extension = $request->file('page_banner')->getClientOriginalExtension();
        $banner = explode('.', $banner);
        $banner_name = Str::slug($banner[0]) . '-' . Str::random(40) . '.' . $extension;
        $destinationPath = public_path('uploads/banners');
        $banner_picture = Image::make($file->getRealPath());
        $width = Image::make($file->getRealPath())->width();
        $height = Image::make($file->getRealPath())->height();    

        $banner_picture->save($destinationPath .'/'. $banner_name ); 
        $data->page_banner = $banner_name;
        $data->save();
      }  

      /*****Thumbnail*****/
      if($request->hasfile('page_thumbnail')){
        $data = PageModel::find($id); 
        if($data->page_thumbnail){
          if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail)){
            unlink(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail);
          }
        }
        $thumbnail = $request->file('page_thumbnail')->getClientOriginalName();
        $extension = $request->file('page_thumbnail')->getClientOriginalExtension();
        $thumbnail = explode('.', $thumbnail);
        $thumbnail_name = Str::slug($thumbnail[0]) . '-' . Str::random(40) . '.' . $extension;
        $destinationPath = public_path('uploads/original');
        $thumbnail_picture = Image::make($thumbnail_file->getRealPath());
        $width = Image::make($thumbnail_file->getRealPath())->width();
        $height = Image::make($thumbnail_file->getRealPath())->height();    

        $thumbnail_picture->save($destinationPath .'/'. $thumbnail_name ); 
        $data->page_thumbnail = $thumbnail_name;
        $data->save();
      }   

      
      $data->page_title = $request->page_title;
      $data->sub_title = $request->sub_title;
      $data->page_excerpt = $request->page_excerpt;
      $data->page_content = $request->page_content;
      $data->meta_keyword = $request->meta_keyword;
      $data->meta_description = $request->meta_description; 
      $data->page_order = $request->page_order; 
      $data->external_link = $request->external_link; 
     $data->uri = Str::slug($request->uri); 
     
      $data->is_draft = $is_draft;
      
      $_data = PageModel::find($id);
        

    // Update Details  

    if(isset($request->ordering)){
        $detail_keys = array_keys($request->ordering); 
        $sn_details = 1;
        $sn_detail_count = count($request->ordering);  
        foreach($detail_keys as $key=>$value){          
            if($key + 1 >= $sn_detail_count){
              continue;
            }          
          if($request->detail_id[$value] == ""){
              $detailData = new PageDetails();
              $detailData->page_id = $data->id;
              $detailData->ordering = $request->ordering[$key];
              $detailData->title = $request->title[$key];
              $detailData->content = $request->content[$key]; 
            
              $detailData->save();  
          } else if($request->detail_id[$value] !== NULL && $request->detail_id[$value] !== ""){
            $detail_id = $request->detail_id[$value];
              $detailData = PageDetails::find($detail_id);
              $detailData->page_id = $data->id;
              $detailData->ordering = $request->ordering[$key];
              $detailData->title = $request->title[$key];
              $detailData->content = $request->content[$key]; 
           
              $detailData->save(); 
          }         
          $sn_details++;
        }
      }
      
    
      $data->save();
      return response()->json(['status' => 'success', 'message' => 'Page Updated Successful!']);
    }
    return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($posttype,$id)
    {
         $data = PageModel::find($id);
      if($data->page_banner  != NULL){
        if(file_exists(env('PUBLIC_PATH').'uploads/banners/' . $data->page_banner)){
          unlink(env('PUBLIC_PATH').'uploads/banners/' . $data->page_banner);
        }
      }    
      if($data->page_thumbnail  != NULL){
        if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail)){
          unlink(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail);
        }
      }      
    
      $data->details()->delete();
      $data->delete();
      return response()->json([
          "errors"=>["Delete Successful."]
        ]);
    }

     public function detailsdestroy($pagetype, $page_id,$id)
    {
      $data = PageDetails::find($id);      
      $data->delete();
      return response()->json([
          "errors"=>["Delete Successful."]
        ]);
    }


     // Return Post Type uri
    private function getPageTypeId($uri){
      $pagetype = PageTypeModel::where('uri',$uri)->first();
      return $pagetype;
    }
    
    // Delete Post Thumbnail
    public function delete_page_thumb(PageModel $PageModel, $id)
    {
        $data = PageModel::find($id);
        if ($data->page_thumbnail) {
            if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->page_thumbnail)) {
                unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->page_thumbnail);
            }
            if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->page_thumbnail)) {
                unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->page_thumbnail);
            }
        }
        $data->page_thumbnail = null;
        $data->save();
        return response()->json([
          "errors"=>["Delete Successful."]
        ]);
    }

    public function delete_page_banner(PageModel $PageModel, $id)
    {
        $data = PageModel::find($id);
        if ($data->page_banner) {
            if (file_exists(env('PUBLIC_PATH') . 'uploads/bannners/' . $data->page_banner)) {
                unlink(env('PUBLIC_PATH') . 'uploads/bannners/' . $data->page_banner);
            }
        }
        $data->page_banner = null;
        $data->save();
        return response()->json([
          "errors"=>["Delete Successful."]
        ]);
    }
    public function pagestatus($id){
    $data = PageModel::find($id);
    if($data->status == '1'){
      $data->status = '0';
      $data->save();
      return 'Success';
    }else if($data->status == '0'){
      $data->status = '1';
      $data->save();
      return 'Success';
    }
    return 'Not success';
  }
}
