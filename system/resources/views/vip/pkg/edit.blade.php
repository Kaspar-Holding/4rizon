@extends('layouts.app')
@section('pageTitle','Edit Gallery')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Edit Package</h2>
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
              <form class="container-fluid" action="{{ route('update_vip_pkg')}}" method="POST" enctype="multipart/form-data" style="padding:30px; pading-bottom:40px;">
                @csrf
                <input type="hidden" name="id" value="{{ $vip_pkg->id }}">
                <div>
                  <label class="form-label">Package Name</label>
                  <input type="text" name="pkg_name" class="form-control" value="{{ $vip_pkg->pkg_name }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Package Description</label>
                  <textarea name="pkg_description" rows="4" class="form-control">{{ $vip_pkg->pkg_description }}</textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">Package Price</label>
                  <input type="number" name="pkg_price" class="form-control" value="{{ $vip_pkg->pkg_price }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Max Guests</label>
                  <input type="number" name="max_guests" class="form-control" value="{{ $vip_pkg->max_guests }}" >
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