@extends('userLayout.app')

{{--@section('title', 'Default')--}}

@section('style')
    @include('UserPanel.pages.home.css')
@endsection
@section('content')

    <div class="homeWrap ">
        <div class="container">
            <div class="row m-auto sectionOne">
                <div class="col-md-6 sectionOneLeft">
                    <h5>Candid conversations that open career doors</h5>
                    <p>We believe talent is everywhere—but access to opportunity isn’t. That’s why Candoor connects people with experienced Advisors for free, 1-on-1 conversations. These honest, human connections build confidence, spark clarity, and help grow careers—one conversation at a time.</p>
                    <!-- <a href="https://gpcyeic8882.typeform.com/to/Fudisj5H" class="signUpEarlyBtn"> -->
                    <a target='_blank' href="{{env('FRONTEND_URL_ADVISEE_SIGNUP')}}" class="signUpEarlyBtn">

                        Find an Advisor  <img class="td-icon" src="{{ asset('images/UserImages/Home/chevRight.svg') }}" alt="">
                    </a>
                </div>
                <div class="col-md-6 sectionOneRight">
                    <img class="td-icon" src="{{ asset('images/UserImages/Home/landing1.png') }}" alt="">
                </div>
            </div>

            <div class="row m-auto sectionInside">
                <div class="col-md-12 text-center sectionInside--">
                    <h5>Your champion on the inside</h5>
                    <p>Our Advisors have worked at the world’s leading companies, including:</p>
                </div>
                <div class="row m-auto companies">
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/McKinsey.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Google.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Tesla.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Goldman.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Microsoft.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Amazon.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Bain.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Apple.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Uber.png') }}" alt="">
                    </div>

                </div>
                <div class="row m-auto companies">
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Airbnb.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/L.E.K..png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Deloitte.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Facebook.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/BCG.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Salesforce.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Morgan.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/TripAdvisor.png') }}" alt="">
                    </div>
                    <div class="col align-self-center">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Dropbox.png') }}" alt="">
                    </div>

                </div>
            </div>

            <div class="row m-auto sectionInside">
                <div class="col-md-12 text-center sectionInside--">
                    <h5>Personalized support at every step of your journey</h5>
                    <p>Whether you’re exploring career paths or ready to land your next role, we’ve got you covered.</p>
                </div>

                <div class="row m-auto stepWrap">

                    <div class="col-md-2">
                        <div class="row m-auto">
                            <div class="col-md-12 text-center box-">
                                <img class="td-icon" src="{{ asset('images/UserImages/Home/lightbulb.png') }}" alt="">
                            </div>
                            <div class="col-md-12 text-center">
                                <h6>Career <br> Advice</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="row m-auto">
                            <div class="col-md-12 text-center box-">
                                <img class="td-icon" src="{{ asset('images/UserImages/Home/network.png') }}" alt="">
                            </div>
                            <div class="col-md-12 text-center">
                                <h6>Networking  <br> Strategies</h6>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="row m-auto">
                            <div class="col-md-12 text-center box-">
                                <img class="td-icon" src="{{ asset('images/UserImages/Home/looking.png') }}" alt="">
                            </div>
                            <div class="col-md-12 text-center">
                                <h6>Job Search  <br> Strategies</h6>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="row m-auto">
                            <div class="col-md-12 text-center box-">
                                <img class="td-icon" src="{{ asset('images/UserImages/Home/resume.png') }}" alt="">
                            </div>
                            <div class="col-md-12 text-center">
                                <h6>Resume  <br> Reviews</h6>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="row m-auto">
                            <div class="col-md-12 text-center box-">
                                <img class="td-icon" src="{{ asset('images/UserImages/Home/interview.png') }}" alt="">
                            </div>
                            <div class="col-md-12 text-center">
                                <h6>Interview Prep &  <br> Mock Interviews</h6>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="row m-auto">
                            <div class="col-md-12 text-center box-">
                                <img class="td-icon" src="{{ asset('images/UserImages/Home/hand.png') }}" alt="">
                            </div>
                            <div class="col-md-12 text-center">
                                <h6>Personalized  <br> Feedback</h6>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>



        <div class="container networkWrap">
            <div class="row m-auto ">
                <div class="col-md-12 text-center sectionInside--">
                    <h5>We’re redefining networking—because everyone deserves someone in their corner.</h5>
                    <p>Candoor is committed to making career opportunities accessible and inclusive. Our platform connects people with professionals who can help them explore, break into, and thrive in their dream jobs. Whether you're a student, early-career professional, or seeking a career change, we provide the guidance you need to move forward with confidence.</p>
                </div>
                <div class="row m-auto networkWrapInner">
                    <div class="col-md-6 networkWrapInnerLeft">
                        <h6>Expanding Access to Career-Advancing Networks</h6>
                        <p>For many, professional success isn’t just about skills and qualifications—it’s about who you know. Candoor bridges this gap by providing direct access to professionals across industries, ensuring that career growth isn’t limited by background, zip code, or existing networks.</p>
                    </div>
                    <div class="col-md-6 networkWrapInnerRight">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/diversity.png') }}" alt="">
                    </div>
                </div>
                <div class="row m-auto networkWrapInner">
                    <div class="col-md-6 networkWrapInnerRight">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/exposure.png') }}" alt="">
                    </div>
                    <div class="col-md-6 networkWrapInnerLeft">
                        <h6>See yourself in any role</h6>
                        <p>Not sure where to start or what’s next for your career? Explore career paths by connecting with Advisors from a variety of industries, companies and roles. You name it, they’ve done it — and you can do it too.</p>
                    </div>
                </div>
                <div class="row m-auto networkWrapInner">
                    <div class="col-md-6 networkWrapInnerLeft">
                        <h6>Grow your professional network on your own terms</h6>
                        <p>Unlike traditional mentor matching programs, we believe that the best relationships form organically. We empower you to choose your own Advisors based on your unique goals and needs and join a community of like-minded Advisees accelerating their careers.</p>
                    </div>
                    <div class="col-md-6 networkWrapInnerRight">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/accessibility.png') }}" alt="">
                    </div>
                </div>
                <div class="row m-auto networkWrapInner">
                    <div class="col-md-6 networkWrapInnerRight">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/human.png') }}" alt="">
                    </div>
                    <div class="col-md-6 networkWrapInnerLeft">
                        <h6>Get personalized guidance from on-the-job professionals</h6>
                        <p>What if you could know why your resume wasn't getting past the system or how much you should really be getting paid? Get the inside scoop from on-the-job professionals who are eager to share their insights and advice with you — tailored to your specific situation.</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="container-fluid  itWorksWrap">
            <div class="container">
                <div class="row m-auto">
                    <div class="col-md-12 text-center sectionInside--">
                        <h5>How it works</h5>
                        <p>Connect with a friendly career Advisor in 4 easy steps:</p>
                    </div>
                </div>
                <div class="row m-auto worksWrap">
                    <div class="col-md-3">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Group4.png') }}" alt="">
                        <h6>1. Tell us about yourself and your career goals.</h6>
                    </div>
                    <div class="col-md-3">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Group3.png') }}" alt="">
                        <h6>2. Browse our Advisor Directory to find one who is right for you.</h6>
                    </div>
                    <div class="col-md-3">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Group22.png') }}" alt="">
                        <h6>3. Send them a message and your availability for a virtual meeting.</h6>
                    </div>
                    <div class="col-md-3">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Group11.png') }}" alt="">
                        <h6>4. Make a new connection!</h6>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid  testimonialsWrap p-0">
            <div class="testimonialsWrap--">
                <div class="col-md-12 text-center sectionInside--white">
                    <h5>See what our Advisees are saying</h5>
                </div>
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="row m-auto advisorWrap">
                            <div class="col-md-3">
                                <img class="advisor-icon" src="{{ asset('images/UserImages/Home/testimonila1.png') }}" alt="">
                            </div>
                            <div class="col-md-9">
                                <h6>Sydney</h6>
                                <p>“As a first generation student, I had no one to help guide my next career steps. Immediately, I connected with accomplished female advisors who helped narrow the roles I applied to. Once I got an interview, I spoke with an Advisor from that same company, who helped me understand what to expect and how to pitch myself. As a result, I got a job offer at Deloitte!”</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row m-auto advisorWrap">
                            <div class="col-md-3">
                                <img class="advisor-icon" src="{{ asset('images/UserImages/Home/testimonila2.png') }}" alt="">
                            </div>
                            <div class="col-md-9">
                                <h6>Laura</h6>
                                <p>“One of my Advisors said: ‘We’re going to get you started so you can get an internship at Google.’ I had never heard those words before and never thought they were possible. Yet he immediately introduced me to others and recommended the best book to prepare. I now feel like I have an understanding of how to get there.”</p>
                           </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row m-auto advisorWrap">
                            <div class="col-md-3">
                                <img class="advisor-icon" src="{{ asset('images/UserImages/Home/testimonila3.png') }}" alt="">
                            </div>
                            <div class="col-md-9">
                                <h6>Selly</h6>
                                <p>“The best part was being able to tap into the minds of people I wouldn't have access to otherwise - like a PM at Apple or a VC from General Catalyst. While my school has alumni in finance, we have very few in tech and entrepreneurship… there’s so much to learn from people who have already taken these paths.”</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row m-auto advisorWrap">
                            <div class="col-md-3">
                                <img class="advisor-icon" src="{{ asset('images/UserImages/Home/testimonila4.png') }}" alt="">
                            </div>
                            <div class="col-md-9">
                                <h6>Ndunge</h6>
                                <p>“I came into this not knowing how to network and I got more and more comfortable with every conversation. It was like a trial run where I could ask questions and not feel afraid of being judged.”</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="container FAQWrap">
            <div class="row m-auto ">
                <div class="col-md-12 text-center sectionInside--">
                    <h5>Frequently Asked Questions</h5>
                    <p>Have other questions? Get in touch at hello@candoor.io</p>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="accordion " id="accordionExample">
                        <div class="accordion-item  ">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How does it work?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <ul>
                                      <li> Sign Up & Share Your Goals – Create your Advisee profile and let us know what you're looking for in your career journey.
                                      </li>
                                      <li>Find an Advisor – Use our directory with helpful filters to connect with professionals by industry, role, and services offered.
                                      </li>
                                      <li>Schedule a Meeting – Request virtual one-on-one sessions with up to two advisors each month. Our platform helps you craft outreach messages and handle scheduling.
                                      </li>
                                      <li>Prepare for Success – Once confirmed, you'll receive a calendar invite with a Zoom link and conversation starters.
                                      </li>
                                      <li>Gain Insights & Build Connections – Receive practical advice, expand your professional network, and provide feedback to help us improve the experience!
                                      </li>
                                  </ul>


                                </div>
                            </div>
                        </div>
                        <!-- <div class="accordion-item  ">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    When will the Advisee application go live?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <p>Our application will go live in Summer 2022. In the meantime, please fill out our short interest form, as we will give those on the interest form early access to our application!</p>
                                </div>
                            </div>
                        </div> -->
                        <div class="accordion-item  ">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Who is eligible to join as an Advisee?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>We welcome anyone who: </p>
                                      <ul>
                                          <li>Has at least a high school diploma or GED.</li>
                                          <li>Has fewer than six years of professional experience.</li>
                                          <li>Needs access to a professional network and may have limited social capital.</li>
                                      </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item  ">
                            <h2 class="accordion-header" id="headingThree1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree1" aria-expanded="false" aria-controls="collapseThree1">
                                    Do I have to identify with a specific background to apply?
                                </button>
                            </h2>
                            <div id="collapseThree1" class="accordion-collapse collapse" aria-labelledby="headingThree1" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        No! Candoor is open to all professionals looking to expand their networks and career knowledge. We are especially committed to supporting those who have historically had limited access to industry connections, but everyone is welcome.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item  ">
                            <h2 class="accordion-header" id="headingThree3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                                    What are the expectations of an Advisee?
                                </button>
                            </h2>
                            <div id="collapseThree3" class="accordion-collapse collapse" aria-labelledby="headingThree3" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <p>
                                We want all participants to get the most out of their experience. This means:
                                    </p>
                                        <ul>
                                        <li>
                                            Preparing for meetings with clear questions or career goals.
                                        </li>
                                        <li>
                                            Respecting advisors' time and keeping scheduled meetings.
                                        </li>
                                        <li>
                                            Following up with a thank-you message after each session.
                                        </li>
                                        <li>
                                            Completing a brief feedback form to help us improve the program.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item  ">
                            <h2 class="accordion-header" id="headingThree4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
                                    Can I build long-term relationships with Advisors?
                                </button>
                            </h2>
                            <div id="collapseThree4" class="accordion-collapse collapse" aria-labelledby="headingThree4" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        Yes! While Candoor facilitates initial 30-minute conversations, you’re encouraged to continue the relationship if both you and the advisor feel it’s valuable. Many Advisees stay in touch with advisors for long-term mentorship and career support.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')

    @include('UserPanel.pages.home.script')

@endsection
