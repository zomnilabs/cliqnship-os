@extends('layouts.admin')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/wizard.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">

    <style>
        .mcontent{
            padding:15px;
        }
        .pull-right button{
            margin-right:20px;
        }

        .select2-container {
            width: 100% !important;
            font-size: 20px;
        }

        .select2-search__field, .select2-search {
            width: 100% !important;
        }

        .waybill-input {
            font-size: 20px;
        }

        .select2-selection__choice {
            background-color: #3c8dbc !important;
            border-color: #357CA5 !important;
            font-size: 20px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #224F69 !important;
            margin-right: 10px !important;
        }

        .stat-item {
            border: solid #efefef 1px;
            padding-top: 10px;
            padding-bottom: 10px;
            height: 80px;
        }

        .stat-item h2 {
            margin: 0;
            padding: 0;
        }

        .stat-input {
            margin: 0;
            padding: 0;
        }

        .stat-input input {
            font-size: 20px;
            padding: 10px;
            height: 50px;
            border-color: #6e6e6e;
        }

        .stat-button {
            margin: 0;
            padding: 0;
        }

        .stat-button button {
            height: 50px;
        }
    </style>
@endsection

@section('scripts')
    <script>
        (function() {
            $('#receivedTable thead tr.searchable td').each( function () {
                var title = $(this).text();
                if (title) {
                    $(this).html( '<input type="text" style="width: 100%" placeholder="Search '+title+'" />' );
                }
            });

            $('#receivedTable').dataTable();

            // Select 2
            $(".waybill-input").select2({
                tags: true,
                tokenSeparators: [',', ' '],
                placeholder: "Input waybill number/s",
                allowClear: true
            }).on('change', function(value) {
                let waybills = $(this).val();
                let newValue = waybills[waybills.length - 1];
                console.log('new value', newValue);

                fetch(`/api/v1/shipments/check/${newValue}`).then((res) => {
                    if (! res.ok) {
                        let html = `<p><span class="text-danger">${newValue}</span> is not a valid waybill</p>`;
                        $('.error-container').append(html);

                        return;
                    }
                }).catch((error) => {
                    let html = `<p><span class="text-danger">${newValue}</span> is not a valid waybill</p>`;
                    $('.error-container').append(html);
                });
            });

            $('#status').on('change', function() {
                if ($(this).val() === 'returned') {
                    $('.reasonInput').removeClass('hide');
                } else {
                    $('.reasonInput').addClass('hide');
                }
            })
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
                        <li class="active">Shipments</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Receiving Shipments</h1>
                </div>

                <div class="page-actions pull-right">
                    <button  data-toggle="modal" data-target="#addWaybill" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Receive New Shipments</button>
                </div>

                <div class="page-actions pull-right">
                    <button  data-toggle="modal" data-target="#addWaybill" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Receive Existing Shipments</button>
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
                                    <h4>Shipments Remitted / Total Shipments</h4>
                                    <h1>{{ $statistics['remitted'] }} / {{ $statistics['total_shipments'] }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Remitted COD / Total COD Shipments</h4>
                                    <h1>{{ $statistics['remitted_cod'] }} / {{ $statistics['with_cod'] }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>COD Remitted / Total Amount</h4>
                                    <h1>{{ $statistics['total_cod_amount_remitted'] }} / {{ $statistics['total_cod_amount'] }}</h1>
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
                    <div class="panel-heading">
                        <div class="panel-title">
                            Existing Shipments
                        </div>
                    </div>

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

                        <table class="table table-bordered" id="receivedTable">
                            <thead>
                            <tr class="searchable">
                                <td class="hide">Id #</td>
                                <td>Tracking #</td>
                                <td>Delivery Address</td>
                                <td>COD</td>
                                <td>COD Amount</td>
                                <td>Service Type</td>
                                <td>Task Status</td>
                                <td>Shipment Status</td>
                            </tr>
                            <tr>
                                <th class="hide">Id #</th>
                                <th>Tracking #</th>
                                <th>Delivery Address</th>
                                <th>COD</th>
                                <th>COD Amount</th>
                                <th>Service Type</th>
                                <th>Task Status</th>
                                <th>Shipment Status</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($assignments as $assignment)
                                    <tr>
                                        <td class="hide">{{ $assignment->id }}</td>
                                        <td>{{ $assignment->shipment->trackingNumbers()->mainTrackingNumber()->tracking_number }}</td>
                                        <td>{{ $assignment->shipment->address->address_line_1 }} {{ $assignment->shipment->address->barangay }} {{ $assignment->shipment->address->city }}, {{ $assignment->shipment->address->province }}. {{ $assignment->shipment->address->zip_code }}</td>
                                        <td>{{ $assignment->shipment->collect_and_deposit ? 'Yes' : 'No' }}</td>
                                        <td>{{ $assignment->shipment->collect_and_deposit_amount }}</td>
                                        <td>{{ $assignment->shipment->service_type }}</td>
                                        <td>{{ $assignment->status }}</td>
                                        <td>{{ $assignment->shipment->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="addWaybill" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" style="width: 100%" role="document">
            <div class="modal-content mcontent">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-header text-center">
                    <h4 class="modal-title" id="modalTitle">Shipment Remit</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row text-center cards">

                                <div class="col-md-3">
                                    <a href="#">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <h4>Shipments Remitted / Total Shipments</h4>
                                                <h1>{{ $statistics['remitted'] }} / {{ $statistics['total_shipments'] }}</h1>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="#">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <h4>New Shipments</h4>
                                                <h1>{{ $statistics['total_cod_amount'] }}</h1>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="#">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <h4>Remitted COD / Total COD Shipments</h4>
                                                <h1>{{ $statistics['remitted_cod'] }} / {{ $statistics['with_cod'] }}</h1>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="#">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <h4>COD Remitted / Total Amount</h4>
                                                <h1>{{ $statistics['total_cod_amount_remitted'] }} / {{ $statistics['total_cod_amount'] }}</h1>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Waybill</th>
                                    <th>COD Amount</th>
                                    <th>Shipment Amount</th>
                                    <th>Remitted COD Amount</th>
                                    <th>Remitted Shipment Fee</th>
                                    <th>Status</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td colspan="6">
                                        <p style="text-align: center">No Content Yet</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6 stat-item">
                                    Total COD
                                    <h2>1000.00</h2>
                                </div>
                                <div class="col-md-6 stat-item">
                                    Total Shipment
                                    <h2>0.00</h2>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-12 stat-item">
                                    <h4>Remitted COD: </h4>
                                    <span id="remittedCOD">900.00</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 stat-item">
                                    <h4>Remitted Shipment Fee: </h4>
                                    <span id="remittedShipmentFee">0.00</span>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-12 stat-input">
                                    <input type="text" placeholder="500000XXXX" class="form-control">
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-12 stat-button">
                                    <button class="btn btn-default btn-block">
                                        Save Transaction
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
