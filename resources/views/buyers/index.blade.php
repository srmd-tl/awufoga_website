@extends('layouts.app')
@section('content')

@include('layouts.headers.cards')
<div class="container-fluid mt--7">
   @include('alerts.alert')
   <div class="row">
      <div class="col">
         <div class="card shadow">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col-4">
                     <h3 class="mb-0">Buyers</h3>
                  </div>
                  <div class="col-8 text-right">
                     <form action="{{route('buyer.index')}}">
                        <div class="form-group">
                         <div class="input-group">
                           <div class="input-group-prepend">
                             <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                           </div>
                           <input class="form-control" placeholder="Search" type="text" name="filter">
                         </div>
                         <button class="btn btn-sm btn-primary" >Search</button>
                         <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-form">Add Buyer</a>
                        </div>
                     </form>
                     
                  </div>
               </div>
            </div>
            <div class="col-12">
            </div>
            <div class="table-responsive">
               <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                     <tr>
                        <th scope="col">Full Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Country Code</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Notification</th>
                        <th scope="col"></th>
                     </tr>
                  </thead>
                  <tbody>

                     @forelse($buyers as $buyer)
                     <tr>
                        <td>{{$buyer->full_name}}</td>
                        <td>{{$buyer->user_name}}</td>
                        <td>{{$buyer->email}}</td>
                        <td>{{$buyer->phone}}</td>
                        <td>{{$buyer->country_code}}</td>
                        <td>
                           <span class="badge badge-{{$buyer->status==1?'success':'danger'}}">{{$buyer->status==1?'Active':'Inactive'}}</span>
                        </td>
                        <td>{{$buyer->created_at}}</td>
                          <td>
                           <span class="badge badge-{{$buyer->notification_on_off==1?'success':'danger'}}">{{$buyer->status==1?'On':'Off'}}</span>
                        </td>
                  
                        <td class="text-right">
                           <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                   <button class="dropdown-item viewBuyer" 
                             
                                 data-image="{{$buyer->image}}" 
                              
                                 >View Image</button>
                                 <button class="dropdown-item editBuyer" 
                                 data-id="{{$buyer->id}}" 
                                 data-username="{{$buyer->user_name}}" 
                                 data-fullname="{{$buyer->full_name}}" 
                                 data-email="{{$buyer->email}}" 
                                 data-countrycode="{{$buyer->country_code}}" 
                                 data-phone="{{$buyer->phone}}" 
                                 data-notification="{{$buyer->notification_on_off}}" 
                                 data-image="{{$buyer->image}}" 
                                 data-status="{{$buyer->status}}" 
                                 >Edit</button>
                                 <button class="dropdown-item deleteBuyer" data-id="{{$buyer->id}}" >Delete</button>
                              </div>
                           </div>
                        </td>
                     </tr>
                     @empty
                     <tr>
                        <td>Nothing Found!</td>
                     </tr>
                     @endforelse
                  </tbody>
                  <tfoot>
                     <tr>
                        <td>{{$buyers->withQueryString()->links()}}</td>
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
      <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Add new buyer</small>
                        </div>
                        <form role="form" method="POST" action="{{route('buyer.store')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Buyer Username" type="text" name="username">
                              </div>
                           </div>
                             <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Buyer Full Name" type="text" name="fullname">
                              </div>
                           </div>
                             <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Buyer Email" type="text" name="email">
                              </div>
                           </div>
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Buyer Country COde" type="text" name="country_code">
                              </div>
                           </div>
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Buyer Phone" type="text" name="phone">
                              </div>
                           </div>
                         
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Buyer Password" type="password" name="password">
                              </div>
                           </div>
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-file-image-o"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="File" type="file" name="image">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-toggle-off"></i></span>
                                 </div>
                                 <select class="form-control" name="status"> 
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                 </select>
                              </div>
                           </div>
                             <div class="form-group">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-send"></i></span>
                                 </div>
                                 <select class="form-control" name="notification"> 
                                    <option value="1">On</option>
                                    <option value="0">Off</option>
                                 </select>
                              </div>
                           </div>
                           <div class="text-center">
                              <button type="submit" class="btn btn-primary my-4">Add Buyer</button>
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
      <div class="modal fade" id="edit-buyer-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Edit Buyer</small>
                        </div>
                        <form role="form" method="POST" id="editForm"  enctype="multipart/form-data">
                           @csrf
                           @method('PUT')
                      
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Buyer Username" type="text" name="username" id="editUsername">
                              </div>
                           </div>
                             <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Buyer Full Name" type="text" name="fullname" id="editFullname">
                              </div>
                           </div>
                             <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Buyer Email" type="text" name="email" id="editEmail">
                              </div>
                           </div>
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Buyer Country COde" type="text" name="country_code" id="editCountryCode">
                              </div>
                           </div>
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Buyer Phone" type="text" name="phone" id="editPhone">
                              </div>
                           </div>
                         
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Buyer Password" type="password" name="password">
                              </div>
                           </div>
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-file-image-o"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="File" type="file" name="image" id="editImage">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-toggle-off"></i></span>
                                 </div>
                                 <select class="form-control" name="status" id="editStatus"> 
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                 </select>
                              </div>
                           </div>
                             <div class="form-group">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-send"></i></span>
                                 </div>
                                 <select class="form-control" name="notification" id="editNotification"> 
                                    <option value="1">On</option>
                                    <option value="0">Off</option>
                                 </select>
                              </div>
                           </div>
                           <div class="text-center">
                              <button type="submit" class="btn btn-primary my-4">Update Buyer</button>
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
      <div class="modal fade" id="delete-buyer-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
                                 
                                 <label class="form-control" >Are You Sure You Want To Delete This Buyer?</label>
                              </div>
                            </div>
                           
                           <div class="text-center">
                              <button type="submit" class="btn btn-danger my-4">Yes</button>
                              <button type="button" class="btn btn-success my-4" data-dismiss="modal">No </button>
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
        <!-- View Buyer Modal -->
     <div class="col-md-4">
      <div class="modal fade" id="view-category-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>View  Image</small>
                        </div>
                        <form role="form">
                          
                            <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <img src="" id="viewImage">
                              </div>
                            </div>
                           
                           <div class="text-center">
                              <button type="button" class="btn btn-success my-4" data-dismiss="modal">Close </button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End View Buyer cat Modal -->
@include('layouts.footers.auth')
</div>

@push('js')
<script type="text/javascript">
    $(function(){
        $(".editBuyer").click(function(){
            var id = $(this).data('id')
            var username = $(this).data('username')
            var fullname = $(this).data('fullname')
            var email = $(this).data('email')
            var phone = $(this).data('phone')
            var countrycode = $(this).data('countrycode')
            var notification = $(this).data('notification')
            var image = $(this).data('image')
            var status = $(this).data('status')

            var route="{{route('buyer.update',':id')}}"
            route = route.replace(':id',id)
            $("#editUsername").val(username)
            $("#editFullname").val(fullname)
            $("#editEmail").val(email)
            $("#editPhone").val(phone)
            $("#editCountryCode").val(countrycode)
            $("#editNotification").val(notification)
            $("#editShowImage").attr('src',image)
            $("#editStatus").val(status)
            $("#editForm").attr("action",route)

            $("#edit-buyer-form").modal()       

        })
          $(".viewBuyer").click(function(){
            var image = "{{asset('storage')}}/"+$(this).data('image')
            $("#viewImage").attr('src',image)
            $("#view-category-form").modal()       

        })

        $(".deleteBuyer").click(function(){
             var id = $(this).data('id')
             var route="{{route('buyer.destroy',':id')}}"
             route = route.replace(':id',id)
             $("#deleteForm").attr("action",route)
            $("#delete-buyer-form").modal()
        })
    })
</script>
@endpush
@endsection