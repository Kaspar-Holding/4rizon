@extends('layouts.app')
@section('pageTitle','Create Item Category')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Create Item Category</h2>
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
              <form class="container-fluid" action="{{route('create_item_category')}}" method="POST" enctype="multipart/form-data" style="padding:30px; padding-bottom:40px;">
                @csrf
                <div>
                  <label class="form-label">Category Name</label>
                  <input type="text" name="category_name" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">Category Description</label>
                  <textarea name="category_description" rows="6" class="form-control" required></textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">Category Image</label>
                  <input type="file" name="category_image" class="form-control" required >
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