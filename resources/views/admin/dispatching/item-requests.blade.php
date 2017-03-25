@extends('layouts.admin')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/wizard.css') }}">
@endsection

@section('scripts')
    <script>
        (function() {
            $('.table tfoot tr.searchable td').each( function () {
                let title = $(this).text();
                if (title) {
                    switch (title) {
                        default:
                            $(this).html( '<input class="form-control filter" type="text" style="width: 100%" placeholder="Search '+title+'" />' );
                    }
                }
            });

            let table = $('.table').DataTable();

            // Apply the search
            table.columns().every( function () {
                let that = this;
                $( '.filter', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        console.log(that.data());
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
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
                        <li class="active">Item Request Dispatching</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Item Request Dispatching</h1>
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
                            <h1>Item Requests</h1>
                        </div>
                        <div class="page-actions pull-right">
                            <button class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Add Item Request Assignment</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tfoot class="filter-footer">
                            <tr class="searchable">
                                <td>Id #</td>
                                <td>Address</td>
                                <td>Size</td>
                                <td>Quantity</td>
                                <td>Source Type</td>
                                <td></td>
                            </tr>
                            </tfoot>
                            <thead>
                            <tr>
                                <th>Id #</th>
                                <th>Address</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Source Type</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($itemRequests as $itemRequest)
                                <tr>
                                    <td>{{ $itemRequest->id }}</td>
                                    <td>{{ $itemRequest->address->getFullAddress() }}</td>
                                    <td>{{ $itemRequest->size }}</td>
                                    <td>{{ $itemRequest->quantity }}</td>
                                    <td>{{ $itemRequest->source->name or ''}}</td>
                                    <td>
                                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        <button class="btn btn-default"><i class="fa fa-edit"></i></button>
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