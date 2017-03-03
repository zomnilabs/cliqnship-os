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

        .white-text {
            color: #fdfdfd !important;
        }

        .panel-body-danger {
            background-color: #ea435e;
        }

        .panel-body-pending {
            background-color: #eac976;
        }

        .panel-body-enroute {
            background-color: #688bea;
        }

        .panel-body-completed {
            background-color: #7bea88;
        }

        .panel-body-wallet {
            background-color: #ead756;
        }

        .stats {
            position: relative;
            min-height: 130px;
        }

        .stats-label {
            background-color: #494949;
            padding: 10px 20px;
            width: 100%;
            position: absolute;
            left: 0;
            bottom: 0;
            margin: 0;
            font-size: 1em;
        }

        .stats-value {
            margin-top: 5px !important;
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
                                <div class="panel-body panel-body-pending white-text stats">
                                    <h1 class="stats-value">10</h1>
                                    <h4 class="stats-label">Pending Pickup/Bookings</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body panel-body-pending white-text stats">
                                    <h1 class="stats-value">10</h1>
                                    <h4 class="stats-label">Pending Shipments</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body panel-body-enroute white-text stats">
                                    <h1 class="stats-value">5</h1>
                                    <h4 class="stats-label">En-Route Shipments</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body panel-body-completed white-text stats">
                                    <h1 class="stats-value">21</h1>
                                    <h4 class="stats-label">Completed Shipments</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-danger">
                                <div class="panel-body panel-body-danger white-text stats">
                                    <h1 class="stats-value">4</h1>
                                    <h4 class="stats-label">Returned Shipments</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body panel-body-wallet white-text stats">
                                    <h1 class="stats-value">P 560, 000</h1>
                                    <h4 class="stats-label">Wallet</h4>
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
