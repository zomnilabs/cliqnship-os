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
            $('.table thead tr.searchable th').each( function () {
                var title = $(this).text();
                if (title) {
                    $(this).html( '<input type="text" style="width: 100%" class="form-control" placeholder="Search '+title+'" />' );
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
                        <li><a href="/customers">Dashboard</a></li>
                        <li class="active">Addressbooks</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Addressbooks</h1>
                </div>

                <div class="page-actions pull-right">
                    <button data-toggle="modal" data-target=".bs-modal-lg" class="btn btn-primary">
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
                            <thead>
                            <tr class="searchable">
                                <th class="hide">Id #</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Address Type</th>
                                <th>Address</th>
                                <th>Contact #</th>
                                <th>Email Address</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th class="hide">Id #</th>
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
                                        <td class="hide">{{$addressbook->id}}</td>
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

    <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content mcontent">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-header text-center">
                    <h4 class="modal-title" id="gridSystemModalLabel">Create Address Book</h4>
                </div><br/>
                <form method="POST" action="/customers/addressbooks" >
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('identifier') ? ' has-error' : '' }}">
                                <label for="Identifier">Identifier</label>
                                <input type="text" class="form-control" name="identifier" id="identifier" required/>
                                @if ($errors->has('identifier'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('identifier') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="Type">Type</label>
                                <select name="type" class="form-control" id="type">
                                    <option value="booking">Booking</option>
                                    <option value="shipmemt">Shipment</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class0.="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" required/>
                                 @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" required/>
                                 @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" id="middle_name" required/>
                                 @if ($errors->has('middle_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('middle_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
                                <label for="contact_number">Contact Number</label>
                                <input type="text" class="form-control" name="contact_number" id="contact_number" required/>
                                 @if ($errors->has('contact_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email" required/>
                                 @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('address_line_1') ? ' has-error' : '' }}">
                                <label for="address_line_1">Address Line 1</label>
                                <input type="text" class="form-control" name="address_line_1" id="address_line_1" required/>
                                 @if ($errors->has('address_line_1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_line_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('address_line_2') ? ' has-error' : '' }}">
                                <label for="address_line_2">Address Line 2</label>
                                <input type="text" class="form-control" name="address_line_2" id="address_line_2"/>
                                 @if ($errors->has('address_line_2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_line_2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('barangay') ? ' has-error' : '' }}">
                                <label for="barangay">Barangay</label>
                                <input type="text" class="form-control" name="barangay" id="barangay" required/>
                                 @if ($errors->has('barangay'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('barangay') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" id="city" required/>
                                 @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('province') ? ' has-error' : '' }}">
                                <label for="province">Province</label>
                                <input type="text" class="form-control" name="province" id="province" required/>
                                 @if ($errors->has('province'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('province') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" name="country" id="country" required/>
                                 @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                                <label for="zip_code">Zipcode</label>
                                <input type="text" class="form-control" name="zip_code" id="zip_code" required/>
                                 @if ($errors->has('zip_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zip_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('landmarks') ? ' has-error' : '' }}">
                                <label for="landmarks">Landmarks</label>
                                <input type="text" class="form-control" name="landmarks" id="landmarks" required/>
                                 @if ($errors->has('landmarks'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('landmarks') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('address_type') ? ' has-error' : '' }}">
                                <label for="address_type">Address Type</label>
                                <select name="address_type" class="form-control" id="address_type">
                                    <option value="residential">Resedential</option>
                                    <option value="office">Office</option>
                                </select>
                                @if ($errors->has('address_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="primary">Is this your primary address?</label>
                                <input type="checkbox" value="1" id="primary" name="primary"/>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="pull-right">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
