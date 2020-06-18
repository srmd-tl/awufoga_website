@extends('layouts.app')
@section('content')

@include('layouts.headers.cards')
<div class="container-fluid mt--7">
   @include('alerts.alert')
   <div class="row">
      <div class="col">
         <div class="card shadow">
          
  
            <div class="leader-box">
               <div class="row">
                  <div class="col-md-12">
                     <div class="title-leader mt-3">
                        <h3>
Awuf Referral Buyer Report
</h3>
                     </div>
                  </div>
               </div>
               <div class="row mb-2">
                <div class="col-12">
                  <form action="">
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
                              <label for="">Order By</label>
                             
                              <select  name="orderBy">
                                   <option value="highestEarned">Highest Earned Amount</option>
                                   <option value="lowestEarned">Lowest Earned Amount</option>
                                   <option value="highestReferred">Highest Reffered Count</option>
                                   <option value="lowestReferred">Lowest Reffered Count</option>
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
                          <th scope="col">Sl No</th>
                          <th scope="col">Buyer Name</th>
                          <th scope="col">Buyer  mobile</th>
                          <th scope="col">Total No Refferal</th>
                          <th scope="col">Referral Sale Amount</th>
                          <th scope="col">Earned From Referral</th>
                          <th>Referral Details</th>
                      </tr>
                    </thead>

                     <tbody>

                        @forelse($buyers as $buyer)
                        <tr>
                           <td >{{$loop->iteration}}</td>
                           <td  >{{$buyer->full_name}}</td>
                           
                           <td>{{$buyer->phone}}</td>
                           <td>{{$buyer->referrals->count()}}</td>
                           <td>{{$buyer->created_at}}</td>
                          
                           <td>{{$buyer->referrals[0]->earnedFromReferral}}</td>
                      
                           <td class="viewVendor" data-image="{{$buyer->image}}" 
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
                                    data-referrals="{{$buyer->referrals}}" 
                              >  
                              <a  >Click To View</a>
                             
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
         <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body ">
                        <div class="text-center text-muted mb-4">
                           <small>Buyer Reference Details</small>
                        </div>
                         <table class="table header-border table-hover verticle-middle">
                             <thead>
                                 <tr>
                                     <th scope="col">Sl No</th>
                                     <th scope="col">Buyer Name</th>
                                     <th scope="col">Buyer  mobile</th>
                                     <th scope="col">Reference code</th>
                                     <th scope="col">Total No Sale</th>
                                     <th scope="col">Total Sale Amount</th>
                                 </tr>
                             </thead>
                             <tbody id="buyerReference">
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
   <!-- End View Vendor cat Modal -->
@include('layouts.footers.auth')
</div>

@push('js')
<script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
<script type="text/javascript">
    $(function(){

          $(".viewVendor").click(function(){
             $("#buyerReference").html('')

            var referralBuyers = $(this).data("referrals")

            $.each(referralBuyers,function(key,value){
              id=value.referral_buyer.split('_')

              route = "{{route('buyer.show',':id')}}"
              route =route.replace(':id',id[1])
              getData(route) .then(data=>{
                $("#buyerReference").append(data)
         
              })
              
            })
            var image = "{{asset('storage')}}/"+$(this).data('image')
            $("#viewImage").attr('src',image)


            $("#view-category-form").modal()       

        })

    })
</script>
@endpush
@endsection