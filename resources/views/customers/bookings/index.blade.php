@extends('layouts.app')

@section('content')
    <div class="header-info container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/customers">Dashboard</a></li>
                        <li class="active">Bookings</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Bookings</h1>
                </div>

                <div class="page-actions pull-right">
                    <button class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        New Booking</button>

                    <button class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Import Bookings</button>

                    <button class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Export Bookings</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
