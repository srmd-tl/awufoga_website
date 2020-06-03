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
                  <div class="col-12">
                     <div class="categories-detail">
                        <h3 class="mb-0">Blogs</h3>
                        <div class="btn_style1">
                           <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-form">Add Blog</a>
                           <a href="{{route('blog.index')}}" class="btn btn-sm btn-primary">Clear Search</a>
                        </div>
                     </div>
                  </div>
                   <div class="col-12">
                     <div class="Search_item">
                          <!-- <form method="GET" action="{{route('vendor.index')}}" class="mr-2">
                           <div class="form-group">
                                 <button value="1" class="btn btn-sm btn-primary" name="statusFilter">Active Search</button>
                                 <button value="0" class="btn btn-sm btn-primary" name="statusFilter">Inactive Search</button>
                           </div>
                           </form> -->
                        <form action="{{route('blog.index')}}">
                           <div class="select_option">
                              <select name="statusFilter">
                                 <option {{request()->statusFilter=='1'?'selected':''}} value="1">Active</option>
                                 <option {{request()->statusFilter=='0'?'selected':''}} value="0">Inactive</option>
                              </select>
                           </div>
                           <div class="form-group">
                               <div class="input-group">
                                 <div class="input-group-prepend">
                                   <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                 </div>

                                <!--  @if(isset(request()->statusFilter))
                                 <input type="hidden" name="statusFilter" value="{{request()->statusFilter}}">
                                 @endif -->
                                 <input  class="form-control" placeholder="Search" type="text" name="filter" value="{{request()->filter}}">


                               </div>
                               <button class="btn btn-sm btn-primary" >Search</button>
                           </div>
                        </form>

                     </div>

                  </div>
               </div>
            </div>
            <div class="col-12">
            </div>
            <div class="table_design">
            <div class="table-responsive">
               <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                     <tr>
                        <th scope="col">Vendor Name</th>
                        <th scope="col">Buyer name </th>
                        <th scope="col">Buyer Mobile No</th>
                        <th scope="col">Sales Date</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Cash back %</th>
                        <th scope="col">Cash back Amount</th>
                        <th scope="col">Grand Total</th>
                        <th scope="col">Vendor Amount</th>
                        <th scope="col">AwufOga commission</th>
                        <th scope="col">Buyer Rating</th>
                        <th scope="col">Payment Type</th>
                        <th scope="col"></th>
                     </tr>
                  </thead>
                  <tbody>

                     @forelse($sales as $sale)
                     <tr>
                        <td  class="viewBlog" data-image="{{$blog->blog_image}}" >{{$sale->vendor->name}}</td>
                        <td  class="viewBlog" data-image="{{$blog->blog_image}}" >{{$sale->buyer->name}}</td>
                        <td  >{{$sale->buyer->phone}}</td>
                        <td  >{{$sale->created_at}}</td>
                        <td  >{{$sale->paid_price}}+{{$sale->pre_price}}</td>
                        <td  >{{$sale->coupon->discount}}</td>
                        <td  >{{$sale->paid_price}}-{{$sale->pre_price}}</td>
                        <td  >{{$sale->paid_price}}+{{$sale->pre_price}}</td>
                        <td  >{{$sale->paid_price}}+{{$sale->pre_price}}</td>
                        <td  >{{$sale->paid_price}}+{{$sale->pre_price}}</td>
                        <td >{{$blog->buyer->}}</td>
                        <td >{{$blog->category->name}}</td>

              <!--           <td>

                           <span class="badge badge-{{$blog->status==1?'success':'danger'}}">{{$blog->status==1?'Active':'Inactive'}}</span>

                        </td -->
                        <td class="text-right">
                           <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                 <button class="dropdown-item editBlog"
                                 data-id="{{$blog->id}}"
                                  data-title="{{$blog->title}}"
                                  data-body="{{$blog->body}}"
                                     data-image="{{$blog->image}}"
                                  data-status="{{$blog->status}}" >Edit</button>
                                 <button class="dropdown-item deleteBlog" data-id="{{$blog->id}}" >Delete</button>
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
                        <td>{{$blogs->withQueryString()->links()}}</td>
                     </tr>
                  </tfoot>
               </table>
            </div>
            </div>
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
                           <small>Add new blog</small>
                        </div>
                        <form role="form" method="POST" action="{{route('blog.store')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="form-group">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                 </div>
                                 <select class="form-control" name="categoryId">
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
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Title" type="text" name="title">
                              </div>
                           </div>
                            <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Body" type="text" name="body">
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



                       <!--     <div class="form-group">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                 </div>
                                 <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                 </select>
                              </div>
                           </div> -->
                           <div class="text-center">
                              <button type="submit" class="btn btn-primary my-4">Add Blog</button>
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
      <div class="modal fade" id="edit-blog-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Edit Blog</small>
                        </div>
                        <form role="form" method="POST" id="editForm"  enctype="multipart/form-data">
                           @csrf
                           @method('PUT')

                           <div class="form-group">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                 </div>

                              </div>
                           </div>
                           <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Key" type="text" name="key" id="editKey">
                              </div>
                           </div>
                            <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Value" type="text" name="value" id="editValue">
                              </div>
                           </div>
                            <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Description" type="text" name="description" id="editDescription">
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
                              <button type="submit" class="btn btn-primary my-4">Update Blog</button>
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
      <div class="modal fade" id="delete-blog-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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

                                 <label class="form-control" >Are You Sure You Want To Delete This Blog?</label>
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
      <div class="modal fade" id="view-blog-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
        $(".editBlog").click(function(){
            var id = $(this).data('id')
            var key = $(this).data('key')
            var value = $(this).data('value')
            var keytype = $(this).data('keytype')
            var description = $(this).data('description')
            var status = $(this).data('status')

            var route="{{route('blog.update',':id')}}"
            route = route.replace(':id',id)
            $("#editKey").val(key)
            $("#editValue").val(value)
            $("#editDescription").val(description)
            $("#ediKeyTypeId").val(keytype)
            $("#editStatus").val(status)
            $("#editForm").attr("action",route)

            $("#edit-blog-form").modal()

        })
          $(".viewBlog").click(function(){
            var description = "{{asset('storage')}}/"+$(this).data('description')
            $("#viewImage").attr('src',description)
            $("#view-blog-form").modal()

        })
        $(".deleteBlog").click(function(){
             var id = $(this).data('id')
             var route="{{route('blog.destroy',':id')}}"
             route = route.replace(':id',id)
             $("#deleteForm").attr("action",route)
            $("#delete-blog-form").modal()
        })
    })
</script>
@endpush
@endsection
