@extends('admin.master')
@section('title', Request::segment(2))

@section('breadcrumb')
    <button type="button" class="btn btn-default btn-sm backlink"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back </button>
    <a href="{{ route('travel_guide_index') }}" class="btn btn-default btn-sm backlink"><i class="fa fa-list" aria-hidden="true"></i> Show List </a>
@endsection

@section('content')
    <form class="form-horizontal" role="form" id="travelguide" method="post" enctype="multipart/form-data">
        @csrf
<section class="content">
<div class="container-fluid">
    <div class="alert" id="message" style="display: none"></div>
    <footer>
        <div id="publishing-action">
            <button type="submit" name="submit" class=" btn btn-success"> Publish</button>
        </div>
        <div class="clearfix"></div>
    </footer>

    <div class="row">
        <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
                <div class="card-header d-flex p-0">
                    <!-- <h3 class="card-title p-3">Manage Trips</h3> -->
                    <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item active"><a class="nav-link active" href="#tab_1" data-toggle="tab"> GENERAL</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">IMAGES</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <!--General tab starts -->
                            <div class="col-md-8">
                                <!-- Input Fields -->
                                <div class="panel">
                                    <div class="panel-heading">
                                        <span class="panel-title">Edit Travel Guide</span>
                                         /
                                        <span class="panel-title">{{$find->trips? $find->trips->trip_title:''}}</span>
                                    </div>
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label for="inputStandard" class="col-lg-2 control-label">Category</label>
                                            <div class="col-lg-9">
                                                <div class="bs-component">
                                                <select class="form-control" name="category">
                                                    <option @if($find->category=='guide') selected @endif value="guide">Travel Guide</option>
                                                    <option @if($find->category=='insurance') selected @endif value="insurance">Trip Insurance</option>
                                                    <option @if($find->category=='payment') selected @endif  value="payment">Application process</option>
                                                </select>
                                                <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="inputStandard" class="col-lg-2 control-label">Title</label>
                                            <div class="col-lg-9">
                                                <div class="bs-component">
                                                    <input type="text" id="category" name="title" value="{{$find->title}}" class="form-control" placeholder="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputStandard" class="col-lg-2 control-label">Caption</label>
                                            <div class="col-lg-9">
                                                <div class="bs-component">
                                                    <input class="form-control" name="link" value="{{$find->link}}" type="text" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputStandard" class="col-lg-2 control-label">Brief</label>
                                            <div class="col-lg-9">
                                                <div class="bs-component">
                                                    <div class="bs-component">
                                                        <textarea class="form-control my-editor" id="textArea3" name="brief" rows="15" autocomplete="off">
                                                            {{$find->brief}}
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputStandard" class="col-lg-2 control-label">Description</label>
                                            <div class="col-lg-9">
                                                <div class="bs-component">
                                                    <div class="bs-component">
                                                        <textarea class="form-control my-editor" id="textArea3" name="description" rows="15" autocomplete="off">
                                                            {{$find->description}}
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="admin-form">
                                    <div class="sid_bvijay mb10">
                                        <div class="hd_show_con">
                                            <div class="publice_edi">
                                                Status: <a href="avoid:javascript;" data-toggle="collapse" data-target="#publish_1">Active</a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="sid_bvijay mb10">
                                        <h4> Thumbnail </h4>
                                        <div class="hd_show_con">
                                            <div id="xedit" class="bs-component">
                                                <!--<input type="file" name="thumbnail" />-->
                                                 <label class="field prepend-icon append-button file mb20">
                                                        <span class="button btn btn-primary">Change</span>
                                                        <input type="file" class="gui-file" name="thumbnail" id="file1" onChange="document.getElementById('Thumbnail').value = this.value;">
                                                        <input type="text" class="gui-input" id="Thumbnail" placeholder="Please select a photo">
                                                        <label class="field-icon">
                                                          <i class="fa fa-upload"></i>
                                                        </label>
                                                      </label>
                                            </div>
                                            @if ($data->thumbnail)
                                                <div class="delete-fe-image thumb_id{{ $data->id }}">
                                                    <img src="{{ asset(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail) }}"
                                                        width="50%" />
                                                    <a href="#{{ $data->id }}" class="thumbdelete">X</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- <div class="sid_bvijay mb10">
                                        <h4> Trip Banner </h4>
                                        <div class="hd_show_con">
                                            <div class="bs-component">
                                                <!--<input type="file" name="banner" />-->
                                                 <label class="field prepend-icon append-button file mb20">
                                                        <span class="button btn btn-primary">Change</span>
                                                        <input type="file" class="gui-file" name="banner" id="file3" onChange="document.getElementById('banner').value = this.value;">
                                                        <input type="text" class="gui-input" id="banner" placeholder="Please select a photo">
                                                        <label class="field-icon">
                                                          <i class="fa fa-upload"></i>
                                                        </label>
                                                      </label>
                                            </div>
                                            @if ($data->banner)
                                                <div class="delete-fe-image banner_id{{ $data->id }}">
                                                    <img src="{{ asset(env('PUBLIC_PATH') . 'uploads/banners/' . $data->banner) }}"
                                                        width="50%" />
                                                    <a href="#{{ $data->id }}" class="bannerdelete">X</a>
                                                </div>
                                            @endif
                                             <small> (Width: 1600px Height: 1200px) </small>
                                        </div>
                                    </div> --}}
                                    
                                    <div class="sid_bvijay mb10">
                                         <h4> Trips Name</h4>
                                         <div class="hd_show_con">
                                    
                                    <div class=" has-feedback has-search">
                                        <input class="category-search form-control" type="text" placeholder="Search.."> 
                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                      </div>
                                            <div class="tab-content mb15">
                                           <div id="tab1" class="tab-pane active">
                                            @if($trip->count() > 0)
                                               <ul class="ctgor category-list" id="myTable">
                                                  @foreach($trip as $value)
                                                <li>
                                                  <label class="">
                                                    <input type="radio" name="trip_name" value="{{ $value->id }}" {{($value->id == $find->trip_id ) ?'checked':''}}>
                                                    {{ $value->trip_title }}  
                                                  </label>
                                                </li>    
                                                @endforeach
                                              </ul> 
                                              @endif
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>

                                    </div>
                                <!--//-->
                                </div>
                                <!-- /.tab-pane general -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <span class="panel-title"> Travel Guide </span>
                                                <a class="btn btn-primary pull-right add-gear" data-added="0"><i class="glyphicon glyphicon-plus"></i>Add Row </a>
                                            </div>

                                            <div class="panel-body" id="row_gear_body">
                                                <div class="row" id="gear-rec-1">
                                                    <div class="col-md-5"><input type="text" name="gear_ordering[]" class="form-control" placeholder="SN" /></div>

                                                    <div class="col-md-6"><input type="file" name="gear_thumbnail[]" class="form-control" /></div>
                                                    <div class="col-md-1"><button class="btn btn-danger delete-gear" gear-data-id="1"><i class="glyphicon glyphicon-trash"></i></button></div>
                                                </div>
                                            </div>

                                            <div style="display:none;">
                                                <div id="row_gear_additional">
                                                    <div class="row">
                                                        <div class="col-md-5"><input type="text" name="gear_ordering[]" class="form-control" placeholder="SN" /></div>
                                                        <div class="col-md-6"><input type="file" name="gear_thumbnail[]" class="form-control" /></div>
                                                        <div class="col-md-1"><button class="btn btn-danger delete-gear" schedule-data-id="0"><i class="glyphicon glyphicon-trash"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $i =0; ?>
                                    @if($find->images->count() > 0)
                                        @foreach($find->images as $row)
                                            <div class="col-lg-2 id{{$row->id}}">
                                                <a href="#{{$row->id}}" class="delete_image">X</a>
                                                <img src="{{ asset('/uploads/travel-guide/' . $row->image) }}" width="100" height="100" />
                                            </div>
                                            <?php $i++;

                                            if($i%5 == 0){
                                                echo '<div class="clearfix"></div>';
                                            }
                                            ?>
                                        @endforeach
                                    @endif
                                </div>

                            <!-- /.tab-pane -->

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- ./card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
</form>


@endsection

@section('scripts')
    <script type="text/javascript">

        /******** For Gear *******/
        jQuery(document).delegate('a.add-gear', 'click', function(e) {
            e.preventDefault();
            var content = jQuery('#row_gear_additional .row'),
                size = jQuery('#row_gear_body >.row').length + 1,
                element = null,
                element = content.clone();
            element.attr('id', 'gear-rec-'+size);
            element.find('.delete-gear').attr('gear-data-id', size);
            element.appendTo('#row_gear_body');
            element.find('.sn').html(size);
        });

        jQuery(document).delegate('button.delete-gear', 'click', function(e) {
            e.preventDefault();
            var makeConfirm = confirm("Are you sure You want to delete");
            if (makeConfirm == true) {
                var id = jQuery(this).attr('gear-data-id');
                var targetDiv = jQuery(this).attr('targetDiv');
                jQuery('#gear-rec-' + id).remove();
                return true;
            } else {
                return false;
            }
        });
        /******** End For Gear *******/

        // Delete Product Image
        $('.delete_image').on('click',function(e){
            e.preventDefault();
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var str = $(this).attr('href');
            var id = str.slice(1);
            $.ajax({
                type:'delete',
                url:"{{ route('travel_guide_delete') . '/' }}" + id,
                data:{_token:csrf},
                success:function(data){
                    $('#message').css('display','block');
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);
                    $('div .id'+id ).remove();
                    jQuery.each(data.errors, function (key, value) {
                   toastr.error(value);
                    });
                },
                error:function(data){
                    alert('Error occurred!');
                }
            });
        });

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#travelguide").on('submit',function(e){
                e.preventDefault();
                let url = "{{route('travel_guide_update')}}";
                let tripData = document.getElementById('travelguide');
                let data = new FormData(tripData);
                data.append('id',{{$find->id}});


                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    cache: false,
                    processData: false,
                    contentType : false,
                    beforeSend:function() {},
                    success: function (data) {
                        console.log(data);
                        location.reload();
                        document.getElementById("travelguide").reset();
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        })
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        })
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // console.log(jqXHR, textStatus, errorThrown);
                        console.log('Error');
                        console.log(textStatus);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        })
                        Toast.fire({
                            icon: 'warning',
                            title: textStatus
                        })
                    }
                });
            });


        });

         /**/
    $('.thumbdelete').on('click',function(e){
    e.preventDefault();
    if(!confirm('Are you sure to delete?')) return false;
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    $.ajax({
      type:'delete',
      url:"{{url('delete_gear_guide_thumb') . '/'}}" + id,
      data:{_token:csrf},
      success:function(data){
        $('.thumb_id' + id ).remove();
        jQuery.each(data.errors, function (key, value) {
                   toastr.error(value);
                    });
      },
      error:function(data){
        alert(data + 'Error!');
      }
    });
  });
  /******/
   $('.bannerdelete').on('click',function(e){
    e.preventDefault();
    if(!confirm('Are you sure to delete?')) return false;
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    $.ajax({
      type:'delete',
      url:"{{url('delete_gear_guide_banner_thumb') . '/'}}" + id,
      data:{_token:csrf},
      success:function(data){
        $('span.banner_id' + id ).remove();
        location.reload();
      },
      error:function(data){
        alert(data + 'Error!');
      }
    });
  });





        $(document).ready(function(){
$(".category-search").on("keyup", function() {
var value = $(this).val().toLowerCase();
$(".category-list li").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});

    </script>
        @stop
