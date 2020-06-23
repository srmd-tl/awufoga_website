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
                        <h3>Sales Report</h3>
                     </div>
                  </div>
               </div>
                <div class="row">
                  <div class="col-12">
                    <form action="{{route('salesReport.index')}}" method="GET">
                       <div class="row">
                          <div class="col-md-4">
                             <div class="buyer-leader-box">
                                <label for="">From Date</label>
                                <input type="text" class="datepicker" name="fromDate" value="{{\Carbon\Carbon::now()->toDateString()}}">
                             </div>
                          </div>
                          <div class="col-md-4">
                             <div class="buyer-leader-box">
                                <label for="">To Date</label>
                                <input type="text" class="datepicker" name="toDate" value="{{\Carbon\Carbon::now()->toDateString()}}">
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
                                <label for="">Order By</label>
                                <select name="orderByFilter">
                                    <option {{request()->orderByFilter=="highSaleAmount"?'selected':null}} value="highSaleAmount">High Sale Amount</option>
                                    <option {{request()->orderByFilter=="lowSaleAmount"?'selected':null}} value="lowSaleAmount">Low Sale Amount</option>
                                    <option {{request()->orderByFilter=="salesDateAsc"?'selected':null}} value="salesDateAsc">Sales Date Asc</option>
                                    <option {{request()->orderByFilter=="salesDateDsc"?'selected':null}} value="salesDateDsc"> Sales Date Dsc</option>
                                </select>
                             </div>
                          </div>
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
                                <a href="{{route('salesReport.index')}}" class="clear-btn">Clear</a>
                                <a href="{{ request()->fullUrlWithQuery(['pdf' => 'true']) }}" class="export-btn">Export To PDF</a>
                                <a href="{{ request()->fullUrlWithQuery(['excel' => 'true']) }}" class="export-btn">Export To Excel</a>
                             </div>
                          </div>
                       </div>
                    </form>
                  </div>
                </div>
            
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
                        <td  class="viewBlog" data-image="{{$sale->vendor->id??1}}" >{{$sale->vendor->full_name??''}}</td>
                        <td  class="viewBlog" data-image="{{$sale->buyer->id??1}}" >{{$sale->buyer->full_name??''}}</td>
                        <td  >{{$sale->buyer->phone??''}}</td>
                        <td  >{{$sale->created_at}}</td>
                        <td  >{{$sale->paid_price}}</td>
                        <td  > {{$sale->coupon?$sale->coupon->discount:''}}</td>
                        <td  >

                           {{$sale->paid_price*($sale->coupon?($sale->coupon->discount/100):1)}}</td>


                           @php 
                              $discount=$sale->paid_price*($sale->coupon?($sale->coupon->discount/100):1);
                              $awufogaComission = $sale->paid_price*(8/100);

                              $total =  $discount-$awufogaComission;
                              $vendorAmount= $sale->paid_price-$total;


                           @endphp
                        <td  >{{ $vendorAmount}}</td>
                        <td  >{{$sale->paid_price*(8/100)}}</td>
                           @php
                           $data = 0;
                           if($sale->coupon)
                           {
                              $data = $sale->coupon->singleCouponRating($sale->buyer->id??1);
                           
                              if($data)
                              {
                                 $data = $data->pivot->rating;
                              }
                           }
                            
                           @endphp
                        <td > {{$data}}</td>
                        <td>

                         @if($sale->payment_wallet>0)
                         Wallet
                         @elseif($sale->payment_credit>0)
                         Credit
                         @elseif($sale->payment_cash>0)
                         Cash
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
                        <td>{{$sales->withQueryString()->links()}}</td>
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


     <!-- View Subcat Modal -->
     <div class="col-md-4">
      <div class="modal fade" id="view-sale-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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

          $(".viewBlog").click(function(){
            var description = "{{asset('storage')}}/"+$(this).data('description')
            $("#viewImage").attr('src',description)
            $("#view-sale-form").modal()

        })

    })
</script>
<script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
@endpush
@endsection
