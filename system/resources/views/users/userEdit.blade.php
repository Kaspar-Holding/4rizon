@extends('layouts.app')
@section('pageTitle','Edit Admin Settings')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Edit User</h2>
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
              <form class="container-fluid" action="{{route('update_user_db')}}" enctype="multipart/form-data" method="POST" style="padding:30px; padding-bottom:40px;">
                @csrf
                
                <div>
                  
                    <label class="form-label">First Name</label>
                    @foreach($user as $users)
                    <input type="text" name="first_name" class="form-control" value="{{ $users->first_name }}" >
                    <input type="hidden" name="id" class="form-control" value="{{ $users->user_id }}" >
                    
                  </div>
                  <br>
                <div>
                  <label class="form-label">Last Name</label>
                  <input type="text" name="last_name" class="form-control" value="{{ $users->last_name }}" >
                </div>
                <br>
                <div>
                    <label class="form-label">Gender</label>
                    <input type="text" name="user_gender" class="form-control" value="{{ $users->gender }}" >
                  </div>
                  <br>
                <div>
                  <label class="form-label">Email</label>
                  <input type="email" name="user_email" class="form-control" value="{{ $users->email }}" >
                </div>
                <br>
                <div>
                    <label class="form-label">Phone Number</label>
                    <input type="text" pattern="[-+]?\d*" name="phone_number" class="form-control" value="{{ $users->phone_number }}" >
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
                  <label class="form-label">Nationality</label>
                  <input type="text" name="nationality" class="form-control" value="{{ $users->nationality }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Identification Type</label>
                  <select name="identification_type"   class="form-control" required >
                    <option value = "{{$users->identification_type}}"> @if ($users->identification_type == 1)South African ID
                        
                    @else
                        Passport
                    @endif </option>
                    
                    <option value="1">South African ID</option>
                    <option value="2">Passport</option>
                    
                  </select>
                </div>
                <br>
                <div>
                  <label class="form-label">Identification Number</label>
                  <input type="text" name="identification_number" class="form-control" value=" {{$users->identification_num}}
                  ">
                </div>
                <br>
                    <input type="text" name="picture" class="form-control" value = "{{$users->picture}}" hidden>
                    @if($users->picture != "")
                <div>
                  <label class="form-label">Image</label>
              
                  <img src="{{asset('image/'.$users->picture)}}" style="width: 20%;">
                </div>
                <br>@endif
                <div>
                  <label class="form-label">Change  Image</label>
                  <input type="file" name="user_image" class="form-control">
                </div>
                <br>
                <div>
                  <label class="form-label">User Status</label>
                  <select name="user_status" class="form-control" required>
                    <option value = "{{$users->user_status}}">Select Status</option>
                    <option value="-1" @if($users->user_status == '-1') selected @endif>Blocked</option>
                    @if($users->user_status == '-1')
                    <option value="0">Unblock</option>@endif
                  </select>
                </div>
                <br>
                <div>
                  <label class="form-label">Add coins</label>
                  <input type="text" name="points" class="form-control" >
                </div>
                <br>
                @if ( $users->identification_type == 1)
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2>DHA Detail</h2>
                                </div>
                            </div>               
                          @if (($dha_profile))
                          
                              @if ($dha_profile->dha_api_status == -1)
                                  <div class="row p-3">
                                      <div class="col-6">
                                          <h5>Status:</h5>
                                      </div>
                                      <div class="col-6">
                                          <h5>Invalid credentials</h5>
                                          {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $users->first_name }}" disabled> --}}
                                      </div>
                                  </div>
                              @else 
                                  <div class="row p-3">
                                      <div class="col-6">
                                          <h5>Name:</h5>
                                      </div>
                                      <div class="col-6">
                                          <h5>{{ $dha_profile->personName }} {{ $dha_profile->personSurname }}</h5>
                                          {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $users->first_name }}" disabled> --}}
                                      </div>
                                  </div>
                                  <div class="row p-3">
                                      <div class="col-6">
                                          <h5>Gender:</h5>
                                      </div>
                                      <div class="col-6">
                                          <h5>{{ $dha_profile->gender }}</h5>
                                          {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $users->first_name }}" disabled> --}}
                                      </div>
                                  </div>
                                  <div class="row p-3">
                                      <div class="col-6">
                                          <h5>Date of Birth:</h5>
                                      </div>
                                      <div class="col-6">
                                          <h5>{{ $dha_profile->dateOfBirth }}</h5>
                                          {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $users->first_name }}" disabled> --}}
                                      </div>
                                  </div>
                                  <div class="row p-3">
                                      <div class="col-6">
                                          <h5>Status:</h5>
                                      </div>
                                      <div class="col-6">
                                          <h5>{{ $dha_profile->aliveStatus }}</h5>
                                          {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $users->first_name }}" disabled> --}}
                                      </div>
                                  </div>
                                  <div class="row p-3">
                                     
                                      <div class="col-6">
                                        
                                          <h5>
                                          </h5>
                                          {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $users->first_name }}" disabled> --}}
                                      </div>
                                  </div>
                              @endif
                          @else
                              <div class="row p-3">
                                  <div class="col-12">
                                      <div class="d-flex justify-content-center">
                                          <a href="{{route('fetch_dha_profile',$users->user_id)}}" type="submit" class="btn btn-primary link-light col-sm-4">Fetch DHA Information</a>
                                      </div>
                                  </div>
                              </div>
                              
                              <hr>
                          @endif
                      @endif
                      @endforeach
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