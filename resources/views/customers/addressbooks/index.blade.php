@extends('layouts.app')

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
            $('.table tfoot tr.searchable td').each( function () {
                let title = $(this).text();
                if (title) {
                    switch (title) {
                        case 'Type':
                            let selectHTML = '<select class="form-control filter-type" style="width: 100%">';
                            selectHTML += '<option>Filter Type</option>';
                            selectHTML += '<option value="booking">Booking</option>';
                            selectHTML += '<option value="shipment">Shipment</option>';
                            selectHTML += '</select>';

                            $(this).html(selectHTML);

                            break;
                        case 'Address Type':
                            let selectHTML2 = '<select class="form-control filter" style="width: 100%">';
                            selectHTML2 += '<option>Filter Address Type</option>';
                            selectHTML2 += '<option value="office">Office</option>';
                            selectHTML2 += '<option value="residential">Residential</option>';
                            selectHTML2 += '</select>';

                            $(this).html(selectHTML2);
                            break;
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
                        <li><a href="/customers">Dashboard</a></li>
                        <li class="active">Addressbooks</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Addressbooks</h1>
                </div>

                <div class="page-actions pull-right">
                    <button data-toggle="modal" data-target="#createAddressbookModal" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        New Addressbooks</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('components.errors')

                        <table class="table table-bordered">
                            <tfoot class="filter-footer">
                                <tr class="searchable">
                                    <td>Id #</td>
                                    <td>Name</td>
                                    <td>Type</td>
                                    <td>Address Type</td>
                                    <td>Address</td>
                                    <td>Contact #</td>
                                    <td>Email Address</td>
                                    <td></td>
                                </tr>
                            </tfoot>

                            <thead>
                                <tr>
                                    <th>Id #</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Address Type</th>
                                    <th>Address</th>
                                    <th>Contact #</th>
                                    <th>Email Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($addressbooks as $addressbook)
                                    <tr id="addressbook-{{$addressbook->id}}">
                                        <td>{{$addressbook->id}}</td>
                                        <td>{{$addressbook->last_name}} {{$addressbook->middle_name}} {{$addressbook->last_name}}</td>
                                        <td>{{ ucwords($addressbook->type) }}</td>
                                        <td>{{ ucwords($addressbook->address_type) }}</td>
                                        <th>{{$addressbook->address_line_1}}</th>
                                        <th>{{$addressbook->contact_number}}</th>
                                        <th>{{$addressbook->email}}</th>
                                        <th>
                                            <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                            <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></button>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('customers.addressbooks.modals.create');
@endsection
