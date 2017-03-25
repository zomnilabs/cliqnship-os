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
            padding-top:10px;
        }
        .top-header{
            height: 60px;
        }
        .flex-container{
            display:flex;
            flex-direction: row;
            justify-content: center;
            align-content: center;
            margin-top:15px;
        }
        .flex-content{
            margin:auto;
            display:flex;
            flex-direction: row;
            justify-content:space-between;
            width:48%;
        }
        .flex-item{
            text-align: center;
            width:48%;
        }
        img{
            width:100%;
            height: 60px;
        }
        .barcode{
            font-size: 20px;
            font-weight: bold;
        }
        .number{
            font-size: 15px;
        }
        .border{
            border:1px solid black;
        }
        .divider{
            border:1px solid black;
        }
        .bolder{
            font-weight: bolder;
        }
        .italic{
            font-style:italic;
        }
        table, tr, td{
            vertical-align: baseline;
        }
        table, td{
            font-size: 12px;
            border: 2px solid black;
        }
        table{
            width: 100%;
        }
        td{
            padding:20px;
            width: 50%;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="flex-container">
            <div class="flex-content top-header">
                <div class="flex-item">
                    <img src="images/logo.png"/>
                </div>
                <div class="flex-item border">
                    <div class="barcode">||||||||||||||||||||||||||||||||||||||</div>
                    <div class="number">1020130322</div>
                </div>
            </div>
            <div class="flex-content">
                <div class="flex-item">
                    <img src="images/logo.png"/>
                </div>
                <div class="flex-item border">
                    <div class="barcode">||||||||||||||||||||||||||||||||||||||</div>
                    <div class="number">1020130322</div>
                </div>
            </div>
        </div>
        <div class="flex-container">
            <div class="flex-content">
                <table>
                    <tr>
                        <td><div class="italic">From:</div><br/>
                            <span class="bolder">[Sender Name Here]</span><br/>
                            #8 Sample Street., Sample Village,<br/>
                            Sample Barangay, Sample City.<br/>
                            Sample Region, Philippines 1605<br/>
                            +639166573127<br/>sender@email.com</td>
                        <td><div class="italic">To [Domestic/International]:</div><br/>
                            <span class="bolder">[Receiver Name Here]</span><br/>
                            #8 Sample Street., Sample Village,<br/>
                            Sample Barangay, Sample City.<br/>
                            Sample Region, Philippines 1605<br/>
                            +639166573127<br/>receiver@email.com</td>
                    </tr>
                    <tr>
                        <td><div class="italic">Requested Date:</div><br/>
                            <div>January 20, 2017</div>
                            <div class="divider"></div>
                            <div class="italic">Package Contents:</div><br/>
                            <div class="bolder">[Qty] - [Package Description]</div><br/>
                            5 x 10 x 2 3kg.<br/>
                            <div class="divider"></div>
                            <div>Additional Instructions:</div><br/>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aperiam debitis dolore eveniet iste obcaecati ratione sit</td>
                        <td><div class="italic">Service:</div><br/>
                            <div class="bolder">Document</div>
                            <div class="divider"></div>
                            <div class="italic">Insurance & Declared Value</div>:<br/>
                            <div class="bolder">N/A</div><br/>
                            <div class="divider"></div><br/>
                            <div class="italic">Shipping Fee:</div>
                            <div class="bolder">P900.00</div></td>
                    <tr>
                        <td>
                            <div class="bolder">I AGREE TO THE ITEMS AND CONDITIONS PRINTED ON THE REVERSE SIDE OF THIS WAYBILL.</div>
                            <div class="italic">Shipper's Signature / Data & Time:</div></td>
                        <td>
                            <div class="bolder">CLIQNSHIP DELIVERED SHIPMENT IN GOOD ORDER AND CONDITION</div>
                            <div class="italic">Shipper's Signature / Relation / Data & Time:</div></td>
                    </tr>
                </table>
            </div>
            <div class="flex-content">
                <table>
                    <tr>
                        <td><div class="italic">From:</div><br/>
                            <span class="bolder">[Sender Name Here]</span><br/>
                            #8 Sample Street., Sample Village,<br/>
                            Sample Barangay, Sample City.<br/>
                            Sample Region, Philippines 1605<br/>
                            +639166573127<br/>sender@email.com</td>
                        <td><div class="italic">To [Domestic/International]:</div><br/>
                            <span class="bolder">[Receiver Name Here]</span><br/>
                            #8 Sample Street., Sample Village,<br/>
                            Sample Barangay, Sample City.<br/>
                            Sample Region, Philippines 1605<br/>
                            +639166573127<br/>receiver@email.com</td>
                    </tr>
                    <tr>
                        <td><div class="italic">Requested Date:</div><br/>
                            <div>January 20, 2017</div>
                            <div class="divider"></div>
                            <div class="italic">Package Contents:</div><br/>
                            <div class="bolder">[Qty] - [Package Description]</div><br/>
                            5 x 10 x 2 3kg.<br/>
                            <div class="divider"></div>
                            <div>Additional Instructions:</div><br/>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aperiam debitis dolore eveniet iste obcaecati ratione sit</td>
                        <td><div class="italic">Service:</div><br/>
                            <div class="bolder">Document</div>
                            <div class="divider"></div>
                            <div class="italic">Insurance & Declared Value</div>:<br/>
                            <div class="bolder">N/A</div><br/>
                            <div class="divider"></div><br/>
                            <div class="italic">Shipping Fee:</div>
                            <div class="bolder">P900.00</div></td>
                    <tr>
                        <td>
                            <div class="bolder">I AGREE TO THE ITEMS AND CONDITIONS PRINTED ON THE REVERSE SIDE OF THIS WAYBILL.</div>
                            <div class="italic">Shipper's Signature / Data & Time:</div></td>
                        <td>
                            <div class="bolder">CLIQNSHIP DELIVERED SHIPMENT IN GOOD ORDER AND CONDITION</div>
                            <div class="italic">Shipper's Signature / Relation / Data & Time:</div></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="flex-container">
            <div class="flex-content top-header">
                <div class="flex-item">
                    <img src="images/logo.png"/>
                </div>
                <div class="flex-item border">
                    <div class="barcode">||||||||||||||||||||||||||||||||||||||</div>
                    <div class="number">1020130322</div>
                </div>
            </div>
            <div class="flex-content">
                <div class="flex-item">
                    <img src="images/logo.png"/>
                </div>
                <div class="flex-item border">
                    <div class="barcode">||||||||||||||||||||||||||||||||||||||</div>
                    <div class="number">1020130322</div>
                </div>
            </div>
        </div>
        <div class="flex-container">
            <div class="flex-content">
                <table>
                    <tr>
                        <td><div class="italic">From:</div><br/>
                            <span class="bolder">[Sender Name Here]</span><br/>
                            #8 Sample Street., Sample Village,<br/>
                            Sample Barangay, Sample City.<br/>
                            Sample Region, Philippines 1605<br/>
                            +639166573127<br/>sender@email.com</td>
                        <td><div class="italic">To [Domestic/International]:</div><br/>
                            <span class="bolder">[Receiver Name Here]</span><br/>
                            #8 Sample Street., Sample Village,<br/>
                            Sample Barangay, Sample City.<br/>
                            Sample Region, Philippines 1605<br/>
                            +639166573127<br/>receiver@email.com</td>
                    </tr>
                    <tr>
                        <td><div class="italic">Requested Date:</div><br/>
                            <div>January 20, 2017</div>
                            <div class="divider"></div>
                            <div class="italic">Package Contents:</div><br/>
                            <div class="bolder">[Qty] - [Package Description]</div><br/>
                            5 x 10 x 2 3kg.<br/>
                            <div class="divider"></div>
                            <div>Additional Instructions:</div><br/>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aperiam debitis dolore eveniet iste obcaecati ratione sit</td>
                        <td><div class="italic">Service:</div><br/>
                            <div class="bolder">Document</div>
                            <div class="divider"></div>
                            <div class="italic">Insurance & Declared Value</div>:<br/>
                            <div class="bolder">N/A</div><br/>
                            <div class="divider"></div><br/>
                            <div class="italic">Shipping Fee:</div>
                            <div class="bolder">P900.00</div></td>
                    <tr>
                        <td>
                            <div class="bolder">I AGREE TO THE ITEMS AND CONDITIONS PRINTED ON THE REVERSE SIDE OF THIS WAYBILL.</div>
                            <div class="italic">Shipper's Signature / Data & Time:</div></td>
                        <td>
                            <div class="bolder">CLIQNSHIP DELIVERED SHIPMENT IN GOOD ORDER AND CONDITION</div>
                            <div class="italic">Shipper's Signature / Relation / Data & Time:</div></td>
                    </tr>
                </table>
            </div>
            <div class="flex-content">
                <table>
                    <tr>
                        <td><div class="italic">From:</div><br/>
                            <span class="bolder">[Sender Name Here]</span><br/>
                            #8 Sample Street., Sample Village,<br/>
                            Sample Barangay, Sample City.<br/>
                            Sample Region, Philippines 1605<br/>
                            +639166573127<br/>sender@email.com</td>
                        <td><div class="italic">To [Domestic/International]:</div><br/>
                            <span class="bolder">[Receiver Name Here]</span><br/>
                            #8 Sample Street., Sample Village,<br/>
                            Sample Barangay, Sample City.<br/>
                            Sample Region, Philippines 1605<br/>
                            +639166573127<br/>receiver@email.com</td>
                    </tr>
                    <tr>
                        <td><div class="italic">Requested Date:</div><br/>
                            <div>January 20, 2017</div>
                            <div class="divider"></div>
                            <div class="italic">Package Contents:</div><br/>
                            <div class="bolder">[Qty] - [Package Description]</div><br/>
                            5 x 10 x 2 3kg.<br/>
                            <div class="divider"></div>
                            <div>Additional Instructions:</div><br/>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aperiam debitis dolore eveniet iste obcaecati ratione sit</td>
                        <td><div class="italic">Service:</div><br/>
                            <div class="bolder">Document</div>
                            <div class="divider"></div>
                            <div class="italic">Insurance & Declared Value</div>:<br/>
                            <div class="bolder">N/A</div><br/>
                            <div class="divider"></div><br/>
                            <div class="italic">Shipping Fee:</div>
                            <div class="bolder">P900.00</div></td>
                    <tr>
                        <td>
                            <div class="bolder">I AGREE TO THE ITEMS AND CONDITIONS PRINTED ON THE REVERSE SIDE OF THIS WAYBILL.</div>
                            <div class="italic">Shipper's Signature / Data & Time:</div></td>
                        <td>
                            <div class="bolder">CLIQNSHIP DELIVERED SHIPMENT IN GOOD ORDER AND CONDITION</div>
                            <div class="italic">Shipper's Signature / Relation / Data & Time:</div></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
