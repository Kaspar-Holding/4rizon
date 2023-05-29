@extends('layouts.app')
@section('pageTitle','Booking Lists')
@section('content')
<style>
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 11px !important;
    }
    </style>
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-8">
               <div class="page_title">
                  <h2>Bookings</h2>
               </div>
            </div>
            <div class="col-md-4"  style="margin-top: 40px;">
               <a href="{{ route('users_transaction_list') }}" class="btn btn-inverse my-button btn-outline-primary">Transactions</a>
               <a href="{{ route('vip_pkg_list') }}" class="btn btn-inverse my-button btn-outline-primary">Vip Package</a>
               <!-- <a href="{{ route('vip_booking_list') }}" class="btn btn-inverse my-button btn-outline-primary">Vip Bookings</a> -->
           </div>
        </div>
         <!-- row -->
        <div class="row">
            <!-- table section -->
            <div class="col-md-12">
               <div class="white_shd full margin_bottom_30">
                    <div class = "alerti">
                        @include('flashmessages')
                    </div>
                  <div class="full graph_head">
                     <div class="heading1 margin_0">
                        <h2>Booking Lists</h2>
                     </div>
                  </div>
                  <div class="table_section padding_infor_info">
                     <div class="table-responsive-sm">
                        <table class="table table-striped" id = "myTable">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 
                                 <th>Event Name</th>
                                 <th>User Name</th>
                                 <th>Event Date</th>
                                 <th>Package Type</th>
                                 <th>Status</th>
                                 <th>Payment </th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              
                              <?php  $count = 1;?>
                              @foreach ($event_list as $event)
                                @php
                                    $events = \App\Models\Event::where('id',$event['event_id'])->first();
                                    $user = \App\Models\user_infos::where('user_id',$event['user_id'])->first();
                                    $vip_pkg = App\Models\VipPkg::where('id',$event['vip_booth_id'])->first();
                                    $guest = App\Models\Guest::where('booking_id',$event['booking_id'])->where('status','=','0')->get();
                                @endphp
                              {{-- @if($user) --}}
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$events->event_name?? ''}}</td>
                                <td class="text-capitalize">{{$user->first_name ?? ''}} {{$user->last_name ?? ''}}</td>
                                <td class="text-capitalize">{{$events->event_date ?? ''}}</td>
                                <td class="text-capitalize">@if(!empty($vip_pkg)) {{$vip_pkg['pkg_name']}}
                                <br> Guest : {{count($guest)}}

                                @else Normal @endif</td>
                               
                                <td class="text-capitalize">
                                    {{ $event->status }} </td>
                                    <td class="text-capitalize">@if($event->payment_status == 0)   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                       To Pay
                                       </button> @else Paid @endif</td>
                                <td>
                                    <a href="view_user_event_details/{{$event['id']}}" class="btn btn-sm btn-blue  btn-inverse btn-outline-primary" style = "background-color: #10948C !important; ">
                                      <i class="fa fa-eye"></i> 
                                    </a>
                                    
                                     
                                </td>
                              </tr>
                              {{-- @endif --}}
                              <?php $count = $count+1;?>
                              @endforeach
                           </tbody>
                           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content" style = "background_color : #0a1022">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="row">
                                             <!-- table section -->
                                          <div class="col-md-12">
                                       <form style = "padding-top:0px; !important" action="{{ route('payment')}}" method="POST" enctype="multipart/form-data" style="padding:30px;">
                                          @csrf
                                          <div>
                                             <label class="form-label">Enter Amount</label>
                                             <input type="text" name="price" class="form-control" required >
                                             @if(!empty($event->booking_id))
                                             <input type="hidden" name="booking_id" value="{{ $event->booking_id }}" class="form-control" required >@endif
                                          </div>
                                          
                                          </div></div>
                                       </div>
                                       <div class="modal-footer">
                                    
                                       <button type="submit" class="btn btn-primary">Save changes</button>
                                       </div>
                                       </form>
                                       </div>
                                    </div>
                              </div>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
        </div>
    </div>
@stop