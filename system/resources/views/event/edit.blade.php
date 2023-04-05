@extends('layouts.app')
@section('pageTitle','Edit Event')
@section('content')

<style>
  .select2-results__options[aria-multiselectable="true"] li {
  padding-left: 30px;
  position: relative
}

.select2-results__options[aria-multiselectable="true"] li:before {
  position: absolute;
  left: 8px;
  opacity: .6;
  top: 6px;
  font-family: "FontAwesome";
  content: "\f0c8";
}


.select2-results__options[aria-multiselectable="true"] li[aria-selected="true"]:before {
  content: "\f14a";
}
.select2-container--default .select2-results__option[aria-selected=true] {
  background-color: rgba(13, 45, 80, 1) !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
  background-color: rgba(13, 45, 80, 1);
}
.select2-container--default .select2-selection--multiple{
  background-color: rgba(13, 45, 80, 1);
  border-radius: 9.6px;
}
/* not required css */

.row
{
padding: 10px;
}
</style>
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Edit Event</h2>
            </div>
             <div><img class="event_banner" src="{{ asset('new/images/banner2.jpg')}}"/></div>
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
              <form class="container-fluid" action="{{route ('update_event')}}" method="POST" enctype="multipart/form-data" style="padding:30px; padding-bottom:40px;">
                @csrf
                <input type="hidden" name="id" value="{{ $event->id }}">
                <div>
                  <label class="form-label">Event Name</label>
                  <input type="text" name="event_name" class="form-control" value="{{ $event->event_name }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Event Price</label>
                  <input type="text" name="event_price" class="form-control" value="{{ $event->event_price }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Event Short Description</label>
                  <textarea name="event_short_description" rows="4" class="form-control">{{ $event->event_short_description }}</textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">Event Description</label>
                  <textarea name="event_description" rows="6" class="form-control">{{ $event->event_description }}</textarea>
                </div>
                <br>
                <div class="row">
                <div class="col-sm-6">
                  <label class="form-label">Change Event Image</label>
                  <input type="file" name="event_image" class="form-control">
                </div>
                <div class="col-sm-6">
                  <img src="{{asset('image/'.$event->event_image)}}" style="width: 40%; border-radius:20px;">
                </div>
                </div>
                <div>
                  <label class="form-label">Event Date</label>
                  <input type="date" name="event_date"  class="form-control" value="{{ $event->event_date }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Event Start Time</label>
                  <input type="datetime-local" name="event_start_time" class="form-control" value="" ><br>
                  <span style=" background: rgb(13 45 80);border-radius: 5px;padding: 9px;color:rgb(69 161 243 / 54%);"> Current Start Time {{$start_time}}</span>
                </div>
                <br>
                <div>
                  <label class="form-label">Event End Time</label>
                  <input type="datetime-local" name="event_end_time" class="form-control" value="" ><br>
                  <span style=" background: rgb(13 45 80);border-radius: 5px;padding: 9px;color:rgb(69 161 243 / 54%);"> Current End Time {{$end_time}}</span>
                </div>
                <br>
                <div>
                  <label class="form-label">Stage 1</label>
                  <input type="text" name="stage_1" class="form-control" value="{{ $event->stage_1 }}">
                </div>
                <br>
                <div>
                  <label class="form-label">Stage 2</label>
                  <input type="text" name="stage_2" class="form-control" value="{{ $event->stage_2 }}">
                </div>
                <br>
                <div>
                  <label class="form-label">Stage 3</label>
                  <input type="text" name="stage_3" class="form-control" value="{{ $event->stage_3 }}">
                </div>
                <br> 
                <div>
                  <label class="form-label">Special</label>
                  <input type="text" name="special" class="form-control" value="{{ $event->special }}">
                </div>
                <br>
                <div class="row" style="margin-top:10px; padding-left:30px;">
                  <button type="submit" class="btn btn-primary col-md-2 my-button link-light col-sm-4">Update</button>
                </div>
                
              </form>
                {{-- <div>
                  <label class="form-label">Assign Artist</label>
                  
                  <select name="artist[]" id="artist" multiple="multiple"  class="form-control select2" >
                    {{-- <option readonly> Assign Artist </option> --}}
                    {{-- @ foreach($dj_list as $artist) --}}
                    {{-- < option value="{{$artist['id']}}">{{$artist['first_name']}} {{$artist['last_name']}}</option> --}}
                    {{-- @endforeach --}}
                  {{-- </select> --}}
                {{-- </div> --}}
                <br>
                <form class="container-fluid"  method="POST" enctype="multipart/form-data" style="padding:30px; padding-bottom:40px;" id="dj_form">
                  @csrf
                  <input type="hidden" name="id" value="{{ $event->id }}">
                  <div class = "row">
                    <div class = "col-md-2">
                      <label class="form-label">Time Slot</label>
                      <select name="time" id="time" class="form-control" >
                        @foreach ($intervals as $date) 
                        <option value="{{date("h:i A", strtotime($date))}}">{{date("h:i A", strtotime($date))}}</option>
                          
                          @endforeach
                         
                          {{-- <option value="09:00">09:00</option>  --}}
                      </select>
                    </div>
                    <div class = "col-md-2">
                      <label class="form-label">Platform 1</label>
                      <select name="artist1" id="artist1" class="form-control" >
                        <option>Select one</option>
                        @foreach($dj_list as $artist)
                        <option value="{{$artist['id']}}">{{$artist['first_name']}} {{$artist['last_name']}}</option>
                        @endforeach
                    
                      </select>
                    </div>
                    <div class = "col-md-2">
                      <label class="form-label">Platform 2</label>
                      <select name="artist2" id="artist2" class="form-control" >
                        <option>Select one</option>
                        @foreach($dj_list as $artist)
                        <option value="{{$artist['id']}}">{{$artist['first_name']}} {{$artist['last_name']}}</option>
                        @endforeach
                    
                      </select>
                    </div>
                    <div class = "col-md-2">
                      <label class="form-label">Platform 3</label>
                      <select name="artist3" id="artist3" class="form-control" >
                        <option>Select one</option>
                        @foreach($dj_list as $artist)
                        <option value="{{$artist['id']}}">{{$artist['first_name']}} {{$artist['last_name']}}</option>
                        @endforeach
                    
                      </select>
                    </div>
                    
                    <div class="col-md-2" style="margin-top:20px; padding-left:30px;">
                      <button id='submit' type="submit" class='btn btn-primary addDj'>Add</button>
                    </div>
                  </div>
                </form>
                
               
                   <br>
                <div class="full graph_head">
                  <div class="heading1 margin_0">
                    <h2>Djs Event Detail</h2>
                  </div>
              </div>
            

              <div class="row p-3" style="margin-left:30px;">
                <div class="col-md-2">
                  <label class="form-label">Time Slot</label>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Platform 1</label>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Platform 2</label>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Platform 3</label>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Status</label>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Delete</label>
                </div>
              </div>
              @foreach($data as $d)
              <div class="row p-3" style="margin-left:30px;">
                <div class="col-md-2">
                  <div style="color :aliceblue;" id="timeslot">{{$d['time']}}</div>
                </div>
                <div class="col-md-2">
                  <div style="color :aliceblue;" id="artist1">{{$d['artist1']}}</div>
                </div>
                <div class="col-md-2">
                  <div style="color :aliceblue;" id="artist2">{{$d['artist2']}}</div>
                </div>
                <div class="col-md-2">
                  <div style="color :aliceblue;" id="artist3">{{$d['artist3']}}</div>
                </div>
                 <div class="col-md-2">
                  <div style="color :aliceblue;" id="status">@if($d['status'] == 2) Pending @elseif($d['status'] == 1) Approved @else Denied @endif</div>
                </div>
                <div class="col-md-2">
                  <div><a href="/delete_timeslot/{{$d['id']}}"  style="color :red; font-size:large;  margin-top:-10px;" class="btn btn-sm btn-green"><i class="fa fa-times" style="width:25px;"></i></a></div>
                </div>
              </div>
              @endforeach
                {{--
              <div class="row p-3">
                @foreach($djs as $dj_event)
                  <div class="col-6">
                      <h5>{{$dj_event->first_name}} {{$dj_event->last_name}}</h5>
                  </div>
                  <div class="col-6">
                    
                      @if($dj_event->going_status == "2")
                          <h5>Requested</h5>
                      @elseif($dj_event->going_status == "1")
                          <h5>Approved</h5>
                      @elseif($dj_event->going_status == "0")
                          <h5>Denied</h5>
                      @endif
                  
                  </div>
                  @endforeach --}}
              </div>
                
                
            </div>
          </div>
        </div>
      </div>
    </div>
    
@stop
