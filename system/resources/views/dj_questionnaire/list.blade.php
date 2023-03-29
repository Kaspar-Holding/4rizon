@extends('layouts.app')
@section('pageTitle','DJ Questionnaire Lists')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>DJ Questionnaire Lists</h2>
               </div>
            </div>
        </div>
         <!-- row -->
        <div class="row">
            <!-- table section -->
            <div class="col-md-12">
               <div class="white_shd full margin_bottom_30">
               <div class = "alert">

                        @include('flashmessages')
                    </div>
                  <div class="full graph_head">
                     <div class="heading1 margin_0">
                        <div class="row">
                            <div class="col-sm-9">
                                <h2>DJ_Questionnaire Lists</h2>
                            </div>
                            @if( Auth::user()->role == "super admin")

                            <div class="col-sm-3">
                                <a href="{{ route('add_new_dj_questionnaire') }}" class="btn my-button btn-inverse btn-outline-primary">Add New DJ Questionnaire</a>
                            </div>
                            @endif
                        </div>
                     </div>
                  </div>
                  <div class="table_section padding_infor_info">
                     <div class="table-responsive-sm">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>DJ_Questionnaire Name</th>
                                 <th>Questions</th>
                                       @if( Auth::user()->role == "super admin")

                                 <th>Action</th> @endif
                              </tr>
                           </thead>
                           <tbody>
                              <?php $count = 1;?>
                              @foreach ($dj_questionnaire_list as $DJ_Questionnaire)
                              <tr>
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$DJ_Questionnaire['questionnaire_name']}}</td>
                                <td class="text-capitalize"><a href="view_dj_questionnaire_questions/{{$DJ_Questionnaire['id']}}" class="btn eye-icon btn-sm btn-inverse btn-outline-primary">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a></td>  
                                          @if( Auth::user()->role == "super admin")
                             
                                <td>
                                    <a href="edit_dj_questionnaire/{{$DJ_Questionnaire['id']}}" class="btn btn-blue btn-sm btn-inverse btn-outline-success">
                                      <i class="fa fa-pencil"></i> 
                                    </a>
                                    <a href="delete_dj_questionnaire/{{$DJ_Questionnaire['id']}}" class="btn btn-red btn-sm btn-inverse btn-outline-danger">
                                      <i class="fa fa-trash"></i> 
                                    </a>
                                   
                                </td> @endif
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