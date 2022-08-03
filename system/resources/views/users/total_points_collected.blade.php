@extends('layouts.app')
@section('pageTitle','Total Points Collected')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>Points Collected</h2>
               </div>
            </div>
        </div>
         <!-- row -->
        <div class="row">
            <!-- table section -->
            <div class="col-md-12">
               <div class="white_shd full margin_bottom_30">
                  <div class="full graph_head">
                     <div class="heading1 margin_0">
                        
                     </div>
                  </div>
                  <div class="table_section padding_infor_info">
                     <div class="table-responsive-sm">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>User Name</th>
                                 <th>Wallet ID</th>
                                 <th>Points Collected</th>
                              </tr>
                           </thead>
                           <tbody>
                              @if(!empty($points))
                              <?php $count = 1;?>
                              @foreach ($points as $points)
                               @php
                                    $point = \App\Models\user_wallets::where('user_id',$points['user_id'])->first();
                                    $user = \App\Models\user_infos::where('user_id',$points['user_id'])->first();
                                @endphp
                                @if($user)
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$user->first_name}} {{$user->last_name}}</td>
                                <td class="text-capitalize">{{$points['wallet_id']}}</td>
                                <td class="text-capitalize">{{$points['available_points']}}</td>
                              </tr>
                              @endif
                              <?php $count = $count+1;?>
                               
                              @endforeach
                              @else
                              <tr>
                                <th>No points collected</th>
                              </tr>
                              @endif
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
        </div>
    </div>
@stop