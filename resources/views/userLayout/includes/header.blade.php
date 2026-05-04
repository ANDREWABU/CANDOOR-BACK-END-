
<div class="headerWrap">
    <div class="container p-0">
        <nav class="navbar navbar-expand-lg navbar-light customNav">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('/')}}">
                    <img class="whiteBg-icon" src="{{ asset('images/UserImages/Home/logoWhite.svg') }}" alt="">
                    <img class="blueBg-logo" src="{{ asset('images/UserImages/Home/Horizontal.svg') }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-md-auto gap-2">
                        <li class="nav-item rounded">
                            <a class="nav-link active" href="{{route('about')}}" aria-current="page" >About</a>
                        </li>
                        <li class="nav-item rounded">
                            <a class="nav-link"  href="{{route('partner')}}">Partners</a>
                        </li>
                        <li class="nav-item rounded">
                            <a class="nav-link"  href="{{route('contact')}}">Contact</a>
                        </li>
                        <li class="nav-item rounded">
                            <a class="nav-link Ba-btn" href="@if(Route::currentRouteName()=='/') {{route('/advisor')}} @else {{route('/')}} @endif"
                            >Become an @if(Route::currentRouteName()=='/') Advisor @else Advisee @endif   <img class="td-icon" src="{{ asset('images/UserImages/Home/rightChevron.svg') }}" alt=""></a>
                        </li>
                        <li class="nav-item rounded">
                            <a target="_blank" class="nav-link log-in-button" href="{{env('FRONTEND_URL')}}"
                            >Log In   </a>
                        </li>

                        <li class="nav-item rounded">
                            <a class="nav-link Ba-btn2" href="https://gpcyeic8882.typeform.com/to/Fudisj5H">Sign Up for Early Access  <img class="td-icon" src="{{ asset('images/UserImages/Home/chevRight.svg') }}" alt=""></a>
                        </li>

                        <li class="nav-item rounded">
                            <a class="nav-link Ba-btn3" href="https://gpcyeic8882.typeform.com/to/Fudisj5H">Sign Up for Early Access  <img class="td-icon" src="{{ asset('images/UserImages/Home/rightChevron.svg') }}" alt=""></a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
