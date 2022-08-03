<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\user_infos;
use App\Models\AccessCtrl;
use App\Models\EventAttend;
use App\Models\Event;
use App\Models\Bookings;
use App\Models\user_wallets;
use App\Models\Purchase;
use App\Models\ClubCapacity;
use DB;
 
class DashboardController extends Controller
{
    function get_data(){
        $get_from_date_value        = \request()->get('from_date');
        $get_to_date_value          = \request()->get('to_date');
        if($get_from_date_value && $get_to_date_value) {
            
           if($get_from_date_value == $get_to_date_value){
                $registered_users = user_infos::where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
                $pending_users    = user_infos::where('user_status',0)->where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
                $invalid_users    = user_infos::where('user_status',2)->where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
                $valid_users      = user_infos::where('user_status',1)->where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
                $qr_scans         = Bookings::whereNotNull('enter_at')->where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
                $total_qr         = Bookings::whereNotNull('booking_id')->where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
                $total_qr_exit    = Bookings::whereNotNull('exit_at')->where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
                $points           = user_wallets::where('created_at', '>=', $get_from_date_value.' 00:00:00')->sum('user_wallets.available_points');
                $points_redeem    = Purchase::where('created_at', '>=', $get_from_date_value.' 00:00:00')->sum('purchase.item_price');
            }
            else if($get_to_date_value < $get_from_date_value){
                return redirect()->back()->with('error', 'Invalid To date selected!');
                // return response()->json(['message' =>'Invalid To date selected'], 500);
            }

            else{
                $registered_users = user_infos::whereDate('created_at','>=',$get_from_date_value)->whereDate('created_at','<=',$get_to_date_value)->get();
                $pending_users    = user_infos::where('user_status',0)->whereDate('created_at','>=',$get_from_date_value)->whereDate('created_at','<=',$get_to_date_value)->get();
                $invalid_users    = user_infos::where('user_status',2)->whereDate('created_at','>=',$get_from_date_value)->whereDate('created_at','<=',$get_to_date_value)->get();
                $valid_users      = user_infos::where('user_status',1)->whereDate('created_at','>=',$get_from_date_value)->whereDate('created_at','<=',$get_to_date_value)->get();
                $qr_scans         = Bookings::whereNotNull('enter_at')->whereDate('created_at','>=',$get_from_date_value)->whereDate('created_at','<=',$get_to_date_value)->get();
                $total_qr         = Bookings::whereNotNull('booking_id')->whereDate('created_at','>=',$get_from_date_value)->whereDate('created_at','<=',$get_to_date_value)->get();
                $total_qr_exit    = Bookings::whereNotNull('exit_at')->whereDate('created_at','>=',$get_from_date_value)->whereDate('created_at','<=',$get_to_date_value)->get();
                $points           = user_wallets::whereDate('created_at','>=',$get_from_date_value)->whereDate('created_at','<=',$get_to_date_value)->sum('user_wallets.available_points');
                $points_redeem    = Purchase::whereDate('created_at','>=',$get_from_date_value)->whereDate('created_at','<=',$get_to_date_value)->sum('purchase.item_price');
            }
            
            
        }elseif($get_from_date_value || empty($get_to_date_value)) {
            $get_to_date_value = $get_from_date_value;
            $registered_users = user_infos::where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
            $pending_users    = user_infos::where('user_status',0)->where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
            $invalid_users    = user_infos::where('user_status',2)->where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
            $valid_users      = user_infos::where('user_status',1)->where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
            $qr_scans         = Bookings::whereNotNull('enter_at')->where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
            $total_qr         = Bookings::whereNotNull('booking_id')->where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
            $total_qr_exit    = Bookings::whereNotNull('exit_at')->where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
            $points           = user_wallets::where('created_at', '>=', $get_from_date_value.' 00:00:00')->sum('user_wallets.available_points');
            $points_redeem    = Purchase::where('created_at', '>=', $get_from_date_value.' 00:00:00')->sum('purchase.item_price');
            
        }elseif($get_to_date_value || empty($get_from_date_value)) {
            $get_from_date_value = $get_to_date_value;
            $registered_users = user_infos::where('created_at', '>=', $get_to_date_value.' 00:00:00')->get();
            $pending_users    = user_infos::where('user_status',0)->where('created_at', '>=', $get_to_date_value.' 00:00:00')->get();
            $invalid_users    = user_infos::where('user_status',2)->where('created_at', '>=', $get_to_date_value.' 00:00:00')->get();
            $valid_users      = user_infos::where('user_status',1)->where('created_at', '>=', $get_to_date_value.' 00:00:00')->get();
            $qr_scans         = Bookings::whereNotNull('enter_at')->where('created_at', '>=', $get_to_date_value.' 00:00:00')->get();
            $total_qr         = Bookings::whereNotNull('booking_id')->where('created_at', '>=', $get_to_date_value.' 00:00:00')->get();
            $total_qr_exit    = Bookings::whereNotNull('exit_at')->where('created_at', '>=', $get_to_date_value.' 00:00:00')->get();
            $points           = user_wallets::where('created_at', '>=', $get_to_date_value.' 00:00:00')->sum('user_wallets.available_points');
            $points_redeem    = Purchase::where('created_at', '>=', $get_to_date_value.' 00:00:00')->sum('purchase.item_price');
        }else{
            $registered_users = user_infos::all();
            $pending_users    = user_infos::where('user_status',0)->get();
            $invalid_users    = user_infos::where('user_status',2)->get();
            $valid_users      = user_infos::where('user_status',1)->get();
            $qr_scans         = Bookings::whereNotNull('enter_at')->get();
            $total_qr         = Bookings::whereNotNull('booking_id')->get();
            $total_qr_exit    = Bookings::whereNotNull('exit_at')->get();
            $points           = user_wallets::sum('user_wallets.available_points');
            $points_redeem    = Purchase::sum('purchase.item_price');
            
        }
            $times            = Carbon::now()->format('Y-');
            $january = user_infos::whereBetween('updated_at', [$times.'01-'.'01',$times.'01-'.'31'])->count();
            $feburary = user_infos::whereBetween('updated_at', [$times.'02-'.'01',$times.'02-'.'31'])->count();
            $march = user_infos::whereBetween('updated_at', [$times.'03-'.'01',$times.'03-'.'31'])->count();
            $april = user_infos::whereBetween('updated_at', [$times.'04-'.'01',$times.'04-'.'31'])->count();
            $may = user_infos::whereBetween('updated_at', [$times.'05-'.'01',$times.'05-'.'31'])->count();
            $june = user_infos::whereBetween('updated_at', [$times.'06-'.'01',$times.'06-'.'31'])->count();
            $july = user_infos::whereBetween('updated_at', [$times.'07-'.'01',$times.'07-'.'31'])->count();
            $august = user_infos::whereBetween('updated_at', [$times.'08-'.'01',$times.'08-'.'31'])->count();
            $september = user_infos::whereBetween('updated_at', [$times.'09-'.'01',$times.'09-'.'31'])->count();
            $october = user_infos::whereBetween('updated_at', [$times.'10-'.'01',$times.'10-'.'31'])->count();
            $november = user_infos::whereBetween('updated_at', [$times.'11-'.'01',$times.'11-'.'31'])->count();
            $december = user_infos::whereBetween('updated_at', [$times.'12-'.'01',$times.'12-'.'31'])->count();
        return view("dashboard",['registered_users'=>$registered_users,'pending_users'=>$pending_users,'invalid_users'=>$invalid_users,'valid_users'=>$valid_users,'qr_scans'=>$qr_scans,'total_qr'=>$total_qr,'total_qr_exit'=>$total_qr_exit,'points'=>$points,'points_redeem'=>$points_redeem,'january'=>$january,'feburary'=>$feburary,'march'=>$march,'april'=>$april,'may'=>$may,'june'=>$june,'july'=>$july,'august'=>$august,'september'=>$september,'october'=>$october,'november'=>$november,'december'=>$december,'from_date'=>$get_from_date_value, 'to_date'=>$get_to_date_value]);
    }
    function get_data_count_api(){
        $get_from_date_value        = \request()->get('from_date');
        $get_to_date_value          = \request()->get('to_date');
        if($get_from_date_value && $get_to_date_value) {

            
            
            if($get_from_date_value == $get_to_date_value){
                $registered_users = user_infos::where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
            }
            

            else{
                $registered_users = user_infos::whereDate('created_at', '>=', $get_from_date_value)->whereDate('created_at', '<=', $get_to_date_value)->get();
                
            }
            
            
            
            $pending_users    = user_infos::where('user_status',0)->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $invalid_users    = user_infos::where('user_status',2)->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $valid_users      = user_infos::where('user_status',1)->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $qr_scans         = Bookings::whereNotNull('enter_at')->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $total_qr         = Bookings::whereNotNull('booking_id')->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $bookings         = Bookings::whereNotNull('booking_id')->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $events        = Event::whereNotNull('id')->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $purchases        = Purchase::whereNotNull('id')->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $total_qr_exit    = Bookings::whereNotNull('exit_at')->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $points           = user_wallets::whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->sum('user_wallets.available_points');
            $points_redeem    = Purchase::whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->sum('purchase.item_price');
        }elseif($get_to_date_value || !empty($get_to_date_value)) {
            $registered_users = user_infos::where('created_at', $get_from_date_value)->get();
            $pending_users    = user_infos::where('user_status',0)->where('created_at', $get_from_date_value)->get();
            $invalid_users    = user_infos::where('user_status',2)->where('created_at', $get_from_date_value)->get();
            $valid_users      = user_infos::where('user_status',1)->where('created_at', $get_from_date_value)->get();
            $qr_scans         = Bookings::whereNotNull('enter_at')->where('created_at', $get_from_date_value)->get();
            $total_qr         = Bookings::whereNotNull('booking_id')->where('created_at', $get_from_date_value)->get();
            $events         = Event::whereNotNull('id')->where('created_at', $get_from_date_value)->get();
            $purchases         = Purchase::whereNotNull('id')->where('created_at', $get_from_date_value)->get();
            $bookings         = Bookings::whereNotNull('booking_id')->where('created_at', $get_from_date_value)->get();
            $total_qr_exit    = Bookings::whereNotNull('exit_at')->where('created_at', $get_from_date_value)->get();
            $points           = user_wallets::where('created_at', $get_from_date_value)->sum('user_wallets.available_points');
            $points_redeem    = Purchase::where('created_at', $get_from_date_value)->sum('purchase.item_price');
        }elseif($get_to_date_value || !empty($get_to_date_value)) {
            $registered_users = user_infos::where('created_at', $get_to_date_value)->get();
            $pending_users    = user_infos::where('user_status',0)->where('created_at', $get_to_date_value)->get();
            $invalid_users    = user_infos::where('user_status',2)->where('created_at', $get_to_date_value)->get();
            $valid_users      = user_infos::where('user_status',1)->where('created_at', $get_to_date_value)->get();
            $qr_scans         = Bookings::whereNotNull('enter_at')->where('created_at', $get_to_date_value)->get();
            $total_qr         = Bookings::whereNotNull('booking_id')->where('created_at', $get_to_date_value)->get();
            $events           = Event::whereNotNull('id')->where('created_at', $get_to_date_value)->get();
            $purchases           = Purchase::whereNotNull('id')->where('created_at', $get_to_date_value)->get();
            $bookings         = Bookings::whereNotNull('booking_id')->where('created_at', $get_to_date_value)->get();
            $total_qr_exit    = Bookings::whereNotNull('exit_at')->where('created_at', $get_to_date_value)->get();
            $points           = user_wallets::where('created_at', $get_to_date_value)->sum('user_wallets.available_points');
            $points_redeem    = Purchase::where('created_at', $get_to_date_value)->sum('purchase.item_price');
        }else{
            $registered_users = user_infos::all();
            $pending_users    = user_infos::where('user_status',0)->get();
            $invalid_users    = user_infos::where('user_status',2)->get();
            $valid_users      = user_infos::where('user_status',1)->get();
            $qr_scans         = Bookings::whereNotNull('enter_at')->get();
            $total_qr         = Bookings::whereNotNull('booking_id')->get();
            $bookings         = Bookings::whereNotNull('booking_id')->get();
            $events           = Event::whereNotNull('id')->get();
            $purchases        = Purchase::whereNotNull('id')->get();
            $total_qr_exit    = Bookings::whereNotNull('exit_at')->get();
            $points           = user_wallets::sum('user_wallets.available_points');
            $points_redeem    = Purchase::sum('purchase.item_price');
            
        }
            $times            = Carbon::now()->format('Y-');
            $january = user_infos::whereBetween('updated_at', [$times.'01-'.'01',$times.'01-'.'31'])->count();
            $feburary = user_infos::whereBetween('updated_at', [$times.'02-'.'01',$times.'02-'.'31'])->count();
            $march = user_infos::whereBetween('updated_at', [$times.'03-'.'01',$times.'03-'.'31'])->count();
            $april = user_infos::whereBetween('updated_at', [$times.'04-'.'01',$times.'04-'.'31'])->count();
            $may = user_infos::whereBetween('updated_at', [$times.'05-'.'01',$times.'05-'.'31'])->count();
            $june = user_infos::whereBetween('updated_at', [$times.'06-'.'01',$times.'06-'.'31'])->count();
            $july = user_infos::whereBetween('updated_at', [$times.'07-'.'01',$times.'07-'.'31'])->count();
            $august = user_infos::whereBetween('updated_at', [$times.'08-'.'01',$times.'08-'.'31'])->count();
            $september = user_infos::whereBetween('updated_at', [$times.'09-'.'01',$times.'09-'.'31'])->count();
            $october = user_infos::whereBetween('updated_at', [$times.'10-'.'01',$times.'10-'.'31'])->count();
            $november = user_infos::whereBetween('updated_at', [$times.'11-'.'01',$times.'11-'.'31'])->count();
            $december = user_infos::whereBetween('updated_at', [$times.'12-'.'01',$times.'12-'.'31'])->count();
        return  response()->json(['registered_users'=>COUNT($registered_users),'pending_users'=>COUNT($pending_users),'invalid_users'=>COUNT($invalid_users),'valid_users'=>COUNT($valid_users),'qr_scans'=>COUNT($qr_scans),'total_qr'=>COUNT($total_qr),'total_qr_exit'=>COUNT($total_qr_exit),'points'=>$points,'points_redeem'=>$points_redeem,'bookings'=>COUNT($bookings),'events'=>COUNT($events),'purchases'=>COUNT($purchases),'january'=>$january,'feburary'=>$feburary,'march'=>$march,'april'=>$april,'may'=>$may,'june'=>$june,'july'=>$july,'august'=>$august,'september'=>$september,'october'=>$october,'november'=>$november,'december'=>$december,'from_date'=>$get_from_date_value, 'to_date'=>$get_to_date_value]);
    }
    function get_data_count_date_api(Request $req){
        $type = "application/json";
        $result = json_decode(file_get_contents("php://input"), true);
        $get_from_date_value        = $result['from_date'];
        $get_to_date_value          = $result['to_date'];
        $club_capacity              = ClubCapacity::all()->pluck("seats")[0];
        if($get_from_date_value && $get_to_date_value) {

            
            
            if($get_from_date_value == $get_to_date_value){
                $registered_users = user_infos::where('created_at', '>=', $get_from_date_value.' 00:00:00')->get();
                
            }
            

            else{
                $registered_users = user_infos::whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
                
            }
            
           
            $users_in_club    = Bookings::where('qr_code_status',1)->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->count('*');
            $successfulEntries= Bookings::where('qr_code_status',1)->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->count('*');
            $rejectedEntries  = Bookings::where('qr_code_status',-1)->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->count('*');
            $exitedEntries    = Bookings::where('qr_code_status',2)->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->count('*');
            $empty_percent    = ($club_capacity - $users_in_club)/$club_capacity;
            $filled_percent   = 1 - $empty_percent;
            $users_in_club    = Bookings::where('qr_code_status',1)->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->count('*');
            $pending_users    = user_infos::where('user_status',0)->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $invalid_users    = user_infos::where('user_status',2)->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $valid_users      = user_infos::where('user_status',1)->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $qr_scans         = Bookings::whereNotNull('enter_at')->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $total_qr         = Bookings::whereNotNull('booking_id')->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $total_qr_exit    = Bookings::whereNotNull('exit_at')->whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->get();
            $points           = user_wallets::whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->sum('user_wallets.available_points');
            $points_redeem    = Purchase::whereBetween('created_at', [$get_from_date_value, $get_to_date_value])->sum('purchase.item_price');
        }elseif($get_to_date_value || !empty($get_to_date_value)) {
            $registered_users = user_infos::where('created_at', $get_from_date_value)->get();
            $pending_users    = user_infos::where('user_status',0)->where('created_at', $get_from_date_value)->get();
            $invalid_users    = user_infos::where('user_status',2)->where('created_at', $get_from_date_value)->get();
            $valid_users      = user_infos::where('user_status',1)->where('created_at', $get_from_date_value)->get();
            $qr_scans         = Bookings::whereNotNull('enter_at')->where('created_at', $get_from_date_value)->get();
            $total_qr         = Bookings::whereNotNull('booking_id')->where('created_at', $get_from_date_value)->get();
            $total_qr_exit    = Bookings::whereNotNull('exit_at')->where('created_at', $get_from_date_value)->get();
            $points           = user_wallets::where('created_at', $get_from_date_value)->sum('user_wallets.available_points');
            $points_redeem    = Purchase::where('created_at', $get_from_date_value)->sum('purchase.item_price');
        }elseif($get_to_date_value || !empty($get_to_date_value)) {
            $registered_users = user_infos::where('created_at', $get_to_date_value)->get();
            $pending_users    = user_infos::where('user_status',0)->where('created_at', $get_to_date_value)->get();
            $invalid_users    = user_infos::where('user_status',2)->where('created_at', $get_to_date_value)->get();
            $valid_users      = user_infos::where('user_status',1)->where('created_at', $get_to_date_value)->get();
            $qr_scans         = Bookings::whereNotNull('enter_at')->where('created_at', $get_to_date_value)->get();
            $total_qr         = Bookings::whereNotNull('booking_id')->where('created_at', $get_to_date_value)->get();
            $total_qr_exit    = Bookings::whereNotNull('exit_at')->where('created_at', $get_to_date_value)->get();
            $points           = user_wallets::where('created_at', $get_to_date_value)->sum('user_wallets.available_points');
            $points_redeem    = Purchase::where('created_at', $get_to_date_value)->sum('purchase.item_price');
        }else{
            $registered_users = user_infos::all();
            $pending_users    = user_infos::where('user_status',0)->get();
            $invalid_users    = user_infos::where('user_status',2)->get();
            $valid_users      = user_infos::where('user_status',1)->get();
            $qr_scans         = Bookings::whereNotNull('enter_at')->get();
            $total_qr         = Bookings::whereNotNull('booking_id')->get();
            $total_qr_exit    = Bookings::whereNotNull('exit_at')->get();
            $points           = user_wallets::sum('user_wallets.available_points');
            $points_redeem    = Purchase::sum('purchase.item_price');
            
        }
            $times            = Carbon::now()->format('Y-');
            $january = user_infos::whereBetween('updated_at', [$times.'01-'.'01',$times.'01-'.'31'])->count();
            $feburary = user_infos::whereBetween('updated_at', [$times.'02-'.'01',$times.'02-'.'31'])->count();
            $march = user_infos::whereBetween('updated_at', [$times.'03-'.'01',$times.'03-'.'31'])->count();
            $april = user_infos::whereBetween('updated_at', [$times.'04-'.'01',$times.'04-'.'31'])->count();
            $may = user_infos::whereBetween('updated_at', [$times.'05-'.'01',$times.'05-'.'31'])->count();
            $june = user_infos::whereBetween('updated_at', [$times.'06-'.'01',$times.'06-'.'31'])->count();
            $july = user_infos::whereBetween('updated_at', [$times.'07-'.'01',$times.'07-'.'31'])->count();
            $august = user_infos::whereBetween('updated_at', [$times.'08-'.'01',$times.'08-'.'31'])->count();
            $september = user_infos::whereBetween('updated_at', [$times.'09-'.'01',$times.'09-'.'31'])->count();
            $october = user_infos::whereBetween('updated_at', [$times.'10-'.'01',$times.'10-'.'31'])->count();
            $november = user_infos::whereBetween('updated_at', [$times.'11-'.'01',$times.'11-'.'31'])->count();
            $december = user_infos::whereBetween('updated_at', [$times.'12-'.'01',$times.'12-'.'31'])->count();
        return  response()->json(['successfulEntries'=>$successfulEntries,'rejectedEntries'=>$rejectedEntries,'exitedEntries'=>$exitedEntries,'club_capacity'=>$club_capacity,'users_in_club'=>$users_in_club,"empty_percent"=>$empty_percent,"filled_percent"=>$filled_percent,'registered_users'=>COUNT($registered_users),'pending_users'=>COUNT($pending_users),'invalid_users'=>COUNT($invalid_users),'valid_users'=>COUNT($valid_users),'qr_scans'=>COUNT($qr_scans),'total_qr'=>COUNT($total_qr),'total_qr_exit'=>COUNT($total_qr_exit),'points'=>$points,'points_redeem'=>$points_redeem,'january'=>$january,'feburary'=>$feburary,'march'=>$march,'april'=>$april,'may'=>$may,'june'=>$june,'july'=>$july,'august'=>$august,'september'=>$september,'october'=>$october,'november'=>$november,'december'=>$december,'from_date'=>$get_from_date_value, 'to_date'=>$get_to_date_value]);
    }
    function get_data_count_now(){
            $date = Carbon::now()->format('Y-d-m');
            
            $bookings         = Bookings::whereNotNull('booking_id')->whereDate('created_at', '=', $date)->get();
            $events        = Event::whereNotNull('id')->whereDate('created_at', '=', $date)->get();
            $purchases        = Purchase::whereNotNull('id')->whereDate('created_at', '=', $date)->get();
            $current    = Bookings::where('qr_code_status','=','1')->whereDate('created_at', '=', $date)->get();
            $exit    = Bookings::where('qr_code_status','=','2')->whereDate('created_at', '=', $date)->get();
           
        
           
        return  response()->json(['bookings'=>COUNT($bookings),'events'=>COUNT($events),'purchases'=>COUNT($purchases),'current'=>COUNT($current),'exit'=>COUNT($exit)]);
    }
    function Dashboard(){
        return view("dashboard.main");
    }
    function layout(){
        return view("layout");
    }
}
