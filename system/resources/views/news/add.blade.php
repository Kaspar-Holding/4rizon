@extends('layouts.app')
@section('pageTitle','Create News')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Create News</h2>
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
              <form class="container-fluid" action="{{ route('create_news')}}" method="POST" enctype="multipart/form-data" style="padding:30px; padding-bottom:40px;">
                @csrf
                <div>
                  <label class="form-label">News Title</label>
                  <input type="text" name="news_title" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">News Short Description</label>
                  <textarea name="news_short_description" rows="4" class="form-control" required></textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">News Description</label>
                  <textarea name="news_description" rows="6" class="form-control" required></textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">News Image</label>
                  <input type="file" name="news_image" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">News Date</label>
                  <input type="date" name="news_date" class="form-control" required >
                </div>
                <br>
                <div class="row" style="padding-top:10px;padding-left:30px;">
                  <button type="submit" class="btn btn-primary  my-button col-md-2 link-light col-sm-4">Create</button>
                </div>
               
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop