@extends('layouts.app')
@section('pageTitle','Gallery Lists')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>Gallery Lists</h2>
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
                                <h2>Gallery Lists</h2>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('add_new_gallery')}}" class="btn my-button btn-inverse btn-outline-primary">Create Gallery</a>
                            </div>
                        </div>
                     </div>
                  </div>
                  <div class="table_section padding_infor_info">
                     <div class="table-responsive-sm">
                        <table class="table table-striped" id="myTable">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Gallery Name</th>
                                 <th>Gallery Date</th>
                                 <th>Last Updated</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $count = 1;?>
                              @foreach ($gallery_list as $gallery)
                              <tr>
                                 @php
                                 $date = \App\Models\Gallery::where('id','=',$gallery['id'])->first();
                                 $new = strtotime($date->updated_at);
                                 
                                  $newdate = date('d-m-Y',$new);
                                 
                                  $newtime = date('H:i',$new);
                                  $date1 = \App\Models\GalleryImage::where('gallery_id','=',$gallery['unique_id'])->first();
                                  if(!empty($date1)){
                                 $new1 = strtotime($date->updated_at);
                                 
                                  $newdate1 = date('d-m-Y',$new);
                                 
                                  $newtime1 = date('H:i',$new);
                                  if($newdate1 > $newdate){
                                    $updated_at = $newdate1;
                                  }
                                  else{
                                    $updated_at = $newdate;
                                  }
                                 }
                                 else{
                                    $updated_at = $newdate;
                                 }
                            @endphp
                                <td class="text-capitalize">{{$count}}</td>
                                <td class="text-capitalize">{{$gallery['gallery_name']}}</td>
                                <td class="text-capitalize">{{$gallery['gallery_date']}}</td>
                                <td class="text-capitalize">{{$updated_at}}</td>

                                <td>
                                    <a href="edit_gallery/{{$gallery['id']}}" class="btn btn-blue  btn-sm btn-inverse btn-outline-success">
                                      <i class="fa fa-pencil"></i> 
                                    </a>
                                    <a style="margin: 2px;" style="margin: 2px;"   href="#" 
                                    data-id={{$gallery['id']}} 
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
                                       <h5 class="modal-title" style="color:black !important;" id="exampleModalLabel">Delete Gallery</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <div class="modal-body">
                                   <form action="{{ route('gallery_delete') }}" method="post">
                                       @csrf
                                       
                                       <input id="id" name="id" hidden>
                                       <h5 class="text-center" style="color:black !important;">Are you sure you want to delete this gallery?</h5>
                                     
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