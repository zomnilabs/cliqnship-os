@extends('layouts.admin')

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
                        <li class="active">Receiving</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Receiving</h1>
                </div>

                <div class="page-actions pull-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createShippingModal">
                        <i class="fa fa-plus"></i>
                        Import Shipments Receiving</button>

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
                            <h1>Rider</h1>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="hide">Id #</th>
                                <th>Name</th>
                                <th>Shipments Assigned</th>
                                <th>Shipments Remitted Today</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($riders as $rider)
                                    <tr>
                                        <td class="hide">{{ $rider->id }}</td>
                                        <td>{{ $rider->profile->full_name }}</td>
                                        <td>{{ $rider->pending }}</td>
                                        <td>{{ $rider->completed_today }}</td>
                                        <td>
                                            <a href="/admin/receiving/rider/remit" class="btn btn-default"><i class="fa fa-search"></i> Remit</a>
                                        </td>
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