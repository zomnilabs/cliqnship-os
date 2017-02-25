<div class="container-fluid">
    <div class="row">
        <section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="active">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Select address">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-globe"></i>
                            </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Add Image">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-picture"></i>
                            </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Add more details">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Service Add-on">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-tag"></i>
                            </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Shipping Preview">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                            </a>
                        </li>
                    </ul>
                </div>

                <form role="form">
                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="step1">
                            <h3>Step 1</h3>
                            <p>Which address would you like to set for this shipment?</p>

                            <div class="form-group">
                                <select name="user_addressbook_id" id="user_addressbook_id" class="form-control">
                                    <option>Select a booking/pickup address</option>
                                    <option value="1">Address 1</option>
                                </select>
                            </div>

                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-primary next-step">Next</button></li>
                            </ul>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="step2">
                            <h3>Step 2</h3>
                            <p>Select an image for this shipment (<span class="text-primary text-capitalize">not required</span>)</p>

                            <div class="form-group">
                                <input type="file" id="bookingImage" class="form-control">
                            </div>

                            <div class="preview">
                                <img src="http://placehold.it/550x150?text=Image+Preview" alt="">
                            </div>

                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                <li><button type="button" class="btn btn-primary next-step">Next</button></li>
                            </ul>
                        </div>

                        <div class="tab-pane" role="tabpanel" id="step3">
                            <h3>Step 3</h3>
                            <p>Give us more information for this shipment</p>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="number_of_items">Number of Items</label>
                                        <input type="text" name="number_of_items" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type_of_items">Type of Items</label>
                                        <input type="text" name="type_of_items" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="length">Length</label>
                                        <input type="text" name="length" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="width">Width</label>
                                        <input type="text" name="width" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="height">Height</label>
                                        <input type="text" name="height" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weight">Weight</label>
                                        <input type="text" name="weight" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>Services</h4>
                                        <label><input type="radio" name="services" value=""> Metro Manila</label>&nbsp;&nbsp;
                                        <label><input type="radio" name="services" value=""> Provincial</label>&nbsp;&nbsp;
                                        <label><input type="radio" name="services" value=""> International</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>Package Type</h4>
                                        <label><input type="radio" name="package_type" value=""> Small</label>&nbsp;&nbsp;
                                        <label><input type="radio" name="package_type" value=""> Medium</label>&nbsp;&nbsp;
                                        <label><input type="radio" name="package_type" value=""> Large</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h4>Paid by</h4>
                                        <label><input type="radio" name="paid_by" value=""> Sender / Shipper</label> &nbsp;&nbsp;
                                        <label><input type="radio" name="paid_by" value=""> Consignee / Receiver</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="remarks">Remarks</label>
                                        <textarea name="remarks" id="remarks" class="form-control" rows="5"
                                                  style="resize: none"></textarea>
                                    </div>
                                </div>
                            </div>

                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                <li><button type="button" class="btn btn-primary next-step">Next</button></li>
                            </ul>
                        </div>

                        <div class="tab-pane" role="tabpanel" id="step4">
                            <h3>Step 4</h3>
                            <p>Select extra shipment service</p>

                            <div class="row">
                                <div class="col-md-6">
                                    <label><input type="checkbox" name="add_ons" id="cod" value="cod"> Collect & Deposit (COD) Metro Manila Only</label>
                                </div>
                                <div class="col-md-6">
                                    <label><input type="checkbox" name="add_ons" id="insurance" value="insurance"> Insurance Declared Value</label>
                                </div>

                                <div class="cod hide">
                                    <div class="col-md-12">
                                        <hr>
                                        <h4>Collect & Deposit (COD) Metro Manila Only</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="account_name">Account Name</label>
                                            <input type="text" name="account_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="account_number">Account Number</label>
                                            <input type="text" name="account_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="bank">Bank</label>
                                            <input type="text" name="bank" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="amount">Amount to be collected</label>
                                            <input type="text" name="amount" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="insurance hide">
                                    <div class="col-md-12">
                                        <hr>
                                        <h4>Insurance Declared Value</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="amount">Amount to be collected</label>
                                            <input type="text" name="amount" class="form-control">
                                        </div>
                                    </div>
                                </div>



                            </div>

                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                <li><button type="button" class="btn btn-primary btn-info-full next-step">Next</button></li>
                            </ul>
                        </div>

                        <div class="tab-pane" role="tabpanel" id="step5">
                            <h3>Step 5</h3>

                            <div class="preview">
                                <img src="http://placehold.it/550x150?text=Image+Preview" alt="">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="pickup_address">FROM</label>
                                    <p>29 Sampaguita Street. San Vicente, Tarlac City Philippines</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="pickup_address">TO</label>
                                    <p>29 Sampaguita Street. San Vicente, Tarlac City Philippines</p>
                                </div>
                                <div class="col-md-12">
                                    <h4>Package Details</h4>
                                </div>
                                <div class="col-md-4">
                                    <label for="quantity">Service:</label>
                                    <p>Metro Manila</p>
                                </div>
                                <div class="col-md-4">
                                    <label for="quantity">Number of Items:</label>
                                    <p>5 Items</p>
                                </div>
                                <div class="col-md-4">
                                    <label for="item_type">Type of Items:</label>
                                    <p>T-Shirts</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="pickup_date">Length:</label>
                                    <p>40</p>
                                </div>
                                <div class="col-md-3">
                                    <label for="quantity">Width:</label>
                                    <p>30</p>
                                </div>
                                <div class="col-md-3">
                                    <label for="item_type">Height:</label>
                                    <p>60</p>
                                </div>
                                <div class="col-md-3">
                                    <label for="item_type">Weight:</label>
                                    <p>20 Kg</p>
                                </div>

                                <div class="col-md-12">
                                    <label for="remarks">Remarks:</label>
                                    <p>Please use a motorcycle as the place is hard to go for a car.</p>
                                </div>

                                <div class="col-md-12">
                                    <label for="remarks">Service Add-on:</label>
                                    <ul>
                                        <li>Collect & Deposit (COD)</li>
                                    </ul>
                                </div>
                            </div>

                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and Continue</button></li>
                            </ul>
                        </div>


                        <div class="tab-pane" role="tabpanel" id="complete">
                            <div class="text-center">
                                <i class="fa fa-check-circle text-success" style="font-size: 10em; padding: 15px"></i>
                                <h2>You have successfully completed all steps.</h2>
                                <h4>Here is the tracking number for this shipment: <strong><i>58AD64AEDA255</i></strong></h4>
                            </div>

                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-primary btn-info-full" data-dismiss="modal">Done</button></li>
                            </ul>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>