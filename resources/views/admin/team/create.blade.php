@extends('admin.master')
@section('title', Request::segment(2))

@section('breadcrumb')
<button type="button" class="btn btn-default btn-sm backlink"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back </button>
<a href="{{ url('admin/teams') }}" class="btn btn-default btn-sm backlink"><i class="fa fa-list" aria-hidden="true"></i> Show List </a>
@endsection

@section('content')
<form class="form-horizontal" role="form" id="teamData" method="post" enctype="multipart/form-data">
@csrf
<section class="content">
      <div class="container-fluid">

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
                <!-- <h3 class="card-title p-3">Manage Trips</h3> -->
                <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item active"><a class="nav-link active" href="#tab_1" data-toggle="tab"> GENERAL</a></li> </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                     <div class="tab-pane active" id="tab_1">
                  <!--General tab starts -->                   
                  @include('admin.team.create.create-general')
                   <!--//-->
                  </div>
                  <!-- /.tab-pane general -->
                 
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

 $(function () {
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    $("#teamData").on('submit',function(e){     
    e.preventDefault();    
    let url = "{{route('teams.store')}}";
    let teamData = document.getElementById('teamData');
    let data = new FormData(teamData);    
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
                            document.getElementById("teamData"). reset();
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
      var trip_title;
      trip_title = $('#name').val();
      trip_title=trip_title.replace(/[^a-zA-Z0-9 ]+/g,"");
      trip_title=trip_title.replace(/\s+/g, "-");
      $('#uri').val(trip_title);
    });
});

// Go back link
$('.backlink').click(function(){
  var url = '<?=url()->previous(); ?>';
  window.location=url;
});

</script>
@endsection