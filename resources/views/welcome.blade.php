@extends('layouts.front')

@section('content')

    <!--- Main front -->
    <div id="main_front">
        <div class="overlay"></div>
        <div class="front_txt">
            <div class="row">
                <div class="col-md-6 col-md-offset-6 col-sm-6 col-xs-12">
                    <p class="title"><strong>IS YOUR SHIPMENT READY?</strong></p>
                    <p class="main-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p>
                    {{--<div class="small-title">Wanna have something shipped for your business</div>--}}
                    {{--<div class="front_signup">--}}
                        {{--<span>SIGN-UP HERE! AND HAVE IT SHIPPED</span>--}}
                    {{--</div>--}}
                    {{--<div class="small-title"><span>Packed and shipped already? Find out  where it is?</span></div>--}}
                    {{--<div class="front_signup">--}}
                        {{--<span>LET'S LOCATE IT!</span>--}}
                    {{--</div>--}}
                    <a href="#" class="app-link">
                        <img src="images/play_store.png" alt="Get it on play store">
                    </a>
                    <a href="#" class="app-link">
                        <img src="images/app_store.png" alt="Get it on app store">
                    </a>
                </div>
            </div>
        </div>
    </div> <!--- End of Main front -->

    <!---Bussiness Signup -->
    <div id="bussiness-signup" style="min-height: 75vh;">
        <div class="container">
            <div class="bs-content">
                <div class="bs-title">
                    <p>SIGN UP YOUR BUSSINESS</br>
                        AND SHIP OUT THOSE ORDERS</br>
                        IN 3 EASY STEPS</br>
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="bs-thumbnail" id="bs-collect-deposit">
                            <img class="img-responsive slide-left" src="images/online-tracking.png" style="height: 130px; width: auto;"/>
                            <div class="caption">
                                <h3>SIGN UP</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</p>
                            </div>
                        </div>
                        <a href="#" class="bs-btn-signup">SIGN UP HERE</a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="bs-thumbnail" id="bs-free-logo">
                            <img class="img-responsive " id="bs-img-middle" src="images/free.png" style="height: 130px; width: auto;"/>
                            <div class="caption">
                                <h3>PACK AND SCHEDULE</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="bs-thumbnail" id="bs-track-logo">
                            <img class="img-responsive  slide-right" src="images/pick-pack.png" style="height: 130px; width: auto;"/>
                            <div class="caption">
                                <h3>WE PICK IT UP!</br>
                                    AND IT SHIPPED OUT
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <a href="#" class="bs-btn-signup">TRACK IT NOW</a>
                    </div>
                </div><!--end of row -->
            </div>
        </div><!-- end of container -->
    </div><!--- End of Bussiness Singup -->
    <!--- Affilitates Program -->
    <div id="af_program">
        <div class="container">
            <div class="ap-main-content">
                <h1 class="ap-title">Why we love to help?</h1>
                <div class="row ap-content">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="af-wrap" id="af-left-content">
                            <img class="img-responsive img-worker af-wrap" src="images/worker.png"/>
                            <img class="img-panda" src="images/panda-logo.png"/>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="af-wrap" id="af-right-content">
                            <p>"Dealing with freight used to be a </br> headache and ate up a lot of my</br> time.
                                </br>
                                Things are completey different</br> since I started using you guys.</br> With <b><i>cliqNship</i></b> handling all our</br> shipping for us, I have more time</br> to focus on growing my business.</br> I can't thank you enough!"
                            </p>
                            <img class="img-charles" src="images/charles-ley.png"/>
                            <div id="ap-name">CHARLES LEY,</div>
                            <div id="ap-company">Manuka Health</div>
                            <span class="btn-ap-title">LEARN ABOUT OUR AFFILITATES PROGRAM</span>
                        </div>
                    </div>
                </div>
                <h1 class="ap-title">And it is not just Manuka Health</h1>
            </div>
        </div>
    </div><!-- End of Affilitates Program -->
    <!--- Grow -->
    <div id="grow">
        <div class="bg-top"></div>
        <div class="container">
            <div class="grow-wrapper">
                <div class="img-company-logo">
                    <img src="images/company-logo.png"/>
                </div>
                <div class="grow-title" id="grow-titleup">
                    Here's how are we going to help you grow
                </div>
                <div class="grow-main-content">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <div class="grow-content">
                                <p class="title-content"><b>BIG</b> <span class="or">or</span> small</br></br></p>
                                We aim to see them grow
                                and <b><i>succeed with us</i></b>
                                reaching one's maximum
                                potential together
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <img class="img-responsive img-tree" src="images/tree.png">
                        </div>
                    </div>
                </div>
                <div class="grow-title" id="grow-titledown">
                    And supply you with...
                </div>
                <img class="img-grow slideanim" src="images/sheep.png">
            </div><!--- End of grow wrapper -->
        </div>
    </div><!-- End of Grow -->
    <!--- Supply -->
    <div id="supply">
        <div class="content">
            <div class="supply-wrapper">
                <div class="supply-upper">
                    <img class="img-robo slideanim" src="images/robo.png"/>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <img src="images/security.jpg"/>
                            <div class="caption">
                                <h4>SECURITY AND INSURANCE</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua.</p> <br />
                                <a href="#" class="btn-security-rates">VIEW RATES</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <img src="images/travel.jpg"/>
                            <div class="caption">
                                <h4>INTERNATIONAL SHIPPING</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua.</p> <br />
                                <a href="#" class="btn-security-rates">VIEW RATES</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <img src="images/time.jpg"/>
                            <div class="caption">
                                <h4>ROUND THE CLOCK ONLINE TRACKING</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua.</p> <br />
                                <a href="#" class="btn-security-rates">VIEW RATES</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="supply-lower">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="caption">
                                <img src="images/pick-pack.jpg"/>
                                <h4>FREE PICK AND PACK</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna.</p>
                            </div>
                            <a href="#" class="btn-security-rates">VIEW RATES</a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="caption">
                                <img src="images/storage.jpg"/>
                                <h4>STORAGE SPACE AND WAREHOUSE</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore.</p>
                            </div>
                            <a href="#" class="btn-security-rates">VIEW RATES</a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="caption">
                                <img src="images/truck.jpg"/>
                                <h4>BUSINESS SERVICE</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                            <a href="#" class="btn-security-rates">VIEW RATES</a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="caption">
                                <img id="img-collect-deposit" src="images/collect.png"/>
                                <h4>COLLECT AND DEPOSITE</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                            <a href="#" class="btn-security-rates">VIEW RATES</a>
                        </div>
                    </div>
                </div>
            </div><!-- end of supply wrapper -->
        </div><!-- end of supply container -->
    </div><!-- End of Supply -->
    <!-- Goal -->
    <div id="goal">
        <div class="container">
            <div class="goal-wrapper">
                <div class="row">
                    <div class="col-sm-6 col-sm-push-6 goal-right-content">
                        <p>"Our goal is to enrich your passion<br/>by providing various help to you<br/>
                            and your customers<br/> with efficient and speedy<br/> pickup and delivery"
                        </p><br/>
                        <span class="goal-name">-Cliq N Ship</span>
                    </div>
                    <div class="col-sm-6 col-sm-pull-6 goal-left-content">
                        <img class="img-responsive" src="images/delivery-boy.png">
                    </div>
                </div>
            </div>
        </div>
    </div><!---- End of Goal-->
    <!--- Shipment Info -->
    <div id="shipment-info">
        <div class="bg-top-black"></div>
        <div class="container">
            <div class="shipment-wrapper">
                <img src="images/bg-shipment.png">
                <div class="row" id="shipment-content">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <p>In <b>1-CLIQ</b> you can instantly compare prices between trusted
                            local and international carriers, and choose the best price and
                            options wherever your shipment is going. Lower your shipment
                            costs tremedously through our negotiated high-volume discounts.
                        </p>
                        <p>
                            You can also book, mange and track all your shipments.
                            Plus, you can submit paperwork in one consolidated place using
                            your cliqNship account... and even earn points as you continue
                            shipping with us!
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12"></div>
                </div>
            </div>
        </div>
    </div><!-- End of Shipment Info -->
    <footer>
        <div class="footer-content">
            <div class="footer-logo"><img src="images/logo-footer.png"></div>
            <div class="footer-txt">SIGN-IN/SIGN UP</br><div class="divider"></div>
                RATES</br><div class="divider"></div>
                AFFILIATES PROGRAM </br><div class="divider"></div>
                TRACK ORDERS</br><div class="divider"></div>
                CONTACT US NEWS AND UPDATES</br><div class="divider"></div>
            </div>
            <div>
                <div class="img-footer"><img src="images/gmail.png"/></div>
                <div class="img-footer"><img src="images/facebook-logo.png"/></div>
                <div class="img-footer"><img src="images/instagram-logo.png"/></div>
            </div>
            <div class="pull-right rights">
                <div>Clinship All rights reserved</div>
                <div>Powered by:Cloudlogiclimited</div>
            </div>
        </div>
    </footer>
@endsection
