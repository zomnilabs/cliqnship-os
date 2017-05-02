<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Daily Delivery Dispatch | Cliqnship</title>

    <!-- Styles -->
    <link href="{{ asset('css/print/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body{
            color:black;
            text-transform: uppercase;
            font-size: 9px;
            margin: 20px;
        }
        thead tr th, tbody tr td, tfoot tr td, tfoot tr th {
            text-align: center;
            vertical-align: middle !important;
        }

        tbody tr.cod { background-color: #F3E81D !important; }

        thead { background-color: #9BBB59 !important; }
        
        @media print {
            body { -webkit-print-color-adjust: exact; }
            thead { background-color: #9BBB59 !important; }
        }
    </style>
<body>
    <div class="container">
        <h4 class="pull-left">Rider: {{ $rider->profile->getFullNameAttribute() }}</h4>
        <h4 class="pull-right">{{ Carbon\Carbon::today('Asia/Manila')->toFormattedDateString() }}</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>DATE</th>
                    <th>WAYBILL</th>
                    <th>CONSIGNEE NAME</th>
                    <th style="width: 200px">CONSIGNEE ADDRESS</th>
                    <th style="width: 80px">CITY</th>
                    <th>RIDER</th>
                    <th>ITEM DESCRIPTION</th>
                    <th>POUCH / OWN PACKAGING</th>
                    <th>COD AMOUNT</th>
                    <th>SHIPPER</th>
                    <th>POD NAME AND SIGNATURE</th>
                    <th>DELIVERY ATTEMPTS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignments as $assignment)
                    <tr class="{{ ($assignment->shipment->collect_and_deposit ? 'cod' : '') }}">
                        <td>{{ $assignment->created_at->format('d/m/y') }}</td>
                        <td>{{ $assignment->shipment->trackingNumbers[0]->tracking_number }}</td>
                        <td>{{ $assignment->shipment->address->getFullNameAttribute() }}</td>
                        <td>{{ $assignment->shipment->address->getFullAddress() }}, {{ $assignment->shipment->address->country }} 
                            {{ $assignment->shipment->address->zip_code }} <br>
                            Landmark: {{ $assignment->shipment->address->landmarks }}
                        </td>
                        <td>{{ $assignment->shipment->address->city }}</td>
                        <td>{{ $assignment->user->profile->getFullNameAttribute() }}</td>
                        <td>{{ $assignment->shipment->item_description }}</td>
                        <td>{{ $assignment->shipment->package_type }}</td>
                        <td>{{ ($assignment->shipment->collect_and_deposit_amount ? $assignment->shipment->collect_and_deposit_amount : '') }}</td>
                        <td>{{ $assignment->shipment->senderAddress->getFullNameAttribute() }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"></td>
                    <th colspan="5">DISPATCHED</th>
                    <th colspan="3">RETURNS</th>
                </tr>
                <tr>
                    <th colspan="2"> Prepared by:</th>
                    <td colspan="2"></td>
                    <th>REGULAR</th>
                    <th colspan="4">{{ $regular }}</th>
                    <th>RETURNS</th>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <th colspan="2" rowspan="2"> Checked by:</th>
                    <td colspan="2"></td>
                    <th>W/ COD</th>
                    <th colspan="4">{{ $withCod }}</th>
                    <th>COD</th>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <th>TOTAL</th>
                    <th colspan="4">{{ $regular + $withCod }}</th>
                    <th>RTS - PROB</th>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <th colspan="2" rowspan="2">Released & Checked by:</th>
                    <td colspan="2"></td>
                    <th colspan="5" rowspan="2" style="vertical-align: bottom !important">
                        <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br>
                        SIGNATURE OF RELEASING OFFICER
                    </th>
                    <th style="width: 90px">RTS - RE-SHIP</th>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <th>TOTAL</th>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <th class="text-right" colspan="12" style="vertical-align: bottom !important">
                        <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br>
                        SIGNATURE OF RECEIVING OFFICER&nbsp;&nbsp;&nbsp;
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
<!-- Scripts -->
<script src="{{ asset('js/print/js/bootstrap.min.js') }}"></script>
</body>
</html>

