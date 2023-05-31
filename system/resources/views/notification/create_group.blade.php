@extends('layouts.app')
@section('pageTitle','Add Notification')
@section('content')
<style>
  
  
  
  .select2-container--default .select2-selection--multiple{
  background-color: rgba(13, 45, 80, 1) !important;
 }
  .select2-results__options[aria-multiselectable="true"] li {
  padding-left: 30px;
  position: relative
}

.select2-results__options[aria-multiselectable="true"] li:before {
  position: absolute;
  left: 8px;
  opacity: .6;
  top: 6px;
  font-family: "FontAwesome";
  content: "\f0c8";
}

.select2-results__options[aria-multiselectable="true"] li[aria-selected="true"]:before {
  content: "\f14a";
}
.select2-container--default .select2-results__option[aria-selected=true] {
  background-color: rgba(13, 45, 80, 1) !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
  background-color: black !important;
  color : white !important;
}
.select2-container--default .select2-selection--multiple{
  background-color: rgba(13, 45, 80, 1);
  border-radius: 9.6px;
}
/* not required css */

.row
{
padding: 10px;
}
</style>
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-8">
            <div class="page_title">
              <h2>Create Group</h2>
            </div>
          </div>
          <div class="col-md-4"  style="margin-top: 40px;">
            <a href="{{ route('notif_list') }}" class="btn btn-inverse my-button btn-outline-primary">All Notifications</a>
            <a href="{{ route('create_group') }}" class="btn btn-inverse my-button btn-outline-primary">Create Group</a>
        </div>
        </div>
         <!-- row -->
        <div class="row">
            <!-- table section -->
          <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
              <div class="full graph_head">
                <div class="col-md-12">
                    <div class="page_title">
                      <h2>User Group</h2>
                    </div>
                  </div>
              </div>
              <form class="container-fluid" action="{{ route('create_admin_group')}}" method="POST" enctype="multipart/form-data" style="padding-bottom:20px; padding:30px;">
                @csrf
                <div class="row" style="margin-top:10px;">
                        <div class="col-md-6">
                        <label class="form-label">Group Name</label>
                        <input type="text" name="group_name" class="form-control" required >
                        </div>
                        
                        <div class="col-md-6">
                        <label class="form-label">User List</label>
                        <select name="user[]" id="cars" multiple class="form-control select2" required >
                            <option> Select Users </option>
                            @foreach($users as $user)
                            <option value="{{$user['user_id']}}">{{$user['first_name']}} {{$user['last_name']}}</option>
                            @endforeach
                        </select>
                        </div>
                </div>
                <br>
                <div class="row" style="padding-top:10px; padding-left:30px;">
                  <button type="submit" class=" col-md-2 btn btn-primary my-button link-light col-sm-4">Create</button>
                </div>
              </form>
              
                <div class="page_title">
                  <h2 style="padding-left: 35px;">Artist Group</h2>
                </div>
              
              <form class="container-fluid" action="{{ route('create_dj_admin_group')}}" method="POST" enctype="multipart/form-data" style="padding-bottom:40px; padding-left:30px; padding-right:30px;">
                @csrf
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-6">
                    <label class="form-label">Group Name</label>
                    <input type="text" name="group_name" class="form-control" required >
                    </div>
                    
                    <div class="col-md-6">
                    <label class="form-label">Artist List</label>
                    <select name="user[]" id="cars" multiple="multiple"  class="form-control select2" required >
                        <option> Select Users </option>
                        @foreach($djusers as $djuser)
                        <option value="{{$djuser['id']}}">{{$djuser['first_name']}} {{$djuser['last_name']}}</option>
                        @endforeach
                    </select>
                    </div>
            </div>
                <br>
                <div class="row" style="padding-top:10px; padding-left:30px;">
                  <button type="submit" class=" col-md-2 btn btn-primary my-button link-light col-sm-4">Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop