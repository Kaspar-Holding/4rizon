@extends('layouts.app')
@section('pageTitle','Notification Lists')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>Notification Lists</h2>
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
                        <div class="row">
                            <div class="col-md-9">
                                <h2>Notification Lists</h2>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('add_admin_msg')}}" class="btn my-button btn-inverse btn-outline-primary">Create Notification</a>
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
                                 <th>User Name</th>
                                 <th>Notification Type</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @php $count = 1; @endphp
                              @foreach ($notif_list as $notification)
                              @if($notification['notification_type'] == 4 )
                                  @php 
                                    $user = App\Models\user_infos::where('user_id',$notification['user_id'])->first();
                                    
                                  @endphp
                                  @elseif($notification['notification_type'] == 5)
                                  @php
                                  $user = App\Models\DjUser::where('id',$notification['dj_id'])->first();
                                  @endphp
                               @endif
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>;
                                <td class="text-capitalize">@if(!empty($user)) {{$user->first_name}} {{$user->last_name}} @else Event Type @endif</td>
                                <td class="text-capitalize">@if($notification['notification_type'] == 3) Admin Message @elseif($notification['notification_type'] == 2) Purchase Item Notification @elseif($notification['notification_type'] == 1) Event Notification @elseif($notification['notification_type'] == 4) Event Invitation @elseif($notification['notification_type'] ==5) DJ Notification @endif</td>
                                <td class="text-capitalize">{{$notification['status']}}</td>
                                <td>
                                    <a href="delete_admin_msg/{{$notification['id']}}" class="btn btn-red btn-sm btn-inverse btn-outline-danger">
                                      <i class="fa fa-trash"></i> 
                                    </a>
                                   
                                </td>
                              </tr>
                              @php $count++; @endphp
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