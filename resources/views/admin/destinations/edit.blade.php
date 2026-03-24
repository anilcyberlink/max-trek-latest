@extends('admin.master')
@section('title', '')
@section('breadcrumb')
    <a href="{{ route('expedition.index') }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')

    <form class="form-horizontal" role="form" action="{{ route('expedition.update', $data->id) }}" method="post"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PUT')
        <div class="col-md-9">
            <!-- Input Fields -->
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Edit Tour </span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label"> Title </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="title" name="title" class="form-control"
                                    value="{{ $data->title }}" />
                                <input type="hidden" id="uri" name="uri" value="{{ $data->uri }}" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label"> Sub Title</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="sub_title" name="sub_title" class="form-control" value="{{ $data->sub_title }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label"> Caption</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="excerpt" name="excerpt" class="form-control" value="{{ $data->excerpt }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label"> Description</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <textarea type="text" id="content" name="content" class="form-control my-editor">{{ $data->content }}</textarea>
                            </div>
                        </div>
                    </div>

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
                    <label class="field">
                        <input type="number" id="ordering" name="ordering" class="form-control"
                            value="{{ $data->ordering }}" />
                    </label>
                </div>

                <!-- <div class="sid_bvijay mb10">
                    <h4> Thumbnail </h4>
                    <div class="hd_show_con">
                        <div id="xedit" class="bs-component">
                            <input type="file" name="thumbnail" />
                        </div>
                        @if ($data->thumbnail)
                            <span class="thumbnailid{{ $data->id }}">
                                <a href="#{{ $data->id }}" class="delete_thumbnail">X</a>
                                <br>
                                <img src="{{ asset('uploads/original/' . $data->thumbnail) }}" width="100%" />

                            </span>
                        @endif
                    </div>
                </div>
                <div class="sid_bvijay mb10">
                    <h4> Banner </h4>
                    <div class="hd_show_con">
                        <div id="xedit" class="bs-component">
                            <input type="file" name="banner" />
                        </div>
                        @if ($data->banner)
                            <span class="bannerid{{ $data->id }}">
                                <a href="#{{ $data->id }}" class="delete_banner">X</a>
                                <img src="{{ asset('uploads/original/' . $data->banner) }}" width="100%" />
                        @endif
                    </div>
                </div> -->


            </div>
        </div>

    </form>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#title').on('keyup', function() {
                var title;
                title = $('#title').val();
                title = title.replace(/[^a-zA-Z0-9 ]+/g, "");
                title = title.replace(/\s+/g, "-");
                $('#uri').val(title);
            });
        });

        $('.delete_banner').on('click', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure to delete?')) return false;
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var str = $(this).attr('href');
            var id = str.slice(1);
            var url = "{{ route('delete-destination-banner', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'delete',
                url: url,
                data: {
                    _token: csrf
                },
                success: function(data) {
                    $('span.bannerid' + id).remove();
                },
                error: function(data) {
                    alert(data + 'Error!');
                }
            });
        });

        $('.delete_thumbnail').on('click', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure to delete?')) return false;
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var str = $(this).attr('href');
            var id = str.slice(1);
            var url = "{{ route('delete-destination-thumb', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'delete',
                url: url,
                data: {
                    _token: csrf
                },
                success: function(data) {
                    $('span.thumbnailid' + id).remove();
                },
                error: function(data) {
                    alert(data + 'Error!');
                }
            });
        });
    </script>
@endsection
