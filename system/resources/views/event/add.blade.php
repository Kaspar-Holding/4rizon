@extends('layouts.app')
@section('pageTitle','Payment Methods')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Create Event</h2>
                 
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
              <form class="container-fluid" action="{{ route('create_event')}}" method="POST" enctype="multipart/form-data" style="padding:30px;">
                @csrf
                <div>
                  <label class="form-label">Event Name</label>
                  <input type="text" name="event_name" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">Event Price</label>
                  <input type="text" name="event_price" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">Event Short Description</label>
                  <textarea name="event_short_description" rows="4" class="form-control" required></textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">Event Description</label>
                  <textarea name="event_description" rows="6" class="form-control" required></textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">Event Image</label>
                  <input type="file" name="event_image" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">Event Date</label>
                  <input type="date" name="event_date" id="txtDate" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">Event Start Time</label>
                  <input type="datetime-local" id="fromtime" name="event_start_time"  class="form-control" required >
                 
                </div>
                <br>
                <div>
                  <label class="form-label">Event End Time</label>
                  <input type="datetime-local" id="totime" name="event_end_time" onchange="Compare()" class="form-control"  required >
                  <span id="error"></span>
                </div>
                <br>
                <div>
                  <label class="form-label">Stage 1</label>
                  <input type="text" name="stage_1" class="form-control" >
                </div>
                <br>
                <div>
                  <label class="form-label">Stage 2</label>
                  <input type="text" name="stage_2" class="form-control" >
                </div>
                <br>
                <div>
                  <label class="form-label">Stage 3</label>
                  <input type="text" name="stage_3" class="form-control" >
                </div>
                <br>
                <div>
                  <label class="form-label">Special</label>
                  <input type="text" name="special" class="form-control" >
                </div>
                <br>
                <div class="row">
                  <button type="submit"  class="btn btn-primary col-md-2 my-button link-light col-sm-4">Create</button>
                </div>
               
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      function Compare() {
        var strStartTime = document.getElementById("fromtime").value;
        var strEndTime = document.getElementById("totime").value;

        var startTime = new Date().setHours(GetHours(strStartTime), GetMinutes(strStartTime), 0);
        var endTime = new Date(startTime)
        var error = document.getElementById("error")
        endTime = endTime.setHours(GetHours(strEndTime), GetMinutes(strEndTime), 0);
        if (startTime > endTime) {
            
            error.innerHTML = "<span style='color: red;'>"+
                        "Start Time is greater than end time</span>"
        }
        else if (startTime == endTime) {
            error.innerHTML = "<span style='color: red;'>"+
                        "Start Time is equal to end time</span>"
        }
        else {
            error.innerHTML = ""
        }
        
      }
      function GetHours(d) {
          var h = parseInt(d.split(':')[0]);
          if (d.split(':')[1].split(' ')[1] == "PM") {
              h = h + 12;
          }
          return h;
      }
      function GetMinutes(d) {
          return parseInt(d.split(':')[1].split(' ')[0]);
      }
    </script>
@stop