@extends('layouts.app')
@section('pageTitle','Edit Gallery')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Edit Splash</h2>
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
              <form class="container-fluid" action="{{route ('update_splash')}}" method="POST" enctype="multipart/form-data" style="padding:30px; pading-bottom:40px;">
                @csrf
                <input type="hidden" name="id" value="{{ $splash->id }}">
                <div>
                  <label class="form-label">Splash Name</label>
                  <input type="text" name="splash_name" class="form-control" value="{{ $splash->splash_name }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Splash Short Description</label>
                  <textarea name="splash_short_description" rows="4" class="form-control">{{ $splash->splash_short_description }}</textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">Splash Description</label>
                  <textarea name="splash_description" rows="6" class="form-control">{{ $splash->splash_description }}</textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">Splash Image</label>
                  <img src="{{asset('image/'.$splash->splash_image)}}" style="width: 20%;">
                </div>
                <br>
                <div>
                  <label class="form-label">Change Splash Image</label>
                  <input type="file" name="splash_image" class="form-control">
                </div>
                <br>
                <div class="row" style="padding-top:10px; padding-left:30px;">
                  <button type="submit" class="btn btn-primary my-button col-md-2 link-light col-sm-4">Update</button>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop