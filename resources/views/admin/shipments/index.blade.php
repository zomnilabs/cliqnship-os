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
            $('#shippingTable tfoot tr.searchable td').each( function () {
                let title = $(this).text();
                if (title) {
                    switch (title) {
                        case 'Pickup Date':
                            $(this).html( '<input type="date" class="form-control filter" style="width: 100%" placeholder="Search '+title+'" />' );

                            break;
                        case 'Status':
                            let selectHTML = '<select class="form-control filter filter-status" style="width: 100%">';
                            selectHTML += '<option value="">Filter Status</option>';
                            selectHTML += '<option value="pending">Pending</option>';
                            selectHTML += '<option value="for-pickup">For Pickup</option>';
                            selectHTML += '<option value="courier-picked-up">Courier Picked Up</option>';
                            selectHTML += '<option value="arrived-at-hq">Arrived at HQ</option>';
                            selectHTML += '<option value="for encoding">Arrived at HQ - For Encoding</option>';
                            selectHTML += '<option value="enroute">En Route</option>';
                            selectHTML += '<option value="successfully-delivered">Successfully Delivered</option>';
                            selectHTML += '<option value="Waiting For POD">Successfully Delivered - NO POD</option>';
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

            $('#btnExport').on('click', function(e) {
                e.preventDefault();

                let data = table
                    .rows({search:'applied'})
                    .data().toArray();

                let ids = '';
                for (let id of data) {
                    console.log(id[0]);
                    ids += id[0] + ',';
                }

                ids = ids.replace(/,\s*$/, '');
                window.open(`/admin/shipments/export?ids=${ids}`);
            });
        }())
    </script>

    <script>
        (function() {
            let shipmentDetails = $('#shipmentDetails');
            let shipmentLoader  = $('#shipmentLoader');
            let shipmentContent = $('#shipmentContent');
            let shipmentReturnLogs = $('#shipmentReturnLogs').DataTable();
            let shipmentEvents = $('#shipmentEvents').DataTable();

            // events
            shipmentDetails.on('hidden.bs.modal', function(e) {
                shipmentLoader.removeClass('hide');
                shipmentContent.addClass('hide');

                shipmentReturnLogs.clear().draw();
                shipmentEvents.clear().draw();
                $('#myTabs a:first').tab('show');
            });

            $('.view-shipment-details').on('click', function() {
                let shipmentId = $(this).data('shipment');

                getShipmentDetails(shipmentId);
            });

            // functions
            function getShipmentDetails(shipmentId) {
                axios.get(`/api/v1/shipments/${shipmentId}`).then((response) => {
                    console.log(response.data);
                    let shipment = response.data;

                    if (shipment.return_logs.length > 0) {
                        buildReturnLogs(shipment.return_logs[0].logs);
                    }

                    buildEvents(shipment.events);
                    populateShipmentDetails(shipment);

                    shipmentLoader.addClass('hide');
                    shipmentContent.removeClass('hide');
                }).catch(error => console.log(error));
            }

            function buildReturnLogs(items) {
                for (let item of items) {
                    shipmentReturnLogs.row.add([
                        `${item.user.profile.first_name} ${item.user.profile.last_name}`,
                        `${item.reason}`,
                        `${item.created_at}`,
                        `${item.status}`
                    ]).draw( false );
                }
            }

            function buildEvents(items) {
                for (let item of items) {
                    shipmentEvents.row.add([
                        `${item.user.profile.first_name} ${item.user.profile.last_name}`,
                        `${item.event_source}`,
                        `${item.event}`,
                        `${item.value}`,
                        `${item.remarks}`,
                        `${item.created_at}`
                    ]).draw( false );
                }
            }
            function populateShipmentDetails(item) {
                $('#to').val(item.sender_address.first_name + " " + item.sender_address.last_name);
                $('#from').val(item.address.first_name + " " + item.address.last_name);
                $('#number_of_items').val(item.number_of_items);
                $('#type_of_items').val(item.item_description);
                $('#length').val(item.length);
                $('#height').val(item.height);
                $('#width').val(item.width);
                $('#weight').val(item.weight);
                $('#remarks').val(item.remarks);
            }
        })()
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
                    <button data-toggle="modal" data-target=".bs-modal-lg" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Create New Shipment</button>

                    <button data-toggle="modal" data-target="#importShipmentsModal" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Import Shipments</button>

                    <a href="#" id="btnExport" class="btn btn-primary">
                        <i class="glyphicon glyphicon-plus"></i>
                        Export Shipments</a>
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

                        <table class="table table-bordered" id="shippingTable">
                            <tfoot class="filter-footer">
                            <tr class="searchable">
                                <td class="hide">Id #</td>
                                <td>Tracking #</td>
                                <td>Delivery Address</td>
                                <td>Service Type</td>
                                <td>Services Add-Ons</td>
                                <td>Charge To</td>
                                <td>Remarks</td>
                                <td>COD Amount</td>
                                <td>POD</td>
                                <td>POD Date</td>
                                <td>Status</td>
                                <td></td>
                            </tr>
                            </tfoot>

                            <thead>
                            <tr>
                                <th class="hide">Id #</th>
                                <th>Tracking #</th>
                                <th>Delivery Address</th>
                                <th>Service Type</th>
                                <th>Services Add-Ons</th>
                                <th>Charge To</th>
                                <th>Remarks</th>
                                <th>COD Amount</th>
                                <td>POD</td>
                                <td>POD Date</td>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($shipments as $shipment)
                                <tr id="shipment-{{$shipment->id}}">
                                    <td class="hide">{{ $shipment->id }}</td>
                                    <td>
                                        <a href="#" class="view-shipment-details" data-shipment="{{ $shipment->id }}" data-toggle="modal" data-target="#shipmentDetails">
                                            {{$shipment->trackingNumbers()->mainTrackingNumber($shipment->id)->tracking_number}}
                                        </a>
                                    </td>
                                    <td>
                                        @if ($shipment->address)
                                            {{ $shipment->address->address_line_1 }} {{ $shipment->address->barangay }} {{ $shipment->address->city }}, {{ $shipment->address->province }}. {{ $shipment->address->zip_code }}
                                        @endif
                                    </td>
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
                                    <td>
                                        <ul>
                                            @if ($shipment->remarks)
                                                @foreach($shipment->remarks as $r)
                                                    <li>{{ $r->remarks }}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </td>
                                    <td>{{ $shipment->cod ? $shipment->cod->collect_and_deposit_amount : '0' }}</td>
                                    <td>{{ $shipment->pod }}</td>
                                    <td>{{ $shipment->pod_date }}</td>
                                    <td c>
                                        @if ($shipment->address)
                                            @if ($shipment->status === 'successfully-delivered' && !$shipment->pod)
                                                Waiting For POD
                                            @else
                                                {{ ucwords($shipment->status) }}
                                            @endif
                                        @else
                                            For Encoding
                                        @endif
                                    </td>
                                    <td style="min-width: 150px;">
                                        <button class="btn btn-danger delBooking" value="{{ $shipment->id }}"><i class="fa fa-trash"></i></button>
                                        <button class="btn btn-default"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-default" onclick="$('iframe').attr('src','/customers/shipments/{{ $shipment->id }}/preview');
                                                frames['frame'].print();"><i class="fa fa-print"></i></button>
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

    <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content mcontent">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-header">
                    <center><b>
                            <h4 class="modal-title" id="gridSystemModalLabel">Create New Shipment</h4></b>
                    </center>
                </div></br>
                <form method="POST" action="{{ url('/admin/riders') }}" >
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Identifier">Identifier</label>
                                <input type="text" class="form-control" name="identifier" id="identifier"required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Type">Type</label>
                                <select name="filter_type_operation" class="form-control" id="type">
                                    <option value="booking">Booking</option>
                                    <option value="shipmemt">Shipment</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class0.="form-group">
                                <label for="firstname">Contact Person First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lastname">Contact Person Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="middlename">Contact Person Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" id="middle_name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_number">Contact Number</label>
                                <input type="number" class="form-control" name="contact_number" id="contact_number" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="text" class="form-control" name="email" id="email" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="AddressLine1">Address Line 1</label>
                                <input type="text" class="form-control" name="address_line_1" id="address_line_1" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="addressline2">Address Line 2</label>
                                <input type="text" class="form-control" name="address_line_2" id="address_line_2"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="barangay">Barangay</label>
                                <input type="text" class="form-control" name="barangay" id="barangay" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="City">City</label>
                                <input type="text" class="form-control" name="city" id="city" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Province">Province</label>
                                <input type="text" class="form-control" name="province" id="province" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" name="country" id="country" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="zipcode">Zipcode</label>
                                <input type="text" class="form-control" name="zip_code" id="zip_code" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Landmarks">LandMarks</label>
                                <input type="text" class="form-control" name="landmarks" id="landmarks" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="AddressType">Address Type</label>
                                <select name="address_type" class="form-control" id="address_type">
                                    <option value="resedential">Resedential</option>
                                    <option value="office">Office</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="checkbox">Is this your primary address?</label>
                                <input type="checkbox" name="checkbox"/>
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
    <iframe src="/customers/shipments/preview" name="frame" style="width: 0; height: 0"></iframe>

    @include('admin.shipments.modals.info')
    @include('admin.shipments.import')
@endsection
