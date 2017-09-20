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
                <div class="content-data">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>User Type</th>
                            <th>Reason</th>
                            <th>Date</th>
                        </tr>
                        </thead>

                        <tbody id="resolutionLogs">
                            @foreach ($resolution->logs as $log)
                                <tr>
                                    <td>{{ $log->user->profile->full_name }}</td>
                                    <td>{{ $log->user->userGroup->name }}</td>
                                    <td>{{ $log->reason }}</td>
                                    <td>{{ $log->created_at }}</td>
                                </tr>
                            @endforeach
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