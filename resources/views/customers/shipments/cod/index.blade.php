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
    </style>
@endsection

@section('scripts')
    <script>
        (function() {
            $('#shippingTable tfoot tr.searchable td').each( function () {
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

            let table = $('#shippingTable').DataTable();

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
                        <li><a href="/customers">Dashboard</a></li>
                        <li><a href="/customers/shipments">Shipments</a></li>
                        <li class="active">Cash-on-Delivery Shipments</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Cash-on-Delivery Shipments</h1>
                </div>
                <div class="page-actions pull-right">
                    <button class="btn btn-primary">
                        <i class="fa fa-download"></i>
                        Export Shipments</button>
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
                                    <h4>Pending Collections</h4>
                                    <h1>21</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Successful Collections</h4>
                                    <h1>4</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Failed Collections</h4>
                                    <h1>5</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Total Wallet</h4>
                                    <h1>P 560, 000</h1>
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

                        <table class="table table-bordered" id="shippingTable">
                            <tfoot class="filter-footer">
                            <tr class="searchable">
                                <td class="hide">Id #</td>
                                <td>Booking #</td>
                                <td>Pickup Date</td>
                                <td>Pickup Address</td>
                                <td># of Items</td>
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
                                <th># of Items</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
