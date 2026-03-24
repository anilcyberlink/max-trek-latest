<?php

namespace App\Http\Controllers\AdminControllers\Pages;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Pages\PageTypeModel;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;


class PageTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PageTypeModel::orderBy('ordering','asc')->get();
        return view('admin.page-type.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    $ordering = PageTypeModel::max('ordering');
    $ordering = $ordering + 1;
    return view('admin.page-type.create',compact('ordering'));
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
            'page_type'=> 'required',
            'uri'=>'required|unique:cl_pagetype'
        ]);
        $medium_width = env('MEDIUM_WIDTH');
      $medium_height = env('MEDIUM_HEIGHT');

      $data = $request->all();
      $file =  $request->file('image');
      
      $product_name = '';
      if($request->hasfile('image')){
        $product = $request->file('image')->getClientOriginalName();
        $extension = $request->file('image')->getClientOriginalExtension();
        $product = explode('.', $product);
        $product_name = Str::slug($product[0]) . '-' . Str::random(40) . '.' . $extension;

        $destinationPath_medium = public_path('uploads/medium');
        $destinationOriginal = public_path('uploads/original');

        $product_picture = Image::make($file->getRealPath());
        $width = Image::make($file->getRealPath())->width();
        $height = Image::make($file->getRealPath())->height();
        
        /*Upload Original Image*/
        $product_picture->save($destinationOriginal .'/'. $product_name ); 
        
        $product_picture->resize($medium_width, $medium_height, function($constraint){
        $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $product_name ); 
      }
        $data['image'] = $product_name;
        $data['uri'] = Str::slug($request->uri);
        $result = PageTypeModel::create($data);
        if($result){
            return redirect()->back()->with('success','Stored Successfully.');
        }
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
          $data = PageTypeModel::find( $id );
        return view('admin.page-type.edit', compact('data'));
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
        'page_type'=>'required'
      ]);

      $medium_width = env('MEDIUM_WIDTH');
      $medium_height = env('MEDIUM_HEIGHT');

      $data = PageTypeModel::find($id);  
      $file =  $request->file('image');
      $product_name = '';
      if($request->hasfile('image')){
        $data = PageTypeModel::find($id); 
        if($data->image){
          if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->image)){
            unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->image);
          }
          if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->image)){
            unlink(env('PUBLIC_PATH').'uploads/original/' . $data->image);
          }
        }
        $product = $request->file('image')->getClientOriginalName();
        $extension = $request->file('image')->getClientOriginalExtension();
        $product = explode('.', $product);
        $product_name = Str::slug($product[0]) . '-' . Str::random(40) . '.' . $extension;

        $destinationPath_medium = public_path('uploads/medium');
        $destinationOriginal = public_path('uploads/original');

        $product_picture = Image::make($file->getRealPath());
        $width = Image::make($file->getRealPath())->width();
        $height = Image::make($file->getRealPath())->height(); 
        
        /*Upload Original Image*/
        $product_picture->save($destinationOriginal .'/'. $product_name ); 


        $product_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $product_name ); 
        
        $data->image = $product_name;
        $data->save();
      }    

      $data->page_type = $request->page_type;
      $data->brief = $request->brief;
      $data->ordering = $request->ordering;      
      $data->is_menu = $request->is_menu;
      $data->external_link = $request->external_link;     
      $data->uri = Str::slug($request->uri); 
      if($data->save()){
        return redirect()->back()->with('sucess','Update Sucessfully.');
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
         $data = PageTypeModel::find($id);
        if($data->image){
      if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->image)){
        unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->image);
      }
      if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->image)){
        unlink(env('PUBLIC_PATH').'uploads/original/' . $data->image);
      }
    }
        $data->delete();
        return response()->json([
          "errors"=>["Delete Successful."]
        ]);
    }

    public function delete_pagetype_thumb($id)
    {
      $data = PageTypeModel::find($id);
     if($data->image){
      if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->image)){
        unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->image);
      }
      if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->image)){
        unlink(env('PUBLIC_PATH').'uploads/original/' . $data->image);
      }
    }
    $data->image = NULL;
    $data->save();
    return response()->json([
          "errors"=>["Delete Successful."]
        ]);
    }
}
