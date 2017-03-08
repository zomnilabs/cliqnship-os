<div class="modal fade" id="viewAddressbookModal" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content mcontent">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header text-center">
                <h4 class="modal-title" id="modalTitle">Address Book</h4>
            </div>
            <form id="viewForm">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('identifier') ? ' has-error' : '' }}">
                                <label for="Identifier">Identifier</label>
                                <input type="text" class="form-control dataField" name="identifier" id="identifier"/>
                                @if ($errors->has('identifier'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('identifier') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type">Address Type</label>
                                <select name="type" class="form-control dataField" id="type">
                                    <option value="booking">Booking</option>
                                    <option value="shipment">Shipment</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control dataField" name="first_name" id="first_name"/>
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control dataField" name="last_name" id="last_name"/>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control dataField" name="middle_name" id="middle_name"/>
                                @if ($errors->has('middle_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('middle_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
                                <label for="contact_number">Contact Number</label>
                                <input type="text" class="form-control dataField" name="contact_number" id="contact_number"/>
                                @if ($errors->has('contact_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control dataField" name="email" id="email"/>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('address_line_1') ? ' has-error' : '' }}">
                                <label for="address_line_1">Address Line 1</label>
                                <input type="text" class="form-control dataField" name="address_line_1" id="address_line_1"/>
                                @if ($errors->has('address_line_1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_line_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('address_line_2') ? ' has-error' : '' }}">
                                <label for="address_line_2">Address Line 2</label>
                                <input type="text" class="form-control dataField" name="address_line_2" id="address_line_2"/>
                                @if ($errors->has('address_line_2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_line_2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('barangay') ? ' has-error' : '' }}">
                                <label for="barangay">Barangay</label>
                                <input type="text" class="form-control dataField" name="barangay" id="barangay"/>
                                @if ($errors->has('barangay'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('barangay') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city">City</label>
                                <input type="text" class="form-control dataField" name="city" id="city"/>
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('province') ? ' has-error' : '' }}">
                                <label for="province">Province</label>
                                <input type="text" class="form-control dataField" name="province" id="province"/>
                                @if ($errors->has('province'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('province') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                <label for="country">Country</label>
                                <input type="text" class="form-control dataField" name="country" id="country"/>
                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                                <label for="zip_code">Zipcode</label>
                                <input type="text" class="form-control dataField" name="zip_code" id="zip_code"/>
                                @if ($errors->has('zip_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zip_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('landmarks') ? ' has-error' : '' }}">
                                <label for="landmarks">Landmarks</label>
                                <input type="text" class="form-control dataField" name="landmarks" id="landmarks"/>
                                @if ($errors->has('landmarks'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('landmarks') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('address_type') ? ' has-error' : '' }}">
                                <label for="address_type">Address Type</label>
                                <select name="address_type" class="form-control dataField" id="address_type">
                                    <option value="residential">Resedential</option>
                                    <option value="office">Office</option>
                                </select>
                                @if ($errors->has('address_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="padding-top: 35px;">
                                <label for="primary">
                                    <input type="checkbox" value="1" id="primary" name="primary"/> Is this your primary address?
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-success" id="formSubmit" onclick="storeData.call(this)"><i class="fa fa-floppy-o"></i> Update Addressbook</button>
                </div>
            </form>
        </div>
    </div>
</div>