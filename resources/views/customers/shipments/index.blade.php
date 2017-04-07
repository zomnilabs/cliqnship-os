@extends('layouts.app')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/wizard.css') }}">
@endsection

@section('scripts')
    <script>
        (function() {
            $('#shippingTable tfoot tr.searchable td').each( function () {
                let title = $(this).text();
                if (title) {
                    switch (title) {
                        case 'Pickup Date':
                            $(this).html( '<input type="date" class="form-control filter" style="width: 100%" placeholder="Search '+title+'" />' );

                            break;
                        case 'Status':
                            let selectHTML = '<select class="form-control filter" style="width: 100%">';
                            selectHTML += '<option value="">Filter Status</option>';
                            selectHTML += '<option value="pending">Pending</option>';
                            selectHTML += '<option value="for-pickup">For Pickup</option>';
                            selectHTML += '<option value="courier-picked-up">Courier Picked Up</option>';
                            selectHTML += '<option value="arrived-at-hq">Arrived at HQ</option>';
                            selectHTML += '<option value="enroute">En Route</option>';
                            selectHTML += '<option value="successfully-delivered">Successfully Delivered</option>';
                            selectHTML += '<option value="returned">Returned</option>';
                            selectHTML += '</select>';

                            $(this).html(selectHTML);
                            break;
                        default:
                            $(this).html( '<input class="form-control filter" type="text" style="width: 100%" placeholder="Search '+title+'" />' );
                    }

                }
            });

            let table = $('#shippingTable').DataTable();

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
                        <li class="active">Shipments</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Shipments</h1>
                </div>

                <div class="page-actions pull-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createShippingModal">
                        <i class="fa fa-plus"></i>
                        New Shipment</button>

                    <button class="btn btn-primary" data-toggle="modal" data-target="#importShipmentsModal">
                        <i class="fa fa-upload"></i>
                        Import Shipments</button>

                    <button class="btn btn-primary">
                        <i class="fa fa-download"></i>
                        Export Shipments</button>
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

                        <table class="table table-bordered" id="shippingTable" style="width: 100%">
                            <tfoot class="filter-footer">
                                <tr class="searchable">
                                    <td class="hide">Id #</td>
                                    <td>Tracking #</td>
                                    <td>Delivery Address</td>
                                    <td># of Items</td>
                                    <td>Service Type</td>
                                    <td>Services Add-Ons</td>
                                    <td>Charge To</td>
                                    <td>Remarks</td>
                                    <td>Status</td>
                                    <td></td>
                                </tr>
                            </tfoot>

                            <thead>
                                <tr>
                                    <th class="hide">Id #</th>
                                    <th>Tracking #</th>
                                    <th>Delivery Address</th>
                                    <th># of Items</th>
                                    <th>Service Type</th>
                                    <th>Services Add-Ons</th>
                                    <th>Charge To</th>
                                    <th>Remarks</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($shipments as $shipment)
                                    <tr id="shipment-{{$shipment->id}}">
                                        <td class="hide">{{ $shipment->id }}</td>
                                        <td>{{ $shipment->trackingNumbers()->mainTrackingNumber()->tracking_number }}</td>
                                        <td>{{ $shipment->address->address_line_1 }} {{ $shipment->address->barangay }} {{ $shipment->address->city }}, {{ $shipment->address->province }}. {{ $shipment->address->zip_code }}</td>
                                        <td>{{ $shipment->number_of_items }}</td>
                                        <td>{{ $shipment->service_type }}</td>
                                        <td>
                                            @if ($shipment->collect_and_deposit)
                                                <p>Collect And Deposit</p>
                                            @endif

                                            @if ($shipment->insurance_declared_value)
                                                <p>Insurance declared value</p>
                                            @endif
                                        </td>
                                        <td>{{ $shipment->charge_to }}</td>
                                        <td>{{ $shipment->remarks }}</td>
                                        <td>{{ $shipment->status }}</td>
                                        <th>
                                            <button class="btn btn-danger delBooking" value="{{ $shipment->id }}"><i class="fa fa-trash"></i></button>
                                            <button class="btn btn-default"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-default" onclick="frames['frame'].print()"><i class="fa fa-print"></i></button>
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
    <div class="modal fade" id="createShippingModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <shipping-wizard></shipping-wizard>
            </div>
        </div>
    </div>
    <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
    @include('customers.shipments.modals.import')
    <iframe src="/customers/shipments/preview" name="frame" style="width: 0; height: 0"></iframe>
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
            $("#shippingImage").change(function(){
                readURL(this);
            });
        });
    </script>
@endsection
