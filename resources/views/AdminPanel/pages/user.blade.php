@extends('layout.app')

@section('title', 'User')
@section('style')
    <style>
        .dropdown .dropdown-toggle:after {
            content: '' !important
        }

    </style>
@endsection

@section('breadcrumb-title')
    <h3>User</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">User</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pt-4 pb-4">
                        <h4>Users List</h4>
                    </div>
                    <div class="card-body p-2">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">User Role</th>
                                    <th scope="col">Status</th>
                                    <th>Actions</th>
                                    {{-- <th scope="col">Edit</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $val)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $val->first_name }}</td>
                                        <td>{{ $val->last_name }}</td>
                                        <td>{{ $val->email }}</td>

                                        {{-- @dd($val->roles[0]) --}}
                                        <td>
                                            @if (!empty($val->roles[0]))

                                                {{ $val->roles[0]->name }}
                                            @else
                                                <span>---</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($val->roles[0]) && $val->roles[0]->id == 1)
                                                <span class="badge rounded-pill badge-success active-btn">Active</span>
                                            @else

                                                @if ($val->status)
                                                    <span class="badge rounded-pill badge-success active-btn"
                                                        onclick="javascript:statusUpdate('0',{{ $val->id }},`{{URL::to('/')}}`)"
                                                        data-staus="{{ $val->status }}">Active</span>
                                                @else
                                                    <span class="badge rounded-pill badge-danger active-btn"
                                                        onclick="javascript:statusUpdate('1',{{ $val->id }},`{{URL::to('/')}}`)"
                                                        data-staus="{{ $val->status }}">Pending</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td style="text-align:right">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle " id="dropdownMenuButton1"
                                                    data-bs-toggle="dropdown" style="background:none">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </span>
                                                <ul class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        <a href="javascript:void(0)"
                                                            data-url="{{ route('userRole/update', $val->id) }}"
                                                            data-get-url="{{ route('/get/user', $val->id) }}"
                                                            data-id="{{ $val->id }}" id="userEdit"
                                                            data-bs-toggle="modal" data-bs-target="#userModal"
                                                            class="dropdown-item" type="button">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        {{-- <td style="text-align:right"> --}}
                                        {{-- <div class="dropdown"> --}}
                                        {{-- <span class="dropdown-toggle " id="dropdownMenuButton1" data-bs-toggle="dropdown" style="background:none"> --}}
                                        {{-- <i class="fas fa-ellipsis-v"></i> --}}
                                        {{-- </span> --}}
                                        {{-- <ul class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuButton1"> --}}
                                        {{-- <li> --}}
                                        {{-- <a href="javascript:void(0)" data-id=""  id="" data-bs-toggle="modal" data-bs-target="#" class="dropdown-item" type="button"> --}}
                                        {{-- <i class="fas fa-edit"></i> --}}
                                        {{-- Edit --}}
                                        {{-- </a> --}}
                                        {{-- </li> --}}

                                        {{-- </ul> --}}
                                        {{-- </div> --}}
                                        {{-- </td> --}}
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <div class="p-2 mt-2">
                            {{-- {{$department->render()}} --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $('body').on('click', '.active-btn')
    </script>
@endsection
