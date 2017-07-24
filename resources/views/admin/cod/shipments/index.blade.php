@extends('layouts.admin')

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
                            selectHTML += '<option value="collected">Collected</option>';
                            selectHTML += '<option value="deposited">Deposited</option>';
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
                        <li><a href="/admin">Dashboard</a></li>
                        <li class="active">Cash-on-Delivery Shipments</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Cash-on-Delivery Shipments</h1>
                </div>
                <div class="page-actions pull-right">
                    <button class="btn btn-primary"
                        data-toggle="modal" data-target="#exportShipmentCod">
                        <i class="fa fa-download"></i>
                        Export Shipments</button>

                    <button class="btn btn-primary"
                            data-toggle="modal" data-target="#importShipmentCod">
                        <i class="fa fa-upload"></i>
                        Import Shipments</button>
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
                                    <h4>Pending Amount</h4>
                                    <h1>{{ number_format($amounts['pending'], 2) }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Collected Amount</h4>
                                    <h1>{{ number_format($amounts['collected'], 2) }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Deposited Amount</h4>
                                    <h1>{{ number_format($amounts['deposited'], 2) }}</h1>
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
                        <table class="table table-bordered" id="shippingTable" style="width: 100%">
                            <tfoot class="filter-footer">
                            <tr class="searchable">
                                <td class="hide">Id #</td>
                                <td>Tracking #</td>
                                <td>Delivery Address</td>
                                <td>Account Details</td>
                                <td>COD Amount</td>
                                <td>Remitted Amount</td>
                                <td>Deposit Date</td>
                                <td>Status</td>
                                <td class="hide"></td>
                            </tr>
                            </tfoot>

                            <thead>
                            <tr>
                                <th class="hide">Id #</th>
                                <th>Tracking #</th>
                                <th>Delivery Address</th>
                                <th>Account Details</th>
                                <th>COD Amount</th>
                                <td>Remitted Amount</td>
                                <th>Deposit Date</th>
                                <th>Status</th>
                                <th class="hide">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($shipments as $shipment)
                                <tr>
                                    <td class="hide">{{ $shipment->id }}</td>
                                    <td>{{ $shipment->trackingNumbers()->mainTrackingNumber()->tracking_number }}</td>
                                    <td>
                                        @if ($shipment->address)
                                            {{ $shipment->address->address_line_1 }} {{ $shipment->address->barangay }} {{ $shipment->address->city }}, {{ $shipment->address->province }}. {{ $shipment->address->zip_code }}
                                        @endif
                                    </td>
                                    <td>
                                        Account Name: {{ $shipment->cod->account_name }} <br/>
                                        Account Number: {{ $shipment->cod->account_number }} <br/>
                                        Bank: {{ $shipment->cod->bank }} <br/>
                                    </td>
                                    <td>{{ number_format($shipment->cod->collect_and_deposit_amount, 2) }}</td>
                                    <td>{{ number_format($shipment->cod->remitted_amount, 2) }}</td>
                                    <td>{{ $shipment->cod->deposit_date ? \Carbon\Carbon::createFromTimestamp(strtotime($shipment->cod->deposit_date))->toFormattedDateString() : '' }}</td>
                                    <td>{{ $shipment->cod->status }}</td>
                                    <td class="hide">
                                        <button class="btn btn-primary">Update Status</button>
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

    <div class="modal fade" id="exportShipmentCod" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content mcontent">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Shipment Assignment</h4>
                </div>
                <form id="viewForm" action="/admin/cash-on-delivery/all/export" method="GET">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="" disabled selected>Select a status to export</option>
                                        <option value="pending">Pending</option>
                                        <option value="collected">Collected</option>
                                        <option value="deposited">Deposited</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success" id="formSubmit"><i class="fa fa-floppy-o"></i> Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="importShipmentCod" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content mcontent">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Shipment Assignment</h4>
                </div>
                <form id="viewForm" action="/admin/cash-on-delivery/all/import" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="file">Shipment CODs File</label>
                                    <input type="file" class="form-control" name="file" id="file" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success" id="formSubmit"><i class="fa fa-floppy-o"></i> Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
