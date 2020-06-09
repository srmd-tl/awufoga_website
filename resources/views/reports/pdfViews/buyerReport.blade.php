@extends('layouts.report')
@section('content')
<div class="container" >
  <h2 style="margin-top: 20px !important">Buyer Report</h2>
  <p>Report About Buyer</p>            
  <table  style="
    table-layout: fixed;
    margin: 30px auto !important; width: 100%;border-collapse: collapse;">
    

    <thead class="thead-light" style="background: #e8e8e8;">
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
                           
      
       </tr>
       @empty
       <tr>
          <td>Nothing Found!</td>
       </tr>
       @endforelse
    </tbody>

  </table>
</div>

@endsection