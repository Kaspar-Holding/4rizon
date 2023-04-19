@extends('layouts.app')
@section('pageTitle','User Detail')
@section('content')
<style>
    h2{
        font-size: 24px !important;
    }
    h5{
        font-size : 14px !important;
        color:#d8dfe5!important; 
    }
    </style>
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>Group Users Details</h2>
               </div>
            </div>
        </div>
         <!-- row -->
        <div class="row p-3">
            <!-- table section -->
            <div class="col-md-12">
               <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head" style=" margin-bottom:20px !important;">
                         <div class="heading1 margin_0">
                            <div class = "alerti">
                                @include('flashmessages')
                            </div>
                            <h2></h2>
                         </div>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                           <table class="table table-striped">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Email</th>           
                                 </tr>
                              </thead>
                              <tbody>
   
                               @php $count = 1;  @endphp
                           
                               @foreach($users as $user => $val)
                               {{-- @php echo json_encode($val['first_name']);die(); @endphp --}}
                                 <tr>
                                   <td class="text-capitalize">{{$count}}</td>;
                                   <td class="text-capitalize">{{$val['first_name'] ?? 'Not Found'}} {{$val['last_name'] ?? ''}}</td>
                                   <td class="text-capitalize">{{$val['email'] ?? ''}}</td>
                                 </tr>
                                 @php $count++; @endphp
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