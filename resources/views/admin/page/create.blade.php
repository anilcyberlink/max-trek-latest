@extends('admin.master')
@section('title', Request::segment(2))

@section('breadcrumb')
<button type="button" class="btn btn-default btn-sm backlink"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back </button>
<a href="{{ route('admin.page.index', Request::segment(2)) }}" class="btn btn-default btn-sm backlink"><i class="fa fa-list" aria-hidden="true"></i> Show List </a>
@endsection

@section('content')
<form class="form-horizontal" role="form" id="pageData" method="post" enctype="multipart/form-data">
@csrf
<section class="content">
      <div class="container-fluid">
 <input type="hidden" name="page_type" value="{{ Request::segment(2) }}" />
      <footer>                        
        <div id="publishing-action">
          <button type="submit" name="submit" class="btn btn-success" value="publish"> Publish</button>         
        </div>
        <div class="clearfix"></div>
      </footer>     

      <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
               
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item active"><a class="nav-link active" href="#tab_1" data-toggle="tab"> GENERAL</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">DETAILS</a></li>           
                                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                     <div class="tab-pane active" id="tab_1">
                  <!--General tab starts -->                   
                  @include('admin.page.create.create-general')
                   <!--//-->
                  </div>
                  <!-- /.tab-pane general -->
                  <div class="tab-pane" id="tab_2">
                  @include('admin.page.create.create-details')
                  </div>                 
                 
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


  

/******** For detaila ***********/
jQuery(document).delegate('a.add-details', 'click', function(e) {
     e.preventDefault();    
     var content = jQuery('#row_detail_additional .row'),
     size = jQuery('#row_detail_body >.row').length + 1,
     element = null,    
     element = content.clone();
     element.attr('id', 'detail-rec-'+size);
     element.find('.delete-detail').attr('detail-data-id', size);
     element.appendTo('#row_detail_body');
     element.find('.sn').html(size);
   });

   jQuery(document).delegate('button.delete-detail', 'click', function(e) {
     e.preventDefault();    
     var makeConfirm = confirm("Are you sure You want to delete");
     if (makeConfirm == true) {
      var id = jQuery(this).attr('detail-data-id');
      var targetDiv = jQuery(this).attr('targetDiv');
      jQuery('#detail-rec-' + id).remove();
      //regnerate index number on table
      $('#row_detail_body .row').each(function(index) {
        $(this).find('span.sn').html(index+1);
      });
      return true;
    } else {
      return false;
    }
  });   
/******** End For detaila *********/

 $(function () {
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    $("#pageData").on('submit',function(e){
    tinymce.triggerSave();
    e.preventDefault();    
    let url = "{{route('admin.page.store', ':page')}}";
    url = url.replace(':page','{{Request::segment(2)}}');
    let pageData = document.getElementById('pageData');
    let data = new FormData(pageData);    
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
                            document.getElementById("pageData"). reset();
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


// ## //
$(document).ready(function(){
    $('#name').on('keyup',function(){
      var page_title;
      page_title = $('#name').val();
      page_title=page_title.replace(/[^a-zA-Z0-9 ]+/g,"");
      page_title=page_title.replace(/\s+/g, "-");
      $('#uri').val(page_title);
    });
});

// Go back link
$('.backlink').click(function(){
  var url = '<?=url()->previous(); ?>';
  window.location=url;
});

</script>
@endsection