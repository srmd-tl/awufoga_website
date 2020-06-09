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
                        <h3 class="mb-0">Vendors</h3>
                        <div class="btn_style1">
                           <a href="{{route('vendor.index')}}" class="btn btn-sm btn-primary">Clear Search</a>
                           
                          
                           
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
                        <form action="{{route('vendor.index')}}">
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
            <div class="leader-box">
               <div class="row">
                  <div class="col-md-12">
                     <div class="title-leader">
                        <h3>Buy leader board</h3>
                     </div>
                  </div>
               </div>
               <div class="row">
                <div class="col-12">
                  <form action="">
                     <div class="row">
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">From Date</label>
                              <input type="text" id="datepicker">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">To Date</label>
                              <input type="text">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">Category</label>
                              <select name="" id="">
                                 <option value="">All</option>
                                 <option value="">Category 1</option>
                                 <option value="">Category 2</option>
                                 <option value="">Category 3</option>
                                 <option value="">Category 4</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">Sub Category</label>
                              <select name="" id="">
                                 <option value="">All</option>
                                 <option value="">Category 1</option>
                                 <option value="">Category 2</option>
                                 <option value="">Category 3</option>
                                 <option value="">Category 4</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">Active Buyer</label>
                              <select name="" id="">
                                 <option value="">All</option>
                                 <option value="">Category 1</option>
                                 <option value="">Category 2</option>
                                 <option value="">Category 3</option>
                                 <option value="">Category 4</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">Order By</label>
                              <select name="" id="">
                                 <option value="">Most Purchasing Buyers</option>
                                 <option value="">Category 1</option>
                                 <option value="">Category 2</option>
                                 <option value="">Category 3</option>
                                 <option value="">Category 4</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">City</label>
                              <select name="" id="">
                                 <option value="">Most Purchasing Buyers</option>
                                 <option value="">Category 1</option>
                                 <option value="">Category 2</option>
                                 <option value="">Category 3</option>
                                 <option value="">Category 4</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">Coupon Type</label>
                              <select name="" id="">
                                 <option value="">Most Purchasing Buyers</option>
                                 <option value="">Category 1</option>
                                 <option value="">Category 2</option>
                                 <option value="">Category 3</option>
                                 <option value="">Category 4</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="leader-btn">
                              <a href="" class="search-btn">Search</a>
                              <a href="" class="clear-btn">Clear</a>
                              <a href="{{ request()->fullUrlWithQuery(['pdf' => 'true']) }}" class="export-btn">Export To PDF</a>
                              <a href="{{ request()->fullUrlWithQuery(['excel' => 'true']) }}" class="export-btn">Export To Excel</a>
                           </div>
                        </div>
                     </div>
                  </form>
                </div>
            </div>

         
            <div class="table_design">
               <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                     <thead class="thead-light">
                        <tr>
                           <th scope="col">Sl.No.</th>
                           <th scope="col">Full Name</th>
                           <th scope="col">Mobile</th>
                           <th scope="col">Member Since</th>
                           <th scope="col">City</th>

                           <th scope="col">Purchase Count</th>
                           <th scope="col">Purchase Amount</th>
                           <th scope="col">Wallet points </th>
                           <th scope="col">Fav Coupons</th>

                           <th scope="col"> Most Purchase in Category</th>
                           <th scope="col"> Most Purchase in Sub Category</th>
                           <th scope="col"> Most sales in Coupon Type</th>
                           <th scope="col"> Wallet Point</th>
                           <th scope="col"></th>
                        </tr>
                     </thead>
                     <tbody>

                        @forelse($buyers as $buyer)
                        <tr>
                           <td  class="viewVendor" data-image="{{$buyer->image}}">{{$buyer->id}}</td>
                           <td ><a >{{$buyer->full_name}}</a></td>
                           <td>{{$buyer->phone}}</td>
                           <td>{{$buyer->created_at}}</td>
                           <td>{{$buyer->created_at}}</td>
                          
                           <td>{{$buyer->usedCoupons->count()}}</td>
                           <td>{{$buyer->usedCoupons->sum('paid_price')}}</td>
                           <td>{{$buyer->usedCoupons->sum('payment_wallet')}}</td>
                           <td>{{$buyer->favCoupons->count()}}</td>
                           <td>
                            @php
                            $mostCoupon = json_decode($buyer->mostUsedCategories());
                            //print_r($mostCoupon->id??0);

                            @endphp
                            @if($mostCoupon)
                              @foreach($mostCoupon->categories as $data)
              
                              {{$data->id}} {{$data->name}}
                              @endforeach
                            @endif
                            </td>
                             <td>
                            @php
                            $mostCoupon = json_decode($buyer->mostUsedCategories());
                            //print_r($mostCoupon->id??0);

                            @endphp
                            @if($mostCoupon)
                              @foreach($mostCoupon->categories as $data)
                              {{$data->id}} {{$data->name}}
                              @endforeach
                            @endif
                            </td>
                           

                           <td>
                              <span class="badge badge-{{$buyer->notification_on_off==1?'success':'danger'}}">{{$buyer->notification_on_off==1?'On':'Off'}}</span>
                           </td>
                           <td class="text-right">
                              <div class="dropdown">
                                 <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis-v"></i>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                 
                                    <button class="dropdown-item editVendor" 
                                    data-id="{{$buyer->id}}" 
                                    data-username="{{$buyer->user_name}}" 
                                    data-fullname="{{$buyer->full_name}}" 
                                    data-email="{{$buyer->email}}" 
                                    data-countrycode="{{$buyer->country_code}}" 
                                    data-phone="{{$buyer->phone}}" 
                                    data-businessname="{{$buyer->business_name}}" 
                                    data-businessemail="{{$buyer->business_email}}" 
                                    data-businesscountrycode="{{$buyer->business_country_code}}" 
                                    data-businessphone="{{$buyer->business_phone}}" 
                                    data-businesswebsite="{{$buyer->website}}" 
                                    data-businessaddress="{{$buyer->address}}" 
                                    data-longitude="{{$buyer->longitude}}" 
                                    data-latitude="{{$buyer->latitude}}" 
                                    data-correctaddress="{{$buyer->correct_address}}" 
                                    data-rate="{{$buyer->rate}}" 
                                    data-reviewcount="{{$buyer->review_count}}" 
                                    data-firstreferral="{{$buyer->first_referral}}" 
                                    data-notification="{{$buyer->notification_on_off}}" 
                                    data-image="{{$buyer->image}}" 
                                    data-status="{{$buyer->status}}" 
                                    >Edit</button>
                                    <button class="dropdown-item deleteVendor" data-id="{{$buyer->id}}" >Delete</button>
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
            </div>
            <div class="card-footer py-4">
               <nav class="d-flex justify-content-end" aria-label="...">
               </nav>
            </div>
         </div>
      </div>
   </div>

        <!-- View Vendor Modal -->
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
   <!-- End View Vendor cat Modal -->
@include('layouts.footers.auth')
</div>

@push('js')
<script type="text/javascript">
    $(function(){
        $(".editVendor").click(function(){
            var id = $(this).data('id')
            var username = $(this).data('username')
            var fullname = $(this).data('fullname')
            var email = $(this).data('email')
            var phone = $(this).data('phone')
            var countrycode = $(this).data('countrycode')

            var businessName = $(this).data('businessname')
            var businessEmail = $(this).data('businessemail')
            var businessPhone = $(this).data('businessphone')
            var businessCountryCode = $(this).data('businesscountrycode')
            var businessWebsite = $(this).data('businesswebsite')
            var businessAddress = $(this).data('businessaddress')
            var longitude = $(this).data('longitude')
            var latitude = $(this).data('latitude')
            var correctAddress = $(this).data('correctaddress')
            var rate = $(this).data('rate')
            var reviewCount = $(this).data('reviewcount')
            var firstReferral = $(this).data('firstreferral')


            var notification = $(this).data('notification')
            var image = $(this).data('image')
            var status = $(this).data('status')

            var route="{{route('vendor.update',':id')}}"
            route = route.replace(':id',id)
            $("#editUsername").val(username)
            $("#editFullname").val(fullname)
            $("#editEmail").val(email)
            $("#editPhone").val(phone)
            $("#editCountryCode").val(countrycode)

            $("#editBusinessName").val(businessName)
            $("#editBusinessEmail").val(businessEmail)
            $("#editBusinessPhone").val(businessPhone)
            $("#editBusinessWebsite").val(businessWebsite)
            $("#editBusinessAddress").val(businessAddress)
            $("#editBusinessLongitude").val(longitude)
            $("#editBusinessLatitude").val(latitude)
            $("#editBusinessCorrectAddress").val(correctAddress)
            $("#editRate").val(rate)
            $("#editReviewCount").val(reviewCount)
            $("#editFirstReferral").val(firstReferral)

            $("#editNotification").val(notification)
            $("#editShowImage").attr('src',image)
            $("#editStatus").val(status)
            $("#editForm").attr("action",route)

            $("#edit-vendor-form").modal()       

        })
          $(".viewVendor").click(function(){
            var image = "{{asset('storage')}}/"+$(this).data('image')
            $("#viewImage").attr('src',image)
            $("#view-category-form").modal()       

        })

        $(".deleteVendor").click(function(){
             var id = $(this).data('id')
             var route="{{route('vendor.destroy',':id')}}"
             route = route.replace(':id',id)
             $("#deleteForm").attr("action",route)
            $("#delete-vendor-form").modal()
        })
    })
</script>
@endpush
@endsection