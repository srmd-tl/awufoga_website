@extends('layouts.app')
@section('content')

@include('layouts.headers.cards')
<div class="container-fluid mt--7">
   @include('alerts.alert')
   <div class="row">
      <div class="col">
         <div class="card shadow">
         
            <div class="leader-box mt-5">
               <div class="row">
                  <div class="col-md-12">
                     <div class="title-leader">
                        <h3>Vendor leader board</h3>
                     </div>
                  </div>
               </div>
           <div class="row">
                  <div class="col-12">
                    <form action="{{route('vendorsReport.index')}}" method="GET">
                       <div class="row">
                          <div class="col-md-4">
                             <div class="buyer-leader-box">
                                <label for="">From Date</label>
                                <input type="text" class="datepicker" name="fromDate">
                             </div>
                          </div>
                          <div class="col-md-4">
                             <div class="buyer-leader-box">
                                <label for="">To Date</label>
                                <input type="text" class="datepicker" name="toDate">
                             </div>
                          </div>
                          <div class="col-md-4">
                             <div class="buyer-leader-box">
                                <label for="">Category</label>
                                <select name="categoryFilter">
                                  <option value="All">All</option>
                                 @forelse($categories as $category)
                                   <option {{request()->categoryFilter==$category->id?'selected':null}} value="{{$category->id}}">{{$category->name}}</option>
                                 @empty
                                 @endforelse
                                </select>
                             </div>
                          </div>
                       </div>
                       <div class="row">
                          <div class="col-md-4">
                             <div class="buyer-leader-box">
                                <label for="">Sub Category</label>
                                <select name="subCategoryFilter">
                                   
                                </select>
                             </div>
                          </div>
                          <div class="col-md-4">
                             <div class="buyer-leader-box">
                                <label for="">Active Vendor</label>
                                <select name="activeFilter" >
                                   <option value="1">Yes</option>
                                   <option value="0">No</option>
                                 
                                </select>
                             </div>
                          </div>
                          <div class="col-md-4">
                             <div class="buyer-leader-box">
                                <label for="">Order By</label>
                                <select name="orderByFilter">
                                    <option {{request()->orderByFilter=="mostPurchasing"?'selected':null}} value="mostPurchasing">Most Selling Vendor</option>
                                    <option {{request()->orderByFilter=="leastPurchasing"?'selected':null}} value="leastPurchasing">Least Selling Vendor</option>
                                    <option {{request()->orderByFilter=="highestWallet"?'selected':null}} value="highestWallet">Highest Wallet Point</option>
                                    <option {{request()->orderByFilter=="lowestWallet"?'selected':null}} value="lowestWallet">Lowest Wallet Point</option>
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
                                <button  class="search-btn">Search</button>
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
                           <th scope="col">Sales Count</th>
                           <th scope="col">Sales Total</th>
                           <th scope="col"> Active coupons</th>
                           <th scope="col"> Expired Coupons</th>
                           <th scope="col"> Most sales in Category</th>
                           <th scope="col"> Most sales in Sub Category</th>
                           <th scope="col"> Most sales in Coupon Type</th>
                           <th scope="col"> Wallet Point</th>
                           <th scope="col"></th>
                        </tr>
                     </thead>
                     <tbody>

                        @forelse($vendors as $vendor)
                        <tr>
                           <td class="viewVendor" data-image="{{$vendor->image}}" ><a >{{$vendor->id}}</a></td>
                           <td  ><a >{{$vendor->full_name}}</a></td>
                           <td>{{$vendor->email}}</td>
                           <td>{{$vendor->phone}}</td>
                           <td>{{$vendor->created_at}}</td>
                          
                           <td>{{$vendor->usedCoupons->count()}}</td>
                           <td>{{$vendor->usedCoupons->sum('paid_price')}}</td>
                           <td>{{$vendor->activeCoupons->count()}}</td>
                           <td>{{$vendor->expiredCoupons->count()}}</td>

                           
      
                           <td>{{$vendor->usedCoupons->sum('payment_wallet')}}</td>
                           <td>
                              <span class="badge badge-{{$vendor->notification_on_off==1?'success':'danger'}}">{{$vendor->notification_on_off==1?'On':'Off'}}</span>
                           </td>
                           <td class="text-right">
                              <div class="dropdown">
                                 <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis-v"></i>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                 
                                    <button class="dropdown-item editVendor" 
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
                                    >Edit</button>
                                    <button class="dropdown-item deleteVendor" data-id="{{$vendor->id}}" >Delete</button>
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
                           <td>{{$vendors->withQueryString()->links()}}</td>
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

          $(".viewVendor").click(function(){
            var image = "{{asset('storage')}}/"+$(this).data('image')
            $("#viewImage").attr('src',image)
            $("#view-category-form").modal()       

        })

    })
</script>
@endpush
@endsection