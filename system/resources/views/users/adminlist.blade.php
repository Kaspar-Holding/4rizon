@extends('layouts.app')
@section('pageTitle','Payment Methods')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>Admin Lists</h2>
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
                            <div class="col-md-9">
                                
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('add_new_user')}}" class="btn btn-inverse my-button btn-outline-primary">Add New User</a>
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
                                 <th>User ID</th>
                                 <th>Name</th>
                                 <th>Email</th>
                                 <th>Role</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $count = 1;?>
                              @foreach ($users_list as $user)
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$user['id']}}</td>
                                <td class="text-capitalize">{{$user['name']}}</td>
                                <td class="text-capitalize">{{$user['email']}}</td>
                                <td class="text-capitalize">
                                    @if($user->role == "super admin")
                                        Super Admin
                                    @elseif($user->role == "admin")
                                        Admin
                                         @else
                                        General Admin
                                    @endif
                                </td>
                                <td>
                                    <a href="edit_admin_details/{{$user['id']}}" class="btn btn-sm btn-blue  btn-inverse btn-outline-primary">
                                         <i class="fa fa-pencil"></i> 
                                    </a>
                                    @if( Auth::user()->role == "super admin")
                                    <a style="margin: 2px;" style="margin: 2px;"   href="#" 
                                    data-id={{$user['id']}} 
                                    data-toggle="modal" 
                                    data-target="#deleteModal" class="btn btn-sm btn-red btn-inverse btn-outline-danger del"><i class="fa fa-trash"></i></a>
                                    @endif
                                   
                                </td>
                              </tr>
                              <?php $count = $count+1;?>
                              @endforeach
                           </tbody>
                        </table>
                        <div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color:black !important;" id="exampleModalLabel">Delete User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{ route('admin_delete') }}" method="post">
                                        @csrf
                                        
                                        <input id="id" name="id" hidden>
                                        <h5 class="text-center" style="color:black !important;">Are you sure you want to delete this user?</h5>
                                      
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>            
        </div>
    </div>
@stop