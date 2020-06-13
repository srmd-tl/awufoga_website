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
                        <h3>Awuful Vendor Referral Report</h3>
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
                            <th scope="col">Vendor Name</th>
                            <th scope="col">Vendor  mobile</th>
                            <th scope="col">Total No Refferal</th>
                            <th scope="col">Referral Sale Amount</th>
                            <th scope="col">Earned From Referral</th>
                            <th>Referral Details</th>
                        </tr>
                    </thead>
                     <tbody>

                        @forelse($vendors as $vendor)
                        <tr>
                           <td ><a >{{$loop->iteration}}</a></td>
                           <td  ><a >{{$vendor->full_name}}</a></td>
                           <td>{{$vendor->mobile}}</td>
                           <td>{{$vendor->phone}}</td>
                           <td>{{$vendor->created_at}}</td>
                          
                           <td>{{$vendor->referrals[0]->earnedFromReferral}}</td>
                      
                           <td class="viewVendor" data-image="{{$vendor->image}}" 
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
                             <tbody>
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
                           <a href="#">Close</a>
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