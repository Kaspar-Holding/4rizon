@extends('layouts.app')
@section('pageTitle','Payment Methods')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Add Answer</h2>
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
              <form class="container-fluid" action="{{ route('create_answer') }}" method="POST" style="padding:30px; padding-bottom:40px;">
                @csrf
                <input type="hidden" name="question_id" value="{{ $question->id }}">
                <div>
                  <label class="form-label">Answer</label>
                  <input type="text" name="answer" class="form-control" required >
                </div>
                <br>
                <div class="row" style="padding-left:30px; padding-top:10px;">
                  <button type="submit" class="btn my-button col-md-2 btn-primary link-light col-sm-4">Create</button>
                </div>
               
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop