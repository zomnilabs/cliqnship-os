@extends('layouts.admin')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/wizard.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/selec2/css/select2.min.css') }}">
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

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row text-center cards">
                    <div class="col-md-3">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Unassigned Shipments</h4>
                                    <h1>{{ $pendingShipment }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Assigned Shipments</h4>
                                    <h1>{{ $assignedShipment }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title pull-left">
                            <h1>Shipment</h1>
                        </div>
                        <div class="page-actions pull-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addRiderAssignment">
                                <i class="fa fa-plus"></i>
                                Add shipment Assignment</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="hide">Shipment Id</th>
                                <th>Tracking #</th>
                                <th>Customer</th>
                                <th>Delivery Address</th>
                                <th>Service Type</th>
                                <th>Services Add-Ons</th>
                                <th>Remarks</th>
                                <th>Rider</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($shipments as $shipment)
                                <tr id="shipment-{{$shipment->id}}">
                                    <td>{{$shipment->id}}</td>
                                    <td>{{$shipment->user->profile->first_name}} {{$shipment->user->profile->middle_name}} {{$shipment->user->profile->last_name}}</td>
                                    <td>{{ ucwords($shipment->source->name) or '' }}</td>
                                    <td>{{ ucwords($shipment->address->address_type or '') }}</td>
                                    <th>{{$shipment->address->address_line_1 or ''}}</th>
                                    <th>{{$shipment->address->contact_number or ''}}</th>
                                    <th>{{$shipment->user->email or ''}}</th>
                                    <th>
                                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        <button class="btn btn-default"><i class="fa fa-edit"></i></button>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        @include('admin.dispatching.shipments.modals.dispatch-assignment')
    </div>
@endsection