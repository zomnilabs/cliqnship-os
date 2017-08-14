@extends('layouts.admin')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/wizard.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <style>
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

            // Select 2
            $(".waybill-input").select2({
                tags: true,
                tokenSeparators: [',', ' '],
                placeholder: "Input waybill number/s",
                allowClear: true
            }).on('change', function(value) {
                let waybills = $(this).val();
                let newValue = waybills[waybills.length - 1];

                if (! newValue) {
                    return;
                }

                fetch(`/api/web/shipments/check/${newValue}?status=arrived-at-hq`).then((res) => {
                    if (! res.ok) {
                        res.json().then((json) => {

                            let html = `<p><span class="text-danger">${newValue}</span> : ${json}</p>`;
                            $('.error-container').append(html);
                        });

                        return;
                    }
                }).catch((error) => {
                    let html = `<p><span class="text-danger">${newValue}</span> is not a valid waybill</p>`;
                    $('.error-container').append(html);
                });
            });

            // modal
            $('#addRiderAssignment').on('hidden.bs.modal', function() {
                $('.error-container').html('');
                $('.waybill-input').val(null).trigger('change');
            });
        }())
    </script>

    <script>
        (function() {
            let shipmentDetails = $('#shipmentDetails');
            let shipmentLoader  = $('#shipmentLoader');
            let shipmentContent = $('#shipmentContent');
            let shipmentReturnLogs = $('#shipmentReturnLogs').DataTable();
            let shipmentEvents = $('#shipmentEvents').DataTable();

            // events
            shipmentDetails.on('hidden.bs.modal', function(e) {
                shipmentLoader.removeClass('hide');
                shipmentContent.addClass('hide');

                shipmentReturnLogs.clear().draw();
                shipmentEvents.clear().draw();
                $('#myTabs a:first').tab('show');
            });

            $('.view-shipment-details').on('click', function() {
                let shipmentId = $(this).data('shipment');

                getShipmentDetails(shipmentId);
            });

            // functions
            function getShipmentDetails(shipmentId) {
                axios.get(`/api/web/shipments/${shipmentId}`).then((response) => {
                    console.log(response.data);
                    let shipment = response.data;

                    buildReturnLogs(shipment.return_logs);
                    buildEvents(shipment.events);

                    shipmentLoader.addClass('hide');
                    shipmentContent.removeClass('hide');
                }).catch(error => console.log(error));
            }

            function buildReturnLogs(items) {
                for (let item of items) {
                    shipmentReturnLogs.row.add([
                        `${item.user.profile.first_name} ${item.user.profile.last_name}`,
                        `${item.reason}`,
                        `${item.created_at}`,
                        `${item.status}`
                    ]).draw( false );
                }
            }

            function buildEvents(items) {
                for (let item of items) {
                    shipmentEvents.row.add([
                        `${item.user.profile.first_name} ${item.user.profile.last_name}`,
                        `${item.event_source}`,
                        `${item.event}`,
                        `${item.value}`,
                        `${item.remarks}`,
                        `${item.created_at}`
                    ]).draw( false );
                }
            }
        })()
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
                    <h1>Dispatching Shipments</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row text-center cards">
                    <div class="col-md-3">
                        <a href="?status=unassigned">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Unassigned Shipments</h4>
                                    <h1>{{ $pendingShipment }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="?status=assigned">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Assigned Shipments</h4>
                                    <h1>{{ $assignedShipment }}</h1>
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
                            <h1>{{ $status }} Shipments</h1>
                        </div>
                        <div class="page-actions pull-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addRiderAssignment">
                                <i class="fa fa-plus"></i>
                                Add shipment Assignment</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="hide">Shipment Id</th>
                                <th>Tracking #</th>
                                <th>From</th>
                                <th>Delivery Address</th>
                                <th>Service Type</th>
                                <th>Services Add-Ons</th>
                                <th>Remarks</th>
                                <th>Source</th>
                                <th>Rider</th>
                                <th>Arrival Date</th>
                                <th>Status</th>
                                {{--<th>Actions</th>--}}
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($shipments as $shipment)
                                <tr id="shipment-{{$shipment->id}}">
                                    <td class="hide">{{$shipment->id}}</td>
                                    <td>
                                        <a href="#" class="view-shipment-details" data-shipment="{{ $shipment->id }}" data-toggle="modal" data-target="#shipmentDetails">
                                            {{$shipment->trackingNumbers()->mainTrackingNumber($shipment->id)->tracking_number}}
                                        </a>
                                    </td>
                                    <td>{{$shipment->user->profile->first_name}} {{$shipment->user->profile->middle_name}} {{$shipment->user->profile->last_name}}</td>
                                    <td>
                                        @if ($shipment->address)
                                            {{ $shipment->address->address_line_1 }} {{ $shipment->address->barangay }} {{ $shipment->address->city }}, {{ $shipment->address->province }}. {{ $shipment->address->zip_code }}
                                        @endif
                                    </td>
                                    <td>{{ $shipment->service_type }}</td>
                                    <td>
                                        @if ($shipment->collect_and_deposit)
                                            <p>Collect And Deposit</p>
                                        @endif

                                        @if ($shipment->insurance_declared_value)
                                            <p>Insurance declared value</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($shipment->remarks)
                                            @foreach ($shipment->remarks as $remark)
                                                <li>{{ $remark->reason }}</li>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ ucwords($shipment->source->name) }}</td>
                                    <th>{{ $shipment->rider->user->profile->full_name or 'Not Assigned' }}</th>
                                    <td>{{ $shipment->events()->where('value', 'arrived-at-hq')->first()->created_at->format('F d, Y H:i A') }}</td>
                                    <td>{{ $shipment->status }}</td>
                                    {{--<th>--}}
                                        {{--<button class="btn btn-danger"><i class="fa fa-trash"></i></button>--}}
                                        {{--<button class="btn btn-default"><i class="fa fa-edit"></i></button>--}}
                                    {{--</th>--}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        @include('admin.shipments.modals.info')
        @include('admin.dispatching.shipments.modals.dispatch-assignment')
    </div>
@endsection