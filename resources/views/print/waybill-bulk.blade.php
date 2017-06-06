<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Print Waybill | Cliqnship</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body{
            color:black;
            font-size: 20px !important;
        }
        .container{
            margin-top:20px;
        }
        .flex-container{
            display:flex;
            flex-direction: row;
            justify-content: space-between;
            width: 100%;
            margin:0px;
        }
        .flex-content{
            width: 49%;
        }
        .flex-data{
            display:flex;
            flex-direction: row;
            justify-content: space-around;
        }
        .text-center {
            text-align: center;
        }
        .bg-grey{
            background-color:#e5e5e5;
            font-size: 17px;
            padding:5px;
        }
        .flex-table{
            display:flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
        .flex-start{
            justify-content:flex-start;
        }
        .center{
            text-align: center;
        }
        .top-header{
            padding: 5px;
        }
        .data-center{
            margin: 0 auto;
            text-align: center;
        }
        .top-border{
            border-top:0px solid;
        }
        .text-grey{
            color:grey;
        }
        .text-left{
            text-align: left;
        }
        .footer-text {
            letter-spacing: 6px
        }
        img.logo{
            width: 150px;
            height: 40px;
        }
        img.barcode {
            width: 320px;
            height: 50px;
        }
        table{
            width: 100%;
        }
        tr{
            width: 100%;
        }
        td{
            font-size:11px;
            padding-left:5px;
        }
        table, tr, td{
            vertical-align: baseline;
        }

        .hide-on-print {
            text-align: center;
        }

        @media print {
            footer {page-break-after: always;}
            .hide-on-print {
                display: none;
            }
        }
    </style>
<body>
    <div class="hide-on-print">
        <h1>Total of {{ count($shipments) }} Waybills</h1>
        <button class="btn btn-primary" id="btnPrint"
            onclick="window.print()">
            Print Waybills
        </button>
        <hr>
    </div>

    @foreach ($shipments as $shipment)
        <div class="container">
            <div class="flex-container">
                <div class="flex-content">
                    <div class="flex-container top-header">
                        <img src="/images/logo.png" class="logo"/>
                        <div class="center">
                            <?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($shipment['tracking_number'], "C39",3,33) . '" alt="barcode" class="barcode" />';?>
                            <div>{{ $shipment['tracking_number'] }}</div>
                        </div>
                    </div>
                    <table border>
                        <tr>
                            <td colspan="1">
                                <div>From: <br>
                                    {{ $shipment['shipper_name'] }} <br>
                                    {{ $shipment['shipper_contact_number'] }} <br>
                                    {{ $shipment['shipper_address'] }}
                                </div>
                            </td>
                            <td colspan="3">
                                <div>
                                    To: <br>
                                    {{ $shipment['contact_person'] }} <br>
                                    {{ $shipment['contact_number'] }} <br>
                                    {{ $shipment['to'] }} <br>
                                    {{ $shipment['address_type'] }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">Service:<div>{{ $shipment['service_type'] }}</div></td>
                            <td colspan="3">Special Instructions:<div>{{ $shipment['remarks'] }}</div></td>
                        </tr>
                        <tr>
                            <td colspan="1">Shippers's Reference:<div></div></td>
                            <td colspan="3">Description of Package:<div>{{ $shipment['item_description'] }}</div></td>
                        </tr>
                        <tr>
                            <td colspan="2">Dimensions:<div>L x {{ $shipment['length'] }} W {{ $shipment['width'] }} x H {{ $shipment['height'] }}</div></td>
                            <td colspan="1">Weight (kg): <br> {{ $shipment['weight'] }}</td>
                            <td colspan="1">Chargeable Weight:</td>
                        </tr>
                        <tr>
                            <td colspan="1">
                                <div>
                                    <div>Shipment Insurance: {{ ($shipment['insurance_declared_value'] ? "YES" : "") }}</div>
                                    <div>Declared Value: {{ ($shipment['insurance_amount'] ? $shipment['insurance_amount'] : "") }}</div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div>
                                    <div>
                                        Collect and Deposit: {{ ($shipment['collect_and_deposit'] ? "YES" : "") }} <br>
                                        Amount: {{ ($shipment['collect_and_deposit_amount'] ? $shipment['collect_and_deposit_amount'] : "") }}
                                    </div>
                                    <div>Account Name: {{ ($shipment['account_name'] ? $shipment['account_name'] : "") }} <br>
                                    Account Number: {{ ($shipment['account_number'] ? $shipment['account_number'] : "") }} <br>
                                    Account Bank: {{ ($shipment['bank'] ? $shipment['bank'] : "") }}</div>
                                </div>

                            </td>
                            <td colspan="1">
                                Charge To: <br> {{ ($shipment['charge_to'] ? ucwords($shipment['charge_to']) : "") }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Shipment Charge:
                                &emsp;&emsp;&emsp;&emsp;
                                Insurance Fee:
                            </td>
                            <td colspan="1">Total:</td>
                            <td colspan="1">O.R.#</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="flex-content data-center">
                                <div style="font-size:10px;margin-top:0px;">By using this waybill, I agree to the terms and conditions stated at http://www.cliqnship.com/terms-and-conditions.php.</div>
                                <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u><br>
                                Sender's Signature
                            </td>
                            <td colspan="2">
                                <div>Received by CliqNShip</div>
                                <div>Name:<u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                <div>Time & Date: <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="text-center">Received above shipment in good order and condition</div>
                                <div class="flex-data">
                                    <div class="text-center">
                                        <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
                                        <div>Name</div>
                                    </div>
                                    <div class="text-center">
                                        <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
                                        <div>Relationship</div>
                                    </div>
                                    <div class="text-center">
                                        <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
                                        <div>Signature</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center">This area is for CliqNship couriers only</td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="1" class="text-left">Attemps:</td>
                            <td colspan="1">1st Attempts:</td>
                            <td colspan="1">2nd Attempts:</td>
                            <td colspan="1">3rd Attempts:</td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="1" class="text-left">Date &emsp;<span class="text-grey">MM / DD / YY</span></td>
                            <td colspan="1" class="text-grey">MM / DD / YY</td>
                            <td colspan="1" class="text-grey">MM / DD / YY</td>
                            <td colspan="1" class="text-grey">MM / DD / YY</td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="1" class="flex-content text-left">
                                <div class="flex-table flex-start">
                                    <div>Time <span class="text-grey">HH:MM</span>&emsp;</div>
                                    <div>AM<div>PM</div></div>
                                </div></td>
                            <td colspan="1" class="flex-content text-left">
                                <div class="flex-table">
                                    <div class="text-grey">HH:MM</span>&emsp;</div>
                                    <div>AM<div>PM</div></div>
                                </div>
                            </td>
                            <td colspan="1" class="flex-content text-left">
                                <div class="flex-table">
                                    <div class="flex-table">
                                        <div class="text-grey">HH:MM</span>&emsp;</div>
                                        <div>AM<div>PM</div></div>
                                    </div></td>
                            <td colspan="1" class="flex-content text-left">
                                <div class="flex-table">
                                    <div class="text-grey">HH:MM</span>&emsp;</div>
                                    <div>AM<div>PM</div></div>
                                </div></td>
                        </tr>
                        <tr>
                            <td colspan="1" class="text-left">House / Office closed</td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                        </tr>
                        <tr>
                            <td colspan="1">Payment not ready:
                                <div class="text-grey" style="font-size: 12px"> Cancel or Re-delivery Data</div></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                        </tr>
                        <tr>
                            <td colspan="1">Unknown consignee as per:
                                <div class="text-grey" style="font-size: 12px"> Name and position</div></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                        </tr>
                        <tr>
                            <td colspan="1">Consignee not around as per:
                                <div class="text-grey" style="font-size: 12px"> Name and relationship</div></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                        </tr>
                        <tr>
                            <td colspan="1">Refused to accept:
                                <div class="text-grey" style="font-size: 12px">Reason</div></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                        </tr>
                        <tr>
                            <td colspan="1">Incomplete address:
                                <div class="text-grey" style="font-size: 12px"> Details</div></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                        </tr>
                        <tr>
                            <td colspan="1">Other:
                                <div class="text-grey" style="font-size: 12px">Reason</div></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                            <td colspan="1" style="vertical-align: middle"><input type="checkbox"/></td>
                        </tr>
                    </table>
                </div>
                <div class="flex-content">
                    <div class="flex-container top-header">
                        <img src="/images/logo.png" class="logo"/>
                        <div class="center">
                            <?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($shipment['tracking_number'], "C39",3,33) . '" alt="barcode" class="barcode"   />';?>
                            <div>{{ $shipment['tracking_number'] }}</div>
                        </div>
                    </div>
                    <table border>
                        <tr>
                            <td colspan="2">
                                <div>From: <br>
                                    {{ $shipment['shipper_name'] }} <br>
                                    {{ $shipment['shipper_contact_number'] }} <br>
                                    {{ $shipment['shipper_address'] }}
                                </div>
                            </td>
                            <td colspan="2">
                                <div>
                                    To: <br>
                                    {{ $shipment['contact_person'] }} <br>
                                    {{ $shipment['contact_number'] }} <br>
                                    {{ $shipment['to'] }}  <br>
                                    {{ $shipment['address_type'] }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Service:<div>{{ $shipment['service_type'] }}</div></td>
                            <td colspan="2">Special Instructions:<div>{{ $shipment['remarks'] }}</div></td>
                        </tr>
                        <tr>
                            <td colspan="2">Shippers's Reference:<div></div></td>
                            <td colspan="2">Description of Package:<div>{{ $shipment['item_description'] }}</div></td>
                        </tr>
                        <tr>
                            <td colspan="2">Dimensions:<div>L x {{ $shipment['length'] }} W {{ $shipment['width'] }} x H {{ $shipment['height'] }}</div></td>
                            <td colspan="1">Weight (kg): <br> {{ $shipment['weight'] }}</td>
                            <td colspan="1">Chargeable Weight:</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div>
                                    <div>Shipment Insurance: {{ ($shipment['insurance_declared_value'] ? "YES" : "") }}</div>
                                    <div>Declared Value: {{ ($shipment['insurance_amount'] ? $shipment['insurance_amount'] : "") }}</div>
                                </div>
                            </td>
                            <td colspan="1">
                                <div>
                                    <div>
                                        Collect and Deposit: {{ ($shipment['collect_and_deposit'] ? "YES" : "") }} <br>
                                        Amount: {{ ($shipment['collect_and_deposit_amount'] ? $shipment['collect_and_deposit_amount'] : "") }}
                                    </div>
                                    <div>Account Name: {{ ($shipment['account_name'] ? $shipment['account_name'] : "") }} <br>
                                    Account Number: {{ ($shipment['account_number'] ? $shipment['account_number'] : "") }} <br>
                                    Account Bank: {{ ($shipment['bank'] ? $shipment['bank'] : "") }}</div>
                                </div>

                            </td>
                            <td colspan="1">
                                Charge To: <br> {{ ($shipment['charge_to'] ? ucwords($shipment['charge_to']) : "") }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="flex-data">
                                    <div>Shipment Charge:</div>
                                    <div class="data-center">Insurance Fee:</div>
                                </div>
                            </td>
                            <td colspan="1">Total:</td>
                            <td colspan="1">O.R.#</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="flex-content data-center">
                                <div style="font-size:10px;margin-top:0px;">By using this waybill, I agree to the terms and conditions stated at http://www.cliqnship.com/terms-and-conditions.php.</div>
                                <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
                                <div>Sender's Signature</div>
                            </td>
                            <td colspan="2">
                                <div>Received by CliqNShip:</div>
                                <div>Name: <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                <div>Time & Date: <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                            </td>
                        </tr>
                        <tr class="footer-text">
                            <td colspan="4" class="data-center bg-grey">BILLINGCOPY</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="flex-container">
                <div class="flex-content">
                    <div class="flex-container top-header">
                        <img src="/images/logo.png" class="logo"/>
                        <div class="center">
                            <?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($shipment['tracking_number'], "C39",3,33) . '" alt="barcode" class="barcode"   />';?>
                            <div>{{ $shipment['tracking_number'] }}</div>
                        </div>
                    </div>
                    <table border>
                        <tr>
                            <td colspan="2">
                                <div>From: <br>
                                    {{ $shipment['shipper_name'] }} <br>
                                    {{ $shipment['shipper_contact_number'] }} <br>
                                    {{ $shipment['shipper_address'] }}
                                </div>
                            </td>
                            <td colspan="2">
                                <div>
                                    To: <br>
                                    {{ $shipment['contact_person'] }} <br>
                                    {{ $shipment['contact_number'] }} <br>
                                    {{ $shipment['to'] }}  <br>
                                    {{ $shipment['address_type'] }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Service:<div>{{ $shipment['service_type'] }}</div></td>
                            <td colspan="2">Special Instructions:<div>{{ $shipment['remarks'] }}</div></td>
                        </tr>
                        <tr>
                            <td colspan="2">Shippers's Reference:<div></div></td>
                            <td colspan="2">Description of Package:<div>{{ $shipment['item_description'] }}</div></td>
                        </tr>
                        <tr>
                            <td colspan="2">Dimensions:<div>L x {{ $shipment['length'] }} W {{ $shipment['width'] }} x H {{ $shipment['height'] }}</div></td>
                            <td colspan="1">Weight (kg): <br> {{ $shipment['weight'] }}</td>
                            <td colspan="1">Chargeable Weight:</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div>
                                    <div>Shipment Insurance: {{ ($shipment['insurance_declared_value'] ? "YES" : "") }}</div>
                                    <div>Declared Value: {{ ($shipment['insurance_amount'] ? $shipment['insurance_amount'] : "") }}</div>
                                </div>
                            </td>
                            <td colspan="1">
                                <div>
                                    <div>
                                        Collect and Deposit: {{ ($shipment['collect_and_deposit'] ? "YES" : "") }} <br>
                                        Amount: {{ ($shipment['collect_and_deposit_amount'] ? $shipment['collect_and_deposit_amount'] : "") }}
                                    </div>
                                    <div>Account Name: {{ ($shipment['account_name'] ? $shipment['account_name'] : "") }} <br>
                                    Account Number: {{ ($shipment['account_number'] ? $shipment['account_number'] : "") }} <br>
                                    Account Bank: {{ ($shipment['bank'] ? $shipment['bank'] : "") }}</div>
                                </div>

                            </td>
                            <td colspan="1">
                                Charge To: <br> {{ ($shipment['charge_to'] ? ucwords($shipment['charge_to']) : "") }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="flex-data">
                                    <div>Shipment Charge:</div>
                                    <div class="data-center">Insurance Fee:</div>
                                </div>
                            </td>
                            <td colspan="1">Total:</td>
                            <td colspan="1">O.R.#</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="flex-content data-center">
                                <div style="font-size:10px;margin-top:0px;">By using this waybill, I agree to the terms and conditions stated at http://www.cliqnship.com/terms-and-conditions.php.</div>
                                <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
                                <div>Sender's Signature</div>
                            </td>
                            <td colspan="2">
                                <div>Received by CliqNShip:</div>
                                <div>Name: <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                <div>Time & Date: <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                            </td>
                        </tr>
                        <tr class="footer-text">
                            <td colspan="4" class="data-center bg-grey">SHIPPER/SELLERCOPY</td>
                        </tr>
                    </table>
                </div>
                <div class="flex-content">
                    <div class="flex-container top-header">
                        <img src="/images/logo.png" class="logo"/>
                        <div class="center">
                            <?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($shipment['tracking_number'], "C39",3,33) . '" alt="barcode" class="barcode"   />';?>
                            <div>{{ $shipment['tracking_number'] }}</div>
                        </div>
                    </div>
                    <table border>
                        <tr>
                            <td colspan="2">
                                <div>From: <br>
                                    {{ $shipment['shipper_name'] }} <br>
                                    {{ $shipment['shipper_contact_number'] }} <br>
                                    {{ $shipment['shipper_address'] }}
                                </div>
                            </td>
                            <td colspan="2">
                                <div>
                                    To: <br>
                                    {{ $shipment['contact_person'] }} <br>
                                    {{ $shipment['contact_number'] }} <br>
                                    {{ $shipment['to'] }}  <br>
                                    {{ $shipment['address_type'] }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Service:<div>{{ $shipment['service_type'] }}</div></td>
                            <td colspan="2">Special Instructions:<div>{{ $shipment['remarks'] }}</div></td>
                        </tr>
                        <tr>
                            <td colspan="2">Shippers's Reference:<div></div></td>
                            <td colspan="2">Description of Package:<div>{{ $shipment['item_description'] }}</div></td>
                        </tr>
                        <tr>
                            <td colspan="2">Dimensions:<div>L x {{ $shipment['length'] }} W {{ $shipment['width'] }} x H {{ $shipment['height'] }}</div></td>
                            <td colspan="1">Weight (kg): <br> {{ $shipment['weight'] }}</td>
                            <td colspan="1">Chargeable Weight:</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div>
                                    <div>Shipment Insurance: {{ ($shipment['insurance_declared_value'] ? "YES" : "") }}</div>
                                    <div>Declared Value: {{ ($shipment['insurance_amount'] ? $shipment['insurance_amount'] : "") }}</div>
                                </div>
                            </td>
                            <td colspan="1">
                                <div>
                                    <div>
                                        Collect and Deposit: {{ ($shipment['collect_and_deposit'] ? "YES" : "") }} <br>
                                        Amount: {{ ($shipment['collect_and_deposit_amount'] ? $shipment['collect_and_deposit_amount'] : "") }}
                                    </div>
                                    <div>Account Name: {{ ($shipment['account_name'] ? $shipment['account_name'] : "") }} <br>
                                    Account Number: {{ ($shipment['account_number'] ? $shipment['account_number'] : "") }} <br>
                                    Account Bank: {{ ($shipment['bank'] ? $shipment['bank'] : "") }}</div>
                                </div>

                            </td>
                            <td colspan="1">
                                Charge To: <br> {{ ($shipment['charge_to'] ? ucwords($shipment['charge_to']) : "") }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="flex-data">
                                    <div>Shipment Charge:</div>
                                    <div class="data-center">Insurance Fee:</div>
                                </div>
                            </td>
                            <td colspan="1">Total:</td>
                            <td colspan="1">O.R.#</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="flex-content data-center">
                                <div style="font-size:10px;margin-top:0px;">By using this waybill, I agree to the terms and conditions stated at http://www.cliqnship.com/terms-and-conditions.php.</div>
                                <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
                                <div>Sender's Signature</div>
                            </td>
                            <td colspan="2">
                                <div>Received by CliqNShip:</div>
                                <div>Name: <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                <div>Time & Date: <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                            </td>
                        </tr>
                        <tr class="footer-text">
                            <td colspan="4" class="data-center bg-grey">CONSIGNEE/RECEIVERCOPY</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <footer>
            <hr>
        </footer>
    @endforeach
</body>
</html>
