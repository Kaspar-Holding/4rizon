<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DjUser;
use App\Models\Event;
use App\Models\EventAttend;
use App\Models\AdminNotification;
use App\Models\Bookings;
use App\Models\Notifications;
use App\Models\user_infos;
use Illuminate\Support\Str;
use DB;
 
class EventController extends Controller
{
    function event_list(){
    	$event_data = Event::all();
    	return view("event.list",['event_list'=>$event_data,]);
    }
    function users_event_attend_list(){
        $event_data = Bookings::all();
        return view("event.attendList",['event_list'=>$event_data,]);
    }
    function users_events_attend_lists($fromdate,$todate){
        if($fromdate == $todate){
          $event_data = Bookings::whereNotNull('enter_at')->where('created_at', '>=', $fromdate.' 00:00:00')->get();
        }else{
              $event_data = Bookings::whereNotNull('enter_at')->whereDate('created_at','>=',$fromdate)->whereDate('created_at','<=',$todate)->get();
        }
        return view("event.attendList",['event_list'=>$event_data,]);
    }
    function edit_event($id){
    	$event = Event::find($id);
        $dj = DjUser::all();
    	return view("event.edit",['event'=>$event,'dj_list'=>$dj]);
    }
    function view_user_event_details($id){
    	$event = Bookings::find($id);
    	return view("event.viewDetails",['event'=>$event,]);
    }
    function add_new_event(){
    	return view("event.add");
    }
    function create_event(Request $req){
        $startTime = date("g:i A", strtotime($req->event_start_time." UTC"));
        $endTime = date("g:i A", strtotime($req->event_end_time." UTC"));
        $event = new Event;
        $event->event_name         = $req->event_name;
        $event->event_short_description        = $req->event_short_description;
        $event->event_description          = $req->event_description   ;
        if ($req->hasFile('event_image')) {
            $eventPic             = time().'.'.$req->event_image->extension();  
            $req->event_image->move(public_path('image'), $eventPic);
            $event->event_image = $eventPic;
        }
        $event->event_date  = $req->event_date;
        $event->event_start_time  = $startTime;
        $event->event_end_time    = $endTime;
        $event->stage_1  = $req->stage_1;
        $event->stage_2  = $req->stage_2;
        $event->stage_3  = $req->stage_3;
        $event->special  = $req->special;
        $event->save();
        $getLastEvent = Event::where('event_name',$req->event_name)->first();
        $notification = new Notifications;
        $notification->notification_type  = "1";
        $notification->event_id            = $getLastEvent->id;
        $notification->event_name          = $req->event_name;
        $notification->event_description   = $req->event_short_description;
        $notification->event_date       = $req->event_date;
        $notification->save();
        return redirect('/event_list')->with('success','Event Created Successfully!');
    }
    function update_event(Request $req){ 
        $event                             = Event::find($req->id);
        $event->event_name                 = $req->event_name;
        $event->event_short_description    = $req->event_short_description;
        $event->event_description          = $req->event_description   ;
        if ($req->hasFile('event_image')) {
            $eventPic             = time().'.'.$req->event_image->extension();  
            $req->event_image->move(public_path('image'), $eventPic);
            $event->event_image = $eventPic;
        }
        $event->event_date  = $req->event_date;
        $event->dj_id  = $req->dj_id;
        $event->stage_1  = $req->stage_1;
        $event->stage_2  = $req->stage_2;
        $event->stage_3  = $req->stage_3;
        $event->special  = $req->special;
        $event->save();
        $push_message = "Event Request";
        $message = " Event Request";
        $dj = DjUser::where('djusers.id','=',$req->dj_id)->first();  
        $this->mobile_push_notificationdj($push_message,$dj->device_id);  
        $djs = new Notifications;
        $djs->dj_id            = $dj->id;
        $djs->event_id         = $req->id;
        $djs->notification_type  = "5";
        $djs->admin_msg          = "You have been assigned a new event"   ;
        $djs->save();
        return redirect('/event_list')->with('success','Event Details Updated Successfully!');
    }
    public function delete_event ($id) {
        if(Event::where('id', $id)->exists()) {
            $event= Event::where('id', $id)->delete();
            return redirect('/event_list')->with('success','Event Details Deleted Successfully!');
        }else{
            return redirect('/event_list')->with('error','Event Not Found');
        }
    }
    // api's
    function user_event_attend(Request $req){
        $check = Bookings::where('event_id',$req->event_id)->where('user_id',$req->user_id)->first();
        if($check->status == "attended"){
            return response()->json(['message' => "User Already Visited", 'error' => true,'code'=>'201'], 201);
        }else{
            $return_code = str::random(30);
            $check->exit_code             = $return_code;
            $check->status                = "attended";
            $check->save();
            return response()->json(['message' => "User Enters In The Pub",'exit_code' => $return_code, 'success' => true], 200);
        }
    }
    function user_going_to_event(Request $req){
        $check = Bookings::where('event_id',$req->event_id)->where('user_id',$req->user_id)->where('going_status',$req->status)->first();
        if (!empty($check)) {
            return response()->json(['message' => "Already Going",'error' => true,'code'=>'201'], 201);
        }else{
            $eventDetails = Event::find($req->event_id);
            $event = new Bookings;
            $event->booking_type   = "1";
            $event->event_id       = $req->event_id;
            $event->user_id        = $req->user_id;
            $event->status         = $req->status;
            $event->going_status   = $req->status;
            $event->save();
            $userFind = user_infos::where('user_id',$req->user_id)->first();
            $messages = "Event Booking Created";
            $this->mobile_push_notification($messages,$userFind->player_id);
            return response()->json(['message' => "User Event Record Created", 'success' => true], 200);
        }
        
    }
    function create_qr_code_event(Request $req){
       
        $check = Bookings::where('event_id',$req->event_id)->where('user_id',$req->user_id)->where('status','Qr Code Created')->first();
        if(!empty($check)){
            return response()->json(['message' => "Qr Code Already Created",'qr_code' => $check->booking_id,'qr_code_expires_at'=>$check->qr_code_expires_at, 'error' => true,'code'=>'201'], 201);
        }else{
            $return_code = str::random(30);
            $tomorrow = date("Y-m-d H:i:s", strtotime('+1 day'));
            $event = new Bookings;
            $event->booking_type          = "1";
            $event->event_id              = $req->event_id;
            $event->user_id               = $req->user_id;
            $event->booking_id            = $return_code;
            $event->status                = "Qr Code Created";
            $event->qr_code_expires_at    = $tomorrow;
            $event->save();
            return response()->json(['message' => "Qr Code Created",'qr_code' => $return_code,'qr_code_expires_at'=>$tomorrow, 'success' => true], 200);
        }
    }
    function user_event_exit(Request $req){
        $event          = Bookings::where('exit_code',$req->code)->first();
        $event->exit_at = date("Y-m-d H:i:s");;
        $event->status  = "exit";
        $event->save();
        return response()->json(['message' => "User Exits From The Pub", 'success' => true], 200);
    }
    function event_list_api($id){
        $date = \Carbon\Carbon::today()->subDays(7);
        $event_data = Event::where('created_at','>=',$date)->get();
        $bookings   = Bookings::where('user_id',$id)->get();
        if(!empty($bookings)){
            return response()->json(['event_list' =>$event_data,'booking_list' =>$bookings,'image_url'=>'https://4rizon.com/image/', 'success' => true], 200);
        }
        return response()->json(['event_list' =>$event_data,'booking_list' =>[],'image_url'=>'https://4rizon.com/image/', 'success' => true], 200);
    }
    function single_event_api($id){
        $event = Event::find($id);
         return response()->json(['event' =>$event,'image_url'=>'https://4rizon.com/image/', 'success' => true], 200);
    }
    function get_bookings($id){
      
        $bookings = Bookings::where('user_id',$id)->get();
        return response()->json(['bookings' =>[$bookings],'success' => true], 200);
    }
    function remove_booking(Request $req){
        $bookings = Bookings::where('id', $req->id)->delete();
        return response()->json(['message' =>"Booking Removed Successfully",'success' => true], 200);
    }
    
    /** DJ Mobile Push Notification **/
    public function mobile_push_notificationdj($message='', $player_id=''){
		/* SEND NOTIFICATION */
		$content = array(
			"en" => $message
			);
		$fields = array(
			'app_id' => "346d914e-58bb-407c-875e-e9202378bf8a",
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
