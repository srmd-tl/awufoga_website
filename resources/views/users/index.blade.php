@extends('layouts.app')
@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="card shadow">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col-8">
                     <h3 class="mb-0">Users</h3>
                  </div>
                  <div class="col-4 text-right">
                     <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-form">Add user</a>
                  </div>
               </div>
            </div>
            <div class="col-12">
            </div>
            <div class="table-responsive">
               <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                     <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Creation Date</th>
                        <th scope="col"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($admins as $admin)
                     <tr>
                        <td>{{$admin->name}}</td>
                        <td>
                           <a href="mailto:admin@argon.com">{{$admin->email}}</a>
                        </td>
                        <td>{{$admin->created_at}}</td>
                        <td class="text-right">
                           <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                 <button class="dropdown-item editAdmin" data-id="{{$admin->id}}" data-name="{{$admin->name}}" data-email="{{$admin->email}}" >Edit</button>
                                 <button class="dropdown-item deleteAdmin" data-id="{{$admin->id}}" >Delete</button>
                              </div>
                           </div>
                        </td>
                     </tr>
                     @empty
                     @endforelse
                  </tbody>
                  <tfoot>
                     <tr>
                        <td>{{$admins->links()}}</td>
                     </tr>
                  </tfoot>
               </table>
            </div>
            <div class="card-footer py-4">
               <nav class="d-flex justify-content-end" aria-label="...">
               </nav>
            </div>
         </div>
      </div>
   </div>
   <!-- Add ADmin Modal -->
   <div class="col-md-4">
      <div class="modal fade addModel" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Add new admin</small>
                        </div>
                        <form role="form" method="POST" action="{{route('admin.store')}}">
                           @csrf
                           <div class="form-group mb-3">
                              <label class="form-control-label" for="input-username">Email</label>
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Email" type="email" name="email">
                              </div>
                           </div>
                           <div class="form-group mb-3">
                              <label class="form-control-label" for="input-username">Name</label>
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Name" type="text" name="name">
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="input-username">Password</label>
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Password" type="password" name="password">
                              </div>
                           </div>
                           <div class="text-center">
                              <button type="submit" class="btn btn-primary my-4">Add Admin</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End Add ADmin Modal -->
  <!-- Edit ADmin Modal -->
   <div class="col-md-4">
      <div class="modal fade addModel" id="edit-admin-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Edit admin</small>
                        </div>
                        <form role="form" method="POST" id="editForm">
                           @csrf
                           @method('PUT')
                      
                           <div class="form-group mb-3">
                                       <label class="form-control-label" for="input-username">Email</label>

                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Email" type="email" name="email" id="editEmail">
                              </div>
                           </div>
                           <div class="form-group mb-3">
                                       <label class="form-control-label" for="input-username">Name</label>

                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Name" type="text" name="name" id="editName">
                              </div>
                           </div>
                           <div class="form-group">
                                       <label class="form-control-label" for="input-username">Password</label>

                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Password" type="password" name="password">
                              </div>
                           </div>
                           <div class="text-center">
                              <button type="submit" class="btn btn-primary my-4">Update Admin</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End Edit ADmin Modal -->

   <!-- Delete Admin Modal -->
     <div class="col-md-4">
      <div class="modal fade" id="delete-admin-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Delete admin</small>
                        </div>
                        <form role="form" method="POST" id="deleteForm">
                           @csrf
                           @method('DELETE')
                            <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 
                                 <label class="form-control pb-5" >Are You Sure You Want To Delete The Admin?</label>
                              </div>
                            </div>
                           
                           <div class="text-center">
                              <button type="submit" class="btn btn-danger my-4">Yes</button>
                              <button type="button" class="btn btn-success my-4">No </button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End Delete Admin Modal -->
@include('layouts.footers.auth')
</div>

@push('js')
<script type="text/javascript">
    $(function(){
        $(".editAdmin").click(function(){
            var id = $(this).data('id')
            var name = $(this).data('name')
            var email = $(this).data('email')

            var route="{{route('admin.update',':id')}}"
            route = route.replace(':id',id)
            $("#editEmail").val(email)
            $("#editName").val(name)
            $("#editForm").attr("action",route)

            $("#edit-admin-form").modal()       

        })

        $(".deleteAdmin").click(function(){
             var id = $(this).data('id')
             var route="{{route('admin.destroy',':id')}}"
             route = route.replace(':id',id)
             $("#deleteForm").attr("action",route)
            $("#delete-admin-form").modal()
        })
    })
</script>
@endpush
@endsection