<div class="modal fade" id="returnShipmentLogs" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle">Resolution Log</h4>
            </div>
            <div class="modal-body">
                <div class="loading-data">
                    <h1><i class="fa fa-spin fa-spinner" style="font-size: 30px;"></i> Please wait...</h1>
                </div>

                <div class="content-data hide">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>User Type</th>
                            <th>Remarks</th>
                            <th>Date</th>
                        </tr>
                        </thead>

                        <tbody id="resolutionLogs">

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>