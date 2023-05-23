@extends('layouts.app')
@section('pageTitle','In-Active Users')
@section('content')
<style>
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 11px !important;
    }
    </style>
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-8">
               <div class="page_title">
                  <h2>Artist Lists</h2>
               </div>
            </div>
            <div class="col-md-4">
               <div style="margin-top:35px">
                    <a href="{{route('register_new_djuser')}}" class="btn btn-inverse my-button btn-outline-primary">Add New Artist</a>
                    @if( Auth::user()->role == "super admin")
                    <span data-href="/export-djcsv" id="export" class="btn btn-inverse my-button btn-outline-primary" onclick ="exportTasks (event.target);">Export</span>
                    @endif
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
                     @include('flashmessages')
                     </div>
                  </div>
               <form class="container-fluid" action="{{route('multiple_approve_dj')}}" method="POST" enctype="multipart/form-data" style="padding:30px;">
                     @csrf
                  
                     <div class="row"  style="margin-bottom:20px !important;">
                        <div class="col-md-9">

                        </div>
                        <div class="col-md-3">
                        
                           <button type = "submit"  class="btn btn-inverse my-button btn-outline-primary" style="
                           margin-left: 0px;">Verify and Approve</button>
                              

                        </div>
                     </div>
                  <div class="table_section padding_infor_info">
                     <div class="table-responsive-sm">
                        <table class="table table-striped" id = "myTable">
                           <thead>
                              <tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Status</th>
                                
                                <th>Name</th>
                                {{-- <th>Email</th> --}}
                                <th>Phone Number</th>
                                <th>DJ Name</th>
                                <th>Agency</th>
                                <th>Genre</th>

                                <th>Identification Type </th>
                                {{-- <th> Identification No </th> --}}
                                       <th>Picture</th>
                                <th>Select All &nbsp;<input type="checkbox" id="selectAll" /></th>
                              </tr>
                           </thead>
                           <tbody>
                              @if(!empty($dj_list))
                              <?php $count = 1;?>
                              @foreach ($dj_list as $dj)
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="row">
                                  
                                    <a style="margin: 2px;" href="view_djadmin_details/{{$dj['id']}}" class="btn check-icon btn-sm btn-inverse btn-outline-primary"><i class="fa fa-eye" aria-hidden="true"></i></a><a style="margin: 2px;" href="edit_djadmin_details/{{$dj['id']}}" class="btn btn-sm btn-blue  btn-inverse btn-outline-primary"><i class="fa fa-pencil"></i> </a>
                                    @if( Auth::user()->role == "super admin")
                                    <a style="margin: 2px;" style="margin: 2px;"   href="#" 
                                    data-id={{$dj['id']}} 
                                    data-toggle="modal" 
                                    data-target="#deleteModal" class="btn btn-sm btn-red btn-inverse btn-outline-danger del"><i class="fa fa-trash"></i></a>
                                    @endif
                                </td>
                               
                                  <td class="text-capitalize">
                                 @if($dj->dj_status == 1)         
                                       Verified<a>         
                                  @elseif($dj->dj_status == 0)
                                        Not Verfied
                                  @elseif($dj->dj_status == 3)
                                       Denied  
                                       @elseif($dj->dj_status == -1)
                                       Blocked      
                                 @endif
                                  </td>
                                <td class="text-capitalize"> {{$dj['first_name']}} {{$dj['last_name']}}</td>
                                {{-- <td class="text-capitalize">{{$dj['email']}}</td> --}}
                                <td class="text-capitalize">{{$dj['phone_number']}}</td>
                                <td class="text-capitalize">{{$dj['dj_name']}}</td>
                                <td class="text-capitalize">{{$dj['representation']}}</td>
                                <td class="text-capitalize">{{$dj['music_genre']}}</td>
                                <td class="text-capitalize">@if ($dj['identification_type'] == 1)South African ID
                                @elseif($dj['identification_type'] == 2)
                                     Passport
                                     @else None
                                @endif
                              </td>
                              {{-- <td class="text-capitalize">
                                 @if($dj['identification_type'] == 1)         
                                        {{$dj['southAfrican_id']}}<a>         
                                  @else
                                       {{$dj['passport_id']}}        
                                  @endif
                                  </td> --}}
                                  <td>
                                    @if($dj['profile_image'] != "")
                                    <img src="{{asset('image/'.$dj['profile_image'])}}" style="width: 40%; border-radius:20px;">
                                    @else <img src="{{asset('image/empty.jpg')}}" style="width: 40%; border-radius:20px;">
                                    @endif
                                  </td>
                                <td>
                                 <input type = "checkbox" id = "example" name = "checkbox[]" value="{{$dj['id']}}"></td> 
                              </tr>
                              
                              <?php $count = $count+1;?>
                              @endforeach
                              
                              @else
                              <tr>
                                <th>No Dj Found</th>
                              </tr>
                              @endif
                           </tbody>
                        
                        </table>
                        <div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h5 class="modal-title" style="color:black !important;" id="exampleModalLabel">Delete User</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <div class="modal-body">
                                   <form action="{{ route('artist_delete') }}" method="post">
                                       @csrf
                                       
                                       <input id="id" name="id" hidden>
                                       <h5 class="text-center" style="color:black !important;">Are you sure you want to delete this user?</h5>
                                     
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                       <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                   </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>            
      </div>
   </div>
@stop