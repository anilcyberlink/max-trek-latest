<div class="col-md-12">

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"> Trip Schedule </span>
            <a class="btn btn-primary pull-right add-schedule" data-added="0"><i class="glyphicon glyphicon-plus"></i> Add Row </a>
        </div>

        <div class="panel-body" id="row_schedule_body">
            {{-- <div class="row">
                <div class="col-md-1"><label>Ordering</label></div>
                <div class="col-md-2"><label>Start Date</label></div>
                <div class="col-md-2"><label>End Date</label></div>
                <div class="col-md-2"><label>Price</label></div>
                <div class="col-md-2"><label>Deposit</label></div>
                <div class="col-md-2"> <label>Availability</label></div>
                <div class="col-md-1"><label>Spots</label></div> 
                <div class="col-md-2"><label>Remarks</label></div> 
                <div class="col-md-1"></div>
            </div> --}}
            @if ($schedules->count() > 0)
                @foreach ($schedules as $row)
                    <div class="row" id="schedule-rec-{{ $loop->iteration }}">
                        <input type="hidden" name="schedule_id[]" value="{{ $row->id }}" />
                        <div class="col-md-12">
                            <div class="col-md-1"><label>Ordering</label></div>
                            <div class="col-md-2"><label>Start Date</label></div>
                            <div class="col-md-2"><label>End Date</label></div>
                            <!--<div class="col-md-2"><label>With Meal Price</label></div>-->
                            <div class="col-md-2"><label>Days</label></div>
                            <div class="col-md-3"> <label>Availability</label></div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="col-md-1">
                            <input type="number" min="1" max="2000" name="schedule_ordering[]"
                                value="{{ $row->ordering }}" class="form-control" placeholder="" />
                        </div>
                        <div class="col-md-2">
                            <input type="date" min="01-01-2025" max="31-12-2035" name="schedule_start_date[]"
                                value="{{ $row->start_date }}" class="form-control" placeholder="DD-MM-YY" />
                        </div>
                        <div class="col-md-2">
                            <input type="date" min="01-01-2025" max="31-12-2036" name="schedule_end_date[]"
                                value="{{ $row->end_date }}" class="form-control" placeholder="DD-MM-YY" />
                        </div>
                        <!--<div class="col-md-3">-->
                        <!--    <input type="number" min="0" name="schedule_price[]" -->
                        <!--        value="{{ $row->price }}" placeholder="price with meal" class="form-control" />-->
                        <!--</div>-->
                        <div class="col-md-2">
                           <input type="number" name="schedule_group_size[]" value="{{ $row->group_size }}" placeholder="" class="form-control"/>
                        </div>
                        <div class="col-md-3">
                            <select name="schedule_availability[]" class="form-control">
                                <option value="available" {{ $row->availability == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="unavailable" {{ $row->availability == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                            </select>
                        </div>
                        <div class="col-md-10">
                            <label for="remark">Information</label>
                            <textarea type="text" name="schedule_remarks[]" value="{{ $row->remarks }}"
                                class="my-editor form-control" placeholder="More Information" >{{ $row->remarks }}</textarea>
                        </div>

                        <div class="col-md-1"><button class="btn btn-danger delete-schedule" schedule-rowid="{{ $row->id }}" schedule-data-id="{{ $loop->iteration }}">
                            <i class="glyphicon glyphicon-trash"></i>
                        </button></div>
                        <div class="col-md-12" style="margin-top: 20px;"></div>
                    </div>
                @endforeach
            @endif
        </div>

        <div style="display:none;">
            <div id="row_schedule_additional">
                <div class="row">
                    <input type="hidden" name="schedule_id[]" value="" />
                    {{-- <div class="col-md-1"><input type="number" min="1" max="2000" name="schedule_ordering[]"
                            class="form-control" /></div>
                    <div class="col-md-2"><input type="date" min="01-01-2021" max="31-12-2030"
                            name="schedule_start_date[]" class="form-control" placeholder="DD-MM-YYYY" /></div>
                    <div class="col-md-2"><input type="date" min="01-01-2021" max="31-12-2030"
                            name="schedule_end_date[]" class="form-control" placeholder="DD-MM-YYYY" /></div>
                     <!--<div class="col-md-2"><input type="text" name="schedule_group_size[]"-->
                     <!--       class="form-control" /></div>-->
                    <div class="col-md-2">
                        <select name="schedule_availability[]" class="form-control">
                            @if ($availability)
                                @foreach ($availability as $row)
                                    <option value="{{ $row }}"> {{ $row }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-1"><input type="text" name="schedule_price[]" class="form-control"
                             /></div>
                    <div class="col-md-2"><input type="text" name="schedule_remarks[]" class="form-control"
                            /></div> --}}
                    <div class="col-md-12">
                        <div class="col-md-1"><label>Ordering</label></div>
                        <div class="col-md-2"><label>Start Date</label></div>
                        <div class="col-md-2"><label>End Date</label></div>
                        <!--<div class="col-md-2"><label>With Meal Price</label></div>-->
                        <div class="col-md-2"><label>Days</label></div>
                        <div class="col-md-3"> <label>Availability</label></div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="col-md-1">
                        <input type="number" min="1" max="2000" name="schedule_ordering[]"
                        class="form-control" placeholder="" />
                    </div>
                    <div class="col-md-2">
                        <input type="date" min="01-01-2025" max="12-12-2035" name="schedule_start_date[]"
                        class="form-control" placeholder="DD-MM-YY" />
                    </div>
                    <div class="col-md-2">
                        <input type="date" min="01-01-2025" max="12-12-2036" name="schedule_end_date[]"
                        class="form-control" placeholder="DD-MM-YY" />
                    </div>
                    <!--<div class="col-md-2">-->
                    <!--    <input type="number" min="0" name="schedule_price[]" -->
                    <!--    class="form-control" placeholder="price with meal" />-->
                    <!--</div>-->
                    <div class="col-md-2">
                       <input type="number" name="schedule_group_size[]"
                       class="form-control" placeholder="" />
                    </div>
                    <div class="col-md-3">
                        <select name="schedule_availability[]" class="form-control">
                            <option value="available"> Available </option>
                            <option value="unavailable"> Unavailable </option>
                        </select>
                    </div>
                    <div class="col-md-10">
                        <label for="remark">Information</label>
                        <textarea type="text" name="schedule_remarks[]"
                        class="form-control" placeholder="More Information" ></textarea>
                    </div>

                    <div class="col-md-1"><button class="btn btn-danger delete-schedule" schedule-data-id="0">
                        <i class="glyphicon glyphicon-trash"></i></button></div>
                    <div class="col-md-12" style="margin-top: 20px;"></div>
                </div>
            </div>
        </div>

    </div>
</div>
