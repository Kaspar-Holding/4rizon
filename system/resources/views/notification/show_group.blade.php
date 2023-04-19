@extends('layouts.app')
@section('pageTitle','Notification Lists')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-7">
               <div class="page_title">
                  <h2>Groups</h2>
               </div>
            </div>
            
               <div class="col-md-5"  style="margin-top: 40px;">
                  {{-- <a href="{{ route('notif_list') }}" class="btn btn-inverse my-button btn-outline-primary">All Notifications</a>
                  @if( Auth::user()->role == "super admin" || Auth::user()->role == "general admin"  )
                  <a href="{{ route('create_group') }}" class="btn btn-inverse my-button btn-outline-primary">Create Group</a> --}}
                  {{-- <a href="{{ route('show_group') }}" class="btn btn-inverse my-button btn-outline-primary">Show Group</a> --}}
                  {{-- @endif --}}
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
                                {{-- <h2>Notification Lists</h2> --}}
                            </div>
                            <div class="col-md-3">
                                {{-- <a href="{{ route('add_admin_msg')}}" class="btn my-button btn-inverse btn-outline-primary">Create Notification</a> --}}
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
                                 <th>Group Name</th>
                                 <th>User Name</th>           
                              </tr>
                           </thead>
                           <tbody>

                            @php $count = 1; @endphp
                            @php 
                                $group = App\Models\UserGroup::groupBy('group_name')->get();  
                            @endphp

                            @foreach($group as $user)
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>;
                                <td class="text-capitalize">{{$user['group_name'] ?? ''}}</td>
                                @php 
                                $name = App\Models\user_infos::where('user_id',$user['user_id'])->first(); 
                               
                                @endphp
                                <td class="text-capitalize"><a style="margin: 2px;" href="view_group/{{$user['group_name']}}" class="btn check-icon btn-sm btn-inverse btn-outline-primary">
                                 <i class="fa fa-eye" aria-hidden="true"></i>
                                 </a></td>
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