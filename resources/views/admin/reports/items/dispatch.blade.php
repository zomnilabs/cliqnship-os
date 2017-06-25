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
                    <h1>Dispatching</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="row">
                            <form action="" method="GET">
                                <div class="col-md-6">
                                    <select name="user_id" class="form-control" id="rider">
                                        <option value="0">All Rider</option>
                                        @foreach ($riders as $rider)
                                            <option value="{{ $rider->id }}">{{ $rider->profile->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-5">
                                    <input type="date" class="form-control" name="date">
                                </div>

                                <div class="col-md-1">
                                    <button class="btn btn-block btn-primary">Filter</button>
                                </div>
                            </form>
                        </div>

                        <hr>

                        <table class="table table-bordered table-hovered">
                            <thead>
                                <tr>
                                    <th>Rider Name</th>
                                    <th>Assigned Shipments</th>
                                    <th>New Shipments</th>
                                    <th>Delivered Shipments</th>
                                    <th>Returned Shipments</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($result as $rider)
                                <tr>
                                    <td>{{ $rider->profile->full_name }}</td>
                                    <td>{{ $rider->assignments->count() }}</td>
                                    <td>{{ $rider->assignments->where('status', 'completed')->where('action', 'new')->count() }}</td>
                                    <td>{{ $rider->assignments->where('status', 'completed')->where('action', 'delivered')->count() }}</td>
                                    <td>{{ $rider->assignments->where('status', 'completed')->where('action', 'returned')->count() }}</td>
                                    <td></td>
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
