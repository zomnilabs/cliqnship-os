@extends('layouts.admin')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/wizard.css') }}">
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
                        <li><a href="/customers">Dashboard</a></li>
                        <li class="active">Returned Shipments</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Returned Shipments</h1>
                </div>

                <div class="page-actions pull-right">
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

            </div>
            <div class="box-body">
                <table class="table table-bordered" id="tableResolution">
                    <thead>
                    <tr>
                        <th class="hide">Shipment #</th>
                        <th>Tracking #</th>
                        <th>Delivery Address</th>
                        <th>Reason</th>
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
                            <td>
                                @if ($resolution->shipment->address)
                                    {{ $resolution->shipment->address->address_line_1 }} {{ $resolution->shipment->address->barangay }} {{ $resolution->shipment->address->city }}, {{ $resolution->shipment->address->province }}. {{ $resolution->shipment->address->zip_code }}
                                @endif
                            </td>
                            <td>{{ $resolution->logs()->first()->reason }}</td>
                            <td>{{ $resolution->shipment->returnLogs()->orderBy('created_at', 'DESC')->count() }}</td>
                            <td>{{ $resolution->status }}</td>
                            <td>
                                {{--<button class="btn btn-default" id="returnShipmentBtn"--}}
                                {{--data-shipment="{{ $shipment->shipment->id }}" data-toggle="modal" data-target="#returnShipment" >--}}
                                {{--<i class="fa fa-refresh"></i></button>--}}

                                {{--<button class="btn btn-default returned-shipment-logs-btn" id="returnShipmentLogsBtn"--}}
                                {{--data-resolution="{{ $shipment->id }}"--}}
                                {{--data-shipment="{{ $shipment->shipment->id }}" data-toggle="modal" data-target="#returnShipmentLogs" >--}}
                                {{--<i class="fa fa-eye"></i></button>--}}

                                <a href="/customers/shipments/returned/{{ $resolution->id }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection