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
    <h3>Language</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Language</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header space-between">
                        <h4>Language lists</h4>
                        <button class="btn btn-gradient addModal">Add Language</button>
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
                                @forelse ($languages as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->lang_name }}</td>
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
    <div class="modal fade" id="addLangModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModaluser">Add Language</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="progress" style="height: 2px">
                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;"
                        aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <form id="addLang">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input type="text" placeholder="Enter Language Name" id="name" name="lang_name"
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
    <div class="modal fade show" id="updateLangModal" tabindex="-1" aria-labelledby="exampleModaluser" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModaluser">Update Language</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="progress" style="height: 2px">
                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;"
                        aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <form id="updateLang">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input type="text" placeholder="Enter Language Name" id="name" name="lang_name"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="lang_id" name="lang_id">
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
                $('#addLangModal #name').val('');
                $('#addLangModal').modal('show');
            })
            $("#addLang").submit(function(e) {
                // $('#addHiringsModal').modal('hide');

                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "languages",
                    dataType: "json",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $(".loader-wrapper").fadeIn("slow");

                    },
                    success: function(response) {
                        console.log(response.status);
                        $('.modal#addLangModal').modal('hide');
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
                        $('.modal#addLangModal').modal('hide');
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
                    url: "languages/" + id,
                    dataType: "json",
                    beforeSend: function() {
                        $(".loader-wrapper").fadeIn("slow");
                    },
                    success: function(response) {
                        console.log(response.status);
                        if (response.status === 200) {
                            $('#updateLang #name').val(response.language.lang_name)
                            $('#updateLang .lang_id').val(response.language.id)
                            $('.modal#updateLangModal').modal('show');

                        }
                    },
                    error: function(response) {
                        // console.log(response.responseJSON.errors.role_name[0]);
                        $('.modal#addLangModal').modal('hide');
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

            $("#updateLang").submit(function(e) {
                // $('#addHiringsModal').modal('hide');
                e.preventDefault();
                let id = $(this).find('.lang_id').val();
                $.ajax({
                    type: "POST",
                    url: "languages/" + id,
                    dataType: "json",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $(".loader-wrapper").fadeIn("slow");
                    },
                    success: function(response) {
                        console.log(response.status);
                        $('.modal#updateLangModal').modal('hide');
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
                        $('.modal#updateLangModal').modal('hide');
                        let error = response?.responseJSON?.errors?.lang_name[0];
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
                            url: "languages/" + id,
                            dataType: "json",
                            beforeSend: function() {     $(".loader-wrapper").fadeIn("slow");
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
