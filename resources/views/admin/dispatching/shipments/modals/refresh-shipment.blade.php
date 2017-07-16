<div class="modal fade" id="returnShipment" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle">Refresh Shipment</h4>
            </div>
            <form id="redispatch-form" action="" method="POST">
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status">Select Status: </label>
                                <select name="status" id="status" class="form-control">
                                    <option value="re-dispatch">Re-dispatch</option>
                                    <option value="return-to-sender">Return to sender</option>
                                </select>

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('resolution_remarks') ? ' has-error' : '' }}">
                                <label for="resolution_remarks">Resolution Team Remarks: </label>
                                <textarea name="resolution_remarks" id="remarks" cols="30" rows="10"
                                          class="form-control" style="resize: none;"></textarea>

                                @if ($errors->has('resolution_remarks'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('resolution_remarks') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 error-container">

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-success" id="formSubmit"><i class="fa fa-floppy-o"></i> Update Shipment</button>
                </div>
            </form>
        </div>
    </div>
</div>