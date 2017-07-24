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
            var table = $('#bookingTable').DataTable();

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
                        default:
                            $(this).html( '<input class="form-control filter" type="text" style="width: 100%" placeholder="Search '+title+'" />' );
                    }

                }
            });

            // Apply the search
            table.columns().every( function () {
                let that = this;
                $( '.filter', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        console.log(that.data());
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
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
                        <li class="active">Bookings</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Bookings</h1>
                </div>

                <div class="page-actions pull-right">
                    <button data-toggle="modal" data-target=".bs-modal-lg" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Create New Booking</button>
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

                        <table class="table table-bordered" id="bookingTable" style="width: 100%">
                            <tfoot class="filter-footer">
                            <tr class="searchable">
                                <td class="hide">Id #</td>
                                <td>Booking #</td>
                                <td>Pickup Date</td>
                                <td>Pickup Address</td>
                                <td>Remarks</td>
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
                                    <td>
                                        @if ($booking->address)
                                            {{ $booking->address->address_line_1 }} {{ $booking->address->barangay }} {{ $booking->address->city }}, {{ $booking->address->province }}. {{ $booking->address->zip_code }}
                                        @endif
                                    </td>
                                    <td>{{ $booking->remarks }}</td>
                                    <td>{{ $booking->status }}</td>
                                    <th>
                                        @if ($booking->status === 'pending')
                                            <button class="btn btn-default"><i class="fa fa-edit"></i></button>
                                        @endif
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

