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
        .bg-grey{
            background-color:#e5e5e5;
            font-size: 15px;
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
        img{
            width: 150px;
            height: 40px;
        }
        table{
            width: 100%;
        }
        tr{
            width: 100%;
        }
        td{
            font-size:12px;
            padding-left:5px;
        }
        table, tr, td{
            vertical-align: baseline;
        }
    </style>
<body>
    <div class="container">
        <div class="flex-container">
            <div class="flex-content">
                <div class="flex-container top-header">
                    <img src="images/logo.png"/>
                    <div class="center">
                        <div>||||||||||||||||||||||||||||||||||||||||||||||||||||||</div>
                        <div>W - 1 6 0 2 1 8 - 0 0 0 0 2</div>
                    </div>
                </div>
                <table border>
                    <tr>
                        <td style="width:50%;" class="flex-content top-border">
                            <div class="flex-data">
                                <div>From:</div><div class="data-center">Acct #: 2016000000001</div>
                            </div>
                        </td>
                        <td style="width:50%;" class="flex-content">
                            <div class="flex-data">
                                <div>To:</div>
                                <div class="data-center">Test
                                    <div>Test</div>
                                    <div>Test</div></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <table border>
                            <tr>
                                <td style="width:40%;">Sevice:<div>test</div></td>
                                <td style="width:60%;">Special Instructions:<div>test</div></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:40%;">Shippers's Reference:<div>test</div></td>
                                <td style="width:60%;">Description of Package:<div>test</div></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;">Dimensions:<div>L x 10 W 11 x H 12</div></td>
                                <td style="width:25%;">Weight (kg):</td>
                                <td style="width:25%;">Chargable Weight:</td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;" class="flex-content top-border">
                                    <div class="flex-data">
                                        <div>Shipment Insurance:
                                            <div>YES</div>
                                        </div>
                                        <div class="data-center">Declared Value:</div>
                                    </div>
                                </td>
                                <td style="width:50%;" class="flex-content top-border">
                                    <div class="flex-data">
                                        <div>Mode of Payment:
                                        </div>
                                        <div class="data-center flex-data"><div>Bank: </div><u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                    </div>
                                    <div class="flex-data">
                                        <div><input type="checkbox"/></div>
                                        <div style="padding-top:1px;">Cash&emsp;</div>
                                        <div><input type="checkbox" checked/></div>
                                        <div style="padding-top:1px;">Charge Check #:<u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;">
                                    <div class="flex-data">
                                        <div>Shipment Charge:</div>
                                        <div class="data-center">Insurance Fee:</div>
                                    </div>
                                </td>
                                <td style="width:25%;">Total:</td>
                                <td style="width:25%;">O.R.#</td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;" class="flex-content data-center">
                                    <div style="font-size:7px;margin-top:0px;">By using this waybill, I agree to the terms and conditionsstated at http://www.cliqnship.com/terms-and-conditions.php.</div>
                                    <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
                                    <div>Sender's Signature</div>
                                </td>
                                <td style="width:50%;">
                                    <div>Received by CliqNShip</div>
                                    <div>Name:<u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                    <div>Time & Date: <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                </td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr class="data-center">
                                <td>
                                    <div>Received above shipment in good order and condition</div>
                                    <div class="flex-data">
                                        <div>
                                            <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
                                            <div>Name</div>
                                        </div>
                                        <div>
                                            <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
                                            <div>Relationship</div>
                                        </div>
                                        <div>
                                            <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
                                            <div>Signature</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr class="data-center">
                                <td>This area is for CliqNship couriers only</td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr class="data-center">
                                <td style="width: 40%;" class="text-left">Attemps:</td>
                                <td style="width: 20%">1st Attempts:</td>
                                <td style="width: 20%">2nd Attempts:</td>
                                <td style="width: 20%">3rd Attempts:</td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr class="data-center">
                                <td style="width: 40%;" class="text-left">Date <span class="text-grey">MM / DD / YY</span></td>
                                <td style="width: 20%" class="text-grey">MM / DD / YY</td>
                                <td style="width: 20%" class="text-grey">MM / DD / YY</td>
                                <td style="width: 20%" class="text-grey">MM / DD / YY</td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width: 40%;" class="flex-content text-left">
                                    <div class="flex-table flex-start">
                                        <div>Time <span class="text-grey">HH:MM</span>&emsp;</div>
                                        <div>AM<div>PM</div></div>
                                    </div></td>
                                <td style="width: 20%;" class="flex-content text-left">
                                    <div class="flex-table">
                                        <div class="text-grey">HH:MM</span>&emsp;</div>
                                        <div>AM<div>PM</div></div>
                                    </div>
                                </td>
                                <td style="width: 20%;" class="flex-content text-left">
                                    <div class="flex-table">
                                        <div class="flex-table">
                                            <div class="text-grey">HH:MM</span>&emsp;</div>
                                            <div>AM<div>PM</div></div>
                                    </div></td>
                                <td style="width: 20%;" class="flex-content text-left">
                                    <div class="flex-table">
                                        <div class="text-grey">HH:MM</span>&emsp;</div>
                                        <div>AM<div>PM</div></div>
                                    </div></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width: 40%;" class="text-left">House / Office closed</td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width: 40%;">Payment not ready:
                                    <div class="text-grey"> Cancel or Re-delivery Data</div></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width: 40%;">Unknown consignee as per:
                                    <div class="text-grey"> Name and relationship</div></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width: 40%;">Refused to accept:
                                    <div class="text-grey">Reason</div></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width: 40%;">Incomplete address:
                                    <div class="text-grey"> Details</div></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width: 40%;">Other:
                                    <div class="text-grey">Reason</div></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                                <td style="width: 20%"><input type="checkbox"/></td>
                            </tr>
                        </table>
                    </tr>
                </table>
            </div>
            <div class="flex-content">
                <div class="flex-container top-header">
                    <img src="images/logo.png"/>
                    <div class="center">
                        <div>||||||||||||||||||||||||||||||||||||||||||||||||||||||</div>
                        <div>W - 1 6 0 2 1 8 - 0 0 0 0 2</div>
                    </div>
                </div>
                <table border>
                    <tr>
                        <td style="width:50%;" class="flex-content top-border">
                            <div class="flex-data">
                                <div>From:</div><div class="data-center">Acct #: 2016000000001</div>
                            </div>
                        </td>
                        <td style="width:50%;" class="flex-content">
                            <div class="flex-data">
                                <div>To:</div>
                                <div class="data-center">Test
                                    <div>Test</div>
                                    <div>Test</div></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <table border>
                            <tr>
                                <td style="width:40%;">Sevice:<div>test</div></td>
                                <td style="width:60%;">Special Instructions:<div>test</div></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:40%;">Shippers's Reference:<div>test</div></td>
                                <td style="width:60%;">Description of Package:<div>test</div></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;">Dimensions:<div>L x 10 W 11 x H 12</div></td>
                                <td style="width:25%;">Weight (kg):</td>
                                <td style="width:25%;">Chargable Weight:</td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;" class="flex-content top-border">
                                    <div class="flex-data">
                                        <div>Shipment Insurance:
                                            <div>YES</div>
                                        </div>
                                        <div class="data-center">Declared Value:</div>
                                    </div>
                                </td>
                                <td style="width:50%;" class="flex-content top-border">
                                    <div class="flex-data">
                                        <div>Mode of Payment:
                                        </div>
                                        <div class="data-center flex-data"><div>Bank: </div><u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                    </div>
                                    <div class="flex-data">
                                        <div><input type="checkbox"/></div>
                                        <div style="padding-top:1px;">Cash&emsp;</div>
                                        <div><input type="checkbox" checked/></div>
                                        <div style="padding-top:1px;">Charge Check #:<u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;">
                                    <div class="flex-data">
                                        <div>Shipment Charge:</div>
                                        <div class="data-center">Insurance Fee:</div>
                                    </div>
                                </td>
                                <td style="width:25%;">Total:</td>
                                <td style="width:25%;">O.R.#</td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;" class="flex-content data-center">
                                    <div style="font-size:7px;margin-top:0px;">By using this waybill, I agree to the terms and conditionsstated at http://www.cliqnship.com/terms-and-conditions.php.</div>
                                    <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
                                    <div>Sender's Signature</div>
                                </td>
                                <td style="width:50%;">
                                    <div>Received by CliqNShip</div>
                                    <div>Name:<u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                    <div>Time & Date: <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                </td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td class="data-center bg-grey">B I L L I N G C O P Y</td>
                            </tr>
                        </table>
                    </tr>
                </table>
            </div>
        </div>
        </div>
    </div>
    <div class="container">
        <div class="flex-container">
            <div class="flex-content">
                <div class="flex-container top-header">
                    <img src="images/logo.png"/>
                    <div class="center">
                        <div>||||||||||||||||||||||||||||||||||||||||||||||||||||||</div>
                        <div>W - 1 6 0 2 1 8 - 0 0 0 0 2</div>
                    </div>
                </div>
                <table border>
                    <tr>
                        <td style="width:50%;" class="flex-content top-border">
                            <div class="flex-data">
                                <div>From:</div><div class="data-center">Acct #: 2016000000001</div>
                            </div>
                        </td>
                        <td style="width:50%;" class="flex-content">
                            <div class="flex-data">
                                <div>To:</div>
                                <div class="data-center">Test
                                    <div>Test</div>
                                    <div>Test</div></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <table border>
                            <tr>
                                <td style="width:40%;">Sevice:<div>test</div></td>
                                <td style="width:60%;">Special Instructions:<div>test</div></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:40%;">Shippers's Reference:<div>test</div></td>
                                <td style="width:60%;">Description of Package:<div>test</div></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;">Dimensions:<div>L x 10 W 11 x H 12</div></td>
                                <td style="width:25%;">Weight (kg):</td>
                                <td style="width:25%;">Chargable Weight:</td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;" class="flex-content top-border">
                                    <div class="flex-data">
                                        <div>Shipment Insurance:
                                            <div>YES</div>
                                        </div>
                                        <div class="data-center">Declared Value:</div>
                                    </div>
                                </td>
                                <td style="width:50%;" class="flex-content top-border">
                                    <div class="flex-data">
                                        <div>Mode of Payment:
                                        </div>
                                        <div class="data-center flex-data"><div>Bank: </div><u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                    </div>
                                    <div class="flex-data">
                                        <div><input type="checkbox"/></div>
                                        <div style="padding-top:1px;">Cash&emsp;</div>
                                        <div><input type="checkbox" checked/></div>
                                        <div style="padding-top:1px;">Charge Check #:<u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;">
                                    <div class="flex-data">
                                        <div>Shipment Charge:</div>
                                        <div class="data-center">Insurance Fee:</div>
                                    </div>
                                </td>
                                <td style="width:25%;">Total:</td>
                                <td style="width:25%;">O.R.#</td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;" class="flex-content data-center">
                                    <div style="font-size:7px;margin-top:0px;">By using this waybill, I agree to the terms and conditionsstated at http://www.cliqnship.com/terms-and-conditions.php.</div>
                                    <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
                                    <div>Sender's Signature</div>
                                </td>
                                <td style="width:50%;">
                                    <div>Received by CliqNShip</div>
                                    <div>Name:<u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                    <div>Time & Date: <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                </td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td class="data-center bg-grey">S H I P P E R / S E L L E R C O P Y</td>
                            </tr>
                        </table>
                    </tr>
                </table>
            </div>
            <div class="flex-content">
                <div class="flex-container top-header">
                    <img src="images/logo.png"/>
                    <div class="center">
                        <div>||||||||||||||||||||||||||||||||||||||||||||||||||||||</div>
                        <div>W - 1 6 0 2 1 8 - 0 0 0 0 2</div>
                    </div>
                </div>
                <table border>
                    <tr>
                        <td style="width:50%;" class="flex-content top-border">
                            <div class="flex-data">
                                <div>From:</div><div class="data-center">Acct #: 2016000000001</div>
                            </div>
                        </td>
                        <td style="width:50%;" class="flex-content">
                            <div class="flex-data">
                                <div>To:</div>
                                <div class="data-center">Test
                                    <div>Test</div>
                                    <div>Test</div></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <table border>
                            <tr>
                                <td style="width:40%;">Sevice:<div>test</div></td>
                                <td style="width:60%;">Special Instructions:<div>test</div></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:40%;">Shippers's Reference:<div>test</div></td>
                                <td style="width:60%;">Description of Package:<div>test</div></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;">Dimensions:<div>L x 10 W 11 x H 12</div></td>
                                <td style="width:25%;">Weight (kg):</td>
                                <td style="width:25%;">Chargable Weight:</td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;" class="flex-content top-border">
                                    <div class="flex-data">
                                        <div>Shipment Insurance:
                                            <div>YES</div>
                                        </div>
                                        <div class="data-center">Declared Value:</div>
                                    </div>
                                </td>
                                <td style="width:50%;" class="flex-content top-border">
                                    <div class="flex-data">
                                        <div>Mode of Payment:
                                        </div>
                                        <div class="data-center flex-data"><div>Bank: </div><u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                    </div>
                                    <div class="flex-data">
                                        <div><input type="checkbox"/></div>
                                        <div style="padding-top:1px;">Cash&emsp;</div>
                                        <div><input type="checkbox" checked/></div>
                                        <div style="padding-top:1px;">Charge Check #:<u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;">
                                    <div class="flex-data">
                                        <div>Shipment Charge:</div>
                                        <div class="data-center">Insurance Fee:</div>
                                    </div>
                                </td>
                                <td style="width:25%;">Total:</td>
                                <td style="width:25%;">O.R.#</td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td style="width:50%;" class="flex-content data-center">
                                    <div style="font-size:7px;margin-top:0px;">By using this waybill, I agree to the terms and conditionsstated at http://www.cliqnship.com/terms-and-conditions.php.</div>
                                    <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
                                    <div>Sender's Signature</div>
                                </td>
                                <td style="width:50%;">
                                    <div>Received by CliqNShip</div>
                                    <div>Name:<u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                    <div>Time & Date: <u>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u></div>
                                </td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="top-border" border>
                            <tr>
                                <td class="data-center bg-grey">C O N S I G N E E / R E C E I V E R C O P Y</td>
                            </tr>
                        </table>
                    </tr>
                </table>
            </div>
    </div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

