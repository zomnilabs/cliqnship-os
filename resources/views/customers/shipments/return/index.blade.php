@extends('layouts.app')

@section('content')
    <div class="header-info container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/customers">Dashboard</a></li>
                        <li><a href="/customers/shipments">Shipments</a></li>
                        <li class="active">Returned Shipments</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Returned Shipments</h1>
                </div>
                <div class="page-actions pull-right">
                    <button class="btn btn-primary">
                        <i class="fa fa-download"></i>
                        Export Shipments</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-8">
                <input type="text" placeholder="Search Shipments" class="form-control">
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
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
        </div>
    </div>
@endsection
