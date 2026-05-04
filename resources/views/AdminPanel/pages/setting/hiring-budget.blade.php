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
    <h3>Hiring Budget</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Hiring Budget</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header space-between">
                        <h4>Hiring Budget lists</h4>
                        <button class="btn btn-gradient addModal">Add Hiring Budget</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Start Price</th>
                                    <th scope="col">End Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($hiringBudget as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->start_price }}</td>
                                        <td>{{ $item->end_price }}</td>
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
    <div class="modal fade" id="addBudgetModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModaluser">Add Hiring Budget</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="progress" style="height: 2px">
                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;"
                        aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <form id="addBudget">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Start Price</label>
                            <input type="number" placeholder="Enter your price" id="start_price" name="start_price"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">End Price</label>
                            <input type="number" placeholder="Enter your price" id="end_price" name="end_price"
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
    <div class="modal fade show" id="updateBudgetModal" tabindex="-1" aria-labelledby="exampleModaluser" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModaluser">Update Budget</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="progress" style="height: 2px">
                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;"
                        aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <form id="updateBudget">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Start Price</label>
                            <input type="number" placeholder="Enter your price" id="start_price" name="start_price"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">End Price</label>
                            <input type="number" placeholder="Enter your price" id="end_price" name="end_price"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="budget_id" name="budget_id">
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
                // $('#addBudgetModal #name').val('');
                $('#addBudgetModal').modal('show');
            })
            $("#addBudget").submit(function(e) {
                // $('#addHiringsModal').modal('hide');

                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "hiring-budget",
                    dataType: "json",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $(".loader-wrapper").fadeIn("slow");

                    },
                    success: function(response) {
                        console.log(response.status);
                        $('.modal#addBudgetModal').modal('hide');
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
                        $('.modal#addBudgetModal').modal('hide');
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
                    url: "hiring-budget/" + id,
                    dataType: "json",
                    beforeSend: function() {
                        $(".loader-wrapper").fadeIn("slow");
                    },
                    success: function(response) {
                        console.log(response.status);
                        if (response.status === 200) {
                            $('#updateBudget #start_price').val(response.hiringBudget.start_price)
                            $('#updateBudget #end_price').val(response.hiringBudget.end_price)
                            $('#updateBudget .budget_id').val(response.hiringBudget.id)
                            $('.modal#updateBudgetModal').modal('show');

                        }
                    },
                    error: function(response) {
                        // console.log(response.responseJSON.errors.role_name[0]);
                        // $('.modal#addLangModal').modal('hide');
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

            $("#updateBudget").submit(function(e) {
                // $('#addHiringsModal').modal('hide');
                e.preventDefault();
                let id = $(this).find('.budget_id').val();
                $.ajax({
                    type: "POST",
                    url: "hiring-budget/" + id,
                    dataType: "json",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $(".loader-wrapper").fadeIn("slow");

                    },
                    success: function(response) {
                        console.log(response.status);
                        $('.modal#updateBudgetModal').modal('hide');
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
                        $('.modal#updateBudgetModal').modal('hide');
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
                            url: "hiring-budget/" + id,
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
