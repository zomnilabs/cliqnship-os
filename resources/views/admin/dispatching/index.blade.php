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

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title pull-left">
                            <h1>Bookings</h1>
                        </div>
                        <div class="page-actions pull-right">
                            <button class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Add booking Assignment</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id #</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Address Type</th>
                                <th>Address</th>
                                <th>Contact #</th>
                                <th>Email Address</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Edward Lim</td>
                                <td>Booking</td>
                                <td>Residential</td>
                                <td>San-miguel Tarlac</td>
                                <td>09123456789</td>
                                <td>edward@gmail.com</td>
                                <td>
                                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    <button class="btn btn-default"><i class="fa fa-edit"></i></button>
                                </td>
                            </tr>
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
                            {{--<button class="btn btn-danger"><i class="fa fa-trash"></i></button>--}}
                            {{--<button class="btn btn-default"><i class="fa fa-edit"></i></button>--}}
                            {{--</th>--}}
                            {{--</tr>--}}
                            {{--@endforeach--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

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
                                <th>Address Type</th>
                                <th>Address</th>
                                <th>Contact #</th>
                                <th>Email Address</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Edward Lim</td>
                                <td>Booking</td>
                                <td>Residential</td>
                                <td>San-miguel Tarlac</td>
                                <td>09123456789</td>
                                <td>edward@gmail.com</td>
                                <td>
                                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    <button class="btn btn-default"><i class="fa fa-edit"></i></button>
                                </td>
                            </tr>
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
                            {{--<button class="btn btn-danger"><i class="fa fa-trash"></i></button>--}}
                            {{--<button class="btn btn-default"><i class="fa fa-edit"></i></button>--}}
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
                            <th>Actions</th>
                            <th>Date</th>
                            <th>Rider</th>
                            <th>Reason</th>
                            <th>Returned Times</th>
                            <th>Returned To</th>
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
                    {{--<button class="btn btn-danger"><i class="fa fa-trash"></i></button>--}}
                    {{--<button class="btn btn-default"><i class="fa fa-edit"></i></button>--}}
                    {{--</th>--}}
                    {{--</tr>--}}
                    {{--@endforeach--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection