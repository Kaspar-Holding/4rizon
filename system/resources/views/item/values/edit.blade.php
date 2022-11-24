@extends('layouts.app')
@section('pageTitle','Edit Element Value')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Edit Element Value</h2>
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
              <form class="container-fluid" action="{{ route('update_item_element_value') }}" method="POST" enctype="multipart/form-data" style="padding:30px; padding-bottom:40px;">
                @csrf
                <input type="hidden" name="id" value="{{ $value->id }}">
                <input type="hidden" name="parent_id" value="{{ $value->attribute_parent_id }}">
                <div>
                  <label class="form-label">Element Value</label>
                  <input type="text" name="value" class="form-control" value="{{ $value->value }}" >
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