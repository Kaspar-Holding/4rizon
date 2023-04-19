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
.dot {
 
  padding: 8px;
  margin-top : 5px;
  height: 19px;
  width: 15px;
  border-radius: 50%;
  display: inline-block;
  background-color:#30dd30;
}
.red-dot {
  padding: 8px;
  margin-top : 5px;
  height: 19px;
  width: 8px !important;
  border-radius: 50%;
  display: inline-block;
  background-color:red;
}
.yellow-dot {
  padding: 8px;
  margin-top : 5px;  
  height: 19px;
  width: 15px;
  border-radius: 50%;
  display: inline-block;
  background-color:yellow;
}

</style>
    <div onload="test()" class="container-fluid">
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
                  <input type="date" name="event_date"   id="event_date" class="form-control" value="{{ $event->event_date }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Event Start Time</label>
                  <input type="time" name="event_start_time" class="form-control" value="" ><br>
                  <span style=" background: rgb(13 45 80);border-radius: 5px;padding: 9px;color:rgb(69 161 243 / 54%);"> Current Start Time {{$start_time}}</span>
                </div>
                
                <br>
                <div>
                  <label class="form-label">Event End Time</label>
                  <input type="time" name="event_end_time" class="form-control" value="" ><br>
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
                
                <br>
                <div class="col-lg-10">
                  <form id="user_form" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="event_id" value="{{ $event->id }}">
                  <table id="table" class="table table-bordered table-striped update">
                      <thead>
                      </thead>
                      <tbody id="exampleid">
                          <tr>
                              <th>Time Slot</th>
                              <th>Platform 1</th>
                              <th>Platform 2</th>
                              <th>Platform 3</th>
                              {{-- <th>Action</th> --}}
                          </tr>
                          @php $count = 0  @endphp
                          @foreach($intervals as $i)
                          <tr>
                            <input type="hidden" name="count" value="{{ $count }}">
                            @php
                            $time = $i;
                            $event_data = \App\Models\Dj_Event::where('event_id',$event->id)->where('time',$time)->first();
                            //  echo json_encode($event_data);die();
                            @endphp
                            <td>
                              <input  name="time[]" value="{{$i}}" id="time" class="form-control txtedit" readonly/>
                            </td>
                            
                            <td>
                              
                              <div class="row">
                                
                                <select name="artist1[]" id="artist1"  class="form-control  txtedit col-md-10">
                                   @if(!empty($event_data))
                                    @if($event_data->artist1 == "")
                                    <option selected value="">Select One</option>
                                    @else
                                    @php
                                      $artist_data1 = \App\Models\DjUser::where('id',$event_data->artist1)->first();
                                    @endphp
                                    {{-- @php echo json_encode($artist_data1);die();@endphp --}}

                                  
                                    <option selected value="{{$artist_data1->id}}">
                                      {{$artist_data1->first_name}} {{$artist_data1->last_name}} </option>
                                      @endif
                                      
                                  @else
                                  <option selected value="">Select One</option>
                                  @endif
                                  @foreach($dj_list as $artist)
                                  <option value="{{$artist['id']}}">{{$artist['first_name']}} {{$artist['last_name']}}</option>
                                  @endforeach
                                </select>
                                @if(!empty($event_data))
                                  @if($event_data->going_status1 == "1")
                                  <i class="fa fa-check" style="color: #32ec51;margin-left: 12px;margin-top: 3px;font-size: 25px;"></i>
                                  @elseif($event_data->going_status1 == "2")
                                  <i class="fa fa-times" style="width:25px;color: red;margin-left: 12px;margin-top: 3px;font-size: 25px;"></i>
                                  
                                  @elseif($event_data->going_status1 == "0")
                                  <span class = "col-md-1 yellow-dot" style="margin-left:5px;"></span>
                                  @endif
                                @endif
                            </div>
                            </td>
                          

                            <td>
                              <div class="row">
                               
                              <select name="artist2[]" id="artist2" class="form-control  txtedit col-md-10" >
                                @if(!empty($event_data))
                                @if($event_data->artist2 == "")
                                <option selected value="">Select One</option>
                                @else
                                @php
                                  $artist_data2 = \App\Models\DjUser::where('id',$event_data->artist2)->first();
                                @endphp
                                <option selected value="{{$event_data->artist2}}">
                                  {{$artist_data2->first_name}} {{$artist_data2->last_name}}</option>
                                  @endif
                              @else
                              <option selected value="">Select One</option>
                              @endif
                                @foreach($dj_list as $artist)
                                <option value="{{$artist['id']}}">{{$artist['first_name']}} {{$artist['last_name']}}</option>
                                @endforeach
                              </select>
                              @if(!empty($event_data))
                                @if($event_data->going_status2 == "1")
                                <i class="fa fa-check" style="color: #32ec51;margin-left: 12px;margin-top: 3px;font-size: 25px;"></i>
                                @elseif($event_data->going_status2 == "2")
                                <i class="fa fa-times" style="width:25px;color: red;margin-left: 12px;margin-top: 3px;font-size: 25px;"></i>
                                @elseif($event_data->going_status2 == "0")
                                <span class = "col-md-1 yellow-dot" style="margin-left:5px;"></span>
                                @endif
                              @endif
                          </div>
                            </td>
                            <td>
                              <div class="row">
                              <select name="artist3[]" id="artist3" class="form-control txtedit col-md-10" >
                                @if(!empty($event_data))
                                @if($event_data->artist3 == "")
                                <option selected value="">Select One</option>
                                @else
                                @php
                                  $artist_data3 = \App\Models\DjUser::where('id',$event_data->artist3)->first();
                                @endphp
                                <option selected value="{{$event_data->artist3}}">
                                  {{$artist_data3->first_name}} {{$artist_data3->last_name}}</option>
                                  @endif
                              @else
                              <option selected value="">Select One</option>
                              @endif
                               @foreach($dj_list as $artist)
                                <option value="{{$artist['id']}}">{{$artist['first_name']}} {{$artist['last_name']}}</option>
                                @endforeach
                              </select>
                              @if(!empty($event_data))
                                @if($event_data->going_status3 == "1")
                                <i class="fa fa-check" style="color: #32ec51;margin-left: 12px;margin-top: 3px;font-size: 25px;"></i>
                                @elseif($event_data->going_status3 == "2")
                                <i class="fa fa-times" style="width:25px;color: red;margin-left: 12px;margin-top: 3px;font-size: 25px;"></i>
                                @elseif($event_data->going_status3 == "0")
                                <span class = "col-md-1 yellow-dot" style="margin-left:5px;"></span>
                                @endif
                              @endif
                          </div>
                            </td>
                          </tr>
                          @php $count++ @endphp
                          @endforeach
                          
                      </tbody>
                      <input type="hidden" id="hiddenrow" name="hiddenrow" value=""/>
                  </table>
                  <button id='submit' type="submit" class='btnAdd hidee'>Submit</button>
                  </form>
                </div>
          
              </div>
                
                
            </div>
          </div>
        </div>
      </div>
  </div>
  
@stop
 