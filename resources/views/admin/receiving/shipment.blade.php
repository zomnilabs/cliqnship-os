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
                        <li class="active">Receiving</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Receiving</h1>
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
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title pull-left">
                            <h1>Shipment</h1>
                        </div>
                        <div class="page-actions pull-right">
                            <button class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Add shipment Assignment</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id #</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Source Type</th>
                                <th>Address Type</th>
                                <th>Address</th>
                                <th>Contact #</th>
                                <th>Email Address</th>
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
                                        <td>{{$shipment->address->address_line_1 or ''}}</td>
                                        <td>{{$shipment->address->contact_number or ''}}</td>
                                        <td>{{$shipment->user->email or ''}}</td>
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

        </div>
    </div>
@endsection