@extends('admin.master')
@section('title', 'Setting')
@section('breadcrumb')
@endsection
@section('content')

    <form class="form-horizontal" role="form" action="{{ url('admin/settings', 1) }}" method="post"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT" />
        <div class="col-md-9">
            <!-- Input Fields -->
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Settings</span>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Site Name</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="" name="site_name" class="form-control" placeholder=""
                                    value="@if($data){{$data->site_name }} @endif" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Phone</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="inputStandard" name="phone" class="form-control" placeholder=""
                                    value="@if($data){{ $data->phone }} @endif" />
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">FAX</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="inputStandard" name="fax" class="form-control" placeholder=""
                                    value="@if($data){{ $data->fax }} @endif" />
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Email Primary</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="inputStandard" name="email_primary" class="form-control"
                                    placeholder="" value="@if($data) {{ $data->email_primary }} @endif" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Email Secondary</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="inputStandard" name="email_secondary" class="form-control"
                                    placeholder="" value="@if($data){{ $data->email_secondary }} @endif" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Facebook Link</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="inputStandard" name="facebook_link" class="form-control"
                                    placeholder="" value="@if($data) {{ $data->facebook_link }}@endif" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label"> Twitter Link </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="inputStandard" name="twitter_link" class="form-control"
                                    placeholder="" value="@if($data) {{ $data->twitter_link }}@endif" />
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Youtube Link</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="inputStandard" name="youtube_link" class="form-control"
                                    value="@if($data) {{ $data->youtube_link }}@endif" />
                            </div>
                        </div>
                    </div>
                    {{--<div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Linkedin Link</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="inputStandard" name="linkedin_link" class="form-control"
                                    value="@if($data) {{ $data->linkedin_link }}@endif" />
                            </div>
                        </div>
                    </div>--}}

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Instagram Link</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="inputStandard" name="instagram_link" class="form-control"
                                    value="@if($data) {{ $data->instagram_link }} @endif" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Tripadvisor Link</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="inputStandard" name="tripadvisor_link" class="form-control"
                                    value="@if($data) {{ $data->tripadvisor_link }} @endif" />
                            </div>
                        </div>
                    </div>
                    <?php /*
                    {{-- <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Skype</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="inputStandard" name="skype" class="form-control"
                                    value="{{ $data->skype }}" />
                            </div>
                        </div>
                    </div> --}}
                    */?>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Meta Key</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <textarea class="form-control" id="contentEditor5" name="meta_key" rows="3">@if($data) {{ $data->meta_key }} @endif</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Meta Description</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <textarea class="form-control" id="contentEditor5" name="meta_description" rows="3">@if($data) {{ $data->meta_description }} @endif</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="textArea2">Location</label>
                        <div class="col-lg-9">
                            <div class="bs-component">
                                <input type="text" class="form-control" id="contentEditor4" name="address"
                                    value="@if($data) {{ $data->address }} @endif" />
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="textArea2"> Google Map Link </label>
                        <div class="col-lg-9">
                            <div class="bs-component">
                                <textarea class="form-control" id="contentEditor1" name="google_map" rows="3">@if($data) {{ $data->google_map }} @endif</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label class="col-lg-2 control-label" for="textArea2"> Google Map iframe</label>
                        <div class="col-lg-9">
                            <div class="bs-component">
                                <textarea class="form-control" id="contentEditor1" name="google_map2" rows="3">@if($data) {{ $data->google_map2 }} @endif</textarea>
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="textArea2">Copyright Text</label>
                        <div class="col-lg-9">
                            <div class="bs-component">
                                <textarea class="form-control" id="contentEditor3" name="copyright_text" rows="3">@if($data) {{ $data->copyright_text }} @endif</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for=""></label>
                        <div class="col-lg-6">
                            <div class="bs-component">
                                <input type="submit" class="form-control btn btn-primary" name="submit"
                                    value="Submit" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="admin-form">

                <div class="sid_ mb10">
                    <h4> Logo </h4>
                    <div class="hd_show_con">
                        <div id="xedit-demo">

                            @if ($data && $data->logo)
                                <span class="logo{{ $data->id }}">
                                    <a href="{{ $data->id }}" id="remove_logo"><span>X</span></a>
                                    <a href="{{ asset('uploads/original/' . $data->logo) }}" target="_blank"><img
                                            src="{{ asset('uploads/original/' . $data->logo) }}" name="logo"
                                            width="150" /></a>
                                    <hr>
                                </span>
                            @endif
                            <input type="file" name="logo" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    <script type="text/javascript">
        (function($) {
            $('#remove_logo').on('click', function(e) {
                e.preventDefault();
                if (confirm('Are you sure to delete??')) {
                    var csrf = $('meta[name="csrf-token"]').attr('content');
                    var id = $(this).attr('href');
                    var url = '{{ route('settings.destroy', ['setting' => ':id']) }}';

                    url = url.replace(':id', id);
                    $.ajax({
                        type: 'delete',
                        url: url,
                        data: {
                            _token: csrf
                        },
                        success: function(data) {
                            $('.logo' + id).remove();
                        },
                        error: function(data) {
                            alert('Error occurred!');
                        }
                    });
                }
            });

        }(jQuery));

        (function($) {
            $('#remove_worked_with').on('click', function(e) {
                e.preventDefault();
                if (confirm('Are you sure to delete??')) {
                    var csrf = $('meta[name="csrf-token"]').attr('content');
                    var id = $(this).attr('href');
                    var url = '{{ route('banner-destroy', ['id' => ':id']) }}';
                    // alert(url);
                    url = url.replace(':id', id);
                    $.ajax({
                        type: 'get',
                        url: url,
                        data: {
                            _token: csrf
                        },
                        success: function(data) {
                            $('.worked_with' + id).remove();
                        },
                        error: function(data) {
                            alert('Error occurred!');
                        }
                    });
                }
            });

        }(jQuery));

        (function($) {
            $('#remove_affililiated_with').on('click', function(e) {
                e.preventDefault();
                if (confirm('Are you sure to delete??')) {
                    var csrf = $('meta[name="csrf-token"]').attr('content');
                    var id = $(this).attr('href');
                    var url = '{{ route('mob-banner-destroy', ['id' => ':id']) }}';
                    // alert(url);
                    url = url.replace(':id', id);
                    $.ajax({
                        type: 'get',
                        url: url,
                        data: {
                            _token: csrf
                        },
                        success: function(data) {
                            $('.affililiated_with' + id).remove();
                        },
                        error: function(data) {
                            alert('Error occurred!');
                        }
                    });
                }
            });

        }(jQuery));
    </script>:
@endsection
