@extends('layouts.app')
@section('pageTitle','User Event Details')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
          <div class="col-md-12">
            <div class="page_title">
              <h2>User Event Details</h2>
            </div>
          </div>
        </div>
         <!-- row -->
        <div class="row">
            <!-- table section -->
          <div class="col-md-12" >
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                      <h2>User Detail</h2>
                    </div>
                    @php
                        $events = \App\Models\Event::where('id',$event->event_id)->first();
                        $user = \App\Models\user_infos::where('user_id',$event->user_id)->first();
                    @endphp
                </div>
                <div class="row p-3">
                    <div class="col-6">
                        <h5>First Name:</h5>
                    </div>
                    <div class="col-6">
                        <h5>{{ $user->first_name }}</h5>
                        {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $user->first_name }}" disabled> --}}
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-6">
                        <h5>Last Name:</h5>
                    </div>
                    <div class="col-6">
                        <h5>{{ $user->last_name }}</h5>
                        {{-- <input type="text" class="form-control h5" name="last_name" style="text-transform: capitalize; background: 'transparent'" value="{{ $user->last_name }}" disabled> --}}
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-6">
                        <h5>Email:</h5>
                    </div>
                    <div class="col-6">
                        <h5>{{ $user->email }}</h5>
                        {{-- <input type="text" class="form-control h5" style="text-transform: capitalize; background: 'transparent'" name="email" value="{{ $user->email }}" disabled> --}}
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-6">
                        <h5>Phone Number:</h5>
                    </div>
                    <div class="col-6">
                        <h5>{{ $user->phone_number }}</h5>
                        {{-- <input type="text" class="form-control h5" name="last_name" value="{{ $user->phone_number }}" disabled> --}}
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-6">
                        <h5>Gender:</h5>
                    </div>
                    <div class="col-6">
                        <h5>{{ $user->gender }}</h5>
                        {{-- <input type="text" class="form-control h5" name="last_name" value="{{ $user->phone_number }}" disabled> --}}
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-6">
                        <h5>Date of Birth:</h5>
                    </div>
                    <div class="col-6">
                        <h5>{{ $user->dob }}</h5>
                        {{-- <input type="text" class="form-control h5" name="last_name" value="{{ $user->phone_number }}" disabled> --}}
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-6">
                        <h5>Identification Type:</h5>
                    </div>
                    <div class="col-6">
                        @if ( $user->identification_type == 1)
                            <h5>South African ID</h5>                            
                        @else
                            <h5>Passport</h5>
                        @endif
                        {{-- <input type="text" class="form-control h5" name="last_name" value="{{ $user->identification_num }}" disabled> --}}
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-6">
                        <h5>Identification Number:</h5>
                    </div>
                    <div class="col-6">
                        <h5>{{ $user->identification_num }}</h5>
                        {{-- <input type="text" class="form-control h5" name="last_name" value="{{ $user->identification_num }}" disabled> --}}
                    </div>
                </div>
                @if ( $user->identification_type == 1)
                    <?php
                        $dha_profile = \App\Models\Dha_profile::where('user_id',$event->user_id)->first();
                    ?>
                    @if(!empty($dha_profile))
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>DHA Detail</h2>
                        </div>
                    </div>               
                    <div class="row p-3">
                        <div class="col-6">
                            <h5>Name:</h5>
                        </div>
                        <div class="col-6">
                            <h5>{{ $dha_profile->personName }} {{ $dha_profile->personSurname }}</h5>
                            {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $user->first_name }}" disabled> --}}
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-6">
                            <h5>Gender:</h5>
                        </div>
                        <div class="col-6">
                            <h5>{{ $dha_profile->gender }}</h5>
                            {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $user->first_name }}" disabled> --}}
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-6">
                            <h5>Date of Birth:</h5>
                        </div>
                        <div class="col-6">
                            <h5>{{ $dha_profile->dateOfBirth }}</h5>
                            {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $user->first_name }}" disabled> --}}
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-6">
                            <h5>Status:</h5>
                        </div>
                        <div class="col-6">
                            <h5>{{ $dha_profile->aliveStatus }}</h5>
                            {{-- <input type="text" class="form-control h5" name="first_name" style="text-transform: capitalize; backgroundColor: 'transparent'" value="{{ $user->first_name }}" disabled> --}}
                        </div>
                    </div>
                    @endif
                @endif
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                      <h2>Event Detail</h2>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-6">
                        <h5>Event Name:</h5>
                    </div>
                    <div class="col-6">
                        <h5>{{ $events->event_name }}</h5>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-6">                        
                        <h5>Event Date:</h5>
                    </div>
                    <div class="col-6">
                        <h5>{{ $events->event_date }}</h5>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-6">                        
                        <h5>Event Description:</h5>
                    </div>
                    <div class="col-6">
                        <h5>{{ $events->event_short_description }}</h5>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-6">                        
                        <h5>Event Type:</h5>
                    </div>
                    <div class="col-6">
                        @if ($events->event_type == 1 )
                            <h5>Normal</h5>
                        @else
                            <h5>VIP</h5>
                        @endif
                    </div>
                </div>
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                      <h2>Guest List</h2>
                    </div>
                </div>
                @foreach($guests as $guest)
                <div class="row p-3">
                    <div class="col-6">
                        <h5>Guest Name:</h5>
                    </div>
                    <div class="col-6">
                        <h5><a style = "color:#666bff;" href="../view_user_details/{{$guest['user_id']}} 
                        ">{{ $guest['first_name'] }} {{$guest['last_name']}}</a></h5>
                    </div>
                </div>
                @endforeach
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                      <h2>User Event Detail</h2>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-6">
                        <h5>Status:</h5>
                    </div>
                    <div class="col-6">
                        @if($event->qr_code_status == "1")
                            <h5>Entered at {{ $event->enter_at }}</h5>
                        @elseif($event->qr_code_status == "2")
                            <h5>Exited at {{ $event->exit_at }}</h5>
                        @elseif($event->qr_code_status == "-1")
                            <h5>Denied at {{ $event->denied_at }}</h5>
                        @elseif($event->qr_code_status == "0")
                            <h5>{{ $event->status }}</h5>
                        @elseif($event->qr_code_status == "3")
                            <h5>Not going</h5>
                        @endif
                    </div>
                    
                </div>
            </div>
          </div>
        </div>
    </div>
@stop