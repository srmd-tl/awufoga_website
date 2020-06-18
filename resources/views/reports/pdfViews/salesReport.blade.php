@extends('layouts.report')
@section('content')
<div class="container" >
  @includeWhen(request()->pdf==true,'reports.pdfViews.include.header',['date'=>\Carbon\Carbon::now()->toDateString(),'name'=>'Sales Report','logo'=>asset('logo.png')])     
    <style>
    th ,td{
     text-align: left;
     font-size: 14px;
    }
  </style>       
  <table  style="
    table-layout: fixed;
    margin: 30px auto !important; width: 100%;border-collapse: collapse;">
    

    <thead class="thead-light" style="background: #e8e8e8;">
       <tr>
          <th >Vendor Name</th>
          <th >Buyer name </th>
          <th >Buyer Mobile No</th>
          <th >Sales Date</th>
          <th >Total Amount</th>
          <th >Cash back %</th>
          <th >Cash back Amount</th>
          <th >Vendor Amount</th>
          <th >AwufOga commission</th>
          <th >Buyer Rating</th>
          <th >Payment Type</th>
       </tr>
    </thead>
    <tbody>

       @forelse($sales as $sale)
       <tr>
          <td >{{$sale->vendor->full_name??''}}</td>
          <td  >{{$sale->buyer->full_name??''}}</td>
          <td  >{{$sale->buyer->phone??''}}</td>
          <td  >{{$sale->created_at->toDateString()}}</td>
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
    @includeWhen(request()->pdf==true,'reports.pdfViews.include.footer',['name'=>'Sales Report','page'=>$sales->currentPage()])
</div>

@endsection