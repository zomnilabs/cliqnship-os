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
                            <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Pouch Request">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-tag"></i>
                            </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Booking Preview">
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
                            <p>Which address would you like to set for this booking / pickup?</p>

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
                            <p>Select an image for this booking / pickup (<span class="text-primary text-capitalize">not required</span>)</p>

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
                            <p>Give us more information for this booking</p>

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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pickup_date">Pickup Date</label>
                                        <input type="date" name="pickup_date" class="form-control">
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
                            <p>Would you like to request a pouch?</p>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="pouch_size">Pouch Size</label>
                                        <select name="pouch_size" id="pouch_size" class="form-control">
                                            <option value="1">Small</option>
                                            <option value="2">Medium</option>
                                            <option value="3">Large</option>
                                            <option value="4">Extra Large</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="quantity" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success" type="button" style="margin-top: 26px;"><i class="fa fa-plus"></i> Add</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="remarks">Pouch Requested</label>
                                       <table class="table table-hover">
                                           <thead>
                                                <tr>
                                                    <th>Pouch Size</th>
                                                    <th>Quantity</th>
                                                </tr>
                                           </thead>
                                           <tbody>
                                                <tr>
                                                    <td>Medium</td>
                                                    <td>2</td>
                                                </tr>
                                                <tr>
                                                    <td>Large</td>
                                                    <td>10</td>
                                                </tr>
                                           </tbody>
                                       </table>
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
                                <div class="col-md-12">
                                    <label for="pickup_address">Pickup Address</label>
                                    <p>29 Sampaguita Street. San Vicente, Tarlac City Philippines</p>
                                </div>
                                <div class="col-md-4">
                                    <label for="pickup_date">Pickup Date:</label>
                                    <p>February 28, 2017</p>
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
                                    <label for="remarks">Pouch Request:</label>
                                    <ul>
                                        <li>2x Medium</li>
                                        <li>10x Large</li>
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