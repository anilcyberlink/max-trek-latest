@extends('admin.master')
@section('title', 'Banner')
@section('breadcrumb')
    <a href="admin/partner" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')

    <form class="form-horizontal" role="form" action="{{ url('admin/partner', $data->id) }}" method="post"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT" />
        <div class="col-md-12">
            <!-- Input Fields -->
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Edit Partners</span>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Title</label>
                        <div class="col-lg-6">
                            <div class="bs-component">
                                <input type="text" id="inputStandard" name="title" class="form-control" placeholder=""
                                    value="{{ $data->title }}" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="banner">Logo</label>
                        <div class="col-lg-6">
                            <div class="bs-component">
                                <input type="file" class="form-control" name="picture" />
                            </div> <br />
                            ( Width: 1500px, Height:500px all time fix size )
                        </div>

                    </div>

                    @if ($data->picture != '' or $data->picture != null)
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="banner"></label>
                            <div class="col-lg-6">
                                <div class="bs-component">
                                    <img src="{{ url(env('PUBLIC_PATH') . 'uploads/banners/' . $data->picture) }}"
                                        width="70%" />
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="link">Link</label>
                        <div class="col-lg-6">
                            <div class="bs-component">
                                <input type="text" class="form-control" name="link" value="{{ $data->link }}"
                                    placeholder="http://www.google.com" /> <br />

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for=""></label>
                        <div class="col-lg-6">
                            <div class="bs-component">
                                <input type="submit" class="form-control btn btn-primary" name="submit" value="Submit" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </form>
@endsection
