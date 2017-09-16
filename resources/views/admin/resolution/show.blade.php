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
                        <li><a href="/admin">Dashboard</a></li>
                        <li class="active"><a href="/admin/resolutions">Resolution Center</a></li>
                        <li class="active">Shipment Details</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Resolving Problematic Shipment</h1>
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
                    <h3>Shipment # {{ $resolution->shipment->trackingNumbers()->mainTrackingNumber($resolution->shipment->id)->tracking_number }}</h3>
                </div>
                <div class="pull-right">
                    <div class="btn-group" style="margin-top: 25px;">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#">Update Shipment Information</a></li>
                            <li><a href="#">Re-dispatch Shipment</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <div class="col-md-6 col-xs-12">
                            <p>Shipment Status: <small class="label bg-red">{{ $resolution->shipment->status }}</small></p>
                            <p>Customer: <strong>{{ $resolution->shipment->user->profile->full_name }}</strong></p>
                            <p>Customer Account Id: <strong>{{ $resolution->shipment->user->account_id }}</strong></p>
                            <p>Customer Address: <strong>{{ $resolution->shipment->senderAddress->full_address_without_identifier }}</strong></p>
                            <p>Delivery Address: <strong>{{ $resolution->shipment->address->full_address_without_identifier }}</strong></p>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <p>Resolution Status: <small class="label bg-red">{{ $resolution->status }}</small></p>
                            <p>Last Updated: <strong>{{ $resolution->updated_at->toFormattedDateString() }}</strong></p>
                        </div>
                    </div>
                </div>

                {{--<table class="table table-bordered" id="tableResolution">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th class="hide">Shipment #</th>--}}
                        {{--<th>Tracking #</th>--}}
                        {{--<th>Customer</th>--}}
                        {{--<th>Delivery Address</th>--}}
                        {{--<th>Reason</th>--}}
                        {{--<th>Returned Times</th>--}}
                        {{--<th>Status</th>--}}
                        {{--<th>Actions</th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}

                    {{--<tbody>--}}
                    {{--@foreach($shipments as $shipment)--}}
                        {{--<tr id="shipment-{{$shipment->shipment->id}}">--}}
                            {{--<td class="hide">{{$shipment->shipment->id}}</td>--}}
                            {{--<td>{{ $shipment->shipment->trackingNumbers()->mainTrackingNumber($shipment->shipment->id)->tracking_number}}</td>--}}
                            {{--<td>{{ $shipment->shipment->user->profile->first_name}} {{$shipment->shipment->user->profile->middle_name}} {{$shipment->shipment->user->profile->last_name}}</td>--}}
                            {{--<td>--}}
                                {{--@if ($shipment->shipment->address)--}}
                                    {{--{{ $shipment->shipment->address->address_line_1 }} {{ $shipment->shipment->address->barangay }} {{ $shipment->shipment->address->city }}, {{ $shipment->shipment->address->province }}. {{ $shipment->shipment->address->zip_code }}--}}
                                {{--@endif--}}
                            {{--</td>--}}
                            {{--<td>{{ $shipment->logs()->first()->reason }}</td>--}}
                            {{--<td>{{ $shipment->shipment->returnLogs()->orderBy('created_at', 'DESC')->count() }}</td>--}}
                            {{--<td>{{ $shipment->status }}</td>--}}
                            {{--<td>--}}
                                {{--<button class="btn btn-default" id="returnShipmentBtn"--}}
                                {{--data-shipment="{{ $shipment->shipment->id }}" data-toggle="modal" data-target="#returnShipment" >--}}
                                {{--<i class="fa fa-refresh"></i></button>--}}

                                {{--<button class="btn btn-default returned-shipment-logs-btn" id="returnShipmentLogsBtn"--}}
                                {{--data-resolution="{{ $shipment->id }}"--}}
                                {{--data-shipment="{{ $shipment->shipment->id }}" data-toggle="modal" data-target="#returnShipmentLogs" >--}}
                                {{--<i class="fa fa-eye"></i></button>--}}

                                {{--<a href="" class="btn btn-default"><i class="fa fa-eye"></i></a>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <h3>Messages and Actions</h3>
        <hr>
        <ul class="timeline">

            <!-- timeline time label -->
            <li class="time-label">
                        <span class="bg-red">
                            10 Feb. 2014
                        </span>
            </li>
            <!-- /.timeline-label -->

            <!-- timeline item -->
            <li>
                <!-- timeline icon -->
                <i class="fa fa-comments bg-green"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                    <h3 class="timeline-header"><a href="#">Support Team</a></h3>

                    <div class="timeline-body">
                        We can't locate the address specified on the shipment, please double check
                    </div>

                    <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">...</a>
                    </div>
                </div>
            </li>
        </ul>

        <div style="margin-bottom: 50px;">
            <form action="" method="POST">
                <textarea class="form-control" rows="3"></textarea>
                <button class="btn btn-default pull-right">Send Message</button>
            </form>
        </div>

    </div>
@endsection