@extends('layouts.front')

@section('content')

<header id="faqs">
    <div class="container">
        <div class="intro-text">
        </div>
    </div>
</header>

<section style="min-height: 100vh">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Frequently Asked Questions</h2>
            </div>
        </div>
        <div class="faqs">
            <div class="panel-group" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 >
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      How do I register at cliqNship?
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                     Simply fill out the form in our homepage. You will be directed to our registration page where you will supply your contact information. Submitting all the required information will make you a registered cliqNship member (in our terms, a full-pledged CLIQer)! A verification message shall be sent to your email to verify your cliqNship account. Afterwards, you can now CLIQ away!
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Is there a pickup fee?
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                    No. We do not charge a pickup fee.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      What areas do you pickup outside Metro Manila?
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body">
                    We currently DO NOT offer pickup outside Metro Manila yet.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingFour">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      Is there a package limit?
                    </a>
                  </h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                  <div class="panel-body">
                    NO, there is no package limit. We offer FREE pick up your shipment(s) within Metro Manila. NO MINIMUM.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingFive">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                      How do I contact cliqNship?
                    </a>
                  </h4>
                </div>
                <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                  <div class="panel-body">
                    You may get in touch with cliqNship through: 
                    <ul>
                        <li>Mobile Numbers: </li>
                        <ul>
                            <li>0917.839.5561 (Globe)</li>
                            <li>0939.924.1242 (Smart) </li>
                        </ul>
                        <li>Email: info@cliqnship.com </li>
                        <li>Skype ID: cliqnship</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingSix">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                      How do I schedule a pickup?
                    </a>
                  </h4>
                </div>
                <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                  <div class="panel-body">
                    You may schedule your pickup at our website by signing in to your cliqNship account. For those who do not have internet access and who don't have their cliqNship accounts yet, you may schedule your pickup by calling us at: 
                    <h6>Mobile Numbers: </h6>
                    <ul>
                        <li>0917.839.5561 (Globe) </li>
                        <li>0939.924.1242  (Smart)</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingSeven">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                      How do I confirm my pickup?
                    </a>
                  </h4>
                </div>
                <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                  <div class="panel-body">
                    Whether you book thru online or phone, you will be issued your own Airway Bill. Having your Airway Bill means your pickup is confirmed.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingEight">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                      When is your cut-off time for booking a pickup?
                    </a>
                  </h4>
                </div>
                <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                  <div class="panel-body">
                    For Mondays to Fridays, our booking cut-off is at 2 PM. For Saturdays, our booking cut-off is at 12 PM.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingNine">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                      Can I request for a specific pickup time?
                    </a>
                  </h4>
                </div>
                <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                  <div class="panel-body">
                    We cannot guarantee specific pickup times as we cannot predict road conditions everyday. We can accommodate this accordingly for special arrangements.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTen">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                      Can I create my own airway bill?
                    </a>
                  </h4>
                </div>
                <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                  <div class="panel-body">
                    Yes you can create your waybill online at our website www.cliqnship.com
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingEleven">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                      What days do you pickup and deliver?
                    </a>
                  </h4>
                </div>
                <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEleven">
                  <div class="panel-body">
                    We pick up and deliver from Monday to Saturday. We don't have operations on Sundays.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwelve">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                      Why do I need to indicate the declared value of my shipment?
                    </a>
                  </h4>
                </div>
                <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwelve">
                  <div class="panel-body">
                    In the rare case that your shipment is lost in transit, this is the amount that will be refunded to you.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThirteen">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                      What are your operating hours?
                    </a>
                  </h4>
                </div>
                <div id="collapseThirteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThirteen">
                  <div class="panel-body">
                    We operate from Monday to Saturday, 9 AM to 6 PM.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingFourteen">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                      What are the sizes of your pouches?
                    </a>
                  </h4>
                </div>
                <div id="collapseFourteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFourteen">
                  <div class="panel-body">
                     Current size of our pouch is 11x17"
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingFifteen">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
                      What if my item doesn’t fit any of your pouches?
                    </a>
                  </h4>
                </div>
                <div id="collapseFifteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFifteen">
                  <div class="panel-body">
                     If it doesn’t fit in the pouch, item will be measured by weight or volume, whichever is higher.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingSixteen">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen">
                      What if I don't know the weight of my package?
                    </a>
                  </h4>
                </div>
                <div id="collapseSixteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSixteen">
                  <div class="panel-body">
                     Courier that will pick up the item can weigh the item for you or can be weighed at our office.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingSeventeen">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeventeen" aria-expanded="false" aria-controls="collapseSeventeen">
                      How will the payment be made?
                    </a>
                  </h4>
                </div>
                <div id="collapseSeventeen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeventeen">
                  <div class="panel-body">
                     Payment is made upon pickup.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingEighteen">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEighteen" aria-expanded="false" aria-controls="collapseEighteen">
                       Do you accept electronic gadgets for shipment?
                    </a>
                  </h4>
                </div>
                <div id="collapseEighteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEighteen">
                  <div class="panel-body">
                      Yes. cliqNship accepts electronic gadgets for shipment.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingNineteen">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNineteen" aria-expanded="false" aria-controls="collapseNineteen">
                        Do you offer insurance?
                    </a>
                  </h4>
                </div>
                <div id="collapseNineteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNineteen">
                  <div class="panel-body">
                      Yes. We are offering the cliqNship insurance as an add on service. Our valuation/insurance charge for both Metro Manila and Provincial deliveries is P15.00 for 1st P500.00 and P5.00 for the succeeding fraction of P500.00.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwenty">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwenty" aria-expanded="false" aria-controls="collapseTwenty">
                        What is the chargeable weight?
                    </a>
                  </h4>
                </div>
                <div id="collapseTwenty" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwenty">
                  <div class="panel-body">
                      Chargeable weight is the actual or volumetric weight of the package, whichever is higher.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwentyOne">
                  <h4 >
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwentyOne" aria-expanded="false" aria-controls="collapseTwentyOne">
                        How do I compute for volumetric weight?
                    </a>
                  </h4>
                </div>
                <div id="collapseTwentyOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwentyOne">
                  <div class="panel-body">
                      <p>
                        For local shipments, we get the volumetric weight by multiplying the length (L), width (W) and height (H) in centimeters and dividing it by 3500.
                      </p>
                      <p class="text-center">
                        LWH <br>
                        ------------ <br>
                        3500
                      </p>
                      <p>
                        For local shipments, we get the volumetric weight by multiplying the length (L), width (W) and height (H) in centimeters and dividing it by 5000.
                      </p>
                      <p class="text-center">
                        LWH <br>
                        ------------ <br>
                        5000
                      </p>
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
