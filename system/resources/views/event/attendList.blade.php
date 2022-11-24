@extends('layouts.app')
@section('pageTitle','Booking Lists')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>Booking Lists</h2>
               </div>
            </div>
        </div>
         <!-- row -->
        <div class="row">
            <!-- table section -->
            <div class="col-md-12">
               <div class="white_shd full margin_bottom_30">
                    <div>
                        @include('flashmessages')
                    </div>
                  <div class="full graph_head">
                     <div class="heading1 margin_0">
                        <h2>Booking Lists</h2>
                     </div>
                  </div>
                  <div class="table_section padding_infor_info">
                     <div class="table-responsive-sm">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Event Name</th>
                                 <th>User Name</th>
                                 <th>Event Date</th>
                                 <th>Vip Package</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $count = 1;?>
                              @foreach ($event_list as $event)
                                @php
                                    $events = \App\Models\Event::where('id',$event['event_id'])->first();
                                    $user = \App\Models\user_infos::where('user_id',$event['user_id'])->first();
                                    $vip_pkg = App\Models\VipPkg::where('id',$event['vip_booth_id'])->first();
                                @endphp
                              @if($user)
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$events->event_name?? ''}}</td>
                                <td class="text-capitalize">{{$user->first_name}} {{$user->last_name}}</td>
                                <td class="text-capitalize">{{$events->event_date ?? ''}}</td>
                                <td class="text-capitalize">@if(!empty($vip_pkg)) {{$vip_pkg['pkg_name']}} @endif</td>
                                <td class="text-capitalize">
                                    {{ $event->status }}
                                <td>
                                    <a href="view_user_event_details/{{$event['id']}}" class="btn btn-sm btn-inverse btn-outline-success">
                                      <i class="fa fa-eye"></i> 
                                    </a>
                                </td>
                              </tr>
                              @endif
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