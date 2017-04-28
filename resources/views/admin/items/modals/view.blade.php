<div class="modal fade" id="viewItemModal" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content mcontent">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header text-center">
                <h4 class="modal-title" id="modalTitle">Create Items</h4>
            </div>
            <form id="viewForm">
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control dataField" name="name" id="name"/>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-success" id="formSubmit" onclick="storeData.call(this)"><i class="fa fa-floppy-o"></i> Update Items</button>
                </div>
            </form>
        </div>
    </div>
</div>