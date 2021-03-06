<div class="modal fade" id="importBookingModal" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Import Bookings</h4>
            </div>
            <form encType="multipart/form-data" action="/customers/bookings/import" method="POST">
                <div class="modal-body">
                    <h4>Templates</h4>
                    If you want to import bookings using a new address, download this template -> <a target="_blank" href="/templates/customers/booking-with-new-pickup-address.xlsx">Booking With New Address XLSX Template</a>
                    <br>
                    If you want to import bookings using your primary address, download this template -> <a target="_blank" href="/templates/customers/booking-using-primary-address.xlsx">Booking Using Primary Address XLSX Template</a>
                    <br>
                    <br>

                    <div class="row">
                        {{ csrf_field() }}

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