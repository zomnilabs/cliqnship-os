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
                <a class="btn btn-primary" href="#provincial" class="provincial active" aria-controls="provincial" role="tab" data-toggle="tab">
                  <i style="font-size: 6em" class="fa fa-truck"></i> <h4>Provincial</h4>
                </a>
                 <a class="btn btn-primary" href="#metromanila" class="metromanila" aria-controls="metromanila" role="tab" data-toggle="tab">
                  <i style="font-size: 6em" class="fa fa-motorcycle"></i> <h4> Metro Manila</h4>
                </a>
                <a class="btn btn-primary" href="#international" class="international" aria-controls="international" role="tab" data-toggle="tab">
                  <i style="font-size: 6em" class="fa fa-plane"></i> <h4>International</h4>
                </a>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="provincial">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="text-center">Provincial Rates</h3></div>

                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="background: #f1e0ad">Weight</th>
                                        <th style="background: #c7de77">Regular Shipment</th>
                                        <th style="background: #c7de77">Food Items</th>
                                        <th style="background: #cb90ce" colspan="3">FAST N VAST</th>
                                        <th style="background: #4393b9" colspan="3">STEADY N BREEZY</th>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad"></td>
                                        <td style="background: #c7de77"></td>
                                        <td style="background: #c7de77"></td>
                                        <th style="background: #cb90ce" colspan="3">More Servicable Areas, Shorter Transit Time</th>
                                        <th style="background: #4393b9" colspan="3">Major Cities, Longer Transit Time, Cheaper Rates, COD Possible</th>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad"></td>
                                        <th style="background: #c7de77" colspan="2">METRO MANILA</th>
                                        <th style="background: #cb90ce">LUZ</th>
                                        <th style="background: #cb90ce">VIZ</th>
                                        <th style="background: #cb90ce">MIN</th>
                                        <th style="background: #4393b9">LUZ</th>
                                        <th style="background: #4393b9">VIZ</th>
                                        <th style="background: #4393b9">MIN</th>
                                    </tr>
                                    <tr>
                                        <th style="background: #b1d047" colspan="9">UNLIPOUCH</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="background: #f1e0ad">7 x 11 (S)</td>
                                        <td style="background: #c7de77">38</td>
                                        <td style="background: #c7de77"></td>
                                        <td style="background: #cb90ce"></td>
                                        <td style="background: #cb90ce"></td>
                                        <td style="background: #cb90ce"></td>
                                        <td style="background: #4393b9">90</td>
                                        <td style="background: #4393b9">95</td>
                                        <td style="background: #4393b9">100</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad">9 x 14 (M)</td>
                                        <td style="background: #c7de77">48</td>
                                        <td style="background: #c7de77"></td>
                                        <td style="background: #cb90ce">138</td>
                                        <td style="background: #cb90ce">148</td>
                                        <td style="background: #cb90ce">150</td>
                                        <td style="background: #4393b9">95</td>
                                        <td style="background: #4393b9">100</td>
                                        <td style="background: #4393b9">120</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad">11 x 17 (L)</td>
                                        <td style="background: #c7de77">68</td>
                                        <td style="background: #c7de77"></td>
                                        <td style="background: #cb90ce">200</td>
                                        <td style="background: #cb90ce">220</td>
                                        <td style="background: #cb90ce">225</td>
                                        <td style="background: #4393b9">100</td>
                                        <td style="background: #4393b9">110</td>
                                        <td style="background: #4393b9">130</td>
                                    </tr>
                                    <tr>
                                        <th style="background: #b1d047" colspan="9">OWN PACKAGING</th>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad">1.0</td>
                                        <td style="background: #c7de77"></td>
                                        <td style="background: #c7de77"></td>
                                        <td style="background: #cb90ce" rowspan="3">200</td>
                                        <td style="background: #cb90ce" rowspan="3">220</td>
                                        <td style="background: #cb90ce" rowspan="3">225</td>
                                        <td style="background: #4393b9">100</td>
                                        <td style="background: #4393b9">110</td>
                                        <td style="background: #4393b9">130</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad">2.0</td>
                                        <td style="background: #c7de77">48</td>
                                        <td style="background: #c7de77"></td>
                                        <td style="background: #4393b9">160</td>
                                        <td style="background: #4393b9">175</td>
                                        <td style="background: #4393b9">195</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad">3.0</td>
                                        <td style="background: #c7de77">68</td>
                                        <td style="background: #c7de77">88</td>
                                        <td style="background: #4393b9">205</td>
                                        <td style="background: #4393b9">210</td>
                                        <td style="background: #4393b9">260</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad">Add on per kg</td>
                                        <td style="background: #c7de77">25</td>
                                        <td style="background: #c7de77">30</td>
                                        <td style="background: #cb90ce">80</td>
                                        <td style="background: #cb90ce">80</td>
                                        <td style="background: #cb90ce">80</td>
                                        <td style="background: #4393b9">75</td>
                                        <td style="background: #4393b9">75</td>
                                        <td style="background: #4393b9">75</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="well text-left">
                                <h4>NOTE</h4>
                                <ul>
                                    <li>All rates are VAT inclusive</li>
                                    <li>Valuation/Insurance charge - P 15 for 1st P500, P 5 for the succeeding fraction</li>
                                    <li>Chargeable Weight - actual or volumetric weight whichever is higher (L x W x H cm / 3500)</li>
                                    <li>Extra charges apply for Out of Delivery Zone (ODZ)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="metromanila">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="text-center">Metro Manila Rates</h3></div>

                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="background: #f1e0ad">Weight</th>
                                        <th style="background: #c7de77">Regular Shipment</th>
                                        <th style="background: #c7de77">Food Items</th>
                                        <th style="background: #cb90ce" colspan="3">FAST N VAST</th>
                                        <th style="background: #4393b9" colspan="3">STEADY N BREEZY</th>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad"></td>
                                        <td style="background: #c7de77"></td>
                                        <td style="background: #c7de77"></td>
                                        <th style="background: #cb90ce" colspan="3">More Servicable Areas, Shorter Transit Time</th>
                                        <th style="background: #4393b9" colspan="3">Major Cities, Longer Transit Time, Cheaper Rates, COD Possible</th>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad"></td>
                                        <th style="background: #c7de77" colspan="2">METRO MANILA</th>
                                        <th style="background: #cb90ce">LUZ</th>
                                        <th style="background: #cb90ce">VIZ</th>
                                        <th style="background: #cb90ce">MIN</th>
                                        <th style="background: #4393b9">LUZ</th>
                                        <th style="background: #4393b9">VIZ</th>
                                        <th style="background: #4393b9">MIN</th>
                                    </tr>
                                    <tr>
                                        <th style="background: #b1d047" colspan="9">UNLIPOUCH</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="background: #f1e0ad">7 x 11 (S)</td>
                                        <td style="background: #c7de77">38</td>
                                        <td style="background: #c7de77"></td>
                                        <td style="background: #cb90ce"></td>
                                        <td style="background: #cb90ce"></td>
                                        <td style="background: #cb90ce"></td>
                                        <td style="background: #4393b9">90</td>
                                        <td style="background: #4393b9">95</td>
                                        <td style="background: #4393b9">100</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad">9 x 14 (M)</td>
                                        <td style="background: #c7de77">48</td>
                                        <td style="background: #c7de77"></td>
                                        <td style="background: #cb90ce">138</td>
                                        <td style="background: #cb90ce">148</td>
                                        <td style="background: #cb90ce">150</td>
                                        <td style="background: #4393b9">95</td>
                                        <td style="background: #4393b9">100</td>
                                        <td style="background: #4393b9">120</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad">11 x 17 (L)</td>
                                        <td style="background: #c7de77">68</td>
                                        <td style="background: #c7de77"></td>
                                        <td style="background: #cb90ce">200</td>
                                        <td style="background: #cb90ce">220</td>
                                        <td style="background: #cb90ce">225</td>
                                        <td style="background: #4393b9">100</td>
                                        <td style="background: #4393b9">110</td>
                                        <td style="background: #4393b9">130</td>
                                    </tr>
                                    <tr>
                                        <th style="background: #b1d047" colspan="9">OWN PACKAGING</th>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad">1.0</td>
                                        <td style="background: #c7de77"></td>
                                        <td style="background: #c7de77"></td>
                                        <td style="background: #cb90ce" rowspan="3">200</td>
                                        <td style="background: #cb90ce" rowspan="3">220</td>
                                        <td style="background: #cb90ce" rowspan="3">225</td>
                                        <td style="background: #4393b9">100</td>
                                        <td style="background: #4393b9">110</td>
                                        <td style="background: #4393b9">130</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad">2.0</td>
                                        <td style="background: #c7de77">48</td>
                                        <td style="background: #c7de77"></td>
                                        <td style="background: #4393b9">160</td>
                                        <td style="background: #4393b9">175</td>
                                        <td style="background: #4393b9">195</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad">3.0</td>
                                        <td style="background: #c7de77">68</td>
                                        <td style="background: #c7de77">88</td>
                                        <td style="background: #4393b9">205</td>
                                        <td style="background: #4393b9">210</td>
                                        <td style="background: #4393b9">260</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #f1e0ad">Add on per kg</td>
                                        <td style="background: #c7de77">25</td>
                                        <td style="background: #c7de77">30</td>
                                        <td style="background: #cb90ce">80</td>
                                        <td style="background: #cb90ce">80</td>
                                        <td style="background: #cb90ce">80</td>
                                        <td style="background: #4393b9">75</td>
                                        <td style="background: #4393b9">75</td>
                                        <td style="background: #4393b9">75</td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="background: #e27451" colspan="2">Service Add Ons</th>
                                    </tr>
                                    <tr>
                                        <th style="background: #b1d047" colspan="2">Collect & Deposit (Metro Manila)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th style="background: #f1e0ad">1st P 5000 of Declared Value</th>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <th style="background: #f1e0ad"> > P 5000 Declared Value</th>
                                        <td>1.5% of total DV</td>
                                    </tr>
                                    <tr>
                                        <th style="background: #f1e0ad">INSURANCE</th>
                                        <td>P 15 for 1st P500, P 5 for the succeeding fraction of P 500</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="well text-left">
                                <h4>NOTE</h4>
                                <ul>
                                    <li>All rates are VAT inclusive</li>
                                    <li>Valuation/Insurance charge - P 15 for 1st P500, P 5 for the succeeding fraction</li>
                                    <li>Chargeable Weight - actual or volumetric weight whichever is higher (L x W x H cm / 3500)</li>
                                    <li>Extra charges apply for Out of Delivery Zone (ODZ)</li>
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
