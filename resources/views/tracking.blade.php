@extends('layouts.front')

@section('stylesheets')
    <style>
        .box.box-primary {
            border-top-color: #3c8dbc;
        }
        .box {
            position: relative;
            border-radius: 3px;
            background: #ffffff;
            border-top: 3px solid #d2d6de;
            border-top-color: rgb(210, 214, 222);
            margin-bottom: 20px;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        }
        .box-header {
            color: #444;
            display: block;
            padding: 10px;
            position: relative;
        }
        .box-body {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
            padding: 10px;
        }
        .bg-red {
            background-color: #dd4b39 !important;
        }
        .bg-green {
            background-color: #00a65a !important;
        }
        .bg-orange {
            background-color: #ff851b !important;
        }

    </style>
@endsection

@section('content')

<header id="tracking">
    <div class="container">
        <div class="intro-text">
        </div>
    </div>
</header>

@if (! $shipment)
    <section style="min-height: 100vh;padding: 60px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">
                    <h2 class="section-heading text-center">TRACKING</h2>
                </div>
            </div>

            <div class="container-fluid">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title">

                        </div>
                    </div>
                    <div class="box-body">
                        <h1>No shipment found</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    <section style="min-height: 100vh;padding: 60px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">
                    <h2 class="section-heading text-center">TRACKING</h2>
                </div>
            </div>

            <div class="container-fluid">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title">
                            <h3>Shipment # {{ $shipment->trackingNumbers()->mainTrackingNumber($shipment->id)->tracking_number }}</h3>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div class="col-md-6 col-xs-12">
                                    <p>Shipment Status: <small class="label {{ $shipment->status === 'returned' ? 'bg-red' : 'bg-green' }}">{{ $shipment->status }}</small></p>
                                    <p>Customer: <strong>{{ $shipment->user->profile->full_name }}</strong></p>
                                </div>

                                {{--<div class="col-md-6 col-xs-12">--}}
                                    {{--<p>Resolution Status:--}}
                                        {{--@if ($status === 'resolving')--}}
                                            {{--<small class="label bg-orange">{{ $status }}</small>--}}
                                        {{--@elseif ($status === 'resolved')--}}
                                            {{--<small class="label bg-green">{{ $status }}</small>--}}
                                        {{--@else--}}
                                            {{--<small class="label bg-red">{{ $status }}</small>--}}
                                        {{--@endif--}}
                                    {{--</p>--}}
                                    {{--<p>Last Updated: <strong>{{ $updated_at->toFormattedDateString() }}</strong></p>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">

                        @foreach ($events as $event)
                            <li class="timeline-inverted">
                                <div class="timeline-image">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>{{ $event['date'] }}</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <h4 class="text-muted"><span class="label bg-red">{{ strtoupper($event['value']) }}</span></h4>
                                        <p class="text-muted">{{ ucfirst($event['remarks']) }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endif


<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <span class="copyright">Clinship All rights reserved</span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-inline quicklinks">
                    <li><a href="terms-and-conditions">Terms and Conditions</a>
                    </li>
                    <li><a href="faqs">FAQS</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

@endsection
