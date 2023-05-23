@extends('layouts.app')
@section('pageTitle','Edit Gallery')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Edit Gallery</h2>
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
              <form class="container-fluid" action="{{ route('update_gallery') }}" method="POST" enctype="multipart/form-data" style="padding:30px; pading-bottom:40px;">
                @csrf
                <input type="hidden" name="id" value="{{ $gallery->id }}">
                <input type="hidden" name="unique_id" value="{{ $gallery->unique_id }}">
                <div>
                  <label class="form-label">Event</label>
                  <select class="form-control" name="event_id">
                  @foreach($events as $event)
                      <option value="{{ $event->id }}">{{$event->event_name}}</option>
                     
                      <option value="{{ $event->id }}" @if($event->id == $gallery->event_id) selected @endif>{{ $event->event_name }}</option>
                      @endforeach
                  </select>
                </div>
                <br>
                <div>
                  <label class="form-label">Gallery Name</label>
                  <input type="text" name="gallery_name" class="form-control" value="{{ $gallery->gallery_name }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Gallery Image</label>
                  
                  @if(!empty($gallery->gallery_image))
                  <img src="{{asset('image/'.$gallery->gallery_image)}}" style="width: 20%;">
                </div>
                <br>
                <div>
                  <label class="form-label">Change Gallery Image</label>
                  @endif
                  <input type="file" name="gallery_image" class="form-control">
                </div>
                <br>
                
                <div>
                 
                  <label class="form-label">Gallery Images</label>
                  @foreach($gallery_images as $image)
                  <img src="{{asset('image/'.$image->image)}}" style="width: 10%;"> 
                  @endforeach
                </div>
                <br>
                <div>
                  <label class="form-label">Add Gallery Images</label>
                  <input type="file" name="gallery_images[]" class="form-control" multiple >
                </div>
                <br>
                <div>
                  <label class="form-label">Gallery Date</label>
                  <input type="date" name="gallery_date" class="form-control" value="{{ $gallery->gallery_date }}" >
                </div>
                <br>
                <div class="row" style="padding-top:10px; padding-left:30px;">
                  <button type="submit" class="btn btn-primary my-button col-md-2 link-light col-sm-4">Update</button>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop