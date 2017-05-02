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
            font-size: 7px;
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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>DATE</th>
                    <th>WAYBILL</th>
                    <th>CONSIGNEE NAME</th>
                    <th>CONSIGNEE ADDRESS</th>
                    <th>CITY</th>
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
                <tr class="cod">
                    <td>3/16/17</td>
                    <td>1000906786</td>
                    <td>LOVE HOPE FAITH</td>
                    <td>4F Legal, Security Bank, 6776 Ayala Avenue Makati Makati</td>
                    <td>Makati</td>
                    <td></td>
                    <td>COLLECT - 1169.4</td>
                    <td>OWN PACKAGING</td>
                    <td>1169.4</td>
                    <td>CASHCASH PINOY</td>
                    <td></td>
                    <td>1</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"></td>
                    <th colspan="5">DISPATCHED</th>
                    <th colspan="3">RETURNS</th>
                </tr>
                <tr>
                    <th colspan="2"> Prepared by:</th>
                    <td colspan="2">Alih Benzar</td>
                    <th>REGULAR</th>
                    <td colspan="4"></td>
                    <th>RETURNS</th>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <th colspan="2" rowspan="2"> Checked by:</th>
                    <td colspan="2">Robert Famenia</td>
                    <th>W/ COD</th>
                    <td colspan="4"></td>
                    <th>COD</th>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2">2nd Shift Dispatcher</td>
                    <th>TOTAL</th>
                    <td colspan="4"></td>
                    <th>RTS - PROB</th>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <th colspan="2" rowspan="2">Released & Checked by:</th>
                    <td colspan="2">Marvin Moises</td>
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
                    <th style="width: 70px">RTS - RE-SHIP</th>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2">1ST SHIFT DISPATCHER</td>
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

