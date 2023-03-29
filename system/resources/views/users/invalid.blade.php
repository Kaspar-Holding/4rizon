@extends('layouts.app')
@section('pageTitle','In-Valid Users')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-9">
               <div class="page_title">
                  <h2>Invalid Users Lists</h2>
               </div>
            </div>
            <div class="col-md-3">
               <div style="margin-top:35px">
               <select name="users"   class="form-control users" required style="background: linear-gradient(255.43deg, rgba(50, 165, 249, 0.48) 0%, rgba(50, 165, 249, 0.16) 49.48%, rgba(27, 65, 107, 0.13) 100%) !important; color: aliceblue; ">
                    <option style = "color: aliceblue;" value="" active>Categories</option>
                 <option style = "color: black;" value = "{{route('users_list')}}">All</option>
                 <option style = "color: black;"  value="{{route('active_users')}}">Active</option>
                 <option style = "color: black;" value="{{route('inactive_users')}}">Pending</option>
                 <option style = "color: black;" value="{{route('denied_users')}}">Denied</option>
                 <option style = "color: black;" value="{{route('blocked_users')}}">Blocked</option>
               </select>
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
                                 <th>User ID</th>
                                 <th>First name</th>
                                 <th>Last name</th>
                                 <th>Email</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              @if(!empty($users_list))
                              <?php $count = 1;?>
                              @foreach ($users_list as $user)
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$user['user_id']}}</td>
                                <td class="text-capitalize">{{$user['first_name']}}</td>
                                <td class="text-capitalize">{{$user['last_name']}}</td>
                                <td class="text-capitalize">{{$user['email']}}</td>
                                <td class="text-capitalize">{{$user['user_status']}}</td>
                               
                              </tr>
                              
                              <?php $count = $count+1;?>
                              @endforeach
                              @else
                              <tr>
                                <th>No User Found</th>
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