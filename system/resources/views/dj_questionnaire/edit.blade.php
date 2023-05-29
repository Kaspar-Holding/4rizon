@extends('layouts.app')
@section('pageTitle','Edit Questionnaire')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Edit Artist Questionnaire</h2>
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
              <form class="container-fluid" action="{{route('dj_questionnaire_update')}}" method="POST" enctype="multipart/form-data" style="padding-bottom:40px; padding:30px;">
                @csrf
                <input type="hidden" name="id" value="{{ $dj_questionnaire->id }}">
                <div>
                  <label class="form-label">Edit Questionnaire</label>
                  <input type="text" name="questionnaire_name" value="{{ $dj_questionnaire->questionnaire_name }}" class="form-control"  >
                </div>
                <br>
                <br>
                <div>
                  <label class="form-label">questionnaire Description</label>
                  <textarea class="form-control" name="questionnaire_description" rows="4" >{{ $dj_questionnaire->questionnaire_description }}</textarea>
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