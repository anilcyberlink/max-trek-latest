@extends('admin.master')
@section('title','Page Type')
@section('breadcrumb')
<a href="{{ url('admin/pagetype/create') }}" class="btn btn-primary btn-sm">Create</a>
@endsection
@section('content')
<div class="tray tray-center" style="">
<div class="panel">         
	<div class="panel-body ph20">
		<div class="tab-content">
			<div id="users" class="tab-pane active">
				<div class="table-responsive mhn20 mvn15">
				    
				<table class="table admin-form theme-warning fs13">
						<thead>
							<tr class="bg-light">
								<th class="">SN</th>
								<th class="">Particulars</th>   
								<th class="">Is Menu </th>   
								<th class="">Ordering </th> 
								<th class="text-left">Action</th>
							</tr>
						</thead>
						<tbody>
							@if(count($data) > 0)	            
							@foreach($data as $row)
							<tr class="id{{$row->id}}">
								<td class="">{{$loop->iteration}}</td>
								<td class="">{{ ucfirst($row->page_type) }}</td>
								<td class="">
								    @if($row->is_menu == 1)
								    <span class="text-success">Yes</span>
								    @elseif($row->is_menu == 0)
								    <span class="text-danger">No</span>
								    @endif
								</td>
								<td> {{ $row->ordering }} </td>								
								<td class="text-left">  
									<a href="{{ url('admin/pagetype/'.$row->id.'/edit') }}">Edit</a> 

									@if(!is_empty_pagetype($row->id))
									    @if(!($row->id == 2))
									        <a href="#{{$row->id}}" class="btn-delete">Delete</a>
									    @endif
									@endif
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

@section('scripts')
<script type="text/javascript">
jQuery(document).ready(function() {
  $('.btn-delete').on('click',function(e){
    e.preventDefault();
    if(!confirm('Are you sure to delete?')) return false;
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    $.ajax({
      type:'DELETE',
      url:"{{url('admin/pagetype') . '/'}}" + id,
      data:{_token:csrf},    
      success:function(data){ 
        $('tbody tr.id' + id ).remove();
      },
      error:function(data){       
       alert('Error occurred!');
     }
   });
  });
});
  </script>
@endsection