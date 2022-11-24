@extends('layouts.app')
@section('pageTitle','Edit Item Category')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Edit Item Category</h2>
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
              <form class="container-fluid" action="{{route('update_item_category')}}" method="POST" enctype="multipart/form-data" style="padding:30px; padding-bottom:40px;">
                @csrf
                <input type="hidden" name="id" value="{{ $item_category->id }}">
                <div>
                  <label class="form-label">Category Name<</label>
                  <input type="text" name="category_name" class="form-control" value="{{ $item_category->category_name }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Category Description</label>
                  <textarea name="category_description" rows="6" class="form-control">{{ $item_category->category_description }}</textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">Category Image</label>
                  <img src="{{asset('image/'.$item_category->category_image)}}" style="width: 20%;">
                </div>
                <br>
                <div>
                  <label class="form-label">Change Category Image</label>
                  <input type="file" name="category_image" class="form-control">
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