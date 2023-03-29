@extends('layouts.app')
@section('pageTitle','Notification Lists')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-8">
               <div class="page_title">
                  <h2>Notifications</h2>
               </div>
            </div>
            <div class="col-md-4"  style="margin-top: 40px;">
                <a href="{{ route('notif_list') }}" class="btn btn-inverse my-button btn-outline-primary">All Notifications</a>
                <a href="{{ route('create_group') }}" class="btn btn-inverse my-button btn-outline-primary">Create Group</a>
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
                                {{-- <h2>Notifications</h2> --}}
                            </div>
                        </div>
                        <br>
                    
                        <div class="row">
                            <div class="col-md-9">
                                <button type="button" class="btn" style="background-color:#b896c6; margin-bottom: 15px; color: white; width:217px; font-size: 18px; font-weight: 600;" data-toggle="collapse" data-target="#demo1">Delivery Notifications</button>
                                <br>
                                <div id="demo1" class="collapse">
                                    <a href="{{ route('delivery_new_notifications') }}"> <span class="blink_me" style="color: white;margin-bottom:10px  !important; font-size:14px;"><b>New Notifications  * ( {{ count($delivery_new_count) }}  ) </b></span></a>
                                    <br>
                                    <a href="{{ route('delivery_all_notifications') }}"> <span style="color: white;margin-bottom:10px; font-size:14px;">All Notifications ( {{ count($delivery_all_count) }}  )</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <button type="button" class="btn" style="background-color:#32A5F9; margin-bottom: 15px; color: white; width:217px; font-size: 18px; font-weight: 600;" data-toggle="collapse" data-target="#demo2">Event Notifications</button>
                                <br>
                                <div id="demo2" class="collapse">
                                    <a href="{{ route('event_new_notifications') }}"> <span class="blink_me" style="color: white;margin-bottom:10px  !important; font-size:14px;"><b>New Notifications  * ( {{ count($event_new_count) }}  )</b></span></a>
                                    <br>
                                    <a href="{{ route('event_all_notifications') }}"> <span style="color: white;margin-bottom:10px; font-size:14px;">All Notifications ( {{ count($event_all_count) }}  )</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <button type="button" class="btn" style="background-color:#00FFFF; margin-bottom: 15px; color: white; width:217px; font-size: 18px; font-weight: 600;" data-toggle="collapse" data-target="#demo3">Booking Notifications</button>
                                <br>
                                <div id="demo3" class="collapse">
                                    <a href="{{ route('booking_new_notifications') }}"> <span class="blink_me" style="color: white;margin-bottom:10px  !important; font-size:14px;"><b>New Notifications  * (  {{ count($booking_new_count) }}  )</b></span></a>
                                    <br>
                                    <a href="{{ route('booking_all_notifications') }}"> <span style="color: white;margin-bottom:10px; font-size:14px;">All Notifications (  {{ count($booking_all_count) }}  )</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <button type="button" class="btn" style="background-color:#f546d9; margin-bottom: 15px; color: white; width:217px; font-size: 18px; font-weight: 600;" data-toggle="collapse" data-target="#demo4">Store Notifications</button>
                                <br>
                                <div id="demo4" class="collapse">
                                    <a href="{{ route('store_new_notifications') }}"> <span class="blink_me" style="color: white;margin-bottom:10px  !important; font-size:14px;"><b>New Notifications  * ( {{ count($store_new_count) }}  )</b></span></a>
                                    <br>
                                    <a href="{{ route('store_all_notifications') }}"> <span style="color: white;margin-bottom:10px; font-size:14px;">All Notifications (  {{ count($store_all_count) }}  )</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <button type="button" class="btn" style="background-color:#5a5ab4; margin-bottom: 15px; color: white; width:217px; font-size: 18px; font-weight: 600;" data-toggle="collapse" data-target="#demo5">Dj Notifications</button>
                                <br>
                                <div id="demo5" class="collapse">
                                    <a href="{{ route('dj_new_notifications') }}"> <span class="blink_me" style="color: white;margin-bottom:10px  !important; font-size:14px;"><b>New Notifications  * ( {{ count($dj_new_count) }}  )</b></span></a>
                                    <br>
                                    <a href="{{ route('dj_all_notifications') }}"> <span style="color: white;margin-bottom:10px; font-size:14px;">All Notifications ( {{ count($dj_new_count) }}  )</span></a>
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