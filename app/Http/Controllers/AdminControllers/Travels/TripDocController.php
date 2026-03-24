<?php

namespace App\Http\Controllers\AdminControllers\Travels;

use App\Http\Controllers\Controller;
use App\Models\Travels\TripDocModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use Image;

class TripDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trip_id = request()->segment(2);
        $data = TripDocModel::where('trip_id', $trip_id)->paginate(20);
        return view('admin.trip-docs.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($trip)
    {
        $ordering = TripDocModel::max('ordering');
        $ordering = $ordering + 1;
        return view('admin.trip-docs.create', compact('trip', 'ordering'));
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
             'document' => 'required',
            'document.*' => 'mimes:doc,pdf,docx',
        ]);
      
        $data = $request->all();
        
        
        if ($request->hasfile('thumbnail')) {
                $doc = $request->file('thumbnail')->getClientOriginalName();
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $doc = explode('.', $doc);
            $document = Str::slug($doc[0]) . '-' . uniqid() . '.' . $extension;

            $request->file('thumbnail')->move(public_path('uploads/original/'), $document);
            $data['thumbnail'] = $document;

        }

        if ($request->hasfile('document')) {
            $doc = $request->file('document')->getClientOriginalName();
            $extension = $request->file('document')->getClientOriginalExtension();
            $doc = explode('.', $doc);
            $document = Str::slug($doc[0]) . '-' . uniqid() . '.' . $extension;

            $request->file('document')->move(public_path('uploads/doc/'), $document);
            $data['document'] = $document;
        }
         $data['key_string'] = Str::random(40);
        $result = TripDocModel::create($data);
        $last_id = $result->id;
        if ($result) {
            return redirect()-> back()->with('success', 'Successfully added.');
        } else {
            return 'Error';
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
    public function edit($trip_id, $id)
    {
        $data = TripDocModel::find($id);
        return view('admin.trip-docs.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $trip_id, $id)
    {
        $data = TripDocModel::find($id);
        $document = "";
        if ($request->hasfile('thumbnail')) {
             if ($data->thumbnail) {
                if (file_exists(public_path('uploads/original/' . $data->thumbnail))) {
                    unlink('uploads/original/' . $data->thumbnail);
                }
            }
                $doc = $request->file('thumbnail')->getClientOriginalName();
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $doc = explode('.', $doc);
            $document = Str::slug($doc[0]) . '-' . uniqid() . '.' . $extension;

            $request->file('thumbnail')->move(public_path('uploads/original/'), $document);
            $data['thumbnail'] = $document;

        }

        if ($request->hasfile('document')) {
            
             if ($data->document) {
                if (file_exists(public_path('uploads/doc/' . $data->document))) {
                    unlink('uploads/doc/' . $data->document);
                }
            }
            $doc = $request->file('document')->getClientOriginalName();
            $extension = $request->file('document')->getClientOriginalExtension();
            $doc = explode('.', $doc);
            $document = Str::slug($doc[0]) . '-' . uniqid() . '.' . $extension;

            $request->file('document')->move(public_path('uploads/doc/'), $document);
            $data['document'] = $document;
        }

        $data['title'] = $request->title;
        $data['ordering'] = $request->ordering;

        if ($data->save()) {
            return redirect()->back()->with('message', 'Update Sucessful.');
        } else {
            return "Error";
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($trip, $id)
    {
        $data = TripDocModel::find($id);
        if ($data->thumbnail) {
                if (file_exists(public_path('uploads/original/' . $data->thumbnail))) {
                    unlink('uploads/original/' . $data->thumbnail);
                }
            }
             if ($data->document) {
                if (file_exists(public_path('uploads/doc/' . $data->document))) {
                    unlink('uploads/doc/' . $data->document);
                }
            }
        $data->delete();
         return response()->json(['status' => 'success', 'message' => 'Successfully Deleted']);
      
    }

    // Delete doc file
    public function delete_doc_file(TripDocModel $TripDocModel, $id)
    {
        $data = TripDocModel::find($id);
        if ($data->document) {
            if (file_exists(public_path('uploads/doc/' . $data->document))) {
                unlink('uploads/doc/' . $data->document);
            }
        }
        $data->document = null;
        $data->save();
        return response()->json(['status' => 'success', 'message' => 'Successfully Deleted']);
    }
    
    // Delete doc thumb file
    public function delete_tripdoc_thumb(TripDocModel $TripDocModel, $id)
    {
        $data = TripDocModel::find($id);
        if ($data->thumbnail) {
            if (file_exists(public_path('uploads/original/' . $data->thumbnail))) {
                unlink('uploads/original/' . $data->thumbnail);
            }
        }
        $data->thumbnail = null;
        $data->save();
         return response()->json(['status' => 'success', 'message' => 'Successfully Deleted']);
    }

    function list($id) {
        $data = TripDocModel::where('trip_id', $id)->get();
        if ($data) {
            return view('admin.trip-docs.index', compact('data'));
        }
        return false;
    }

}
