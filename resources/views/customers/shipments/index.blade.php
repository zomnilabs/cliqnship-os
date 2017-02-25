@extends('layouts.app')

@section('content')
    <div class="header-info container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/customers">Dashboard</a></li>
                        <li class="active">Shipments</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Shipments</h1>
                </div>

                <div class="page-actions pull-right">
                    <button class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        New Shipment</button>

                    <button class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Import Shipments</button>

                    <button class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Export Shipments</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">

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
                                    <th>Pending</th>
                                    <th>This is a remarks</th>
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
                                    <th>This is a remarks</th>
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
                                    <th>This is a remarks</th>
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
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                        <label for="gender" class="col-md-4 control-label">Gender</label>

                                        <div class="col-md-6">
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                                            </select>
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
