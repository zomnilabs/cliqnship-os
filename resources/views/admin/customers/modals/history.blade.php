<div class="modal fade" id="historyModal" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="width: 80%">
        <div class="modal-content mcontent">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle">Customer History</h4>
            </div>
                <div class="modal-body">
                    <div class="tabbable"> <!-- Only required for left/right tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Addressbook</a></li>
                            <li><a href="#tab2" data-toggle="tab">Bookings</a></li>
                            <li><a href="#tab3" data-toggle="tab">Shipments</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1"><br/>
                                <table class="table table-bordered">
                                    <tfoot class="filter-footer">
                                        <tr class="searchable">
                                            <td>Id #</td>
                                            <td>Name</td>
                                            <td>Address Type</td>
                                            <td>Address</td>
                                            <td>Contact #</td>
                                            <td>Email Address</td>
                                        </tr>
                                    </tfoot>

                                    <thead>
                                        <tr>
                                            <th>Id #</th>
                                            <th>Name</th>
                                            <th>Address Type</th>
                                            <th>Address</th>
                                            <th>Contact #</th>
                                            <th>Email Address</th>
                                        </tr>
                                    </thead>

                                    <tbody id="addressbook-table">
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab2"><br/>
                                <table class="table table-bordered" style="width: 100%">
                                    <tfoot class="filter-footer">
                                        <tr class="searchable">
                                            <td class="hide">Id #</td>
                                            <td>Booking #</td>
                                            <td>Status</td>
                                            <td>Type of Items</td>
                                            <td>No. of items</td>
                                            <td>Pickup Date</td>
                                            <td>Remarks</td>
                                        </tr>
                                    </tfoot>

                                    <thead>
                                        <tr>
                                            <th class="hide">Id #</th>
                                            <th>Booking #</th>
                                            <th>Status</th>
                                            <th>Type of Items</th>
                                            <th>No. of items</th>
                                            <th>Pickup Date</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>

                                    <tbody id="booking-table">

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab3"><br/>
                                <table class="table table-bordered" style="width: 100%">
                                    <tfoot class="filter-footer">
                                    <tr class="searchable">
                                        <td class="hide">Id #</td>
                                        <td>Booking #</td>
                                        <td>Pickup Date</td>
                                        <td>Pickup Address</td>
                                        <td># of Items</td>
                                        <td>Remarks</td>
                                        <td>Status</td>
                                    </tr>
                                    </tfoot>

                                    <thead>
                                        <tr>
                                            <th class="hide">Id #</th>
                                            <th>Booking #</th>
                                            <th>Pickup Date</th>
                                            <th>Pickup Address</th>
                                            <th># of Items</th>
                                            <th>Remarks</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody id="shipments-table">

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