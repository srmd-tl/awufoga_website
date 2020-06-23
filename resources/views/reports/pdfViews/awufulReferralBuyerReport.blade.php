@extends('layouts.report')
@section('content')
<div class="container" >
  @includeWhen(request()->pdf==true,'reports.pdfViews.include.header',['date'=>\Carbon\Carbon::now()->toDateString(),'name'=>'
Awuf Referral Buyer Report
','logo'=>asset('logo.png')])   
    <style>
    th{
      background: #e2e2e2;
    }
    th ,td{
     text-align: left;
     font-size: 14px;
     border-bottom: 1px solid #e2e2e2;
    }
    table {
      border: 1px solid #e2e2e2;
    }
 
  </style>              
  <table  style="
    margin: 30px auto !important; width: 100%;border-collapse: collapse;">
  <thead class="thead-light">
       <tr>
          <th >Sl No</th>
          <th >Buyer Name</th>
          <th >Buyer  mobile</th>
          <th >Total No Refferal</th>
          <th >Referral Sale Amount</th>
          <th >Earned From Referral</th>
       
      </tr>
    </thead>

     <tbody>

        @forelse($buyers as $buyer)
        <tr>
           <td  ><a >{{$loop->iteration}}</a></td>
           <td  ><a >{{$buyer->full_name}}</a></td>
           <td >{{$buyer->mobile}}</td>
           <td >{{$buyer->phone}}</td>
           <td >{{$buyer->created_at->toDateString()}}</td>
          
           <td>{{$buyer->referrals[0]->earnedFromReferral}}</td>
        </tr>
        @empty
        <tr>
           <td >Nothing Found!</td>
        </tr>
        @endforelse
     </tbody>
   </table>
      @includeWhen(request()->pdf==true,'reports.pdfViews.include.footer',['name'=>'
Awuf Referral Buyer Report
','page'=>$buyers->currentPage()])
 </div>
@endsection