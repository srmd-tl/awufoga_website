@extends('layouts.report')
@section('content')
<div class="container" >
  @includeWhen(request()->pdf==true,'reports.pdfViews.include.header',['date'=>\Carbon\Carbon::now()->toDateString(),'name'=>'
Awuf Referral Buyer Report
','logo'=>asset('logo.png')])             
  <table  style="
    margin: 30px auto !important; width: 100%;border-collapse: collapse;">
  <thead class="thead-light">
       <tr>
          <th scope="col" style="padding: 3px 25px !important;">Sl No</th>
          <th scope="col" style="padding: 3px 25px !important;">Buyer Name</th>
          <th scope="col" style="padding: 3px 25px !important;">Buyer  mobile</th>
          <th scope="col" style="padding: 3px 25px !important;">Total No Refferal</th>
          <th scope="col" style="padding: 3px 25px !important;">Referral Sale Amount</th>
          <th scope="col" style="padding: 3px 25px !important;">Earned From Referral</th>
          <th>Referral Details</th>
      </tr>
    </thead>

     <tbody>

        @forelse($buyers as $buyer)
        <tr>
           <td  style="padding: 3px 25px !important;"><a >{{$loop->iteration}}</a></td>
           <td  ><a >{{$buyer->full_name}}</a></td>
           <td style="padding: 3px 25px !important;">{{$buyer->mobile}}</td>
           <td style="padding: 3px 25px !important;">{{$buyer->phone}}</td>
           <td style="padding: 3px 25px !important;">{{$buyer->created_at}}</td>
          
           <td>{{$buyer->referrals[0]->earnedFromReferral}}</td>
        </tr>
        @empty
        <tr>
           <td style="padding: 3px 25px !important;">Nothing Found!</td>
        </tr>
        @endforelse
     </tbody>
   </table>
      @includeWhen(request()->pdf==true,'reports.pdfViews.include.footer',['name'=>'
Awuf Referral Buyer Report
','page'=>$buyers->currentPage()])
 </div>
@endsection