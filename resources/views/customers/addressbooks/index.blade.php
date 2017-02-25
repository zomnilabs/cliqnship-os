@extends('layouts.app')

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
                        <li><a href="/customers">Dashboard</a></li>
                        <li class="active">Addressbooks</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Addressbooks</h1>
                </div>

                <div class="page-actions pull-right">
                    <button data-toggle="modal" data-target=".bs-modal-lg" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        New Addressbooks</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content mcontent">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Identifier">Identifier</label>
                            <input type="text" class="form-control" name="identifier"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Identifier">Type</label>
                            <select name="filter_type_operation" class="form-control">
                                <option value="equals" {{ old('filter_type_operation') === 'equals' ? 'selected' : '' }}>Booking/PickUpAddress</option>
                                <option value="contains" {{ old('filter_type_operation') === 'contains' ? 'selected' : '' }}>Contains</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="firstname">Contact Person First Name</label>
                            <input type="text" class="form-control" name="firstname"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lastname">Contact Person Last Name</label>
                            <input type="text" class="form-control" name="lastname"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middlename">Contact Person Middle Name</label>
                            <input type="text" class="form-control" name="middlename"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contactno">Contact Number</label>
                            <input type="text" class="form-control" name="contactno"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" class="form-control" name="email"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="AddressLine1">Address Line 1</label>
                            <input type="text" class="form-control" name="addressline1"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="addressline2">Address Line 2</label>
                            <input type="text" class="form-control" name="addressline2"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="barangay">Barangay</label>
                            <input type="text" class="form-control" name="barangay"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="City">City</label>
                            <input type="text" class="form-control" name="city"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Province">Province</label>
                            <input type="text" class="form-control" name="province"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" name="country"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="zipcode">Zipcode</label>
                            <input type="text" class="form-control" name="zipcode"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Landmarks">LandMarks</label>
                            <input type="text" class="form-control" name="landmarks"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="AddressType">Address Type</label>
                            <select name="filter_type_operation" class="form-control">
                                <option value="equals" {{ old('filter_type_operation') === 'equals' ? 'selected' : '' }}>Resedential</option>
                                <option value="contains" {{ old('filter_type_operation') === 'contains' ? 'selected' : '' }}>Contains</option>
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
                        <button class="btn btn-primary">Save</button>
                    </div>
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
                                <th>Id #</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact #</th>
                                <th>Email Address</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Edward Lim</td>
                                <th>Talaga, Capas, Tarlac</th>
                                <th>09123456789</th>
                                <th>edward@gmail.com</th>
                                <th>active</th>
                                <th>
                                    <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                    <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></button>
                                </th>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Jackilyn Damulag</td>
                                <th>San Miguel, Tarlac</th>
                                <th>09993456789</th>
                                <th>jackilyn@gmail.com</th>
                                <th>active</th>
                                <th>
                                    <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                    <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></button>
                                </th>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>John Castro</td>
                                <th>Concepcion, Tarlac</th>
                                <th>09323456789</th>
                                <th>john@gmail.com</th>
                                <th>active</th>
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
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Filter
                                                </button>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-primary">
                                                    Clear Filter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
