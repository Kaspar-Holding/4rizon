@extends('layouts.app')
@section('pageTitle','Item Lists')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-8">
               <div class="page_title">
                  <h2>Merchandise</h2>
               </div>
            </div>
            <div class="col-md-4">
               <div style="margin-top:35px">
               <a href="{{ route('item_category_list') }}" class="btn btn-inverse my-button btn-outline-primary">Item Category</a>
               <a href="{{ route('item_element_list') }}" class="btn btn-inverse my-button btn-outline-primary">Element List</a>
               </div>
           </div>
        </div>
         <!-- row -->
        <div class="row">
            <!-- table section -->
            <div class="col-md-12">
               <div class="white_shd full margin_bottom_30">
                    <div class = "alerti">
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
                                    <a style="margin: 2px;" style="margin: 2px;"   href="#" 
                                    data-id={{$item['id']}} 
                                    data-toggle="modal" 
                                    data-target="#deleteModal" class="btn btn-sm btn-red btn-inverse btn-outline-danger del"><i class="fa fa-trash"></i></a>
                                   
                                </td>
                              </tr>
                              <?php $count = $count+1;?>
                              @endforeach
                           </tbody>
                        </table>
                        <div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h5 class="modal-title" style="color:black !important;" id="exampleModalLabel">Delete Item</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <div class="modal-body">
                                   <form action="{{ route('item_delete') }}" method="post">
                                       @csrf
                                       
                                       <input id="id" name="id" hidden>
                                       <h5 class="text-center" style="color:black !important;">Are you sure you want to delete this Item?</h5>
                                     
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                       <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                   </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                     </div>
                  </div>
               </div>
            </div>            
        </div>
    </div>
@stop