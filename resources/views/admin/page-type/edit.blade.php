@extends('admin.master')
@section('title', 'Page Type')
@section('breadcrumb')
    <a href="{{ url('admin', Request::segment(2)) }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
    <form class="form-horizontal" role="form" action="{{ url('admin/' . Request::segment(2) . '/' . $data->id) }}" method="post"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT" />
        <div class="col-md-9">
            <!-- Input Fields -->
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Edit Page Type</span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label">Page Type</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="page_type" name="page_type" class="form-control" placeholder=""
                                    value="{{ $data->page_type }}" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Uri</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="uri" name="uri" class="form-control" placeholder=""
                                    value="{{ $data->uri }}" readonly />
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Brief</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <textarea class="form-control" id="" name="brief" rows="3">{{ $data->brief }}</textarea>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Image</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="file" name="image" />
                                @if ($data->image)
                                    <span class="id{{ $data->id }}">
                                        <a href="#{{ $data->id }}" class="imagedelete">X</a>
                                        <img src="{{ asset(env('PUBLIC_PATH') . 'uploads/medium/' . $data->image) }}"
                                            width="150" />
                                        <hr>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="admin-form">

                <div class="sid_bvijay mb10">
                    <div class="hd_show_con">
                        <div class="publice_edi">
                            Status:
                            <a href="avoid:javascript;" data-toggle="collapse" data-target="#publish_1">
                                Active
                            </a>
                        </div>
                    </div>
                    <footer>
                        <div id="publishing-action">
                            <input type="submit" class="btn btn-primary btn-lg" value="Publish" />
                        </div>
                        <div class="clearfix"></div>
                    </footer>
                    <div class="clearfix"></div>
                </div>

                <div class="sid_bvijay mb10">
                    <label class="field text">
                        <h4> Ordering: </h4>
                        <input type="number" id="ordering" name="ordering" class="form-control"
                            value="{{ $data->ordering }}" />
                    </label>
                </div>

                <div class="sid_bvijay mb10">
                    <label class="field text">
                        <h4> Is Menu: </h4>
                        <select name="is_menu" class="form-control input-sm">
                            <option value="0" {{ $data->is_menu == '0' ? 'selected' : '' }}> No </option>
                            <option value="1" {{ $data->is_menu == '1' ? 'selected' : '' }}> Yes </option>
                        </select>
                    </label>
                </div>

                {{-- <div class="sid_bvijay mb10">
                    <label class="field text">
                        <h4> External Link </h4>
                        <input type="text" id="" name="external_link" class="form-control"
                            placeholder="External Link" value="{{ $data->external_link }}" />
                    </label>
                </div> --}}

            </div>
        </div>

    </form>
@endsection
@section('libraries')
    <script type="text/javascript">
        $('.imagedelete').on('click', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure to delete?')) return false;
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var str = $(this).attr('href');
            var id = str.slice(1);
            $.ajax({
                type: 'delete',
                url: "{{ url('delete_pagetype_thumb') . '/' }}" + id,
                data: {
                    _token: csrf
                },
                success: function(data) {
                    $('span.id' + id).remove();
                      jQuery.each(data.errors, function (key, value) {
                   toastr.error(value);
                    });
                },
                error: function(data) {
                    alert(data + 'Error!');
                }
            });
        });
    </script>
@endsection

@section('scripts')
    //
    <script type="text/javascript">
        //   $(document).ready(function(){
        //     var page_type;
        //     $('#page_type').on('keyup', function(){
        //       page_type = $('#page_type').val();
        //       page_type=page_type.replace(/[^a-zA-Z0-9 ]+/g,"");
        //       page_type=page_type.replace(/\s+/g, "-");
        //       $('#uri').val(page_type);
        //     });
        //   });   
        // 
    </script>
@endsection
