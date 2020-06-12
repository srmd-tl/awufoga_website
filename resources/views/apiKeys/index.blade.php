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
                        <h3 class="mb-0">Api Keys</h3>
                        <div class="btn_style1">
                           <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-form">Add ApiKey</a>
                           <a href="{{route('apiKey.index')}}" class="btn btn-sm btn-primary">Clear Search</a>
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
                        <form action="{{route('apiKey.index')}}">
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
                        <th scope="col">Key</th>
                        <th scope="col">Value</th>
                        <th scope="col">Api Key Type</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                     </tr>
                  </thead>
                  <tbody>

                     @forelse($apiKeys as $apiKey)
                     <tr>
                        <td >{{$apiKey->key}}</td>
                        <td >{{$apiKey->value}}</td>
                        <td >{{$apiKey->keyType->title}}</td>
                        <td >{{$apiKey->description}}</td>
                       
                        <td>

                           <span class="badge badge-{{$apiKey->status==1?'success':'danger'}}">{{$apiKey->status==1?'Active':'Inactive'}}</span>
                           
                        </td>
                        <td class="text-right">
                           <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                 
                                 <button class="dropdown-item editApiKey" 
                                 data-id="{{$apiKey->id}}"
                                  data-keytype="{{$apiKey->keyType->id}}" 
                                  data-key="{{$apiKey->key}}" 
                                  data-value="{{$apiKey->value}}" 
                                  data-description="{{$apiKey->description}}" 
                                  data-status="{{$apiKey->status}}" >Edit</button>
                                 <button class="dropdown-item deleteApiKey" data-id="{{$apiKey->id}}" >Delete</button>
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
                        <td>{{$apiKeys->withQueryString()->links()}}</td>
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
      <div class="modal fade addModel" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Add new apiKey</small>
                        </div>
                        <form role="form" method="POST" action="{{route('apiKey.store')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="form-group">
                                       <label class="form-control-label" for="input-username">Key Type</label>

                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                 </div>
                                 <select class="form-control" name="keyTypeId"> 
                                    @forelse($keyTypes as $type)
                                    <option value="{{$type->id}}">{{$type->title}}</option>
                                    @empty
                                    @endforelse
                                   
                                 </select>
                              </div>
                           </div>
                           <div class="form-group mb-3">
                                       <label class="form-control-label" for="input-username">Key</label>

                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Key" type="text" name="key">
                              </div>
                           </div>
                            <div class="form-group mb-3">
                                       <label class="form-control-label" for="input-username">Value</label>

                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Value" type="text" name="value">
                              </div>
                           </div>
                            <div class="form-group mb-3">
                                       <label class="form-control-label" for="input-username">Description</label>

                              <div class="input-group input-group-merge input-group-alternative">
                                 <textarea class="form-control" rows="10" cols="30" name="description" placeholder="Description"></textarea>
                                 
                              </div>
                           </div>
                        
                           <div class="form-group">
                                       <label class="form-control-label" for="input-username">Status</label>

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
                              <button type="submit" class="btn btn-primary my-4">Add ApiKey</button>
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
      <div class="modal fade addModel" id="edit-apiKey-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Edit ApiKey</small>
                        </div>
                        <form role="form" method="POST" id="editForm"  enctype="multipart/form-data">
                           @csrf
                           @method('PUT')
                      
                           <div class="form-group">
                                       <label class="form-control-label" for="input-username">Title</label>

                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                 </div>
                                 <select class="form-control" name="keyTypeId" id="ediKeyTypeId"> 
                                    @forelse($keyTypes as $type)
                                    <option value="{{$type->id}}">{{$type->title}}</option>
                                    @empty
                                    @endforelse
                                   
                                 </select>
                              </div>
                           </div>
                           <div class="form-group mb-3">
                                       <label class="form-control-label" for="input-username">Key</label>

                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Key" type="text" name="key" id="editKey">
                              </div>
                           </div>
                            <div class="form-group mb-3">
                                       <label class="form-control-label" for="input-username">Value</label>

                              <div class="input-group input-group-merge input-group-alternative">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                 </div>
                                 <input class="form-control" placeholder="Value" type="text" name="value" id="editValue">
                              </div>
                           </div>
                            <div class="form-group mb-3">
                                       <label class="form-control-label" for="input-username">Description</label>

                              <div class="input-group input-group-merge input-group-alternative">
                                 <textarea class="form-control" name="description" rows="10" cols="30" id="editDescription"></textarea>
                          
                              </div>
                           </div>
                        
                           <div class="form-group">
                                       <label class="form-control-label" for="input-username">Status</label>

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
                              <button type="submit" class="btn btn-primary my-4">Update ApiKey</button>
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
      <div class="modal fade" id="delete-apiKey-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Delete Api Key</small>
                        </div>
                        <form role="form" method="POST" id="deleteForm">
                           @csrf
                           @method('DELETE')
                            <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 
                                 <label class="form-control pb-5" >Are You Sure You Want To Delete This ApiKey?</label>
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
      <div class="modal fade" id="view-apiKey-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
        $(".editApiKey").click(function(){
            var id = $(this).data('id')
            var key = $(this).data('key')
            var value = $(this).data('value')
            var keytype = $(this).data('keytype')
            var description = $(this).data('description')
            var status = $(this).data('status')

            var route="{{route('apiKey.update',':id')}}"
            route = route.replace(':id',id)
            $("#editKey").val(key)
            $("#editValue").val(value)
            $("#editDescription").val(description)
            $("#ediKeyTypeId").val(keytype)
            $("#editStatus").val(status)
            $("#editForm").attr("action",route)

            $("#edit-apiKey-form").modal()       

        })
          $(".viewApiKey").click(function(){
            var description = "{{asset('storage')}}/"+$(this).data('description')
            $("#viewImage").attr('src',description)
            $("#view-apiKey-form").modal()       

        })
        $(".deleteApiKey").click(function(){
             var id = $(this).data('id')
             var route="{{route('apiKey.destroy',':id')}}"
             route = route.replace(':id',id)
             $("#deleteForm").attr("action",route)
            $("#delete-apiKey-form").modal()
        })
    })
</script>
@endpush
@endsection