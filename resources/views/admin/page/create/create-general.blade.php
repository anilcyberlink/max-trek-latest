
  <div class="col-md-9">
    <!-- Input Fields -->
    <div class="panel">
      <div class="panel-heading">
        <span class="panel-title">New Page</span>
      </div>
      <div class="panel-body">                    
        <div class="form-group"> 
         <label for="inputStandard" class="col-lg-3 control-label">Page Title</label>         
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="name" name="page_title" class="form-control" placeholder="Page Title" value="{{old('page_title')}}" />
              <input type="hidden" id="uri" name="uri" value="" />
            </div>
          </div>
        </div>

        <!-- <div class="form-group"> 
         <label for="inputStandard" class="col-lg-3 control-label">Sub Title</label>        
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" name="sub_title" class="form-control" placeholder="Sub Title" value="{{old('sub_title')}}" />
            </div>
          </div>
        </div>  -->

        
      <!-- <span class="panel-title">Brief</span>
      <div class="form-group">         
        <div class="col-lg-12">
          <div class="bs-component">
            <textarea class="form-control my-editor"   name="page_excerpt" rows="3"></textarea>
          </div>
        </div>
      </div> -->
   
      <!-- <span class="panel-title"> Content</span>  
      <div class="form-group">
        <div class="col-lg-12">
          <div class="bs-component">
            <textarea class="form-control my-editor" name="page_content" rows="6"></textarea>
          </div>
        </div>
      </div> -->
    
    <div class="form-group"> 
         <label for="inputStandard" class="col-lg-3 control-label">Meta Keywords</label>        
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" name="meta_keyword" class="form-control" placeholder="Meta Keywords" value="{{old('meta_keyword')}}" />
            </div>
          </div>
        </div>  
                           
        <div class="form-group"> 
         <label for="inputStandard" class="col-lg-3 control-label">Meta Desription</label>         
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="email" name="meta_description" class="form-control" placeholder="Meta Desription" value="{{old('meta_description')}}" />
           
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
        Status: <a href="avoid:javascript;" data-toggle="collapse" data-target="#publish_1">Active</a>              
    </div>
</div>

<div class="sid_bvijay mb10">
  <label class="field text">
    <h4> Ordering: </h4>
    <input type="number"   name="page_order" class="form-control" placeholder="Ordering" value="{{$ordering}}" />   
  </label>
</div>

<!-- <div class="sid_bvijay mb10">
 <label class="field text">
  <h4> External Link </h4>
   <input type="text" id="" name="external_link" class="form-control" placeholder="External Link" value="" />   
  </label>
</div>  -->


<!-- <div class="sid_bvijay mb10">
  <h4> Thumbnail </h4>
  <div class="hd_show_con">
    <div id="xedit-demo">
     <input type="file" name="page_thumbnail" />
   </div>
 </div>
</div> -->

<!-- <div class="sid_bvijay mb10">
  <h4> Add Image </h4>
  <div class="hd_show_con">
    <div id="xedit-demo">
    <input type="file" name="page_banner" /> 
   </div>
 </div>
</div> -->

</div>       
</div>