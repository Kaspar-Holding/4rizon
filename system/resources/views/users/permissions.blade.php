@extends('layouts.app')
@section('pageTitle','Payment Methods')
@section('content')
  <div class="container-fluid" id="container-wrapper">
      <div class="row">
          <div class="col-xd-12 col-sm-10 ">
              <h2>Manager Permissions</h2><br>
          </div>
          <div>
              @include('flashmessages')
          </div>
      </div>      
      <form class="container-fluid" action="{{ route('edit_permissions')}}" method="post">
          @csrf
          <input type="hidden" name="id" value="{{ $permissions->id }}">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">Add</th>
                <th scope="col">View</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>
                  Car Management
                </th>
                <td>
                  <input type="checkbox" class="minimal" name="car_add" id="permission" class="minimal" value="1" @if($permissions->car_add == 1) checked @endif>
                </td>
                <td>
                  <input type="checkbox" class="minimal" name="car_show" id="permission" class="minimal" value="1" @if($permissions->car_show == 1) checked @endif>
                </td>
                <td>
                  <input type="checkbox" class="minimal" name="car_edit" id="permission" class="minimal" value="1" @if($permissions->car_edit == 1) checked @endif>
                </td>
                <td>
                  <input type="checkbox" class="minimal" name="car_delete" id="permission" class="minimal" value="1" @if($permissions->car_delete == 1) checked @endif>
                </td>
              </tr>
              <tr>
                <th>
                  Sale Management
                </th>
                <td>
                  <input type="checkbox" class="minimal" name="sale_add" id="permission" class="minimal" value="1" @if($permissions->sale_add == 1) checked @endif>
                </td>
                <td>
                  <input type="checkbox" class="minimal" name="sale_show" id="permission" class="minimal" value="1" @if($permissions->sale_show == 1) checked @endif>
                </td>
                <td>
                </td>
                <td>
                  <input type="checkbox" class="minimal" name="sale_delete" id="permission" class="minimal" value="1" @if($permissions->sale_delete == 1) checked @endif>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary link-light col-sm-4">Update</button>
          </div>
          <br>
      </form>
  </div>
@stop