@extends('userLayout.app')

{{--@section('title', 'Default')--}}

@section('style')
    @include('UserPanel.pages.advisor.css')
@endsection
@section('content')

    <div class="homeWrap ">
        <div class="container">
            <div class="row m-auto sectionOne">
                <div class="col-md-6 sectionOneLeft">
                    <h5>Open career doors through candid conversations</h5>
                    <p>We believe talent is everywhere—but access to opportunity isn’t. That’s why Candoor connects people with experienced Advisors for free, 1-on-1 conversations. These honest, human connections build confidence, spark clarity, and help grow careers—one conversation at a time.</p>
                    <!-- <a target='_blank' href="https://gpcyeic8882.typeform.com/to/Fudisj5H" class="signUpEarlyBtn"> -->
                    <a target='_blank' href="{{env('FRONTEND_URL_ADVISOR_SIGNUP')}}" class="signUpEarlyBtn">
                        Become an Advisor <img class="td-icon" src="{{ asset('images/UserImages/Home/chevRight.svg') }}" alt="">
                    </a>
                </div>
                <div class="col-md-6 sectionOneRight">
                    <img class="td-icon" src="{{ asset('images/UserImages/Home/landing1.png') }}" alt="">
                </div>
            </div>




        </div>
        <div class="container-fluid  itWorksWrap">
            <div class="container">
                <div class="row m-auto">
                    <div class="col-md-12 text-center sectionInside--">
                        <h5>How it works</h5>
                        <p>Starting with just one 30-minute conversation per month, you can make an impact on someone's career.</p>
                    </div>
                </div>
                <div class="row m-auto worksWrap">
                    <div class="col-md-3">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Group7.png') }}" alt="">
                        <h6>1. Complete your profile</h6>
                    </div>
                    <div class="col-md-3">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Group6.png') }}" alt="">
                        <h6>2. Set your monthly capacity</h6>
                    </div>
                    <div class="col-md-3">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Group5.png') }}" alt="">
                        <h6>3. Receive requests to chat</h6>
                    </div>
                    <div class="col-md-3">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Group11.png') }}" alt="">
                        <h6>4. Make a new connection!</h6>
                    </div>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="row m-auto sectionInside">
                <div class="col-md-12 text-center sectionInside--">
                    <h5>What you’ll do</h5>
                    <p>Choose what services you’ll offer from the list below (or add your own!) Your guidance can help talented college students and young professionals land and excel in the job of their dreams.</p>
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
                    <h5>Why join?</h5>
                    <p>We’re redefining networking—because everyone deserves someone in their corner. By becoming an Advisor, you’ll help level the playing field for professionals who lack access to the right connections, guidance, and opportunities. </p>
                </div>
                <div class="row m-auto networkWrapInner">
                    <div class="col-md-6 networkWrapInnerLeft">
                        <h6>Empower the next generation in need of access</h6>
                        <p>Career conversations are doors to opportunities that many still can’t reach. Whether you’re a hiring manager, employee resource group member, or someone with experience to share, your support can make a meaningful difference for a student or early-career professional taking the next step in their career.
                        </p>
                    </div>
                    <div class="col-md-6 networkWrapInnerRight">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/diversity.png') }}" alt="">
                    </div>
                </div>
                <div class="row m-auto networkWrapInner">
                    <div class="col-md-6 networkWrapInnerRight">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/share.png') }}" alt="">
                    </div>
                    <div class="col-md-6 networkWrapInnerLeft">
                        <h6>Share your expertise and learnings</h6>
                        <p>Whether you’ve pivoted many times in your career or pursued a steady path, you've gathered valuable insights and navigated “unspoken rules” along the way. As an Advisor, you’ll share your expertise and learnings with Advisees who are eager to learn from you as they navigate their own journeys.
                        </p>
                    </div>
                </div>
                <div class="row m-auto networkWrapInner">
                    <div class="col-md-6 networkWrapInnerLeft">
                        <h6>Pay it forward on your own schedule</h6>
                        <p>Unlike traditional 1-on-1 mentor matching programs, you set your own capacity (starting with just one 30-minute conversation per month) and Advisees come to you. This helps ensure your guidance is as relevant as possible, while we take care of scheduling, capacity management and more so you can focus on being a great Advisor.</p>
                    </div>
                    <div class="col-md-6 networkWrapInnerRight">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/autonomy.png') }}" alt="">
                    </div>
                </div>
                <div class="row m-auto networkWrapInner">
                    <div class="col-md-6 networkWrapInnerRight">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/impact.png') }}" alt="">
                    </div>
                    <div class="col-md-6 networkWrapInnerLeft">
                        <h6>Measure and scale your impact</h6>
                        <p>There’s no better feeling than making a positive difference in someone’s life. Through your Advisor Dashboard, you can stay connected with your Advisees and join a community of like-minded professionals who are passionate about expanding access to opportunities and helping others succeed.</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="container-fluid  testimonialsWrap p-0">
            <div class="testimonialsWrap--">
                <div class="col-md-12 text-center sectionInside--white">
                    <h5>See what our Advisors are saying</h5>
                </div>
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="row m-auto advisorWrap">
                            <div class="col-md-3">
                                <img class="advisor-icon" src="{{ asset('images/UserImages/Home/Blue.png') }}" alt="">
                            </div>
                            <div class="col-md-9">
                                <h6>Estevan</h6>
                                <p>“As a first-generation college student, it’s important to pass on the things I've learned to help level the playing field. Candoor has given me an incredible opportunity to do just that. Each of my conversations has been incredibly energizing — and in a short time, I’ve been able to make unique connections with professionals outside my usual bubble and make a tangible impact.”</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row m-auto advisorWrap">
                            <div class="col-md-3">
                                <img class="advisor-icon" src="{{ asset('images/UserImages/Home/Blue2.png') }}" alt="">
                            </div>
                            <div class="col-md-9">
                                <h6>Jhonnerys</h6>
                                <p>“All of the Advisees I’ve spoken to have highly relevant interests to my background — and in the course of my conversations, I could see that I made an impact. I wouldn’t be here today if it weren’t for the people who exposed me to new opportunities and supported me in achieving them, and Candoor has allowed me to be that cheerleader for others.”</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row m-auto advisorWrap">
                            <div class="col-md-3">
                                <img class="advisor-icon" src="{{ asset('images/UserImages/Home/Blue3.png') }}" alt="">
                            </div>
                            <div class="col-md-9">
                                <h6>Angel</h6>
                                <p>“Everyone has a unique story that goes beyond LinkedIn logos and resume titles; it just takes some polish and practice to make this story shine. What I’ve enjoyed most about being an Advisor is collaborating with Advisees to amplify their narratives and support them during their journeys. As a child of immigrants, I am humbled to give back and do my duty to address the opportunity gap.”</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row m-auto advisorWrap">
                            <div class="col-md-3">
                                <img class="advisor-icon" src="{{ asset('images/UserImages/Home/Blue4.png') }}" alt="">
                            </div>
                            <div class="col-md-9">
                                <h6>Nashae</h6>
                                <p>“Candoor is a great way for me to pay it forward to the next generation of leaders. I’m so happy to be able to connect with young professionals efficiently and fruitfully.”</p>
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
                                      <li>After you complete your profile, Advisees will be able to see you in our Advisor Directory and request to book a virtual meeting.</li>
                                        <li>When an Advisee requests a meeting with you, you will receive a notification via email with their goals and availability.</li>
                                      <li>Once you confirm a time, you’ll both automatically receive a calendar invite with a Zoom link.</li>
                                      <li>After your conversation, fill out our short feedback form to let us know how it went!</li>
                                      <li>Once you’ve reached your monthly capacity, Advisees will not be able to contact you until the 1st of the following month. You can edit your capacity at any time or pause your involvement for up to three months a year.</li>
                                  </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item  ">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What are the eligibility criteria for Advisors?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <p>To be eligible as a Candoor Advisor, you must have 1+ year of full-time work experience in the tech or business sectors and a passion for paying your learnings forward to support our community. While we currently focus on tech and business, we aspire to expand to other industries such as healthcare, law, and government in the future! </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item  ">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    What are the expectations of an Advisor?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                      <ul>
                                          <li>Be available for at least one 30-minute conversation per month</li>
                                          <li>Respond to Advisee inbounds within 72 hours</li>
                                          <li>Fill out our short feedback form after your conversations</li>
                                          <li>Honor your meeting times and minimize last-minute rescheduling and cancellations</li>
                                          <li>Actively listen and identify ways to tactically support Advisees</li>
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
                                        No, you do not! Advisors of all backgrounds are encouraged to join. We value a diverse community of Advisors who are united by a shared commitment to expanding access to opportunities and helping others succeed in their careers.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item  ">
                            <h2 class="accordion-header" id="headingThree2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree2" aria-expanded="false" aria-controls="collapseThree2">
                                    When will Advisees start reaching out to me?
                                </button>
                            </h2>
                            <div id="collapseThree2" class="accordion-collapse collapse" aria-labelledby="headingThree2" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        Candoor will be reviewing applications and onboarding our first Advisees to the platform in late Summer 2022. You can expect to start hearing from Advisees a few weeks afterwards.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item  ">
                            <h2 class="accordion-header" id="headingThree3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                                    Am I expected to introduce Advisees to people in my network?
                                </button>
                            </h2>
                            <div id="collapseThree3" class="accordion-collapse collapse" aria-labelledby="headingThree3" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                   <p>This is not an expectation; however, if you feel like an Advisee would benefit from talking to someone you know, feel free to introduce them! Better yet, invite them to join Candoor so they can scale their impact and manage their availability through our platform. </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item  ">
                            <h2 class="accordion-header" id="headingThree4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
                                    Can I keep in touch with Advisees for longer-term mentorship?
                                </button>
                            </h2>
                            <div id="collapseThree4" class="accordion-collapse collapse" aria-labelledby="headingThree4" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        Definitely! While Candoor excels at facilitating unlikely professional connections through 30-minute conversations, you’re more than welcome to stay in touch on a longer term basis with Advisees.
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
