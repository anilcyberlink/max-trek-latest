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
                                value="{{ $data->trip_title }}" placeholder="Trip Title" />
                            <input type="hidden" id="uri" name="uri" value="{{ $data->uri }}" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="bs-component">
                            <input type="text" id="sub_title" name="sub_title" class="form-control"
                                value="{{ $data->sub_title }}" placeholder="Trip Sub Title" />
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"> Trip Details </span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-6">
                        <div class="bs-component ">
                            <label>Trip Difficulty</label>
                            @if ($trek->count() > 0)
                                <select class="form-control" name="trip_grade" required>
                                    <option value="0" selected disabled> Select Grade </option>
                                    @foreach ($trek as $row)
                                        <option value="{{ $row->id }}"
                                            {{ $row->id == $data->trip_grade ? 'selected' : '' }}>{{ $row->trip_grade }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Best Season</label>
                            <!-- <input type="text" name="best_season" class="form-control"
                                value="{{ $data->best_season }}" /> -->
                            <select name="best_season" id="best_season" class="form-control">
                                <option value="" selected disabled>Select season</option>
                               <option value="Spring" {{($data->best_season == 'Spring')?'selected':''}}>Spring</option>
                               <option value="Summmer" {{($data->best_season == 'Summer')?'selected':''}}>Summer</option>
                               <option value="Monsoon" {{($data->best_season == 'Monsoon')?'selected':''}}>Monsoon</option>
                               <option value="Autumn" {{($data->best_season == 'Autum')?'selected':''}}>Autumn</option>
                               <option value="Winter" {{($data->best_season == 'Winter')?'selected':''}}>Winter</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Max Elevation</label>
                            <input type="number" name="max_altitude" class="form-control"
                                value="{{ $data->max_altitude }}" />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Group Size</label>
                            <input type="text" name="group_size" class="form-control"
                                value="{{ $data->group_size }}" />
                                <span>Note : : Pattern 1 or  1-4. Don't use any words</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Accommodation</label>
                            <input type="text" name="accommodation" class="form-control"
                                value="{{ $data->accommodation }}" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Meals</label>
                            <input type="text" name="meal" class="form-control"
                                value="{{ $data->meal }}" />
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Total Price</label>
                            <input type="text" name="starting_price" class="form-control"
                                value="{{ $data->starting_price }}" placeholder="$" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bs-component">
                        <label>Transportation</label>
                            <input type="text" name="route" class="form-control" value="{{ $data->route }}" placeholder=""/>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control"
                                value="{{ $data->start_date }}" />
                        </div>
                    </div> -->
                </div>
                <div class="form-group">
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Activity</label>
                            <input type="text" name="walking_per_day" class="form-control"
                                value="{{ $data->walking_per_day }}" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Duration</label>
                            <input type="number" min="1" name="duration" class="form-control"
                                value="{{ $data->duration }}" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Start Location </label>
                            <input type="text" name="start_location" class="form-control"
                                value="{{ $data->start_location }}" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>End Location</label>
                            <input type="text" name="end_location" class="form-control"
                                value="{{ $data->end_location }}" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{--<div class="col-lg-6">
                        <div class="bs-component">
                            <label>Guided Group</label>
                            <input type="text" name="guided_group" class="form-control"
                                value="{{ $data->guided_group }}" />
                        </div>
                    </div>--}}
                </div>
                {{-- <div class="form-group">
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>% Off</label>
                            <input type="text" name="discount" class="form-control"
                                value="{{ $data->discount }}" />
                        </div>
                    </div>
                </div>--}}
                {{-- <div class="form-group"> 
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Video ID</label>
                           <input type="text" class="form-control" name="trip_video" value="{{ $data->trip_video }}"
                                placeholder="Trip Video" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <label>Video Status</label>
                             <select class="form-control" name="video_status">
                                <option @if ($data->video_status == 1)selected @endif value="1">Enabled</option>
                                <option @if ($data->video_status == 0)selected @endif value="0">Disabled</option>
                            </select>
                        </div>
                    </div>
                    
                </div> --}}
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
                            <textarea class="form-control my-editor" name="trip_highlight" rows="6"
                                placeholder="Trip Caption">{{ $data->trip_highlight }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Trip Content</span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="bs-component">
                            <textarea class="my-editor form-control" name="trip_content" id="trip_content" placeholder="Trip Content"
                                rows="9">{{ $data->trip_content }}</textarea>
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
                            <textarea class="my-editor form-control" name="trip_excerpt" rows="3" placeholder="Trip Brief">{{ $data->trip_excerpt }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Related Trips</span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="bs-component">

                            <select class="form-control realted-trips" name="related_trips[]" multiple="multiple">
                                @if ($all_trips->count() > 0)
                                    @foreach ($all_trips as $row)
                                        @foreach ($data->relatedtrips as $_row)
                                            @if ($row->id == $_row->pivot->related_trip_id)
                                                <option value="{{ $row->id }}" selected> {{ $row->trip_title }}
                                                </option>
                                                @continue
                                            @endif
                                        @endforeach
                                        <option value="{{ $row->id }}">{{ $row->trip_title }}</option>
                                    @endforeach
                                @endif
                            </select>
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
                            <input type="text" name="meta_key" class="form-control"
                                value="{{ $data->meta_key }}" placeholder="Meta Key" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="bs-component">
                            <textarea class="form-control" name="meta_description" rows="3" placeholder="Meta Description">{{ $data->meta_description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="inputStandard" class="col-lg-7 control-label">Show In Home Banner ? </label>
            <div class="col-lg-5">
                <div class="bs-component">
                    <select name="is_menu" class="form-control input-sm">
                        <option value="0" {{ $data->is_menu == '0' ? 'selected' : '' }}> No </option>
                        <option value="1" {{ $data->is_menu == '1' ? 'selected' : '' }}> Yes </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="admin-form">
            <div class="sid_bvijay mb10">
                <h4> Country/ Destination</h4>
                <div class="hd_show_con">
                    <div class="sid_bvijay mb10">
                        <input type="text" name="peak_name" class="form-control" value="{{ $data->peak_name }}" required>
                    </div>
                </div>
            </div>
            <div class="sid_bvijay mb10">
                <h4> Trip Type </h4>
                <div class="hd_show_con">
                    <select class="form-control onchange-select" name="trip_type">
                        <option value="" disabled> Select Trip Type </option>
                        @if ($trip_type->count(0 > 0))
                            @foreach ($trip_type as $row)
                                <option value="{{ $row->id }}" @if ($data->trip_type == $row->id) selected @php $trip_type_id = $row->id; @endphp @else @php $trip_type_id =''; @endphp @endif>
                                    {{ $row->trip_type }} </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div id="selection-error" class="text-danger mb-2" style="display:none;">
                Please select at least one Region or Expedition.
            </div>
            <div class="sid_bvijay mb10 {{($trip_type_id == 1) ? '': 'onchange'}} 1">
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
                                                <input type="radio" name="region[]" value="{{ $row->id }}"
                                                    {{ in_array($row->id, $checked_regions) ? 'checked' : '' }}>
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

            <div class="{{($trip_type_id == 2) ? '': 'onchange'}} 2">
                <div class="sid_bvijay mb10">
                    <h4> Expeditions </h4>
                    <div class="hd_show_con">
                        <div class="tab-content mb15">
                            <div id="tab1" class="tab-pane active">
                                @if ($destinations->count() > 0)
                                    <ul class="ctgor">
                                        @foreach ($destinations as $row)
                                            <li>
                                                <label class="option">
                                                    <input type="radio" name="destination[]"
                                                        value="{{ $row->id }}"
                                                        {{ in_array($row->id, $checked_destinations) ? 'checked' : '' }}>
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
                        @if ($activities->count() > 0)
                            <ul class="ctgor category-list1" style="height:200px">
                                @foreach ($activities as $row)
                                    <li>
                                        <label class="option">
                                            <input type="checkbox" name="activity[]" value="{{ $row->id }}"
                                                {{ in_array($row->id, $checked_activities) ? 'checked' : '' }}>
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
                                            <input type="checkbox" name="tripgroup[]"
                                                value="{{ $row->id }}"
                                                {{ in_array($row->id, $checked_tripgroups) ? 'checked' : '' }}>
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
                <h4> Trip Ordering </h4>
                <div class="hd_show_con">
                    <label class="field text">
                        <input type="number" name="ordering" class="form-control" placeholder="Ordering"
                            value="{{ $data->ordering }}" />
                    </label>
                </div>
            </div>

            <!-- trip Thumbnail -->
            <div class="sid_bvijay mb10">
                <h4> Thumbnail </h4>
                <div class="hd_show_con">
                    <div id="xedit" class="bs-component">
                        <label class="field prepend-icon append-button file mb20">
                            <span class="button btn btn-primary">{{ $data->thumbnail ? 'Change' : 'Choose File' }}</span>
                            <input type="file" class="gui-file" name="thumbnail" id="file1"
                                onChange="document.getElementById('Thumbnail').value = this.value;">
                            <input type="text" class="gui-input" id="Thumbnail"
                                placeholder="Please select a photo">
                            <label class="field-icon">
                                <i class="fa fa-upload"></i>
                            </label>
                        </label>
                    </div>
                    @if ($data->thumbnail)
                        <div class="delete-fe-image thumb_id{{ $data->id }}">
                            <img src="{{ asset(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail) }}"
                                width="200px" />
                            <a href="#{{ $data->id }}" class="thumbdelete">X</a>
                        </div>
                    @endif
                    <small> (Width: 1500px Height: 1500px) </small>
                </div>
            </div>

            <!-- trip map -->
            <div class="sid_bvijay mb10">
                <h4> Trip Map </h4>
                <div class="hd_show_con">
                    <div class="bs-component">
                        <label class="field prepend-icon append-button file mb20">
                            <span class="button btn btn-primary">{{ $data->trip_map ? 'Change' : 'Choose File' }}</span>
                            <input type="file" class="gui-file" name="trip_map" id="file2"
                                onChange="document.getElementById('trip_map').value = this.value;">
                            <input type="text" class="gui-input" id="trip_map"
                                placeholder="Please select a photo">
                            <label class="field-icon">
                                <i class="fa fa-upload"></i>
                            </label>
                        </label>
                    </div>
                    @if ($data->trip_map)
                        <div class="delete-fe-image map_id{{ $data->id }}">
                            <img src="{{ asset(env('PUBLIC_PATH') . 'uploads/original/' . $data->trip_map) }}"
                                width="200px" />
                            <a href="#{{ $data->id }}" class="mapdelete">X</a>
                        </div>
                    @endif
                    <small> (Width: 1500px Height: 1500px) </small>
                </div>
            </div>
            <!-- trip banner -->
            <div class="sid_bvijay mb10">
                <h4> Trip Banner </h4>
                <div class="hd_show_con">
                    <div class="bs-component">
                        <label class="field prepend-icon append-button file mb20">
                            <span class="button btn btn-primary">{{ $data->thumbnail ? 'banner' : 'Choose File' }}</span>
                            <input type="file" class="gui-file" name="banner" id="file3"
                                onChange="document.getElementById('banner').value = this.value;">
                            <input type="text" class="gui-input" id="banner"
                                placeholder="Please select a photo">
                            <label class="field-icon">
                                <i class="fa fa-upload"></i>
                            </label>
                        </label>
                    </div>
                    @if ($data->banner)
                        <div class="delete-fe-image banner_id{{ $data->id }}">
                            <img src="{{ asset(env('PUBLIC_PATH') . 'uploads/banners/' . $data->banner) }}"
                                width="200px" />
                            <a href="#{{ $data->id }}" class="bannerdelete">X</a>
                        </div>
                    @endif
                    <small> (Width: 1600px Height: 550px) </small>
                </div>
            </div>
            <!-- trip PDF -->
            {{-- <div class="sid_bvijay mb10">
                <h4> Upload PDF </h4>
                <div class="hd_show_con">
                    <div id="xedit" class="bs-component">
                        <label class="field prepend-icon append-button file mb20">
                            <span class="button btn btn-primary">{{ $data->trip_pdf ? 'Change' : 'Choose File' }}</span>
                            <input type="file" class="gui-file" name="upload_pdf" id="file1"
                                onChange="document.getElementById('upload_pdf').value = this.value;">
                            <input type="text" class="gui-input" id="upload_pdf"
                                placeholder="Please select a photo">
                            <label class="field-icon">
                                <i class="fa fa-upload"></i>
                            </label>
                        </label>
                    </div>
                    @if ($data->trip_pdf)
                        <div class="delete-fe-image pdf_id{{ $data->id }}">
                            <embed src="{{ asset(env('PUBLIC_PATH') . 'uploads/pdf/' . $data->trip_pdf) }}"
                                width="200px" />
                            <a href="#{{ $data->id }}" class="pdfdelete">X</a>
                        </div>
                    @endif
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
