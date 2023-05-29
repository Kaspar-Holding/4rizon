@extends('layouts.app')
@section('pageTitle','Gallery Lists')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-9">
               <div class="page_title">
                  <h2>Bookings</h2>
               </div>
            </div>
            <div class="col-md-3"  style="margin-top: 40px;">
               <a href="{{ route('vip_pkg_list') }}" class="btn btn-inverse my-button btn-outline-primary">Vip Package</a>
            
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
                        <div class="row">
                            <div class="col-md-9">
                                <h2>Vip Booking Lists</h2>
                            </div>
                        </div>
                     </div>
                  </div>
                  <div class="table_section padding_infor_info">
                     <div class="table-responsive-sm">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Vip Package</th>
                                 <th>Event</th>
                                 <th>Booked By</th>
                                 <th>Guest List</th>
                                 
                              </tr>
                           </thead>
                           <tbody>
                              <?php $count = 1;?>
                              @foreach ($vip_booking_list as $vip_book)
                              @php 
                                $user = App\Models\user_infos::where('user_id',$vip_book['user_id'])->first();
                                $vip_pkg = App\Models\VipPkg::where('id',$vip_book['vip_booth_id'])->first();
                                $event = App\Models\Event::where('id',$vip_book['event_id'])->first();
                              @endphp
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$vip_pkg['pkg_name']}}</td>
                                <td class="text-capitalize">{{$event['event_name']}}</td>
                                <td class="text-capitalize">{{$user->first_name ?? ''}} {{$user->last_name ?? ''}}</td>
                                <td class="text-capitalize">
                                 <a href="view_user_event_details/{{$vip_book['id']}}" class="btn btn-sm btn-blue  btn-inverse btn-outline-primary" style = "background-color: #10948C !important; ">
                                    <i class="fa fa-eye"></i> 
                                  </a>
                                </td>
                                
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
@stop