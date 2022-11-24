@extends('layouts.app')
@section('pageTitle','Create Element Values')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Create Element Values</h2>
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
              <form class="container-fluid" action="{{route('create_item_element_value')}}" method="POST" enctype="multipart/form-data" style="padding:30px; padding-bottom:40px;">
                @csrf
                <div>
                    <input type="hidden" name="attribute_parent_id" value="{{ $id }}">
                  <label class="form-label">Elements Value</label>
                  <input type="text" name="value" class="form-control" required >
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