@extends('layouts.app')
@section('pageTitle','Payment Methods')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>Create API Token</h2>
               </div>
               <p>API tokens allow third party services to authenticate with our application on your behalf. </p>
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
                         <form class="container-fluid" action="" method="post" style="margin-bottom:10px;">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5>Token Name</h5>
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control h5" name="user_name" value="" id="">
                                    <input type="hidden" name="id" value="">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <h5>Permission</h5>
                                </div>
                            </div>
                            <div class="row">
                                  <div class="col-3">
                                    <input type="checkbox" id="" name="" value="">
                                    <label for="vehicle1">Create</label><br>
                                  </div>
                                  <div class="col-3">
                                    <input type="checkbox" id="" name="" value="">
                                    <label for="vehicle2">Read</label><br>
                                  </div>
                                  <div class="col-3">
                                    <input type="checkbox" id="" name="" value="">
                                    <label for="vehicle3">Update</label><br>
                                  </div>
                                  <div class="col-3">
                                    <input type="checkbox" id="" name="" value="">
                                    <label for="vehicle3">Delete</label><br>
                                  </div>
                                  
                                  
                                 
                            </div>
                            <br>
                            
                            <br>
                           
                            <br>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary col-md-2 my-button link-light col-sm-4">Create</button>
                            </div>
                            <br>
                        </form
                            
                        </div>
                     </div>
                  </div>
               </div>
            </div>            
        </div>
    </div>
        <div class="row column_title" style="margin-top:10px!important;">
            <div class="col-md-12">
               <div class="page_title" style="margin-top:0px!important;">
                  <h2>Manage API Tokens</h2>
               </div>
               <p>You may delete any of your exsisting tokens if they are no longer needed. </p>
            </div>
        </div>
        <div class="row">
            <!-- table section -->
            <div class="col-md-12">
               <div class="white_shd full margin_bottom_30">
                    <div class = "alerti">
                        @include('flashmessages')
                    </div>
                     <div class="table_section padding_infor_info">
                     <div class="table-responsive-sm">
                        <table class="table table-striped">
                            Token Detail
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Token</th>
                                 <th>Last Used</th>
                                 <th>Permissions</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                               <tr>
                                   <td>1</td>
                                   <td>1#5465768</td>
                                   <td>wkdwe</td>
                                   <td>All</td>
                                   <td>
                                      
                                    <a href="" class="btn btn-blue btn-sm btn-inverse btn-outline-success">
                                      <i class="fa fa-pencil"></i> 
                                    </a>
                                    <a href="" class="btn btn-red btn-sm btn-inverse btn-outline-danger">
                                      <i class="fa fa-trash"></i> 
                                    </a>
                                   
                                </td>
                                  
                               </tr>
                                
                              
                           </tbody>
                        </table>
                     </div>
                  </div>
            </div>            
        </div>
    </div>
@stop