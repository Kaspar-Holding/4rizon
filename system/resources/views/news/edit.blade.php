@extends('layouts.app')
@section('pageTitle','Edit News')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Edit News</h2>
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
              <form class="container-fluid" action="{{ route('update_news')}}" method="POST" enctype="multipart/form-data" style="padding:30px; padding-bottom:40px;">
                @csrf
                <input type="hidden" name="id" value="{{ $news->id }}">
                <div>
                  <label class="form-label">News Title</label>
                  <input type="text" name="news_title" class="form-control" value="{{ $news->news_title }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">News Short Description</label>
                  <textarea name="news_short_description" rows="4" class="form-control">{{ $news->news_short_description }}</textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">News Description</label>
                  <textarea name="news_description" rows="6" class="form-control">{{ $news->news_description }}</textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">News Image</label>
                  <img src="{{asset('image/'.$news->news_image)}}" style="width: 20%;">
                </div>
                <br>
                <div>
                  <label class="form-label">Change News Image</label>
                  <input type="file" name="news_image" class="form-control">
                </div>
                <br>
                <div>
                  <label class="form-label">News Date</label>
                  <input type="date" name="news_date" class="form-control" value="{{ $news->news_date }}" >
                </div>
                <br>
                <div class="row" style="padding-top:10px; padding-left:16px;">
                  <button type="submit" class="btn btn-primary  my-button link-light col-md-2 col-sm-4">Update</button>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop