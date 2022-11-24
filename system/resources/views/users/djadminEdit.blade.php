@extends('layouts.app')
@section('pageTitle','Edit Admin Settings')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Edit DJ User</h2>
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
              <form class="container-fluid" action="{{route('update_djadmin_user')}}" method="POST" style="padding:30px; padding-bottom:40px;">
                @csrf
                <div>
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" >
                    <input type="hidden" name="id" class="form-control" value="{{ $user->id }}" >
                  </div>
                  <br>
                <div>
                  <label class="form-label">Last Name</label>
                  <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" >
                  <input type="hidden" name="id" class="form-control" value="{{ $user->id }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Email</label>
                  <input type="email" name="user_email" class="form-control" value="{{ $user->email }}" >
                </div>
                <br>
                <div>
                    <label class="form-label">Phone Number</label>
                    <input type="text" pattern="^\+[1-9]{1}[0-9]{3,14}$" name="phone_number" class="form-control" value="{{ $user->phone_number }}" >
                  </div>
                  <br>
                <div>
                  <label class="form-label">Change Password</label>
                  <input type="password" id="upass" name="user_password" class="form-control">
                  <i class="fa fa-eye btn icon-control" style="color:black; cursor:pointer;position: relative;
    left: 79rem;
    bottom: 2rem;" id="toggleBtn" onclick="toggePassword()"></i>
                </div>
                <br>
                <div>
                  <label class="form-label">DJ Status</label>
                  <select name="dj_status" class="form-control" required>
                    <option>Select Status</option>
                    <option value="1" @if($user['dj_status'] == '1') selected @endif>Approved</option>
                    <option value="0" @if($user['dj_status'] == '0') selected @endif>Not Approved</option>
                  </select>
                </div>
                @if ( $user->identification_type == 1)
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2>DHA Detail</h2>
                                </div>
                            </div>               
                          @if (($dj_dha_profile))
                          
                              @if ($dj_dha_profile->dha_api_status == -1)
                                  <div class="row p-3">
                                      <div class="col-6">
                                          <h5>Status:</h5>
                                      </div>
                                      <div class="col-6">
                                          <h5>Invalid credentials</h5>
                                          {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $user->first_name }}" disabled> --}}
                                      </div>
                                  </div>
                              @else 
                                  <div class="row p-3">
                                      <div class="col-6">
                                          <h5>Name:</h5>
                                      </div>
                                      <div class="col-6">
                                          <h5>{{ $dj_dha_profile->personName }} {{ $dj_dha_profile->personSurname }}</h5>
                                          {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $user->first_name }}" disabled> --}}
                                      </div>
                                  </div>
                                  <div class="row p-3">
                                      <div class="col-6">
                                          <h5>Gender:</h5>
                                      </div>
                                      <div class="col-6">
                                          <h5>{{ $dj_dha_profile->gender }}</h5>
                                          {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $user->first_name }}" disabled> --}}
                                      </div>
                                  </div>
                                  <div class="row p-3">
                                      <div class="col-6">
                                          <h5>Date of Birth:</h5>
                                      </div>
                                      <div class="col-6">
                                          <h5>{{ $dj_dha_profile->dateOfBirth }}</h5>
                                          {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $user->first_name }}" disabled> --}}
                                      </div>
                                  </div>
                                  <div class="row p-3">
                                      <div class="col-6">
                                          <h5>Status:</h5>
                                      </div>
                                      <div class="col-6">
                                          <h5>{{ $dj_dha_profile->aliveStatus }}</h5>
                                          {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $user->first_name }}" disabled> --}}
                                      </div>
                                  </div>
                                  <div class="row p-3">
                                     
                                      <div class="col-6">
                                        
                                          <h5>
                                          </h5>
                                          {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $user->first_name }}" disabled> --}}
                                      </div>
                                  </div>
                              @endif
                          @else
                              <div class="row p-3">
                                  <div class="col-12">
                                      <div class="d-flex justify-content-center">
                                          <a href="{{route('fetch_dj_dha_profile',$user->id)}}" type="submit" class="btn btn-primary link-light col-sm-4">Fetch DHA Information</a>
                                      </div>
                                  </div>
                              </div>
                              
                              <hr>
                          @endif
                      @endif
                <br>
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