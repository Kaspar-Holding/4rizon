<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\AccessCtrl;
use DB;
 
class WebsiteController extends Controller
{
    function get_data(){
        return view("home");
    }
    function get_data_homepage(){
        $event_data = Event::take(2)->orderBy('id','DESC')->get();
        return view("homepage",['event_list'=>$event_data,]);
    }
    function get_about_us(){
        return view("about-us");
    }
    function get_book_event(){
        return view("book-event");
    }
    function get_contact_us(){
        return view("contact-us");
    }
    function get_event_page(){
        $event_data = Event::orderBy('id','DESC')->get();
        return view("event-page",['event_list'=>$event_data,]);
    }
    function get_gallery1(){
        return view("gallery1");
    }
    function get_club(){
        return view("clubs");
    }
    function privacy_policy(){
        return view("privacy_policy");
    }
    function terms(){
        return view("terms");
    }
    function get_booth(){
        return view("booth");
    }
    function get_gallery(){
        return view("gallery");
    }
    function get_clubevent(){
        return view("club_events");
    }

}
