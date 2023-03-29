@extends('layouts.app')
@section('pageTitle','Register Dj User')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title"> 
              <h2>Register DJ User</h2>
            </div>
          </div>
        </div>
         <!-- row -->
        <div class="row">
            <!-- table section -->
          <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
              <form class="container-fluid form" action="{{route('save_djuser')}}" method="POST" enctype="multipart/form-data">
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
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required >
                    </div>
                  <div class="col-md-6">
                      <label class="form-label">Password</label>
                      <input type="password" id="upass" name="password" class="form-control">
                      <i class="fa fa-eye btn icon-control" style="color:black; cursor:pointer;position: relative;
                      left: 38rem;
                      bottom: 29px;" id="toggleBtn" onclick="toggePassword()"></i>
                  </div>
              
                </div>
                <div class="row"style="margin-top:10px;" >
                  <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input type="text" pattern="[-+]?\d*"   name="phone_number" class="form-control" required >
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Picture</label>
                    <input type="file" name="picture" class="form-control" required >
                  </div>
                </div>
                <div class="row"style="margin-top:10px;" >
                  <div class="col-md-6">
                    <label class="form-label">Music Genre </label>
                    
                    <select name="music_genre" id="music_genre"  class="form-control" required >
                    @foreach($genre as $genres)
                      <option value="{{$genres->id}}">{{$genres->music_genre}}</option>
                      @endforeach
                    </select>
                    
                  </div>
                </div>
                <div class="row"style="margin-top:10px;" >
                  <div class="col-md-6">
                    <label class="form-label">Sub Genre </label>
                    <select name="sub_genre" id="sub_genre"  class="form-control" required >
                    @foreach($sub_genre as $sub_genres)
                      <option value="{{$sub_genres->id}}">{{$sub_genres->sub_genre}}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <div class="row" style="margin-top:10px;">
                  <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <select name="gender" id="cars"  class="form-control" Value = "Select" required >
                    <option value="">Select</option>

                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="Rather Not Say">Rather Not Say</option>

                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Representation</label>
                    <select name="representation" id="cars"  class="form-control" required >
                      <option value="individual">Individual</option>
                      {{-- <option value="female">Female</option> --}}
                    </select>
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
    <script>
      function toggePassword() {
          var upass = document.getElementById('upass');
          var toggleBtn = document.getElementById('toggleBtn');
          if (upass.type == "password") {
              upass.type = "text";
              toggleBtn.value = "Hide password";
          } else {
              upass.type = "Password";
              toggleBtn.value = "Show the password";
          }
      }

  </script>
@stop