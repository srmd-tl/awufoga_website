@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
      
        <div class="row mt-5">
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">New Offers Waiting for Admin Approval </h3>
                            </div>
                          
                        </div>
                    </div>
                    <div class="table_design">
                        <div class="table-responsive myTable myTableStyle">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                  <tr>
                                        <th>#</th>
                                        <th>Coupon Title</th>
                                        <th>Vendor</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            <tbody>

                              @forelse($coupons as $coupon)
                              <tr>
                                <td>{{$loop->iteration}}</td>
                                 <td  class="viewCoupon" 

                                  data-image="{{$coupon->images}}" 
                                  data-description="{{$coupon->description}}" 
                                  data-term="{{$coupon->terms}}"
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

                                 >{{$coupon->title}}</td>
                                 <td>{{$coupon->vendor->full_name}}</td>
                    
                                 <td>{{$coupon->start_date}}</td>
                                 <td>{{$coupon->end_date}}</td>                  
                                <td >
                                       <a  title="Accept"  class="btn btn-success btn-sm accept"  data-action="{{route('coupon.updateStatus',$coupon->id)}}"
                                       >
                                             Accept
                                       </a>

                                    

                                  
                                      <a  title="Reject"  class="btn btn-danger btn-sm reject" data-action="{{route('coupon.updateStatus',$coupon->id)}}" >
                                             Reject
                                       </a>

                                   
                                </td>
                              </tr>
                              @empty
                              <tr>
                                 <td>Nothing Found!</td>
                              </tr>
                              @endforelse
                           </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0"> New Vendors Waiting for Admin Approval </h3>
                            </div>
                          
                        </div>
                    </div>
                    <div class="table_design">
                        <div class="table-responsive myTable">
                            <!-- Projects table -->
                              <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                  <tr>
                                      <th>#</th>
                                      <th>Vendor Name</th>
                                      <th>Phone</th>

                                      <th>City</th>
                            
                                      <th>Actions</th>
                                  </tr>
                                </thead>
                                   <tbody>

                              @forelse($vendors as $vendor)
                              <tr>
                                <td>{{$loop->iteration}}</td>
                                 <td class="viewVendor" 
                                 data-image="{{$vendor->image}}"
                                   data-id="{{$vendor->id}}" 
                                    data-username="{{$vendor->user_name}}" 
                                    data-fullname="{{$vendor->full_name}}" 
                                    data-email="{{$vendor->email}}" 
                                    data-countrycode="{{$vendor->country_code}}" 
                                    data-phone="{{$vendor->phone}}" 
                                    data-businessname="{{$vendor->business_name}}" 
                                    data-businessemail="{{$vendor->business_email}}" 
                                    data-businesscountrycode="{{$vendor->business_country_code}}" 
                                    data-businessphone="{{$vendor->business_phone}}" 
                                    data-businesswebsite="{{$vendor->website}}" 
                                    data-businessaddress="{{$vendor->address}}" 
                                    data-longitude="{{$vendor->longitude}}" 
                                    data-latitude="{{$vendor->latitude}}" 
                                    data-correctaddress="{{$vendor->correct_address}}" 
                                    data-rate="{{$vendor->rate}}" 
                                    data-reviewcount="{{$vendor->review_count}}" 
                                    data-firstreferral="{{$vendor->first_referral}}" 
                                    data-notification="{{$vendor->notification_on_off}}" 
                                    data-image="{{$vendor->image}}" 
                                    data-status="{{$vendor->status}}" 
                                  ><a >{{$vendor->full_name}}</a></td>
                                 <td>{{$vendor->full_phone}}</td>
                                 <td>{{$vendor->city}}</td>
                             
                               
                     
                                <td>

                                     <a  title="Accept"  class="btn btn-success btn-sm accept"  data-action="{{route('vendor.updateStatus',$vendor->id)}}"
                                       >
                                             Accept
                                       </a>

                                    

                                  
                                      <a  title="Reject"  class="btn btn-danger btn-sm reject" data-action="{{route('vendor.updateStatus',$vendor->id)}}" >
                                             Reject
                                       </a>


                                       
                                     
                                </td>
                              </tr>
                              @empty
                              <tr>
                                 <td>Nothing Found!</td>
                              </tr>
                              @endforelse
                           </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

         <!-- View Vendor Modal -->
     <div class="col-md-4">
      <div class="modal fade" id="view-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body ">
                        <div class="text-center text-muted mb-4">
                           <small>View  Image</small>
                        </div>
                         <table class="table header-border table-hover verticle-middle">
                             <thead>
                                 <tr>
                                     <th scope="col">Sl No</th>
                                     <th scope="col">Vendor Name</th>
                                     <th scope="col">Vendor  mobile</th>
                                     <th scope="col">Reference code</th>
                                     <th scope="col">Total No Sale</th>
                                     <th scope="col">Total Sale Amount</th>
                                 </tr>
                             </thead>
                             <tbody id="referralBuyers">
                                 <tr>
                                     <th>1</th>
                                     <td>Abdullahi</td>
                                     <td>AS1233</td>
                                     <td>987654321</td>
                                     <td>125</td>
                                     <td>145000</td>
                                 </tr>
                                 <tr>
                                     <th>1</th>
                                     <td>Laeela</td>
                                     <td>ADS233</td>
                                     <td>123456</td>
                                     <td>100</td>
                                     <td>140000</td>
                                 </tr>
                             </tbody>
                         </table>

                         <div class="close_btn">
                           <a data-dismiss="modal">Close</a>
                         </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>



    <!-- Accept Modal -->
     <div class="col-md-4">
      <div class="modal fade" id="accept-modal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Accept</small>
                        </div>
                        <form role="form"  method="POST" id="acceptForm">
                          <input type="hidden" name="status" value="1">
                           @csrf
                           @method('PUT')
                            <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 
                                 <label class="form-control pb-5" >Are You Sure You Want To Accept</label>
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
   <!-- End Accept Modal -->

   <!-- Reject Modal -->
     <div class="col-md-4">
      <div class="modal fade" id="reject-modal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Reject</small>
                        </div>
                        <form role="form" method="POST" id="rejectForm">
                          <input type="hidden" name="status" value="2">
                           @csrf
                           @method('PUT')
                            <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 
                                 <label class="form-control pb-5" >Are You Sure You Want To Reject</label>
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
   <!-- End Reject Modal -->
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script type="text/javascript">
    $(function(){

          $(".viewCoupon").click(function(){
          var image = $(this).data('image')
          var description = $(this).data('description')
          var term = $(this).data('term')
          var featured = $(this).data('featured')
          var longitude = $(this).data('longitude')
          var latitude = $(this).data('latitude')
          $("#view-form").modal()       

         

        })

           $(".accept").click(function(){
            var action = $(this).data('action')
            $("#acceptForm").attr('action',action)
            $('#accept-modal').modal()
          })
            $(".reject").click(function(){
            var action = $(this).data('action')
            $("#rejectForm").attr('action',action)
            $('#reject-modal').modal()
          })

    })

   


</script>
@endpush