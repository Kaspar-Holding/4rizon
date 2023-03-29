@extends('layouts.app')
@section('pageTitle','Register User')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Register User</h2>
            </div>
          </div>
        </div>
         <!-- row -->
        <div class="row">
            <!-- table section -->
          <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
              <form class="container-fluid form" action="{{ route('save_user')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row" >
                  <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" required >
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" required >
                  </div>
                </div>
                <div class="row" style="margin-top:10px;">
                  <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="text" name="password" class="form-control" required >
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required >
                  </div>
                </div>
                <div class="row"style="margin-top:10px;" >
                  <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input type="text" pattern="[-+]?\d*" name="phone_number" class="form-control" required >
                  </div>
                
                </div>
                <div class="row"style="margin-top:10px;" >
                  <div class="col-md-6">
                    <label class="form-label">Identification Type: </label>
                    <select name="identification_type" id="cars"  class="form-control" required >
                      <option value="1">South African ID</option>
                      <option value="2">Passport</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Identification Number</label>
                    <input type="text" name="identification_num" class="form-control" required >
                  </div>
                </div>
                <div class="row" style="margin-top:10px;">
                  <div class="col-md-6">
                    <label class="form-label">Dob</label>
                    <input type="date" name="dob" class="form-control" required >
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Nationality</label>
                    <input type="text" name="nationality" class="form-control" required >
                    {{-- <select class="form-control countrypicker" name="nationality" data-flag="true"></select> --}}
                  </div>
                </div>
                <div class="row" style="margin-top:10px;">
                  <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <select name="gender" id="cars"  class="form-control" required >
                    <option value="">Select</option>

                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="Rather Not Say">Rather Not Say</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Picture</label>
                    <input type="file" name="picture" class="form-control" required >
                  </div>
                  </div>
                <div class="row" style="margin-top:20px;">
                  <button type="submit" class="btn btn-primary my-button link-light col-sm-2">Submit</button>
                </div>
                <div class="d-flex justify-content-center"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop