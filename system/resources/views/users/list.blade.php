@extends('layouts.app')
@section('pageTitle','Payment Methods')
@section('content')
<style>
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 11px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: aliceblue !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_pag{
        color: aliceblue !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: aliceblue !important;
    }
    </style>
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-9">
               <div class="page_title">
                  <h2>Users Lists</h2>
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
                    <div class = "alerti">
                        @include('flashmessages')
                    </div>
                  <div class="full graph_head" style="margin-bottom:20px !important;">
                     <div class="heading1 margin_0">
                        <form class="container-fluid" action="{{route('multiple_delete')}}" method="POST" enctype="multipart/form-data" style="padding:30px;">
                            @csrf
                         <div class="row">
                            <div class="col-md-7">
                                <h2>Users</h2>
                            </div>
                            <div class="col-md-5">
                                <a href="{{ route('register_new_user') }}" class="btn btn-inverse my-button btn-outline-primary">Register New User</a>
                            {{-- </div>
                            <div class = "col-md-2"> --}}
                                @if( Auth::user()->role == "super admin")
                                <span data-href="/export-csv" id="export" class="btn btn-inverse my-button btn-outline-primary" onclick ="exportTasks (event.target);">Export</span>
                                <div id = "btn_multidelete1" class="btn btn-inverse my-button btn-outline-primary" data-toggle="modal" data-target="#multiconfirm-modal1" style="margin-left: 0px; display:none">Delete
                                </div>
                                <i style="color:white;font-size: 27px;
                                position: relative;
                                top: 8px;
                                left: 8px;" class="fa fa-bars" onclick="selectAl()"></i>
                                
                                @endif
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
                                 <th>Action</th>
                                 <th>Status</th>
                                 <th>Status</th>
                                 <th>First name</th>
                                 <th>Last name</th>
                                 <th>Email</th>
                                 <th>Age</th>
                                 <th>identification No</th>
                                 {{-- <th>Role</th> --}}
                                 <th>Citizenship</th>
                                 {{-- <th>Gender</th> --}}
                                 <th>Register at</th>
                                 <th id="multipleHead" style="display:none;">Select All &nbsp;<input type="checkbox" id="deleteAll"  /></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $count = 1;?>
                              @foreach ($users_list as $user)
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class = "row">
                                    <a style="margin: 2px;" href="view_user_details/{{$user['user_id']}}" class="btn check-icon btn-sm btn-inverse btn-outline-primary">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    @if( Auth::user()->role == "super admin")
                                    <a style="margin: 2px;" href="edit_user_details/{{$user['user_id']}}" class="btn btn-sm btn-blue  btn-inverse btn-outline-primary">
                                        <i class="fa fa-pencil"></i> 
                                   </a>
                                   @endif
                                   @if( Auth::user()->role == "super admin")
                                   <a style="margin: 2px;" style="margin: 2px;" href="delete_user_details/{{$user['user_id']}}" class="btn btn-sm btn-red btn-inverse btn-outline-danger"><i class="fa fa-trash"></i></a>
                                   @endif
                                   
                                </td>  
                                <td class="text-capitalize">
                                    @if ($user['user_status'] == "0")
                                    <a style="color:#fcfbff; font-size:xx-large; margin-top:-12px;"  class="btn btn-sm btn-green"><i class="fa fa-question" style="width:25px;"></i></a>
                                    @elseif ($user['user_status'] == "1")
                                    <a style="color: lawngreen; font-size:xx-large;  margin-top:-12px;" class="btn btn-sm btn-green"><i class="fa fa-check" style="width:25px;"></i></a>
                                    @elseif ($user['user_status'] == "3")
                                    <a style="color :red; font-size:xx-large;  margin-top:-12px;" class="btn btn-sm btn-green"><i class="fa fa-times" style="width:25px;"></i></a>
                                    @elseif ($user['user_status'] == "-1")
                                    <a style="color: red;  font-size:xx-large;  margin-top:-12px;" class="btn btn-sm btn-green"><i class="fa fa-ban" style="width:25px;"></i></a>
                                    @endif
                                </td>  
                                 <td class="text-capitalize">
                                    @if ($user['identification_type'] == 0)
                                    Incomplete Profile
                                @elseif ($user['user_status'] == "0")
                                    Pending
                                @elseif ($user['user_status'] == "1")
                                    Active
                                @elseif ($user['user_status'] == "3")
                                   Invalid Id
                                @elseif ($user['user_status'] == "-1")
                                    Blocked
                                @endif
                            </td>                              
                                <td class="text-capitalize">{{$user['first_name']}}</td>
                                <td class="text-capitalize">{{$user['last_name']}}</td>
                                <td class="text-capitalize">{{$user['email']}}</td>
                                @php
                                $dateOfBirth = $user['dob'];
                                
                                    $today = date("Y-m-d");
                                    $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                    $age = $diff->format('%y');
                                @endphp
                                <td class="text-capitalize">{{$age}} years</td>
                                <td class="text-capitalize">{{$user['identification_num']}}</td>
                                {{-- <td class="text-capitalize">{{$user['role']}}</td> --}}
                                <td class="text-capitalize">
                                    @if($user['identification_type'] == 0 ) NIL
                                    @elseif($user['nationality'] == "SA" || $user['nationality'] == "South Africa" || $user['identification_type'] == 1 ) SA
                                @else Not SA @endif</td>
                                {{-- <td class="text-capitalize">{{$user['gender']}}</td> --}}
                                @php
                                $register = strtotime($user['created_at']);
                                   $date = date('m/d/y',$register) ;
                                @endphp
                                <td class="text-capitalize">{{$user['created_at']}}</td>
                               
                                <td class="multipleSelectBox" style="display:none;">
                                    <input type = "checkbox" id = "example1" class="record1" name = "checkbox[]" value="{{$user['user_id']}}"></td>
                                       
                              </tr>
                              <?php $count = $count+1;?>
                              @endforeach
                           </tbody>
                           <div class="modal fade" id="multiconfirm-modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                               <div class="modal-content" style = "background_color : #0a1022">
                                  <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete Users</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                  </button>
                                  </div>
                                  <div class="modal-body">
                                     <div class="row">
                                           <!-- table section -->
                                     <div class="col-md-12">
                                           <p>Are you sure?</p>
                                           {{-- <input type = "text" name = "checkbox[]" id = "checkbox"> --}}
                                   
                                     </div>
                                     <div class="modal-footer">
                                        {{-- <form> --}}
                                           {{-- @csrf --}}
                                           <input name="pass_checkedvalue" type="hidden" id="hidden_checkedinput1">
                                           <input class="btn btn-secondary" type="submit" name="submit_button" value="Delete">
                                        {{-- </form> --}}
                                     </div>
                                     </form>
                                     </div>
                               </div>
                            </div>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
        </div>
    </div>
@stop