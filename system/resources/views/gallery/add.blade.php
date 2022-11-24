@extends('layouts.app')
@section('pageTitle','Add Gallery Info')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Create Gallery</h2>
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
                  
                </div>
              </div>
              <form class="container-fluid" action="{{ route('create_gallery')}}" method="POST" enctype="multipart/form-data" style="padding-bottom:40px; padding:30px;">
                @csrf
                <div>
                  <label class="form-label">Event</label>
                  <select class="form-control" name="event_id">
                      <option>-- Select --</option>
                      @foreach($events as $event)
                      <option value="{{ $event->id }}">{{ $event->event_name }}</option>
                      @endforeach
                  </select>
                </div>
                <br>
                <div>
                  <label class="form-label">Gallery Name</label>
                  <input type="text" name="gallery_name" class="form-control" required >
                </div>
                <br>
                <!--<div>-->
                <!--  <label class="form-label">Gallery Short Description</label>-->
                <!--  <textarea name="gallery_short_description" rows="4" class="form-control" required></textarea>-->
                <!--</div>-->
                <!--<br>-->
                <!--<div>-->
                <!--  <label class="form-label">Gallery Description</label>-->
                <!--  <textarea name="gallery_description" rows="6" class="form-control" required></textarea>-->
                <!--</div>-->
                <!--<br>-->
                <div>
                  <label class="form-label">Gallery Image</label>
                  <input type="file" name="gallery_image" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">Gallery Images</label>
                  <input type="file" name="gallery_images[]" class="form-control" multiple >
                </div>
                <br>
                <div>
                  <label class="form-label">Gallery Date</label>
                  <input type="date" name="gallery_date" class="form-control" required >
                </div>
                <br>
                <div class="row" style="padding-top:10px; padding-left:30px;">
                  <button type="submit" class=" col-md-2 btn btn-primary my-button link-light col-sm-4">Create</button>
                </div>
               
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
  $("#totime").change(function() {
    var startDate = document.getElementById("fromtime").value;
    var endDate = document.getElementById("totime").value;

    if ((Date.parse(endDate) <= Date.parse(startDate))) {
      alert("End date should be greater than Start date");
      document.getElementById("totime").value = "";
    }
  });
</script>
@stop