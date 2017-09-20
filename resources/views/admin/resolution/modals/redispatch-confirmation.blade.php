<div class="modal fade" id="redispatchShipment" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle">Redispatch Shipment</h4>
            </div>
            <form id="redispatch-form" action="/admin/resolutions/{{ $resolution->id }}/redispatch" method="POST">
                <div class="modal-body">
                    {{csrf_field()}}
                    <p>Are you sure to re-dispatch this shipment?</p>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-success" id="formSubmit"><i class="fa fa-floppy-o"></i> Redispatch Shipment</button>
                </div>
            </form>
        </div>
    </div>
</div>