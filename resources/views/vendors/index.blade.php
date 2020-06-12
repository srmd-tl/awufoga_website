@extends('layouts.app')
@section('content')

@include('layouts.headers.cards')
<div class="container-fluid mt--7">
   @include('alerts.alert')
   <div class="row">
      <div class="col">
         <div class="card shadow">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col-12">
                     <div class="categories-detail">
                        <h3 class="mb-0">Vendors</h3>
                        <div class="btn_style1">
                           <a href="{{route('vendor.index')}}" class="btn btn-sm btn-primary">Clear Search</a>
                           
                           <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-form">Add Vendor</a>
                           
                        </div>
                     </div>
                  </div>
                  <div class="col-12">
                     <div class="Search_item">
                          <!-- <form method="GET" action="{{route('vendor.index')}}" class="mr-2">
                           <div class="form-group">
                                 <button value="1" class="btn btn-sm btn-primary" name="statusFilter">Active Search</button>
                                 <button value="0" class="btn btn-sm btn-primary" name="statusFilter">Inactive Search</button>
                           </div>
                           </form> -->
                        <form action="{{route('vendor.index')}}">
                           <div class="select_option">
                              <select name="statusFilter">
                                 <option {{request()->statusFilter=='1'?'selected':''}} value="1">Active</option>
                                 <option {{request()->statusFilter=='0'?'selected':''}} value="0">Inactive</option>
                              </select>
                           </div>
                           <div class="form-group">
                               <div class="input-group">
                                 <div class="input-group-prepend">
                                   <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                 </div>
                                 
                                <!--  @if(isset(request()->statusFilter))
                                 <input type="hidden" name="statusFilter" value="{{request()->statusFilter}}">
                                 @endif -->
                                 <input class="form-control" placeholder="Search" type="text" name="filter" value="{{request()->filter}}">

                               
                               </div>
                               <button class="btn btn-sm btn-primary" >Search</button>
                           </div>
                        </form>

                     </div>
                     
                  </div>
               </div>
            </div>
        
            
            <div class="table_design">
               <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                     <thead class="thead-light">
                        <tr>
                           <th scope="col">Full Name</th>
                           <th scope="col">Username</th>
                           <th scope="col">Email</th>
                           <th scope="col">Phone</th>
                           <th scope="col">Status</th>
                           <th scope="col">Created At</th>
                           <th scope="col">Notification</th>
                           <th scope="col"></th>
                        </tr>
                     </thead>
                     <tbody>

                        @forelse($vendors as $vendor)
                        <tr>
                           <td class="viewVendor" data-image="{{$vendor->image}}" ><a >{{$vendor->full_name}}</a></td>
                           <td>{{$vendor->user_name}}</td>
                           <td>{{$vendor->email}}</td>
                           <td>{{$vendor->full_phone}}</td>
                           <td>
                              <span class="badge badge-{{$vendor->status==1?'success':'danger'}}">{{$vendor->status==1?'Active':'Inactive'}}</span>
                           </td>
                           <td>{{$vendor->created_at}}</td>
                             <td>
                              <span class="badge badge-{{$vendor->notification_on_off==1?'success':'danger'}}">{{$vendor->notification_on_off==1?'On':'Off'}}</span>
                           </td>
                     
                           <td class="text-right">
                              <div class="dropdown">
                                 <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis-v"></i>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                 
                                    <button class="dropdown-item editVendor" 
                                    data-id="{{$vendor->id}}" 
                                    data-username="{{$vendor->user_name}}" 
                                    data-fullname="{{$vendor->full_name}}" 
                                    data-email="{{$vendor->email}}" 
                                    data-countrycode="{{$vendor->country_code}}" 
                                    data-phone="{{$vendor->phone}}" 
                                    data-businessname="{{$vendor->business_name}}" 
                                    data-businessemail="{{$vendor->business_email}}" 
                                    data-businesscountrycode="{{$vendor->business_country_code}}" 
                                    data-businessphone="{{$vendor->business_phone}}" 
                                    data-businesswebsite="{{$vendor->website}}" 
                                    data-businessaddress="{{$vendor->address}}" 
                                    data-longitude="{{$vendor->longitude}}" 
                                    data-latitude="{{$vendor->latitude}}" 
                                    data-correctaddress="{{$vendor->correct_address}}" 
                                    data-rate="{{$vendor->rate}}" 
                                    data-reviewcount="{{$vendor->review_count}}" 
                                    data-firstreferral="{{$vendor->first_referral}}" 
                                    data-notification="{{$vendor->notification_on_off}}" 
                                    data-image="{{$vendor->image}}" 
                                    data-status="{{$vendor->status}}" 
                                    >Edit</button>
                                    <button class="dropdown-item deleteVendor" data-id="{{$vendor->id}}" >Delete</button>
                                 </div>
                              </div>
                           </td>
                        </tr>
                        @empty
                        <tr>
                           <td>Nothing Found!</td>
                        </tr>
                        @endforelse
                     </tbody>
                     <tfoot>
                        <tr>
                           <td>{{$vendors->withQueryString()->links()}}</td>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
            <div class="card-footer py-4">
               <nav class="d-flex justify-content-end" aria-label="...">
               </nav>
            </div>
         </div>
      </div>
   </div>
   <!-- Add ADmin Modal -->
   <div class="col-md-4">
      <div class="modal fade addModel lg_modal" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Add new vendor</small>
                        </div>
                        <form role="form" method="POST" action="{{route('vendor.store')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="row">
                              <div class="col-md-4">  
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Username</label>
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Username" type="text" name="username">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Full Name</label>
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Full Name" type="text" name="fullname">
                                    </div>
                                 </div>
                              </div>
                                 <div class="col-md-4"> 
                             
                                   <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Email</label>
                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Email" type="text" name="email">
                                    </div>
                                 </div>
                              </div>

                           </div>
                           <div class="row">
                            
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Country Code</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                       </div>
                                       <!-- country codes (ISO 3166) and Dial codes. -->
                                       <select name="country_code" id="" class="form-control">
                                          <option data-countryCode="GB" value="44" Selected>UK (+44)</option>
                                          <option data-countryCode="US" value="1">USA (+1)</option>
                                         
                                             <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                             <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                             <option data-countryCode="AO" value="244">Angola (+244)</option>
                                             <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                                             <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                                             <option data-countryCode="AR" value="54">Argentina (+54)</option>
                                             <option data-countryCode="AM" value="374">Armenia (+374)</option>
                                             <option data-countryCode="AW" value="297">Aruba (+297)</option>
                                             <option data-countryCode="AU" value="61">Australia (+61)</option>
                                             <option data-countryCode="AT" value="43">Austria (+43)</option>
                                             <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                                             <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                                             <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                                             <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                             <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                                             <option data-countryCode="BY" value="375">Belarus (+375)</option>
                                             <option data-countryCode="BE" value="32">Belgium (+32)</option>
                                             <option data-countryCode="BZ" value="501">Belize (+501)</option>
                                             <option data-countryCode="BJ" value="229">Benin (+229)</option>
                                             <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                                             <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                                             <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                                             <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                             <option data-countryCode="BW" value="267">Botswana (+267)</option>
                                             <option data-countryCode="BR" value="55">Brazil (+55)</option>
                                             <option data-countryCode="BN" value="673">Brunei (+673)</option>
                                             <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                                             <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                                             <option data-countryCode="BI" value="257">Burundi (+257)</option>
                                             <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                                             <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                                             <option data-countryCode="CA" value="1">Canada (+1)</option>
                                             <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                                             <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                                             <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                                             <option data-countryCode="CL" value="56">Chile (+56)</option>
                                             <option data-countryCode="CN" value="86">China (+86)</option>
                                             <option data-countryCode="CO" value="57">Colombia (+57)</option>
                                             <option data-countryCode="KM" value="269">Comoros (+269)</option>
                                             <option data-countryCode="CG" value="242">Congo (+242)</option>
                                             <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                                             <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                                             <option data-countryCode="HR" value="385">Croatia (+385)</option>
                                             <option data-countryCode="CU" value="53">Cuba (+53)</option>
                                             <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                                             <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                                             <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                                             <option data-countryCode="DK" value="45">Denmark (+45)</option>
                                             <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                                             <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                                             <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                                             <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                                             <option data-countryCode="EG" value="20">Egypt (+20)</option>
                                             <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                                             <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                                             <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                                             <option data-countryCode="EE" value="372">Estonia (+372)</option>
                                             <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                                             <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                                             <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                                             <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                                             <option data-countryCode="FI" value="358">Finland (+358)</option>
                                             <option data-countryCode="FR" value="33">France (+33)</option>
                                             <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                                             <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                                             <option data-countryCode="GA" value="241">Gabon (+241)</option>
                                             <option data-countryCode="GM" value="220">Gambia (+220)</option>
                                             <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                                             <option data-countryCode="DE" value="49">Germany (+49)</option>
                                             <option data-countryCode="GH" value="233">Ghana (+233)</option>
                                             <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                                             <option data-countryCode="GR" value="30">Greece (+30)</option>
                                             <option data-countryCode="GL" value="299">Greenland (+299)</option>
                                             <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                                             <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                                             <option data-countryCode="GU" value="671">Guam (+671)</option>
                                             <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                                             <option data-countryCode="GN" value="224">Guinea (+224)</option>
                                             <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                                             <option data-countryCode="GY" value="592">Guyana (+592)</option>
                                             <option data-countryCode="HT" value="509">Haiti (+509)</option>
                                             <option data-countryCode="HN" value="504">Honduras (+504)</option>
                                             <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                                             <option data-countryCode="HU" value="36">Hungary (+36)</option>
                                             <option data-countryCode="IS" value="354">Iceland (+354)</option>
                                             <option data-countryCode="IN" value="91">India (+91)</option>
                                             <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                                             <option data-countryCode="IR" value="98">Iran (+98)</option>
                                             <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                                             <option data-countryCode="IE" value="353">Ireland (+353)</option>
                                             <option data-countryCode="IL" value="972">Israel (+972)</option>
                                             <option data-countryCode="IT" value="39">Italy (+39)</option>
                                             <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                                             <option data-countryCode="JP" value="81">Japan (+81)</option>
                                             <option data-countryCode="JO" value="962">Jordan (+962)</option>
                                             <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                                             <option data-countryCode="KE" value="254">Kenya (+254)</option>
                                             <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                                             <option data-countryCode="KP" value="850">Korea North (+850)</option>
                                             <option data-countryCode="KR" value="82">Korea South (+82)</option>
                                             <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                                             <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                                             <option data-countryCode="LA" value="856">Laos (+856)</option>
                                             <option data-countryCode="LV" value="371">Latvia (+371)</option>
                                             <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                                             <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                                             <option data-countryCode="LR" value="231">Liberia (+231)</option>
                                             <option data-countryCode="LY" value="218">Libya (+218)</option>
                                             <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                                             <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                                             <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                                             <option data-countryCode="MO" value="853">Macao (+853)</option>
                                             <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                             <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                                             <option data-countryCode="MW" value="265">Malawi (+265)</option>
                                             <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                                             <option data-countryCode="MV" value="960">Maldives (+960)</option>
                                             <option data-countryCode="ML" value="223">Mali (+223)</option>
                                             <option data-countryCode="MT" value="356">Malta (+356)</option>
                                             <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                                             <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                                             <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                                             <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                                             <option data-countryCode="MX" value="52">Mexico (+52)</option>
                                             <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                                             <option data-countryCode="MD" value="373">Moldova (+373)</option>
                                             <option data-countryCode="MC" value="377">Monaco (+377)</option>
                                             <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                                             <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                                             <option data-countryCode="MA" value="212">Morocco (+212)</option>
                                             <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                                             <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                                             <option data-countryCode="NA" value="264">Namibia (+264)</option>
                                             <option data-countryCode="NR" value="674">Nauru (+674)</option>
                                             <option data-countryCode="NP" value="977">Nepal (+977)</option>
                                             <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                                             <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                                             <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                                             <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                                             <option data-countryCode="NE" value="227">Niger (+227)</option>
                                             <option selected data-countryCode="NG" value="234">Nigeria (+234)</option>
                                             <option data-countryCode="NU" value="683">Niue (+683)</option>
                                             <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                                             <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                                             <option data-countryCode="NO" value="47">Norway (+47)</option>
                                             <option data-countryCode="OM" value="968">Oman (+968)</option>
                                             <option data-countryCode="PK" value="92">Pakistan (+92)</option>
                                             <option data-countryCode="PW" value="680">Palau (+680)</option>
                                             <option data-countryCode="PA" value="507">Panama (+507)</option>
                                             <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                                             <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                                             <option data-countryCode="PE" value="51">Peru (+51)</option>
                                             <option data-countryCode="PH" value="63">Philippines (+63)</option>
                                             <option data-countryCode="PL" value="48">Poland (+48)</option>
                                             <option data-countryCode="PT" value="351">Portugal (+351)</option>
                                             <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                                             <option data-countryCode="QA" value="974">Qatar (+974)</option>
                                             <option data-countryCode="RE" value="262">Reunion (+262)</option>
                                             <option data-countryCode="RO" value="40">Romania (+40)</option>
                                             <option data-countryCode="RU" value="7">Russia (+7)</option>
                                             <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                                             <option data-countryCode="SM" value="378">San Marino (+378)</option>
                                             <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                                             <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                                             <option data-countryCode="SN" value="221">Senegal (+221)</option>
                                             <option data-countryCode="CS" value="381">Serbia (+381)</option>
                                             <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                                             <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                                             <option data-countryCode="SG" value="65">Singapore (+65)</option>
                                             <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                                             <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                                             <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                                             <option data-countryCode="SO" value="252">Somalia (+252)</option>
                                             <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                                             <option data-countryCode="ES" value="34">Spain (+34)</option>
                                             <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                                             <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                                             <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                                             <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                                             <option data-countryCode="SD" value="249">Sudan (+249)</option>
                                             <option data-countryCode="SR" value="597">Suriname (+597)</option>
                                             <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                                             <option data-countryCode="SE" value="46">Sweden (+46)</option>
                                             <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                                             <option data-countryCode="SI" value="963">Syria (+963)</option>
                                             <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                                             <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                                             <option data-countryCode="TH" value="66">Thailand (+66)</option>
                                             <option data-countryCode="TG" value="228">Togo (+228)</option>
                                             <option data-countryCode="TO" value="676">Tonga (+676)</option>
                                             <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                                             <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                                             <option data-countryCode="TR" value="90">Turkey (+90)</option>
                                             <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                                             <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                                             <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                             <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                                             <option data-countryCode="UG" value="256">Uganda (+256)</option>
                                             <!-- <option data-countryCode="GB" value="44">UK (+44)</option> -->
                                             <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                             <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                                             <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                             <!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
                                             <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                                             <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                                             <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                                             <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                                             <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                                             <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
                                             <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                                             <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                                             <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                                             <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                                             <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                                             <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                                       </select>
                                       
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4"> 
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Phone</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Phone" type="text" name="phone">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Password</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Password" type="password" name="password">
                                    </div>
                                 </div>
                              </div>
                           </div>
                          
                          <div class="row">
                              <div class="col-md-4">  
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Business Name</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-building"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Business Name" type="text" name="businessName">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Business Email</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-email"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Business Email" type="text" name="businessEmail">
                                    </div>
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Business Country Code</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                       </div>
                                       <!-- country codes (ISO 3166) and Dial codes. -->
                                       <select name="businessCountryCode" id="" class="form-control">
                                          <option data-countryCode="GB" value="44" Selected>UK (+44)</option>
                                          <option data-countryCode="US" value="1">USA (+1)</option>
                                         
                                             <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                             <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                             <option data-countryCode="AO" value="244">Angola (+244)</option>
                                             <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                                             <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                                             <option data-countryCode="AR" value="54">Argentina (+54)</option>
                                             <option data-countryCode="AM" value="374">Armenia (+374)</option>
                                             <option data-countryCode="AW" value="297">Aruba (+297)</option>
                                             <option data-countryCode="AU" value="61">Australia (+61)</option>
                                             <option data-countryCode="AT" value="43">Austria (+43)</option>
                                             <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                                             <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                                             <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                                             <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                             <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                                             <option data-countryCode="BY" value="375">Belarus (+375)</option>
                                             <option data-countryCode="BE" value="32">Belgium (+32)</option>
                                             <option data-countryCode="BZ" value="501">Belize (+501)</option>
                                             <option data-countryCode="BJ" value="229">Benin (+229)</option>
                                             <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                                             <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                                             <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                                             <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                             <option data-countryCode="BW" value="267">Botswana (+267)</option>
                                             <option data-countryCode="BR" value="55">Brazil (+55)</option>
                                             <option data-countryCode="BN" value="673">Brunei (+673)</option>
                                             <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                                             <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                                             <option data-countryCode="BI" value="257">Burundi (+257)</option>
                                             <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                                             <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                                             <option data-countryCode="CA" value="1">Canada (+1)</option>
                                             <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                                             <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                                             <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                                             <option data-countryCode="CL" value="56">Chile (+56)</option>
                                             <option data-countryCode="CN" value="86">China (+86)</option>
                                             <option data-countryCode="CO" value="57">Colombia (+57)</option>
                                             <option data-countryCode="KM" value="269">Comoros (+269)</option>
                                             <option data-countryCode="CG" value="242">Congo (+242)</option>
                                             <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                                             <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                                             <option data-countryCode="HR" value="385">Croatia (+385)</option>
                                             <option data-countryCode="CU" value="53">Cuba (+53)</option>
                                             <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                                             <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                                             <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                                             <option data-countryCode="DK" value="45">Denmark (+45)</option>
                                             <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                                             <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                                             <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                                             <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                                             <option data-countryCode="EG" value="20">Egypt (+20)</option>
                                             <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                                             <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                                             <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                                             <option data-countryCode="EE" value="372">Estonia (+372)</option>
                                             <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                                             <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                                             <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                                             <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                                             <option data-countryCode="FI" value="358">Finland (+358)</option>
                                             <option data-countryCode="FR" value="33">France (+33)</option>
                                             <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                                             <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                                             <option data-countryCode="GA" value="241">Gabon (+241)</option>
                                             <option data-countryCode="GM" value="220">Gambia (+220)</option>
                                             <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                                             <option data-countryCode="DE" value="49">Germany (+49)</option>
                                             <option data-countryCode="GH" value="233">Ghana (+233)</option>
                                             <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                                             <option data-countryCode="GR" value="30">Greece (+30)</option>
                                             <option data-countryCode="GL" value="299">Greenland (+299)</option>
                                             <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                                             <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                                             <option data-countryCode="GU" value="671">Guam (+671)</option>
                                             <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                                             <option data-countryCode="GN" value="224">Guinea (+224)</option>
                                             <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                                             <option data-countryCode="GY" value="592">Guyana (+592)</option>
                                             <option data-countryCode="HT" value="509">Haiti (+509)</option>
                                             <option data-countryCode="HN" value="504">Honduras (+504)</option>
                                             <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                                             <option data-countryCode="HU" value="36">Hungary (+36)</option>
                                             <option data-countryCode="IS" value="354">Iceland (+354)</option>
                                             <option data-countryCode="IN" value="91">India (+91)</option>
                                             <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                                             <option data-countryCode="IR" value="98">Iran (+98)</option>
                                             <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                                             <option data-countryCode="IE" value="353">Ireland (+353)</option>
                                             <option data-countryCode="IL" value="972">Israel (+972)</option>
                                             <option data-countryCode="IT" value="39">Italy (+39)</option>
                                             <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                                             <option data-countryCode="JP" value="81">Japan (+81)</option>
                                             <option data-countryCode="JO" value="962">Jordan (+962)</option>
                                             <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                                             <option data-countryCode="KE" value="254">Kenya (+254)</option>
                                             <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                                             <option data-countryCode="KP" value="850">Korea North (+850)</option>
                                             <option data-countryCode="KR" value="82">Korea South (+82)</option>
                                             <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                                             <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                                             <option data-countryCode="LA" value="856">Laos (+856)</option>
                                             <option data-countryCode="LV" value="371">Latvia (+371)</option>
                                             <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                                             <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                                             <option data-countryCode="LR" value="231">Liberia (+231)</option>
                                             <option data-countryCode="LY" value="218">Libya (+218)</option>
                                             <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                                             <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                                             <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                                             <option data-countryCode="MO" value="853">Macao (+853)</option>
                                             <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                             <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                                             <option data-countryCode="MW" value="265">Malawi (+265)</option>
                                             <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                                             <option data-countryCode="MV" value="960">Maldives (+960)</option>
                                             <option data-countryCode="ML" value="223">Mali (+223)</option>
                                             <option data-countryCode="MT" value="356">Malta (+356)</option>
                                             <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                                             <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                                             <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                                             <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                                             <option data-countryCode="MX" value="52">Mexico (+52)</option>
                                             <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                                             <option data-countryCode="MD" value="373">Moldova (+373)</option>
                                             <option data-countryCode="MC" value="377">Monaco (+377)</option>
                                             <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                                             <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                                             <option data-countryCode="MA" value="212">Morocco (+212)</option>
                                             <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                                             <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                                             <option data-countryCode="NA" value="264">Namibia (+264)</option>
                                             <option data-countryCode="NR" value="674">Nauru (+674)</option>
                                             <option data-countryCode="NP" value="977">Nepal (+977)</option>
                                             <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                                             <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                                             <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                                             <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                                             <option data-countryCode="NE" value="227">Niger (+227)</option>
                                             <option selected="" data-countryCode="NG" value="234">Nigeria (+234)</option>
                                             <option data-countryCode="NU" value="683">Niue (+683)</option>
                                             <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                                             <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                                             <option data-countryCode="NO" value="47">Norway (+47)</option>
                                             <option data-countryCode="OM" value="968">Oman (+968)</option>
                                             <option data-countryCode="PK value="92">Pakistan (+92)</option>
                                             <option data-countryCode="PW" value="680">Palau (+680)</option>
                                             <option data-countryCode="PA" value="507">Panama (+507)</option>
                                             <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                                             <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                                             <option data-countryCode="PE" value="51">Peru (+51)</option>
                                             <option data-countryCode="PH" value="63">Philippines (+63)</option>
                                             <option data-countryCode="PL" value="48">Poland (+48)</option>
                                             <option data-countryCode="PT" value="351">Portugal (+351)</option>
                                             <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                                             <option data-countryCode="QA" value="974">Qatar (+974)</option>
                                             <option data-countryCode="RE" value="262">Reunion (+262)</option>
                                             <option data-countryCode="RO" value="40">Romania (+40)</option>
                                             <option data-countryCode="RU" value="7">Russia (+7)</option>
                                             <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                                             <option data-countryCode="SM" value="378">San Marino (+378)</option>
                                             <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                                             <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                                             <option data-countryCode="SN" value="221">Senegal (+221)</option>
                                             <option data-countryCode="CS" value="381">Serbia (+381)</option>
                                             <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                                             <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                                             <option data-countryCode="SG" value="65">Singapore (+65)</option>
                                             <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                                             <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                                             <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                                             <option data-countryCode="SO" value="252">Somalia (+252)</option>
                                             <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                                             <option data-countryCode="ES" value="34">Spain (+34)</option>
                                             <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                                             <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                                             <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                                             <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                                             <option data-countryCode="SD" value="249">Sudan (+249)</option>
                                             <option data-countryCode="SR" value="597">Suriname (+597)</option>
                                             <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                                             <option data-countryCode="SE" value="46">Sweden (+46)</option>
                                             <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                                             <option data-countryCode="SI" value="963">Syria (+963)</option>
                                             <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                                             <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                                             <option data-countryCode="TH" value="66">Thailand (+66)</option>
                                             <option data-countryCode="TG" value="228">Togo (+228)</option>
                                             <option data-countryCode="TO" value="676">Tonga (+676)</option>
                                             <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                                             <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                                             <option data-countryCode="TR" value="90">Turkey (+90)</option>
                                             <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                                             <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                                             <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                             <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                                             <option data-countryCode="UG" value="256">Uganda (+256)</option>
                                             <!-- <option data-countryCode="GB" value="44">UK (+44)</option> -->
                                             <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                             <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                                             <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                             <!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
                                             <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                                             <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                                             <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                                             <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                                             <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                                             <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
                                             <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                                             <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                                             <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                                             <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                                             <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                                             <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                                       </select>
                                       
                                    </div>
                                 </div>
                              </div>

                           </div>
                           <div class="row">
                            
                              <div class="col-md-4"> 
                             
                                   <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Business Phone</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Business Phone" type="text" name="businessPhone">
                                    </div>
                                 </div>
                              </div>
                         
                              <div class="col-md-4"> 
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Website</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-globe"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Website" type="text" name="website">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Address</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Address" type="text" name="address">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-4"> 
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Longitude</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Longitude" type="text" name="longitude">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Latitude</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Latitude" type="text" name="latitude">
                                    </div>
                                 </div>
                              </div>
                               <div class="col-md-4"> 
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Correct Address</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Correct Address" type="text" name="correctAddress">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                             
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Rate</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-star-half"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Rate" type="text" name="rate">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4"> 
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Review Count</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-calculator"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Review Count" type="text" name="reviewCount">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">First Referral</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-users"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor First Referral" type="text" name="firstReferral">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           
                           <div class="row">
                        
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label" for="input-username">Status</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-toggle-off"></i></span>
                                       </div>
                                       <select class="form-control" name="status"> 
                                          <option value="1">Active</option>
                                          <option value="0">Inactive</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                    <label class="form-control-label" for="input-username">Notification</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-send"></i></span>
                                       </div>
                                       <select class="form-control" name="notification"> 
                                          <option value="1">On</option>
                                          <option value="0">Off</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                    
                              <div class="col-md-4"> 
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Image</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                
                                       <input class="form-control" placeholder="File" type="file" name="image">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="text-center">
                              <button type="submit" class="btn btn-primary my-4">Add Vendor</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End Add ADmin Modal -->
  <!-- Edit ADmin Modal -->
   <div class="col-md-4">
      <div class="modal fade addModel" id="edit-vendor-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Edit Vendor</small>
                        </div>
                        <form role="form" method="POST" id="editForm"  enctype="multipart/form-data">
                           @csrf
                           @method('PUT')
                           <div class="row">
                              <div class="col-md-4">
                                 
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Username</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Username" type="text" name="username" id="editUsername">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Full Name</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Full Name" type="text" name="fullname" id="editFullname">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Email</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Email" type="text" name="email" id="editEmail">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                         
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Country Code</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                       </div>
                                       <select name="country_code" class="form-control" id="editCountryCode">
                                          <option data-countryCode="GB" value="44" Selected>UK (+44)</option>
                                          <option data-countryCode="US" value="1">USA (+1)</option>
                                         
                                             <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                             <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                             <option data-countryCode="AO" value="244">Angola (+244)</option>
                                             <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                                             <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                                             <option data-countryCode="AR" value="54">Argentina (+54)</option>
                                             <option data-countryCode="AM" value="374">Armenia (+374)</option>
                                             <option data-countryCode="AW" value="297">Aruba (+297)</option>
                                             <option data-countryCode="AU" value="61">Australia (+61)</option>
                                             <option data-countryCode="AT" value="43">Austria (+43)</option>
                                             <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                                             <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                                             <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                                             <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                             <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                                             <option data-countryCode="BY" value="375">Belarus (+375)</option>
                                             <option data-countryCode="BE" value="32">Belgium (+32)</option>
                                             <option data-countryCode="BZ" value="501">Belize (+501)</option>
                                             <option data-countryCode="BJ" value="229">Benin (+229)</option>
                                             <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                                             <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                                             <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                                             <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                             <option data-countryCode="BW" value="267">Botswana (+267)</option>
                                             <option data-countryCode="BR" value="55">Brazil (+55)</option>
                                             <option data-countryCode="BN" value="673">Brunei (+673)</option>
                                             <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                                             <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                                             <option data-countryCode="BI" value="257">Burundi (+257)</option>
                                             <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                                             <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                                             <option data-countryCode="CA" value="1">Canada (+1)</option>
                                             <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                                             <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                                             <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                                             <option data-countryCode="CL" value="56">Chile (+56)</option>
                                             <option data-countryCode="CN" value="86">China (+86)</option>
                                             <option data-countryCode="CO" value="57">Colombia (+57)</option>
                                             <option data-countryCode="KM" value="269">Comoros (+269)</option>
                                             <option data-countryCode="CG" value="242">Congo (+242)</option>
                                             <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                                             <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                                             <option data-countryCode="HR" value="385">Croatia (+385)</option>
                                             <option data-countryCode="CU" value="53">Cuba (+53)</option>
                                             <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                                             <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                                             <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                                             <option data-countryCode="DK" value="45">Denmark (+45)</option>
                                             <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                                             <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                                             <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                                             <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                                             <option data-countryCode="EG" value="20">Egypt (+20)</option>
                                             <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                                             <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                                             <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                                             <option data-countryCode="EE" value="372">Estonia (+372)</option>
                                             <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                                             <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                                             <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                                             <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                                             <option data-countryCode="FI" value="358">Finland (+358)</option>
                                             <option data-countryCode="FR" value="33">France (+33)</option>
                                             <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                                             <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                                             <option data-countryCode="GA" value="241">Gabon (+241)</option>
                                             <option data-countryCode="GM" value="220">Gambia (+220)</option>
                                             <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                                             <option data-countryCode="DE" value="49">Germany (+49)</option>
                                             <option data-countryCode="GH" value="233">Ghana (+233)</option>
                                             <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                                             <option data-countryCode="GR" value="30">Greece (+30)</option>
                                             <option data-countryCode="GL" value="299">Greenland (+299)</option>
                                             <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                                             <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                                             <option data-countryCode="GU" value="671">Guam (+671)</option>
                                             <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                                             <option data-countryCode="GN" value="224">Guinea (+224)</option>
                                             <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                                             <option data-countryCode="GY" value="592">Guyana (+592)</option>
                                             <option data-countryCode="HT" value="509">Haiti (+509)</option>
                                             <option data-countryCode="HN" value="504">Honduras (+504)</option>
                                             <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                                             <option data-countryCode="HU" value="36">Hungary (+36)</option>
                                             <option data-countryCode="IS" value="354">Iceland (+354)</option>
                                             <option data-countryCode="IN" value="91">India (+91)</option>
                                             <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                                             <option data-countryCode="IR" value="98">Iran (+98)</option>
                                             <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                                             <option data-countryCode="IE" value="353">Ireland (+353)</option>
                                             <option data-countryCode="IL" value="972">Israel (+972)</option>
                                             <option data-countryCode="IT" value="39">Italy (+39)</option>
                                             <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                                             <option data-countryCode="JP" value="81">Japan (+81)</option>
                                             <option data-countryCode="JO" value="962">Jordan (+962)</option>
                                             <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                                             <option data-countryCode="KE" value="254">Kenya (+254)</option>
                                             <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                                             <option data-countryCode="KP" value="850">Korea North (+850)</option>
                                             <option data-countryCode="KR" value="82">Korea South (+82)</option>
                                             <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                                             <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                                             <option data-countryCode="LA" value="856">Laos (+856)</option>
                                             <option data-countryCode="LV" value="371">Latvia (+371)</option>
                                             <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                                             <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                                             <option data-countryCode="LR" value="231">Liberia (+231)</option>
                                             <option data-countryCode="LY" value="218">Libya (+218)</option>
                                             <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                                             <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                                             <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                                             <option data-countryCode="MO" value="853">Macao (+853)</option>
                                             <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                             <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                                             <option data-countryCode="MW" value="265">Malawi (+265)</option>
                                             <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                                             <option data-countryCode="MV" value="960">Maldives (+960)</option>
                                             <option data-countryCode="ML" value="223">Mali (+223)</option>
                                             <option data-countryCode="MT" value="356">Malta (+356)</option>
                                             <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                                             <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                                             <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                                             <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                                             <option data-countryCode="MX" value="52">Mexico (+52)</option>
                                             <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                                             <option data-countryCode="MD" value="373">Moldova (+373)</option>
                                             <option data-countryCode="MC" value="377">Monaco (+377)</option>
                                             <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                                             <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                                             <option data-countryCode="MA" value="212">Morocco (+212)</option>
                                             <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                                             <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                                             <option data-countryCode="NA" value="264">Namibia (+264)</option>
                                             <option data-countryCode="NR" value="674">Nauru (+674)</option>
                                             <option data-countryCode="NP" value="977">Nepal (+977)</option>
                                             <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                                             <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                                             <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                                             <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                                             <option data-countryCode="NE" value="227">Niger (+227)</option>
                                             <option selected="" data-countryCode="NG" value="234">Nigeria (+234)</option>
                                             <option data-countryCode="NU" value="683">Niue (+683)</option>
                                             <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                                             <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                                             <option data-countryCode="NO" value="47">Norway (+47)</option>
                                             <option data-countryCode="OM" value="968">Oman (+968)</option>
                                             <option data-countryCode="PK value="92">Pakistan (+92)</option>
                                             <option data-countryCode="PW" value="680">Palau (+680)</option>
                                             <option data-countryCode="PA" value="507">Panama (+507)</option>
                                             <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                                             <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                                             <option data-countryCode="PE" value="51">Peru (+51)</option>
                                             <option data-countryCode="PH" value="63">Philippines (+63)</option>
                                             <option data-countryCode="PL" value="48">Poland (+48)</option>
                                             <option data-countryCode="PT" value="351">Portugal (+351)</option>
                                             <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                                             <option data-countryCode="QA" value="974">Qatar (+974)</option>
                                             <option data-countryCode="RE" value="262">Reunion (+262)</option>
                                             <option data-countryCode="RO" value="40">Romania (+40)</option>
                                             <option data-countryCode="RU" value="7">Russia (+7)</option>
                                             <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                                             <option data-countryCode="SM" value="378">San Marino (+378)</option>
                                             <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                                             <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                                             <option data-countryCode="SN" value="221">Senegal (+221)</option>
                                             <option data-countryCode="CS" value="381">Serbia (+381)</option>
                                             <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                                             <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                                             <option data-countryCode="SG" value="65">Singapore (+65)</option>
                                             <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                                             <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                                             <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                                             <option data-countryCode="SO" value="252">Somalia (+252)</option>
                                             <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                                             <option data-countryCode="ES" value="34">Spain (+34)</option>
                                             <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                                             <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                                             <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                                             <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                                             <option data-countryCode="SD" value="249">Sudan (+249)</option>
                                             <option data-countryCode="SR" value="597">Suriname (+597)</option>
                                             <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                                             <option data-countryCode="SE" value="46">Sweden (+46)</option>
                                             <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                                             <option data-countryCode="SI" value="963">Syria (+963)</option>
                                             <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                                             <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                                             <option data-countryCode="TH" value="66">Thailand (+66)</option>
                                             <option data-countryCode="TG" value="228">Togo (+228)</option>
                                             <option data-countryCode="TO" value="676">Tonga (+676)</option>
                                             <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                                             <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                                             <option data-countryCode="TR" value="90">Turkey (+90)</option>
                                             <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                                             <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                                             <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                             <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                                             <option data-countryCode="UG" value="256">Uganda (+256)</option>
                                             <!-- <option data-countryCode="GB" value="44">UK (+44)</option> -->
                                             <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                             <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                                             <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                             <!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
                                             <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                                             <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                                             <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                                             <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                                             <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                                             <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
                                             <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                                             <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                                             <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                                             <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                                             <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                                             <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                                       </select>
                              
                                    </div>
                                 </div>
                              </div>
                           
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Phone</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Phone" type="text" name="phone" id="editPhone">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                         
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Password</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Password" type="password" name="password">
                                    </div>
                                 </div>
                              </div>
                           </div>


                          <div class="row">
                              <div class="col-md-4">  
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Business Name</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-building"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Business Name" type="text" name="businessName" id="editBusinessName">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Business Email</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-email"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Business Email" type="text" name="businessEmail" id="editBusinessEmail">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Business Country Code</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                       </div>
                                       <!-- country codes (ISO 3166) and Dial codes. -->
                                       <select name="businessCountryCode" id="editBusinessCountryCode" class="form-control">
                                          <option data-countryCode="GB" value="44" Selected>UK (+44)</option>
                                          <option data-countryCode="US" value="1">USA (+1)</option>
                                         
                                             <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                             <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                             <option data-countryCode="AO" value="244">Angola (+244)</option>
                                             <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                                             <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                                             <option data-countryCode="AR" value="54">Argentina (+54)</option>
                                             <option data-countryCode="AM" value="374">Armenia (+374)</option>
                                             <option data-countryCode="AW" value="297">Aruba (+297)</option>
                                             <option data-countryCode="AU" value="61">Australia (+61)</option>
                                             <option data-countryCode="AT" value="43">Austria (+43)</option>
                                             <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                                             <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                                             <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                                             <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                             <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                                             <option data-countryCode="BY" value="375">Belarus (+375)</option>
                                             <option data-countryCode="BE" value="32">Belgium (+32)</option>
                                             <option data-countryCode="BZ" value="501">Belize (+501)</option>
                                             <option data-countryCode="BJ" value="229">Benin (+229)</option>
                                             <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                                             <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                                             <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                                             <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                             <option data-countryCode="BW" value="267">Botswana (+267)</option>
                                             <option data-countryCode="BR" value="55">Brazil (+55)</option>
                                             <option data-countryCode="BN" value="673">Brunei (+673)</option>
                                             <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                                             <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                                             <option data-countryCode="BI" value="257">Burundi (+257)</option>
                                             <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                                             <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                                             <option data-countryCode="CA" value="1">Canada (+1)</option>
                                             <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                                             <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                                             <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                                             <option data-countryCode="CL" value="56">Chile (+56)</option>
                                             <option data-countryCode="CN" value="86">China (+86)</option>
                                             <option data-countryCode="CO" value="57">Colombia (+57)</option>
                                             <option data-countryCode="KM" value="269">Comoros (+269)</option>
                                             <option data-countryCode="CG" value="242">Congo (+242)</option>
                                             <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                                             <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                                             <option data-countryCode="HR" value="385">Croatia (+385)</option>
                                             <option data-countryCode="CU" value="53">Cuba (+53)</option>
                                             <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                                             <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                                             <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                                             <option data-countryCode="DK" value="45">Denmark (+45)</option>
                                             <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                                             <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                                             <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                                             <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                                             <option data-countryCode="EG" value="20">Egypt (+20)</option>
                                             <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                                             <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                                             <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                                             <option data-countryCode="EE" value="372">Estonia (+372)</option>
                                             <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                                             <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                                             <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                                             <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                                             <option data-countryCode="FI" value="358">Finland (+358)</option>
                                             <option data-countryCode="FR" value="33">France (+33)</option>
                                             <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                                             <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                                             <option data-countryCode="GA" value="241">Gabon (+241)</option>
                                             <option data-countryCode="GM" value="220">Gambia (+220)</option>
                                             <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                                             <option data-countryCode="DE" value="49">Germany (+49)</option>
                                             <option data-countryCode="GH" value="233">Ghana (+233)</option>
                                             <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                                             <option data-countryCode="GR" value="30">Greece (+30)</option>
                                             <option data-countryCode="GL" value="299">Greenland (+299)</option>
                                             <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                                             <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                                             <option data-countryCode="GU" value="671">Guam (+671)</option>
                                             <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                                             <option data-countryCode="GN" value="224">Guinea (+224)</option>
                                             <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                                             <option data-countryCode="GY" value="592">Guyana (+592)</option>
                                             <option data-countryCode="HT" value="509">Haiti (+509)</option>
                                             <option data-countryCode="HN" value="504">Honduras (+504)</option>
                                             <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                                             <option data-countryCode="HU" value="36">Hungary (+36)</option>
                                             <option data-countryCode="IS" value="354">Iceland (+354)</option>
                                             <option data-countryCode="IN" value="91">India (+91)</option>
                                             <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                                             <option data-countryCode="IR" value="98">Iran (+98)</option>
                                             <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                                             <option data-countryCode="IE" value="353">Ireland (+353)</option>
                                             <option data-countryCode="IL" value="972">Israel (+972)</option>
                                             <option data-countryCode="IT" value="39">Italy (+39)</option>
                                             <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                                             <option data-countryCode="JP" value="81">Japan (+81)</option>
                                             <option data-countryCode="JO" value="962">Jordan (+962)</option>
                                             <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                                             <option data-countryCode="KE" value="254">Kenya (+254)</option>
                                             <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                                             <option data-countryCode="KP" value="850">Korea North (+850)</option>
                                             <option data-countryCode="KR" value="82">Korea South (+82)</option>
                                             <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                                             <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                                             <option data-countryCode="LA" value="856">Laos (+856)</option>
                                             <option data-countryCode="LV" value="371">Latvia (+371)</option>
                                             <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                                             <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                                             <option data-countryCode="LR" value="231">Liberia (+231)</option>
                                             <option data-countryCode="LY" value="218">Libya (+218)</option>
                                             <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                                             <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                                             <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                                             <option data-countryCode="MO" value="853">Macao (+853)</option>
                                             <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                             <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                                             <option data-countryCode="MW" value="265">Malawi (+265)</option>
                                             <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                                             <option data-countryCode="MV" value="960">Maldives (+960)</option>
                                             <option data-countryCode="ML" value="223">Mali (+223)</option>
                                             <option data-countryCode="MT" value="356">Malta (+356)</option>
                                             <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                                             <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                                             <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                                             <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                                             <option data-countryCode="MX" value="52">Mexico (+52)</option>
                                             <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                                             <option data-countryCode="MD" value="373">Moldova (+373)</option>
                                             <option data-countryCode="MC" value="377">Monaco (+377)</option>
                                             <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                                             <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                                             <option data-countryCode="MA" value="212">Morocco (+212)</option>
                                             <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                                             <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                                             <option data-countryCode="NA" value="264">Namibia (+264)</option>
                                             <option data-countryCode="NR" value="674">Nauru (+674)</option>
                                             <option data-countryCode="NP" value="977">Nepal (+977)</option>
                                             <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                                             <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                                             <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                                             <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                                             <option data-countryCode="NE" value="227">Niger (+227)</option>
                                             <option selected="" data-countryCode="NG" value="234">Nigeria (+234)</option>
                                             <option data-countryCode="NU" value="683">Niue (+683)</option>
                                             <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                                             <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                                             <option data-countryCode="NO" value="47">Norway (+47)</option>
                                             <option data-countryCode="OM" value="968">Oman (+968)</option>
                                             <option data-countryCode="PK value="92">Pakistan (+92)</option>
                                             <option data-countryCode="PW" value="680">Palau (+680)</option>
                                             <option data-countryCode="PA" value="507">Panama (+507)</option>
                                             <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                                             <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                                             <option data-countryCode="PE" value="51">Peru (+51)</option>
                                             <option data-countryCode="PH" value="63">Philippines (+63)</option>
                                             <option data-countryCode="PL" value="48">Poland (+48)</option>
                                             <option data-countryCode="PT" value="351">Portugal (+351)</option>
                                             <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                                             <option data-countryCode="QA" value="974">Qatar (+974)</option>
                                             <option data-countryCode="RE" value="262">Reunion (+262)</option>
                                             <option data-countryCode="RO" value="40">Romania (+40)</option>
                                             <option data-countryCode="RU" value="7">Russia (+7)</option>
                                             <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                                             <option data-countryCode="SM" value="378">San Marino (+378)</option>
                                             <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                                             <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                                             <option data-countryCode="SN" value="221">Senegal (+221)</option>
                                             <option data-countryCode="CS" value="381">Serbia (+381)</option>
                                             <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                                             <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                                             <option data-countryCode="SG" value="65">Singapore (+65)</option>
                                             <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                                             <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                                             <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                                             <option data-countryCode="SO" value="252">Somalia (+252)</option>
                                             <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                                             <option data-countryCode="ES" value="34">Spain (+34)</option>
                                             <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                                             <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                                             <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                                             <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                                             <option data-countryCode="SD" value="249">Sudan (+249)</option>
                                             <option data-countryCode="SR" value="597">Suriname (+597)</option>
                                             <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                                             <option data-countryCode="SE" value="46">Sweden (+46)</option>
                                             <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                                             <option data-countryCode="SI" value="963">Syria (+963)</option>
                                             <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                                             <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                                             <option data-countryCode="TH" value="66">Thailand (+66)</option>
                                             <option data-countryCode="TG" value="228">Togo (+228)</option>
                                             <option data-countryCode="TO" value="676">Tonga (+676)</option>
                                             <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                                             <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                                             <option data-countryCode="TR" value="90">Turkey (+90)</option>
                                             <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                                             <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                                             <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                             <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                                             <option data-countryCode="UG" value="256">Uganda (+256)</option>
                                             <!-- <option data-countryCode="GB" value="44">UK (+44)</option> -->
                                             <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                             <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                                             <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                             <!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
                                             <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                                             <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                                             <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                                             <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                                             <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                                             <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
                                             <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                                             <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                                             <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                                             <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                                             <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                                             <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                                       </select>
                                       
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                            
                           
                              <div class="col-md-4"> 
                             
                                   <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Business Phone</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Business Phone" type="text" name="businessPhone" id="editBusinessPhone">
                                    </div>
                                 </div>
                              </div>
                         
                              <div class="col-md-4"> 
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Business Website</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-globe"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Website" type="text" name="website" id="editBusinessWebsite">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Business Address</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Address" type="text" name="address" id="editBusinessAddress">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-4"> 
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Latitude</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Longitude" type="text" name="longitude" id="editBusinessLongitude">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Longitude</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Latitude" type="text" name="latitude" id="editBusinessLatitude">
                                    </div>
                                 </div>
                              </div>
                               <div class="col-md-4"> 
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Correct Address</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Correct Address" type="text" name="correctAddress" id="editBusinessCorrectAddress">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                             
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Rate</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-star-half"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Rate" type="text" name="rate" id="editRate">
                                    </div>
                                 </div>
                              </div>
               
                              <div class="col-md-4"> 
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Review Count</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-calculator"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor Review Count" type="text" name="reviewCount" id="editReviewCount">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">First Referral</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-users"></i></span>
                                       </div>
                                       <input class="form-control" placeholder="Vendor First Referral" type="text" name="firstReferral" id="editFirstReferral">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">

                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="form-control-label" for="input-username">Notification</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-send"></i></span>
                                       </div>
                                       <select class="form-control" name="notification" id="editNotification"> 
                                          <option value="1">On</option>
                                          <option value="0">Off</option>
                                       </select>
                                    </div>
                                 </div>
                                 
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label" for="input-username">Status</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-toggle-off"></i></span>
                                       </div>
                                       <select class="form-control" name="status" id="editStatus"> 
                                          <option value="1">Active</option>
                                          <option value="0">Inactive</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                         
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-control-label" for="input-username">Image</label>

                                    <div class="input-group input-group-merge input-group-alternative">
                                      
                                       <input class="form-control" placeholder="File" type="file" name="image" id="editImage">
                                    </div>
                                 </div>
                                  
                              </div>
                           </div>
                           <div class="text-center">
                              <button type="submit" class="btn btn-primary my-4">Update Vendor</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End Edit ADmin Modal -->

   <!-- Delete Admin Modal -->
     <div class="col-md-4">
      <div class="modal fade" id="delete-vendor-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>Delete Vendor</small>
                        </div>
                        <form role="form" method="POST" id="deleteForm">
                           @csrf
                           @method('DELETE')
                            <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 
                                 <label class="form-control" >Are You Sure You Want To Delete This Vendor?</label>
                              </div>
                            </div>
                           
                           <div class="text-center">
                              <button type="submit" class="btn btn-danger my-4">Yes</button>
                              <button type="button" class="btn btn-success my-4" data-dismiss="modal">No </button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End Delete Admin Modal -->
        <!-- View Vendor Modal -->
     <div class="col-md-4">
      <div class="modal fade addModel" id="view-category-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>View  Image</small>
                        </div>
                        <form role="form">
                          
                            <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <img src="" id="viewImage">
                              </div>
                            </div>
                           
                           <div class="text-center">
                              <button type="button" class="btn btn-success my-4" data-dismiss="modal">Close </button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End View Vendor cat Modal -->
@include('layouts.footers.auth')
</div>

@push('js')
<script type="text/javascript">
    $(function(){
        $(".editVendor").click(function(){
            var id = $(this).data('id')
            var username = $(this).data('username')
            var fullname = $(this).data('fullname')
            var email = $(this).data('email')
            var phone = $(this).data('phone')
            var countrycode = $(this).data('countrycode')

            var businessName = $(this).data('businessname')
            var businessEmail = $(this).data('businessemail')
            var businessPhone = $(this).data('businessphone')
            var businessCountryCode = $(this).data('businesscountrycode')
            var businessWebsite = $(this).data('businesswebsite')
            var businessAddress = $(this).data('businessaddress')
            var longitude = $(this).data('longitude')
            var latitude = $(this).data('latitude')
            var correctAddress = $(this).data('correctaddress')
            var rate = $(this).data('rate')
            var reviewCount = $(this).data('reviewcount')
            var firstReferral = $(this).data('firstreferral')


            var notification = $(this).data('notification')
            var image = $(this).data('image')
            var status = $(this).data('status')

            var route="{{route('vendor.update',':id')}}"
            route = route.replace(':id',id)
            $("#editUsername").val(username)
            $("#editFullname").val(fullname)
            $("#editEmail").val(email)
            $("#editPhone").val(phone)
            $("#editCountryCode").val(countrycode)

            $("#editBusinessName").val(businessName)
            $("#editBusinessEmail").val(businessEmail)
            $("#editBusinessPhone").val(businessPhone)
            $("#editBusinessWebsite").val(businessWebsite)
            $("#editBusinessAddress").val(businessAddress)
            $("#editBusinessLongitude").val(longitude)
            $("#editBusinessLatitude").val(latitude)
            $("#editBusinessCorrectAddress").val(correctAddress)
            $("#editRate").val(rate)
            $("#editReviewCount").val(reviewCount)
            $("#editFirstReferral").val(firstReferral)

            $("#editNotification").val(notification)
            $("#editShowImage").attr('src',image)
            $("#editStatus").val(status)
            $("#editForm").attr("action",route)

            $("#edit-vendor-form").modal()       

        })
          $(".viewVendor").click(function(){
            var image = "{{asset('storage')}}/"+$(this).data('image')
            $("#viewImage").attr('src',image)
            $("#view-category-form").modal()       

        })

        $(".deleteVendor").click(function(){
             var id = $(this).data('id')
             var route="{{route('vendor.destroy',':id')}}"
             route = route.replace(':id',id)
             $("#deleteForm").attr("action",route)
            $("#delete-vendor-form").modal()
        })
    })
</script>
@endpush
@endsection