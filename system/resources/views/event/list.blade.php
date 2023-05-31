@extends('layouts.app')
@section('pageTitle','Event Lists')
@section('content')
<style>
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 11px !important;
    }
    </style>
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>Events</h2>
               </div>
            </div>
        </div>
         <!-- row -->
        <div class="row">
            <!-- table section -->
            <div class="col-md-12">
               <div class="white_shd full margin_bottom_30">
                    <div class = "alerti">
                        @include('flashmessages')
                    </div>
                  <div class="full graph_head">
                     <div class="heading1 margin_0">
                       
                        <div class="row">
                            <div class="col-md-9">
                                <h2>Event Lists</h2>
                            </div>
                            <div class="col-md-3">

                                <a href="{{ route('add_new_event')}}" class="btn btn-inverse my-button btn-outline-primary">Create Event</a>
                                {{-- @if( Auth::user()->role == "super admin")
                                <button type  = "submit" class=" delete_btn btn btn-inverse my-button btn-outline-primary"  style="margin-left: 0px;">Delete
                                </button>
                                @endif --}}
                            </div>
                        </div>
                     </div>
                  </div>
                  <div class="table_section padding_infor_info">
                     <div class="table-responsive-sm">
                        <table class="table table-striped" id = "myTable">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Event Name</th>
                                 <th>Event Date</th>
                                 {{-- <th>Dj Name</th> --}}
                                 <th>Event Start Time</th>
                                 <th>Event End Time</th>
                                 <th>QR Generated</th>
                                 <th>Action</th>
                                 {{-- <th>Select All &nbsp;<input type="checkbox" id="selectAll" /></th> --}}
                              </tr>
                           </thead>
                           <tbody>
                              <?php $count = 1;?>
                              @foreach ($event_list as $event)
                              @php
                                $countQr = \App\Models\Bookings::where("event_id",$event['id'])->whereNotNull('booking_id')->count() ;
                              @endphp
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$event['event_name']}}</td>
                                <td class="text-capitalize">{{$event['event_date']}}</td>
                                {{-- @if($event->dj == null) 
                                <td class="text-capitalize">Not Assigned</td>
                                @else
                                <td class="text-capitalize">{{$event->dj->first_name}}</td>
                                 @endif --}}
                                <td class="text-capitalize">{{$event['event_start_time']}}</td>
                                <td class="text-capitalize">{{$event['event_end_time']}}</td>
                                <td>{{ $countQr }}</td>
                                <td>
                                    <a href="edit_event/{{$event['id']}}" class="btn btn-sm btn-blue btn-inverse btn-outline-success">
                                      <i class="fa fa-pencil"></i> 
                                    </a>
                                    <a style="margin: 2px;" style="margin: 2px;"   href="#" 
                                    data-id={{$event['id']}} 
                                    data-toggle="modal" 
                                    data-target="#deleteModal" class="btn btn-sm btn-red btn-inverse btn-outline-danger del"><i class="fa fa-trash"></i></a>
                                   
                                </td>
                                {{-- <td>
                                    <input type = "checkbox" id = "example" name = "checkbox[]" value="{{$event['id']}}"></td> --}}
                              </tr>
                              <?php $count = $count+1;?>
                              @endforeach
                           </tbody>
                        </table>
                    </form>
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
                                   <form action="{{ route('event_delete') }}" method="post">
                                       @csrf
                                       
                                       <input id="id" name="id" hidden>
                                       <h5 class="text-center" style="color:black !important;">Are you sure you want to delete this event?</h5>
                                     
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
               </div>
            </div>            
        </div>
    </div>
@stop