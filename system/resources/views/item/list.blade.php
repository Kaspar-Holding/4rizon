@extends('layouts.app')
@section('pageTitle','Item Lists')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>Item Lists</h2>
               </div>
            </div>
        </div>
         <!-- row -->
        <div class="row">
            <!-- table section -->
            <div class="col-md-12">
               <div class="white_shd full margin_bottom_30">
                    <div>
                        @include('flashmessages')
                    </div>
                  <div class="full graph_head">
                     <div class="heading1 margin_0">
                        <div class="row">
                            <div class="col-md-9">
                                <h2>Item Lists</h2>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('add_item')}}" class="btn my-button btn-inverse btn-outline-primary">Create Item</a>
                            </div>
                        </div>
                     </div>
                  </div>
                  <div class="table_section padding_infor_info">
                     <div class="table-responsive-sm">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Item Category</th>
                                 <th>Item Name</th>
                                 <th>Item Price</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $count = 1;?>
                              @foreach ($item_list as $item)
                              @php
                                $category = App\Models\ItemCategory::find($item['category_id']);
                              @endphp
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$category->category_name ?? ''}}</td>
                                <td class="text-capitalize">{{$item['item_name']}}</td>
                                <td class="text-capitalize">{{$item['item_price']}}</td>
                                <td>
                                    <a href="/edit_item/{{$item['id']}}" class="btn btn-blue btn-sm btn-inverse btn-outline-success">
                                      <i class="fa fa-pencil"></i> 
                                    </a>
                                    <a href="/delete_item/{{$item['id']}}" class="btn btn-red btn-sm btn-inverse btn-outline-danger">
                                      <i class="fa fa-trash"></i> 
                                    </a>
                                   
                                </td>
                              </tr>
                              <?php $count = $count+1;?>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
        </div>
    </div>
@stop