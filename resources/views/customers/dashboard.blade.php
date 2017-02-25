@extends('layouts.app')

@section('stylesheets')
    <style>
        .cards .panel .panel-body{
            color: #636b6f;
        }
        .cards .panel .panel-body a{
            color: #636b6f;
            cursor: pointer;
        }
        .cards a {
            text-decoration: none !important;
        }
        .cards .panel .panel-body:hover{
            color: #B1CE52;
        }

        .navbar-default {
            border-color: #434343;
        }
    </style>
@endsection

@section('content')
    <div class="header-info container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row text-center cards">
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Pending Pickup/Bookings</h4>
                                    <h1>10</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Pending Shipments</h4>
                                    <h1>10</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>En-Route Shipments</h4>
                                    <h1>5</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Completed Shipments</h4>
                                    <h1>21</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Returned Shipments</h4>
                                    <h1>4</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Wallet</h4>
                                    <h1>P 560, 000</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2>Recently completed shipments</h2>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Booking Number</th>
                                    <th>Item Description</th>
                                    <th>Service Type</th>
                                    <th>Remarks</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>58AD64AEDA281</td>
                                    <td>T-shirt</td>
                                    <td>Metro Manila</td>
                                    <td>Testing</td>
                                    <td>Completed</td>
                                </tr>
                                <tr>
                                    <td>58AD64AEDA255</td>
                                    <td>Food</td>
                                    <td>Metro Manila</td>
                                    <td>Handle with Care</td>
                                    <td>Completed</td>
                                </tr>
                                <tr>
                                    <td>58HFA4AEDA281</td>
                                    <td>Testing</td>
                                    <td>Metro Manila</td>
                                    <td>Fragile</td>
                                    <td>Completed</td>
                                </tr>
                                <tr>
                                    <td>58AD64AEHNN62</td>
                                    <td>Testttttt</td>
                                    <td>Metro Manila</td>
                                    <td>Handle with Care</td>
                                    <td>Completed</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
