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
                                    <a href="delete_event/{{$event['id']}}" class="btn btn-sm btn-red btn-inverse btn-outline-danger">
                                      <i class="fa fa-trash"></i> 
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
            </div>            
        </div>
    </div>
@stop