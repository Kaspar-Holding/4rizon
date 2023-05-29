@extends('layouts.app')
@section('pageTitle','Payment Methods')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Add Artist Questionnaire</h2>
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
              <form class="container-fluid form" action="{{route('create_dj_questionnaire')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <label class="form-label">Artist Questionnaire Name</label>
                    <input type="text" name="questionnaire_name" class="form-control" required >
                  </div>
                </div>
                <div class="row" style="padding-top:10px">
                  <div class="col-12">
                      <label class="form-label">Artist Questionnaire Description</label>
                      <textarea class="form-control" name="questionnaire_description" rows="4" required></textarea>
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