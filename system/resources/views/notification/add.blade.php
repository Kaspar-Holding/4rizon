@extends('layouts.app')
@section('pageTitle','Add Notification')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Create Notification</h2>
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
              <form class="container-fluid" action="{{ route('create_admin_msg')}}" method="POST" enctype="multipart/form-data" style="padding-bottom:40px; padding:30px;">
                @csrf
                <div>
                  <label class="form-label">Notification</label>
                  <input type="text" name="admin_msg" class="form-control" required >
                </div>
                <br>
                <div class="row" style="padding-top:10px; padding-left:30px;">
                  <button type="submit" class=" col-md-2 btn btn-primary my-button link-light col-sm-4">Create</button>
                </div>
              </form>
              <form class="container-fluid" action="create_dj_admin_msg" method="POST" enctype="multipart/form-data" style="padding-bottom:40px; padding:30px;">
                @csrf
                <div>
                  <label class="form-label">DJ Notifications</label>
                  <input type="text" name="admin_msg" class="form-control">
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