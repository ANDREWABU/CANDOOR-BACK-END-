 <!-- Experience Modal -->
 <div class="modal fade" id="experienceModal" tabindex="-1" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Experience Title</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal"
                 aria-label="Close"></button>
         </div>
         <div class="progress" style="height: 2px">
             <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%;"
                 aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
         </div>
         <form action="" method="POST" id="experienceform">
             <div class="modal-body">
                 @csrf
                 <div class="form-group">
                     <label for="title">Title</label>
                     <input type="text" placeholder="Title" id="experiencetitle" name="title"
                         class="form-control">
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                 <button type="submit" class="btn btn-primary">Update</button>
             </div>
         </form>
     </div>
 </div>
</div>
<!-- Experience Modal -->


<div class="modal fade" id="userroleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">User Role</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal"
                 aria-label="Close"></button>
         </div>
         <div class="progress" style="height: 2px">
             <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%;"
                 aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
         </div>
         <form action="" method="POST" id="userroleform">
             <div class="modal-body">
                 @csrf
                 <div class="form-group">
                     <label for="title">Title</label>
                     <input type="text" placeholder="Title" id="userroletitle" name="name"
                         class="form-control">
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                 <button type="submit" class="btn btn-primary">Update</button>
             </div>
         </form>
     </div>
 </div>
</div>

<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModaluser"
 aria-hidden="false">
 <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModaluser">User Role</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal"
                 aria-label="Close"></button>
         </div>
         <div class="progress" style="height: 2px">
             <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%;"
                 aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
         </div>
         <form method="POST" id="userform">
             <div class="modal-body">
                 {{-- @method('patch') --}}
                 @csrf
                 <div class="form-group">
                     <label for="title">First Name</label>
                     <input type="text" placeholder="First Name" id="userfirstname" name="first_name"
                         class="form-control">
                 </div>
                 <div class="form-group">
                     <label for="title">Last Name</label>
                     <input type="text" placeholder="Last Name" id="userlastname" name="last_name"
                         class="form-control">
                 </div>
                 <div class="form-group">
                     <label for="title">Role</label>
                     <select name="user_role_id" id="userrole" class="form-control">

                         {{-- <option value="1">admin</option>
                         <option value="2">mentor</option>
                         <option value="3">mentee</option> --}}
                         @if (isset($roles) && !empty($roles))
                             <option>Please Select Role</option>
                             @foreach ( $roles as $val)
                                 <option value="{{ $val->id }}">{{ $val->name }}</option>
                             @endforeach
                         @endif
                     </select>

                 </div>
                 <div class="form-group" id="status">
                     <label for="title">Status</label>
                     <select name="status" class="form-control">

                         <option value="1">Active</option>
                         <option value="0">Inactive</option>
                     </select>

                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                 <button type="submit" class="btn btn-primary">Update</button>
             </div>
         </form>
     </div>
 </div>
</div>
