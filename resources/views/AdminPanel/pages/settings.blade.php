@extends('layout.app')

@section('title', 'Settings')
@section('style')
    <style>
        .dropdown .dropdown-toggle:after{
            content:'' !important
        }
        .nav-tabs .nav-link.active {
          background-color:#76c4e3 !important;
            color: white;
            border: 0;
      }
        .nav-tabs .nav-link {
          margin-right: 1px;
          border: 2px solid #ecf3fa;
      }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Settings</h3>
@endsection

@section('alertcontent')
    @if (session()->has('update'))
        <div class="alert alert-success p-2 text-center" id="alert" style="border-radius: 20px">
            <span>{{session()->get('update')}}</span>
        </div>
    @endif
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')

    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#experience" role="tab" aria-controls="experience" aria-selected="true">Experience</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#user_role" role="tab" aria-controls="user_role" aria-selected="false">User Roles</a>
                                </div>
                            </nav>
                        </div>
                        <div class="card-body">
                            <section id="tabs" class="project-tab">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="experience" role="tabpanel" aria-labelledby="nav-home-tab">
                                                    <table class="table table-bordered text-center">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">S/N</th>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Description</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($experience as $exper)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <th scope="row">{{$exper->title}}</th>
                                                                <td>{{$exper->description}}</td>
                                                                <td style="text-align:right">
                                                                    <div class="dropdown">
                                                                        <span class="dropdown-toggle " id="dropdownMenuButton1" data-bs-toggle="dropdown" style="background:none">
                                                                            <i class="fas fa-ellipsis-v"></i>
                                                                        </span>
                                                                        <ul class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuButton1">
                                                                            <li>
                                                                                <a href="javascript:void(0)" data-id="{{$exper->id}}" data-url="{{route('experience',$exper->id)}}" data-get-url="{{route('get/experience',$exper->id)}}" id="experienceedit" data-bs-toggle="modal" data-bs-target="#experienceModal" class="dropdown-item" type="button">
                                                                                    <i class="fas fa-edit"></i>
                                                                                    Edit
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="p-2 mt-2">
                                                        {{--                            {{$department->render()}}--}}
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="user_role" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                    <table class="table table-bordered text-center">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">S/N</th>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Description</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($user_role as $u_r)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <th scope="row">{{$u_r->name}}</th>
                                                                <td>{{$u_r->guard_name}}</td>
                                                                <td style="text-align:right">
                                                                    <div class="dropdown">
                                                                    <span class="dropdown-toggle " id="dropdownMenuButton1" data-bs-toggle="dropdown" style="background:none">
                                                                        <i class="fas fa-ellipsis-v"></i>
                                                                    </span>
                                                                        <ul class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuButton1">
                                                                            <li>
                                                                                <a href="javascript:void(0)" data-id="{{$u_r->id}}"  id="userroleedit" data-url="{{route('/role/title/update',$u_r->id)}}" data-get-url="{{route('/get/user/role',$u_r->id)}}" data-bs-toggle="modal" data-bs-target="#userroleModal" class="dropdown-item" type="button">
                                                                                    <i class="fas fa-edit"></i>
                                                                                    Edit
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="p-2 mt-2">
                                                        {{--                            {{$department->render()}}--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#nav-tab a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            })

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                e.relatedTarget // previous tab
            });
        });
    </script>




@endsection
