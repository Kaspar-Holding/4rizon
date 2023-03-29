<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DjUser;
use App\Models\Event;
use App\Models\EventAttend;
use App\Models\AdminNotification;
use App\Models\Bookings;
use App\Models\Guest;
use App\Models\Dj_Event;
use App\Models\Notifications;
use App\Models\user_infos;
use App\Models\Transaction;
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
   
    function users_transaction_list(){
        $event_data = Transaction::all();
        return view("event.transactions",['event_list'=>$event_data,]);
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
        $start = $event->event_start_time;
        $end = $event->event_end_time;

        $dj = DjUser::where('dj_status','1')->get();
        $intervals = CarbonInterval::hours(1)->toPeriod($start, $end);
        
        // $dj_event = Dj_Event::where('event_id',$id)->get();
        $dj_event = DB::table('dj_event')
            ->select('dj_event.event_id','dj_event.going_status','djusers.first_name','djusers.last_name')
            ->join('djusers', 'djusers.id', '=', 'dj_event.dj_id')->where('dj_event.event_id','=',$id)
            ->get();
    	return view("event.edit",['event'=>$event,'dj_list'=>$dj,'djs'=>$dj_event,'intervals'=>$intervals]);
    }
    function view_user_event_details($id){
    	$event = Bookings::find($id);
        $guests = Guest::where('booking_id','=',$event->booking_id)->where('status','=',0)->get();
    	return view("event.viewDetails",['event'=>$event,'guests'=>$guests]);
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
        $event->pkg_price  = $req->event_price;
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
    function payment(Request $req){
       
        $booking_data = Bookings::where('booking_id','=',$req->booking_id)->first();
        $transaction = Transaction::where('booking','=',$req->booking_id)->first();
        if(empty($transaction)){
            $event = new Transaction;
            $event->amount         = $req->price;
            $event->booking =$booking_data->booking_id;
            $event->user = $booking_data->user_id;
            $event->event = $booking_data->event_id;
            $event->save();
            Bookings::where('booking_id','=',$req->booking_id)->update([
                'payment_status'=>1
              ]);
            return redirect('/users_event_attend_list')->with('success','Payment Done');  
        }
        else{
            return redirect('/users_event_attend_list')->with('success','Payment Already Made');
        }
    }
    function update_event(Request $req){ 
        $artistList = $req->artist;
        
        if(!empty($artistList)){
            foreach($artistList as $list){
                $assigned = Dj_Event::where('dj_id','=',$list)->where('event_id','=',$req->id)->first();
                if(empty($assigned)){

                $dj_event = new Dj_Event;
                $dj_event->event_id = $req->id;
                $dj_event->dj_id = $list;
                $dj_event->save();
                $push_message = "Event Request";
                $message = " Event Request";
                $dj = DjUser::where('djusers.id','=',$list)->first(); 
                if(isset($dj)){
                    $event                             = Event::find($req->id);
                    $this->mobile_push_notificationdj($push_message,$dj->device_id);  
                    $djs = new Notifications;
                    $djs->dj_id            = $dj->id;
                    $djs->event_id         = $req->id;
                    $djs->event_name        = $event->event_name;
                    $djs->notification_type  = "5";
                    $djs->admin_msg          = "You have been assigned a $event->event_name on $event->event_date."   ;
                    $djs->save();
                
                }
            }
            }
        }
        
        $event                             = Event::find($req->id);
        $event->event_name                 = $req->event_name;
        $event->pkg_price                 = $req->event_price;
        $event->event_short_description    = $req->event_short_description;
        $event->event_description          = $req->event_description   ;
        if ($req->hasFile('event_image')) {
            $eventPic             = time().'.'.$req->event_image->extension();  
            $req->event_image->move(public_path('image'), $eventPic);
            $event->event_image = $eventPic;
        }
        $event->event_date  = $req->event_date;
        // $event->dj_id  = $list;

        $event->stage_1  = $req->stage_1;
        $event->stage_2  = $req->stage_2;
        $event->stage_3  = $req->stage_3;
        $event->special  = $req->special;
        $event->save();
        
        
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
            $return_code = str::random(30);
            $eventDetails = Event::find($req->event_id);
            $event = new Bookings;
            $event->booking_type   = "1";
            $event->event_id       = $req->event_id;
            $event->user_id        = $req->user_id;
            $event->status         = $req->status;
            $event->going_status   = $req->status;
            $event->booking_id   = $return_code;

            $event->save();
            $userFind = user_infos::where('user_id',$req->user_id)->first();
            $messages = "Event Booking Created";
            $this->mobile_push_notification($messages,$userFind->player_id);
            return response()->json(['message' => "User Event Record Created", 'success' => true], 200);
        }
        
    }
    function create_qr_code_event(Request $req){
       
        $check = Bookings::where('event_id',$req->event_id)->where('user_id',$req->user_id)->where('status','Qr Code Created')->first();
        $event_expiry = Event::where('id',$req->event_id)->first();
        $expiry_time = date("G:i:s", strtotime($event_expiry->event_end_time));
        $expiry = $event_expiry->event_date.' '.$expiry_time;
        // echo json_encode( $expiry);die();
        if(!empty($check)){
            return response()->json(['message' => "Qr Code Already Created",'qr_code' => $check->booking_id,'qr_code_expires_at'=>$check->qr_code_expires_at, 'error' => true,'code'=>'201'], 201);
        }else{
            $return_code = str::random(30);
            // $tomorrow = date("Y-m-d H:i:s", strtotime('+1 day'));
            $event = new Bookings;
            $event->booking_type          = "1";
            $event->event_id              = $req->event_id;
            $event->user_id               = $req->user_id;
            $event->booking_id            = $return_code;
            $event->status                = "Qr Code Created";
            $event->qr_code_expires_at    = $expiry;
            $event->save();
            
            return response()->json(['message' => "Qr Code Created",'qr_code' => $return_code,'qr_code_expires_at'=>$expiry, 'success' => true], 200);
        }
    }
    function user_event_exit(Request $req){
        $event          = Bookings::where('exit_code',$req->code)->first();
        $event->exit_at = date("Y-m-d H:i:s");;
        $event->status  = "exit";
        $event->save();
        return response()->json(['message' => "User Exits From The Pub", 'success' => true], 200);
    }
      function invitation_status(Request $req){
        $result = json_decode(file_get_contents("php://input"), true);
        $status = $result['status'];
        $user_id = $result['user_id'];
        $booking_id = $result['booking_id'];
        $host = Guest::where('booking_id','=',$booking_id)->where('user_id','=',$user_id)->first();
        $host_id = $host->host_id;

        if($status == 1){
            Guest::where('booking_id','=',$booking_id)->where('user_id','=',$user_id)->update([
                'status'=> $status
              ]);
              $userFind = user_infos::where('user_id',$user_id)->first();
              $name = $userFind->first_name;
              $message = $name." has rejected your invitation";
              $hostFind = user_infos::where('user_id',$host_id)->first();
              if (!is_null($hostFind->player_id)){
                $this->mobile_push_notification($message,$hostFind->player_id);
              }
        }
         if($status == 2){
            Guest::where('booking_id','=',$booking_id)->where('user_id','=',$user_id)->update([
                'status'=> $status
              ]);
             
        }
        return response()->json(['message' => "status updated", 'success' => true], 200);
    }
    function event_list_api($id){
        $date = \Carbon\Carbon::today()->subDays(7);
        $event_data = Event::where('event_date','>=',$date)->get();
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
