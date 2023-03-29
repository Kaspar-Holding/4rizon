@extends('layouts.app')
@section('pageTitle','Survey Lists')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>Survey Lists</h2>
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
                            <div class="col-sm-9">
                                <h2>Survey Lists</h2>
                            </div>       @if( Auth::user()->role == "super admin" )

                            <div class="col-sm-3">
                                <a href="{{ route('add_new_survey') }}" class="btn my-button btn-inverse btn-outline-primary">Add New Survey</a>
                            </div> @endif
                        </div>
                     </div>
                  </div>
                  <div class="table_section padding_infor_info">
                     <div class="table-responsive-sm">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Survey Name</th>
                                 <th>Survey Price</th>
                                 <th>Questions</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $count = 1;?>
                              @foreach ($survey_list as $survey)
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$survey['survey_name']}}</td>
                                <td class="text-capitalize">{{$survey['survey_price']}}</td>
                                <td class="text-capitalize"><a href="view_survey_questions/{{$survey['id']}}" class="btn eye-icon btn-sm btn-inverse btn-outline-primary">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a></td>                               
                                <td> 
                                    <a href="edit_survey/{{$survey['id']}}" class="btn btn-blue btn-sm btn-inverse btn-outline-success">
                                      <i class="fa fa-pencil"></i> 
                                    </a>
                                    @if( Auth::user()->role == "super admin")
                                    <a href="delete_survey/{{$survey['id']}}" class="btn btn-red btn-sm btn-inverse btn-outline-danger">
                                      <i class="fa fa-trash"></i> 
                                    </a>
                                    @endif
                                   
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