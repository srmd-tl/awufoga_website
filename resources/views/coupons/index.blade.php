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
                        <h3 class="mb-0">Coupons</h3>
                        <div class="btn_style1">
                           <a href="{{route('coupon.index')}}" class="btn btn-sm btn-primary">Clear Search</a>
                           
       
                           
                        </div>
                     </div>
                  </div>
                  <div class="col-12">
                     <div class="Search_item">
                          <!-- <form method="GET" action="{{route('coupon.index')}}" class="mr-2">
                           <div class="form-group">
                                 <button value="1" class="btn btn-sm btn-primary" name="statusFilter">Active Search</button>
                                 <button value="0" class="btn btn-sm btn-primary" name="statusFilter">Inactive Search</button>
                           </div>
                           </form> -->
                        <form action="{{route('coupon.index')}}">
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
                                 <input list="filters" class="form-control" placeholder="Search" type="text" name="filter" value="{{request()->filter}}">

                                 <datalist id="filters">
                                     <option value="Active">
                                     <option value="Inactive">
                                   </datalist>
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
                           <th scope="col">Coupon Name</th>
                           <th scope="col">Coupon Type</th>
                           <th scope="col">Vendor</th>
                           <th scope="col">Discount</th>
                           <th scope="col">From Date</th>
                           <th scope="col">To Date</th>
                           <th scope="col">Status</th>
                           <th scope="col">Is Featured</th>
                    
                           <th scope="col"></th>
                        </tr>
                     </thead>
                     <tbody>

                        @forelse($coupons as $coupon)
                        <tr>
                           <td  class="viewCoupon" data-image="{{$coupon->images}}">{{$coupon->title}}</td>
                           <td>{{$coupon->coupon_type==1?'Discount':'Cash Back'}}</td>
                           <td>{{$coupon->vendor->full_name}}</td>
                           <td>{{$coupon->discount}}</td>
                           <td>{{$coupon->start_date}}</td>
                           <td>{{$coupon->end_date}}</td>
                           <td>
                              <span class="badge badge-{{$coupon->status==1?'success':'danger'}}">{{$coupon->status==1?'Accepted':'Rejected'}}</span>
                           </td>
                             <td>
                              <span class="badge badge-{{$coupon->featured==1?'success':'danger'}}">{{$coupon->featured==1?'Yes':'No'}}</span>
                           </td>
                     
                           <td class="text-right">
                              <div class="dropdown">
                                 <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis-v"></i>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                 
                                    <button class="dropdown-item editCoupon" 
                                    data-id="{{$coupon->id}}" 
                                    data-title="{{$coupon->title}}" 
                                    data-description="{{$coupon->description}}" 
                                    data-start_date="{{$coupon->start_date}}" 
                                    data-enddate="{{$coupon->end_date}}" 
                                    data-discount="{{$coupon->discount}}" 
                                    data-vendor="{{$coupon->vendor->id}}" 
                                    data-image="{{$coupon->images}}" 
                                    data-status="{{$coupon->status}}" 
                                    data-featured="{{$coupon->featured}}" 
                                    data-longitude="{{$coupon->longitude}}" 
                                    data-latitude="{{$coupon->latitude}}" 
                                    data-terms="{{$coupon->terms}}" 
                                    data-offertype="{{$coupon->offer_type}}" 
                                    
                                    >Edit</button>
                                    <button class="dropdown-item deleteCoupon" data-id="{{$coupon->id}}" >Delete</button>
                                    <button class="dropdown-item acceptCoupon" data-id="{{$coupon->id}}" >Accept</button>
                                    <button class="dropdown-item rejectCoupon" data-id="{{$coupon->id}}" >Reject</button>
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
                           <td>{{$coupons->withQueryString()->links()}}</td>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
            <div class="card-footer py-4">
               <nav class="d-flex justify-content-end" aria-label="...">
               </nav>
            </div>
         </div>
      </div>
   </div>

  <!-- Edit Coupon Modal -->
   <div class="col-md-4">
      <div class="modal fade" id="edit-coupon-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Edit Coupon</small>
                        </div>
                        <form role="form" method="POST" id="editForm"  enctype="multipart/form-data">
                           @csrf
                           @method('PUT')
                           <div class="row">
                              <div class="col-md-6">
                                 
                                 <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Coupon Username" type="text" name="title" id="editTitle">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Coupon Full Name" type="text" name="description" id="editDescription">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                   <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-start_date-83"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Coupon Email" type="text" name="start_date" id="editStartDate">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-discount"></i></span>
                                       </div>
                                       <input type="text" name="end_date" class="form-control" id="editEndDate">
                                          
                              
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-discount"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Coupon Phone" type="text" name="discount" id="editDiscount">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                         
                                 <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                       </div>
                                       <select class="form-control" name="vendor" id="editVendor"> 
                                          @forelse($vendors as $vendor)
                                          <option  value="{{$vendor->id}}">{{$vendor->full_name}}</option>
                                          @empty
                                          @endforelse
                                         
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">

                              <div class="col-md-6">
                                  <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-send"></i></span>
                                       </div>
                                       <select class="form-control" name="featured" id="editIsFeatured"> 
                                          <option value="1">On</option>
                                          <option value="0">Off</option>
                                       </select>
                                    </div>
                                 </div>
                                 
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-toggle-off"></i></span>
                                       </div>
                                       <select class="form-control" name="status" id="editStatus"> 
                                          <option value="0">Accepted</option>
                                          <option value="1">Rejected</option>
                                          <option value="2">Pending</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                            <div class="row">

                              <div class="col-md-6">
                                  <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-send"></i></span>
                                       </div>
                                       <select class="form-control"  name="offerType" id="editOfferType"> 
                                          <option value="1">On</option>
                                          <option value="0">Off</option>
                                       </select>
                                    </div>
                                 </div>
                                 
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-toggle-off"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Coupon Email" type="text" name="term" id="editTerms"> 
                                  
                                    </div>
                                 </div>
                              </div>
                           </div>
                            <div class="row">
                              <div class="col-md-6">
                                   <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-start_date-83"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Coupon Email" type="text" name="longitude" id="editLongitude">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-discount"></i></span>
                                       </div>
                                       <input type="text" name="latitude" class="form-control" id="editLatitude">
                                          
                              
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-file-image-o"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="File" type="file" name="image" id="editImage">
                                    </div>
                                 </div>
                                  
                              </div>
                           </div>

                           <div class="text-center">
                              <button type="submit" class="btn btn-primary my-4">Update Coupon</button>
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
      <div class="modal fade" id="delete-coupon-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
                                 
                                 <label class="form-control" >Are You Sure You Want To Delete This Coupon?</label>
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
   <!-- Accept Coupon Modal -->
     <div class="col-md-4">
      <div class="modal fade" id="accept-coupon-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Accept Coupon</small>
                        </div>
                        <form role="form" method="POST" id="acceptForm">
                           <input type="hidden" name="status" value="1">
                           @csrf
                           @method('PUT')
                            <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 
                                 <label class="form-control" >Are You Sure You Want To Accept This Coupon?</label>
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
     <!-- Reject Coupon Modal -->
     <div class="col-md-4">
      <div class="modal fade" id="reject-coupon-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Reject Coupon</small>
                        </div>
                        <form role="form" method="POST" id="rejectForm">
                           <input type="hidden" name="status" value="2">
                           @csrf
                           @method('PUT')
                            <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 
                                 <label class="form-control" >Are You Sure You Want To Reject This Coupon?</label>
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
        <!-- View Coupon Modal -->
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
                              <div class="input-group input-group-merge input-group-alternative" id="imageDiv">
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
   <!-- End View Coupon cat Modal -->
@include('layouts.footers.auth')
</div>

@push('js')
<script type="text/javascript">
    $(function(){
        $(".editCoupon").click(function(){
            var id = $(this).data('id')
            var title = $(this).data('title')
            var description = $(this).data('description')
            var start_date = $(this).data('start_date')
            var discount = $(this).data('discount')
            var enddate = $(this).data('enddate')
            var vendor = $(this).data('vendor')
            var images = $(this).data('image')
            var featured=$(this).data('featured')
            var status = $(this).data('status')
            var longitude = $(this).data('longitude')
            var latitude = $(this).data('latitude')
            var offertype = $(this).data('offertype')
            var terms = $(this).data('terms')
            console.log(images)
            var route="{{route('coupon.update',':id')}}"
            route = route.replace(':id',id)
            $("#editTitle").val(title)
            $("#editDescription").val(description)
            $("#editStartDate").val(start_date)
            $("#editDiscount").val(discount)
            $("#editEndDate").val(enddate)
            $("#editVendor").val(vendor)
            $("#editIsFeatured").val(featured)
            $("#editStatus").val(status)
            $("#editTerms").val(terms)
            $("#editLongitude").val(longitude)
            $("#editLatitude").val(latitude)
            $("#editOfferType").val(offertype)
            $("#editForm").attr("action",route)

            $("#edit-coupon-form").modal()       

        })
          $(".viewCoupon").click(function(){
            var images = $(this).data('image')
            console.log(images);
            $("#imageDiv").html("")
            $.each(images,function(key,value){
               $("#imageDiv").append('<img src='+value.image+'>')
            })

  
            $("#view-category-form").modal()       

        })

        $(".deleteCoupon").click(function(){
             var id = $(this).data('id')
             var route="{{route('coupon.destroy',':id')}}"
             route = route.replace(':id',id)
             $("#deleteForm").attr("action",route)
            $("#delete-coupon-form").modal()
        })
        $(".acceptCoupon").click(function(){
             var id = $(this).data('id')
             var route="{{route('coupon.updateStatus',':id')}}"
             route = route.replace(':id',id)
             $("#acceptForm").attr("action",route)
            $("#accept-coupon-form").modal()
        })
        $(".rejectCoupon").click(function(){
             var id = $(this).data('id')
             var route="{{route('coupon.updateStatus',':id')}}"
             route = route.replace(':id',id)
             $("#rejectForm").attr("action",route)
            $("#reject-coupon-form").modal()
        })
    })
</script>
@endpush
@endsection