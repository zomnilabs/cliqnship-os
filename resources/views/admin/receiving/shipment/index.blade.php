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
            height: 100px;
        }

        .stat-item h2 {
            margin: 0;
            padding: 0;
            font-size: 50px;
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
            /**
             * Number.prototype.format(n, x, s, c)
             *
             * @param integer n: length of decimal
             * @param integer x: length of whole part
             * @param mixed   s: sections delimiter
             * @param mixed   c: decimal delimiter
             */
            Number.prototype.format = function(n, x, s, c) {
                let re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                    num = this.toFixed(Math.max(0, ~~n));

                return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
            };

            let shipments = [];

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

                fetch(`/api/web/shipments/check/${newValue}`).then((res) => {
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

            $(".waybill-input-new").select2({
                tags: true,
                tokenSeparators: [',', ' '],
                placeholder: "Input waybill number/s",
                allowClear: true
            });

            // waybillNumbersInput
            $('#waybillNumbersInput').on('click', function(e) {
                $(this).select();
                $(this).focus();
            });

            $('#waybillNumbersInput').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    let value = $(this).val();

                    $(this).prop('disabled', true);
                    $(this).select();
                    $(this).focus();

                    let self = $(this);

                    let index = shipments.findIndex((item) => item.tracking_number === value);

                    if (index >= 0) {
                        let html = `<p><span class="text-danger">${value}</span> already in the table</p>`;
                        $('#errorContainer').html(html);

                        $(this).prop('disabled', false);
                        $(this).select();
                        $(this).focus();

                        return;
                    }

                    fetch(`/api/web/shipments/check/${value}`).then((res) => {
                        if (! res.ok) {
                            let html = `<p><span class="text-danger">${value}</span> is not a valid waybill</p>`;
                            $('#errorContainer').html(html);
                            self.prop('disabled', false);

                            self.select();
                            self.focus();
                            return;
                        }

                        res.json().then((json) => {
                            shipments.push(json);
                            calculateTotals();

                            addToTable(json);
                        });

                        $('#errorContainer').html('');
                        self.prop('disabled', false);
                        self.select();
                        self.focus();
                    }).catch((error) => {
                        let html = `<p><span class="text-danger">${value}</span> is not a valid waybill</p>`;
                        $('#errorContainer').html(html);

                        self.prop('disabled', false);
                        self.select();
                        self.focus();
                    });
                }
            });

            $('#addWaybill').on('hidden.bs.modal', function(e) {
                $('.alert').addClass('hide');
            });

            // Save the transaction
            $('#saveTransaction').on('click', function(e) {
                e.preventDefault();

                $(this).prop('disabled', true);
                $(this).html('<i class="fa fa-spinner fa-spin"></i> &nbsp; Saving transaction...');

                let data = {
                    shipments: []
                };

                let riderId = $('#riderId').val();

                for (let shipment of shipments) {
                    console.log(shipment.newStatus);
                    let item = {
                        shipment_id: shipment.shipment_id,
                        status: shipment.newStatus ? shipment.newStatus : 'pending',
                        remitted_amount: typeof shipment.inputtedCOD !== 'undefined' ? shipment.inputtedCOD : 0
                    };

                    data.shipments.push(item);
                }

                let url = `/admin/receiving/rider/remit/${riderId}/shipments`;
                axios.post(url, data).then((response) => {
                    console.log(response);

                    $('#transactionSuccess').removeClass('hide');
                    resetTransactionButton();
                    resetForm();
                }).catch((e) => {
                    $('#transactionError').removeClass('hide');
                    resetTransactionButton();
                });
            });

            function resetForm() {
                shipments = [];
                $('#noContent').show();
                let table = $('#shipmentReceiveTable tbody');
                table.children('.shipment-item').remove();
                calculateTotals();
                calculateRemittedCOD();
            }

            function resetTransactionButton() {
                $('#saveTransaction').prop('disabled', false);
                $('#saveTransaction').html('Save Transaction');
            }

            // calculate
            function calculateTotals() {
                let total = 0;

                for (let shipment of shipments) {
                    total += shipment.shipment.cod ? shipment.shipment.cod.collect_and_deposit_amount : 0;
                }

                $('#totalCOD').html(total.format(2, 3, ',', '.'));
            }

            // Calculate remittedCOD
            function calculateRemittedCOD() {
                let remittedCOD = 0;

                for (let shipment of shipments) {
                    remittedCOD += shipment.inputtedCOD ? shipment.inputtedCOD : 0;
                }

                $('#remittedCOD').html(remittedCOD.format(2, 3, ',', '.'));
            }

            function addToTable(data) {
                $('#noContent').hide();

                let table = $('#shipmentReceiveTable tbody');
                let html = '<tr class="shipment-item">';
                html += `<td>${data.tracking_number}</td>`;
                html += `<td>${data.shipment.cod ? data.shipment.cod.collect_and_deposit_amount : 0}</td>`;
                html += `<td>0</td>`;
                html += `<td class="editable-cod-amount" data-shipment="${data.shipment.id}">0</td>`;
                html += `<td class="editable-shipment-fee" data-shipment="${data.shipment.id}">0</td>`;
                html += `<td class="editable-status" data-shipment="${data.shipment.id}">${data.shipment.status}</td>`;
                html += '</tr>';

                table.append(html);
                setupEditable();
            }

            // Editables
            function setupEditable() {
                $.fn.editable.defaults.mode = 'inline';

                $('.editable-status').editable({
                    type: 'select',
                    name: 'status',
                    title: 'Change Status',
                    inline: true,
                    source: [
                        {
                            value: 'arrived-at-hq',
                            text: 'Arrived At HQ',
                            selected: true
                        },
                        {
                            value: 'successfully-delivered',
                            text: 'Successfully Delivered'
                        }
                    ]
                }).on('save', function(e, params) {
                    let shipmentId = $(this).data('shipment');
                    let newStatus = params.submitValue;

                    let shipmentIndex = searchShipment(shipmentId);
                    if (shipmentIndex < 0) {
                        return;
                    }

                    shipments[shipmentIndex]['newStatus'] = newStatus;
                    console.log(shipments);

                });

                $('.editable-cod-amount').editable({
                    type: 'number',
                    title: 'Enter COD Amount Remitted'
                }).on('save', function(e, params) {
                    let shipmentId = $(this).data('shipment');
                    let inputtedCOD = parseInt(params.submitValue);
                    let $row = $(e.target).parent();

                    let shipmentIndex = searchShipment(shipmentId);
                    if (shipmentIndex < 0) {
                        return;
                    }

                    shipments[shipmentIndex]['inputtedCOD'] = inputtedCOD;
                    shipments[shipmentIndex]['newStatus'] = 'successfully-delivered';

                    if (inputtedCOD < shipments[shipmentIndex].shipment.cod.collect_and_deposit_amount) {
                        e.target.style.backgroundColor = '#ffcecc';
                    }

                    $row.find('.editable-status').editable('setValue',"successfully-delivered");

                    calculateRemittedCOD();
                });

                $('.editable-shipment-fee').editable({
                    type: 'number',
                    title: 'Enter COD Amount Remitted'
                });
            }

            // Search thru collection of shipments
            function searchShipment(shipmentId) {
                return shipments.findIndex((item) => {
                    return item.shipment_id === shipmentId;
                });
            }

            setupEditable();
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
                    <button  data-toggle="modal" data-target="#addReturnedWaybill" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Receive Returned Shipments</button>
                </div>

                <div class="page-actions pull-right">
                    <button  data-toggle="modal" data-target="#addNewWaybill" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Receive New Shipments</button>
                </div>

                <div class="page-actions pull-right">
                    <button  data-toggle="modal" data-target="#addWaybill" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Receive Shipments</button>
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
                                        <td>
                                            @if ($assignment->shipment->address)
                                                {{ $assignment->shipment->address->address_line_1 }} {{ $assignment->shipment->address->barangay }} {{ $assignment->shipment->address->city }}, {{ $assignment->shipment->address->province }}. {{ $assignment->shipment->address->zip_code }}
                                            @endif
                                        </td>
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
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Shipment Remit</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success hide" id="transactionSuccess">
                                Transaction successfully saved.
                            </div>

                            <div class="alert alert-danger hide" id="transactionError">
                                Transaction successfully saved.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered" id="shipmentReceiveTable">
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
                                <tr id="noContent">
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
                                    <h2 id="totalCOD">0.00</h2>
                                </div>
                                <div class="col-md-6 stat-item">
                                    Total Shipment
                                    <h2 id="totalShipment">0.00</h2>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-12 stat-item">
                                    <h4>Remitted COD: </h4>
                                    <span id="remittedCOD">0.00</span>
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
                                    <input type="text" placeholder="500000XXXX" id="waybillNumbersInput" class="form-control">
                                    <div id="errorContainer"></div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-12 stat-button">
                                    <button type="button" id="saveTransaction" class="btn btn-default btn-block">
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
    <div class="modal fade" id="addReturnedWaybill" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content mcontent">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Returned Shipment Remit</h4>
                </div>
                <form id="viewForm" method="post">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('waybills') ? ' has-error' : '' }}">
                                    <label for="waybills">Returned Waybill Number/s</label>

                                    <select class="form-control dataField waybill-input" name="waybills[]" id="waybills" multiple="multiple"></select>

                                    @if ($errors->has('waybills'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('waybills') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label for="status">Waybill Number/s</label>

                                    <select class="form-control dataField" name="status" id="status">
                                        <option value="returned" selected>Returned</option>
                                    </select>

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="reasonInput form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
                                    <label for="reason">Reason</label>

                                    <input type="text" id="reason" name="reason" class="form-control" />

                                    @if ($errors->has('reason'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('reason') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 error-container">

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success" id="formSubmit"><i class="fa fa-floppy-o"></i> Receive Shipment Remit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addNewWaybill" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content mcontent">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">New Shipment Remit</h4>
                </div>
                <form id="viewForm" method="post" action="/admin/receiving/rider/remit/{{ $riderId }}/new">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('waybills') ? ' has-error' : '' }}">
                                    <label for="waybills">New Waybill Number/s</label>

                                    <select class="form-control dataField waybill-input-new" name="waybills[]" id="waybills" multiple="multiple"></select>

                                    @if ($errors->has('waybills'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('waybills') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label for="status">Waybill Number/s</label>

                                    <select class="form-control dataField" name="status" id="status">
                                        <option value="arrived-at-hq" selected>Arrived at HQ</option>
                                    </select>

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 error-container">

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success" id="formSubmit"><i class="fa fa-floppy-o"></i> Receive Shipment Remit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <input type="hidden" id="riderId" value="{{ $riderId }}">
@endsection
