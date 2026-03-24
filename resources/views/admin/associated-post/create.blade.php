@extends('admin.master')
@section('title', 'Post Category')
@section('breadcrumb')
  <a href="{{ url('admin/associated/' . Request::segment(3) . '/' . Request::segment(4)) }}"
    class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
  <form class="form-horizontal" role="form" action="{{url('admin/associated/' . Request::segment(3) . '/' . Request::segment(4) . '/store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-md-10">
      <!-- Input Fields -->
      <div class="panel">
        <div class="panel-heading">
          <span class="panel-title">Create Associated Post</span>
        </div>
        <div class="panel-body">
          <input type="hidden" name="post_id" value="{{Request::segment(4)}}" />
          <div class="form-group">
            <label for="title" class="col-lg-3 control-label">Title</label>
            <div class="col-lg-8">
              <div class="bs-component">
                <input type="text" id="title" name="title" class="form-control" />
                <input type="hidden" id="uri" name="uri" class="form-control" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="sub_title" class="col-lg-3 control-label">Sub Title</label>
            <div class="col-lg-8">
              <div class="bs-component">
                <input type="text" id="sub_title" name="sub_title" class="form-control" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="star" class="col-lg-3 control-label">Star</label>
            <div class="col-lg-8">
              <div class="bs-component">
                <input type="number" min="0" max="5" id="star" name="star" class="form-control" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="inputStandard" class="col-lg-3 control-label">Brief</label>
            <div class="col-lg-8">
              <div class="bs-component">
                <div class="bs-component">
                  <textarea class="form-control" id="" name="brief" rows="7" autocomplete="off"></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-lg-3 control-label">Ordering</label>
            <div class="col-lg-8">
              <div class="bs-component">
                <input type="number" id="ordering" name="ordering" class="form-control" value="{{$ordering}}" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="inputStandard" class="col-lg-3 control-label">Thumbnail</label>
            <div class="col-lg-8">
              <div class="bs-component">
                <div class="bs-component">
                  <div id="xedit-demo">
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
  <script type="text/javascript">
    $(document).ready(function () {
      $('#title').on('keyup', function () {
        var title;
        title = $('#title').val();
        title = title.replace(/[^a-zA-Z0-9 ]+/g, "");
        title = title.replace(/\s+/g, "-");
        $('#uri').val(title);
      });
    });
  </script>
@endsection