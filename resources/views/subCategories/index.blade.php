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
                     <h3 class="mb-0">Sub Categories</h3>
                  </div>
                  <div class="col-8 text-right">
                     <form action="{{route('subCategory.index')}}">
                        <div class="form-group">
                         <div class="input-group">
                           <div class="input-group-prepend">
                             <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                           </div>
                           <input class="form-control" placeholder="Search" type="text" name="filter">
                         </div>
                         <button class="btn btn-sm btn-primary" >Search</button>
                         <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-form">Add Sub Category</a>
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
                        <th scope="col">Sub Category Name</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($subCategories as $subCategory)
                     <tr>
                        <td class="viewSubCategory" data-image="{{$subCategory->image}}" >{{$subCategory->name}}</td>
                        <td>{{$subCategory->category->name}}</td>
                       
                        <td>

                           <span class="badge badge-{{$subCategory->status==1?'success':'danger'}}">{{$subCategory->status==1?'Active':'Inactive'}}</span>
                           
                        </td>
                        <td class="text-right">
                           <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                           
                                  <button class="dropdown-item editSubCategory" 
                                 data-id="{{$subCategory->id}}" 
                                 data-name="{{$subCategory->name}}" 
                                 data-image="{{$subCategory->image}}" 
                                 data-status="{{$subCategory->status}}" 
                                 data-category="{{$subCategory->category_id}}"
                                 >Edit</button>

                                 <button class="dropdown-item deleteSubCategory" data-id="{{$subCategory->id}}" >Delete</button>
                              </div>
                           </div>
                        </td>
                     </tr>
                     @empty
                     @endforelse
                  </tbody>
                  <tfoot>
                     <tr>
                        <td>{{$subCategories->withQueryString()->links()}}</td>
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
                           <small>Add New Sub Category</small>
                        </div>
                        <form role="form" method="POST" action="{{route('subCategory.store')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Sub Category Name" type="text" name="name">
                              </div>
                           </div>
                            <div class="form-group">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                 </div>
                                 <select class="form-control" name="category"> 
                                    @forelse($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @empty
                                    @endforelse
                                 </select>
                              </div>
                           </div>
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="File" type="file" name="image">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                 </div>
                                 <select class="form-control" name="status"> 
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                 </select>
                              </div>
                           </div>
                           <div class="text-center">
                              <button type="submit" class="btn btn-primary my-4">Add Sub Category</button>
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
      <div class="modal fade" id="edit-category-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Edit Sub Category</small>
                        </div>
                        <form role="form" method="POST" id="editForm"  enctype="multipart/form-data">
                           @csrf
                           @method('PUT')
                      
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Category Name" type="text" name="name" id="editName">
                              </div>
                           </div>

                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                 </div>
                                 <select class="form-control" name="category" id="editCategory"> 
                                 @forelse($categories as $category)
                                 <option value="{{$category->id}}" >{{$category->name}}</option>
                                 @empty
                                 @endforelse
                           </select>
                              </div>
                           </div>
                          
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                 </div>
                                 <img id="editShowImage">
                                 <input type="file" class="form-control" name="image">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                 </div>
                                 <select class="form-control" name="status" id="editStatus">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                    
                                 </select>
                              </div>
                           </div>
                           <div class="text-center">
                              <button type="submit" class="btn btn-primary my-4">Update Sub Category</button>
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
      <div class="modal fade" id="delete-category-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
                                 
                                 <label class="form-control" >Are You Sure You Want To Delete This Category?</label>
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
      <!-- View Subcat Modal -->
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
   <!-- End View SUb cat Modal -->
@include('layouts.footers.auth')
</div>

@push('js')
<script type="text/javascript">
    $(function(){
        $(".editSubCategory").click(function(){
            var id = $(this).data('id')
            var name = $(this).data('name')
            var image = $(this).data('image')
            var status = $(this).data('status')
            var category = $(this).data('category')

            var route="{{route('subCategory.update',':id')}}"
            route = route.replace(':id',id)
            $("#editName").val(name)
            $("#editShowImage").attr('src',image)
            $("#editStatus").val(status)
            $("#editCategory").val(category)
            $("#editForm").attr("action",route)

            $("#edit-category-form").modal()       

        })
          $(".viewSubCategory").click(function(){
            var image = "{{asset('storage')}}/"+$(this).data('image')
            $("#viewImage").attr('src',image)
            $("#view-category-form").modal()       

        })

        $(".deleteSubCategory").click(function(){
             var id = $(this).data('id')
             var route="{{route('subCategory.destroy',':id')}}"
             route = route.replace(':id',id)
             $("#deleteForm").attr("action",route)
            $("#delete-category-form").modal()
        })
    })
</script>
@endpush
@endsection