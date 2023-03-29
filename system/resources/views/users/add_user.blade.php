@extends('layouts.app')
@section('pageTitle','Payment Methods')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Add User</h2>
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
                  <h2></h2>
                </div>
              </div>
              <form class="container-fluid" action="{{ route('add_user')}}" method="POST" style="padding:30px; padding-bottom:40px;">
                @csrf
                <div>
                  <label class="form-label">Name</label>
                  <input type="text" name="name" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">Email</label>
                  <input type="email" name="user_email" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">Password</label>
                  <input type="password" name="user_password" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">User Role</label>
                  <select name="user_role" class="form-control" required>
                    <option>-- Select --</option>
                    <option value="super admin">Super Admin</option>
                    <option value="admin">Admin</option>
                      <option value="general admin">General Admin</option>
                  </select>
                </div>
                <br>
                <div class="row" style="padding-top:10px; padding-left:30px;">
                  <button type="submit" class="btn col-md-2 my-button btn-primary link-light col-sm-4">Create</button>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop