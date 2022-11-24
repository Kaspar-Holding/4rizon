@extends('layouts.app')
@section('pageTitle','Edit Event')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Edit Weekly Lineup</h2>
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
              <form class="container-fluid" action="{{ route('update_weekly_lineup')}}" method="POST" enctype="multipart/form-data" style="padding-bottom:40px; padding:30px;">
                @csrf
                <input type="hidden" name="id" value="{{ $weekly_lineup->id }}">
                <div>
                  <label class="form-label">Weekly Lineup Name</label>
                  <input type="text" name="name" class="form-control" value="{{ $weekly_lineup->name }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Weekly Lineup Short Description</label>
                  <textarea name="short_description" rows="4" class="form-control">{{ $weekly_lineup->short_description }}</textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">Weekly Lineup Description</label>
                  <textarea name="description" rows="6" class="form-control">{{ $weekly_lineup->description }}</textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">Weekly Lineup Image</label>
                  <img src="{{asset('image/'.$weekly_lineup->image)}}" style="width: 20%;">
                </div>
                <br>
                <div>
                  <label class="form-label">Change Weekly Lineup Image</label>
                  <input type="file" name="weekly_lineup_image" class="form-control">
                </div>
                <br>
                <div>
                  <label class="form-label">Weekly Lineup Date</label>
                  <input type="date" name="date" class="form-control" value="{{ $weekly_lineup->date }}" >
                </div>
                <br>
                <div class="row" style="padding-left:30px; padding-top:10px;">
                  <button type="submit" class="btn btn-primary col-md-2 my-button link-light col-sm-4">Update</button>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop