<div class="col-md-12">
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"> Trip Useful Information </span>
            <a class="btn btn-primary pull-right add-useful" data-added="0"><i class="glyphicon  glyphicon-plus"></i> Add Row </a>
        </div>
        <div class="panel-body" id="row_useful_body">
            <div class="row" id="useful-headingg">
                <div class="col-md-1"> <label>Ordering </label></div>
                <div class="col-md-3"> <label>Title</label></div>
                <div class="col-md-3"> <label>Description</label></div>
                <div class="col-md-1"> </div>
            </div>
            <div class="row" id="useful-rec-1">


            </div>
        </div>

        <div style="display:none;">
            <div id="row_useful_additional">

                <div class="row">
                    <div>
                        <div class="col-md-2"> <label>Ordering </label></div>
                        <div class="col-md-10"> <label>Title</label></div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-2"> <input type="number" min="1" max="2000" name="useful_ordering[]" class="form-control" /></div>
                        <div class="col-md-10"><input type="text" name="useful_title[]" class="form-control" placeholder="" /></div>
                    </div>
                    <div class="col-md-3"> <label>Description</label></div>
                    <div class="col-md-10"><textarea name="useful_description[]" class="form-control" placeholder=""></textarea></div>
                    <div class="col-md-1"><button class="btn btn-danger delete-useful" useful-data-id="0"><i class="glyphicon glyphicon-trash"></i></button></div>
                    <div class="col-md-12" style="margin-top: 20px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>