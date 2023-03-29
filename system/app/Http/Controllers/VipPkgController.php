<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VipPkg;
use App\Models\VipBookings;
use App\Models\Bookings;
use App\Models\user_infos;
use App\Models\Event;
use App\Models\Guest;
use App\Models\AdminNotification;
use Illuminate\Support\Str;
use DB;
 
class VipPkgController extends Controller
{
    function vip_pkg_list(){
    	$vip_pkg_list = VipPkg::all();
    	return view("vip.pkg.list",['vip_pkg_list'=>$vip_pkg_list,]);
    }
    function edit_vip_pkg($id){
    	$vip_pkg = VipPkg::find($id);
    	return view("vip.pkg.edit",['vip_pkg'=>$vip_pkg,]);
    }
    function add_new_vip_pkg(){
    	return view("vip.pkg.add");
    }
    function create_vip_pkg(Request $req){
        $vip_pkg = new VipPkg;
        $vip_pkg->pkg_name           = $req->pkg_name;
        $vip_pkg->pkg_description    = $req->pkg_description;
        $vip_pkg->pkg_price          = $req->pkg_price;
        $vip_pkg->max_guests         = $req->max_guests;
        $vip_pkg->save();
        return redirect('/vip_pkg_list')->with('success','Vip Package Created Successfully!');
    }
    function update_vip_pkg(Request $req){
        $vip_pkg                     = VipPkg::find($req->id);
        $vip_pkg->pkg_name           = $req->pkg_name;
        $vip_pkg->pkg_description    = $req->pkg_description;
        $vip_pkg->pkg_price          = $req->pkg_price   ;
        $vip_pkg->max_guests         = $req->max_guests;
        $vip_pkg->save();
        return redirect('/vip_pkg_list')->with('success','Vip Package Details Updated Successfully!');
    }
    public function delete_vip_pkg ($id) {
        if(VipPkg::where('id', $id)->exists()) {
            $vip_pkg= VipPkg::where('id', $id)->delete();
            return redirect('/vip_pkg_list')->with('success','Vip Pacakge Details Deleted Successfully!');
        }else{
            return redirect('/vip_pkg_list')->with('error','Vip Pacakge Not Found');
        }
    }

    function vip_booking_list(){
    	$vip_booking_list = VipBookings::all();
    	return view("vip.list",['vip_booking_list'=>$vip_booking_list,]);
    }
    public function delete_vip_booking ($id) {
        if(VipBookings::where('id', $id)->exists()) {
            $vip_pkg= VipBookings::where('id', $id)->delete();
            return redirect('/vip_booking_list')->with('success','Vip Booking Details Deleted Successfully!');
        }else{
            return redirect('/vip_booking_list')->with('error','Vip Booking Not Found');
        }
    }

    // api's
    function vip_booth_pkg_list_api(){
        $vip_data = VipPkg::all();
        return response()->json(['vip_pkg_list' =>$vip_data, 'success' => true], 200);
    }
    function single_vip_booth_pkg_api($id){
        $vip = VipPkg::find($id);
        return response()->json(['vip_pkg' =>$vip, 'success' => true], 200);
    }
    function vip_booth_booking_api(Request $req){
        $unique_id = str::random(20);
        $result = json_decode(file_get_contents("php://input"), true);
        $check = Bookings::where("event_id",$result['eventId'])->where("user_id",$result['userId'])->first();
        
        if(empty($check)){
            $decodes = json_encode($result['users']);
            $code = str::random(30);
            $vip_booking = new Bookings;
            $vip_booking->booking_type     = "2";
            $vip_booking->event_id         = $result['eventId'];
            $vip_booking->vip_booth_id     = $result['packageId'];
            $vip_booking->booking_id       = $code;
            $vip_booking->user_id          = $result['userId'];
            $vip_booking->guest_lists      = $decodes ;
            $vip_booking->unique_id        = $unique_id;
          

            $vip_booking->save();
           
            $userFind = user_infos::where('user_id',$result['userId'])->first();
            $message = "Vip Booking Created Successfully.";
            $this->mobile_push_notification($message,$userFind->player_id);
            $events = Event::find($result['eventId']);
            foreach($result['users'] as $user){
                $newcode = str::random(30);
                if($user['id'] != "-1"){
                    $notification = new AdminNotification;
                    $notification->user_id = $user['id'];
                    $notification->booked_by = $result['userId'];
                    $notification->booked_by_username = $userFind->first_name.' '.$userFind->last_name;
                    $notification->notification_type  = "4";
                    $notification->event_id = $result['eventId'];
                    $notification->event_name = $events->event_name;
                    $notification->event_description = $events->event_short_description;
                    $notification->event_date = $events->event_date;
                    $notification->save();
                     $guest_list = new Guest;
                        $guest_list->host_id         = $result['userId'];
                        $guest_list->booking_id       = $code;
                        $guest_list->user_id          = $user['id'];
                        $guest_list->first_name      = $user['name'] ;
                        $guest_list->last_name      = $user['sur_name'] ;
                        $guest_list->save();
                    $userFind = user_infos::where('user_id',$user['id'])->first();
                    $message = "You Are Invited For An Event";
                    $this->mobile_push_notification($message,$userFind->player_id);
                }
               
                
            }
            return response()->json(['qr_code' => $code,'success' => true], 200);
        }else{
            $decodes = json_encode($result['users']);
            Bookings::where('id','=',$check->id)->update([
            'guest_lists'=>$decodes,
            ]);
            $message = "Booking List Updated";
            $userFind = user_infos::where('user_id',$result['userId'])->first();
            $this->mobile_push_notification($message,$userFind->player_id);
            return response()->json(['message' => "Booking List Updated",'qr_code' => $check->booking_id, 'success' => true], 200);
        }
    }
    function update_vip_booth_booking_api(Request $req){
        $result = json_decode(file_get_contents("php://input"), true);
        $check = Bookings::where("user_id",$result['userId'])->where("unique_id",$result['uniqueId'])->whereNull("booking_user_id")->first();
        $decodes = json_encode($result['users']);
        Bookings::where('id','=',$check->id)->update([
          'guest_lists'=>$decodes,
        ]);
        $code = str::random(30);
        $userFind = user_infos::where('user_id',$result['userId'])->first();
        $message = "Vip Booking Guest List Updates Successfully.";
        $this->mobile_push_notification($message,$userFind->player_id);
        $events = Event::find($check->event_id);
        Bookings::where('unique_id', $result['uniqueId'])->whereNotNull("booking_user_id")->delete();
        foreach($result['users'] as $user){
            $newcode = str::random(30);
            if($user['id'] != "-1"){
                $notification = new AdminNotification;
                $notification->user_id = $user['id'];
                $notification->booked_by = $result['userId'];
                $notification->booked_by_username = $userFind->first_name.' '.$userFind->last_name;
                $notification->notification_type  = "4";
                $notification->event_id = $check->event_id;
                $notification->event_name = $events->event_name;
                $notification->event_description = $events->event_short_description;
                $notification->event_date = $events->event_date;
                $notification->save();
                $userFind = user_infos::where('user_id',$user['id'])->first();
                $message = "You Are Invited For An Event";
                $this->mobile_push_notification($message,$userFind->player_id);
            }
           
            
        }
        return response()->json(['message' => "Guest List Updated Successfully", 'success' => true], 200);
    }
    function update_vip_booth_booking_status_api(Request $req){
        Bookings::where('booking_id','=',$req->booking_id)->update([
          'status'=>$req->status,
        ]);
        $check = Bookings::where("booking_id",$req->booking_id)->first();
        $userFind = user_infos::where('user_id',$check->booking_user_id)->first();
        $message = "User ".$req->status." the invite";
        $this->mobile_push_notification($message,$userFind->player_id);
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
