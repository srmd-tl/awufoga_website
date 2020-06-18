@extends('layouts.report')
@section('content')
<div class="container" >
@includeWhen(request()->pdf==true,'reports.pdfViews.include.header',['date'=>\Carbon\Carbon::now()->toDateString(),'name'=>'Vendor Leader Board
','logo'=>asset('logo.png')])
    <style>
    th ,td{
     text-align: left;
     font-size: 14px;
    }
  </style>           
  <table  style="
    margin: 30px auto !important; width: 100%;border-collapse: collapse;">
    <thead class="thead-light" >
            <tr>
              <th >Sl.No.</th>
               <th >Full Name</th>
               <th >Mobile</th>
               <th >Member Since</th>
               <th >City</th>
               <th >Sales Count</th>
               <th >Sales Total</th>
               <th > Active coupons</th>
               <th > Expired Coupons</th>
               <th > Most sales in Category</th>
               <th > Most sales in Sub Category</th>
               <th > Wallet Point</th>
            </tr>
         </thead>
         <tbody>

            @forelse($vendors as $vendor)
            <tr>
               <td >{{$loop->iteration}}</td>
               <td  >{{$vendor->full_name}}</td>
   
               <td>{{$vendor->phone}}</td>
               <td>{{$vendor->created_at->toDateString()}}</td>
               <td>N/A</td>
              
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

     @includeWhen(request()->pdf==true,'reports.pdfViews.include.footer',['name'=>'Vendor Leader Board','page'=>$vendors->currentPage()])

   
 </div>
@endsection