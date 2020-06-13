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
                        <h3>Buy leader board</h3>
                     </div>
                  </div>
               </div>
                <div class="row">
                  <div class="col-12">
                    <form action="{{route('buyersReport.index')}}" method="GET">
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
                                <label for="">Active Buyer</label>
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
                                    <option {{request()->orderByFilter=="mostPurchasing"?'selected':null}} value="mostPurchasing">Most Purchasing Buyer</option>
                                    <option {{request()->orderByFilter=="leastPurchasing"?'selected':null}} value="leastPurchasing">Least Purchasing Buyer</option>
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

                           <th scope="col">Purchase Count</th>
                           <th scope="col">Purchase Amount</th>
                           <th scope="col">Wallet points </th>
                           <th scope="col">Fav Coupons</th>

                           <th scope="col"> Most Purchase in Category</th>
                           <th scope="col"> Most Purchase in Sub Category</th>
                     
                           <th scope="col"></th>
                        </tr>
                     </thead>
                     <tbody>

                        @forelse($buyers as $buyer)
                        <tr>
                           <td  class="viewVendor" data-image="{{$buyer->image}}">{{$loop->iteration}}</td>
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
                            @if($mostCoupon)
                              @php
                              
                              $mostCoupon = json_decode($buyer->mostUsedSubCategories($mostCoupon->categories));
                              //print_r($mostCoupon->id??0);

                              @endphp
                              @if($mostCoupon)
                                @foreach($mostCoupon->subcategories as $data)
                                {{$data->id}} {{$data->name}}
                                @endforeach
                              @endif
                            @endif
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
      <div class="modal fade addModel" id="view-category-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
<script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
@endpush
@endsection