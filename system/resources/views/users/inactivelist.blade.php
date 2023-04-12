@extends('layouts.app')
@section('pageTitle','In-Active Users')
@section('content')
<style>
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 11px !important;
    }
    </style>
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-9">
               <div class="page_title">
                  <h2>Pending Users Lists</h2>
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
                  <div class = "alertii">
                     @include('flashmessages')
                  </div>
                  <div class="full graph_head">
                     <div class="heading1 margin_0"> 
                     </div>
                  </div>
               <form class="container-fluid" action="{{route('multiple_approve')}}" method="POST" enctype="multipart/form-data" style="padding:30px;">
                     @csrf
                  
                     <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-2">
                           <div id = "btn_multidelete" class="btn btn-inverse my-button btn-outline-primary" data-toggle="modal" data-target="#multiconfirm-modal" style="
                           margin-left: 0px;">Verify and Approve
                           </div>
                        </div>
                        <div class="col-md-2">
                           <!-- Button trigger modal -->
                           {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                           Launch demo modal
                           </button>  --}}
                           <!-- Modal -->
                           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">User Status</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <h3>
                                          Approved Users : {{$approved ?? ''}}
                                       </h3>
                                       <br>
                                       <h3>
                                          Denied Users Users : {{$denied ?? ''}}
                                       </h3>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                       {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  <div class="table_section padding_infor_info">
                     <div class="table-responsive-sm">
                        <table class="table table-striped" id = "myTable">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>User ID</th>
                                 <th>First name</th>
                                 <th>Last name</th>
                                 <th>Email</th>
                                 <th>Register at</th>
                                 <th>Status</th>
                               
                                 <th>Select All &nbsp;<input type="checkbox" id="selectAll" /></th>
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
                                <td class="text-capitalize">{{$user['created_at']}}</td>
                                @if($user->user_status == 0)  
                                <td class="text-capitalize">Pending</td>
                                @elseif($user->user_status == 3)
                                <td class="text-capitalize">Denied<br>Invalid Id</td>
                               @endif
                                <td>
                                 <input type = "checkbox" id = "example" class="record" name = "checkbox[]" value="{{$user['user_id']}}"></td>
                                    
                                   
                                
                              </tr>
                              
                              <?php $count = $count+1;?>
                              @endforeach
                              
                              @else
                              <tr>
                                <th>No User Found</th>
                              </tr>
                              @endif
                           </tbody>
                           <div class="modal fade" id="multiconfirm-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content" style = "background_color : #0a1022">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Verify Users</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="row">
                                             <!-- table section -->
                                       <div class="col-md-12">
                                             <p>If you would like to proceed to verify and approve selected users click OK</p>
                                             {{-- <input type = "text" name = "checkbox[]" id = "checkbox"> --}}
                                     
                                       </div>
                                       <div class="modal-footer">
                                          {{-- <form> --}}
                                             {{-- @csrf --}}
                                             <input name="pass_checkedvalue" type="hidden" id="hidden_checkedinput">
                                             <input class="btn btn-secondary" type="submit" name="submit_button" value="OK">
                                          {{-- </form> --}}
                                       </div>
                                       </form>
                                       </div>
                                 </div>
                              </div>
                        </table>
                       
                     </div>
                  </div>
               </form>
            </div>
         </div>            
      </div>
   </div>
   
@stop