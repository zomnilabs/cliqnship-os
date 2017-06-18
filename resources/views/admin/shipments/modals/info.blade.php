<div class="modal fade" id="shipmentDetails" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header text-center">
                <h4 class="modal-title" id="modalTitle">Shipment Details</h4>
            </div>
                <div class="modal-body">
                    <div id="shipmentLoader">
                        <i class="fa fa-spinner fa-spin"></i> Getting shipment data
                    </div>

                    <div id="shipmentContent" class="hide">
                        <ul class="nav nav-tabs" id="myTabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Shipment Details</a></li>
                            <li><a href="#tab2" data-toggle="tab">Return History</a></li>
                            <li><a href="#tab3" data-toggle="tab">Audit Trail</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1"><br/>
                                shipment details
                            </div>

                            <div class="tab-pane" id="tab2"><br/>
                                <table id="shipmentReturnLogs" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Rider</th>
                                        <th>Reason</th>
                                        <th>Return Date</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="tab3"><br/>
                                <table id="shipmentEvents" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Source</th>
                                        <th>Event</th>
                                        <th>Value</th>
                                        <th>Remarks</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                </div>
        </div>
    </div>
</div>