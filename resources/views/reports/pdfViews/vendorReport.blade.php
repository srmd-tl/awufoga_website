@extends('layouts.report')
@section('content')
<div class="container" >
  <div style="text-align: center;">
    <!-- <img src="http://127.0.0.1:8000/logo.png" width="300" alt=""> -->
  </div>
  <div class="" style="text-align: center;">
    <h2 style="margin-top: 20px !important">Vendor Report</h2>
    <p>Report About Vendor</p>      
  </div> 
  <div class="date-detail" style="padding: 0px 50px">
    <p>17/30/2020</p>
  </div>
  <table  style="
    table-layout: fixed;
    margin: 30px auto !important; width: 100%;border-collapse: collapse;">
    <thead class="thead-light"  style="background: #e8e8e8;">
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
               <th scope="col"> Wallet Point</th>
            </tr>
         </thead>
         <tbody>

            @forelse($vendors as $vendor)
            <tr>
               <td class="viewVendor" data-image="{{$vendor->image}}" ><a >{{$loop->iteration}}</a></td>
               <td  ><a >{{$vendor->full_name}}</a></td>
   
               <td>{{$vendor->phone}}</td>
               <td>{{$vendor->created_at}}</td>
               <td>Not Known Yet</td>
              
               <td>{{$vendor->usedCoupons->count()}}</td>
               <td>{{$vendor->usedCoupons->sum('paid_price')}}</td>
               <td>{{$vendor->activeCoupons->count()}}</td>
               <td>{{$vendor->expiredCoupons->count()}}</td>
                <td>
                  @php
                  $mostCoupon = json_decode($vendor->mostUsedCategories());
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
                  
                  $mostCoupon = json_decode($vendor->mostUsedSubCategories($mostCoupon->categories));
                  //print_r($mostCoupon->id??0);

                  @endphp
                  @if($mostCoupon)
                    @foreach($mostCoupon->subcategories as $data)
                    {{$data->id}} {{$data->name}}
                    @endforeach
                  @endif
                @endif
                </td>
     

               <td>{{$vendor->usedCoupons->sum('payment_wallet')}}</td>
        

              
            </tr>
            @empty
            <tr>
               <td>Nothing Found!</td>
            </tr>
            @endforelse
         </tbody>
     </table>


     <div class="page-number" style="text-align: center; margin:10px 0px;">
        <span style="font-size: 18px; color: #000000; margin:0px 10px;">Vendor Report</span>
        <span><span>Page:</span> 15</span>
     </div>
 </div>
@endsection