@extends('layouts.app')
@section('pageTitle','Gallery Lists')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>Vip Booth Package Lists</h2>
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
                                <h2>Vip Booth Package Lists</h2>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('add_new_vip_pkg')}}" class="btn my-button btn-inverse btn-outline-primary">Create Package</a>
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
                                 <th>Package Name</th>
                                 <th>Package Price</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $count = 1;?>
                              @foreach ($vip_pkg_list as $vip_pkg)
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$vip_pkg['pkg_name']}}</td>
                                <td class="text-capitalize">{{$vip_pkg['pkg_price']}}</td>
                                <td>
                                    <a href="edit_vip_pkg/{{$vip_pkg['id']}}" class="btn btn-blue  btn-sm btn-inverse btn-outline-success">
                                      <i class="fa fa-pencil"></i> 
                                    </a>
                                    <a href="delete_vip_pkg/{{$vip_pkg['id']}}" class="btn btn-red btn-sm btn-inverse btn-outline-danger">
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