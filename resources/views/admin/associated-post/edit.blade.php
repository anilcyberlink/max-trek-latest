@extends('admin.master')
@section('title', 'Post Category')
@section('breadcrumb')
  @if(Request::segment(3))
    <a href="{{url('admin/associated/' . Request::segment(3) . '/' . $data->post_id)}}" class="btn btn-primary btn-sm">Go Back</a>
  @endif
@endsection
@section('content')
  <form class="form-horizontal" role="form"
    action="{{url('admin/associated/' . Request::segment(3) . '/' . Request::segment(4))}}" method="post"
    enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT" />
    <div class="col-md-10">
      <!-- Input Fields -->
      <div class="panel">
        <div class="panel-heading">
          <span class="panel-title">Edit Associated Post</span>
        </div>
        <div class="panel-body">
          <input type="hidden" name="post_id" value="{{Request::segment(4)}}" />
          <div class="form-group">
            <label for="title" class="col-lg-3 control-label">Title</label>
            <div class="col-lg-8">
              <div class="bs-component">
                <input type="text" id="title" name="title" class="form-control" value="{{$data->title}}" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="sub_title" class="col-lg-3 control-label">Sub Title</label>
            <div class="col-lg-8">
              <div class="bs-component">
                <input type="text" id="sub_title" name="sub_title" class="form-control" value="{{$data->sub_title}}" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="star" class="col-lg-3 control-label">Star</label>
            <div class="col-lg-8">
              <div class="bs-component">
                <input type="number" min="0" max="5" id="star" name="star" class="form-control" value="{{$data->star}}" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="inputStandard" class="col-lg-3 control-label">Brief</label>
            <div class="col-lg-8">
              <div class="bs-component">
                <div class="bs-component">
                  <textarea class="form-control " id="" name="brief" rows="7"
                    autocomplete="off">{{$data->brief}}</textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-lg-3 control-label">Ordering</label>
            <div class="col-lg-8">
              <div class="bs-component">
                <input type="number" id="ordering" name="ordering" class="form-control" value="{{$data->ordering}}" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="inputStandard" class="col-lg-3 control-label">Thumbnail</label>
            <div class="col-lg-8">
              <div class="bs-component">
                <div class="bs-component">
                  <div id="xedit-demo">
                    @if($data->thumbnail)
                      <span class="id{{$data->id}}">
                        <a href="#{{$data->id}}" class="imagedelete"></a>
                        <img src="{{ asset(env('PUBLIC_PATH') . 'uploads/associated/' . $data->thumbnail) }}" width="150" />
                      </span>
                      <hr>
                    @endif
                    <input type="file" name="thumbnail" />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label" for=""> </label>
            <div class="col-lg-8">
              <div class="bs-component">
                <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>

    <div class="col-md-4"> </div>
  </form>
@endsection
@section('scripts')
@endsection