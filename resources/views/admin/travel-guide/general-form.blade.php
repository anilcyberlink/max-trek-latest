<div class="col-md-8">
    <!-- Input Fields -->
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">Create Travel Guide</span>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <label for="inputStandard" class="col-lg-2 control-label">Category</label>
                <div class="col-lg-9">
                    <div class="bs-component">
                    <select class="form-control" name="category">
                        <option selected disabled>--Please select type--</option>
                            <option value="guide">Travel Guide</option>
                            <option value="insurance">Trip Insurance</option>
                            <option value="payment">Application process</option>
                    </select>
                    <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputStandard" class="col-lg-2 control-label">Title</label>
                <div class="col-lg-9">
                    <div class="bs-component">
                        <input type="text" id="category" name="title" class="form-control" placeholder="" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputStandard" class="col-lg-2 control-label">Caption</label>
                <div class="col-lg-9">
                    <div class="bs-component">
                        <input class="form-control" name="link" type="text" placeholder="">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputStandard" class="col-lg-2 control-label">Brief</label>
                <div class="col-lg-9">
                    <div class="bs-component">
                        <div class="bs-component">
                            <textarea class="form-control my-editor" id="textArea3" name="brief" rows="15" autocomplete="off"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputStandard" class="col-lg-2 control-label">Description</label>
                <div class="col-lg-9">
                    <div class="bs-component">
                        <div class="bs-component">
                            <textarea class="form-control my-editor" id="textArea3" name="description" rows="15" autocomplete="off"></textarea>
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
                <div id="xedit-demo">
                    <!--<input type="file" name="thumbnail" />-->
                     
                          <label class="field prepend-icon append-button file">
                            <span class="button btn btn-primary">Choose File</span>
                            <input type="file" class="gui-file" name="thumbnail" id="file1" onChange="document.getElementById('Thumbnail').value = this.value;">
                            <input type="text" class="gui-input" id="Thumbnail" placeholder="Please select a photo">
                            <label class="field-icon">
                              <i class="fa fa-upload"></i>
                            </label>
                          </label>               
                </div>
            </div>
        </div>
        
        <div class="sid_bvijay mb10">
            <h4>Trips Name</h4>
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
                     <input type="radio" name="trip_name" value="{{$value->id}}" >
                     {{$value->trip_title}} 
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
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#travelguide").on('submit',function(e){
            e.preventDefault();
            let url = "{{route('travel_guide_post')}}";
            let tripData = document.getElementById('travelguide');
            let data = new FormData(tripData);
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                cache: false,
                processData: false,
                contentType : false,
                beforeSend:function() {},
                success: function (data) {
                    if (data.status == 'success') {
                            document.getElementById("tripData"). reset();
                            toastr.success(data.message);
                            setTimeout(function(){
                        location.reload(); 
                    }, 1000); 
                  // alert("here");
               }
                  
               jQuery.each(data.errors, function (key, value) {
                   toastr.error(value);
               });
                },
                error: function (qXHR, textStatus, errorThrown) {
            // alert(xhr.status);
            alert(errorThrown);
              
           }
                });
            });


    });

</script>
@stop
