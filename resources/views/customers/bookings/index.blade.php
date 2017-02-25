@extends('layouts.app')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/wizard.css') }}">
@endsection

@section('content')
    <div class="header-info container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/customers">Dashboard</a></li>
                        <li class="active">Bookings</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Bookings</h1>
                </div>

                <div class="page-actions pull-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createBookingModal">
                        <i class="glyphicon glyphicon-plus"></i>
                        New Booking</button>

                    <button class="btn btn-primary">
                        <i class="fa fa-upload"></i>
                        Import Bookings</button>

                    <button class="btn btn-primary">
                        <i class="fa fa-download"></i>
                        Export Bookings</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="filter-categories">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-sm btn-default active">
                                    <input type="radio" name="filter" id="option1" value="all" autocomplete="off" checked> [{{ number_of_bookings(Auth::user()->id, 'all') }}] All
                                </label>
                                <label class="btn btn-sm btn-warning">
                                    <input type="radio" name="filter" id="option2" value="pending" autocomplete="off"> [{{ number_of_bookings(Auth::user()->id, 'pending') }}] Pending
                                </label>
                                <label class="btn btn-sm btn-primary">
                                    <input type="radio" name="filter" id="option3" value="accepted" autocomplete="off"> [{{ number_of_bookings(Auth::user()->id, 'accepted') }}] Accepted
                                </label>

                                <label class="btn btn-sm btn-success">
                                    <input type="radio" name="filter" id="option3" value="completed" autocomplete="off"> [{{ number_of_bookings(Auth::user()->id, 'completed') }}] Completed
                                </label>

                                <label class="btn btn-sm btn-danger">
                                    <input type="radio" name="filter" id="option3" value="rejected" autocomplete="off"> [{{ number_of_bookings(Auth::user()->id, 'rejected') }}] Rejected
                                </label>
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Booking #</th>
                                    <th>Pickup Date</th>
                                    <th>Pickup Address</th>
                                    <th># of Items</th>
                                    <th>Remarks</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>KJLKJLJL</td>
                                    <td>February 25, 2017</td>
                                    <td>29 Anonas Quezon City</td>
                                    <th>1</th>
                                    <th>This is a remarks</th>
                                    <th>{!! format_booking_status('pending') !!}</th>
                                    <th>
                                        <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                        <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </th>
                                </tr>

                                <tr>
                                    <td>KJLKJLJL</td>
                                    <td>February 25, 2017</td>
                                    <td>29 Anonas Quezon City</td>
                                    <th>1</th>
                                    <th>This is a remarks</th>
                                    <th>{!! format_booking_status('accepted') !!}</th>
                                    <th>
                                        <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                        <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </th>
                                </tr>

                                <tr>
                                    <td>KJLKJLJL</td>
                                    <td>February 25, 2017</td>
                                    <td>29 Anonas Quezon City</td>
                                    <th>1</th>
                                    <th>Pending</th>
                                    <th>{!! format_booking_status('rejected') !!}</th>
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
                                        <label class="col-md-12">Booking #</label>

                                        <div class="col-md-6">
                                            <select name="filter_booking_no_operation" class="form-control">
                                                <option value="equals" {{ old('filter_booking_no_operation') === 'equals' ? 'selected' : '' }}>Equals</option>
                                                <option value="contains" {{ old('filter_booking_no_operation') === 'contains' ? 'selected' : '' }}>Contains</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <input id="booking_no" type="text" class="form-control" name="filter_booking_no_term" value="{{ old('filter_booking_no_operation') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12">Type</label>

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
                                        <label class="col-md-12">City</label>

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
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-primary">
                                                    Filter
                                                </button>
                                            </div>
                                            <div class="col-md-2">
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

    <div class="modal fade" id="createBookingModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                @include('customers.bookings.wizard')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            //Initialize tooltips
            $('.nav-tabs > li a[title]').tooltip();

            //Wizard
            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

                let $target = $(e.target);

                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function (e) {

                let $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                nextTab($active);

            });
            $(".prev-step").click(function (e) {

                let $active = $('.wizard .nav-tabs li.active');
                prevTab($active);

            });

            // Image input onchange
            $("#bookingImage").change(function(){
                readURL(this);
            });
        });

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }
        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.preview img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
