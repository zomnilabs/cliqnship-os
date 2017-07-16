<div class="modal fade" id="shipmentDetails" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="width: 1200px">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header">
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="pickup_address">FROM</label>
                                        <input type="text" name="from"
                                            id="from" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pickup_address">TO</label>
                                        <input type="text" name="to"
                                               id="to" class="form-control">
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <h4>Package Details</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="services">Services: </label> <br>
                                        <label><input type="radio" name="services" id="metro_manila" value="metro_manila"> Metro Manila</label>&nbsp;&nbsp;
                                        <label><input type="radio" name="services" id="provincial" value="provincial"> Provincial</label>&nbsp;&nbsp;
                                        <label><input type="radio" name="services" id="international" value="international"> International</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="package_type">Package Type: </label> <br>
                                        <label><input type="radio" name="package_type" id="own-packaging"  value="small"> Own Packaging</label>&nbsp;&nbsp;
                                        <label><input type="radio" name="package_type" id="medium"  value="medium"> Medium</label>&nbsp;&nbsp;
                                        <label><input type="radio" name="package_type" id="large"  value="large"> Large</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="charge_to">Paid by: </label> <br>
                                        <label><input type="radio" name="charge_to" id="sender" value="sender"> Sender / Shipper</label> &nbsp;&nbsp;
                                        <label><input type="radio" name="charge_to" id="consignee" value="consignee"> Consignee / Receiver</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="quantity">Number of Items:</label>
                                        <input type="text" name="number_of_items"
                                               id="number_of_items" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="item_type">Type of Items:</label>
                                        <input type="text" name="type_of_items"
                                               id="type_of_items" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="pickup_date">Length:</label>
                                        <input type="text" name="length"
                                               id="length" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="quantity">Width:</label>
                                        <input type="text" name="width"
                                               id="width" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="item_type">Height:</label>
                                        <input type="text" name="height"
                                               id="height" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="item_type">Weight:</label>
                                        <input type="text" name="weight"
                                               id="weight" class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="remarks">Remarks:</label>
                                        <textarea class="form-control" name="remarks" id="remarks" cols="10" rows="10" style="resize: none"></textarea>
                                    </div>
                                </div>
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