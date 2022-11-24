@extends('layouts.app')
@section('pageTitle','Add Gallery Info')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Create Package</h2>
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
              <form class="container-fluid" action="{{ route('create_vip_pkg')}}" method="POST" enctype="multipart/form-data" style="padding-bottom:40px; padding:30px;">
                @csrf
                <div>
                  <label class="form-label">Package Name</label>
                  <input type="text" name="pkg_name" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">Package Description</label>
                  <textarea name="pkg_description" rows="4" class="form-control" required></textarea>
                </div>
                <br>
                
                <div>
                  <label class="form-label">Package Price</label>
                  <input type="number" name="pkg_price" class="form-control" required >
                </div>
                <br>
                <div>
                  <label class="form-label">Max Guests</label>
                  <input type="number" name="max_guests" class="form-control" required >
                </div>
                <br>
                <div class="row" style="padding-top:10px; padding-left:30px;">
                  <button type="submit" class=" col-md-2 btn btn-primary my-button link-light col-sm-4">Create</button>
                </div>
               
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop