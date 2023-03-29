@extends('layouts.app')
@section('pageTitle','Item Element Lists')
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
                                <h2>Item Element Lists</h2>
                            </div>
                            <div class="col-md-3">
                                <a href="{{route('add_item_element')}}" class="btn my-button btn-inverse btn-outline-primary">Create Item Element</a>
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
                                 <th>Element Name</th>
                                 <th>Total Values</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $count = 1;?>
                              @foreach ($item_element_list as $element)
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$element['name']}}</td>
                                <td class="text-capitalize"><a href="item_element_value_list/{{$element['id']}}" class="btn btn-blue btn-sm btn-inverse btn-outline-successm"><i class="fa fa-plus"></i> Add Value</a> </td>
                                <td>
                                    <a href="edit_item_element/{{$element['id']}}" class="btn btn-blue btn-sm btn-inverse btn-outline-success">
                                      <i class="fa fa-pencil"></i> 
                                    </a>
                                    <a href="delete_item_element/{{$element['id']}}" class="btn btn-red btn-sm btn-inverse btn-outline-danger">
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