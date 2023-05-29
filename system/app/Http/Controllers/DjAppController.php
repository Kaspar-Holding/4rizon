<?php

namespace App\Http\Controllers;
use Redirect;

use App\UserEmails;
use App\Models\DjUser;
use App\Models\Dj_Event;
use App\Models\Dj_Dha_Address;
use App\Models\Dj_Dha_profile;
use App\Models\Genre;
use App\Models\Sub_Genre;
use App\Models\DjAgreement;
use App\Models\DjAnswers;
use App\Models\EventReject;
use App\Models\Event;
use App\Models\user_infos;
use App\Models\Bookings;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;


class DjAppController extends Controller
{
    function register_djuser(Request $req) {
        $type = "application/json";
        $result = json_decode(file_get_contents("php://input"), true);
        $djusers = DjUser::where('email','=',$result['email'])->get();
        $phone_check = DjUser::where('phone_number','=',$result['phone_number'])->get();
        if (count($djusers) > 0) {
          return response()->json(["message" => "Email or Phone Number already exists!", "status" => "2"], 404);
        }
        elseif(sizeof($phone_check) > 0){
          return response()->json(["message" => "Phone Number already exists!", "status" => "2"], 404);
        }
        else{
          if ($result['password'] == $result['c_password']) { 
             
              $djusers = new DjUser;
              $djusers->first_name       = $result['first_name'];
              $djusers->last_name        = $result['last_name'];
              $djusers->email            = $result['email'];
              $djusers->password         = Hash::make($result['password']);
              $djusers->phone_number     = $result['phone_number'];
              if (!empty($result['dj_picture'])){
                $image = $result['dj_picture'];
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $image = base64_decode($image);
                $pic             = time().'.'.'png';  
                file_put_contents(public_path('image')."/".$pic,$image );
                // $image->move(public_path('image'), $pic);
                $djusers->profile_image = $pic;
              }
              $djusers->save();
              $last = $djusers->id;
       
              $first_name       = $result['first_name'];
              $last_name        = $result['last_name'];
              $email            = $result['email'];
              $password         = Hash::make($result['password']);
              $phone_number     = $result['phone_number'];
              $emails = DjUser::where('id','=',$last)->first();
              UserEmails::notifications($emails->email);
            return response()->json(["message" => "User Registered Successfully", "status" => "1","first_name"=>$first_name,"last_name"=>$last_name,"email"=>$email,"phone_number"=>$phone_number,"id"=>$last],200);
          }
          else{
            return response()->json(["message" => "Passwords Didn't Matched", "status" => "0"], 404);
          }
        }
    }
    public function registered_djusers_status(Request $req){
      $type = "application/json";
      $result = json_decode(file_get_contents("php://input"), true);
      $user_infos = DjUser::where('id','=',$result['user_id'])->first();
      
      if (!empty($user_infos)){
        if($user_infos->dj_status == 0){
          return response()->json(["status" => 'registered','code'=>'200','dj_status' => $user_infos->dj_status], 200);
        }
        elseif($user_infos->dj_status == 2){
          return response()->json(["status" => 'Questionaire Filled','code'=>'200','dj_status' => $user_infos->dj_status], 200);
        }
        elseif($user_infos->dj_status == 1){
          return response()->json(["status" => 'verified','code'=>'200','dj_status' => $user_infos->dj_status], 200);
        }
         elseif($user_infos->dj_status == 3){
          return response()->json(["status" => 'verification denied ','code'=>'200','dj_status' => $user_infos->dj_status], 200);
        }
          
      }else{
          return response()->json(["message" => "Email Not Exists",'code'=>'201'], 201);
      }
    }
    function register_djuser_question(Request $req) {
      $type = "application/json";
      $result = json_decode(file_get_contents("php://input"), true);
     $id = $result['user_id'];
            
            foreach ($result['answers'] as $arr) { 
              $dj_questionnaire_answers = new DJAnswers;
              $dj_questionnaire_answers->dj_questionnaire_id = 12;
              $dj_questionnaire_answers->question_id = $arr['question_id'];
              $dj_questionnaire_answers->answer = $arr['answer'];
              $dj_questionnaire_answers->dj_id = $id;
              $dj_questionnaire_answers->save();   
              DjUser::where('id','=',$id)->update(['dj_status'=>2]) ;           
              # code...
            }
          return response()->json(["message" => "Questionnaire Saved Successfully", "status" => "1",'id' => $id , ],200);
    }
    function verify_dj(Request $req){
      $type = "application/json";
      $result = json_decode(file_get_contents("php://input"), true);
      $cb = $result['dj_id'];
      $identification_num = $result['identification_number'];
      $identification_type = $result['identification_type'];
      $gender = $result['gender'];
      $dob = $result['dob'];
      if($identification_type == 1){
        DjUser::where('id','=',$cb)->update([
          'southAfrican_id'=>"$identification_num",'identification_type'=>"$identification_type","gender"=>"$gender","dob"=> $dob]);
        }
        else{
          DjUser::where('id','=',$cb)->update([
            'passport_id'=>"$identification_num",'identification_type'=>"$identification_type","gender"=>"$gender","dob"=> $dob]);
        }
        $user_infos = DjUser::where('id','=',$cb)->first();
        if(!is_null($user_infos->passport_id)){
          DjUser::where('id','=',$cb)->update([
            'dj_status' => '1'
          ]);
           $userFind = DjUser::where('id',$cb)->first();
                $message = "Your Account Has Been Approved";
                if (!is_null($userFind->device_id)){
                  $this->mobile_push_notification($message,$userFind->device_id);
                }
           $email = DjUser::where('id','=',$cb)->first();
            UserEmails::notifications($email->email);
            return response()->json(["message" => "Thank you for the verification","status"=>1,"dj_status"=>$userFind->dj_status],200);
        }
      else{
      $dha_info = Dj_Dha_profile::where('dj_id','=',$cb)->get();
      if (sizeof($dha_info) == 0){
        $data_array = array();
        $data_array['Token'] = "9a88abd8-2f4a-4f6f-bbcf-22755254f89b";
        $data_array['Username'] = "Jynx";
        $data_array['Password'] = "Pass12345";
        $data_array['TransactionReference'] = "Your internal reference";
      $user_infos = DjUser::where('id','=',$cb)->first();
      if($user_infos->southAfrican_id){
        $data_array['idNumber'] = $user_infos->southAfrican_id;
      }
      else{
        $data_array['idNumber'] = $user_infos->passport_id;
      }
      $result = json_decode(file_get_contents("php://input"), true);
     
      $make_call = json_decode($this->callCoreInfoAPI(json_encode($data_array)),true);
        if(empty($make_call)){
          DjUser::where('id','=',$cb)->update([
            'dj_status' => '3'
          ]);
           $userFind = DjUser::where('id',$cb)->first();
                $message = "Your Account Has Been Denied";
                if (!is_null($userFind->device_id)){
                  $this->mobile_push_notification($message,$userFind->device_id);
                }
          $user = DjUser::where('id','=',$cb)->first();
          return response()->json(["message" => "Verification Denied","status"=>0,"dj_status"=>$user->dj_status],201);
        }
        else{
          $dha_info = new Dj_Dha_profile;
          $dha_info->dj_id              = $cb;
          if($user_infos->southAfrican_id){
            $dha_info->identification_num = $user_infos->southAfrican_id;
          }
          else{
            $dha_info->identification_num = $user_infos->passport_id;
          }
          $dha_info->personName           = $make_call['personName'];
          $dha_info->personSurname        = $make_call['personSurname'];
          $dha_info->gender               = $make_call['gender'];
          $dha_info->dateOfBirth          = $make_call['dateOfBirth'];
          $dha_info->aliveStatus          = $make_call['aliveStatus'];
          $dha_info->dha_api_status       = $make_call['clientFeedback']['clientErrorInfo'];
          $dha_info->save();
          DjUser::where('id','=',$cb)->update([
            'dj_status' => '1'
          ]);
           $userFind = DjUser::where('id',$cb)->first();
                $message = "Your Account Has Been Approved";
                if (!is_null($userFind->device_id)){
                  $this->mobile_push_notification($message,$userFind->device_id);
                }
           $email = DjUser::where('id','=',$cb)->first();
            UserEmails::notifications($email->email);
          $user = DjUser::where('id','=',$cb)->first();

          // return redirect()->to('view_user_details/'.$req->id)->with('success','User Status Changed Successfully!');
          return response()->json(["message" => "Thank you for the verification","status"=>1,"dj_status"=>$user->dj_status],200);
        }
      }
      else{     
        DjUser::where('id','=',$cb)->update([
          'dj_status' => '1'
        ]);    
        $email = DjUser::where('id','=',$cb)->first();
        UserEmails::notifications($email->email);
        $user = DjUser::where('id','=',$cb)->first();

        return response()->json(["message" => "Thank you for the verification","status"=>1,"user_status"=>$user->dj_status],200);
      }
        # code...
    }
       
  } 
  
  function register_djuser_old(Request $req) {
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $djusers = DjUser::where('email','=',$result['email'])->get();
    $phone_check = DjUser::where('phone_number','=',$result['phone_number'])->get();
    if (sizeof($djusers) > 0) {
      return response()->json(["message" => "Email or Phone Number already exists!", "status" => "2"], 404);
    }
    elseif(sizeof($phone_check) > 0){
      return response()->json(["message" => "Phone Number already exists!", "status" => "2"], 404);
    }
    else{
      if ($result['password'] == $result['c_password']) { 
         
          $djusers = new DjUser;
          $djusers->first_name       = $result['first_name'];
          $djusers->last_name        = $result['last_name'];
          $djusers->email            = $result['email'];
          $djusers->password         = Hash::make($result['password']);
          $djusers->phone_number     = $result['phone_number'];
          $djusers->music_genre     = "No genre";
         
          $djusers->gender           = $result['gender'];
          $djusers->passport_id           = $result['passport_id'];
          $djusers->southAfrican_id           = $result['southAfrican_id'];
          $djusers->representation           = $result['representation'] ;
          $djusers->dj_name           = $result['dj_name'];
          if (!empty($result['dj_picture'])){
            $image = $result['dj_picture'];
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);
            $pic             = time().'.'.'png';  
            file_put_contents(public_path('image')."/".$pic,$image );
            // $image->move(public_path('image'), $pic);
            $djusers->profile_image = $pic;
          }
          if (!empty($result['dj_logo'])){
            $logo_image = $result['dj_logo'];
            $logo_image = str_replace('data:image/png;base64,', '', $logo_image);
            $logo_image = str_replace(' ', '+', $logo_image);
            $logo_image = base64_decode($logo_image);
            $logo_pic             = time().'.'.'png';  
            file_put_contents(public_path('image')."/".$logo_pic,$logo_image );
            // $image->move(public_path('image'), $pic);
            $djusers->logo_image = $logo_pic;
          }
          $djusers->save();
          $lastId = $djusers->id;  
          
          foreach ($result['answers'] as $arr) { 
            $dj_questionnaire_answers = new DJAnswers;
            $dj_questionnaire_answers->dj_questionnaire_id = 12;
            $dj_questionnaire_answers->question_id = $arr['question_id'];
            $dj_questionnaire_answers->answer = $arr['answer'];
            $dj_questionnaire_answers->dj_id = $lastId;
            $dj_questionnaire_answers->save();                
            # code...
          }
        return response()->json(["message" => "User Registered Successfully", "status" => "1",'id' => $lastId],200);
      }else{
        return response()->json(["message" => "Passwords Didn't Matched", "status" => "0"], 404);
      }
    }
}
    
    function dj_notifications(){
      $type = "application/json";
      $result = json_decode(file_get_contents("php://input"), true);
    	$notification_data = AdminNotification::where('dj_id', '=',$result['dj_id'])->get();
    	return response()->json(["Notification List" => $notification_data],200);
    }
    function dj_delete(){
      $type = "application/json";
      $result = json_decode(file_get_contents("php://input"), true);
    	$dj = DjUser::where('id', '=',$result['id'])->delete();
    	return response()->json(["message" => "Dj Deleted"],200);
    }
  
  function login_djuser(Request $req) {
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $email_login = DjUser::where('email','=',$result['phone_number'])->first();
    if(!empty($email_login)){
      $user_id = $email_login->id;
      $type = $email_login->dj_type;
      $user_first_name = $email_login->first_name;
      $user_last_name = $email_login->last_name;
      // return response()->json(["message" => "DJ not exists", "status" => empty($email_login)],200);
      if(Hash::check($result['password'],$email_login->password)){
        if($type == "1"){
          return response()->json(["message" => "User logged in Successfully", "status" => "1","type"=>$type,"id"=>$user_id,"name"=>$user_first_name.' '.$user_last_name],200);
        }
        elseif($type == "2"){
          return response()->json(["message" => "User logged in Successfully", "status" => "1","type"=>$type,"id"=>$user_id,"name"=>$user_first_name.' '.$user_last_name],200);
        }
        elseif($type == "3"){
          return response()->json(["message" => "Artist Account is denied", "status" => "0"],200);
        }

      } else{
        return response([
          'error'=>["Email or password is not matched"]
        ]);
      }
    }
    else{
      return response()->json(["message" => "Artist Account is denied", "status" => "0"],200);
    }
    
    // if(empty($email_login)){
    //   $phone_login = DjUser::where('phone_number','=',$result['phone_number'])->first();
    //   $user_id = $phone_login->id;
    //   $type = $phone_login->dj_type;
    //   $user_first_name = $phone_login->first_name;
    //   $user_last_name = $phone_login->last_name;
      
    //   if(!$phone_login || !Hash::check($result['password'],$phone_login->password)){
    //     return response([
    //       'error'=>["Phone Number or password is not matched"]
    //     ]);
    //   }
    //   if($type == 1){
    //     return response()->json(["message" => "User logged in Successfully", "status" => "1","type"=>$type,"id"=>$user_id,"name"=>$user_first_name.' '.$user_last_name],200);
    //   }
    //   elseif($type == 2){
    //     return response()->json(["message" => "User logged in Successfully", "status" => "1","type"=>$type,"id"=>$user_id,"name"=>$user_first_name.' '.$user_last_name],200);
    //   }
    // }
    // else{
    //   return response()->json(["message" => "DJ not exists", "status" => "0"],200);
    // }
    
    
  } 
  function login_djuserold(Request $req) {
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $email_login = DjUser::where('email','=',$result['phone_number'])->first();
    if(!empty($email_login)){
      $user_id = $email_login->id;
      $status = $email_login->dj_status;
      $user_first_name = $email_login->first_name;
      $user_last_name = $email_login->last_name;
      
      if(!$email_login || !Hash::check($result['password'],$email_login->password)){
        return response([
          'error'=>["Email or password is not matched"]
        ]);
      }
      if($status == 0){
        return response()->json(["message" => "DJ not approved yet", "status" => "0"],200);
      }
      else{
        return response()->json(["message" => "User logged in Successfully", "status" => "1","id"=>$user_id,"name"=>$user_first_name.' '.$user_last_name],201);
      }
    }
    else{
      return response()->json(["message" => "DJ not exists", "status" => "0"],201);
    }
    
    if(empty($email_login)){
      $phone_login = DjUser::where('phone_number','=',$result['phone_number'])->first();
      $user_id = $phone_login->id;
      $status = $phone_login->dj_status;
      $user_first_name = $phone_login->first_name;
      $user_last_name = $phone_login->last_name;
     
      if(!$phone_login || !Hash::check($result['password'],$phone_login->password)){
        return response([
          'error'=>["Phone Number or password is not matched"]
        ]);
      }
      if($status == 0){
        return response()->json(["message" => "DJ not approved yet", "status" => "0"],200);
      }
      else{
        return response()->json(["message" => "User logged in Successfully", "status" => "1","id"=>$user_id,"name"=>$user_first_name.' '.$user_last_name],200);
      }
    }
    else{
      return response()->json(["message" => "DJ not exists", "status" => "0"],201);
    }
   
    
}
  public function fetch_dj_dha_profile(Request $req)
  {
    $dha_info = Dj_Dha_profile::where('dj_id','=',$req->id)->get();
    if (sizeof($dha_info) == 0){
        $data_array = array();
        $data_array['Token'] = "9a88abd8-2f4a-4f6f-bbcf-22755254f89b";
        $data_array['Username'] = "Jynx";
        $data_array['Password'] = "Pass12345";
        $data_array['TransactionReference'] = "Your internal reference";
        $user_infos = DjUser::where('id','=',$req->id)->first();
        if($user_infos->southAfrican_id){
          $data_array['idNumber'] = $user_infos->southAfrican_id;
        }
        else{
          $data_array['idNumber'] = $user_infos->passport_id;
        }
        $result = json_decode(file_get_contents("php://input"), true);
        // $make_call = array();
        // $make_call['personName'] = "KANZA";
        // $make_call['personSurname'] = "NAJAM UL HUDA";
        // $make_call['gender'] = "Female";
        // $make_call['dateOfBirth'] = "1986-08-12";
        // $make_call['aliveStatus'] = "ALIVE";
        $make_call = json_decode($this->callCoreInfoAPI(json_encode($data_array)),true);
        // $make_call = json_decode('{
        //     "personName": "KANZA",
        //     "personSurname": "NAJAM UL HUDA",
        //     "gender": "Female",
        //     "dateOfBirth": "1986-08-12",
        //     "aliveStatus": "ALIVE",
        //     "clientFeedback": {
        //         "systemErrorInfo": "0",
        //         "clientErrorInfo": "0"
        //     }
        // }', true);
        $dha_info = new Dj_Dha_profile;
        $dha_info->dj_id              = $req->id;
        if($user_infos->southAfrican_id){
          $dha_info->identification_num = $user_infos->southAfrican_id;
        }
        else{
          $dha_info->identification_num = $user_infos->passport_id;
        }
        $dha_info->personName           = $make_call['personName'];
        $dha_info->personSurname        = $make_call['personSurname'];
        $dha_info->gender               = $make_call['gender'];
        $dha_info->dateOfBirth          = $make_call['dateOfBirth'];
        $dha_info->aliveStatus          = $make_call['aliveStatus'];
        $dha_info->dha_api_status       = $make_call['clientFeedback']['clientErrorInfo'];
        $dha_info->save();
        // return redirect()->to('view_user_details/'.$req->id)->with('success','User Status Changed Successfully!');
        return Redirect::to("/".$req->id)->with('success','User Status Changed Successfully!');
    }
    else{            
        return Redirect::to("/".$req->id)->with('success','Already Exists!');
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
   
	
		
		return $result;
	}

  public function dj_agreement_status_on(Request $req){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    DjUser::where('id','=',$result['id'])->update(['agreement_status'=>$result['agreement_status'],
    ]);
      return response()->json(["message" => "Agreement Status Updated Successfully"], 201);
  }
  public function dj_notification_status_on(Request $req){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    AdminNotification::where('id','=',$result['id'])->update(['status'=>$result['status'],
    ]);
      return response()->json(["message" => "Notification Status Updated Successfully"], 201);
  }
  public function mobile_push_notification($message='', $player_id=''){
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
  public function register_device(Request $req){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    DjUser::where('id','=',$result['id'])->update(['device_id'=>$result['device_id'],
    ]);
      return response()->json(["message" => "Device Registered Successfully"], 201);
  }
    function music_genre() {
      $type = "application/json";
      $music_genre = Genre::select('id','music_genre')->get(); 
      $p = array();
      foreach($music_genre as  $row){
        $music_id = $row['id'];
        $sub_genre = Sub_Genre::where('music_genre', $music_id)->get();
        $row['sub_genre'] = $sub_genre;
        array_push($p, $row);
      }
      
      
      return response()->json(['genre_list' =>$p,'status' => "1"], 200);
  }
  public function artist_delete(Request $req)
{
    // Need to find all addresses with the contacdt Id and delete them.
    
    $user_id = $req->id;
   
    DjUser::where('id',$user_id)->delete();
    return redirect('/admin_djlist')->with('success','Artist deleted successfully');   
}
public function update_artist(Request $req){
if($req->identification_type == 2){
  $passport_id = $req->identification_number;
  $southAfrican_id = "";
}
if($req->identification_type == 1){
  $passport_id = "";
  $southAfrican_id = $req->identification_number;
}
if (!empty($req->dj_picture)){
  $image = $req->dj_picture;
  $image = str_replace('data:image/png;base64,', '', $image);
  $image = str_replace(' ', '+', $image);
  $image = base64_decode($image);
  $pic             = time().'.'.'png';  
  file_put_contents(public_path('image')."/".$pic,$image );
  // $image->move(public_path('image'), $pic);
  
}
  DjUser::where('id','=',$req->id)->update([
    'first_name'=>$req->first_name,
    'last_name'=>$req->last_name,
    'phone_number'=>$req->phone_number,
    'email'=>$req->email,
    'passport_id'=>$passport_id,
    'southAfrican_id'=>$southAfrican_id,
    'identification_type'=>$req->identification_type,
    'dob'=>$req->dob,
    'gender'=>$req->gender,
    'profile_image'=> $pic,
  ]);
          
    // if (!empty($req->password)) {
    //     $user_infos->password = Hash::make($req->password);
    // }
    // $user_infos->role = $req->role;
    // $user_infos->save();
    return response()->json(["message" => "User Updated Successfully"], 201);
}
  function dj_agreement_status_check() {
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    
    $dj_user = DjUser::where('id','=',$result['id'])->first();
    $dj_agreement_status = $dj_user->agreement_status;
    return response()->json(["agreement_status" => $dj_agreement_status, 'status' => "1"], 200);
  }
  function dj_agreement() {
    $type = "application/json";
      
    $dj_agreement = DjAgreement::select('agreement')->get();
    return response()->json(['agreement' =>$dj_agreement, 'status' => "1"], 200);
  }
  function dj_event_list_api(Request $req){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $event_reject = EventReject::select('event_id')->where('dj_id','=',$result['id'])->get();
    $dj_check = DjUser::where('id','=',$result['id'])->where('dj_status','=','1')->first();
    if ($dj_check == null ){
      return response()->json(["message" => "DJ is not approved yet"], 404);
    }else{
      
      $events = Event::select(DB::raw("events.* ,DATE_FORMAT(events.event_date, '%d') as event_date_daY, DATE_FORMAT(events.event_date, '%b') as event_date_month,  events.dj_qr_code_status as qr_code_status,dj_event.time,dj_event.artist1,dj_event.artist2,dj_event.artist3,dj_event.going_status,dj_event.going_status1,dj_event.going_status2,dj_event.going_status3"),)->join('dj_event','dj_event.event_id','=','events.id')->where('events.event_date', '>=', DB::raw('curdate()'))->where('dj_event.artist1','=',$result['id'])->orWhere('dj_event.artist2','=',$result['id'])->orWhere('dj_event.artist3','=',$result['id'])->orWhere('dj_event.going_status1','=','1')->orWhere('dj_event.going_status1','=','0')->orWhere('dj_event.going_status2','=','1')->orWhere('dj_event.going_status2','=','0')->orWhere('dj_event.going_status3','=','1')->orWhere('dj_event.going_status3','=','0')->get();
      $eventss = array();
      foreach($events as $event){

        if($event['artist1'] == $result['id']){
          $event['platform'] = "Platform 1";
          if($event['going_status1'] != "2"){
            
          $event['going_status'] = $event['going_status1'];
          array_push($eventss,$event);
          }
        }
        if($event['artist2'] == $result['id']){
          if($event['going_status2'] != "2"){
          $event['platform'] = "Platform 2";
          $event['going_status'] = $event['going_status2'];
          array_push($eventss,$event);
          }
        }
        if($event['artist3'] == $result['id']){
          if($event['going_status3'] != "2"){
          $event['platform'] = "Platform 3";
          $event['going_status'] = $event['going_status3'];
          array_push($eventss,$event);
          }
        }
       
      }
      // echo json_encode($eventss);die();
              // ->whereNotIn('events.id',$event_reject->pluck('event_id'))
      return response()->json(['event_list' =>$eventss ,
                              //  'event_reject'=> $event_reject, 
                            'success' => true], 200);
    }
  }
  function dj_booking_id(Request $req){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $booking = Bookings::select('booking_id')->where('dj_id','=',$result['id'])->where( 'event_id','=',$result['event_id'])->get();
    
    return response()->json(['booking_id' =>$booking ,'success' => true], 200);
  }
  
  function register_new_djuser(){
    $genre = Genre::all();
    $sub_genre = Sub_Genre::all();
    return view("users.register_djuser",['genre'=>$genre,'sub_genre'=>$sub_genre]);
  }
  public function email_verify_mail_dj(Request $req){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $user_infos = DjUser::where('email','=',$result['email'])->first();
    if (!empty($user_infos)){
        if($user_infos->dj_status == "2"){
            DjUser::where('id','=',$user_infos->id)->update([
              'dj_status'=> '0',
            ]);
            return response()->json(["message" => "Account Sent For Re Active" ,'code'=>'200'], 200);
        }elseif($user_infos->dj_status == "-1"){
            return response()->json(["message" => "Your Account Has Been Blocked",'code'=>'201'], 201);
        }else{
            return response()->json(["message" => "Email already exists!",'code'=>'201'], 201);
        }
    }else{
        $unique_id =  random_int(100,100000);          
        $queryStatus;
        try {
          $query = UserEmails::signUpEmail($result['email'], $unique_id);
            $queryStatus = "Successful";
        } catch(Exception $e) {
            $queryStatus = "Not success";
        }
        return response()->json(["message" => "Email Sent Successfully","verify_code"=>$unique_id,"emil"=>$result['email'],'code'=>'200'], 200);
    }
}
  public function delete_djadmin_details ($id) {
    if(DjUser::where('id', $id)->exists()) {
       $user= DjUser::where('id', $id)->delete();
       return redirect('/admin_djlist')->with('success','DJ User Deleted Successfully!');
    } else {
       return redirect('/admin_djlist')->with('error','Dj User Not Found');
    }
  }
  public function edit_djadmin_details($id){
    $users_data = DjUser::find($id);
    $dj_dha_profile = Dj_Dha_profile::where('dj_id',$id)->first();
    $dj_dha_address = Dj_Dha_Address::where('dj_id',$id)->first();
    // dd($users_data);die();
    return view("users.djadminEdit",['user'=>$users_data,'dj_dha_profile'=>$dj_dha_profile,'dj_dha_address'=>$dj_dha_address]);

  }
  
  public function view_djadmin_details($id){
    
    $users_data = DjUser::where('id','=',$id)->get();
   
    $dj_dha_profile = Dj_Dha_profile::where('dj_id',$users_data->pluck('id'))->first();
    $dj_dha_address = Dj_Dha_Address::where('dj_id',$users_data->pluck('id'))->first();
    
  
   
    return view("users.djadminView",['users'=>$users_data,'dj_dha_profile'=>$dj_dha_profile,'dj_dha_address'=>$dj_dha_address]);

  }
  public function artistResponse($id){
    
    $users_data = DjUser::where('id','=',$id)->get();
   
    $dj_response = DB::table('dj_questionnaire_answers')
    ->select('dj_questionnaire_questions.dj_questionnaire_question','dj_questionnaire_answers.dj_id','dj_questionnaire_answers.answer')
    ->join('dj_questionnaire_questions', 'dj_questionnaire_questions.dj_questionnaire_id', '=', 'dj_questionnaire_answers.dj_questionnaire_id')->where('dj_questionnaire_answers.dj_id','=',$id)->groupBy('dj_questionnaire_questions.dj_questionnaire_question')
    ->get();
  
   
    return view("users.artistResponse",['users'=>$users_data,'dj_response' => $dj_response]);

  }
  
  public function approve_djuser(Request $req)
  {
    DjUser::where('id','=',$req->id)->update([
      'dj_status'=>1
    ]);
    $userFind = DjUser::where('id',$req->id)->first();
    $message = "Your Account Has Been Approved";
    if (!is_null($userFind->device_id)){
      $this->mobile_push_notification($message,$userFind->device_id);
    }
    return Redirect::to("view_djadmin_details/".$req->id)->with('success','User Status Changed Successfully!');
    # code...
  }
  function update_djadmin_user(Request $req){
    $validator = \Validator::make($req->all(), [
      'first_name'   => 'required|string|max:191',
      'last_name'    => 'required|string|max:191',
      'phone_number' => 'required|numeric',
      'email'        => 'required|email',
      'representation'   => 'required|string|max:191',
      'music_genre'   => 'required|string|max:191',
      'dj_name'   => 'required|string|max:191',
      'identification_type'   => 'required|int|max:191',
      'first_name'   => 'required|string|max:191',
    ]);
    $nums = 0;
    if (isset($req->user_image)) {

      $userPic             = time().$nums.'.'.$req->user_image->extension();  
      $req->user_image->move(public_path('image'), $userPic);
      
    }
    else{
      $userPic = $req->admin_image;
    }
    $users = DjUser::find($req->id);
    $users->first_name       = $req->first_name;
    $users->last_name       = $req->last_name;
    $users->email      = $req->user_email;
    $users->representation      = $req->representation;
    $users->music_genre      = $req->music_genre;
    $users->dj_name      = $req->dj_name;
    $users->identification_type      = $req->identification_type;

    $users->phone_number       = $req->phone_number;
    $users->dj_status       = $req->dj_status;
    $users->profile_image = $userPic;
    if(!empty($req->user_password)){
        $users->password   = Hash::make($req->user_password);
    }
    $users->save();
    return redirect('/admin_djlist')->with('success',' Dj User Updated Successfully!');
}
  function save_djuser(Request $req){
    $djusers = DjUser::where('email','=',$req->email)->get();
    if (sizeof($djusers) > 0){
      return redirect('/admin_djlist')->with('error','Email already exists!');
    }else{
      $validator = \Validator::make($req->all(), [
        'first_name'   => 'required|string|max:191',
        'last_name'    => 'required|string|max:191',
        'phone_number' => 'required|numeric',
        'email'        => 'required|email',
        'password'     => 'required',
      ]);
      if ($validator->fails()) {
        $responseArr['message'] = $validator->errors();
        return response()->json($responseArr);
      }
      $djusers = new DjUser;
      $djusers->first_name       = $req->first_name;
      $djusers->last_name        = $req->last_name;
      $djusers->email            = $req->email;
      $djusers->password         = Hash::make($req->password);
      $djusers->phone_number     = $req->phone_number;
      $djusers->music_genre      = $req->music_genre;
      $djusers->sub_genre        = $req->sub_genre;
      $djusers->gender           = $req->gender;
      $djusers->representation   = $req->representation;
      if ($req->hasFile('picture')) {
        $user_infosPic             = time().'.'.$req->picture->extension();
        $req->picture->move('image', $user_infosPic);
        $djusers->profile_image = $user_infosPic;
    }
     
      $djusers->save();
      
      return redirect('/admin_djlist')->with('success','DJ User Registered Successfully!');
    }
  }
  

  public function admin_djlist(){
    $dj_data = DjUser::all();
    return view("users.admindjlist",['dj_list'=>$dj_data,]);
  }
  public function dj_event_attend_list(){
    $event = Event::all();
    $bookings = DjEventStatus::all();
    return view("event.dj_event_attend_list",['event_list'=>$event,'bookings_list'=>$bookings,]);
  }
  public function one_event(){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $event = Event::where('id','=',$result['event_id'])->get();
    return response()->json(["event_list" => $event], 200);
  }
  public function update_password(Request $req){ 
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $email_login = DjUser::where('email','=',$result['phone_number'])->first();
      if(!empty($email_login)){
        $user_id = $email_login->id;
        DjUser::where('email','=',$result['phone_number'])->update([
          'password'=>Hash::make($result['password']),
        ]);
        return response()->json(["message" => "Password Updated Successfully","id" => $user_id], 200);
      }


      
      else if(empty($email_login)){
        
        $phone_login = DjUser::where('phone_number','=',$result['phone_number'])->first();
        if(!empty($phone_login)){
          $user_id = $phone_login->id;
          DjUser::where('phone_number','=',$result['phone_number'])->update([
            'password'=>Hash::make($result['password']),
          ]);
          return response()->json(["message" => "Password Updated Successfully",'id' => $user_id], 200);
        }
        else{
          return response()->json(["message" => "Phone Number doesn't exist"], 200);
        }
      }
      else{
        return response()->json(["message" => "Email doesn't exist"], 200);
      }
    
      
  }
  public function reset_password(Request $req){ 
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $email_login = user_infos::where('email','=',$result['email'])->first();
      if(!empty($email_login)){
        $user_id = $email_login->id;
        user_infos::where('email','=',$result['email'])->update([
          'password'=>Hash::make($result['password']),
        ]);
        return response()->json(["message" => "Password Updated Successfully","id" => $email_login], 200);
      }
      
  }
  public function accept_event(Request $req){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $going_check = Dj_Event::where('event_id','=',$result['event_id'])->get();
    foreach($going_check as $gk){
      if($gk->artist1 == $result['dj_id'] ){
        Dj_Event::where('event_id','=',$result['event_id'])->where('artist1','=',$result['dj_id'])->where('time','=',$result['timeslot'])->update([
          'going_status1'=>1
        ]);
      }
      if($gk->artist2 == $result['dj_id'] ){
        Dj_Event::where('event_id','=',$result['event_id'])->where('artist2','=',$result['dj_id'])->where('time','=',$result['timeslot'])->update([
          'going_status2'=>1
        ]);
      }
      if($gk->artist3 == $result['dj_id'] ){
        Dj_Event::where('event_id','=',$result['event_id'])->where('artist2','=',$result['dj_id'])->where('time','=',$result['timeslot'])->update([
          'going_status2'=>1
        ]);
      }
    }
   
      $bookings = new Bookings;
      $bookings->dj_id       = $result['dj_id'];
      $bookings->event_id = $result['event_id'];
      $bookings->booking_id = str::random(20);
      $bookings->booking_type        = "4";
      $bookings->save();
      $bookingId = $bookings->booking_id;
      $push_message = "Event Accepted";
      $message = " Event Accepted";
      $dj = DjUser::where('djusers.id','=',$result['dj_id'])->first();  
      $event = Event::where('id','=',$result['event_id'])->first();
      if(!empty($dj)){
        $this->mobile_push_notification($push_message,$dj->device_id);  
        $djs = new AdminNotification;
        $djs->dj_id            = $dj->id;
        $djs->item_qr_code      = $bookingId;
        $djs->event_id         = $result['event_id'];
        $djs->event_name      = $event->event_name;
        $djs->notification_type  = "6";
        $djs->admin_msg          = "Your $event->event_name Booking has been confirmed"   ;
        $djs->save();
      }
      
      return response()->json(["message" => "Event Accepted",'success' => true], 200);
  }
  public function reject_event(Request $req){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);    
    $event = Event::where('id','=',$result['event_id'])->first();
      $djusers = new EventReject;
      $djusers->event_id      = $result['event_id'];
      $djusers->dj_id        = $result['dj_id'];
      $djusers->save(); 
      $going_check = Dj_Event::where('event_id','=',$result['event_id'])->get();
      foreach($going_check as $gk){
        if($gk->artist1 == $result['dj_id'] ){
          Dj_Event::where('event_id','=',$result['event_id'])->where('artist1','=',$result['dj_id'])->where('time','=',$result['timeslot'])->update([
            'going_status1'=>2
          ]);
        }
        if($gk->artist2 == $result['dj_id'] ){
          Dj_Event::where('event_id','=',$result['event_id'])->where('artist2','=',$result['dj_id'])->where('time','=',$result['timeslot'])->update([
            'going_status2'=>2
          ]);
        }
        if($gk->artist3 == $result['dj_id'] ){
          Dj_Event::where('event_id','=',$result['event_id'])->where('artist2','=',$result['dj_id'])->where('time','=',$result['timeslot'])->update([
            'going_status3'=>2
          ]);
        }
      }
    // Dj_Event::where('event_id','=',$result['event_id'])->where('artist1','=',$result['dj_id'])->orWhere('artist2','=',$result['dj_id'])->orWhere('artist3','=',$result['dj_id'])->update(['going_status'=>2,
    //     ]);           
        return response()->json(["message" => "$event->event_name Rejected"],200);
  }
  function gallery_event_list(Request $req){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $dt = Carbon::now()->toDateString();
   
    $events = DB::table('events')
            ->join('dj_event','dj_event.event_id','=','events.id')
            ->select('events.*',DB::raw("DATE_FORMAT(events.event_date, '%d') as event_date_daY, DATE_FORMAT(events.event_date, '%b') as event_date_month"),)
            ->where('events.event_date', '<=', $dt)
            ->orWhere('dj_event.artist1','=',$result['id'])
            ->orWhere('dj_event.artist2',$result['id'])
            ->orWhere('dj_event.artist3',$result['id'])
            ->groupBy('events.id')
            ->get();
            // ->where('dj_id','=',$result['id'])
           
    return response()->json(['event_list' =>$events ,'success' => true], 200);
  }
  function gallery_event_images(Request $req){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $gallery_images = DB::table('gallery')
            ->join('gallery_images', 'gallery.unique_id', '=', 'gallery_images.gallery_id')
            ->select('gallery_images.*',)
            ->where('gallery.event_id', '=', $result['event_id'])
            ->get();
    return response()->json(['gallery_images' =>$gallery_images ,'success' => true], 200);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DjUser  $DjUser
     * @return \Illuminate\Http\Response
     */
    public function show(DjUser $DjUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DjUser  $DjUser
     * @return \Illuminate\Http\Response
     */
    public function edit(DjUser $DjUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DjUser  $DjUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DjUser $DjUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DjUser  $DjUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(DjUser $DjUser)
    {
        //
    }
}
