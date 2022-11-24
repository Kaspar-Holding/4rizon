@extends('layouts.app')
@section('pageTitle','Edit Event')
@section('content')
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
                  <input type="time" name="event_start_time" class="form-control" value="{{ date("H:i", strtotime($event->event_start_time)) }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Event End Time</label>
                  <input type="time" name="event_end_time" class="form-control" value="{{ date("H:i", strtotime($event->event_end_time)) }}" >
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
                <div>
                  <label class="form-label">DJ Name</label>
                  <select type="text" name="dj_id" class="form-control"> 
                    @if(!empty($event->dj->id))
                    <option value="{{ $event->dj->id }}"> {{ $event->dj->first_name }} </option> 
                    @else
                    <option value=""> Not Assigned </option> 
                    @endif
                    @foreach($dj_list as $dj)
                    <option value="{{ $dj->id }}"> {{ $dj->first_name }} </option> 
                    @endforeach
                  </select>
                </div>
                <br>
                <div class="row" style="margin-top:10px; padding-left:30px;">
                  <button type="submit" class="btn btn-primary col-md-2 my-button link-light col-sm-4">Update</button>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop