<nav id="sidebar">
 <div class="sidebar_blog_1">
    <div class="sidebar-header">
       <div class="logo_section">
          <a href="index.html">
             <img class="logo_icon img-responsive" src="{{ asset('new/images/logo/logo_icon.png')}}" alt="#" />
         </a>
       </div>
    </div>
    <div class="sidebar_user_info">
       <div class="icon_setting"></div>
       <div class="user_profle_side">
          <div class="user_img">
             <img class="img-responsive" src="{{ asset('new/images/user.png')}}" alt="#" />
            </div>
          <div class="user_info">
             <h6>{{ Auth::user()->name }}</h6>
             <p><span class="online_animation"></span> Online</p>
          </div>
       </div>
    </div>
 </div>
 <div class="sidebar_blog_2">
    
    <ul class="list-unstyled components">
      @if( Auth::user()->role == "super admin")
      <li class="active">
       <a style="padding-top:20px; padding-bottom:20px;" href="{{ route('dashboard') }}" class="nav-link {{ request()->is('/') ? 'active' : 'link-dark' }}" aria-current="page"><img class="nav-img" src="{{ asset('new/images/icons/chart.png')}}"/> <span style = "margin-left:20px !important;">Dashboard</span></a>
       </li>
      
       <li class=""><a href="{{ route('admin_list') }}"><i class="fa fa-user nav-img" style = "width: 27px;
         margin-right: 1px !important;
         font-size: 19px !important;
         float: none !important;
         padding-left: 6px;"></i> <span class="nav-span">Admin Management</span></a></li>  @endif
         @if( Auth::user()->role == "super admin" || Auth::user()->role == "admin"  )

       <li class=""><a href="{{ route('admin_djlist') }}"><i class="fa fa-user nav-img" style = "width: 27px;
         margin-right: 3px !important;
         font-size: 19px !important;
         float: none !important;
         padding-left: 6px;"></i><span class="nav-span">Artist Management</span></a></li>
         @endif
       {{-- <li>
         <li>
      <a href="#element3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle {{ request()->is('users_list') ? 'active' : 'link-dark' }}"><img class="nav-img" src="{{ asset('new/images/icons/user.png')}}"/><span class="nav-span">Artist Management</span></a>
      <ul class="collapse list-unstyled" id="element3">
         <li data-toggle="collapse" data-target=".collapse.show"><a href="{{ route('register_new_djuser') }}"> <span>Register New Artist</span></a></li>
         <li data-toggle="collapse" data-target=".collapse.show"><a href="{{ route('admin_djlist') }}"> <span>All Artists</span></a></li>
         <li data-toggle="collapse" data-target=".collapse.show"><a href="{{ route('dj_questionnaire') }}"> <span>Artist Questionnaire</span></a></li>
     </ul>
    </li> --}}
    @if( Auth::user()->role == "super admin" || Auth::user()->role == "general admin"  )

    <li class=""><a href="{{ route('users_list') }}"><i class="fa fa-user nav-img" style = "width: 27px;
      margin-right: 3px !important;
      font-size: 19px !important;
      float: none !important;
      padding-left: 6px;"></i><span class="nav-span">User Management</span></a></li>
    @endif
       {{-- <li>
           <li>
        <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle {{ request()->is('users_list') ? 'active' : 'link-dark' }}"><img class="nav-img" src="{{ asset('new/images/icons/user.png')}}"/><span class="nav-span">Users Management</span></a>
        <ul class="collapse list-unstyled" id="element">
           <li><a href="{{ route('register_new_user') }}"> <span>Register New User</span></a></li>
           <li><a href="{{ route('users_list') }}"> <span>All Users</span></a></li>
           <li><a href="{{ route('active_users') }}"> <span>Active Users</span></a></li>
           @php 
                $user = App\Models\user_infos::where('user_status',0)->where('notify_status',0)->get();
              @endphp
           <li><a href="{{ route('inactive_users') }}"> <span>Pending Users </span>
            @if(count($user) > 0) <span class="blink_me">
              <svg height="50" width="50" class="blinking">
                <circle cx="25" cy="25" r="5" fill="red" />
                Sorry, your browser does not support inline SVG.  
                </svg> 
            </span> @endif
           </a></li>
           <li><a href="{{ route('denied_users') }}"> <span>Denied Users</span></a></li>
           <li><a href="{{ route('blocked_users') }}"> <span>Blocked Users</span></a></li>
        </ul>
      </li> --}}
      <li class=""><a href="{{ route('admin_msg_list') }}"><i class="fa fa-bell nav-img" style = "margin-right: 3px !important;
         font-size: 18px !important;
          float: none !important;"></i><span class="nav-span">Notifications</span></a></li>
       {{-- <li>
        <a href="#element0" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><img class="nav-img" src="{{ asset('new/images/icons/chart.png')}}"/><span class="nav-span">Notifications</span></a>
        <ul class="collapse list-unstyled" id="element0">

            <li><a href="{{ route('notif_list') }}"> <span class="nav-span">All Notifications</span></a></li>
       <li><a href="{{ route('admin_msg_list') }}"><span class="nav-span">Admin Notifications</span></a></li>
       <li><a href="{{ route('create_group') }}"><span class="nav-span">Create Group</span></a></li>

        </ul>
      </li> --}}
       
      @if( Auth::user()->role == "super admin" || Auth::user()->role == "admin"  )
        <li><a href="{{ route('event_list') }}"></i> <img class="nav-img" style = "width: 27px;
         margin-right: 3px !important;" src="{{ asset('new/images/icons/event.png')}}"/><span class="nav-span">Events</span></a></li>
        @endif
      <li class=""><a href="{{ route('item_list') }}"><i class="fa fa-shopping-cart nav-img" style = "margin-right: 0px !important;
         font-size: 18px !important;
          float: none !important;"></i> <span class="nav-span">Merchandise</span></a></li>
      {{-- <li>
        <a href="#element1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><img class="nav-img" src="{{ asset('new/images/icons/event.png')}}"/><span class="nav-span">Merchandise</span></a>
        <ul class="collapse list-unstyled" id="element1">
            <li><a href="{{ route('item_list') }}"><span class="nav-span">Items</span></a></li>
            <li><a href="{{ route('item_category_list') }}"><span class="nav-span">Item Category</span></a></li>
            <li><a href="{{ route('item_element_list') }}"><span class="nav-span">Item Elemets</span></a></li>
        </ul>
      </li> --}}
      @if( Auth::user()->role == "super admin" || Auth::user()->role == "general admin"  )

      <li class=""><a href="{{ route('users_event_attend_list') }}"><i class="fa fa-book nav-img" style = "margin-right: 0px !important;
         font-size: 18px !important;
          float: none !important;"></i> <span class="nav-span">Bookings</span></a></li> @endif
       {{-- <li>
        <a href="{{ route('users_event_attend_list') }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><img class="nav-img" src="{{ asset('new/images/icons/setting.png')}}"/><span class="nav-span">Bookings</span></a>
        <ul class="collapse list-unstyled" id="element2">
            <li><a href="{{ route('users_event_attend_list') }}"><span class="nav-span">All Bookings</span></a></li>
            <li><a href="{{ route('users_transaction_list') }}"><span class="nav-span">Users Transactions</span></a></li>
            <li><a href="{{ route('vip_pkg_list') }}"><span class="nav-span">Vip Booth Package</span></a></li>
            <li><a href="{{ route('vip_booking_list') }}"><span class="nav-span">Vip Booth Bookings</span></a></li>
        </ul>
      </li> --}}
       {{-- <li><a href="{{ route('news_list') }}"><img class="nav-img" src="{{ asset('new/images/icons/event.png')}}"/><span class="nav-span">News</span></a></li> --}}
       {{-- <li><a href="{{ route('splash_list') }}"><img class="nav-img" src="{{ asset('new/images/icons/setting.png')}}"/><span class="nav-span">Splash</span></a></li> --}}
       
       <li>
         <a href="#ele" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle {{Request::is('dj_questionnaire') || Request::is('news_list')|| Request::is('survey_list')|| Request::is('splash_list') || Request::is('weekly_lineup_list') ? 'collapse active':'collapsed link-light'}}"><img class="nav-img" src="{{ asset('new/images/icons/setting.png')}}"/><span class="nav-span">Settings</span></a>
         <ul class="collapse list-unstyled {{Request::is('dj_questionnaire') || Request::is('news_list') || Request::is('survey_list') || Request::is('splash_list') || Request::is('weekly_lineup_list') ? 'show':''}}" id="ele">
         @if( Auth::user()->role == "super admin" || Auth::user()->role == "admin"  )
            <li><a href="{{ url('dj_questionnaire') }}" class="{{Request::is('dj_questionnaire') ? 'active':''}}"> <span>Artist Questionnaire</span></a></li> @endif
            @if( Auth::user()->role == "super admin" || Auth::user()->role == "general admin"  )
             <li><a href="{{ url('news_list') }}" class="{{Request::is('news_list') ? 'active':''}}"> <span>News</span></a></li>
             <li><a href="{{ url('gallery_list') }}" class="{{Request::is('gallery_list') ? 'active':''}}"> <span>Gallery</span></a></li>
             <li><a href="{{ url('survey_list') }}" class="{{Request::is('survey_list') ? 'active':''}}"><span>Survey</span></a></li> 
             <li><a href="{{ url('purchase_list') }}" class="{{Request::is('purchase_list') ? 'active':''}}"><span>Purchases</span></a></li>@endif
             {{-- @if( Auth::user()->role == "super admin")
             <li><a href="{{ url('splash_list') }}" class="{{Request::is('splash_list') ? 'active':''}}"> <span>Splash</span></a></li> @endif --}}
             <li><a href="{{ url('weekly_lineup_list') }}" class="{{Request::is('weekly_lineup_list') ? 'active':''}}"> <span>Weekly Lineup</span></a></li>
           
         </ul>
       </li>

     
  
      <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img class="nav-img" src="{{ asset('new/images/icons/sharp.png')}}"/><span class="nav-span">Logout</span></a>
        <form method="POST" id="logout-form" action="{{ route('logout') }}">
            @csrf
        </form></li>
       <!-- <li><a href="widgets.html"><i class="fa fa-clock-o orange_color"></i> <span>Widgets</span></a></li>
       <li>
          <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-diamond purple_color"></i> <span>Elements</span></a>
          <ul class="collapse list-unstyled" id="element">
             <li><a href="general_elements.html">> <span>General Elements</span></a></li>
             <li><a href="media_gallery.html">> <span>Media Gallery</span></a></li>
             <li><a href="icons.html">> <span>Icons</span></a></li>
             <li><a href="invoice.html">> <span>Invoice</span></a></li>
          </ul>
       </li>
       <li><a href="tables.html"><i class="fa fa-table purple_color2"></i> <span>Tables</span></a></li>
       <li>
          <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-object-group blue2_color"></i> <span>Apps</span></a>
          <ul class="collapse list-unstyled" id="apps">
             <li><a href="email.html">> <span>Email</span></a></li>
             <li><a href="calendar.html">> <span>Calendar</span></a></li>
             <li><a href="media_gallery.html">> <span>Media Gallery</span></a></li>
          </ul>
       </li>
       <li><a href="price.html"><i class="fa fa-briefcase blue1_color"></i> <span>Pricing Tables</span></a></li>
       <li>
          <a href="contact.html">
          <i class="fa fa-paper-plane red_color"></i> <span>Contact</span></a>
       </li>
       <li class="active">
          <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clone yellow_color"></i> <span>Additional Pages</span></a>
          <ul class="collapse list-unstyled" id="additional_page">
             <li>
                <a href="profile.html">> <span>Profile</span></a>
             </li>
             <li>
                <a href="project.html">> <span>Projects</span></a>
             </li>
             <li>
                <a href="login.html">> <span>Login</span></a>
             </li>
             <li>
                <a href="404_error.html">> <span>404 Error</span></a>
             </li>
          </ul>
       </li>
       <li><a href="map.html"><i class="fa fa-map purple_color2"></i> <span>Map</span></a></li>
       <li><a href="charts.html"><i class="fa fa-bar-chart-o green_color"></i> <span>Charts</span></a></li>
       <li><a href="settings.html"><i class="fa fa-cog yellow_color"></i> <span>Settings</span></a></li> -->
    </ul>
 </div>
</nav>
