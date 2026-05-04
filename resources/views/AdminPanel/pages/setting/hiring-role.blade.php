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
    <h3>Candoor Spaces</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Hiring Roles</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header space-between">
                        <h4>Hiring Roles</h4>
                        <button class="btn btn-gradient addModal">Add Hiring
                            Roles</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($hiringRoles as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->role_name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <span class="dropdown-toggle " id="dropdownMenuButton1"
                                                    data-bs-toggle="dropdown" style="background:none">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </span>
                                                <ul class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        <a href="javascript:void(0)" class="dropdown-item edit"
                                                            data-id="{{ $item->id }}" type="button">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" class="dropdown-item delete"
                                                            data-id="{{ $item->id }}" type="button">
                                                            <i class="fas fa-trash"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>

                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <div class="p-2 mt-2">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Career Spaces Model --}}
    <div class="modal fade" id="addHiringsModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModaluser">Add Hiring Roles</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="progress" style="height: 2px">
                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;"
                        aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <form id="addHiringRoles">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input type="text" placeholder="Enter Hiring Roles Name" id="name" name="role_name"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Update Career Spaces Model --}}
    <div class="modal fade show" id="updateHiringModal" tabindex="-1" aria-labelledby="exampleModaluser" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModaluser">Add Spaces</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="progress" style="height: 2px">
                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;"
                        aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <form id="updateHiringRoles">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input type="text" placeholder="Enter Hiring Roles Name" id="name" name="role_name"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="role_id" name="role_id">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            $('body').on('click', '.addModal', function() {
                $('#addHiringsModal #name').val('');
                $('#addHiringsModal').modal('show');
            })
            $("#addHiringRoles").submit(function(e) {
                // $('#addHiringsModal').modal('hide');

                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "hiring-roles",
                    dataType: "json",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $(".loader-wrapper").fadeIn("slow");

                    },
                    success: function(response) {
                        console.log(response.status);
                        $('.modal#addHiringsModal').modal('hide');
                        if (response.status === 200) {
                            let msg = response.success;
                            swal({
                                icon: 'success',
                                title: 'Good job!',
                                text: msg,
                            }).then(function(isConfirm) {
                                if (isConfirm) {
                                    location.reload();
                                }
                            })
                        }
                    },
                    error: function(response) {
                        // console.log(response.responseJSON.errors.role_name[0]);
                        $('.modal#addHiringsModal').modal('hide');
                        let error = response?.responseJSON?.errors?.role_name[0];
                        swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: error,
                        })
                    },
                    complete: function() {
                        $(".loader-wrapper").fadeOut("slow");

                    }
                });

            });

            $('body').on('click', '.edit', function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    type: "GET",
                    url: "hiring-roles/" + id,
                    dataType: "json",
                    beforeSend: function() {
                        $(".loader-wrapper").fadeIn("slow");
                    },
                    success: function(response) {
                        console.log(response.status);
                        if (response.status === 200) {
                            $('#updateHiringRoles #name').val(response.hiringRoles.role_name)
                            $('#updateHiringRoles .role_id').val(response.hiringRoles.id)
                            $('.modal#updateHiringModal').modal('show');

                        }
                    },
                    error: function(response) {
                        // console.log(response.responseJSON.errors.role_name[0]);
                        $('.modal#addHiringsModal').modal('hide');
                        let error = response?.responseJSON?.errors?.role_name[0];
                        swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: error,
                        })
                    },
                    complete: function() {
                        $(".loader-wrapper").fadeOut("slow");
                    }
                });
            })

            $("#updateHiringRoles").submit(function(e) {
                // $('#addHiringsModal').modal('hide');
                e.preventDefault();
                let id = $(this).find('.role_id').val();
                $.ajax({
                    type: "POST",
                    url: "hiring-roles/" + id,
                    dataType: "json",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $(".loader-wrapper").fadeIn("slow");

                    },
                    success: function(response) {
                        console.log(response.status);
                        $('.modal#updateHiringModal').modal('hide');
                        if (response.status === 200) {
                            let msg = response.success;
                            swal({
                                icon: 'success',
                                title: 'Good job!',
                                text: msg,
                            }).then(function(isConfirm) {
                                if (isConfirm) {
                                    location.reload();
                                }
                            })
                        }
                    },
                    error: function(response) {
                        // console.log(response.responseJSON.errors.role_name[0]);
                        $('.modal#updateHiringModal').modal('hide');
                        let error = response?.responseJSON?.errors?.role_name[0];
                        swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: error,
                        })
                    },
                    complete: function() {
                        $(".loader-wrapper").fadeOut("slow");

                    }
                });

            });

            $('body').on('click', '.delete', function() {
                let id = $(this).attr('data-id');
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "DELETE",
                            url: "hiring-roles/" + id,
                            dataType: "json",
                            beforeSend: function() {
                                $(".loader-wrapper").fadeIn("slow");
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.status === 200) {
                                    let msg = response.success;

                                    swal({
                                        icon: 'success',
                                        title: 'Good job!',
                                        text: msg,
                                    }).then(function(isConfirm) {
                                        if (isConfirm) {
                                            location.reload();
                                        }
                                    })
                                }
                            },
                            error: function(response) {
                                // console.log(response.responseJSON.errors.role_name[0]);
                                let error = response?.success;
                                swal({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: error,
                                })
                            },
                            complete: function() {
                                $(".loader-wrapper").fadeOut("slow");
                            }
                        });
                    }
                })
            })


        });
    </script>
@endsection
