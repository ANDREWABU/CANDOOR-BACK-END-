@extends('userLayout.app')

{{--@section('title', 'Default')--}}

@section('style')
    @include('UserPanel.pages.Partner.css')
@endsection
@section('content')

    <div class="homeWrap partnerWrap">
        <div class="container-fluid partnerWrap-1">
            <div class="container">
                <div class="row m-auto">
                    <div class="col-md-12 text-center">
                        <h5>Partner With Us</h5>
                    </div>
                    <div class="col-md-12 aboutWrapText">
                        <p>Join us in empowering the next generation of Black, Latinx & Indigenous leaders.
                    </div>
                </div>
            </div>
        </div>




        <div class="container networkWrap networkWrapPartner">
            <div class="row m-auto ">
                <div class="row m-auto networkWrapInner">
                    <div class="col-md-6 networkWrapInnerLeft">
                        <h6>Employers</h6>
                        <p>Are you an employer looking to diversify your workforce? Our partners use Candoor to diversify their applicant pipeline and get their employees involved in mentorship efforts - ultimately helping to build their brand with our community of Black, Latinx and Indigenous professionals.</p>
                        <ul>
                            <li>
                                <img class="tick-icon" src="{{ asset('images/UserImages/Home/Check-icon.png') }}" alt="">
                                <p>Diversify your talent pipeline with candidates who have been pre-vetted by experienced industry professionals</p>
                            </li>
                            <li>
                                <img class="tick-icon" src="{{ asset('images/UserImages/Home/Check-icon.png') }}" alt="">
                                <p>Demonstrate your company’s culture and commitment to diversity, equity and inclusion in a remote-first world</p>
                            </li>

                            <li>
                                <img class="tick-icon" src="{{ asset('images/UserImages/Home/Check-icon.png') }}" alt="">
                                <p>Provide scalable, flexible ways for your employees to pay it forward and measure their impact</p>
                            </li>
                        </ul>

                    </div>
                    <div class="col-md-6 networkWrapInnerRight text-center">
                        <img class="td-icon m-auto" src="{{ asset('images/UserImages/Home/employe-1.png') }}" alt="">
                    </div>
                </div>
                <div class="row m-auto networkWrapInner">
                    <div class="col-md-6 networkWrapInnerRight">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/Community-2.png') }}" alt="">
                    </div>
                    <div class="col-md-6 networkWrapInnerLeft">
                        <h6>ERGs, Mentorship Organizations and Professional Communities</h6>
                        <p>Are you an professional community, mentorship program, or Employee Resource Group looking to provide more value to your members? Our partners choose Candoor to broaden their members’ professional networks, support them throughout their careers and scale their organization’s impact.</p>
                        <ul>
                            <li>
                                <img class="tick-icon" src="{{ asset('images/UserImages/Home/Check-icon.png') }}" alt="">
                                <p>Expose your members to new career paths and professionals working at their dream companies</p>
                            </li>
                            <li>
                                <img class="tick-icon" src="{{ asset('images/UserImages/Home/Check-icon.png') }}" alt="">
                                <p>Support your members’ careers by tapping into our community of experienced industry professionals</p>
                            </li>

                            <li>
                                <img class="tick-icon" src="{{ asset('images/UserImages/Home/Check-icon.png') }}" alt="">
                                <p>Provide scalable, flexible ways for your members to pay it forward and measure their impact</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row m-auto networkWrapInner">
                    <div class="col-md-6 networkWrapInnerLeft">
                        <h6>Student Clubs & University Career Offices</h6>
                        <p>Calling all student clubs, career offices and school-affiliated groups! Our partners choose Candoor to broaden their members’ professional networks and accelerate their careers.</p>
                        <ul>
                            <li>
                                <img class="tick-icon" src="{{ asset('images/UserImages/Home/Check-icon.png') }}" alt="">
                                <p>Augment your school’s alumni network by tapping into our diverse community of experienced industry professionals</p>
                            </li>
                            <li>
                                <img class="tick-icon" src="{{ asset('images/UserImages/Home/Check-icon.png') }}" alt="">
                                <p>Connect your members with leading employers and relevant job opportunities</p>
                            </li>

                            <li>
                                <img class="tick-icon" src="{{ asset('images/UserImages/Home/Check-icon.png') }}" alt="">
                                <p>Access curated career development resources to supplement your school or club’s existing offerings</p>
                            </li>
                        </ul>

                    </div>
                    <div class="col-md-6 networkWrapInnerRight">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/employe-2.png') }}" alt="">
                    </div>
                </div>
                <div class="row m-auto networkWrapInner">
                    <div class="col-md-6 networkWrapInnerRight">
                        <img class="td-icon" src="{{ asset('images/UserImages/Home/employe-3.png') }}" alt="">
                    </div>
                    <div class="col-md-6 networkWrapInnerLeft">
                        <h6>DEI Educators and Practitioners</h6>
                        <p>We value your expertise! Our vision is to equip every Candoor community member with the knowledge and know-how to effectively champion underserved professionals and become changemakers in their own organizations.</p>
                        <ul>
                            <li>
                                <img class="tick-icon" src="{{ asset('images/UserImages/Home/Check-icon.png') }}" alt="">
                                <p>Market your services to Candoor’s users, who are passionate about diversity, equity and inclusion</p>
                            </li>
                            <li>
                                <img class="tick-icon" src="{{ asset('images/UserImages/Home/Check-icon.png') }}" alt="">
                                <p>Support a 100% minority- and women-led business in reinventing traditional recruiting processes to be more efficient and equitable</p>
                            </li>

                            <li>
                                <img class="tick-icon" src="{{ asset('images/UserImages/Home/Check-icon.png') }}" alt="">
                                <p>Scale your reach and impact</p>
                            </li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>


        <div class="container-fluid partnerWrap-1">
            <div class="container">
                <div class="row m-auto">
                    <div class="col-md-12 text-center">
                        <h5>Want to learn more?</h5>
                    </div>
                    <div class="col-md-12 aboutWrapText">
                        <p>Submit this form and a Candoor team member will be in touch shortly. <br> For general or press inquiries, email
                            <a href="mailto:hello@candoor.io">hello@candoor.io</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container partnerContactFormWrap">
            <div class="row m-auto">

                <div class="col-md-2"></div>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif
                <div class="col-md-8 contactRightWrap">
                    <form id="partner-with-us-form" action="{{route('post/general/partnership')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" class="form-control" id="first_name" placeholder="First name" name="first_name" required>
                            </div>
                            <div class="col-6">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="last_name" placeholder="Last name" name="last_name" required>
                            </div>
                            <div class="col-12 position-relative">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control " id="email" placeholder="you@company.com" name="email" required>
                            </div>
                            <div class="col-12">
                                <label for="job_title" class="form-label">Job Title</label>
                                <input type="text" class="form-control" id="job_title" placeholder="Type here...." name="job_title" required>
                            </div>
                            <div class="col-12">
                                <label for="company_name" class="form-label">Company or Organization Name</label>
                                <input type="text" class="form-control" id="company_name" placeholder="Type here...." name="company_name" required>
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label">Company or Organization Size</label>
                                <select class="form-select" id="select-subject" name="company_size" >
                                    <option value="">Select a size...</option>
                                    <option value="0 - 1">0 - 1</option>
                                    <option value="2 - 10">2 - 10</option>
                                    <option value="11 - 50">11 - 50</option>
                                    <option value="51 - 200">51 - 200 </option>
                                    <option value="201 - 500">201 - 500 </option>
                                    <option value="501 - 1000">501 - 1000 </option>
                                    <option value="1001 - 5000">1001 - 5000 </option>
                                    <option value="5001 - 10000">5001 - 10000 </option>
                                    <option value="10,000+">10,000+</option>
                                </select>

                                <!-- <input type="text" style="position: absolute; visibility: hidden;left:0" id="subject" name="subject" required> -->

                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Message</label>
                                <textarea  class="form-control" rows="5" required id="message" placeholder="" name="message"></textarea>
                            </div>
                        </div>
                        <div class="col-12 text-center pt-1">
                            <button type="submit" value="Submit" id="partner-with-us-form-submit-btn" class="btn btn-primary">Send Message</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>

            </div>
        </div>


    </div>

@endsection

@section('scripts')

    @include('UserPanel.pages.Partner.script')

@endsection
