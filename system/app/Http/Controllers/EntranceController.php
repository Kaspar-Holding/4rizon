<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\user_infos;

use Illuminate\Support\Facades\Hash;
use App\UserEmails;
use App\Models\Dha_profile;

use App\Models\Dha_Address;

use Illuminate\Support\Str;

use App\Models\user_wallets;

use DB;
use Carbon\Carbon;

use App\Models\Event;
use App\Models\Entries;
use App\Models\DjUser;
use App\Models\VipPkg;
use App\Models\Users;
use App\Models\Bookings;
use App\Models\Purchase;
use App\Models\Item;
use App\Models\PasswordReset2;

use App\Models\EventAttend;

class EntranceController extends Controller
{
    
    public function manual_event_list(){
    	$event_data = Event::all();
        return response()->json(['event_list' =>$event_data,'image_url'=>'https://4rizon.com/image/', 'success' => true], 200);
    }
    public function find_user(){
        $type = "application/json";
        $result = json_decode(file_get_contents("php://input"), true);
        $check = user_infos::where('identification_num',$result['identification_number'])->first();
        if (!empty($check)) {
            return response()->json(['message' =>"User found",'user_name'=>$check->first_name.' '.$check->last_name, 'identification_type'=>$check->identification_type,'identification_number'=>$check->identification_num,'success' => true], 200);
        }
        else{
            return response()->json(['message' =>"User not found",'success' => false], 404);
        }
    }
    public function boarding_status(){
        $type = "application/json";
        $result = json_decode(file_get_contents("php://input"), true);
        $check = user_infos::where('user_id',$result['user_id'])->first();
        if (!empty($check)) {
            user_infos::where('user_id','=',$result['user_id'])->update(['on_boarding_status'=>'1']);
            return response()->json(['status'=>'1','success' => true], 200);
        }
        else{
            return response()->json(['message' =>"Failed",'success' => false], 404);
        }
    }
    public function reset_password_entrance(Request $req){
        $user = Users::where('email',$req->email)->first();
       
        if(is_null($user)){
          return response()->json(["message" => "User Not Found"], 201);  
        }else{
          UserEmails::passwordReset2($req->email);  
          return response()->json(["message" => "Email Sent"], 200);
        }
    }
    function update_password_entrance(Request $request){
 
        $validator = \Validator::make($request->all(), [
          'password' =>  'required|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|min:8|max:191',
          'email' => 'required',
        ]);
        if ($validator->fails()) {
          $responseArr['message'] = $validator->errors();
          return response()->json($responseArr);
         
        }
        try{
            $email=$request->email;
            $password = $request->password;
            $user_infos=DB::table('users')->select('email')->where('email',$request->email)->first();
            if (empty($user_infos)) {
                return ['code'=>'201','status'=>'failed','message'=>'Invalid EMAIL'];
            }
            if(!empty($user_infos)){
                PasswordReset2::where('email','=',$request->email)->update([
                    'password'=>$password
                  ]);
              $password = Hash::make($request->password);
              Users::where('email','=',$request->email)->update([
                'password'=>$password
              ]);
              return view("success");
              
            }
        }catch(\Exception $e){
            return response()->json(["status"=>"error", "code" => 201, "message"=> $e->getMessage()]);
            
        }
        return view("success");
    } 
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
    public function manual_user_going_to_event(Request $req){
        $check = Bookings::where('event_id',$req->event_id)->where("booking_type","1")->where('user_id',$req->user_id)->first();
        if (!empty($check)) {
            $message = "";
            if ($check['qr_code_status'] == "0" ){
                $message = "Already Going";
            
            }
            else if ($check['qr_code_status'] == "1" ){
                $message = "Entered the Club";
            } 
            else if ($check['qr_code_status'] == "-1" ){
                $message = "Denied Access at Club";
            } 
            else if ($check['qr_code_status'] == "2" ){
                $message = "Already Exited";
            }
            return response()->json(['message' => $message,'success' => true], 200);
        }else{
            // $eventDetails = Event::find($req->event_id);
            $event = new Bookings;
            $event->event_id   = $req->event_id;
            $event->user_id   = $req->user_id;
            $event->booking_type   = "1";
            $event->vip_booth_id   = "";
            // $event->event_name   = $eventDetails->event_name;
            // $event->event_short_description   = $eventDetails->event_short_description;
            // $event->event_date   = $eventDetails->event_date;
            $event->status   = $req->status;
            $event->save();
            $id = Bookings::orderBy('id', 'desc')->first();
            return response()->json(['message' => "User Event Record Created", 'success' => true,"event_id"=>$id], 200);
            // return response()->json(['message' => "User Event Record Created", 'success' => true], 200);
        }
        
    }
    public function manual_register_user(Request $req) {
        $type = "application/json";

        $user_infos = user_infos::where('email','=',$req->email)->get();

        if (sizeof($user_infos) > 0){
          return response()->json(["status"=>"0","message" => "Email already exists!"], 404);
        }else{
            $user_infos = user_infos::where('identification_num','=',$req->identification_num)->where('identification_type',$req->identification_type)->get();
            if (sizeof($user_infos) > 0){
                return response()->json(["status"=>"0","message" => "ID Number already registered!"], 404);
            }else{
                $validator = \Validator::make($req->all(), [
                    'first_name'   => 'required|string|max:191',
                    'last_name'    => 'required|string|max:191',
                    'phone_number' => 'required',
                    'email'        => 'required',
                    'password'     => 'required',
                    'c_password'   => 'required',
                    'identification_type'  => 'required',
                    'identification_num'  => 'required',
                    'dob'          => 'required',
                    'nationality'  => 'required',
                    'gender'  => 'required',
                ]);
                if ($validator->fails()) {
                    $responseArr['message'] = $validator->errors();
                    return response()->json($responseArr);
                }
                if ($req->password == $req->c_password) {
                    $user_infos = new user_infos;
                    $user_infos->first_name       = $req->first_name;
                    $user_infos->last_name        = $req->last_name;
                    $user_infos->phone_number     = $req->phone_number;
                    $user_infos->email            = $req->email;
                    $user_infos->password         = Hash::make($req->password);
                    $user_infos->identification_type = $req->identification_type;
                    $user_infos->identification_num = $req->identification_num;
                    $user_infos->dob              = $req->dob;
                    $user_infos->nationality      = $req->nationality;
                    $user_infos->gender           = $req->gender;
                    $user_infos->user_status      = "0";
                    $user_infos->remember_token   = str::random(50);
                    $user_infos->role             = "user";
                    $user_infos->save();
                    $user = user_infos::where('email', $req->email)->first();
                    $user_wallet = new user_wallets;
                    $user_wallet->user_id      = $user->user_id;
                    $user_wallet->available_points    = 0;
                    $user_wallet->save();
                    $user_id = DB::table('user_infos')->orderBy('user_id', 'DESC')->first();
                    $data_array = array();
                    $data_array['Token'] = "9a88abd8-2f4a-4f6f-bbcf-22755254f89b";
                    $data_array['Username'] = "Jynx";
                    $data_array['Password'] = "Pass12345";
                    $data_array['TransactionReference'] = "Your internal reference";
                    $data_array['idNumber'] = $req->identification_num;
                    // $user_infos = user_infos::where('user_infos.user_id','=',$user_id)->first();
                    if ($req->identification_type == "1") {
                        $data_array['idNumber'] = $req->identification_num;
                        $make_call = json_decode($this->callCoreInfoAPI(json_encode($data_array)),true);
                        $dha_info = new Dha_profile;
                        $dha_info->user_id              = $user_id->user_id;
                        $dha_info->identification_num   = $user_id->identification_num;
                        $dha_info->personName           = $make_call['personName'];
                        $dha_info->personSurname        = $make_call['personSurname'];
                        $dha_info->gender               = $make_call['gender'];
                        $dha_info->dateOfBirth          = $make_call['dateOfBirth'];
                        $dha_info->aliveStatus          = $make_call['aliveStatus'];
                        $dha_info->save();
                        $make_call = json_decode($this->callContactInfoAPI(json_encode($data_array)),true);
                        $dha_address = new Dha_Address;
                        $dha_address->user_id              = $user_id->user_id;
                        $dha_address->identification_num   = $user_id->identification_num;
                        $dha_address->addressLine1         = $make_call['addressLine1'];
                        $dha_address->addressLine2         = $make_call['addressLine2'];
                        $dha_address->addressLine3         = $make_call['addressLine3'];
                        $dha_address->addressLine4         = $make_call['addressLine4'];
                        $dha_address->addressLine5         = $make_call['addressLine5'];
                        $dha_address->save();
                    }
                    return response()->json(["status"=>"1","message" => "User Registered Successfully","user_data"=>$user_id], 200);
                }else{
                    return response()->json(["status"=>"0","message" => "Passwords Didn't Matched"], 404);
                }
            }
        
        }
    }
    public function manual_user_details(Request $req)
    {
        $type = "application/json";
        $json_input = json_decode(file_get_contents("php://input"), true);
        $validator = \Validator::make($req->all(), [
            'user_id'   => 'required',
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        $user_infos = user_infos::where('user_id','=',$req->user_id)->get();
        $dha_user_infos = Dha_profile::selectRaw('personName,personSurname,gender,dateOfBirth,aliveStatus')->where('user_id','=',$req->user_id)->get();
        $dha_address_infos = Dha_Address::selectRaw('addressLine1,addressLine2,addressLine3,addressLine4,addressLine5')->where('user_id','=',$req->user_id)->get();
        $a = array();
        if (sizeof($dha_user_infos) > 0) {
            $combined_user_data = array_merge($user_infos->toArray()[0],$dha_user_infos->toArray()[0]);
            if (sizeof($dha_address_infos) > 0){
            $combined_user_data = array_merge($combined_user_data,$dha_address_infos->toArray()[0]);}
            # code...
        }
        if (sizeof($user_infos) == 0){
          return response()->json(["status"=>"0","message" => "User not found!","user_data"=>$combined_user_data], 404);
        }
        else{            
            
            return response()->json(["status"=>"1","message" => "User found!","user_data"=>$user_infos], 200);
        }
        # code...
    }
    private function callCoreInfoAPI($data)
	{
		$curl = curl_init();
		//OPTIONS:
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_URL, "https://flexywarebio.com/biometric/getdhaidinfo");
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json',));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		//EXECUTE:
		$result = curl_exec($curl);
		if(!$result){die("Connection Failure");}
		curl_close($curl);
		
		return $result;
	}
    private function callContactInfoAPI($data)
	{
		$curl = curl_init();
		//OPTIONS:
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_URL, "https://flexywarebio.com/homeaffairs/getcontactinfo");
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json',));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		//EXECUTE:
		$result = curl_exec($curl);
		if(!$result){die("Connection Failure");}
		curl_close($curl);
		
		return $result;
	}
    public function user_in_club(Request $req)
    {
        $type = "application/json";
        $json_input = json_decode(file_get_contents("php://input"), true);
        $validator = \Validator::make($req->all(), [
            'user_id'   => 'required'
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        $user_infos = user_infos::selectRaw('user_id,club_status,event_id')->where([['user_id','=',$req->user_id],['club_status','=',"1"]])->whereNotNull('event_id')->get();
        if (sizeof($user_infos) == 0){
            $user_info1 = user_infos::selectRaw('user_id,club_status,event_id')->where([['user_id','=',$req->user_id]])->get();
            return response()->json(["status"=>"0","message" => "User is not in Club!","user_data"=>$user_info1], 404);

        }
        else{            
            foreach ($user_infos as $key => &$r) {
                $event_data = Bookings::where([['user_id','=',$r['user_id']],['event_id','=',$r['event_id']]])->get();
                $r['event_data'] = $event_data;
                # code...
            }
            unset($r);
            return response()->json(["status"=>"0","message" => "User found!","user_data"=>$user_infos], 200);
        }
        # code...
    }
    public function manual_user_status_change(Request $req)
    {
        $type = "application/json";
        $json_input = json_decode(file_get_contents("php://input"), true);
        $validator = \Validator::make($req->all(), [
            'user_id'   => 'required',
            'user_status' => 'required',
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        $user_infos = user_infos::where('user_id','=',$req->user_id)->get();
        if (sizeof($user_infos) == 0){
            return response()->json(["status"=>"0","message" => "User not found!","user_data"=>$json_input], 404);
        }
        else{  
            user_infos::where('user_id','=',$req->user_id)->update(['user_status'=>$req->user_status]);
            $user_infos = user_infos::where('user_id','=',$req->user_id)->get();
            return response()->json(["status"=>"1","message" => "User status updated successfully!","user_data"=>$user_infos], 200);
            
            
            
        }
        # code...
    }
    public function manual_user_check(Request $req)
    {
        $type = "application/json";
        $json_input = json_decode(file_get_contents("php://input"), true);
        $validator = \Validator::make($req->all(), [
            'first_name'   => 'required',
            'last_name'   => 'required',
            'identification_type'   => 'required',
            'identification_num'   => 'required',
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        $user_infos = user_infos::where([['first_name','=',$req->first_name],['last_name','=',$req->last_name],['identification_type','=',$req->identification_type],['identification_num','=',$req->identification_num]])->get();
        if (sizeof($user_infos) == 0){
          return response()->json(["status"=>"0","message" => "User not found!","user_data"=>$json_input], 404);
        }
        else{            
            
            return response()->json(["status"=>"1","message" => "User found!","user_data"=>$user_infos], 200);
        }
        # code...
    }
    public function shop_qr_reading(Request $req)
    {
        $type = "application/json";
        $validator = \Validator::make($req->all(), [
            'booking_id'   => 'required'
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        $booking_infos = Purchase::where('purchase_id','=',$req->booking_id)->get();
        if (sizeof($booking_infos) == 0){
            return response()->json(["qr_information"=>[["message"=> "Item not found!"]]], 404);
        //   return response()->json(["response"=> "Booking not found!"], 404);
        }
        else{            
            
            $user_infos = user_infos::select('user_id','first_name','last_name','email','phone_number','gender','dob','identification_type','identification_num','nationality')->where('user_infos.user_id','=',$booking_infos->pluck('user_id'))->get();
            $dha_user_infos = Dha_profile::selectRaw('personName,personSurname,gender,dateOfBirth,aliveStatus')->where('user_id','=',$booking_infos->pluck('user_id'))->get();
            $dha_address_infos = Dha_Address::selectRaw('addressLine1,addressLine2,addressLine3,addressLine4,addressLine5')->where('user_id','=',$booking_infos->pluck('user_id'))->get();
            $item_info = Item::select()->where('id','=',$booking_infos->pluck('item_id'))->get();
            $combined_user_data = $booking_infos->toArray()[0];
            if (sizeof($dha_user_infos) > 0) {
                // $combined_user_data = array_merge($user_infos->toArray()[0],$dha_user_infos->toArray());
                $combined_user_data['dha_details'] = $dha_user_infos->toArray()[0];
                $combined_user_data['dha_details'] = array_merge($combined_user_data['dha_details'],$dha_address_infos->toArray());
                
                # code...
            } 
            // else {
            //     $combined_user_data['dha_details'] = [];
            //     # code...
            // }
            $combined_user_data['user_details'] = $user_infos->toArray()[0];
            $combined_user_data["item_details"] = $item_info->toArray()[0];
            return response()->json(["qr_information"=>[$combined_user_data]], 200);
        }
        # code...
    }
    public function check_booking_type(Request $req){
        $type = "application/json";
        $validator = \Validator::make($req->all(), [
            'booking_id'   => 'required'
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        $booking_infos = Bookings::select('booking_type')->where('booking_id','=',$req->booking_id)->get();
        if (sizeof($booking_infos) == 0){
            // return response()->json(["qr_information"=>[["message"=> "Booking not found!"]]], 200);
            return response()->json(["qr_information"=>[["booking_type"=> "0"]]], 200);
        //   return response()->json(["response"=> "Booking not found!"], 404);
        }
        else{
            return response()->json(["qr_information"=>[["booking_type"=> $booking_infos->pluck("booking_type")[0]]]], 200);
        }
    }
    public function dj_event_booking_qr_reading(Request $req)
    {
        $type = "application/json";
        $validator = \Validator::make($req->all(), [
            'booking_id'   => 'required'
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        $booking_infos = Bookings::where('booking_id','=',$req->booking_id)->get();
        if (sizeof($booking_infos) == 0){
            return response()->json(["qr_information"=>[["message"=> "Booking not found!"]]], 404);
        //   return response()->json(["response"=> "Booking not found!"], 404);
        }
        else{            
            // print_r($booking_infos->toArray()[0]);
            // $booking_infos = Bookings::where('booking_id','=',$req->booking_id)->get();
            // $combined_user_data = array();
            if ($booking_infos[0]['booking_type'] == "4"){
                $user_infos = DjUser::where('id','=',$booking_infos->pluck('dj_id'))->get();
                $event_info = Event::select()->where('id','=',$booking_infos->pluck('event_id'))->get();
                // $vip_booth_info = array();
                // $a = array();
                $combined_user_data = $booking_infos->toArray()[0];
                // $combined_user_data['user_details'] = $user_infos->toArray();
                
                $combined_user_data = $booking_infos->toArray()[0];
                $combined_user_data['user_details'] = $user_infos->toArray()[0];
                $combined_user_data["event_details"] = $event_info->toArray()[0];
            }else {
              return response()->json(["qr_information"=>[["message"=> "Booking not found!"]]], 404);
            }
            return response()->json(["qr_information"=>[$combined_user_data]], 200);
        }
        # code...
    }
    public function event_booking_qr_reading(Request $req)
    {
        $type = "application/json";
        $validator = \Validator::make($req->all(), [
            'booking_id'   => 'required'
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        $booking_infos = Bookings::where('booking_id','=',$req->booking_id)->get();
        if (sizeof($booking_infos) == 0){
            return response()->json(["qr_information"=>[["message"=> "Booking not found!"]]], 404);
        //   return response()->json(["response"=> "Booking not found!"], 404);
        }
        else{     
            $booking_infoss = Bookings::where('booking_id','=',$req->booking_id)->first();     
            $date = Carbon::now();
            $entry = new Entries ;
            $entry->user_id = $booking_infoss->user_id;
            $entry->event_id = $booking_infoss->event_id;
            if(!empty($req->reason)){
                $entry->reason = $req->reason;
            }
            $entry->entered_at = $date;
            $entry->save();

            // print_r($booking_infos->toArray()[0]);
            // $booking_infos = Bookings::where('booking_id','=',$req->booking_id)->get();
            $combined_user_data = array();
            if ($booking_infos[0]['booking_type'] == "4"){
                $user_infos = DjUser::where('id','=',$booking_infos->pluck('dj_id'))->get();
                $event_info = Event::select()->where('id','=',$booking_infos->pluck('event_id'))->get();
                // $vip_booth_info = array();
                // $a = array();
                $combined_user_data = $booking_infos->toArray()[0];
                // $combined_user_data['user_details'] = $user_infos->toArray();
                
                $combined_user_data = $booking_infos->toArray()[0];
                $combined_user_data['user_details'] = $user_infos->toArray()[0];
                $combined_user_data["event_details"] = $event_info->toArray()[0];
            }
            if ($booking_infos[0]['booking_type'] == "1"){
                $user_infos = user_infos::select('user_id','first_name','last_name','email','phone_number','gender','dob','identification_type','identification_num','nationality')->where('user_infos.user_id','=',$booking_infos->pluck('user_id'))->get();
                $dha_user_infos = Dha_profile::selectRaw('personName,personSurname,gender,dateOfBirth,aliveStatus')->where('user_id','=',$booking_infos->pluck('user_id'))->get();
                $dha_address_infos = Dha_Address::selectRaw('addressLine1,addressLine2,addressLine3,addressLine4,addressLine5')->where('user_id','=',$booking_infos->pluck('user_id'))->get();
                $event_info = Event::select()->where('id','=',$booking_infos->pluck('event_id'))->get();
                // $vip_booth_info = array();
                // $a = array();
                $combined_user_data = $booking_infos->toArray()[0];
                // $combined_user_data['user_details'] = $user_infos->toArray();
                
                $combined_user_data = $booking_infos->toArray()[0];
                $combined_user_data['user_details'] = $user_infos->toArray()[0];
                $combined_user_data["event_details"] = $event_info->toArray()[0];
                if (sizeof($dha_user_infos) > 0) {
                    // $combined_user_data = array_merge($user_infos->toArray()[0],$dha_user_infos->toArray());
                    $combined_user_data['dha_details'] = $dha_user_infos->toArray()[0];
                    if (sizeof($dha_address_infos) > 0) {
                        $combined_user_data['dha_details'] = array_merge($combined_user_data['dha_details'],$dha_address_infos->toArray()[0]);
                    }
                    
                    # code...
                } 
            }
            // else {
            //         $combined_user_data = $user_infos->toArray()[0];
            //         # code...
            // }
            if ($booking_infos[0]['booking_type'] == "2"){
                $user_infos = user_infos::select('user_id','first_name','last_name','email','phone_number','gender','dob','identification_type','identification_num','nationality')->where('user_infos.user_id','=',$booking_infos->pluck('user_id'))->get();
                $dha_user_infos = Dha_profile::selectRaw('personName,personSurname,gender,dateOfBirth,aliveStatus')->where('user_id','=',$booking_infos->pluck('user_id'))->get();
                $dha_address_infos = Dha_Address::selectRaw('addressLine1,addressLine2,addressLine3,addressLine4,addressLine5')->where('user_id','=',$booking_infos->pluck('user_id'))->get();
                $event_info = Event::select()->where('id','=',$booking_infos->pluck('event_id'))->get();
                // $vip_booth_info = array();
                // $a = array();
                $combined_user_data = $booking_infos->toArray()[0];
                // $combined_user_data['user_details'] = $user_infos->toArray();
                
                $combined_user_data = $booking_infos->toArray()[0];
                $combined_user_data['user_details'] = $user_infos->toArray()[0]; 
                $combined_user_data["event_details"] = $event_info->toArray()[0];
                if (sizeof($dha_user_infos) > 0) {
                    // $combined_user_data = array_merge($user_infos->toArray()[0],$dha_user_infos->toArray());
                    $combined_user_data['dha_details'] = $dha_user_infos->toArray()[0];
                    if (sizeof($dha_address_infos) > 0) {
                        $combined_user_data['dha_details'] = array_merge($combined_user_data['dha_details'],$dha_address_infos->toArray()[0]);
                    }
                    
                    # code...
                } 
                $vip_booth_info = VipPkg::select()->where('id','=',$booking_infos->pluck('vip_booth_id'))->get();
                $combined_user_data['vip_booth_details'] = $vip_booth_info->toArray()[0];
                $combined_user_data['guest_lists'] = json_decode($booking_infos[0]["guest_lists"],true);
                
                // print_r($combined_user_data);
                foreach($combined_user_data['guest_lists'] as $guest => &$r){
                    $r['guest_user_detail'] = user_infos::select('user_id','first_name','last_name','email','phone_number','gender','dob','identification_type','identification_num','nationality')->where('user_infos.user_id','=',$r['id'])->get()->toArray()[0];
                    $dha_guest_user_infos = Dha_profile::selectRaw('personName,personSurname,gender,dateOfBirth,aliveStatus')->where('user_id','=',$r['id'])->get();
                    $dha_guest_user_address_infos = Dha_Address::selectRaw('addressLine1,addressLine2,addressLine3,addressLine4,addressLine5')->where('user_id','=',$r['id'])->get();
                    if (sizeof($dha_guest_user_infos) > 0) {
                        // $combined_user_data = array_merge($user_infos->toArray()[0],$dha_user_infos->toArray());
                        $r['guest_user_dha_details'] = $dha_guest_user_infos->toArray()[0];
                        if (sizeof($dha_guest_user_address_infos) > 0) {
                        $r['guest_user_dha_details'] = array_merge($r['guest_user_dha_details'],$dha_guest_user_address_infos->toArray()[0]);
                        }
                        
                        # code...
                    } 
                }
                unset($r);
                $combined_user_data['vip_booth_details']['reserved_seats'] = sizeof($combined_user_data['guest_lists']);
                $combined_user_data['vip_booth_details']['remaining_seats'] = (int)$combined_user_data['vip_booth_details']['max_guests'] - sizeof($combined_user_data['guest_lists']);
            }
            if ($booking_infos[0]['booking_type'] == "3"){
                $user_infos = user_infos::select('user_id','first_name','last_name','email','phone_number','gender','dob','identification_type','identification_num','nationality')->where('user_infos.user_id','=',$booking_infos->pluck('user_id'))->get();
                $dha_user_infos = Dha_profile::selectRaw('personName,personSurname,gender,dateOfBirth,aliveStatus')->where('user_id','=',$booking_infos->pluck('user_id'))->get();
                $dha_address_infos = Dha_Address::selectRaw('addressLine1,addressLine2,addressLine3,addressLine4,addressLine5')->where('user_id','=',$booking_infos->pluck('user_id'))->get();
                $event_info = Event::select()->where('id','=',$booking_infos->pluck('event_id'))->get();
                // $vip_booth_info = array();
                // $a = array();
                $combined_user_data = $booking_infos->toArray()[0];
                // $combined_user_data['user_details'] = $user_infos->toArray();
                
                $combined_user_data = $booking_infos->toArray()[0];
                $combined_user_data['user_details'] = $user_infos->toArray()[0];
                $combined_user_data["event_details"] = $event_info->toArray()[0];
                if (sizeof($dha_user_infos) > 0) {
                    // $combined_user_data = array_merge($user_infos->toArray()[0],$dha_user_infos->toArray());
                    $combined_user_data['dha_details'] = $dha_user_infos->toArray()[0];
                    if (sizeof($dha_address_infos) > 0) {
                        $combined_user_data['dha_details'] = array_merge($combined_user_data['dha_details'],$dha_address_infos->toArray()[0]);
                    }
                    
                    # code...
                } 
                $booked_by = user_infos::select()->where('user_id','=',$booking_infos->pluck('booking_user_id'))->get();
                $vip_booth_info = VipPkg::select()->where('id','=',$booking_infos->pluck('vip_booth_id'))->get();
                $combined_user_data['booked_by'] = $booked_by->toArray()[0];
                $combined_user_data['vip_booth_details'] = $vip_booth_info->toArray()[0];
                // $combined_user_data['guest_lists'] = json_decode($booking_infos[0]["guest_lists"],true);
                if (!empty(json_decode($booking_infos[0]["guest_lists"],true))) {
                    $combined_user_data['guest_lists'] = json_decode($booking_infos[0]["guest_lists"],true);
                    // print_r($combined_user_data);
                    foreach($combined_user_data['guest_lists'] as $guest => &$r){
                        $r['guest_user_detail'] = user_infos::select('user_id','first_name','last_name','email','phone_number','gender','dob','identification_type','identification_num','nationality')->where('user_infos.user_id','=',$r['id'])->get()->toArray()[0];
                        $dha_guest_user_infos = Dha_profile::selectRaw('personName,personSurname,gender,dateOfBirth,aliveStatus')->where('user_id','=',$r['id'])->get();
                        $dha_guest_user_address_infos = Dha_Address::selectRaw('addressLine1,addressLine2,addressLine3,addressLine4,addressLine5')->where('user_id','=',$r['id'])->get();
                        if (sizeof($dha_guest_user_infos) > 0) {
                            // $combined_user_data = array_merge($user_infos->toArray()[0],$dha_user_infos->toArray());
                            $r['guest_user_dha_details'] = $dha_guest_user_infos->toArray()[0];
                            if (sizeof($dha_guest_user_address_infos) > 0) {
                            $r['guest_user_dha_details'] = array_merge($r['guest_user_dha_details'],$dha_guest_user_address_infos->toArray()[0]);
                            }
                            
                            # code...
                        } 
                    }
                    unset($r);
                    $combined_user_data['vip_booth_details']['reserved_seats'] = sizeof($combined_user_data['guest_lists']);
                    $combined_user_data['vip_booth_details']['remaining_seats'] = (int)$combined_user_data['vip_booth_details']['max_guests'] - sizeof($combined_user_data['guest_lists']);
                } else {
                    $combined_user_data['guest_list_error_message'] = "Guest List is missing data";
                    // return response()->json(["qr_information"=>[["message"=> "Your Booking is missing Guest Users Details!"]]], 404);
                }
            }
            return response()->json(["qr_information"=>[$combined_user_data]], 200);
        }
        # code...
    }
    public function user_n_event_details(Request $req)
    {
        $type = "application/json";
        $validator = \Validator::make($req->all(), [
            'user_id'   => 'required',
            'dj_id'   => 'required',
            'booking_type'   => 'required',
            'booking_id'   => 'required'
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        if ($req->booking_type == "4") {
            $booking_infos = Bookings::where('dj_id','=',$req->dj_id)->where('booking_id','=',$req->booking_id)->get();
            if (sizeof($booking_infos) == 0){
              return response()->json(["message" => "Booking not found!"], 404);
            }
            else{            
                
                $user_infos = DjUser::where('user_infos.dj_id','=',$booking_infos->pluck('dj_id'))->get();
                // $dha_user_infos = Dha_profile::selectRaw('personName,personSurname,gender,dateOfBirth,aliveStatus')->where('user_id','=',$booking_infos->pluck('user_id'))->get();
                // $dha_address_infos = Dha_Address::selectRaw('addressLine1,addressLine2,addressLine3,addressLine4,addressLine5')->where('user_id','=',$booking_infos->pluck('user_id'))->get();
                // $a = array();
                // if (sizeof($dha_user_infos) > 0) {
                //     $combined_user_data = array_merge($user_infos->toArray()[0],$dha_user_infos->toArray());
                //     $combined_user_data = array_merge($combined_user_data,$dha_address_infos->toArray());
                //     # code...
                // } else {
                $combined_user_data = $user_infos->toArray()[0];
                    # code...
                // }
                
                $combined_user_data = array_merge($combined_user_data,$booking_infos->toArray()[0]);
                return response()->json(["user_infos"=>[$combined_user_data]], 200);
            }
        } else {
            $booking_infos = Bookings::where('user_id','=',$req->user_id)->where('booking_id','=',$req->booking_id)->get();
            if (sizeof($booking_infos) == 0){
              return response()->json(["message" => "Booking not found!"], 404);
            }
            else{            
                
                $user_infos = user_infos::where('user_infos.user_id','=',$booking_infos->pluck('user_id'))->get();
                $dha_user_infos = Dha_profile::selectRaw('personName,personSurname,gender,dateOfBirth,aliveStatus')->where('user_id','=',$booking_infos->pluck('user_id'))->get();
                $dha_address_infos = Dha_Address::selectRaw('addressLine1,addressLine2,addressLine3,addressLine4,addressLine5')->where('user_id','=',$booking_infos->pluck('user_id'))->get();
                $a = array();
                if (sizeof($dha_user_infos) > 0) {
                    $combined_user_data = array_merge($user_infos->toArray()[0],$dha_user_infos->toArray());
                    $combined_user_data = array_merge($combined_user_data,$dha_address_infos->toArray());
                    # code...
                } else {
                    $combined_user_data = $user_infos->toArray()[0];
                    # code...
                }
                
                $combined_user_data = array_merge($combined_user_data,$booking_infos->toArray()[0]);
                return response()->json(["user_infos"=>[$combined_user_data]], 200);
            }
        }
        # code...
    }
    public function change_purchase_status(Request $req)
    {
        $type = "application/json";
        $validator = \Validator::make($req->all(), [
            'booking_id'   => 'required',
            'user_id'   => 'required',
            'qr_code_status' => 'required',
            'admin_id' => 'required'
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        $booking_infos = Purchase::where('purchase_id','=',$req->booking_id)->where('user_id','=',$req->user_id)->first();
        if (sizeof(Purchase::where('purchase_id','=',$req->booking_id)->where('user_id','=',$req->user_id)->get()) == 0){
          return response()->json(["message" => "Booking not found!"], 404);
        }
        else{            
            $push_message = "";
            $message = "";
            $user_infos = user_infos::where('user_infos.user_id','=',$booking_infos->user_id)->first();
            if ($req->qr_code_status == "1") {                
                Purchase::where('purchase_id','=',$req->booking_id)->where('user_id','=',$req->user_id)->update(['redeemed_by'=>$req->admin_id,'redeemed_message'=>"Redemeed",'redeemed_status' => $req->qr_code_status]);
                $push_message = ucwords("You (".$user_infos->first_name." ".$user_infos->last_name).") redeemded product successfully";
                $message = ucwords($user_infos->first_name." ".$user_infos->last_name)." redeemded product successfully";
                # code...
            } 
            $this->mobile_push_notification($push_message,$user_infos->player_id);
            return response()->json(["status"=>"1","message"=>$message], 200);
        }
        
        # code...
    }
    public function change_dj_event_status(Request $req)
    {
        $type = "application/json";
        $validator = \Validator::make($req->all(), [
            'booking_id'   => 'required',
            'dj_id'   => 'required',
            'qr_code_status' => 'required',
            'admin_id' => 'required'
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        $booking_infos = Bookings::where('booking_id','=',$req->booking_id)->where('dj_id','=',$req->dj_id)->first();
        if (sizeof(Bookings::where('booking_id','=',$req->booking_id)->where('dj_id','=',$req->dj_id)->get()) == 0){
          return response()->json(["message" => "Booking not found!"], 404);
        }
        else{            
            date_default_timezone_set('Africa/Johannesburg');
            $message = "";
            $push_message = "";
            $user_infos = DjUser::where('id','=',$booking_infos->dj_id)->first();
            $event_info = Event::select()->where('id','=',$booking_infos->pluck('event_id'))->first();
            if ($req->qr_code_status == "1") {                
                Bookings::where('booking_id','=',$req->booking_id)->where('dj_id','=',$req->dj_id)->update(['entered_by'=>$req->admin_id,'status'=>"Entered",'qr_code_status' => $req->qr_code_status,"enter_at"=>date('Y-m-d H:i:s', time())]);
                Event::where('id','=',$event_info->event_id)->where('dj_id','=',$req->dj_id)->update(['dj_qr_code_status'=>$req->qr_code_status]);
                $push_message = ucwords("You (".$user_infos->first_name." ".$user_infos->last_name).") have entered successfully for ". $event_info->event_name. " at ".date("h:i:sa");
                $message = ucwords($user_infos->first_name." ".$user_infos->last_name)." entered successfully";
                # code...
            } else if ($req->qr_code_status == "2") {
                Bookings::where('booking_id','=',$req->booking_id)->where('dj_id','=',$req->dj_id)->update(['exited_by'=>$req->admin_id,'status'=>"Exited",'qr_code_status' => $req->qr_code_status,"exit_at"=>date('Y-m-d H:i:s', time())]);
                Event::where('id','=',$event_info->event_id)->where('dj_id','=',$req->dj_id)->update(['dj_qr_code_status'=>$req->qr_code_status]);
                $push_message = ucwords("You (".$user_infos->first_name." ".$user_infos->last_name).") have exited successfully for ". $event_info->event_name. " at ".date("h:i:sa");
                $message = ucwords($user_infos->first_name." ".$user_infos->last_name)." exited successfully";
                # code...
            } else if ($req->qr_code_status == "-1") {
                Bookings::where('booking_id','=',$req->booking_id)->where('dj_id','=',$req->dj_id)->update(['denied_by'=>$req->admin_id,'status'=>"Denied",'qr_code_status' => $req->qr_code_status,"denied_at"=>date('Y-m-d H:i:s', time())]);
                Event::where('id','=',$event_info->event_id)->where('dj_id','=',$req->dj_id)->update(['dj_qr_code_status'=>$req->qr_code_status]);
                $push_message = ucwords("You (".$user_infos->first_name." ".$user_infos->last_name).") have denied entry for ". $event_info->event_name. " at ".date("h:i:sa");
                $message = ucwords($user_infos->first_name." ".$user_infos->last_name)." denied entry";
            } else if ($req->qr_code_status == "0") {
                Bookings::where('booking_id','=',$req->booking_id)->where('dj_id','=',$req->dj_id)->update(['entered_by'=>null,'exited_by'=>null,'denied_by'=>null,'status'=>"Qr Code Created",'qr_code_status' => $req->qr_code_status,"enter_at"=>null,"exit_at"=>null,"denied_at"=>null]);
                Event::where('id','=',$event_info->event_id)->where('dj_id','=',$req->dj_id)->update(['dj_qr_code_status'=>$req->qr_code_status]);
                $push_message = ucwords("Your (".$user_infos->first_name." ".$user_infos->last_name).") data have been cleared for ". $event_info->event_name. " at ".date("h:i:sa");
                $message = ucwords($user_infos->first_name." ".$user_infos->last_name)." data cleared";
            }
            $this->mobile_push_notification($push_message,$user_infos->device_id);
            return response()->json(["status"=>"1","message"=>$message], 200);
        }
        
        # code...
    }
    public function change_event_status(Request $req)
    {
        $type = "application/json";
        $validator = \Validator::make($req->all(), [
            'booking_id'   => 'required',
            'user_id'   => 'required',
            'qr_code_status' => 'required',
            'admin_id' => 'required'
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        $booking_infos = Bookings::where('booking_id','=',$req->booking_id)->where('user_id','=',$req->user_id)->first();
        if (sizeof(Bookings::where('booking_id','=',$req->booking_id)->where('user_id','=',$req->user_id)->get()) == 0){
          return response()->json(["message" => "Booking not found!"], 404);
        }
        else{            
            date_default_timezone_set('Africa/Johannesburg');
            $message = "";
            $push_message = "";
            $user_infos = user_infos::where('user_infos.user_id','=',$booking_infos->user_id)->first();
            $event_info = Event::select()->where('id','=',$booking_infos->pluck('event_id'))->first();
            if ($req->qr_code_status == "1") {                
                Bookings::where('booking_id','=',$req->booking_id)->where('user_id','=',$req->user_id)->update(['entered_by'=>$req->admin_id,'status'=>"Entered",'qr_code_status' => $req->qr_code_status,"enter_at"=>date('Y-m-d H:i:s', time())]);
                user_infos::where('user_id','=',$booking_infos->user_id)->update(['club_status'=>"1",'event_id' => $booking_infos->event_id]);
                $push_message = ucwords("You (".$user_infos->first_name." ".$user_infos->last_name).") have entered successfully for ". $event_info->event_name. " at ".date("h:i:sa");
                $message = ucwords($user_infos->first_name." ".$user_infos->last_name)." entered successfully";
                # code...
            } else if ($req->qr_code_status == "2") {
                Bookings::where('booking_id','=',$req->booking_id)->where('user_id','=',$req->user_id)->update(['exited_by'=>$req->admin_id,'status'=>"Exited",'qr_code_status' => $req->qr_code_status,"exit_at"=>date('Y-m-d H:i:s', time())]);
                user_infos::where('user_id','=',$booking_infos->user_id)->update(['club_status'=>"0",'event_id' => null]);
                $push_message = ucwords("You (".$user_infos->first_name." ".$user_infos->last_name).") have exited successfully for ". $event_info->event_name. " at ".date("h:i:sa");
                $message = ucwords($user_infos->first_name." ".$user_infos->last_name)." exited successfully";
                # code...
            } else if ($req->qr_code_status == "-1") {
                Bookings::where('booking_id','=',$req->booking_id)->where('user_id','=',$req->user_id)->update(['denied_by'=>$req->admin_id,'status'=>"Denied",'qr_code_status' => $req->qr_code_status,"denied_at"=>date('Y-m-d H:i:s', time())]);
                user_infos::where('user_id','=',$booking_infos->user_id)->update(['club_status'=>"0",'event_id' => null]);
                $push_message = ucwords("You (".$user_infos->first_name." ".$user_infos->last_name).") have denied entry for ". $event_info->event_name. " at ".date("h:i:sa");
                $message = ucwords($user_infos->first_name." ".$user_infos->last_name)." denied entry";
            } else if ($req->qr_code_status == "0") {
                Bookings::where('booking_id','=',$req->booking_id)->where('user_id','=',$req->user_id)->update(['entered_by'=>null,'exited_by'=>null,'denied_by'=>null,'status'=>"Qr Code Created",'qr_code_status' => $req->qr_code_status,"enter_at"=>null,"exit_at"=>null,"denied_at"=>null]);
                user_infos::where('user_id','=',$booking_infos->user_id)->update(['club_status'=>"0",'event_id' => null]);
                $push_message = ucwords("Your (".$user_infos->first_name." ".$user_infos->last_name).") data have been cleared for ". $event_info->event_name. " at ".date("h:i:sa");
                $message = ucwords($user_infos->first_name." ".$user_infos->last_name)." data cleared";
            }
            $userFind = user_infos::where('user_id',$req->user_id)->first();
            $this->mobile_push_notification($push_message,$user_infos->player_id);
            return response()->json(["status"=>"1","message"=>$message], 200);
        }
        
        # code...
    }
    public function currently_in_club(Request $req)
    {
        $type = "application/json";
        // $data = Event::selectRaw("events.event_name,events.event_image,events.event_date,user_infos.first_name,user_infos.last_name,user_infos.picture as user_image")
        //             ->join('booking','events.id','=','booking.event_id')
        //             ->join('user_infos','user_infos.user_id','=','booking.user_id')
        //             ->where('booking.qr_code_status','=','1')->get();           
        // $data = Bookings::where('booking.qr_code_status','=','1')->get();
        $data = Event::selectRaw("distinct events.id as event_id,events.event_name,events.event_image,events.event_date")
                    ->join('booking','booking.event_id','=','events.id')
                    ->where('booking.qr_code_status','=','1')->get();  
        if (count($data) == 0){
            return response()->json(["status"=>"0","events"=>"No Users in the club right now"], 200);
        }else {
            
            $user_data = [];
            // $data[0]['users_data'] = [];
            foreach ($data as $key => &$r) {
                $booking_data = Bookings::where('booking.qr_code_status','=','1')->where('booking.event_id','=',$r['event_id'])->get();
                foreach ($booking_data as $key) {
                    if ($key['booking_type'] == 4) {
                        $user_id = Bookings::select('dj_id')->where('event_id','=',$key['event_id'])->where('qr_code_status','=','1')->get();
                        $user_data = [];
                        foreach ($user_id as $key) {
                            $user_data[] = DjUser::selectRaw('djusers.first_name,djusers.last_name,"" as user_image,djusers.id,booking.booking_id')
                            ->where("djusers.id",'=',$key['dj_id'])
                            ->join("booking","booking.dj_id",'=',"djusers.id")
                            ->first();
                            # code...
                        }
                        $r['users_data'] = $user_data;
                    } else {
                        $user_id = Bookings::select(DB::raw('user_id, booking_id'))->where('event_id','=',$key['event_id'])->where('qr_code_status','=','1')->get();
                        $user_data = [];
                        foreach ($user_id as $key) {
                            $user_data[] = user_infos::selectRaw('user_infos.first_name,user_infos.last_name,user_infos.picture as user_image,user_infos.user_id,booking.booking_id')
                            ->where("user_infos.user_id",'=',$key['user_id'])
                            ->where("booking.booking_id",'=',$key['booking_id'])
                            ->join("booking","booking.user_id",'=',"user_infos.user_id")
                            ->first();
                            # code...
                        }
                        $r['users_data'] = $user_data;
                    }
                }
                # code...
            }     
            unset($r);
            // foreach ($data['booking_data'] as $key => &$r){
            //     // print_r($r->booking_type);
            //     if ($r->booking_type == 4) {
            //         $user_id = Bookings::select('dj_id')->where('event_id','=',$r['event_id'])->where('qr_code_status','=','1')->get();
            //         $user_data = [];
            //         foreach ($user_id as $key) {
            //             $user_data[] = DjUser::selectRaw('djusers.first_name,djusers.last_name,"" as user_image,djusers.id,booking.booking_id')
            //             ->where("djusers.id",'=',$key['dj_id'])
            //             ->join("booking","booking.dj_id",'=',"djusers.id")
            //             ->first();
            //             # code...
            //         }
            //         $r['users_data'] = $user_data;
            //     } else {
            //         $user_id = Bookings::select('user_id')->where('event_id','=',$r['event_id'])->where('qr_code_status','=','1')->get();
            //         $user_data = [];
            //         foreach ($user_id as $key) {
            //             $user_data[] = user_infos::selectRaw('user_infos.first_name,user_infos.last_name,user_infos.picture as user_image,user_infos.user_id,booking.booking_id')
            //             ->where("user_infos.user_id",'=',$key['user_id'])
            //             ->join("booking","booking.user_id",'=',"user_infos.user_id")
            //             ->first();
            //             # code...
            //         }
            //         $r['users_data'] = $user_data;
            //     }
    
            // }
            // unset($r);    
            // $data['users_data'] = $user_data;
            return response()->json(["status"=>"1","events"=>$data], 200);
        }
        
        
        # code...
    }
    //
}
