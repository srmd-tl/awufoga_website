@extends('layouts.report')
@section('content')
<div class="container" >
  <h2 style="margin-top: 20px !important">Awuful Referral VendorReport Report</h2>
  <p>Awuful Referral VendorReport</p>            
  <table  style="
    table-layout: fixed;
    margin: 30px auto !important; width: 100%;border-collapse: collapse;">

     <thead class="thead-light">
                        <tr>
                            <th scope="col">Sl No</th>
                            <th scope="col">Vendor Name</th>
                            <th scope="col">Vendor  mobile</th>
                            <th scope="col">Total No Refferal</th>
                            <th scope="col">Referral Sale Amount</th>
                            <th scope="col">Earned From Referral</th>
                        </tr>
                    </thead>
                     <tbody>

                        @forelse($vendors as $vendor)
                        <tr>
                           <td ><a >{{$vendor->id}}</a></td>
                           <td  ><a >{{$vendor->full_name}}</a></td>
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
             </div>
             @endsection