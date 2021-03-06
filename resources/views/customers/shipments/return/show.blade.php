@extends('layouts.app')

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

            $('.returned-shipment-logs-btn').on('click', function() {
                $('.loading-data').removeClass('hide');
                $('.content-data').addClass('hide');

                $('#resolutionLogs').children().remove();

                let resolutionId = $(this).data('resolution');
                let url = `/customers/shipments/returned/${resolutionId}`;

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
                        <li><a href="/customers/shipments/returned">Returned Shipments</a></li>
                        <li class="active">Shipment Details</li>
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
                    <h3>Shipment # {{ $resolution->shipment->trackingNumbers()->mainTrackingNumber($resolution->shipment->id)->tracking_number }}</h3>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <div class="col-md-6 col-xs-12">
                            <p>Shipment Status: <small class="label {{ $resolution->shipment->status === 'returned' ? 'bg-red' : 'bg-green' }}">{{ $resolution->shipment->status }}</small></p>
                            <p>Customer: <strong>{{ $resolution->shipment->user->profile->full_name }}</strong></p>
                            <p>Customer Account Id: <strong>{{ $resolution->shipment->user->account_id }}</strong></p>
                            <p>Customer Address: <strong>{{ $resolution->shipment->senderAddress->full_address_without_identifier }}</strong></p>
                            <p>Delivery Address: <strong>{{ $resolution->shipment->address->full_address_without_identifier }}</strong></p>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <p>Resolution Status:
                                @if ($resolution->status === 'resolving')
                                    <small class="label bg-orange">{{ $resolution->status }}</small>
                                @elseif ($resolution->status === 'resolved')
                                    <small class="label bg-green">{{ $resolution->status }}</small>
                                @else
                                    <small class="label bg-red">{{ $resolution->status }}</small>
                                @endif
                            </p>
                            <p>Last Updated: <strong>{{ $resolution->updated_at->toFormattedDateString() }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <h3>Messages and Actions</h3>
        <hr>
        <ul class="timeline">

            <?php $lastDate = null ?>
            @foreach ($resolution->messages as $message)

                @if ($lastDate != $message->created_at->toDateString())
                    <!-- timeline time label -->
                    <li class="time-label">
                        <span class="bg-red">
                            {{ $message->created_at->format('d M. Y') }}
                        </span>
                    </li>

                    <?php $lastDate = $message->created_at->toDateString() ?>
                @endif

                <li>
                    <!-- timeline icon -->
                    <i class="fa fa-comments bg-green"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{ $message->created_at->format('h:i A') }}</span>

                        <h3 class="timeline-header"><a href="#">{{ $message->user->user_group_id == 5 ? $message->user->profile->full_name : 'Support Team' }}</a></h3>

                        <div class="timeline-body">
                            {{ $message->message }}
                        </div>

                        <div class="timeline-footer">

                        </div>
                    </div>
                </li>
            @endforeach


        </ul>

        <div class="row" style="margin-bottom: 50px;">
            <div class="col-md-12 col-xs-12">
                <form method="POST">
                    {{ csrf_field() }}
                    <textarea class="form-control" rows="3" name="message"></textarea>
                    <button type="submit" class="btn btn-default pull-right">Send Message</button>
                </form>
            </div>
        </div>

    </div>

@endsection