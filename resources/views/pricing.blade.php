@extends('layouts.auth')

@section('content')

<header id="pricing">
    <div class="container">
        <div class="intro-text">
        </div>
    </div>
</header>

<section style="min-height: 100vh;padding: 60px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">PRICING</h2>
            </div>
        </div>
        <div class="pricing text-center">
            
            <div style="display: inline-flex; padding-bottom: 40px;">
                 <a class="btn btn-primary" href="#domestic" class="domestic active" aria-controls="domestic" role="tab" data-toggle="tab">
                  <i style="font-size: 6em" class="fa fa-motorcycle"></i> <h4> Domestic</h4>
                </a>
                <a class="btn btn-primary" href="#international" class="international" aria-controls="international" role="tab" data-toggle="tab">
                  <i style="font-size: 6em" class="fa fa-plane"></i> <h4>International</h4>
                </a>
            </div>
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="domestic">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="text-center">Domestic Rates</h3></div>

                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="background: #9BBB59"></th>
                                        <th style="background: #9BBB59">METRO MANILA</th>
                                        <th style="background: #9BBB59" colspan="4">STEADY N BREEZY</th>
                                    </tr>
                                    <tr>
                                        <th style="background: #9BBB59">Weight</th>
                                        <th style="background: #9BBB59">Regular Shipment</th>
                                        <th style="background: #9BBB59" colspan="2">FAST N VAST <br> (More serviceable areas, shorter transit time)</th>
                                        <th style="background: #9BBB59" colspan="2">STEADY N BREEZY <br> (major cities, longer transit time, cheaper rates, COD possible)</th>
                                    </tr>
                                    <tr>
                                        <th style="background: #FFFF00" colspan="9">POUCH</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>9 x 14 (M)</td>
                                        <td>55</td>
                                        <td>1kg max</td>
                                        <td>148</td>
                                        <td>1kg max</td>
                                        <td>100</td>
                                    </tr>
                                    <tr>
                                        <td>11 x 17 (L)</td>
                                        <td>70</td>
                                        <td>3kg max</td>
                                        <td>220</td>
                                        <td>2kg max</td>
                                        <td>150</td>
                                    </tr>
                                    <tr>
                                        <th style="background: #FFFF00" colspan="9">OWN PACKAGING</th>
                                    </tr>
                                    <tr>
                                        <td style="background: #C4D79B">1.0</td>
                                        <td></td>
                                        <td rowspan="3">1st 3kg</td>
                                        <td rowspan="3">225</td>
                                        <td rowspan="3">1st 3kg</td>
                                        <td>100</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #C4D79B">2.0</td>
                                        <td>48</td>
                                        <td>160</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #C4D79B">3.0</td>
                                        <td>80</td>
                                        <td>205</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #C4D79B">Add on per kg</td>
                                        <td>25</td>
                                        <td></td>
                                        <td>80</td>
                                        <td></td>
                                        <td>75</td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="background: #C5BE97" colspan="2">Service Add Ons</th>
                                    </tr>
                                    <tr>
                                        <th style="background: #C2D69A" colspan="2">Collect & Deposit (Metro Manila)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1st P 5000 of Declared Value</th>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <th> > P 5000 Declared Value</th>
                                        <td>1.5% of total DV</td>
                                    </tr>
                                    <tr>
                                        <th style="background: #C2D69A">INSURANCE</th>
                                        <td>P 15 for 1st P500, P 5 for the succeeding fraction of P 500</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="well text-left">
                                <h4>NOTE</h4>
                                <ul>
                                    <li>Chargeable Weight - actual or volumetric weight whichever is higher (L x W x H cm / 3500)</li>
                                    <li>Dry ice/Ice gel, Styrofoam, plastic handles, and other supplies if needed should be used to provided protection for the goods.</li>
                                    <li>Rates above do not include the supplies needed and will be charged accordingly.</li>
                                    <li>Documentation (waybill with correct and complete information such as consignee details, destination), and items should be packaged properly and ready during the time of pickup to prevent delays.</li>
                                    <li>Out of town deliveries will have corresponding surcharges accordingly.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="international">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="text-center">International Rates</h3></div>

                        <div class="panel-body">
                            
                            <div class="well text-center">
                                <h4><a href="/templates/international.pdf" target="_blank"> <i class="fa fa-search fa-lg"></i> View international rates</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <span class="copyright">Clinship All rights reserved</span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-inline quicklinks">
                    <li><a href="terms-and-conditions">Terms and Conditions</a>
                    </li>
                    <li><a href="faqs">FAQS</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

@endsection
