@extends('userLayout.app')

{{--@section('title', 'Default')--}}

@section('style')
    @include('UserPanel.pages.contactUs.css')
@endsection


@section('content')
    <div class="container contactWrap">
        <div class="row m-auto">
            <div class="col-md-6 contactLeft">
                <h2>Contact Us</h2>
                <p>
                    We'd love to talk about partnerships, investment opportunities, media inquiries or anything else you'd like to reach out to us about!
                </p>
                <p>
                    Drop us a line using the form  and we’ll get back to you as soon as possible.
                </p>

                <img class="td-icon" src="{{ asset('images/UserImages/Home/illustration.png') }}" alt="">


            </div>
            <div class="col-md-6 contactRight">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif
                <div class="row m-auto contactRightWrap">
                    <h2>General Inquiries</h2>
                    <form id="contact-form" action="{{route('post/general/inquiries')}}" method="post">
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
                                <input type="email" class="form-control fc-mail" id="email" placeholder="you@company.com" name="email" required>
                                <img class="mail-icon" src="{{ asset('images/UserImages/Home/mail1.svg') }}" alt="">
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label">Subject</label>
                               <select class="form-select" id="select-subject"  >
                                    <option value="">Select a subject</option>
                                    <option value="General Inquiries">General Inquiries </option>
                                    <option value="Partnership Opportunities">Partnership Opportunities</option>
                                    <option value="Investor Relations">Investor Relations</option>
                                    <option value="Media & Press Inquiries">Media & Press Inquiries</option>
                                    <option value="Other">Other</option>

                               </select>

                                <input type="text" style="position: absolute; visibility: hidden;left:0" id="subject" name="subject" required>

                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Message</label>
                                <textarea  class="form-control" rows="5" required id="message" placeholder="Start typing..." name="message"></textarea>
                            </div>
                        </div>
                        <div class="col-12 text-center pt-1">
                            <button type="submit" value="Submit" id="contact-form-submit-btn" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>



@endsection

@section('scripts')
    @include('UserPanel.pages.contactUs.script')
@endsection
