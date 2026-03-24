<div class="row">
    <div class="col-md-8">
        <!-- Input Fields -->
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">New Trip</span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="bs-component">
                            <input type="text" id="trip_title" name="trip_title" class="form-control"
                                placeholder="Trip Title" value="{{ old('trip_title') }}" required/>
                            <input type="hidden" id="uri" name="uri" value="" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="bs-component">
                            <input type="text" id="sub_title" name="sub_title" class="form-control"
                                placeholder="Trip Sub Title" value="{{ old('sub_title') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Trip Details</span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Trip Difficulty</label>
                            @if ($trek->count() > 0)
                                <select class="form-control" name="trip_grade" required>
                                    <option value="" selected disabled> Select Grade </option>
                                    @foreach ($trek as $row)
                                        <option value="{{ $row->id }}">{{ $row->trip_grade }} </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>  
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Best Season</label>
                            <!-- <input type="text" name="best_season" class="form-control" value="{{ old('best_season') }}" /> -->
                            <select name="best_season" id="best_season" class="form-control">
                                <option value="" selected disabled>Select season</option>
                                <option value="Spring">Spring</option>
                                <option value="Summmer">Summer</option>
                                <option value="Monsoon">Monsoon</option>
                                <option value="Autumn">Autumn</option>
                                <option value="Winter">Winter</option>
                            </select>
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Max Elevation</label>
                            <input type="number" name="max_altitude" class="form-control"
                                value="{{ old('max_altitude') }}" placeholder="In terms of meter"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Group Size</label>
                            <input type="text" name="group_size" class="form-control"
                                value="{{ old('group_size') }}" />
                        </div>
                        <span>Note : : Pattern 1 or  1-4. Don't use any words</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Accommodation</label>
                            <input type="text" name="accommodation" class="form-control"
                                value="{{ old('accommodation') }}" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Meals</label>
                            <input type="text" name="meal" class="form-control"
                                value="{{ old('meal') }}" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-6">
                        <div class="bs-component">
                        <label>Total Price</label>
                            <input type="number" min="1" name="starting_price" class="form-control" value="{{ old('starting_price') }}" placeholder="$"/>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control"
                                value="{{ old('start-date') }}" />
                        </div>
                    </div> -->
                    <div class="col-lg-6">
                        <div class="bs-component">
                        <label>Transportation</label>
                            <input type="text" name="route" class="form-control" value="{{ old('route') }}" placeholder=""/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Activity</label>
                            <input type="text" name="walking_per_day" class="form-control" value="{{ old('walking_per_day') }}" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Duration</label>
                            <input type="number" min="1" name="duration" class="form-control" value="{{ old('duration') }}" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Start Location</label>
                            <input type="text" name="start_location" class="form-control" value="{{ old('start_location') }}" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>End Location</label>
                            <input type="text" name="end_location" class="form-control" value="{{ old('end_location') }}" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Guided Group</label>
                            <input type="text" name="guided_group" class="form-control"
                                value="{{ old('guided_group') }}" />
                        </div>
                    </div> -->
                </div>
                <!-- <div class="form-group">
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>% Off</label>
                            <input type="number" min="1" name="discount" class="form-control"
                                value="{{ old('discount') }}" />
                        </div>
                    </div>
                </div> -->
                 {{-- <div class="form-group">
                     <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Video ID</label>
                           <input type="text" class="form-control" name="trip_video" value="{{ old('trip_video') }}" placeholder="Video ID" />
                        </div>
                    </div>  
                     <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Video Status</label>
                            <select class="form-control" name="video_status">                               
                                <option value="1">Enabled</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div>
                    </div>                                 
                </div>            --}}
            </div>
        </div>

        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Route Description</span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="bs-component">
                            <textarea class="form-control my-editor" name="trip_highlight"
                                rows="6">{{ old('trip_highlight') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"> Trip Content</span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="bs-component">
                            <textarea class="form-control my-editor" name="trip_content" rows="9">{{ old('trip_content') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Best time for expedition</span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="bs-component">
                            <textarea class="my-editor form-control" name="trip_excerpt" rows="3">{{ old('trip_excerpt') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"> Meta data </span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="bs-component">
                            <input type="text" name="meta_key" class="form-control" placeholder="Meta Key"
                                value="{{ old('meta_key') }}" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="bs-component">
                            <textarea class="form-control" id="textArea3" name="meta_description" rows="3" 
                                placeholder="Meta Description">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="inputStandard" class="col-lg-7 control-label">Show In Home Banner ?</label>
            <div class="col-lg-5">
                <div class="bs-component">
                    <select name="is_menu" class="form-control input-sm">
                        <option value="0"> No </option>
                        <option value="1"> Yes </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="admin-form">
            <!-- // -->
            <div class="sid_bvijay mb10">
                <h4> Country /Destination </h4>
                <div class="hd_show_con">
                    <input type="text" name="peak_name" class="form-control" value="{{ old('peak_name') }}" required/>
                </div>
            </div>
            <div class="sid_bvijay mb10">
                <h4> Trip Type </h4>
                <div class="hd_show_con">
                    <select class="form-control onchange-select" name="trip_type" required>
    				 <option value="" selected disabled> Select Trip Type </option>
                     @foreach($trip_type as $row)
                     <option value="{{$row->id}}">{{$row->trip_type}}</option>
                     @endforeach
                    </select>
                </div>
            </div>
            <div id="selection-error" class="text-danger mb-2" style="display:none;">
                Please select at least one Region or Expedition.
            </div>

            <div class="sid_bvijay mb10 onchange 1">
                <h4> Regions </h4>
                <div class="hd_show_con">
                <div class=" has-feedback has-search">
                  <input class="category-search form-control" type="text" placeholder="Search.."> 
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                    <div class="tab-content mb15">
                        <div id="tab1" class="tab-pane active">
                            @if ($regions->count() > 0)
                                <ul class="ctgor category-list" style="height:200px">
                                    @foreach ($regions as $row)
                                        <li>
                                            <label class="option">
                                                <input type="radio" name="region[]" value="{{ $row->id }}" @if (is_array(old('region')) && in_array($row->id, old('region'))) checked @endif />
                                                <span class="checkbox"></span> {{ $row->title }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
        <div class="sid_bvijay mb10 onchange 2">
            <h4> Expeditions </h4>
            <div class="hd_show_con">
                <div class="tab-content mb15">
                    <div id="tab1" class="tab-pane active">
                        @if ($destinations->count() > 0)
                            <ul class="ctgor">
                                @foreach ($destinations as $row)
                                    <li>
                                        <label class="option">
                                            <input type="radio" name="destination[]" value="{{ $row->id }}" @if (is_array(old('destination')) && in_array($row->id, old('destination'))) checked @endif />
                                            <span class="checkbox"></span> {{ $row->title }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
             {{-- <div class="sid_bvijay mb10"> 
            <h4> Activity </h4>
            <div class="hd_show_con">
                 <div class=" has-feedback has-search">
                      <input class="category-search1 form-control" type="text" placeholder="Search.."> 
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                <div class="tab-content mb15">
                    <div id="tab1" class="tab-pane active">
                        @if ( $activities->count() > 0)
                            <ul class="ctgor category-list1" style="height:200px">
                                @foreach ($activities as $row)
                                    <li>
                                        <label class="option">
                                            <input type="checkbox" name="activity[]" value="{{ $row->id }}">
                                            <span class="checkbox"></span> {{ $row->title }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>  --}}

 
            
            <div class="sid_bvijay mb10">
                <h4> Trip Groups </h4>
                <div class="hd_show_con">
                    <div class="tab-content mb15">
                        <div id="tab1" class="tab-pane active">
                            @if ($trip_groups->count() > 0)
                                <ul class="ctgor">
                                    @foreach ($trip_groups as $row)
                                        <li>
                                            <label class="option">
                                                <input type="checkbox" name="tripgroup[]" value="{{ $row->id }}" @if (is_array(old('tripgroup')) && in_array($row->id, old('tripgroup'))) checked @endif />
                                                <span class="checkbox"></span> {{ $row->title }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="sid_bvijay mb10">
                <label class="field text">
                    <input type="number" name="ordering" class="form-control" placeholder="Ordering"
                        value="{{ $ordering }}" />
                </label>
            </div>

            <div class="sid_bvijay mb10">
                <h4> Thumbnail </h4>
                <div class="hd_show_con">
                     <div id="xedit" class="bs-component">
                     <label class="field prepend-icon append-button file mb20">
                        <span class="button btn btn-primary">Choose File</span>
                        <input type="file" class="gui-file" name="thumbnail" id="file1" onChange="document.getElementById('Thumbnail').value = this.value;">
                        <input type="text" class="gui-input" id="Thumbnail" placeholder="Please select a photo">
                        <label class="field-icon">
                          <i class="fa fa-upload"></i>
                        </label>
                      </label>
                    </div>
                     <small> (Width: 1500px Height: 1500px) </small>
                </div>
            </div>

            <div class="sid_bvijay mb10">
              <h4> Trip map </h4>
                <div class="hd_show_con">
                    <div id="xedit" class="bs-component">
                     <label class="field prepend-icon append-button file mb20">
                        <span class="button btn btn-primary">Choose File</span>
                        <input type="file" class="gui-file" name="trip_map" id="file2" onChange="document.getElementById('trip_map').value = this.value;">
                        <input type="text" class="gui-input" id="trip_map" placeholder="Please select a photo">
                        <label class="field-icon">
                          <i class="fa fa-upload"></i>
                        </label>
                      </label>
                    </div>
                     <small> (Width: 1500px Height: 1500px) </small>
                </div>
            </div>

            <div class="sid_bvijay mb10">
                <h4> Trip Banner </h4>
                <div class="hd_show_con">
                   <div id="xedit" class="bs-component">
                     <label class="field prepend-icon append-button file mb20">
                        <span class="button btn btn-primary">Choose File</span>
                        <input type="file" class="gui-file" name="banner" id="file2" onChange="document.getElementById('banner').value = this.value;">
                        <input type="text" class="gui-input" id="banner" placeholder="Please select a photo">
                        <label class="field-icon">
                          <i class="fa fa-upload"></i>
                        </label>
                      </label>
                    </div>
                   <small> (Width: 1600px Height: 550px) </small>
                </div>
            </div>

            {{-- <div class="sid_bvijay mb10">
                <h4> Upload PDF </h4>
                <div class="hd_show_con">
                    <div id="xedit" class="bs-component">
                     <label class="field prepend-icon append-button file mb20">
                        <span class="button btn btn-primary">Choose File</span>
                        <input type="file" class="gui-file" name="upload_pdf" id="file2" onChange="document.getElementById('upload_pdf').value = this.value;">
                        <input type="text" class="gui-input" id="upload_pdf" placeholder="Please select a File">
                        <label class="field-icon">
                          <i class="fa fa-upload"></i>
                        </label>
                      </label>
                    </div>
                   <small> (Less Than 2MB) </small>
                </div>
            </div> --}}

        </div>
    </div>
</div>
<script>
    const regionInputs = document.querySelectorAll('input[name="region[]"]');
    const destinationInputs = document.querySelectorAll('input[name="destination[]"]');

    regionInputs.forEach(input => {
        input.addEventListener('change', function () {
            if (this.checked) {
                // uncheck all destinations
                destinationInputs.forEach(d => d.checked = false);

                // also ensure only ONE region is checked
                regionInputs.forEach(r => {
                    if (r !== this) r.checked = false;
                });
            }
        });
    });

    destinationInputs.forEach(input => {
        input.addEventListener('change', function () {
            if (this.checked) {
                // uncheck all regions
                regionInputs.forEach(r => r.checked = false);

                // also ensure only ONE destination is checked
                destinationInputs.forEach(d => {
                    if (d !== this) d.checked = false;
                });
            }
        });
    });
</script>

