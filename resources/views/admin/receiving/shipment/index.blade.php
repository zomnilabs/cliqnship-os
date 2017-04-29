@extends('layouts.admin')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/wizard.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">

    <style>
        .mcontent{
            padding:15px;
        }
        .pull-right button{
            margin-right:20px;
        }

        .select2-container {
            width: 100% !important;
            font-size: 20px;
        }

        .select2-search__field, .select2-search {
            width: 100% !important;
        }

        .waybill-input {
            font-size: 20px;
        }

        .select2-selection__choice {
            background-color: #3c8dbc !important;
            border-color: #357CA5 !important;
            font-size: 20px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #224F69 !important;
            margin-right: 10px !important;
        }
    </style>
@endsection

@section('scripts')
    <script>
        (function() {
            $('.table thead tr.searchable td').each( function () {
                var title = $(this).text();
                if (title) {
                    $(this).html( '<input type="text" style="width: 100%" placeholder="Search '+title+'" />' );
                }
            });

            $('.table').dataTable();

            // Select 2
            $(".waybill-input").select2({
                tags: true,
                tokenSeparators: [',', ' '],
                placeholder: "Input waybill number/s",
                allowClear: true
            }).on('change', function(value) {
                let waybills = $(this).val();
                let newValue = waybills[waybills.length - 1];
                console.log('new value', newValue);

                fetch(`/api/v1/shipments/check/${newValue}`).then((res) => {
                    if (! res.ok) {
                        let html = `<p><span class="text-danger">${newValue}</span> is not a valid waybill</p>`;
                        $('.error-container').append(html);

                        return;
                    }
                }).catch((error) => {
                    let html = `<p><span class="text-danger">${newValue}</span> is not a valid waybill</p>`;
                    $('.error-container').append(html);
                });
            });

            $('#status').on('change', function() {
                if ($(this).val() === 'returned') {
                    $('.reasonInput').removeClass('hide');
                } else {
                    $('.reasonInput').addClass('hide');
                }
            })
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
                        <li class="active">Shipments</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Shipments</h1>
                </div>

                <div class="page-actions pull-right">
                    <button  data-toggle="modal" data-target="#addWaybill" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Add New Shipment Remit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="hide">
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
                        </div>

                        <table class="table table-bordered">
                            <thead>
                            <tr class="searchable">
                                <td class="hide">Id #</td>
                                <td>Tracking #</td>
                                <td>Delivery Address</td>
                                <td># of Items</td>
                                <td>Service Type</td>
                                <td>Status</td>
                            </tr>
                            <tr>
                                <th class="hide">Id #</th>
                                <th>Tracking #</th>
                                <th>Delivery Address</th>
                                <th># of Items</th>
                                <th>Service Type</th>
                                <th>Status</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($assignments as $assignment)
                                    <tr>
                                        <td class="hide">{{ $assignment->id }}</td>
                                        <td>{{ $assignment->shipment->trackingNumbers()->mainTrackingNumber()->tracking_number }}</td>
                                        <td>{{ $assignment->shipment->address->address_line_1 }} {{ $assignment->shipment->address->barangay }} {{ $assignment->shipment->address->city }}, {{ $assignment->shipment->address->province }}. {{ $assignment->shipment->address->zip_code }}</td>
                                        <td>{{ $assignment->shipment->number_of_items }}</td>
                                        <td>{{ $assignment->shipment->service_type }}</td>
                                        <td>{{ $assignment->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addWaybill" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content mcontent">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-header text-center">
                    <h4 class="modal-title" id="modalTitle">Shipment Remit</h4>
                </div>
                <form id="viewForm" method="post">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('waybills') ? ' has-error' : '' }}">
                                    <label for="waybills">Waybill Number/s</label>

                                    <select class="form-control dataField waybill-input" name="waybills[]" id="waybills" multiple="multiple"></select>

                                    @if ($errors->has('waybills'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('waybills') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label for="status">Waybill Number/s</label>

                                    <select class="form-control dataField" name="status" id="status">
                                        <option value="arrived-at-hq">Received At Warehouse</option>
                                        <option value="successfully-delivered">Successfully Delivered</option>
                                        <option value="returned">Returned</option>
                                    </select>

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="reasonInput hide form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
                                    <label for="reason">Reason</label>

                                    <input type="text" name="reason" id="reason" class="form-control" />

                                    @if ($errors->has('reason'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('reason') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 error-container">

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success" id="formSubmit"><i class="fa fa-floppy-o"></i> Receive Shipment Remit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
