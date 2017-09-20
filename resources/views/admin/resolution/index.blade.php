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
            $('#tableResolution thead tr.searchable th').each( function () {
                var title = $(this).text();
                if (title) {
                    $(this).html( '<input type="text" style="width: 100%" placeholder="Search '+title+'" />' );
                }
            });

            $('#tableResolution').dataTable();

            $('#returnShipmentBtn').click(function(){
                id = $(this).attr('data-shipment');
                action = '/admin/dispatching/shipments/returned/'+ id +'/redispatch';
                $('#redispatch-form').attr('action', action);
            });

            $('#returnShipmentLogs').on('shown.bs.modal', function() {
//                $('.loading-data').removeClass('hide');
            });

            $('.returned-shipment-logs-btn').on('click', function() {
                $('.loading-data').removeClass('hide');
                $('.content-data').addClass('hide');

                $('#resolutionLogs').children().remove();

                let resolutionId = $(this).data('resolution');
                let url = `/admin/resolutions/shipments/returned/${resolutionId}`;

                axios.get(url).then((response) => {
                    console.log(response.data);

                    for (let log of response.data) {
                        addToTable(log);
                    }

                    $('.content-data').removeClass('hide');
                    $('.loading-data').addClass('hide');
                });
            });

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

                fetch(`/api/web/resolutions/check/${newValue}`).then((res) => {
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

            function addToTable(log) {
                let html = '<tr>';
                    html += `<td>${log.user.profile.first_name} ${log.user.profile.last_name}</td>`;
                    html += `<td>${log.user.user_group.name}</td>`;
                    html += `<td>${log.reason}</td>`;
                    html += `<td>${log.created_at}</td>`;
                    html += '</tr>';

                $('#resolutionLogs').append(html);
            }

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
                        <li class="active">Resolution Center</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Resolving Problematic Shipments</h1>
                </div>

                <div class="page-actions pull-right">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row text-center cards">
                    <div class="col-md-3">
                        <a href="?status=unresolved">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Unresolved Issues</h4>
                                    <h1>{{ $unresolved }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="?status=resolving">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Resolving Issues</h4>
                                    <h1>{{ $resolving }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="?status=resolved">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Resolved Issues</h4>
                                    <h1>{{ $resolved }}</h1>
                                </div>
                            </div>
                        </a>
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

                <div class="box-title pull-right">
                    <button class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#createRTS"
                            style="margin-top: 30px">Create an RTS Shipment</button>
                </div>

            </div>
            <div class="box-body">
                <table class="table table-bordered" id="tableResolution">
                    <thead>
                    <tr>
                        <th class="hide">Shipment #</th>
                        <th>Tracking #</th>
                        <th>Customer</th>
                        <th>Delivery Address</th>
                        <th>Last Reason</th>
                        <th>Returned Times</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($shipments as $resolution)
                        <tr id="shipment-{{$resolution->shipment->id}}">
                            <td class="hide">{{$resolution->shipment->id}}</td>
                            <td>{{ $resolution->shipment->trackingNumbers()->mainTrackingNumber($resolution->shipment->id)->tracking_number }}</td>
                            <td>{{ $resolution->shipment->user->profile->first_name}} {{$resolution->shipment->user->profile->middle_name}} {{$resolution->shipment->user->profile->last_name}}</td>
                            <td>
                                @if ($resolution->shipment->address)
                                    {{ $resolution->shipment->address->address_line_1 }} {{ $resolution->shipment->address->barangay }} {{ $resolution->shipment->address->city }}, {{ $resolution->shipment->address->province }}. {{ $resolution->shipment->address->zip_code }}
                                @endif
                            </td>
                            <td>{{ $resolution->logs()->first()->reason }}</td>
                            <td>{{ $resolution->logs()->count() }}</td>
                            <td>{{ $resolution->status }}</td>
                            <td>
                                {{--<button class="btn btn-default" id="returnShipmentBtn"--}}
                                        {{--data-shipment="{{ $shipment->shipment->id }}" data-toggle="modal" data-target="#returnShipment" >--}}
                                    {{--<i class="fa fa-refresh"></i></button>--}}

                                {{--<button class="btn btn-default returned-shipment-logs-btn" id="returnShipmentLogsBtn"--}}
                                        {{--data-resolution="{{ $shipment->id }}"--}}
                                        {{--data-shipment="{{ $shipment->shipment->id }}" data-toggle="modal" data-target="#returnShipmentLogs" >--}}
                                    {{--<i class="fa fa-eye"></i></button>--}}

                                <a href="/admin/resolutions/{{ $resolution->id }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.resolution.modals.create-rts')
@endsection