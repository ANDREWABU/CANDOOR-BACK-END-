@extends('layout.app')

@section('title', 'User')
@section('style')
    <style>
        .dropdown .dropdown-toggle:after {
            content: '' !important
        }

    </style>
@endsection
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
@section('breadcrumb-title')
    <h3>Candoor Spaces</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Candoor Spaces</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header space-between">
                        <h4>Candoor Spaces</h4>
                        <button class="btn btn-gradient" data-bs-toggle="modal" data-bs-target="#addSpaces">Add Candoor
                            Space</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Summary</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($spaces as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->summary }}</td>
                                        <td><img class="td-icon" src="{{ asset($item->icon) }}" alt="">
                                        </td>
                                        <td><img class="td-icon" src="{{ asset($item->image) }}" alt="">
                                        </td>
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
    <div class="modal fade show" id="addSpaces" tabindex="-1" aria-labelledby="exampleModaluser" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModaluser">Add Spaces</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="progress" style="height: 2px">
                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;"
                        aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <form method="POST" action="{{ route('spaces.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" placeholder="Enter Spaces Title" id="title" name="title"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="title">Description</label>
                            <textarea class="form-control" id="new-task" id="summary" name="summary"
                                placeholder="Enter Space Description. . ."></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="title">Icon</label>
                                <input type="file" id="icon" name="icon" class="form-control" onchange="iconUpload(this)">
                            </div>
                            <div class="col-md-12 text-center">
                                <img src="" class="iconUpload image-show">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="title">Image</label>
                                <input type="file" placeholder="Enter Space Image" id="image" name="image"
                                    class="form-control" onchange="imageUpload(this)">
                            </div>
                            <div class="col-md-12 text-center">
                                <img src="" class="imageUpload image-show">
                            </div>
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
    <div class="modal fade show" id="updateSpaces" tabindex="-1" aria-labelledby="exampleModaluser" aria-modal="true"
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
                <div class="updateForm"></div>
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
            $("#addSpacesForm").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "spaces",
                    dataType: "json",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // $(".loader-wrapper").fadeIn("slow");
                    },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                        // $("#updatePermission .permission").val(response.permission);
                        // $("#formID").attr("action", "updatePermission/" + id);
                        // $("#updatePermission").modal("show");
                    },
                    error: function(response) {},
                    complete: function() {
                        // $(".loader-wrapper").fadeOut("slow");
                    }
                });

            });

            // edit
            $('body').on('click', '.edit', function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    type: "GET",
                    url: "spaces/" + id,
                    dataType: "json",
                    beforeSend: function() {
                        // $(".loader-wrapper").fadeIn("slow");
                    },
                    success: function(response) {
                        console.log(response);
                        $('#updateSpaces .updateForm').html(response.html);
                        $('#updateSpaces').modal('show')
                    },
                    error: function(response) {},
                    complete: function() {
                        // $(".loader-wrapper").fadeOut("slow");
                    }
                });
            })
            //Update
            $("body").on('submit', '#updateSpacesForm', function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id')
                $.ajax({
                    type: "POST",
                    url: "spaces/" + id,
                    dataType: "json",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // $(".loader-wrapper").fadeIn("slow");
                    },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                        // $("#updatePermission .permission").val(response.permission);
                        // $("#formID").attr("action", "updatePermission/" + id);
                        // $("#updatePermission").modal("show");
                    },
                    error: function(response) {},
                    complete: function() {
                        // $(".loader-wrapper").fadeOut("slow");
                    }
                });

            });

            // Delete

            $('body').on('click', '.delete', function() {
                let id = $(this).attr('data-id');
                swal({
                    title: 'Are you sure?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "DELETE",
                            url: "spaces/" + id,
                            dataType: "json",
                            beforeSend: function() {
                                // $(".loader-wrapper").fadeIn("slow");
                            },
                            success: function(response) {
                                console.log(response);
                                location.reload();
                                // $("#updatePermission .permission").val(response.permission);
                                // $("#formID").attr("action", "updatePermission/" + id);
                                // $("#updatePermission").modal("show");
                            },
                            error: function(response) {},
                            complete: function() {
                                // $(".loader-wrapper").fadeOut("slow");
                            }
                        });
                    }
                })
            })

        })
        // Image Base64
        var imagebase64 = "";

        function iconUpload(element) {
            $('.iconUpload').attr('src', '');
            var file = element.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                imagebase64 = reader.result;
                if (imagebase64) {
                    $('.iconUpload').attr('src', imagebase64);
                }
            }
            reader.readAsDataURL(file);
        }

        function imageUpload(element) {
            $('.imageUpload').attr('src', '');
            var file = element.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                imagebase64 = reader.result;
                if (imagebase64) {
                    $('.imageUpload').attr('src', imagebase64);
                }
            }
            reader.readAsDataURL(file);
        }
    </script>
@endsection
