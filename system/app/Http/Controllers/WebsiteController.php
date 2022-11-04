<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\AccessCtrl;
use DB;
 
class WebsiteController extends Controller
{
    function get_data(){
        return view("home");
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
