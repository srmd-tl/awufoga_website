<!DOCTYPE html>
<html lang="en" style=" margin: 15px 0px 0px 0px !important;">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href = "{{asset('argon/css/reports.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
</head>
<body style="margin: 15px 0px 0px 0px !important;">

<div class="container" >
  <h2 style="margin-top: 20px !important">Basic Table</h2>
  <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>            
  <table class="table" style="
    table-layout: fixed;
    margin: 30px auto !important;">
    
    <thead class="thead-light">
       <tr>
          <th scope="col" style="
           font-size: 12px !important;">Vendor Name</th>
          <th scope="col" style="
           font-size: 12px !important;">Buyer name </th>
          <th scope="col" style="
           font-size: 12px !important;">Buyer Mobile No</th>
          <th scope="col" style="
           font-size: 12px !important;">Sales Date</th>
          <th scope="col" style="
           font-size: 12px !important;">Total Amount</th>
          <th scope="col" style="
           font-size: 12px !important;">Cash back %</th>
          <th scope="col" style="
           font-size: 12px !important;">Cash back Amount</th>
          <th scope="col" style="
           font-size: 12px !important;">Vendor Amount</th>
          <th scope="col" style="
           font-size: 12px !important;">AwufOga commission</th>
          <th scope="col" style="
           font-size: 12px !important;">Buyer Rating</th>
          <th scope="col" style="
           font-size: 12px !important;">Payment Type</th>
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
                $data = $sale->coupon->singleCouponRating($sale->buyer->id??1);
             
                if($data)
                {
                   $data = $data->pivot->rating;
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

</body>
</html>