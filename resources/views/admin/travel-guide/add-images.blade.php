<div class="col-md-12">
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"> Travel Guide </span>
            <a class="btn btn-primary pull-right add-gear" data-added="0"><i class="glyphicon glyphicon-plus"></i> Add Row </a>
        </div>

        <div class="panel-body" id="row_gear_body">
            <div class="row" id="gear-rec-1">
                <div class="col-md-5"><input type="text" name="gear_ordering[]" class="form-control" placeholder="Caption here" /></div>

                <div class="col-md-6"><input type="file" name="gear_thumbnail[]" class="form-control" /></div>
                <div class="col-md-1"><button class="btn btn-danger delete-gear" gear-data-id="1"><i class="glyphicon glyphicon-trash"></i></button></div>
            </div>
        </div>

        <div style="display:none;">
            <div id="row_gear_additional">
                <div class="row">
                    <div class="col-md-5"><input type="text" name="gear_ordering[]" class="form-control" placeholder="SN" /></div>
                    <div class="col-md-6"><input type="file" name="gear_thumbnail[]" class="form-control" /></div>
                    <div class="col-md-1"><button class="btn btn-danger delete-gear" schedule-data-id="0"><i class="glyphicon glyphicon-trash"></i></button></div>
                </div>
            </div>
        </div>
    </div>
</div>