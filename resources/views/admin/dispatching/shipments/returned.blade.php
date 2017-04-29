@extends('layouts.admin')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/wizard.css') }}">
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

                    <button class="btn btn-primary">
                        <i class="fa fa-download"></i>
                        Import Returned Shipments</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="box box-primary">
            <div class="box-header">
                <div class="box-title pull-left">
                    <h1>Returned Shipments</h1>
                </div>
                <div class="page-actions pull-right">
                    <button class="btn btn-danger">
                        <i class="fa fa-plus"></i>
                        Add Returned Shipment</button>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Shipment #</th>
                        <th>Tracking #</th>
                        <th>Customer</th>
                        <th>Delivery Address</th>
                        <th>Rider</th>
                        <th>Reason</th>
                        <th>Returned Times</th>
                        <th>Returned To</th>
                        <th>Retry Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($shipments as $shipment)
                        <tr id="shipment-{{$shipment->id}}">
                            <td class="hide">{{$shipment->id}}</td>
                            <td>{{$shipment->trackingNumbers()->mainTrackingNumber($shipment->id)->tracking_number}}</td>
                            <td>{{$shipment->user->profile->first_name}} {{$shipment->user->profile->middle_name}} {{$shipment->user->profile->last_name}}</td>
                            <td>{{ $shipment->address->address_line_1 }} {{ $shipment->address->barangay }} {{ $shipment->address->city }}, {{ $shipment->address->province }}. {{ $shipment->address->zip_code }}</td>
                            <td>{{ $shipment->service_type }}</td>
                            <td>{{$shipment->rider->user->profile->full_name}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $shipment->status }}</td>
                            <td>
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                <button class="btn btn-default"><i class="fa fa-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection