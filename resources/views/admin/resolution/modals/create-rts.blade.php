<div class="modal fade" id="createRTS" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content mcontent">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle">Creating Return to Sender Shipment</h4>
            </div>
            <form id="viewForm" method="POST">
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('waybills') ? ' has-error' : '' }}">
                                <label for="waybills">Waybill Number/s</label>

                                <select class="form-control dataField waybill-input" name="waybills[]" id="waybills" multiple="multiple"></select>

                                @if ($errors->has('waybills'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('waybills') }}</strong>
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
                    <button type="submit" class="btn btn-success" id="formSubmit"><i class="fa fa-floppy-o"></i> Create RTS</button>
                </div>
            </form>
        </div>
    </div>
</div>