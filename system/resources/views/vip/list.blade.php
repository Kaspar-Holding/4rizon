@extends('layouts.app')
@section('pageTitle','Gallery Lists')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-8">
               <div class="page_title">
                  <h2>Bookings</h2>
               </div>
            </div>
            <div class="col-md-4"  style="margin-top: 40px;">
               <a href="{{ route('vip_pkg_list') }}" class="btn btn-inverse my-button btn-outline-primary">Vip Package</a>
               <a href="{{ route('vip_booking_list') }}" class="btn btn-inverse my-button btn-outline-primary">Vip Bookings</a>
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
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $count = 1;?>
                              @foreach ($vip_booking_list as $vip_book)
                              @php 
                                $user = App\Models\user_infos::where('user_id',$vip_book['user_id'])->first();
                                $vip_pkg = App\Models\VipPkg::where('id',$vip_book['vip_pkg_id'])->first();
                                $event = App\Models\VipPkg::where('id',$vip_book['vip_pkg_id'])->first();
                              @endphp
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$vip_pkg['pkg_name']}}</td>
                                <td class="text-capitalize">{{$event['event_name']}}</td>
                                <td class="text-capitalize">{{$user->first_name}} {{$user->last_name}}</td>
                                <td class="text-capitalize">
                                    <a href="edit_vip_pkg/{{$vip_book['id']}}" class="btn btn-blue  btn-sm btn-inverse btn-outline-success">
                                      <i class="fa fa-eye"></i> 
                                    </a>
                                </td>
                                <td>
                                    
                                    <a href="delete_vip_booking/{{$vip_book['id']}}" class="btn btn-red btn-sm btn-inverse btn-outline-danger">
                                      <i class="fa fa-trash"></i> 
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