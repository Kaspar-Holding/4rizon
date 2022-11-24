@extends('layouts.app')
@section('pageTitle','Weekly Lineup')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Create Weekly Lineup</h2>
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
              <form class="container-fluid" action="{{ route('create_weekly_lineup')}}" method="POST" enctype="multipart/form-data" style="padding-bottom:40px; padding:30px;">
                @csrf
                <div>
                  <label class="form-label">Name</label>
                  <input type="text" name="name" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">Short Description</label>
                  <textarea name="short_description" rows="4" class="form-control" required></textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">Description</label>
                  <textarea name="description" rows="6" class="form-control" required></textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">Image</label>
                  <input type="file" name="weekly_lineup_image" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">Date</label>
                  <input type="date" name="date" class="form-control" required >
                </div>
                <br>
                <div class="row" style="padding-left:30px; paddin-top:10px;">
                  <button type="submit" class="btn my-button btn-primary col-md-2 link-light col-sm-4">Create</button>
                </div>
              
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop