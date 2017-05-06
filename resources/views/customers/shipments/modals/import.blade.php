<div class="modal fade" id="importShipmentsModal" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Import Shipments</h4>
            </div>
            <form encType="multipart/form-data" action="/customers/shipments/import" method="POST">
                <div class="modal-body">
                    <h4>Templates</h4>
                    You can download an excel template from here -> <a target="_blank" href="/templates/customers/shipments-template.xlsx">Shipment Template XLSX</a>
                    <br>

                    <div class="row">
                        {{ csrf_field() }}

                        <div class="col-md-12 form-group">
                            <label for="from" class="control-label">Select Sender Address</label>
                            <select name="from" id="from" class="form-control">
                                @foreach ($addresses as $address)
                                    @if ($address->type === 'booking')
                                        <option value="{{ $address->id }}">{{ $address->identifier }} : {{ $address->address_line_1 }} {{ $address->barangay }}, {{ $address->city }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <label for="file" class="control-label">Import your file here</label>
                            <input type="file" name="file" id="file"
                                   placeholder="Excel File" class="form-control" />
                            @if ($errors->has('file'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>