@extends('layouts.report')
@section('content')
<div class="container" >
  <h2 style="margin-top: 20px !important">Basic Table</h2>
  <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>            
  <table  style="
    table-layout: fixed;
    margin: 30px auto !important; width: 100%;border-collapse: collapse;">
    

    <thead class="thead-light" style="background: #e8e8e8;">
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
       </tr>
    </thead>
    <tbody>

       @forelse($sales as $sale)
       <tr>
          <td >{{$sale->vendor->full_name??''}}</td>
          <td  >{{$sale->buyer->full_name??''}}</td>
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

  </table>
</div>

@endsection