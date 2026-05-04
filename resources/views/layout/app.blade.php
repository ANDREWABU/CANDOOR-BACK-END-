<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>Career Space</title>
    <!-- Google font-->
    <script src="https://kit.fontawesome.com/e3c44fa1ae.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/5.0.0/umd/popper.min.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    @include('layout.includes.css')
    @yield('style')
</head>

<body @if (Route::current()->getName() == 'index') onload="startTime()" @endif>
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>
    {{-- @if (Route::current()->getName() == 'index')
    @endif --}}
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('layout.includes.header')
        <!-- Page Header Ends  -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">

            <!-- Page Sidebar Start-->
            @include('layout.includes.sidebar')

            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 center-block">
                            @section('alertcontent')
                                @if (session()->has('success'))
                                    <div class="alert alert-success p-2 text-center" id="alert" style="border-radius: 20px">
                                        <span>{{ session()->get('success') }}</span>
                                    </div>
                                @endif
                                @if (session()->has('warning'))
                                    <div class="alert alert-success p-2 text-center" id="alert" style="border-radius: 20px">
                                        <span>{{ session()->get('warning') }}</span>
                                    </div>
                                @endif
                                @if (session()->has('error'))
                                    <div class="alert alert-success p-2 text-center" id="alert" style="border-radius: 20px">
                                        <span>{{ session()->get('error') }}</span>
                                    </div>
                                @endif
                            @endsection
                        </div>
                    </div>
                    <div class="page-title">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-5">
                                @yield('breadcrumb-title')
                            </div>
                            <div class="col-2">
                                @yield('alertcontent')
                            </div>
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('/') }}"> <i
                                                data-feather="home"></i></a></li>
                                    @yield('breadcrumb-items')
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button trigger modal -->

                @include('layout.includes.modal')

                <!-- Container-fluid starts-->
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('layout.includes.footer')


        </div>
    </div>
    {{-- @dd(url()->current(),'here') --}}
    <!-- latest jquery-->
    @include('layout.includes.script')

    {{-- Scripts --}}
    @yield('scripts')

</body>

</html>
