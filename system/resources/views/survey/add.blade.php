@extends('layouts.app')
@section('pageTitle','Payment Methods')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Add Survey</h2>
            </div>
          </div>
        </div>
         <!-- row -->
        <div class="row">
            <!-- table section -->
          <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
              <div class="full graph_head">
              </div>
              <form class="container-fluid form" action="{{ route('create_survey') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label">Survey Name</label>
                    <input type="text" name="survey_name" class="form-control" required >
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Survey Coins Rewards</label>
                    <input type="text" name="survey_price" class="form-control" required >
                  </div>
                </div>
                <div class="row" style="padding-top:10px">
                  <div class="col-md-6">
                      <label class="form-label">Survey Description</label>
                      <textarea class="form-control" name="survey_description" rows="4" required></textarea>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Survey Image</label>
                    <input type="file" name="survey_image" class="form-control" required >
                  </div>
                </div>
                <div class=" row" style="margin-top:10px;">
                  <button type="submit" class="btn col-md-2 my-button btn-primary link-light col-sm-4">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop