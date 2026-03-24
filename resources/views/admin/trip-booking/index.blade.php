@extends('admin.master')
@section('title','Trip Booking')
@section('breadcrumb')
@endsection
@section('content')
    <div class="tray tray-center" style="height: 647px;">
        <div class="panel">
            <div class="panel-body ph20">
                <div class="tab-content">
                    <div id="users" class="tab-pane active">
                        <div class="table-responsive mhn20 mvn15">
                            <table class="table admin-form table-striped dataTable" id="datatable3">
                                <thead>
                                <tr class="bg-light">
                                    <th class="">SN</th>                                   
                                    <th class="">Trip</th>
                                    <th class="">Details</th>
                                    <th class="">Departure</th>
                                    <!--<th class="">Total People</th>-->
                                    <th class="">Comments</th>
                                    <th class="">Inquiry On</th>
                                  <th class="text-left">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($book) > 0)
                                @foreach($book as $key=>$row)
                                <tr class="bg-light">
                                    <td class="">{{$key+=1}}</td>                                   
                                    <td class="">{{$row->title}} <br>
                                        @if($row->schedule_id)
                                            Type: Fixed Depature
                                        @endif
                                    </td>
                                    <td class="">{{ ucfirst($row->full_name) }} <br> {{ ($row->email) }} <br> {{$row->phone}}<br>{{$row->country}} <br> Total People: {{ ($row->num_people) }}</td>                              
                                    <td class="">Start : {{$row->departure_date}} <br>
                                        @if($row->end_date)
                                            End : {{$row->end_date}} 
                                        @endif
                                        </td>
                                    <!--<td class="">{{ ($row->num_people) }}</td>-->
                                    <td class=""><textarea>{!!$row->comments!!}</textarea></td> 
                                    <td class="">{{$row->created_at->format('d M Y')}}</td>
                                   
                                    <td class="text-left">
                                    <span class="trash"><a href="{{route('delete-booking',$row->id)}}" onclick="return confirm('Confirm Delete?')" class="btn-btn-danger">Delete</a></span>
                                    </td>
                                </tr>

                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('libraries')
<!-- Datatables -->
<script src="{{asset('vendor/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>

<!-- Datatables Tabletools addon -->
<script src="{{asset('vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>

<!-- Datatables ColReorder addon -->
<script src="{{asset('vendor/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')}}"></script>

<!-- Datatables Bootstrap Modifications  -->
<script src="{{asset('vendor/plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>

<script type="text/javascript">

/************/
  $('#datatable3').dataTable({
    "aoColumnDefs": [{
      'bSortable': true,
      'aTargets': [-1]

    }],
    "oLanguage": {
      "oPaginate": {
        "sPrevious": "Previous",
        "sNext": "Next"
      }
    },
    "iDisplayLength": 20,
    "aLengthMenu": [
    [5, 10, 25, 50, -1],
    [5, 10, 25, 50, "All"]
    ],
    "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
    "oTableTools": {
      "sSwfPath": "{{asset('vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf')}}"
    }
  });
  </script>
@endsection

