@extends('layouts.report')
@section('content')
<div class="container" >
  @includeWhen(request()->pdf==true,'reports.pdfViews.include.header',['date'=>\Carbon\Carbon::now()->toDateString(),'name'=>'Buyer Leader Board','logo'=>asset('logo.png')])      
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
             <th >Sl.No.</th>
             <th >Full Name</th>
             <th >Mobile</th>
             <th >Member Since</th>
             <th >City</th>

             <th >Purchase Count</th>
             <th >Purchase Amount</th>
             <th >Wallet points </th>
             <th >Fav Coupons</th>

             <th > Most Purchase in Category</th>
             <th > Most Purchase in Sub Category</th>
  
   
       </tr>
    </thead>
    <tbody>

        @forelse($buyers as $buyer)
        <tr>
           <td class="viewVendor" data-image="{{$buyer->image}}">{{$loop->iteration}}</td>
           <td ><a >{{$buyer->full_name}}</a></td>
           <td >{{$buyer->phone}}</td>
           <td >{{$buyer->created_at->toDateString()}}</td>
           <td >N/A</td>
          
           <td >{{$buyer->usedCoupons->count()}}</td>
           <td >{{$buyer->usedCoupons->sum('paid_price')}}</td>
           <td >{{$buyer->usedCoupons->sum('payment_wallet')}}</td>
           <td >{{$buyer->favCoupons->count()}}</td>
           <td >
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
  @includeWhen(request()->pdf==true,'reports.pdfViews.include.footer',['name'=>'Buyer Leader Board','page'=>$buyers->currentPage()])
  </table>
</div>

@endsection