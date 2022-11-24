@extends('layouts.app')
@section('pageTitle','Edit Item')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>Edit Item</h2>
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
              <form class="container-fluid" action="{{route('update_item')}}" method="POST" enctype="multipart/form-data" style="padding:30px; padding-bottom:40px;">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <div>
                  <label class="form-label">Category Name</label>
                  <select class="form-control" name="category_id">
                    <option>-- SELECT --</option>
                    @foreach($item_category as $category)
                    <option value="{{ $category->id }}" @if($item->category_id == $category->id) selected @endif>{{ $category->category_name }}</option>
                    @endforeach
                  </select>
                </div>
                <br>
                <div>
                  <label class="form-label">Item Name</label>
                  <input type="text" name="item_name" class="form-control" value="{{ $item->item_name }}" >
                </div>
                <br>
                <div>
                  <label class="form-label">Item Short Description</label>
                  <textarea name="item_short_description" rows="6" class="form-control">{{ $item->item_short_description }}</textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">Item Description</label>
                  <textarea name="item_description" rows="6" class="form-control">{{ $item->item_description }}</textarea>
                </div>
                <br>
                <div>
                  <label class="form-label">Item Image</label>
                  <img src="{{asset('image/'.$item->item_image)}}" style="width: 20%;">
                </div>
                <br>
                <div>
                  <label class="form-label">Change Item Image</label>
                  <input type="file" name="item_image" class="form-control">
                </div>
                <br>
                <div>
                  <label class="form-label">Item Price</label>
                  <input type="text" name="item_price" class="form-control" value="{{ $item->item_price }}" >
                </div>
                <br>
                @php $attribute_id = json_decode($item->attribute_value_id); @endphp
                @if($attributes)
                  @foreach($attributes as $k => $v)
                    <div class="form-group">
                      <label for="groups">{{ $v['attribute_data']['name'] }}</label>
                      <select class="form-control select_group" id="attributes_value_id" name="attributes_value_id[]" multiple="multiple">
                        @foreach($v['attribute_value'] as $k2 => $v2)
                          <option value="{{ $v2['id'] }}" @if($attribute_id != NULL) @if(in_array($v2['id'], $attribute_id)) selected @endif @endif>{{ $v2['value'] }}</option>
                        @endforeach
                      </select>
                    </div>    
                  @endforeach
                @endif
                @if($item->entries != NULL)
                <div>
                  <label class="form-label">Entries</label>
                  <input type="text" name="entries" class="form-control" value="{{ $item->entries }}" >
                </div>
                <br>
                @endif
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