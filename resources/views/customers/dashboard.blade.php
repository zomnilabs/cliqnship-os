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

        .navbar-default {
            border-color: #434343;
        }

        .white-text {
            color: #fdfdfd !important;
        }

        .panel-body-danger {
            background-color: #ea435e;
        }

        .panel-body-pending {
            background-color: #eac976;
        }

        .panel-body-enroute {
            background-color: #688bea;
        }

        .panel-body-completed {
            background-color: #7bea88;
        }

        .panel-body-wallet {
            background-color: #ead756;
        }

        .stats {
            position: relative;
            min-height: 130px;
        }

        .stats-label {
            background-color: #494949;
            padding: 10px 20px;
            width: 100%;
            position: absolute;
            left: 0;
            bottom: 0;
            margin: 0;
            font-size: 1em;
        }

        .stats-value {
            margin-top: 5px !important;
        }
    </style>
@endsection

@section('scripts')
    <script>
        let BASE_URL = 'http://localhost:8000/';

        (function() {
            axios.get(`${BASE_URL}/customers/reports/shipments/per-month`)
                .then((response) => {
                    console.log('response', response.data);

                    let ctx = document.getElementById('shipmentsChart');

                    let data = {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                        datasets: [
                            {
                                label: "Returned Shipments",
                                fill: false,
                                lineTension: 0.1,
                                backgroundColor: "#ea435e",
                                borderColor: "#ea435e",
                                borderCapStyle: 'butt',
                                borderDash: [],
                                borderDashOffset: 0.0,
                                borderJoinStyle: 'miter',
                                pointBorderColor: "#ea2844",
                                pointBackgroundColor: "#fff",
                                pointBorderWidth: 1,
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: "#ea435e",
                                pointHoverBorderColor: "#ea435e",
                                pointHoverBorderWidth: 2,
                                pointRadius: 1,
                                pointHitRadius: 10,
                                data: response.data.success,
                                spanGaps: false,
                            },
                            {
                                label: "Completed Shipments",
                                fill: false,
                                lineTension: 0.1,
                                backgroundColor: "#7bea88",
                                borderColor: "#7bea88",
                                borderCapStyle: 'butt',
                                borderDash: [],
                                borderDashOffset: 0.0,
                                borderJoinStyle: 'miter',
                                pointBorderColor: "#51ea65",
                                pointBackgroundColor: "#fff",
                                pointBorderWidth: 1,
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: "#7bea88",
                                pointHoverBorderColor: "#7bea88",
                                pointHoverBorderWidth: 2,
                                pointRadius: 1,
                                pointHitRadius: 10,
                                data: response.data.returned,
                                spanGaps: false,
                            }
                        ]
                    };

                    let shipmentsChart = new Chart(ctx, {
                        type: 'line',
                        data: data,
                        options: {
                            scales: {
                                yAxes: [{
                                    stacked: true
                                }]
                            },
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                });
        }());
    </script>

    <script>
        (function() {
            axios.get(`${BASE_URL}/customers/reports/shipments/top-five-clients`)
                .then((response) => {
                    console.log('response', response.data);

                    let ctx = document.getElementById('shipmentsChartByAddress');

                    let data = {
                        labels: response.data.customers,
                        datasets: [
                            {
                                data: response.data.counts,
                                backgroundColor: [
                                    "#FF6384",
                                    "#36A2EB",
                                    "#FFCE56",
                                    "#78b849",
                                    "#54cac8"
                                ],
                                hoverBackgroundColor: [
                                    "#FF6384",
                                    "#36A2EB",
                                    "#FFCE56",
                                    "#78b849",
                                    "#54cac8"
                                ]
                            }]
                    };

                    let shipmentsChart = new Chart(ctx, {
                        type: 'pie',
                        data: data,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                });
        }());
    </script>

    <script>
        (function() {
            let ctx = document.getElementById('shipmentsChartWithCod');

            let data = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "My First dataset",
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        data: [65, 59, 80, 81, 56, 55, 40],
                    }
                ]
            };

            let shipmentsChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }());
    </script>

    @if (! $withPrimaryAddress)
    <script>
        $(function() {
            $('#createAddressbookModal').modal('show');
        });
    </script>
    @endif
@endsection

@section('content')
    @include('customers.primary-addressbook-modal')
    <div class="header-info container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row text-center cards">
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body panel-body-pending white-text stats">
                                    <h1 class="stats-value">{{ $counts['pendingBookings'] }}</h1>
                                    <h4 class="stats-label">Pending Pickup/Bookings</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body panel-body-pending white-text stats">
                                    <h1 class="stats-value">{{ $counts['pendingShipments'] }}</h1>
                                    <h4 class="stats-label">Pending Shipments</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body panel-body-enroute white-text stats">
                                    <h1 class="stats-value">{{ $counts['enRouteShipments'] }}</h1>
                                    <h4 class="stats-label">En-Route Shipments</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body panel-body-completed white-text stats">
                                    <h1 class="stats-value">{{ $counts['completedShipments'] }}</h1>
                                    <h4 class="stats-label">Completed Shipments</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-danger">
                                <div class="panel-body panel-body-danger white-text stats">
                                    <h1 class="stats-value">{{ $counts['returnedShipments'] }}</h1>
                                    <h4 class="stats-label">Returned Shipments</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <div class="panel panel-default">
                                <div class="panel-body panel-body-wallet white-text stats">
                                    <h1 class="stats-value">P {{ $counts['codAmount'] or '0' }}</h1>
                                    <h4 class="stats-label">Collected COD</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Shipments Monthly Overview - {{ Carbon\Carbon::today()->year }}</h5>
                    </div>
                    <div class="panel-body">
                        <canvas id="shipmentsChart" width="200" height="300"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Top Shipment Count / Address</h5>
                    </div>
                    <div class="panel-body">
                        <div style="height: 300px; width: 100%">
                            <canvas id="shipmentsChartByAddress"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2>Recently updated shipments</h2>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Waybill #</th>
                                    <th>Remarks</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shipments as $shipment)
                                    <tr>
                                        <td>{{ $shipment->trackingNumbers[0]->tracking_number }}</td>
                                        <td>
                                            @foreach($shipment->remarks as $r)
                                                {{ $r->remarks }},
                                            @endforeach
                                        </td>
                                        <td>{{ ucwords($shipment->status) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2>Shipments With Collect & Deposit Service</h2>

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Booking Number</th>
                                <th>Item Description</th>
                                <th>Service Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cods as $shipment)
                                <tr>
                                    <td>{{ $shipment->trackingNumbers[0]->tracking_number }}</td>
                                    <td>{{ $shipment->item_description }}</td>
                                    <td>{{ ucwords($shipment->service_type) }}</td>
                                    <td>
                                        {{ $shipment->cod->collect_and_deposit_amount }}
                                    </td>
                                    <td>{{ ucwords($shipment->status) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
