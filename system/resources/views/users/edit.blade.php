@extends('layouts.app')
@section('pageTitle','Payment Methods')
@section('content')
    @foreach ($users as $user)
    <div class="container-fluid" id="container-wrapper">
        <div class="row">
            <div class="col-xd-12 col-sm-10 ">
                <h2>{{ $user['name'] }} Edit Details</h2><br>
            </div>
        </div>      
        <form class="container-fluid" action="{{ route('edit_user')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-6">
                    <h5>Name:</h5>
                </div>
                <div class="col-6">
                    <input type="text" class="form-control h5" name="user_name" value="{{ $user['name'] }}" id="">
                    <input type="hidden" name="id" value="{{ $user['id'] }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <h5>Email:</h5>
                </div>
                <div class="col-6">
                    <input type="email"  class="form-control h5" name="user_email" value="{{ $user['email'] }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <h5>Change Password:</h5>
                </div>
                <div class="col-6">
                    <input type="password" class="form-control h5" name="user_password" id="">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <h5>Role:</h5>
                </div>
                <div class="col-6">
                    <select name="user_role" class="form-control" required>
                        <option>-- Select --</option>
                        <option value="admin" @if($user['role'] == 'admin') selected @endif>Admin</option>
                        <option value="manager" @if($user['role'] == 'manager') selected @endif>Manager</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary link-light col-sm-4">Update</button>
            </div>
            <br>
        </form>
    </div>
    @endforeach
@stop