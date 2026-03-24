@extends('admin.master')
@section('breadcrumb')
<a href="{{ url('admin/trip/'  . Request::segment(2) . '/edit') }}" class="btn btn-success btn-sm">{{get_trip(Request::segment(2))->trip_title}}</a>
    <a href="{{ route('admin.tripdocs.index', Request::segment(2)) }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')

    @if(session('message'))
        <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{session('message')}}
        </div>
    @endif
    <form class="form-horizontal" id="upload_image1" role="form"
        action="{{ route('admin.tripdocs.update', ['admin' => Request::segment(2), 'tripdoc' => $data->id]) }}"
        method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT" />
        <div class="col-md-8">
            <!-- Input Fields -->
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Trip Document </span>
                </div>
                <div class="panel-body">
                    <input type="hidden" name="post_id" value="{{ Request::segment(3) }}">

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label"> Title </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" name="title" id="title" value="{{ $data->title ? $data->title : '' }}"
                                    class="form-control" />
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label"> Ordering </label>
                        <div class="col-lg-8">
                            <input type="text" name="ordering" value="{{ $data->ordering ? $data->ordering : '' }}"
                                class="form-control" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label"> Document </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="file" name="document" class="form-control" />
                            </div>
                        </div>
                    </div>

                    @if ($data->document)
                        <div class="form-group">
                            <label for="inputStandard" class="col-lg-2 control-label"> </label>
                            <div class="col-lg-8">
                                <div class="bs-component">
                                    <span class="id{{ $data->id }}">
                                        <!--<a href="#{{ $data->id }}" class="delete_doc">X</a>-->
                                        {{ $data->title == '' ? $data->document : $data->title }} - 
                                        <a href="{{ asset(env('PUBLIC_PATH') . 'uploads/doc/' . $data->document) }}" target="_blank">View File</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label"> </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="submit" class="btn btn-primary btn-sm" name="submit" value="Submit" />
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

       <aside class="col-lg-4 ">
 <!-- menu quick links -->

        <div class="admin-form">
          <div class="sid_bvijay mb10">
            <h4> Thumbnail </h4>
            <div class="hd_show_con">
              <div id="xedit-demo">
                   @if ($data->thumbnail)
                      <span class="thumbid{{ $data->id }}">
                      <a href="#{{ $data->id }}" class="imagedelete">X</a>
                      <img src="{{ asset(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail) }}" width="150" />
                      <hr>
                      </span>             
                      @endif 
               <input type="file" name="thumbnail" />
             </div>
           </div>
         </div>
       </div>
 
</aside>
    </form>
@endsection

@section('libraries')
    <script type="text/javascript">
         $('.imagedelete').on('click',function(e){
            e.preventDefault();
            if(!confirm('Are you sure to delete?')) return false;
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var str = $(this).attr('href');
            var id = str.slice(1);
            $.ajax({
              type:'delete',
              url:"{{ url('delete_tripdoc_thumb') . '/' }}" + id,
              data:{_token:csrf},    
              success:function(data){ 
                $('span.thumbid' + id ).remove();
              },
              error:function(data){  
              alert(data + 'Error!');     
              }
            });
          });

    </script>
@endsection
