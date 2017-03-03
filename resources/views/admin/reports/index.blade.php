@extends('layouts.admin')

@section('stylesheets')
    <style>
        .mcontent{
            padding:15px;
        }
        .pull-right button{
            margin-right:20px;
        }
    </style>
@endsection

@section('content')
    <div class="header-info container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Dashboard</a></li>
                        <li class="active">Reports</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Reports</h1>
                </div>

                <div class="page-actions pull-right">
                    <button data-toggle="modal" data-target=".bs-modal-lg" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Create New Reports</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Booking #</th>
                                <th>Pickup Date</th>
                                <th>Pickup Address</th>
                                <th># of Items</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>KJLKJLJL</td>
                                <td>February 25, 2017</td>
                                <td>29 Anonas Quezon City</td>
                                <th>1</th>
                                <th>This is a remarks</th>
                                <th>{!! format_booking_status('pending') !!}</th>
                                <th>
                                    <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                    <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></button>
                                </th>
                            </tr>

                            <tr>
                                <td>KJLKJLJL</td>
                                <td>February 25, 2017</td>
                                <td>29 Anonas Quezon City</td>
                                <th>1</th>
                                <th>This is a remarks</th>
                                <th>{!! format_booking_status('accepted') !!}</th>
                                <th>
                                    <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                    <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></button>
                                </th>
                            </tr>

                            <tr>
                                <td>KJLKJLJL</td>
                                <td>February 25, 2017</td>
                                <td>29 Anonas Quezon City</td>
                                <th>1</th>
                                <th>Pending</th>
                                <th>{!! format_booking_status('rejected') !!}</th>
                                <th>
                                    <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                    <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></button>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Filters</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="GET">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12">Identifier</label>

                                        <div class="col-md-6">
                                            <select name="filter_addressbook_no_operation" class="form-control">
                                                <option value="equals" {{ old('filter_identifier_no_operation') === 'equals' ? 'selected' : '' }}>Equals</option>
                                                <option value="contains" {{ old('filter_identifier_no_operation') === 'contains' ? 'selected' : '' }}>Contains</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <input id="booking_no" type="text" class="form-control" name="filter_booking_no_term" value="{{ old('filter_booking_no_operation') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12">City</label>

                                        <div class="col-md-6">
                                            <select name="filter_city_operation" class="form-control">
                                                <option value="equals" {{ old('filter_city_operation') === 'equals' ? 'selected' : '' }}>Equals</option>
                                                <option value="contains" {{ old('filter_city_operation') === 'contains' ? 'selected' : '' }}>Contains</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <input id="city" type="text" class="form-control" name="filter_city_term" value="{{ old('filter_city_term') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12">Province</label>

                                        <div class="col-md-6">
                                            <select name="filter_province_operation" class="form-control">
                                                <option value="equals" {{ old('filter_province_operation') === 'equals' ? 'selected' : '' }}>Equals</option>
                                                <option value="contains" {{ old('filter_province_operation') === 'contains' ? 'selected' : '' }}>Contains</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <input id="city" type="text" class="form-control" name="filter_city_term" value="{{ old('filter_city_term') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        Submit Filter
                                    </button>

                                    <button type="button" class="btn btn-danger">
                                        Clear Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content mcontent">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-header">
                    <center><b>
                            <h4 class="modal-title" id="gridSystemModalLabel">Create New Customer</h4></b>
                    </center>
                </div></br>
                <form method="POST" action="{{ url('/admin/riders') }}" >
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Identifier">Identifier</label>
                                <input type="text" class="form-control" name="identifier" id="identifier"required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Type">Type</label>
                                <select name="filter_type_operation" class="form-control" id="type">
                                    <option value="booking">Booking</option>
                                    <option value="shipmemt">Shipment</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class0.="form-group">
                                <label for="firstname">Contact Person First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lastname">Contact Person Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="middlename">Contact Person Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" id="middle_name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_number">Contact Number</label>
                                <input type="number" class="form-control" name="contact_number" id="contact_number" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="text" class="form-control" name="email" id="email" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="AddressLine1">Address Line 1</label>
                                <input type="text" class="form-control" name="address_line_1" id="address_line_1" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="addressline2">Address Line 2</label>
                                <input type="text" class="form-control" name="address_line_2" id="address_line_2"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="barangay">Barangay</label>
                                <input type="text" class="form-control" name="barangay" id="barangay" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="City">City</label>
                                <input type="text" class="form-control" name="city" id="city" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Province">Province</label>
                                <input type="text" class="form-control" name="province" id="province" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" name="country" id="country" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="zipcode">Zipcode</label>
                                <input type="text" class="form-control" name="zip_code" id="zip_code" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Landmarks">LandMarks</label>
                                <input type="text" class="form-control" name="landmarks" id="landmarks" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="AddressType">Address Type</label>
                                <select name="address_type" class="form-control" id="address_type">
                                    <option value="resedential">Resedential</option>
                                    <option value="office">Office</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="checkbox">Is this your primary address?</label>
                                <input type="checkbox" name="checkbox"/>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="pull-right">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
