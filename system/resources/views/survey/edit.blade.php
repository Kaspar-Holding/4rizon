@extends('layouts.app')
@section('pageTitle','Payment Methods')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Edit Survey</h2>
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
              <form class="container-fluid" action="{{route('survey_update')}}" method="POST" enctype="multipart/form-data" style="padding-bottom:40px; padding:30px;">
                @csrf
                <input type="hidden" name="id" value="{{ $survey->id }}">
                <div>
                  <label class="form-label">Survey Name</label>
                  <input type="text" name="survey_name" value="{{ $survey->survey_name }}" class="form-control"  >
                </div>
                <br>
                <div>
                  <label class="form-label">Survey Coins Rewards</label>
                  <input type="text" name="survey_price" class="form-control" value="{{ $survey->survey_price }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Survey Image</label>
                  <img src="{{asset('image/'.$survey->survey_image)}}" style="width: 20%;">
                </div>
                <br>
                <div>
                  <label class="form-label">Change Survey Image</label>
                  <input type="file" name="survey_image" class="form-control">
                </div>
                <br>
                <div>
                  <label class="form-label">Survey Description</label>
                  <textarea class="form-control" name="survey_description" rows="4" >{{ $survey->survey_description }}</textarea>
                </div>
                <br>
                <div class="row" style="padding-left:30px; padding-top:10px;">
                  <button type="submit" class=" my-button col-md-2 btn btn-primary link-light col-sm-4">Update</button>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop