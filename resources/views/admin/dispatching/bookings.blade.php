@extends('layouts.admin')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/wizard.css') }}">
@endsection

@section('scripts')
    <script>
        (function() {
            $('#bookingTable tfoot tr.searchable td').each( function () {
                let title = $(this).text();
                if (title) {
                    switch (title) {
                        case 'Pickup Date':
                            $(this).html( '<input type="date" class="form-control filter" style="width: 100%" placeholder="Search '+title+'" />' );

                            break;
                        case 'Status':
                            let selectHTML = '<select class="form-control filter" style="width: 100%">';
                            selectHTML += '<option value="">Filter Status</option>';
                            selectHTML += '<option value="pending">Pending</option>';
                            selectHTML += '<option value="accepted">Accepted</option>';
                            selectHTML += '<option value="completed">Completed</option>';
                            selectHTML += '<option value="rejected">Rejected</option>';
                            selectHTML += '</select>';

                            $(this).html(selectHTML);

                            break;
                        case 'Rider':
                            let selectHTMLRider = '<select class="form-control filter" style="width: 100%">';
                            selectHTMLRider += '<option value="">Filter Rider</option>';
                            @foreach ($riders as $rider)
                                selectHTMLRider += '<option value="{{ $rider->id }}">{{ $rider->profile->full_name }}</option>';
                            @endforeach
                            selectHTMLRider += '</select>';

                            $(this).html(selectHTMLRider);

                            break;
                        default:
                            $(this).html( '<input class="form-control filter" type="text" style="width: 100%" placeholder="Search '+title+'" />' );
                    }

                }
            });

            let table = $('#bookingTable').DataTable();

            // Apply the search
            table.columns().every( function () {
                let that = this;
                $( '.filter', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );

            let riders = [];
            @foreach ($riders as $rider)
                riders.push({
                    value: {{ $rider->id }},
                    text: '{{ $rider->profile->full_name }}'
            });
            @endforeach

            $.fn.editable.defaults.mode = 'inline';
            $('.change_rider').editable({
                type: 'select',
                name: 'rider',
                title: 'Change Rider',
                source: riders
            });
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
                        <i class="fa fa-upload"></i>
                        Import Bookings Assignment</button>

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
                                    <h4>Pending Bookings</h4>
                                    <h1>{{ $pendingBooking }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Assigned Bookings</h4>
                                    <h1>{{ $assignedBooking }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Completed Bookings</h4>
                                    <h1>{{ $completedBooking }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Rejected Bookings</h4>
                                    <h1>{{ $rejectedBooking }}</h1>
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
                            <h1>Bookings</h1>
                        </div>
                    </div>

                    <div class="box-body">
                        <table class="table table-bordered" id="bookingTable" style="width: 100%">
                            <tfoot class="filter-footer">
                            <tr class="searchable">
                                <td class="hide">Id #</td>
                                <td>Booking #</td>
                                <td>Pickup Date</td>
                                <td>Pickup Address</td>
                                <td>Remarks</td>
                                <td>Rider</td>
                                <td>Status</td>
                                <td></td>
                            </tr>
                            </tfoot>

                            <thead>
                            <tr>
                                <th class="hide">Id #</th>
                                <th>Booking #</th>
                                <th>Pickup Date</th>
                                <th>Pickup Address</th>
                                <th>Remarks</th>
                                <th>Rider</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($bookings as $booking)
                                <tr id="booking-{{$booking->id}}">
                                    <td class="hide">{{ $booking->id }}</td>
                                    <td>{{ $booking->booking_no }}</td>
                                    <td>{{ $booking->pickup_date }}</td>
                                    <td>{{ $booking->address->address_line_1 }} {{ $booking->address->barangay }} {{ $booking->address->city }}, {{ $booking->address->province }}. {{ $booking->address->zip_code }}</td>
                                    <td>{{ $booking->remarks }}</td>
                                    <td class="change_rider">{{ $booking->assignment ? $booking->assignment->rider->profile->full_name : 'Not Assigned' }}</td>
                                    <td>{{ $booking->status }}</td>
                                    <th>
                                        <button class="btn btn-danger delBooking" value="{{ $booking->id }}"><i class="fa fa-trash"></i></button>
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
    </div>

@endsection