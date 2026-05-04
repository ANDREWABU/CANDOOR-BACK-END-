@extends('layout.app')

@section('title', 'Degree')
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
    <h3>Degree</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Degree</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header space-between">
                        <h4>Degrees</h4>
                        <button class="btn btn-gradient" id="AddDegreep" data-bs-toggle="modal" data-bs-target="#addDegree">Add 
                            Degree</button>
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
                                @forelse ($degrees as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
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
                                                        
                                                        <form method="POST" action="{{ route('degrees.destroy',[$item->id]) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="dropdown-item delete"
                                                            data-id="{{ $item->id }}">
                                                            <i class="fas fa-trash"></i>
                                                            Delete</button>
                                                        </form>
                                                        {{-- <a href="javascript:void(0)" class="dropdown-item delete"
                                                            data-id="{{ $item->id }}" type="button">
                                                            <i class="fas fa-trash"></i>
                                                            Delete
                                                        </a> --}}
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

    {{-- Add Degree Model --}}
    <div class="modal fade show" id="addDegree" tabindex="-1" aria-labelledby="addDegreeModal" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDegreeModal">Add Degree</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="progress" style="height: 2px">
                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;"
                        aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <form method="POST" id="addDegreeForm" action="{{ route('degrees.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" value="{{ old('name') }}" placeholder="Enter Degree Name" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Update  Degree Model --}}
    <div class="modal fade show" id="updateDegree" tabindex="-1" aria-labelledby="exampleModaluser" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModaluser">Update Degree</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="progress" style="height: 2px">
                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;"
                        aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="updateForm"></div>

                <form method="POST" id="updateDegreeForm" action="" >
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="update_name">Name</label>
                            <input type="hidden" value="" name="update_id" id="update_id" />
                            <input type="text" placeholder="Enter Degree Name" id="update_name" name="update_name"
                                class="form-control @error('update_name') is-invalid @enderror" value="">
                            @error('update_name')
                            <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
   <script>
       var name_error_s=false;
       var update_name_old=false;
       var old_id="{{ old('update_id') }}";
       @error('name')
              name_error_s=true;
        @enderror
        var name_error_up=false;
       @error('update_name')
           name_error_up=true;
           update_name_old="{{ old('update_name') }}";
        @enderror
   </script>  
    <script>
       
        $(document).ready(function() {
        
            if(name_error_s)
            {
                $("#addDegree").modal('show');
            }

            if(name_error_up)
            {
                $("#updateDegree").modal('show');
                
                    let id = old_id;
                    $("#updateDegree").modal('show');
                    $('#update_name').val(update_name_old);
            }

            $("#AddDegreep").click(function(){
                $('input[name="name"]').removeClass('is-invalid');
                $('input[name="name"]').val('');
            });

            $('body').on('click', '.edit', function() {
                let id = $(this).attr('data-id');
                let route= "{{ route('degrees.show', ":id") }}";
                route = route.replace(':id', id);
                $('input[name="update_name"]').removeClass('is-invalid');
                $.ajax({
                    type: "GET",
                    url: route,
                    dataType: "json",
                    beforeSend: function() {
                        // $(".loader-wrapper").fadeIn("slow");
                    },
                    success: function(response) {
                        // console.log(response);
                        if(response.status === 'success')
                        {
                            $("#updateDegree").modal('show');
                           $('#update_name').val(response.data.name);
                           $('#update_id').val(response.data.id);
                           $("#updateDegreeForm").attr('action',response.data.action);
                        }
                    },
                    error: function(response) {},
                    complete: function() {
                        // $(".loader-wrapper").fadeOut("slow");
                    }
                });
            });

        });
            
    </script>
@endsection
