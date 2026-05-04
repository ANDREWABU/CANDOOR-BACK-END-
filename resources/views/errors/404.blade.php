@extends('userLayout.app')

{{--@section('title', 'Default')--}}

@section('style')
    @include('errors.css')
@endsection
@section('content')

    <div class="homeWrap ">
        <div class="container">
            <div class="row m-auto four-0-wrap">
                <div class="col-md-6 align-self-center">
                    <span class="error-code-text">404 error</span>
                    <h2 class="error-code-heading">Page not found</h2>
                    <p class="error-code-detail">Sorry, the page you are looking for doesn't exist. <br> Here are some helpful links:</p>
                    <a href="{{URL::previous()}}" class="goBack"> <img src="{{ asset('images/UserImages/Home/Icon2.png') }}" class="arrow-left"> Go Back</a>
                    <a href="{{route('/')}}" class="takeHome">Take me home</a>
                </div>
                <div class="col-md-6 align-self-center text-center">
                    <img src="{{ asset('images/UserImages/Home/notFound/404.png') }}" class="error-code-image">

                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')

    @include('errors.script')

@endsection
