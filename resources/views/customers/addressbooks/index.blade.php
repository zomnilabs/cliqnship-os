@extends('layouts.app')

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
                    <button class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        New Addressbooks</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id #</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact #</th>
                                <th>Email Address</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Edward Lim</td>
                                <th>Talaga, Capas, Tarlac</th>
                                <th>09123456789</th>
                                <th>edward@gmail.com</th>
                                <th>active</th>
                                <th>
                                    <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                    <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></button>
                                </th>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Jackilyn Damulag</td>
                                <th>San Miguel, Tarlac</th>
                                <th>09993456789</th>
                                <th>jackilyn@gmail.com</th>
                                <th>active</th>
                                <th>
                                    <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                    <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></button>
                                </th>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>John Castro</td>
                                <th>Concepcion, Tarlac</th>
                                <th>09323456789</th>
                                <th>john@gmail.com</th>
                                <th>active</th>
                                <th>
                                    <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                    <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></button>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Filters</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="GET">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12">Identifier</label>

                                        <div class="col-md-6">
                                            <select name="filter_addressbook_no_operation" class="form-control">
                                                <option value="equals" {{ old('filter_identifier_no_operation') === 'equals' ? 'selected' : '' }}>Equals</option>
                                                <option value="contains" {{ old('filter_identifier_no_operation') === 'contains' ? 'selected' : '' }}>Contains</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <input id="booking_no" type="text" class="form-control" name="filter_booking_no_term" value="{{ old('filter_booking_no_operation') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12">City</label>

                                        <div class="col-md-6">
                                            <select name="filter_city_operation" class="form-control">
                                                <option value="equals" {{ old('filter_city_operation') === 'equals' ? 'selected' : '' }}>Equals</option>
                                                <option value="contains" {{ old('filter_city_operation') === 'contains' ? 'selected' : '' }}>Contains</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <input id="city" type="text" class="form-control" name="filter_city_term" value="{{ old('filter_city_term') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12">Province</label>

                                        <div class="col-md-6">
                                            <select name="filter_province_operation" class="form-control">
                                                <option value="equals" {{ old('filter_province_operation') === 'equals' ? 'selected' : '' }}>Equals</option>
                                                <option value="contains" {{ old('filter_province_operation') === 'contains' ? 'selected' : '' }}>Contains</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <input id="city" type="text" class="form-control" name="filter_city_term" value="{{ old('filter_city_term') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Filter
                                                </button>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-primary">
                                                    Clear Filter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
