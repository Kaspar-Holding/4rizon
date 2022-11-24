@extends('layouts.app')
@section('pageTitle','Edit Admin Settings')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Edit Admin User</h2>
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
              <form class="container-fluid" action="{{ route('update_admin_user')}}" method="POST" style="padding:30px; padding-bottom:40px;">
                @csrf
                <div>
                  <label class="form-label">Name</label>
                  <input type="text" name="name" class="form-control" value="{{ $user->name }}" >
                  <input type="hidden" name="id" class="form-control" value="{{ $user->id }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Email</label>
                  <input type="email" name="user_email" class="form-control" value="{{ $user->email }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Change Password</label>
                  <input type="password" name="user_password" class="form-control">
                </div>
                <br>
                <div>
                    <label class="form-label">User Role</label>
                    <select name="user_role" class="form-control" required>
                        <option>-- Select --</option>
                        <option value="admin" @if($user['role'] == 'admin') selected @endif>Super Admin</option>
                        <option value="manager" @if($user['role'] == 'manager') selected @endif>Admin</option>
                    </select>
                </div>
                <br>
                <div class="row" style="padding-left:30px; padding-top:10px;">
                  <button type="submit" class="btn my-button col-md-2 btn-primary link-light col-sm-4">Update</button>
                </div>
                <div class="d-flex justify-content-center"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop