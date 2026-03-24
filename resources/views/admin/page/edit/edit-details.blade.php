<div class="col-md-12">
<div class="panel">
  <div class="panel-heading">
     <span class="panel-title">Page Details</span>
  <a class="btn btn-primary pull-right add-details" data-added="0"><i class="glyphicon glyphicon-plus"></i> Add Row </a>
  </div>
  <div class="panel-body" id="row_details_body">     
        <div class="row">             
            <div class="col-md-1">  <label>Ordering</label> </div>
            <div class="col-md-3">  <label>Title</label> </div>
            <div class="col-md-7">  <label>Content</label> </div>          
            <div class="col-md-1">  <label>Action</label> </div>
        </div>       

    @if($details->count() > 0) 
      @foreach($details as $row)   
    
        <div class="row" id="details-rec-{{$loop->iteration}}">   
         <input type="hidden" name="detail_id[]" value="{{$row->id}}" />           
          <div class="col-md-1"><input type="number" name="ordering[]" class="form-control" placeholder="SN" value="{{$row->ordering}}"/></div>
          <div class="col-md-3"><input type="text" name="title[]" class="form-control" placeholder="Name " value="{{$row->title}}"/></div>
           <div class="col-md-7">
            <textarea class="my-editor form-control" name="content[]">{{$row->content}}</textarea>
          </div>                      
          <div class="col-md-1"><button class="btn btn-danger delete-details"  details-rowid="{{$row->id}}" details-data-id="{{$loop->iteration}}"><i class="glyphicon glyphicon-trash"></i></button></div>  
        </div>       
 @endforeach
  @endif
  </div>
  <div style="display:none;">
      <div id="row_details_additional">
        <div class="row"> 
           <input type="hidden" name="detail_id[]" value="" />              
           <div class="col-md-1"><input type="number" name="ordering[]" class="form-control" placeholder="SN" /></div>
          <div class="col-md-3"><input type="text" name="title[]" class="form-control" placeholder="Name " /></div>
           <div class="col-md-7"><textarea class="form-control" name="content[]"></textarea></div>                      
          <div class="col-md-1"><button class="btn btn-danger delete-details" details-data-id="0"><i class="glyphicon glyphicon-trash"></i></button></div>   
        </div>
    </div>
  </div>
  
</div>


</div>   

