@extends('layouts.app')
@section('pageTitle','Payment Methods')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="container-fluid card card-b">
        <div class="row pad">
            <div class="col-xd-12 col-sm-7">
                <h3>Users Lists</h3><br>
            </div> 
            <div class = "alerti">
                @include('flashmessages')
            </div>
        </div>
       
        <div class="table-responsive" style="padding:10px 0px;">
            <table class="table table-striped">
                <thead>
                  <tr class="a-table"style="background-color:rgb(240 243 255 / 30%);">
                    <th style="border:none;" class="a-table" scope="col">#</th>
                    <th style="border:none;" class="a-table" scope="col">User ID</th>
                    <th style="border:none;" class="a-table" scope="col">First name</th>
                    <th style="border:none;" class="a-table"scope="col">Last name</th>
                    <th style="border:none;"  class="a-table" scope="col">Email</th>
                    <th style="border:none;"  class="a-table" scope="col">Status</th>
                    <!-- <th scope="col">Status</th> -->
                    <th  style="border:none;" class="a-table" scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $count = 1;?>
                  @foreach ($users_list as $user)
                  <tr>
                    <td class="text-capitalize">{{$count}}</td>
                    <td class="text-capitalize">{{$user['user_id']}}</td>
                    <td class="text-capitalize">{{$user['first_name']}}</td>
                    <td class="text-capitalize">{{$user['last_name']}}</td>
                    <td class="text-capitalize">{{$user['email']}}</td>
                    <td class="text-capitalize">{{$user['user_status']}}</td>
                   
                    <td>
                        <a href="view_user_details
                        s/{{$user['id']}}" class="btn btn-sm btn-inverse btn-outline-primary">
                          Approve  
                        </a>
                       
                    </td>
                  </tr>
                  <?php $count = $count+1;?>
                  @endforeach
                </tbody>
            </table>
           
        </div>
    </div>
</div>
@stop