@extends('layouts.report')
@section('content')
<div class="container" >
  @includeWhen(request()->pdf==true,'reports.pdfViews.include.header',['date'=>\Carbon\Carbon::now()->toDateString(),'name'=>'Awuf Referral Vendor Report','logo'=>asset('logo.png')]) 
  <style>
    th ,td{
     text-align: left;
     font-size: 14px;
    }
  </style>    
  <table  style="
    margin: 30px auto !important; width: 100%;border-collapse: collapse;">

     <thead class="thead-light">
                        <tr>
                            <th>Sl No</th>
                            <th>Vendor Name</th>
                            <th>Vendor  mobile</th>
                            <th>Total No Refferal</th>
                            <th>Referral Sale Amount</th>
                            <th>Earned From Referral</th>
                        </tr>
                    </thead>
                     <tbody>

                        @forelse($vendors as $vendor)
                        <tr>
                           <td >{{$loop->iteration}}</td>
                           <td  >{{$vendor->full_name}}</td>
                           <td>{{$vendor->mobile}}</td>
                           <td>{{$vendor->phone}}</td>
                           <td>{{$vendor->created_at}}</td>
                          
                           <td>{{$vendor->referrals[0]->earnedFromReferral}}</td>
                      
                   
                        </tr>
                        @empty
                        <tr>
                           <td>Nothing Found!</td>
                        </tr>
                        @endforelse
                     </tbody>
                 </table>
      @includeWhen(request()->pdf==true,'reports.pdfViews.include.footer',['name'=>'Awuf Referral Vendor Report','page'=>$vendors->currentPage()])
             </div>
             @endsection