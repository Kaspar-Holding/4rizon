@extends('layouts.app')
@section('pageTitle','Purchase Lists')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>Purchase Lists</h2>
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
                        <div class="row">
                            {{-- <div class="col-sm-9">
                                <h2>Purchase Lists</h2>
                            </div>       --}}
                        </div>
                     </div>
                  </div>
                  <div class="table_section padding_infor_info">
                     <div class="table-responsive-sm">
                        <table class="table table-striped" id = "myTable">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>User Name</th>
                                 <th>Item</th>
                                 <th>Quantity</th>
                                 <th>Coins</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $count = 1;?>
                              @foreach ($purchase_list as $purchase)
                              
                              @php
                              
                                    $item = \App\Models\Item::where('id',$purchase['item_id'])->first();
                                    $user = \App\Models\user_infos::where('user_id','=',$purchase['user_id'])->first();
                                  
                                @endphp
                                @if(!empty($user))
                              <tr>
                                 
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$user['first_name']}} {{$user['last_name']}}</td>
                                <td class="text-capitalize">{{$item->item_name}}</td>
                                <td class="text-capitalize">{{$purchase['quantity']}}</td>
                                <td class="text-capitalize">{{$purchase['item_price']}}</td> 
                                <td class="text-capitalize">@if($purchase['redeem_status'] == 0)Bought @else Recieved</td> @endif   
   
                                {{-- <td> 
                                    <a href="edit_survey/{{$survey['id']}}" class="btn btn-blue btn-sm btn-inverse btn-outline-success">
                                      <i class="fa fa-pencil"></i> 
                                    </a>
                                    @if( Auth::user()->role == "super admin")
                                    <a href="delete_survey/{{$survey['id']}}" class="btn btn-red btn-sm btn-inverse btn-outline-danger">
                                      <i class="fa fa-trash"></i> 
                                    </a>
                                    @endif
                                   
                                </td> --}}
                              </tr>
                              <?php $count = $count+1;?>
                              @endif
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