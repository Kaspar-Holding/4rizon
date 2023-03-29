@extends('layouts.app')
@section('pageTitle','Transactions')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-8">
               <div class="page_title">
                  <h2>Transactions</h2>
               </div>
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
                        <h2>Transaction List</h2>
                     </div>
                  </div>
                  <div class="table_section padding_infor_info">
                     <div class="table-responsive-sm">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>User Name</th>
                                 <th>Event Name</th>   
                                 <th>Event Price</th>
                                 <th>Date</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $count = 1;?>
                              @foreach ($event_list as $event)
                                @php
                                    $events = \App\Models\Event::where('id',$event['event'])->first();
                                    $user = \App\Models\user_infos::where('user_id',$event['user'])->first();
                                @endphp
                                
                              @if($user)
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$user->first_name}} {{$user->last_name}}</td>
                                <td class="text-capitalize">{{$events->event_name?? ''}}</td>
                                <td class="text-capitalize">{{$event['amount']}}</td>
                                <td class="text-capitalize">{{$event['created_at'] ?? ''}}</td>
                                
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