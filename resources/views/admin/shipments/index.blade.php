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

@section('scripts')
    <script>
        (function() {
            $('.table thead tr.searchable th').each( function () {
                var title = $(this).text();
                if (title) {
                    $(this).html( '<input type="text" style="width: 100%" placeholder="Search '+title+'" />' );
                }
            });

            $('.table').dataTable();
        }())
    </script>
@endsection


@section('content')
    <div class="header-info container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Dashboard</a></li>
                        <li class="active">Shipments</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Shipments</h1>
                </div>

                <div class="page-actions pull-right">
                    <button data-toggle="modal" data-target=".bs-modal-lg" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Create New Shipment</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="hide">
                            <div class="filter-categories">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-sm btn-default active">
                                        <input type="radio" name="filter" id="option1" value="all" autocomplete="off" checked> [{{ number_of_bookings(Auth::user()->id, 'all') }}] All
                                    </label>
                                    <label class="btn btn-sm btn-warning">
                                        <input type="radio" name="filter" id="option2" value="pending" autocomplete="off"> [{{ number_of_bookings(Auth::user()->id, 'pending') }}] Pending
                                    </label>
                                    <label class="btn btn-sm btn-primary">
                                        <input type="radio" name="filter" id="option3" value="accepted" autocomplete="off"> [{{ number_of_bookings(Auth::user()->id, 'accepted') }}] Accepted
                                    </label>

                                    <label class="btn btn-sm btn-success">
                                        <input type="radio" name="filter" id="option3" value="completed" autocomplete="off"> [{{ number_of_bookings(Auth::user()->id, 'completed') }}] Completed
                                    </label>

                                    <label class="btn btn-sm btn-danger">
                                        <input type="radio" name="filter" id="option3" value="rejected" autocomplete="off"> [{{ number_of_bookings(Auth::user()->id, 'rejected') }}] Rejected
                                    </label>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                            <tr class="searchable">
                                <th class="hide">Id #</th>
                                <th>Booking #</th>
                                <th>Pickup Date</th>
                                <th>Pickup Address</th>
                                <th># of Items</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th>Actions</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th class="hide">Id #</th>
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
                            {{--@foreach($addressbooks as $addressbook)--}}
                            {{--<tr id="addressbook-{{$addressbook->id}}">--}}
                            {{--<td>{{$addressbook->id}}</td>--}}
                            {{--<td>{{$addressbook->last_name}} {{$addressbook->middle_name}} {{$addressbook->last_name}}</td>--}}
                            {{--<td>{{ ucwords($addressbook->type) }}</td>--}}
                            {{--<td>{{ ucwords($addressbook->address_type) }}</td>--}}
                            {{--<th>{{$addressbook->address_line_1}}</th>--}}
                            {{--<th>{{$addressbook->contact_number}}</th>--}}
                            {{--<th>{{$addressbook->email}}</th>--}}
                            {{--<th>--}}
                            {{--<button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>--}}
                            {{--<button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></button>--}}
                            {{--</th>--}}
                            {{--</tr>--}}
                            {{--@endforeach--}}
                            </tbody>
                        </table>
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
                            <h4 class="modal-title" id="gridSystemModalLabel">Create New Shipment</h4></b>
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
