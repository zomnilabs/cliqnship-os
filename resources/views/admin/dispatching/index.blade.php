@extends('layouts.admin')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/wizard.css') }}">
@endsection

@section('content')
    <div class="header-info container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Dashboard</a></li>
                        <li class="active">Dispatching</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Dispatching</h1>
                </div>

                <div class="page-actions pull-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createShippingModal">
                        <i class="fa fa-plus"></i>
                       Import Shipments Assignment</button>

                    <button class="btn btn-primary">
                        <i class="fa fa-upload"></i>
                        Import Bookings Assignment</button>

                    <button class="btn btn-primary">
                        <i class="fa fa-download"></i>
                        Import Returned Shipments</button>
                </div>
            </div>
        </div>
    </div>
@endsection