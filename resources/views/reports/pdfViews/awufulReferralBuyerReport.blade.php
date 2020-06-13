@extends('layouts.report')
@section('content')
<div class="container" >
  <h2 style="margin-top: 20px !important">Awuful Referral Buyer Report</h2>
  <p>Awuful Referral Buyer Report</p>            
  <table  style="
    table-layout: fixed;
    margin: 30px auto !important; width: 100%;border-collapse: collapse;">
  <thead class="thead-light">
       <tr>
          <th scope="col">Sl No</th>
          <th scope="col">Buyer Name</th>
          <th scope="col">Buyer  mobile</th>
          <th scope="col">Total No Refferal</th>
          <th scope="col">Referral Sale Amount</th>
          <th scope="col">Earned From Referral</th>
          <th>Referral Details</th>
      </tr>
    </thead>

     <tbody>

        @forelse($buyers as $buyer)
        <tr>
           <td ><a >{{$loop->iteration}}</a></td>
           <td  ><a >{{$buyer->full_name}}</a></td>
           <td>{{$buyer->mobile}}</td>
           <td>{{$buyer->phone}}</td>
           <td>{{$buyer->created_at}}</td>
          
           <td>{{$buyer->referrals[0]->earnedFromReferral}}</td>
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