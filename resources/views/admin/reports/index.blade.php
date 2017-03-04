@extends('layouts.admin')

@section('stylesheets')
    <style>
        .mcontent{
            padding:15px;
        }
        .pull-right button{
            margin-right:20px;
        }
    </style>
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
                        <li class="active">Reports</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Reports</h1>
                </div>

                <div class="page-actions pull-right">
                    <button data-toggle="modal" data-target=".bs-modal-lg" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Create New Report</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="hide">
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
                        </div>

                        <table class="table table-bordered">
                            <thead>
                            <tr class="searchable">
                                <th class="hide">Id #</th>
                                <th>Booking #</th>
                                <th>Pickup Date</th>
                                <th>Pickup Address</th>
                                <th># of Items</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th>Actions</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th class="hide">Id #</th>
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
                            {{--<button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>--}}
                            {{--<button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></button>--}}
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
@endsection
