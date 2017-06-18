@extends('layouts.admin')

@section('stylesheets')
    <style>
        .mcontent{
            padding:15px;
        }
        .pull-right button{
            margin-right:20px;
        }
    </style>
@endsection

@section('scripts')
    <script>
        (function() {
//            $('.table thead tr.searchable th').each( function () {
//                var title = $(this).text();
//                if (title) {
//                    $(this).html( '<input type="text" style="width: 100%" placeholder="Search '+title+'" />' );
//                }
//            });
//
//            $('.table').dataTable();
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
                        <li><a href="/admin/reports">Reports</a></li>
                        <li class="active">Shipments Age</li>
                    </ol>
                </div>

                <div class="header-title pull-left">
                    <h1>Shipment Age</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <table class="table table-bordered table-hovered">
                            <thead>
                            <tr>
                                <th>Waybill Number</th>
                                <th>Arrival Date</th>
                                <th>Age</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($shipments as $shipment)
                                    <tr>
                                        <td>{{ $shipment['waybill_number'] }}</td>
                                        <td>{{ $shipment['arrival_date'] }}</td>
                                        <td>{{ $shipment['age'] }}</td>
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
