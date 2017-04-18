@extends('layouts.front')

@section('scripts')
    <script type="text/javascript">
        $('.carousel').carousel({
          interval: 4000
        })
    </script>
@endsection

@section('content')

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <header class="header1">
        <div class="container">
            <div class="intro-text">
                <div class="intro-heading">Is your shipment ready?</div>
                <div class="intro-lead-in">Snap. Enter pickup details. Schedule pickup. </div>
                <h4>Download the CliqnShip Mobile App Now</h4>
                <a href="#" class="btn btn-default btn-download">
                    <span class="text1">Get it for</span>
                    <span class="text2">Android</span>
                    <i class="fa fa-android fa-3x icon"></i>
                </a>
                <a href="#" class="btn btn-default btn-download">
                    <span class="text1">Get it for </span>
                    <span class="text2">iOs</span>
                    <i class="fa fa-apple fa-3x icon"></i>
                </a>
            </div>
        </div>
    </header>
    </div>
    <div class="item">
        <header class="header2">
            <div class="container">
                <div class="intro-text">
                    <div class="intro-heading text-primary" style="font-size: 60px">Need your payments collected?</div>
                <div class="intro-lead-in" style="font-size: 35px"> We can take care of it for you. Increase your sales by offering COD!</div>
                    <h4>Download the CliqnShip Mobile App Now</h4>
                    <a href="#" class="btn btn-default btn-download">
                        <span class="text1">Get it for</span>
                        <span class="text2">Android</span>
                        <i class="fa fa-android fa-3x icon"></i>
                    </a>
                    <a href="#" class="btn btn-default btn-download">
                        <span class="text1">Get it for </span>
                        <span class="text2">iOs</span>
                        <i class="fa fa-apple fa-3x icon"></i>
                    </a>
                </div>
            </div>
        </header>
    </div>
  </div>
</div>
<!-- Header -->

    <!-- Services Section -->
    <section id="howto">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">How To</h2>
                    <h3 class="section-subheading text-muted">Sign up your bussiness and ship out these orders in 3 easy steps</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Sign Up</h4>
                    <p class="text-muted">Click on <a href="/register">Register</a>. It takes just seconds to sign up.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-dropbox fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Pack and Schedule</h4>
                    <p class="text-muted">Prepare your shipment. You have the option to print or use a handwritten waybill. Just ask our couriers for supplies.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-rocket fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">We pick it up and ship out!</h4>
                    <p class="text-muted">Schedule a pick-up date and one of our couriers will arrive at your door on the date specified.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">About Cliqnship</h2>
                    <h3 class="section-subheading" style="padding: 0 15%;">
                        cliqNship (CNS) is a leading door to door and logistics solution provider that 
                        specializes in moving shipments across the country and around the world with just 1-cliq.
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <div class="well well-lg" style="color: #000">
                        <em>“Dealing with freight used to be a headache and ate up a lot of my time. Things are completely different since I started using you guys. With CliqNShip handling all our shipping for us, I have more time to focus on growing my business. I can’t thank you enough!”</em> <strong>- Charles Ley, Manuka</strong>
                    </div>

                    <p>We envisioned <strong>cliqNship</strong> not only as a pickup and delivery service company, but as one that actively and passionately caters to your shipping needs and other SME (Small Medium Enterprise) and e-commerce concerns. We believe that cliqNship is more than the traditional delivery service. We are beyond that. We are a company who is driven to provide an excellent and personalized experience to its customers and clients. We aim to see them grow and succeed with us--reaching one's maximum potential, together.</p>

                    <p>Founded last <strong>October 2011</strong>, cliqNship started during the boom of e-commerce in the Philippines. As with every startup company, we started small but we were aggressive. Soon enough, we grew and are now servicing thousands of clients--making sure they receive awesome service from our team.</p>

                    <p>Every day, we continue to look and explore for more ways to make our services <strong>"awesome-r"</strong>, not only for our direct clients, but also for our clients' clients as well. It is an unending process and we want to ensure that everyone is more than satisfied. To see our clients grow and to know that we are part of their growth is more than enough to motivate and drive us to deliver awesomeness right at your doorstep.</p>
                    <p>So come on and <strong>#choosecliqnship</strong> coz we make sure that <strong>#everybodygetsit</strong>!</p>

                    <hr>
                </div>
            </div>
        </div>
    </section>

    <section id="whyus">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Why Us?</h2>
                    <h4 class="section-heading" style="text-decoration: underline;">Why #choosecliqnship? Here are the reasons we make sure #everybodygetsit!</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ol>
                        <li>
                            <h5>Receive your items right away!</h5>
                            <p class="text-muted"> - Our fast, priority shipping gets your items where you want them at the soonest time possible. </p>
                        </li>
                        <li>
                            <h5>Connect with our responsive customer service team!</h5>
                            <p class="text-muted"> - May it be on the phone, SMS or across our online accounts, our team makes sure you are attended to, 100% satisfied and happy at all costs. <em>Happy cliqers = awesomeness!</em> </p>
                        </li>
                        <li>
                            <h5>Meet our friendly neighborhood riders!</h5>
                            <p class="text-muted"> - Always with a smile, our cool and reliable team of riders ensures that your items are picked up and delivered on time and in good condition. </p>
                        </li>
                        <li>
                            <h5>Get up-to-date delivery statuses on your package!</h5>
                            <p class="text-muted"> - Check your package’s delivery status on our user-friendly tracking page. It even comes with an SMS feature which updates both shipper and consignee! Yay! </p>
                        </li>
                        <li>
                            <h5>Make payments hassle-free with our Collect N Deposit/COD service!</h5>
                            <p class="text-muted"> - We can collect payments from your customers and deposit them to your specified bank account--it’s that easy! </p>
                        </li>
                        <li>
                            <h5>Protect your packages with our budget-friendly insurance add-on!</h5>
                            <p class="text-muted"> - Safekeep your fragile items at a lower cost by having them insured. Get added security for your items! </p>
                        </li>
                        <li>
                            <h5>Get your food items out there! We deliver them, too!</h5>
                            <p class="text-muted"> - This is for all our food-loving cliqers! We deliver pastries, cookies, non-perishables and the like. (Unfortunately, this excludes cooked items, cakes with soft icing, frozen goods, highly sensitive, easily spoiled food items and the like.) </p>
                        </li>
                        <li>
                            <h5>Expand your market with our flexible international shipping services!</h5>
                            <p class="text-muted"> - Become a global brand and deliver your products anywhere in the world! You may choose from our range of international delivery options like Express, EMS and Postal services based on your budget and transit time requirements. </p>
                        </li>
                        <li>
                            <h5>Store your items with us! (and we can help you prepare orders, too!)</h5>
                            <p class="text-muted"> - With our pickNstore and pickNpack warehousing services, you may store your items...and we can help you prepare the orders for delivery as well! Email us at <strong>info@cliqnship.com</strong> for more details. </p>
                        </li>
                        <li>
                            <h5>Manage your orders and deliveries with your personalized cliqNship team member!</h5>
                            <p class="text-muted"> - Need a helping hand with increasing orders? We can help you handle all the dirty work of processing and packing all your orders with your personal cliqNship team member! Such fun! </p>
                        </li>
                        <li>
                            <h5>Get maximum exposure across multiple channels!</h5>
                            <p class="text-muted"> - Expand your network with marketing and promotional collaborations with cliqNship! </p>
                        </li>
                        <li>
                            <h5>Create your online store with our help!</h5>
                            <p class="text-muted"> - Want to setup your own online store but don’t know how? We are glad to help out! Build, customize and manage effectively your own website for your online store through our awesome partners. Find out more by calling us at 6348181 or emailing us at <strong>be-a-cliqer@cliqnship.com</strong>. </p>
                        </li>
                        <li>
                            <h5>Ship more to earn more points!</h5>
                            <p class="text-muted"> - Receive exclusive cliqer perks when you garner more points simply by shipping with us! Plus you get to level up your cliqer status as your points grow! </p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Clients Aside -->
    <aside class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h4>Featured Cliqers</h5>
                    <hr>
                </div>
                <div class="col-md-2 col-sm-6">
                    <a href="#">
                        <img src="images/partner1.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-2 col-sm-6">
                    <a href="#">
                        <img src="images/partner2.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-2 col-sm-6">
                    <a href="#">
                        <img src="images/partner3.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-2 col-sm-6">
                    <a href="#">
                        <img src="images/partner4.png" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-2 col-sm-6">
                    <a href="#">
                        <img src="images/partner5.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-2 col-sm-6">
                    <a href="#">
                        <img src="images/partner6.png" class="img-responsive img-centered" alt="">
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-12" style="color: #fff">
                                <h3>CALL US </h3>
                                <div class="col-md-6">
                                    <h5>634.8181 (Landline)</h5>
                                    <h5>0917.839.5561 (Globe)</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>SMS US : 0998.988.6912 (Smart)</h5>
                                    <h5>Email: info@cliqnship.com</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Send Message</button>
                            </div>
                        </div>
                    </form>
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
