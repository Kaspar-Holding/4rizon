@extends('layouts.app')
@section('pageTitle','Dashboard')
@section('content');
<style>
   .col-lg-2{
      padding : 3px !important;
   }
   .container-fluid{
      padding-left : 15px !important;
      padding-right : 13px !important;
   }
   </style>
                  <div class="container-fluid" style="padding-left:30px;">
                  <div class="row seacrh_container marginTop" style="margin:0px;">
                   <div class="col-md-12" style="padding-left:0px">
                     <div class="white_shd full margin_bottom_30">
                        <div class="div-head">Search Statistics</div>
                        <form action="{{request()->fullUrl()}}" method="get">
                        <div class="cd">
                           <div class="row">
                              <div class="col-sm-12">
                                    @if(session()->has('error'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('error') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                       <div class="col-sm-3 col-12">
                                          <div class="input-group state_shd customGroup p-2 mb-3">
                                                <div class="input-group-prepend">
                                                <span class="state_icon" id="basic-addon1"><i class=" fa fa-calendar"></i></span>
                                                </div>
                                                <input type="date" class="form-control"  placeholder="From Date" value="{{ $from_date ?? '' }}" name="from_date" From="2022-04-01">
                                          </div>
                                       </div>
                                       <div class="col-sm-3 col-12">
                                          <div class="input-group  state_shd customGroup p-2 mb-3">
                                                <div class="input-group-prepend">
                                                <span class="state_icon" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input type="date" class="form-control"  placeholder="To Date"  value="{{ $to_date ?? '' }}"  name="to_date" aria-label="To Date" To="2022-04-11">
                                          </div>
                                          <!--  -->
                                       </div>
                                       <div class="col-sm-3 col-12">@if(request()->get('from_date') || request()->get('to_date'))
                                    <a class="btn btn-primary btn-sm mt-2 text-white" href="{{route('dashboard')}}">Reset</a>
                                @endif</div>
                                       <div class="col-sm-3 col-12" style="align-self:center;">
                                          <button class="srch" type="submit" class="btn btn-inverse">Search</button>
                                       </div>
                                    </div>
                              </div>
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
                  </div>
                     <div class="row2  column1">
                        
                        <div class="col-md-6 col-lg-2">
                            <a href="@if(request()->get('from_date') || request()->get('to_date'))users_lists/{{$from_date}}/{{$to_date}} @else {{ route('users_list') }} @endif">
                           <div class="full counter_section row margin_bottom_30">
                              <div class="icons row col-sm-12">
                                 <div class="couter_icon col-sm-6"> 
                                 <i class="fa fa-user"></i>
                                 </div>
                              </div>
                              <div class="counter_no col-sm-12">
                                 <div>
                                    <p class="total_no">{{ count($registered_users) }}</p>
                                    <p class="head_couter">All Users</p>
                                 </div>
                              </div>
                           </div>
                           </a>
                        </div>
                        <div class="col-md-6 col-lg-2">
                           <a href="@if(request()->get('from_date') || request()->get('to_date'))users_lists/{{$from_date}}/{{$to_date}} @else {{ route('users_list') }} @endif">
                          <div class="full counter_section row margin_bottom_30">
                             <div class="icons row col-sm-12">
                                <div class="couter_icon col-sm-6"> 
                                <i class="fa fa-user"></i>
                                </div>
                             </div>
                             <div class="counter_no col-sm-12">
                                <div>
                                   <p class="total_no">{{count($users_app) }}</p>
                                   <p class="head_couter">Via App</p>
                                </div>
                             </div>
                          </div>
                          </a>
                       </div>
                       <div class="col-md-6 col-lg-2">
                        <a href="@if(request()->get('from_date') || request()->get('to_date'))users_lists/{{$from_date}}/{{$to_date}} @else {{ route('users_list') }} @endif">
                       <div class="full counter_section row margin_bottom_30">
                          <div class="icons row col-sm-12">
                             <div class="couter_icon col-sm-6"> 
                             <i class="fa fa-user"></i>
                             </div>
                          </div>
                          <div class="counter_no col-sm-12">
                             <div>
                                <p class="total_no">{{ count($users_web) }}</p>
                                <p class="head_couter">Via Web</p>
                             </div>
                          </div>
                       </div>
                       </a>
                    </div>
                        <div class="col-md-6 col-lg-2">
                           <a href="@if(request()->get('from_date') || request()->get('to_date'))users_lists/{{$from_date}}/{{$to_date}} @else {{ route('users_list') }} @endif">
                          <div class="full counter_section row margin_bottom_30">
                             <div class="icons row col-sm-12">
                                <div class="couter_icon col-sm-6"> 
                                <i class="fa fa-user"></i>
                                </div>
                             </div>
                             <div class="counter_no col-sm-12">
                                <div>
                                   <p class="total_no">{{ count($users_verify) }}</p>
                                   <p class="head_couter">Active Users</p>
                                </div>
                             </div>
                          </div>
                          </a>
                       </div>
                       <div class="col-md-6 col-lg-2">
                        <a href="@if(request()->get('from_date') || request()->get('to_date'))users_lists/{{$from_date}}/{{$to_date}} @else {{ route('users_list') }} @endif">
                       <div class="full counter_section row margin_bottom_30">
                          <div class="icons row col-sm-12">
                             <div class="couter_icon col-sm-6"> 
                             <i class="fa fa-user"></i>
                             </div>
                          </div>
                          <div class="counter_no col-sm-12">
                             <div>
                                <p class="total_no">{{ count($users_reject) }}</p>
                                <p class="head_couter">Denied Users</p>
                             </div>
                          </div>
                       </div>
                       </a>
                    </div>
                    <div class="col-md-6 col-lg-2">
                     <a href="@if(request()->get('from_date') || request()->get('to_date'))users_lists/{{$from_date}}/{{$to_date}} @else {{ route('users_list') }} @endif">
                    <div class="full counter_section row margin_bottom_30">
                       <div class="icons row col-sm-12">
                          <div class="couter_icon col-sm-6"> 
                          <i class="fa fa-user"></i>
                          </div>
                       </div>
                       <div class="counter_no col-sm-12">
                          <div>
                             <p class="total_no">{{ count($users_pending) }}</p>
                             <p class="head_couter">Pending Users</p>
                          </div>
                       </div>
                    </div>
                    </a>
                 </div>
             
                        
                        {{-- <div class="col-md-6 col-lg-3">
                            <a href="@if(request()->get('from_date') || request()->get('to_date'))users_record/{{$from_date}}/{{$to_date}} @else {{ route('users_record') }} @endif">
                           <div class="full counter_section row margin_bottom_30" style="height : 162px;">
                              <div class="icons row col-sm-12">
                                 <div class="couter_icon col-sm-3"> 
                                 <i class="fa fa-user"></i>
                                 </div>
                                 <div class = "col-sm-6">
                                    <h5 style="margin-top:20px; color:aliceblue !important;" class="head_couter">Registrations</h5>
                                 </div>
                              </div>
                              <div class="counter_no col-sm-12">
                                 <div>
                                    <p class="head_couter">Via App: &nbsp; &nbsp;<b>  {{count($users_app) }}</b>  </p>
                                    <p class="head_couter">Via Web:&nbsp; &nbsp;<b> {{ count($users_web) }}</b> </p>
                                 
                                 </div>
                              </div>
                           </div>
                           </a>
                        </div> --}}
                        {{-- <div class="col-md-6 col-lg-3">
                           <a href="@if(request()->get('from_date') || request()->get('to_date'))users_record/{{$from_date}}/{{$to_date}} @else {{ route('users_record') }} @endif">
                       <div class="full counter_section row margin_bottom_30">
                             <div class="icons row col-sm-12">
                                <div class="couter_icon col-sm-3"> 
                                <i class="fa fa-user"></i>
                                </div>
                                <div class = "col-sm-6">
                                   <h5 style="margin-top:20px; color:aliceblue !important;" class="head_couter">Users</h5>
                                </div>
                             </div>
                             <div class="counter_no col-sm-12">
                                <div>
                                 
                                   <p class="head_couter">Active:  &nbsp;&nbsp; &nbsp; &nbsp;<b>  {{ count($users_verify) }}</b> </p>
                                   <p class="head_couter">Denied:&nbsp;&nbsp; &nbsp; <b>   {{ count($users_reject) }}</b> </p>
                                   <p class="head_couter">Pending: &nbsp; <b>  {{ count($users_pending) }}</b></p>
                                   <p class="head_couter">Blocked: &nbsp;&nbsp; <b>  {{ count($users_blocked) }}</b></p>
                                </div>
                             </div>
                          </div>
                          </a>
                       </div> --}}
                        {{-- <div class="col-md-6 col-lg-3">
                            <a href="@if(request()->get('from_date') || request()->get('to_date'))users_events_attend_lists/{{$from_date}}/{{$to_date}} @else {{ route('users_event_attend_list') }} @endif">
                        <div class="full row counter_section margin_bottom_30">
                              <div class="icons row col-sm-12">
                                 <div class="couter_icon col-sm-6"> 
                                 <i class="fa fa-user"></i>
                                 </div>
                              </div>
                              <div class="counter_no col-sm-12">
                                 <div>
                                    <p class="total_no">{{ count($qr_scans) }}</p>
                                    <p class="head_couter">QR Code Scans</p>
                                 </div>
                              </div>
                           </div>
                           </a>
                        </div> --}}
                        {{-- <div class="col-md-6 col-lg-3">
                            <a href="@if(request()->get('from_date') || request()->get('to_date'))total_points_collects/{{$from_date}}/{{$to_date}} @else {{ route('total_points_collected') }} @endif">
                           <div class="full row counter_section margin_bottom_30">
                              <div class="icons row col-sm-12">
                                 <div class="couter_icon col-sm-6"> 
                                 <i class="fa fa-user"></i>
                                 </div>
                              </div>
                              <div class="counter_no col-sm-12">
                                 <div>
                                    <p class="total_no">{{ $points }}</p>
                                    <p class="head_couter">Total Points Collected</p>
                                 </div>
                              </div>
                           </div>
                           </a>
                        </div> --}}
                        
                     </div>
                     <div class="row2 column1" >
                        <div class="col-md-6 col-lg-2">
                           <a href="@if(request()->get('from_date') || request()->get('to_date'))users_lists/{{$from_date}}/{{$to_date}} @else {{ route('users_list') }} @endif">
                          <div class="full counter_section row margin_bottom_30">
                             <div class="icons row col-sm-12">
                                <div class="couter_icon col-sm-6"> 
                                <i class="fa fa-user"></i>
                                </div>
                             </div>
                             <div class="counter_no col-sm-12">
                                <div>
                                   <p class="total_no">{{ count($bookings) }}</p>
                                   <p class="head_couter">All Bookings</p>
                                </div>
                             </div>
                          </div>
                          </a>
                       </div>
                       <div class="col-md-6 col-lg-2">
                          <a href="@if(request()->get('from_date') || request()->get('to_date'))users_lists/{{$from_date}}/{{$to_date}} @else {{ route('users_list') }} @endif">
                         <div class="full counter_section row margin_bottom_30">
                            <div class="icons row col-sm-12">
                               <div class="couter_icon col-sm-6"> 
                               <i class="fa fa-user"></i>
                               </div>
                            </div>
                            <div class="counter_no col-sm-12">
                               <div>
                                  <p class="total_no">{{ count($paid) }}</p>
                                  <p class="head_couter">Confirmed</p>
                               </div>
                            </div>
                         </div>
                         </a>
                      </div>
                      <div class="col-md-6 col-lg-2">
                       <a href="@if(request()->get('from_date') || request()->get('to_date'))users_lists/{{$from_date}}/{{$to_date}} @else {{ route('users_list') }} @endif">
                      <div class="full counter_section row margin_bottom_30">
                         <div class="icons row col-sm-12">
                            <div class="couter_icon col-sm-6"> 
                            <i class="fa fa-user"></i>
                            </div>
                         </div>
                         <div class="counter_no col-sm-12">
                            <div>
                               <p class="total_no">{{ count($payment_pending) }}</p>
                               <p class="head_couter">Pending</p>
                            </div>
                         </div>
                      </div>
                      </a>
                   </div>
                   <div class="col-md-6 col-lg-2">
                    <a href="@if(request()->get('from_date') || request()->get('to_date'))users_lists/{{$from_date}}/{{$to_date}} @else {{ route('users_list') }} @endif">
                   <div class="full counter_section row margin_bottom_30">
                      <div class="icons row col-sm-12">
                         <div class="couter_icon col-sm-6"> 
                         <i class="fa fa-user"></i>
                         </div>
                      </div>
                      <div class="counter_no col-sm-12">
                         <div>
                            <p class="total_no">{{ count($qr_success) }}</p>
                            <p class="head_couter">Entries</p>
                         </div>
                      </div>
                   </div>
                   </a>
                </div>
                <div class="col-md-6 col-lg-2">
                 <a href="@if(request()->get('from_date') || request()->get('to_date'))users_lists/{{$from_date}}/{{$to_date}} @else {{ route('users_list') }} @endif">
                <div class="full counter_section row margin_bottom_30">
                   <div class="icons row col-sm-12">
                      <div class="couter_icon col-sm-6"> 
                      <i class="fa fa-user"></i>
                      </div>
                   </div>
                   <div class="counter_no col-sm-12">
                      <div>
                         <p class="total_no">{{ count($qr_pending) }}</p>
                         <p class="head_couter">Pending Entries</p>
                      </div>
                   </div>
                </div>
                </a>
             </div>
             <div class="col-md-6 col-lg-2">
              <a href="@if(request()->get('from_date') || request()->get('to_date'))users_lists/{{$from_date}}/{{$to_date}} @else {{ route('users_list') }} @endif">
             <div class="full counter_section row margin_bottom_30">
                <div class="icons row col-sm-12">
                   <div class="couter_icon col-sm-6"> 
                   <i class="fa fa-user"></i>
                   </div>
                </div>
                <div class="counter_no col-sm-12">
                   <div>@foreach($app_share as $share)
                      <p class="total_no">{{ $share['count_share'] }}</p>@endforeach
                      <p class="head_couter">Total App Share</p>
                   </div>
                </div>
             </div>
             </a>
          </div>
                     </div>
                     <!-- graph -->
                     <div class="row column2 graph margin_bottom_30">
                        <div class="col-md-l2 col-lg-12">
                           <div class=" full row">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Registered Users</h2>
                                 </div>
                              </div>
                              <div class="full graph_revenue">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="content">
                                          <div class="area_chart">
                                             <canvas height="120" id="canvas"></canvas>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <div class="row full margin_bottom_30 column3" style="padding-left:10px;">
                           <div class="col-sm-4 my-col">
                              <div class="white_shd"> 
                                 <div class="loader row">
                                    <progress id="send" value="{{ count($qr_scans) }}" max="{{ count($total_qr) }}"></progress>
                                    <progress id="recv" value="{{ count($total_qr_exit) }}" max="{{ count($total_qr) }}"></progress>
                                    <button style="font-size:13px;" class="start-btn" id="btn">Total Codes <br/> Generated <br/> <span style="color: #6BEAEC; padding-top:5px;">{{ count($total_qr) }}</span></button>
                                 </div>
                                 <div class="row  box-row1" style="margin-top:40px;">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-8">
                                    <p class="fp"><span class="online_animation-red"></span> Total Codes Scanned For Entery</p>
                                    </div>
                                    <div class="col-sm-1 fp" style="color: #6BEAEC; padding-top:5px;">{{count($qr_scans)}}</div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="row  box-row1 load">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-8">
                                    <p  class="fp"><span class="online_animation-blue"></span> Total Codes Scanned To Exit</p>
                                    </div>
                                    <div class="col-sm-1 fp" style="color: #6BEAEC; padding-top:5px;">{{ count($total_qr_exit) }}</div>
                                    <div class="col-sm-2"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-4 my-col">
                           <div class="white_shd"> 
                              <div class="loader row">
                                 <progress id="send" value="{{ count($pending_users) }}" max="{{ count($registered_users) }}"></progress>
                                 <progress id="recv" value="{{ count($valid_users) }}" max="{{ count($registered_users) }}"></progress>
                                 <button style="font-size:13px;" class="start-btn" id="btn">Total Users <span style="color: #6BEAEC; padding-top:5px;">{{ count($registered_users) }}</span></button>
                              </div>
                              <div class="row  box-row1" style="margin-top:40px;">
                                 <div class="col-sm-1"></div>
                                 <div class="col-sm-8">
                                 <p class="fp"><span class="online_animation-red"></span> Total New Users</p>
                                 </div>
                                 <div class="col-sm-1 fp" style="color: #6BEAEC; padding-top:5px;">{{ count($pending_users) }}</div>
                                 <div class="col-sm-2"></div>
                              </div>
                              <div class="row  box-row1 load">
                                 <div class="col-sm-1"></div>
                                 <div class="col-sm-8">
                                 <p  class="fp"><span class="online_animation-blue"></span> Total Active Users</p>
                                 </div>
                                 <div class="col-sm-1 fp" style="color: #6BEAEC; padding-top:5px;">{{ count($valid_users) }}</div>
                                 <div class="col-sm-2"></div>
                              </div>
                           </div>
                           </div>
                           <div class="col-sm-4 my-col">
                              <div class="white_shd"> 
                                 <div class="loader row">
                                    <progress id="send" value="{{ count($pending_artist) }}" max="{{ count($registered_users) }}"></progress>
                                    <progress id="recv" value="{{ count($valid_artist) }}" max="{{ count($registered_users) }}"></progress>
                                    <button style="font-size:13px;" class="start-btn" id="btn">Total Artists <span style="color: #6BEAEC; padding-top:5px;">{{ count($registered_artist) }}</span></button>
                                 </div>
                                 <div class="row  box-row1" style="margin-top:40px;">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-8">
                                    <p class="fp"><span class="online_animation-red"></span> Total New Artist</p>
                                    </div>
                                    <div class="col-sm-1 fp" style="color: #6BEAEC; padding-top:5px;">{{ count($pending_artist) }}</div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="row  box-row1 load">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-8">
                                    <p  class="fp"><span class="online_animation-blue"></span> Total Active Artist</p>
                                    </div>
                                    <div class="col-sm-1 fp" style="color: #6BEAEC; padding-top:5px;">{{ count($valid_artist) }}</div>
                                    <div class="col-sm-2"></div>
                                 </div>
                              </div>
                              </div>
                           <div class="col-md-l2 col-lg-12">
                              <div class=" full row">
                                 <div class="full graph_head">
                                    <div class="heading1 ">
                                       <h2>Events Booking Count</h2>
                                    </div>
                                 </div>
                                 <div class="full graph_revenue">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="content">
                                             <div class="table_section padding_infor_info white_shd margin_1">
                                                <div class="table-responsive-sm">
                                                   <table class="table table-striped">
                                                      <thead>
                                                         <tr>
                                                            <th>#</th>
                                                            <th>Event Name</th>
                                                            <th>Booking Count</th>
                                                            
                                                         </tr>
                                                      </thead>
                                                      <tbody>
                                                         <?php $count = 1;?>
                                                         @foreach ($events as $event_id)
                                                         <tr>
                                                            <td class="text-capitalize">{{$count}}</td>
                                                           <td class="text-capitalize">{{$event_id['event_name']}}</td>
                                                           @php 
                                                           
                                                            $booking_count = \App\Models\Bookings::where('event_id','=',$event_id['id'])->get(); @endphp
                                                           <td class="text-capitalize">{{count($booking_count)}}</td>
                                                          
                                                           
                                                         </tr>
                                                         <?php $count = $count+1;?>
                                                         @endforeach
                                                      </tbody>
                                                   </table>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           
                        </div>
                       
                     <!-- end graph -->
                  </div>
                     </div>

                  
                  </div>
                  <!-- footer -->
    <input type="hidden" id="january" value="{{ $january }}">
    <input type="hidden" id="feburary" value="{{ $feburary }}">
    <input type="hidden" id="march" value="{{ $march }}">
    <input type="hidden" id="april" value="{{ $april }}">
    <input type="hidden" id="may" value="{{ $may }}">
    <input type="hidden" id="june" value="{{ $june }}">
    <input type="hidden" id="july" value="{{ $july }}">
    <input type="hidden" id="august" value="{{ $august }}">
    <input type="hidden" id="september" value="{{ $september }}">
    <input type="hidden" id="october" value="{{ $october }}">
    <input type="hidden" id="november" value="{{ $november }}">
    <input type="hidden" id="december" value="{{ $december }}">
    <input type="hidden" id="qr_code_scan" value="{{ count($qr_scans) }}">

   
                
@stop
