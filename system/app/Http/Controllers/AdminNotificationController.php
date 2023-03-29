<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DjUser;
use App\Models\user_infos;
use App\Models\UserGroup;
use App\Models\DjGroup;
use App\Models\AdminNotification;
use Illuminate\Support\Str;
use DB;
 
class AdminNotificationController extends Controller
{
    function admin_msg_list(){
    	$notification_data = AdminNotification::all();
    	return view("notification.list",['notification_list'=>$notification_data,]);
    }
    function notif_list(){
    	$notification_data = AdminNotification::all();
        $delivery_new_count = AdminNotification::where('notification_type',2)->where('status',0)->get();
        $delivery_all_count = AdminNotification::where('notification_type',2)->get();
        $event_new_count = AdminNotification::where('notification_type',1)->where('status',0)->get();
        $event_all_count = AdminNotification::where('notification_type',1)->get();
        $booking_new_count = AdminNotification::where('notification_type',4)->where('status',0)->get();
        $booking_all_count = AdminNotification::where('notification_type',4)->get();
        $store_new_count = AdminNotification::where('notification_type',2)->where('status',0)->get();
        $store_all_count = AdminNotification::where('notification_type',2)->get();
        $dj_new_count = AdminNotification::where('notification_type',5)->where('status',0)->get();
        $dj_all_count = AdminNotification::where('notification_type',5)->get();
        
    	return view("notification.notif_list",['notif_list'=>$notification_data,'delivery_new_count'=>$delivery_new_count,'delivery_all_count'=>$delivery_all_count,'event_new_count'=>$event_new_count,'event_all_count'=>$event_all_count,'booking_new_count'=>$booking_new_count,'booking_all_count'=>$booking_all_count,'store_new_count'=>$store_new_count,'store_all_count'=>$store_all_count,'dj_new_count'=>$dj_new_count,'dj_all_count'=>$dj_all_count]);
    }
    function delivery_new_notifications(){
    	$notification_data = AdminNotification::where('notification_type',2)->where('status',0)->orderBy('id', 'DESC')->get();
    	return view("notification.delivery_new_notifications",['notif_list'=>$notification_data,]);
    }
    function event_new_notifications(){
    	$notification_data = AdminNotification::where('notification_type',1)->where('status',0)->orderBy('id', 'DESC')->get();
    	return view("notification.event_new_notifications",['notif_list'=>$notification_data,]);
    }
    function booking_new_notifications(){
    	$notification_data = AdminNotification::where('notification_type',4)->where('status',0)->orderBy('id', 'DESC')->get();
    	return view("notification.booking_new_notifications",['notif_list'=>$notification_data,]);
    }
    function store_new_notifications(){
    	$notification_data = AdminNotification::where('notification_type',2)->where('status',0)->orderBy('id', 'DESC')->get();
    	return view("notification.store_new_notifications",['notif_list'=>$notification_data,]);
    }
    function dj_new_notifications(){
    	$notification_data = AdminNotification::where('notification_type',5)->where('status',0)->orderBy('id', 'DESC')->get();
    	return view("notification.dj_new_notifications",['notif_list'=>$notification_data,]);
    }
    function delivery_all_notifications(){
    	$notification_data = AdminNotification::where('notification_type',2)->orderBy('id', 'DESC')->get();
    	return view("notification.delivery_all_notifications",['notif_list'=>$notification_data,]);
    }
    function event_all_notifications(){
    	$notification_data = AdminNotification::where('notification_type',1)->orderBy('id', 'DESC')->get();
    	return view("notification.event_all_notifications",['notif_list'=>$notification_data,]);
    }
    function booking_all_notifications(){
    	$notification_data = AdminNotification::where('notification_type',4)->orderBy('id', 'DESC')->get();
    	return view("notification.booking_all_notifications",['notif_list'=>$notification_data,]);
    }
    function store_all_notifications(){
    	$notification_data = AdminNotification::where('notification_type',2)->orderBy('id', 'DESC')->get();
    	return view("notification.store_all_notifications",['notif_list'=>$notification_data,]);
    }
    function dj_all_notifications(){
    	$notification_data = AdminNotification::where('notification_type',5)->orderBy('id', 'DESC')->get();
    	return view("notification.dj_all_notifications",['notif_list'=>$notification_data,]);
    }
    function add_admin_msg(){
        $users = UserGroup::select('group_name')->distinct()->get();
        $djusers = DjGroup::select('group_name')->distinct()->get();
    	return view("notification.add",['usergroups'=>$users, 'djgroups'=>$djusers]);
    }
    function create_group(){
        $users = user_infos::get();
        $dj_users = DjUser::get();
    	return view("notification.create_group",['users'=>$users, 'djusers'=>$dj_users]);
    }
    function create_admin_group(Request $req){
        $name = $req->group_name;
        $usersList = $req->user;
        $count_array = count($usersList);
        for($i=0; $i<$count_array; $i++){
            $users = new UserGroup;
            $user_id = $usersList[$i];
            $users->user_id            = $user_id;
            $users->group_name  = $name;
            $users->save();
        }
        return redirect('/create_group')->with('success','Group Created Successfully!');

    }
    function create_dj_admin_group(Request $req){
        $name = $req->group_name;
        $usersList = $req->user;
        $count_array = count($usersList);
        for($i=0; $i<$count_array; $i++){
            $users = new DjGroup;
            $user_id = $usersList[$i];
            $users->dj_id            = $user_id;
            $users->group_name  = $name;
            $users->save();
        }
        return redirect('/create_group')->with('success','Group Created Successfully!');

    }
   
    function create_admin_msg(Request $req){

        $usersList = $req->user;

        foreach($usersList as $list){
            $group = UserGroup::where('group_name','=',$list)->get();
        $count_array = count($group);
        // echo json_encode($count_array);die();

		foreach($group as $g){
            
            $users = new AdminNotification;
            $user_id = $g['user_id'];
            $users->user_id            = $user_id;
            $users->notification_type  = "3";
            $users->admin_msg          = $req->admin_msg   ;
            $users->save();
            $messages = $req->admin_msg;
                    $user = user_infos::where('user_id',$user_id)->get();
                    foreach($user as $u){
                         $this->mobile_push_notification($messages,$u['player_id']);
                    }
        }
        }
            return redirect('/admin_msg_list')->with('success','Admin Notification Created Successfully!');
    }
    function create_dj_admin_msg(Request $req){

        $usersList = $req->user;

        foreach($usersList as $list){
            $group = DjGroup::where('group_name','=',$list)->get();
        $count_array = count($group);

		foreach($group as $g){
            
            $users = new AdminNotification;
            $user_id = $g['dj_id'];
            $users->user_id            = $user_id;
            $users->notification_type  = "5";
            $users->admin_msg          = $req->admin_msg   ;
            $users->save();
            $messages = $req->admin_msg;
                    $user = DjUser::where('id',$user_id)->get();
                    foreach($user as $u){
                         $this->mobile_push_notification($messages,$u['player_id']);
                    }
        }
        }
            return redirect('/admin_msg_list')->with('success','Admin Notification Created Successfully!');
    }
    // function create_dj_admin_msg(Request $req){
    //     $djUsersList = DjUser::get();
    //     foreach($djUsersList as $dj){
    //         $djs = new AdminNotification;
    //         $djs->dj_id            = $dj->id;
    //         $djs->notification_type  = "5";
    //         $djs->admin_msg          = $req->admin_msg   ;
    //         $djs->save();
    //     }
        
    //         return redirect('/admin_msg_list')->with('success','Admin Notification Created Successfully!');
    // }
    public function delete_admin_msg($id) {
        if(AdminNotification::where('id', $id)->exists()) {
            $AdminNotification= AdminNotification::where('id', $id)->delete();
            return redirect('/admin_msg_list')->with('success','Admin Notification Deleted Successfully!');
        }else{
            return redirect('/admin_msg_list')->with('error','Admin Notification Not Found');
        }
    }
    
    // apis
    function notification_api($id){
        $notification = AdminNotification::where('user_id',$id)->get();
        return response()->json(['notifications' =>$notification,'success' => true], 200);
    }
    function notification_status_api($id){
        $notification = AdminNotification::find($id);
        $notification->status = 1;
        $notification->save();
        return response()->json(['message' =>"status updated successfully",'success' => true], 200);
    }
    /** Mobile Push Notification Function **/
	public function mobile_push_notification($message='', $player_id=''){
		/* SEND NOTIFICATION */
		$content = array(
			"en" => $message
			);
		$fields = array(
			'app_id' => "e3ead764-83f0-45b2-832e-7b4aa851e4f4",
			// 'app_id' => "9b212888-74e1-4626-b188-732bcd1f897b",
			'include_player_ids' => array($player_id),
			'data' => array("noti_type" => "order_update"),
			'contents' => $content
		);
		
		$fields = json_encode($fields);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		$return["allresponses"] = $response;
		$return = json_encode($return);
		/* SEND NOTIFICATION */
		if(!empty($return)){
			return true;
		}
	}
}
