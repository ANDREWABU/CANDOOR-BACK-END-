@extends('userLayout.app')

{{--@section('title', 'Default')--}}

@section('style')
    @include('UserPanel.pages.about.css')
@endsection


@section('content')
<div class="aboutWrapMain">
    <div class="container-fluid aboutWrap">
        <div class="container">
            <div class="row m-auto">
                <div class="col-md-12 text-center sectionInside--white">
                    <h5>About Us</h5>
                    <p>We're democratizing access to professional networks - because "who you know" shouldn't limit your career opportunities.</p>
                </div>
                <br><br> <br>
                <img class="team-img" src="{{ asset('images/UserImages/Home/team-photo.png') }}" alt="">
                <br>
                <div class="col-md-12 aboutWrapText">
                    <p>When it comes to career progression, “who you know” matters. Unfortunately, not all networks are created equal. <a class="according-to-linkedIn-a" target="_blank" href="https://blog.linkedin.com/2019/september/26/closing-the-network-gap">According to LinkedIn</a>,  individuals from high-income zip codes, elite schools, and top companies have up to a 12x advantage in gaining access to opportunities. While candidates with strong networks often have contacts to refer them and walk them through the hiring process, many do not—leaving them unsure whether their resumes are even reviewed and uncertain about how to grow into their dream roles.
                        <br> <br>
                        That’s why we founded Candoor: a platform designed to help people in need of access to career opportunities book free, 1-on-1 conversations with professionals in their dream jobs. Redefining career access by expanding networks and unlocking opportunities, our mission is to empower the next generation of business leaders by democratizing access to transformative careers.
                        <br> <br>
                        We’re not your typical mentorship program. Our three-sided platform allows Advisors to pay it forward on their own schedule, Advisees to gain the knowledge, feedback, and connections they need to break into their dream roles, and employers to hire and retain diverse talent at scale.
                        <br> <br>
                        Together, we aspire to create a world where talent is no longer limited by who you know, and access to opportunity is available to all.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container meetTeam">
        <div class="row m-auto">
            <div class="col-md-12 text-center sectionInside--">
                <h5>Meet the Team</h5>
                <p>Candoor is a 100% minority and women-led business. Driven by our own experiences navigating historically non-diverse industries like consulting, finance, and tech, we’re a team of industry professionals passionate about expanding access to opportunities and paying it forward.</p>
            </div>
        </div>

        <div class="row m-auto width-team">

        <div class="col-md-3 testimonial " data-id="1">
                <div class="row m-auto">
                    <div class="card">
                        <div class="card-body">
                            <img class="owner-img" src="{{ asset('images/UserImages/Home/owner1.png') }}" alt="">
                            <h6>Abdelwadood Daoud</h6>
                            <p>Chief Executive Officer <br>& Co-founder</p>
                            <img class="arrow-icon" src="{{ asset('images/UserImages/Home/Down-Right.png') }}" alt="">
                            <img class="arrow-icon2" src="{{ asset('images/UserImages/Home/Down-Right2.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 testimonial" data-id="4">
                <div class="row m-auto">
                    <div class="card">
                        <div class="card-body">
                            <img class="owner-img" src="{{ asset('images/UserImages/Home/owner4.png') }}" alt="">
                            <h6>Uma Abu</h6>
                            <p>Chief Technology Officer<br> & Co-founder</p>
                            <img class="arrow-icon" src="{{ asset('images/UserImages/Home/Down-Right.png') }}" alt="">
                            <img class="arrow-icon2" src="{{ asset('images/UserImages/Home/Down-Right2.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-3 testimonial active" data-id="3">
                <div class="row m-auto">
                    <div class="card">
                        <div class="card-body">
                            <img class="owner-img" src="{{ asset('images/UserImages/Home/owner3.png') }}" alt="">
                            <h6>Kristina Hu</h6>
                            <p>Co-founder</p>
                            <img class="arrow-icon" src="{{ asset('images/UserImages/Home/Down-Right.png') }}" alt="">
                            <img class="arrow-icon2" src="{{ asset('images/UserImages/Home/Down-Right2.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 testimonial" data-id="2">
                <div class="row m-auto">
                    <div class="card">
                        <div class="card-body">
                            <img class="owner-img" src="{{ asset('images/UserImages/Home/owner2.png') }}" alt="">
                            <h6>Shelby Schrier</h6>
                            <p>Co-founder</p>
                            <img class="arrow-icon" src="{{ asset('images/UserImages/Home/Down-Right.png') }}" alt="">
                            <img class="arrow-icon2" src="{{ asset('images/UserImages/Home/Down-Right2.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-md-12 testimonial-text active" id="testimonial-text-3">
                <p>
                    <strong> Kristina Hu</strong>
                        is a Co-founder of Candoor. After studying economics at Harvard College, she started her career in investment banking at Morgan Stanley in New York. Afterwards, she pivoted to tech, where she worked in multiple roles at Uber including data analytics, strategy & business development, and product management. (Two of those roles were at Uber’s EMEA office in Amsterdam!) In May 2022, she graduated from Harvard Business School. She co-founded Candoor to level the playing field in access to opportunity and inspire fellow business leaders to become DEI advocates in their own organizations.
                </p>
            </div>


            <div class="col-md-12 testimonial-text" id="testimonial-text-2">
                <p>
                <strong> Shelby Schrier</strong>
                    Shelby Schrier is a Co-founder of Candoor. She co-founded Candoor because she believes opening traditionally closed-off networks is a meaningful way to democratize opportunity access and she aspires to pave the way for future female and minority entrepreneurs. Prior to Candoor, Shelby was a Senior Data Analyst at Tripadvisor and an Associate Consultant at L.E.K. She holds an MBA from Harvard Business School and a BA in Mathematics from Dartmouth College.
                </p>
            </div>
            <div class="col-md-12 testimonial-text" id="testimonial-text-1">
                <p>
                    <strong> Abdelwadood (Wadood) Daoud</strong>
                    is a Senior Program Manager at Microsoft and previously spent time at Tesla and the US Department of Energy. He graduated from Iowa State University with a Bachelor's in Engineering. He was also heavily involved with the National Society of Black Engineers where he served as the National Finance Chair focused on building symbiotic partnerships . Through his experiences in NSBE and the technology industry, he has seen how critical it is to be given a "chance." He co-founded Candoor because he wanted to give as many people as possible the same “chance” he was given. Regardless of the goal, he truly believes that anything can be achieved with the right mix of knowledge, networking, and confidence.

                </p>
            </div>
            <div class="col-md-12 testimonial-text" id="testimonial-text-4">
                <p>
                    <strong>Uma Abu</strong>
                    is a software engineer at Netflix. Before Netflix, he was a Software Engineer at Microsoft. He graduated from Iowa State University with a Bachelor in Software Engineering. While in college, he was heavily involved with the Iowa State Chapter of the National Society of Black Engineers, where he served as a senator representing the Chapter on a Regional and National Level. Uma has a passion for Software and technology. He co-founded Candoor because he strongly believes in the mission to democratize opportunity access. He also believes talking to the right person can change your life and mindset, and everyone should have the equal opportunity to find that right person.
                </p>
            </div>
        </div>

    </div>


    <div class="container">
        <div class="row m-auto">
            <div class="col-md-12 text-center sectionInside--">
                <h5>Our Values</h5>
                <p>Our philosophy is simple: hire a team of diverse, passionate people and foster a culture that empowers you to do your best work.</p>
            </div>
        </div>
        <div class="row m-auto valuesWrap">
            <div class="col-md-4">
                <img src="{{ asset('images/UserImages/Home/Featuredicon.png') }}" alt="">
                <h6>Embody Our Mission</h6>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/UserImages/Home/Featuredicon1.png') }}" alt="">

                <h6>Never Stop Learning</h6>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/UserImages/Home/Featuredicon2.png') }}" alt="">
                <h6>Transparency & Candoor</h6>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/UserImages/Home/Featuredicon3.png') }}" alt="">
                <h6>Lead with Empathy</h6>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/UserImages/Home/Featuredicon4.png') }}" alt="">
                <h6>Betting on Potential</h6>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/UserImages/Home/Featuredicon5.png') }}" alt="">
                <h6>Winning Together</h6>
            </div>
        </div>
    </div>

    <div class="container-fluid aboutStoryWrap">
        <div class="container">
            <div class="row m-auto">
                <div class="col-md-12 text-center sectionInside--">
                    <h5>Our Story</h5>
                </div>
            </div>
            <div class="row m-auto">
                <p>
                    Over the last 2 years, Kristina and Shelby have been laser focused on advancing racial equity through their own spheres of influence. Recognizing that they wouldn't be where they are today without their networks, they launched a Harvard Business School Class Mentor Directory through which they and 70 fellow MBA students published their professional backgrounds and contact info online to extend their professional knowledge and networks to underrepresented groups. In just two weeks (and only two LinkedIn posts) the directory drew 200+ inbounds! <br><br>

                    Meanwhile, working across the country, Wadood and Uma grew increasingly frustrated at a recruitment process that was blind to potential. They knew hundreds of students and early in-career professionals who had the potential to excel but were struggling to land interviews or even get their resumes read. They decided to focus their efforts on building a program that leveraged the intrinsic motivations of ERG members, allies, and hiring managers to get minoritized individuals scheduled for candid conversations with hiring managers. Their efforts (and unique approach) led to 6 successful hires in a matter of weeks. It became evident their approach could - and should - be scaled across organizations.<br><br>

                    When the two teams were introduced, they quickly realized they were working toward the same underlying mission, and that their unique combination of perspectives, skill sets, and networks would enable them to make the scale of impact they were aspiring to. And so… Candoor was born! <br><br>

                    Talk about the power of connections 😉

                </p>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
    @include('UserPanel.pages.about.script')
@endsection
