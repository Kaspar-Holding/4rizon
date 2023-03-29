@extends('layouts.app')
@section('pageTitle','User Detail')
@section('content')
<style>
    h2{
        font-size: 24px !important;
    }
    h5{
        font-size : 14px !important;
        color:#d8dfe5!important; 
    }
    </style>
    @foreach ($users as $user)
    <div class="container-fluid">
        <div class="row column_title col-md-12">
            
               <div class="page_title col-md-10">
                  <h2>Artist Details</h2>
               </div>
               <div class="col-md-2" >
                <a href="../view_djadmin_details/{{$user['id']}}" style="margin-top:35px;" class="btn btn-inverse my-button btn-outline-primary">Artist Profile</a>
           
            </div>
        </div>
         <!-- row -->
        <div class="row p-3">
            <!-- table section -->
            <div class="col-md-12">
               <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head" style=" margin-bottom:30px !important;">
                         <div class="heading1 margin_0">
                            <div class = "alerti">
                                @include('flashmessages')
                            </div>
                            <h2>{{ $user['first_name'] }} {{$user['last_name']}}'s Response</h2>
                         </div>@endforeach
                    </div>
                    <div class="container-fluid">
        @foreach($dj_response as $artist_response)
                  
                        
                         <div class="">
                            <div class="col-12">
                                <p style="font-size: 17px !important; margin-left: 11px;color: #d8dfe5!important;"><b style="font-weight:600!important; font-size:16px!important; ">Q :</b>  {{ $artist_response->dj_questionnaire_question }}</p>
                            </div><br>
                            <div class="col-12">
                                <p style="font-size: 17px !important; margin-left: 11px;
                                color: #d8dfe5!important;"><b style="font-weight:600; font-size:16px;">A :</b>  {{ $artist_response->answer }}</p>
                            </div>
                        </div>

                
                        <br>
                        @endforeach
                            </div>

                   
                   
                </div>
            </div>
        </div>
    </div>
    
@stop