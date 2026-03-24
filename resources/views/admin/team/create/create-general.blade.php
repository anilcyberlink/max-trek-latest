
  <div class="col-md-9">
    <!-- Input Fields -->
    <div class="panel">
      <div class="panel-heading">
        <span class="panel-title">New Member</span>
      </div>
      <div class="panel-body">                    
        <div class="form-group"> 
         <label for="inputStandard" class="col-lg-2 control-label">Name</label>         
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{old('name')}}"/>
              <input type="hidden" id="uri" name="uri" value="" />
            </div>
          </div>
        </div>

        <div class="form-group"> 
         <label for="inputStandard" class="col-lg-2 control-label">Position</label>        
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" name="position" class="form-control" placeholder="Position" value="{{old('position')}}" />
            </div>
          </div>
        </div>  

        <div class="form-group"> 
         <label for="inputStandard" class="col-lg-2 control-label">Phone</label>        
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" name="phone" class="form-control" placeholder="phone" value="{{old('phone')}}" />
            </div>
          </div>
        </div>  
                           
        <div class="form-group"> 
         <label for="inputStandard" class="col-lg-2 control-label">Email</label>         
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="email" name="email" class="form-control" placeholder="Email Address" value="{{old('email')}}" />
           
            </div>
          </div>
        </div>

         <div class="form-group"> 
       <label for="inputStandard" class="col-lg-2 control-label">HighLights</label>               
        <div class="col-lg-9">
          <div class="bs-component">
            <textarea class="form-control textarea"   name="highlights" rows="3">{{old('highlights')}}</textarea>
          </div>
        </div>
      </div>

        <div class="form-group"> 
       <label for="inputStandard" class="col-lg-2 control-label">Brief</label>               
        <div class="col-lg-9">
          <div class="bs-component">
            <textarea class="form-control textarea"   name="brief" rows="6">{{old('brief')}}</textarea>
          </div>
        </div>
      </div>
   
     
      <div class="form-group">
         <label for="inputStandard" class="col-lg-2 control-label">Content</label>       
        <div class="col-lg-9">
          <div class="bs-component">
            <textarea class="form-control textarea"   name="content" rows="12">{{old('content')}}</textarea>
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
   Ordering: <input type="number"   name="ordering" class="form-control" placeholder="Ordering" value="{{$ordering}}" />   
  </label>
</div>
  <div class="sid_bvijay mb10">
  <div class="hd_show_con">
   Show in Home
    <input type="checkbox" name="show_in_home" value="0" />
  </div>
</div>

<div class="sid_bvijay mb10">
  <h4> Profile Picture </h4>
  <div class="hd_show_con">
    <div id="xedit-demo">
     <input type="file" name="thumbnail" />
   </div>
 </div>
</div>

<!-- <div class="sid_bvijay mb10">
  <h4> Banner </h4>
   <h4> <input type="checkbox" name="published" value="1" />  Blur </h4> 
  <div class="hd_show_con">
    <div id="xedit-demo">
    <input type="file" name="banner" /> 
   </div>
 </div>
</div>  -->
<div class="sid_bvijay mb10">
  <label for="inputStandard" class="col-lg-2 control-label">Facebook</label>
  <label class="field text">
    <input type="text" id="" name="facebook_url" class="form-control" placeholder="Facebook Link" value="" />   
   </label>
 </div>
 <div class="sid_bvijay mb10">
  <label for="inputStandard" class="col-lg-2 control-label">Instagram</label>
  <label class="field text">
    <input type="text" id="" name="instagram_url" class="form-control" placeholder="Instagram Link" value="" />   
   </label>
 </div>
 <div class="sid_bvijay mb10">
  <label for="inputStandard" class="col-lg-2 control-label">Twitter</label>
  <label class="field text">
    <input type="text" id="" name="twitter_url" class="form-control" placeholder="Twitter Link" value="" />   
   </label>
 </div>
 <div class="sid_bvijay mb10">
  <label for="inputStandard" class="col-lg-2 control-label">Wikipedia</label>
  <label class="field text">
    <input type="text" id="" name="wikipedia_url" class="form-control" placeholder="Wikipedia Link" value="" />   
   </label>
 </div>
 <div class="sid_bvijay mb10">
  <label for="inputStandard" class="col-lg-2 control-label">YouTube</label>
 <label class="field text">
 <input type="text" id="" name="youtube_url" class="form-control" placeholder="YouTube Link" value="" />
 </label>
 </div>


</div>       
</div>