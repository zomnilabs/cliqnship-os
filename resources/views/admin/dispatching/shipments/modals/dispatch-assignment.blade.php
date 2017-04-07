<div class="modal fade" id="addRiderAssignment" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content mcontent">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header text-center">
                <h4 class="modal-title" id="modalTitle">Shipment Assignment</h4>
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

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('rider_id') ? ' has-error' : '' }}">
                                <label for="rider_id">Rider</label>
                                <select name="rider_id" id="rider_id" class="form-control">
                                    @foreach ($riders as $rider)
                                        <option value="{{ $rider->id }}">{{ $rider->profile->full_name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('rider_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rider_id') }}</strong>
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
                    <button type="submit" class="btn btn-success" id="formSubmit"><i class="fa fa-floppy-o"></i> Create Assignment</button>
                </div>
            </form>
        </div>
    </div>
</div>