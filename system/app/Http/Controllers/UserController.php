<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\PasswordReset;
use App\Models\PasswordReset2;

use App\Models\Permissions;
use Illuminate\Support\Facades\Hash;
use App\Models\user_infos;
use App\Models\Admin;
use App\Models\TestUser;

use App\Models\user_wallets;
use App\Models\Purchase;
use App\UserEmails;
use App\Models\DjUser;
use App\Models\AppShare;
use App\Models\Dj_Dha_Address;
use App\Models\Dj_Dha_profile;
use App\Models\EventAttend;
use App\Models\Dha_profile;
use App\Models\Registered_Users;
use App\Models\Dha_Address;
use App\Models\Bookings;
use App\Models\VipPkg;
use App\Models\VipBookings;
use App\Models\PaymentToken;
use App\Models\Event;

use Illuminate\Support\Str;
use DB;
 
class UserController extends Controller
{
  // public function payment_gateway(Request $req){
  //   $type = "application/json";
  //   $bookings = Bookings::where('booking_id','=',$req->booking_id)->first();
  //   $booking_id = $req->booking_id;
  //   $vip = VipPkg::where('id','=',$bookings->vip_booth_id)->first();
  //   $price = $vip->pkg_price * 100;
  //   // return response()->json(["booking"=>$bookings,"price" => $vip->pkg_price,'code'=>'200'], 200);
  // }
  public function payment_gateway2(Request $req){
    $type = "application/json";
    $price = $req->price;
    $token = $req->token;
    $data_array = array();
    $data_array = [
      'token' => $token, // Your token for this transaction here
      'amountInCents' => $price, // payment in cents amount here
      'currency' => 'ZAR' // currency here
  ];
    // $data_array = array();
    // $data_array['token'] = "9a88abd8-2f4a-4f6f-bbcf-22755254f89b";
    // $data_array['amountInCents'] = $price;
    // $data_array['currency'] = "ZAR";
    
    $result = json_decode(file_get_contents("php://input"), true);
    
    $make_call = $this->chargeApi($data_array);
    return response()->json(["response"=>$make_call,'code'=>'200'], 200);
    // return view("payment_gateway");
}
public function save_token(Request $req){
  $type = "application/json";
  $result = json_decode(file_get_contents("php://input"), true);
  $token = new PaymentToken;
  $token->token = $result['tokenid'];
  $token->save();
  return response()->json(["message" => "Token Saved" ,'code'=>'200'], 200);
}
    public function register_user(Request $req) {
        $type = "application/json";

        $user_infos = user_infos::where('email','=',$req->email)->first();

        if (!empty($user_infos)){
            if($user_infos->user_status == "2"){
                user_infos::where('user_id','=',$user_infos->user_id)->update([
                  'user_status'=> '0',
                ]);
                return response()->json(["message" => "Account Sent For Re Active" ,'code'=>'200'], 200);
            }elseif($user_infos->user_status == "-1"){
                return response()->json(["message" => "Your Account Has Been Blocked",'code'=>'201'], 201);
            }else{
                return response()->json(["message" => "Email already exists!",'code'=>'201'], 201);
            }
        }else{
          
          $validator = \Validator::make($req->all(), [
            'first_name'   => 'required|string|max:191',
            'last_name'    => 'required|string|max:191',
            'phone_number' => 'required',
            'email'        => 'required',
            'password'     => 'required',
            'c_password'   => 'required',
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
            $unique_id = str::random(10);
            $user_infos = new user_infos;
            $user_infos->first_name       = $req->first_name;
            $user_infos->last_name        = $req->last_name;
            $user_infos->phone_number     = $req->phone_number;
            $user_infos->email            = $req->email;
            $user_infos->password         = Hash::make($req->password);
            $user_infos->identification_num = $req->identification_num;
            $user_infos->dob              = $req->dob;
            $user_infos->nationality      = $req->nationality;
            $user_infos->gender           = $req->gender;
            $user_infos->remember_token   =str::random(50);
            $user_infos->role             = "user";
            $user_infos->user_status      = "0";
            if ($req->hasFile('vaccinated_image')) {
              $vaccinated_imagePic             = time().'.'.$req->vaccinated_image->extension();
              $req->vaccinated_image->move('image', $vaccinated_imagePic);
              $user_infos->vaccinated_image = $vaccinated_imagePic;
            }
            $user_infos->vaccinated_status  = $req->vaccinated_status;
            $user_infos->player_id          = $req->player_id;
            $user_infos->notify_status      = "0";
            $user_infos->unique_id          = $unique_id;
            $user_infos->save();
            $user = user_infos::where('email', $req->email)->first();
            $user_wallet = new user_wallets;
            $user_wallet->user_id      = $user->user_id;
            $user_wallet->available_points    = 0;
            $user_wallet->save();
            $message = "Your Account Has Been Created Successfully";
            $this->mobile_push_notification($message,$req->player_id);
            // $sendT = UserEmails::signUpEmail($req->email, $unique_id);
            $reset_passwords = new PasswordReset;
            $reset_passwords->email = $req->email;
            $reset_passwords->password = $req->password;  
            $reset_passwords->save();                                 
            return response()->json(["message" => "User Registered Successfully",'code'=>'200'], 200);
          }else{
            return response()->json(["message" => "Passwords Didn't Matched",'code'=>'201'], 201);
          }
        }
    }
    public function registered_users(Request $req) {
    

      $registered_users = user_infos::where('email','=',$req->email)->first();
    
      if (!empty($registered_users)){
              return response()->json(["message" => "Email already exists!",'code'=>'201'], 201);
          
      }else{
      
        $validator = \Validator::make($req->all(), [
          'first_name'   => 'required|string|max:191',
          'last_name'    => 'required|string|max:191',
          'phone_number' => 'required',
          'email'        => 'required',
          'password'     => 'required',
          'c_password'   => 'required',
        ]);
        if ($validator->fails()) {
          $responseArr['message'] = $validator->errors();
          return response()->json($responseArr);
        }
        if ($req->password == $req->c_password) {
          $unique_id = str::random(10);
          $registered_users = new user_infos;
          $registered_users->first_name       = $req->first_name;
          $registered_users->last_name        = $req->last_name;
          $registered_users->phone_number     = $req->phone_number;
          $registered_users->email            = $req->email;
          $registered_users->password         = Hash::make($req->password);
          // $registered_users->c_password         = Hash::make($req->password);
          $registered_users->save();
           $user = user_infos::where('email', $req->email)->first();
            $user_wallet = new user_wallets;
            $user_wallet->user_id      = $user->user_id;
            $user_wallet->available_points    = 0;
            $user_wallet->save();     
          $last_id = $registered_users->id; 
          $first_name =   $registered_users->first_name;
          $last_name =   $registered_users->last_name;
          $email =   $registered_users->email;
          $phone_number =   $registered_users->phone_number;
          $emails = user_infos::where('user_id','=',$last_id)->first();
            UserEmails::notifications($emails->email);
          return response()->json(["message" => "User Registered Successfully",'code'=>'200','user_id'=>$last_id,'first_name'=>$first_name,'last_name'=>$last_name,'email'=>$email,'phone_number'=>$phone_number,'user_status'=>'0'], 200);
        }else{
          return response()->json(["message" => "Passwords Didn't Matched",'code'=>'201'], 201);
        }
      }
  }
  public function registered_users_status(Request $req){
    $user_infos = user_infos::where('email','=',strtolower($req->email))->first();
    
    if (!empty($user_infos)){
      if($user_infos->user_status == 0){
        return response()->json(["status" => 'registered','code'=>'200','user_status' => $user_infos->user_status], 200);
      }
      elseif($user_infos->user_status == 1){
        return response()->json(["status" => 'verified','code'=>'200','user_status' => $user_infos->user_status], 200);
      }
       elseif($user_infos->user_status == 3){
        return response()->json(["status" => 'verification Denied','code'=>'200','user_status' => $user_infos->user_status], 200);
      }
        
    }else{
        return response()->json(["message" => "Email Not Exists",'code'=>'201'], 201);
    }
  }
  public function get_vaccination(Request $req){
    $user_infos = user_infos::where('user_id','=',strtolower($req->user_id))->first();
    
    if (!empty($user_infos)){
        return response()->json(["message" => 'Success','code'=>'200',"Vaccination_status"=>$user_infos->vaccinated_status], 200);
        }
        else{
          return response()->json(["message" => "User Not Exists",'code'=>'201'], 201);
      }
    }
  public function add_vaccination(Request $req){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $user_infos = user_infos::where('user_id','=',strtolower($result['user_id']))->first();
    if (!empty($user_infos)){
      if (!empty($result['vaccinated_image'])) {
        $image = $result['vaccinated_image'];
       
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $image = base64_decode($image);
        $pic             = time().'.'.'png';
       
        file_put_contents(public_path('image')."/".$pic,$image );
        // $image->move(public_path('image'), $pic);
        
        
        user_infos::where('user_id','=',$result['user_id'])->update([
          'vaccinated_status'=> '1','vaccinated_image'=>$pic,
        ]);
        return response()->json(["message" => 'Vaccination Data Recorded','code'=>'200'], 200);
      }
      else{
        return response()->json(["message" => "No image found",'code'=>'201'], 201);
      }       
    }else{
        return response()->json(["message" => "User Not Exists",'code'=>'201'], 201);
    }
  }
    public function email_verify_mail(Request $req){
        $user_infos = user_infos::where('email','=',strtolower($req->email))->first();
        // print_r();
        if (!empty($user_infos)){
            if($user_infos->user_status == "2"){
                user_infos::where('user_id','=',$user_infos->user_id)->update([
                  'user_status'=> '0',
                ]);
                return response()->json(["message" => "Account Sent For Re Active" ,'code'=>'200'], 200);
            }elseif($user_infos->user_status == "-1"){
                return response()->json(["message" => "Your Account Has Been Blocked",'code'=>'201'], 201);
            }else{
              return response()->json(["message" => "Email already exists!",'code'=>'201'], 201);
            }
        }else{
            $unique_id = random_int(100,100000);
            UserEmails::signUpEmail($req->email, $unique_id);
            return response()->json(["message" => "Email Sent Successfully","verify_code"=>"$unique_id",'code'=>'200'], 200);
        }
    }
    public function user_login(Request $request){
      
        $validator = \Validator::make($request->all(), [
            'password' => 'required|string|max:191',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        try{
            $email=$request->email;
            $password=$request->password;
            $user_infos=user_infos::where('email',$request->email)->first();
            if (empty($user_infos)) {
                $user_infos=user_infos::where('phone_number',$request->email)->first();
            }
            if(!empty($user_infos)){
                if(Hash::check($request->password,$user_infos->password)){
                    // if($user_infos->user_status == '0'){
                    //     return ['code'=>'201','user_status'=>$user_infos->user_status,'message'=>'Your Account Is In Pending State Wait For The Account Approval'];
                    // }else
                    if($user_infos->user_type == '1'){
                        // $user_infos->remember_token=str::random(50);
                        // DB::table('user_infos')->where('user_id',$user_infos->user_id)->update(['remember_token'=>$user_infos->remember_token]);
                        // $sendT = UserEmails::signUpEmail($request->email, $user_infos->user_id);
                        return ['code'=>'200','Status'=>'success','image_url'=>'https://admin.4rizon.com/image/','user_info'=>$user_infos]; 
                    }elseif($user_infos->user_type == '2'){
                      $user_infos->remember_token=str::random(50);
                        DB::table('user_infos')->where('user_id',$user_infos->user_id)->update(['remember_token'=>$user_infos->remember_token]);
                        // $sendT = UserEmails::signUpEmail($request->email, $user_infos->user_id);
                        return ['code'=>'200','Status'=>'success','image_url'=>'https://admin.4rizon.com/image/','user_info'=>$user_infos]; 
                        // return ['code'=>'201','status'=>'failed','message'=>'Your Account Is Invalid Due To Email Verification.'];
                    }elseif($user_infos->user_status == '-1'){
                        return ['code'=>'201','status'=>'failed','message'=>'Your Account Is Blocked By Admin.'];
                    }elseif($user_infos->user_type == '3'){
                      // $user_infos->remember_token=str::random(50);
                      // DB::table('user_infos')->where('user_id',$user_infos->user_id)->update(['remember_token'=>$user_infos->remember_token]);
                      // $sendT = UserEmails::signUpEmail($request->email, $user_infos->user_id);
                      return ['code'=>'200','Status'=>'success','image_url'=>'https://admin.4rizon.com/image/','user_info'=>$user_infos]; 
                  }
                  }  
                else{
                    return ['code'=>'201','status'=>'failed','message'=>'Incorrect Password Please Enter Valid Password To Login'];
                }
            }else{
                return ['code'=>'201','status'=>'failed','message'=>'User Not Found'];
            }
        }catch(\Exception $e){
            return response()->json(["status"=>"error", "code" => 201, "message"=> $e->getMessage()]);
        }
    }
    public function register_test_user(Request $req) {
        $type = "application/json";

        $user_infos = TestUser::where('email','=',$req->email)->get();

        if (sizeof($user_infos) > 0){
          return response()->json(["message" => "Email already exists!"], 201);
        }else{
          
          $validator = \Validator::make($req->all(), [
            'first_name'   => 'required|string|max:191',
            'last_name'    => 'required|string|max:191',
            'phone_number' => 'required',
            'email'        => 'required',
            'password'     => 'required',
            'c_password'   => 'required',
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
            $user_infos = new TestUser;
            $user_infos->first_name       = $req->first_name;
            $user_infos->last_name        = $req->last_name;
            $user_infos->phone_number     = $req->phone_number;
            $user_infos->email            = $req->email;
            $user_infos->password         = Hash::make($req->password);
            $user_infos->identification_num = $req->identification_num;
            $user_infos->dob              = $req->dob;
            $user_infos->nationality      = $req->nationality;
            $user_infos->gender           = $req->gender;
            $user_infos->remember_token   =str::random(50);
            $user_infos->role             = "user";
            $user_infos->save();
            $reset_passwords = new reset_passwords;
            $reset_passwords->email = $req->email;
            $reset_passwords->password = $req->password;  
            $reset_passwords->save();   
            return response()->json(["message" => "User Registered Successfully"], 201);
          }else{
            return response()->json(["message" => "Passwords Didn't Matched"], 201);
          }
        }
    }
    public function test_login_user(Request $request){
      
        $validator = \Validator::make($request->all(), [
            'password' => 'required|string|max:191',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        try{
            $email=$request->email;
            $password=$request->password;
            $user_infos=DB::table('test_users')->select('first_name','last_name','email','remember_token','user_id','password')->where('email',$request->email)->first();
            if (empty($user_infos)) {
                $user_infos=DB::table('test_users')->select('first_name','last_name','email','remember_token','user_id','password')->where('phone_number',$request->email)->first();
            }
            

            if(Hash::check($request->password,$user_infos->password)){
                
                $user_infos->remember_token=str::random(50);
                DB::table('test_users')->where('user_id',$user_infos->user_id)->update(['remember_token'=>$user_infos->remember_token]);
                return ['code'=>'200','Status'=>'success','user_info'=>$user_infos];    
            }else{
                return ['code'=>'400','status'=>'failed','message'=>'user not found'];
            }
        }catch(\Exception $e){
            return response()->json(["status"=>"error", "code" => 201, "message"=> $e->getMessage()]);
        }
    }
    public function create_user(Request $req){
      $type = "application/json";

      $user_infos = user_infos::where('email','=',$req->email)->get();
       
        if (sizeof($user_infos) > 0){
          return response()->json(["message" => "Email already exists!"], 201);
        }else{
          
          $validator = \Validator::make($req->all(), [
            'first_name'   => 'required|string|max:191',
            'last_name'    => 'required|string|max:191',
            'phone_number' => 'required',
            'email'        => 'required',
            'password'     => 'required',
            'c_password'   => 'required',
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
            $user_infos->identification_num = $req->identification_num;
            $user_infos->dob              = $req->dob;
            $user_infos->nationality      = $req->nationality;
            $user_infos->gender           = $req->gender;
            $user_infos->remember_token   =str::random(50);
            $user_infos->role             = "user";
            $user_infos->save();
            return response()->json(["message" => "User Registered Successfully"], 201);
          }else{
            return response()->json(["message" => "Passwords Didn't Matched"], 201);
          }
        }
  }
    public function edit_user(Request $req){
      $user_id = $req->id;
     
      $users = user_infos::where('user_id',$user_id)->get();
      return ['code'=>'200','Status'=>'success','user'=>$users];
  }
    public function update_user(Request $req){

        user_infos::where('user_id','=',$req->id)->update([
          'first_name'=>$req->first_name,
          'last_name'=>$req->last_name,
          'phone_number'=>$req->phone_number,
          'email'=>$req->email,
          'identification_num'=>$req->identification_num,
          'dob'=>$req->dob,
          'nationality'=>$req->nationality,
          'gender'=>$req->gender,
        ]);
                
          // if (!empty($req->password)) {
          //     $user_infos->password = Hash::make($req->password);
          // }
          // $user_infos->role = $req->role;
          // $user_infos->save();
          return response()->json(["message" => "User Updated Successfully"], 201);
    }
    public function update_password_api(Request $req){
        $user = user_infos::where('user_id','=',$req->id)->first();
       if(!empty($user)){
            if(!empty($req->password)) {
                $validator = \Validator::make($req->all(), [
                'password' =>  'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|confirmed'
              ]);
              if ($validator->fails()) {
                $responseArr['message'] = $validator->errors();
                return response()->json($responseArr);
              }else{
                user_infos::where('user_id','=',$user->id)->update([
                  'password'=>Hash::make($req->password),
                ]);
              }
                
            }
       }
          return response()->json(["message" => "Password Updated Successfully"], 200);
    } 
    public function notification(Request $req){
      UserEmails::notifications($req->email);   
          return response()->json(["message" => "Email Sent"], 200);
    }
    public function update_forget_password_api(Request $req){
        $user = user_infos::where('email',$req->email)->first();
        if(is_null($user)){
          return response()->json(["message" => "User Not Found"], 201);  
        }else{
          UserEmails::passwordReset($req->email);   
          return response()->json(["message" => "Email Sent"], 200);
        }
    }
    public function update_forget_password_admin(Request $req){
      $user = Admin::where('email',$req->email)->first();
      if(is_null($user)){
        return response()->json(["message" => "User Not Found"], 201);  
      }else{
        UserEmails::passwordResetAdmin($req->email);   
        return view('email_sent');
      }
      
  }
    public function dj_password_api(Request $req){
      $user = DjUser::where('email',$req->email)->first();
      if(is_null($user)){
        return response()->json(["message" => "User Not Found"], 201);  
      }else{
        UserEmails::passwordReset($req->email);   
        return response()->json(["message" => "Email Sent"], 200);
      }
      UserEmails::passwordReset($req->email);  
  }
    public function deleteUser ($id) {
    if(user_infos::where('user_id', $id)->exists()) {
       $user= user_infos::where('user_id', $id)->delete();
       
       return response()->json(["message" => "user record deleted"], 202);
    } else {
       return response()->json(["message" => "user not found"], 201);
    }
  }
    public function update_status(Request $req){

        user_infos::where('user_id','=',$req->id)->update([
          'user_status'=>1,
        ]);
          return response()->json(["message" => "User Status Updated Successfully"], 201);
    }
    function total_points_collected(){
           
        $points = user_wallets::where("available_points","!=",0)->get();
        return view("users.total_points_collected",["points" => $points,]);
            
    }
    function total_points_collects($fromdate,$todate){
        if($fromdate == $todate){
          $points = user_wallets::where("available_points","!=",0)->where('created_at', '>=', $fromdate.' 00:00:00')->get();
        }else{
              $points = user_wallets::where("available_points","!=",0)->whereDate('created_at','>=',$fromdate)->whereDate('created_at','<=',$todate)->get();
        }
        return view("users.total_points_collected",["points" => $points,]);
            
    }
    function total_points_redeemed(){
           
        $points           = Purchase::all();
        return view("users.total_points_redeemed",["points" => $points,]);
    }
    function total_points_redeem($fromdate,$todate){
        if($fromdate == $todate){
          $points = Purchase::where('created_at', '>=', $fromdate.' 00:00:00')->get();
        }else{
              $points = Purchase::whereDate('created_at','>=',$fromdate)->whereDate('created_at','<=',$todate)->get();
        }
        return view("users.total_points_redeemed",["points" => $points,]);
    }
    function total_qr_scans(){
        $total_qr         = EventAttend::whereNotNull('booking_id')->get();
        return view("users.total_qr_scans",["qr_scan" => $total_qr,]);
    }

  public function exportCSV(Request $request)
    {
       $fileName = 'users.csv';
       $tasks = user_infos::all();
    
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );
    
            $columns = array('ID', 'First Name', 'Last Name', 'Email','dob','identification_num', 'Registered At','role','nationality','gender');
    
            $callback = function() use($tasks, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
    
                foreach ($tasks as $task) {
                    $row['ID']  = $task->user_id;
                    $row['First Name']    = $task->first_name;
                    $row['Last Name']    = $task->last_name;
                    $row['Email']  = $task->email;
                    $row['dob'] = $task->dob;
                    $row['identification_num'] = $task->identification_num;
                    $row['Registered At']  = $task->created_at;
                    $row['role'] = $task->role;
                    $row['nationality'] = $task->nationality;
                    $row['gender'] = $task->gender;
                    
    
                    fputcsv($file, array($row['ID'], $row['First Name'], $row['Last Name'], $row['Email'],$row['dob'],$row['identification_num'], $row['Registered At'],$row['role'],$row['nationality'],$row['gender']));
                }
    
                fclose($file);
            };
    
            return response()->stream($callback, 200, $headers);
  }
  public function exportdjCSV(Request $request)
    {
       $fileName = 'djuser.csv';
       $tasks = DjUser::all();
    
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );
    
            $columns = array('ID', 'First Name', 'Last Name', 'Email', 'Phone No','representation','gender','dj_name','passport_id','southAfrican_id');
    
            $callback = function() use($tasks, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
    
                foreach ($tasks as $task) {
                    $row['ID']  = $task->id;
                    $row['First Name']    = $task->first_name;
                    $row['Last Name']    = $task->last_name;
                    $row['Email']  = $task->email;
                    $row['Phone No']  = $task->phone_number;
                    $row['representation'] = $task->representation;
                    $row['gender'] = $task->gender;
                    $row['dj_name']  = $task->dj_name;
                    $row['passport_id'] = $task->passport_id;
                    $row['southAfrican_id'] = $task->southAfrican_id;
    
                    fputcsv($file, array($row['ID'], $row['First Name'], $row['Last Name'], $row['Email'], $row['Phone No'],$row['representation'],$row['gender'],$row['dj_name'],$row['passport_id'],$row['southAfrican_id']));
                }
    
                fclose($file);
            };
    
            return response()->stream($callback, 200, $headers);
  }

  function add_new_user(){
    return view("users.add_user");
  }
  function register_new_user(){
    return view("users.register_user");
  }
  function reset_password(){
    return view("reset_password",["message"=>""]);
  }
  function r_pass(){
    return view("r_pass",["message"=>""]);
  }
  function email_sent(){
    return view("email_sent",["message"=>""]);
  }
  function success(){
    return view("success",["message"=>""]);
  }
  function reset_password_admin(){
    return view("reset_password_admin",["message"=>""]);
  }
  function reset_password_entrance(){
    return view("reset_password_entrance",["message"=>""]);
  }
  function dj_reset_password(){
    return view("dj_reset_password");
  }
  function update_password_admin(Request $request){
 
    $validator = \Validator::make($request->all(), [
      'password' =>  'required|max:191',
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
        else{
          $password = Hash::make($request->password);
          // print_r($password);die();
          Admin::where('email','=',$request->email)->update([
            'password'=>$password
          ]);
          return redirect('/login');
          
        }
    }catch(\Exception $e){
        return response()->json(["status"=>"error", "code" => 201, "message"=> $e->getMessage()]);
        
    }
  
  return view("reset_password",["message"=>'']);
}
  function update_password(Request $request){
 
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
          $user_infos=DB::table('user_infos')->select('email')->where('email',$request->email)->first();
          if (empty($user_infos)) {
              return ['code'=>'201','status'=>'failed','message'=>'Invalid EMAIL'];
          }
          if(!empty($user_infos)){
            PasswordReset::where('email','=',$request->email)->update([
              'password'=>$password
            ]);
            $password = Hash::make($request->password);
            user_infos::where('email','=',$request->email)->update([
              'password'=>$password
            ]);
            return view("success");
            
          }
      }catch(\Exception $e){
          return response()->json(["status"=>"error", "code" => 201, "message"=> $e->getMessage()]);
          
      }
    
    return view("reset_password",["message"=>'']);
  }
  function dj_update_password(Request $request){
    $validator = \Validator::make($request->all(), [
        'password' => 'required|string|max:191',
        'email' => 'required',
    ]);
    if ($validator->fails()) {
        $responseArr['message'] = $validator->errors();
        return response()->json($responseArr);
    }
    try{
        $email=$request->email;
        $password = $request->password;
        $user_infos=DB::table('djusers')->select('email')->where('email',$request->email)->first();
        if (empty($user_infos)) {
            return ['code'=>'201','status'=>'failed','message'=>'Invalid EMAIL'];
        }
        if(!empty($user_infos)){
          DjPasswordReset::where('email','=',$request->email)->update([
            'password'=>$password
          ]);
          $password = Hash::make($request->password);
          DjUser::where('email','=',$request->email)->update([
            'password'=>$password
          ]);
          return view("success");
          
        }
    }catch(\Exception $e){
        return response()->json(["status"=>"error", "code" => 201, "message"=> $e->getMessage()]);
    }
  
  return view("dj_reset_password");
}
  function upload_user_files(Request $req){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $user_infos = user_infos::where('email','=',$req->user_id)->get();
    if (sizeof($user_infos) > 0){
      return redirect('/users_list')->with('error','Email already exists!');
    }else{
      $user_infosPic = "";
      if ($req->hasFile('picture')) {
        $user_infosPic             = time().'.'.$req->picture->extension();
        $req->picture->move('image', $user_infosPic);
      }
     
      if ($req->hasFile('front_id')) {
     
        $user_infosFrontId             = time().'.'.$req->front_id->extension();
        $req->front_id->move('image', $user_infosFrontId);
        
      }
      if ($req->hasFile('back_id')) {
        $user_infosBackId           = time().'.'.$req->back_id->extension();
        $req->back_id->move('image', $user_infosBackId);
      }
      if(!empty($user_infosPic)){
        user_infos::where('user_id','=',$req->id)->update([
          'picture'=> $user_infosPic,
        ]);
      }
      if(!empty($user_infosFrontId)){
        user_infos::where('user_id','=',$req->id)->update([
          'front_id' => $user_infosFrontId,
        ]);
      }
      if(!empty($user_infosBackId)){
        user_infos::where('user_id','=',$req->id)->update([
          'back_id'=> $user_infosBackId,
        ]);
      }
      
      return response()->json(['message' =>"Uploaded Successfully", 'success' => true], 200);

    }
  }
  function save_user(Request $req){
    $validator = \Validator::make($req->all(), [
     
      'dob'        => 'required|date|before:13 years ago'
    ]);
    if($validator->fails()){
      return redirect('/users_list')->with('error','You must be 18 years old or above');
    }
    else{
    $user_infos = user_infos::where('email','=',$req->email)->get();
    if (sizeof($user_infos) > 0){
      return redirect('/users_list')->with('error','Email already exists!');
    }else{
      
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
      if ($req->hasFile('picture')) {
          $user_infosPic             = time().'.'.$req->picture->extension();
          $req->picture->move('image', $user_infosPic);
          $user_infos->picture = $user_infosPic;
      }
      $user_infos->remember_token   = str::random(50);
      $user_infos->role             = "user";
      $user_infos->user_status      = "0";
      $user_infos->save();
      $user = user_infos::where('email', $req->email)->first();
      $user_wallet = new user_wallets;
      $user_wallet->user_id      = $user->user_id;
      $user_wallet->available_points    = 0;
      $user_wallet->save();
      $reset_passwords = new PasswordReset;
      $reset_passwords->email = $req->email;
      $reset_passwords->password = $req->password;  
      $reset_passwords->save();   
      return redirect('/users_list')->with('success','User Registered Successfully!');
    }
  }
  }
  function create(Request $req){ 
    
    $users_data        = User::where('email','=',$req->user_email)->get();
    if (sizeof($users_data) > 0){
        return redirect('/admin_list')->with('error','Email already exists!');
    }else{
        $users = new User;
        $users->name       = $req->name;
        $users->email      = $req->user_email;
        $users->password   = Hash::make($req->user_password);
        // print_r($users->password);die();
        $users->role       = $req->user_role;
        $users->save();
        return redirect('/admin_list')->with('success','Admin Created!');
    }
  }
  function update_admin_user(Request $req){
        $users = User::find($req->id);
        $users->name       = $req->name;
        $users->email      = $req->user_email;
        if(!empty($req->user_password)){
            $users->password   = Hash::make($req->user_password);
        }
        $users->role       = $req->user_role;
        $users->save();
        return redirect('/admin_list')->with('success','Admin Updated Successfully!');
  }
  function check_user(Request $req){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $users = DjUser::where('email', $result['email'])->get();
   
    if(!empty($users)){
      return response()->json(['status' =>"1", 'success' => true], 200);
    }
    return response()->json(['status' =>"0", 'success' => false], 201);
}
  public function delete_admin_details ($id) {
    if(User::where('id', $id)->exists()) {
       $user= User::where('id', $id)->delete();
       return redirect('/admin_list')->with('success','Admin User Deleted Successfully!');
    } else {
       return redirect('/admin_list')->with('error','User Not Found');
    }
  }
  public function admin_list(){
    $users_data = User::all();
    return view("users.adminlist",['users_list'=>$users_data,]);
  }
  public function edit_admin_details($id){
    $users_data = User::find($id);
    return view("users.adminEdit",['user'=>$users_data,]);
  }
  public function users_list(){
    $users_data = user_infos::all();
    return view("users.list",['users_list'=>$users_data,]);
  }
  public function users_lists($fromdate,$todate){
      if($fromdate == $todate){
          $users_data = user_infos::where('created_at', '>=', $fromdate.' 00:00:00')->get();
      }else{
          $users_data = user_infos::whereDate('created_at','>=',$fromdate)->whereDate('created_at','<=',$todate)->get();
      }
    
    return view("users.list",['users_list'=>$users_data,]);
  }
  public function active_users(){
    $users_data = user_infos::where('user_status',1)->get();
    return view("users.activelist",['users_list'=>$users_data,]);
  }
  public function active_users_list($fromdate,$todate){
      if($fromdate == $todate){
          $users_data = user_infos::where('user_status',1)->where('created_at', '>=', $fromdate.' 00:00:00')->get();
      }else{
          $users_data = user_infos::where('user_status',1)->whereDate('created_at','>=',$fromdate)->whereDate('created_at','<=',$todate)->get();
      }
       return view("users.activelist",['users_list'=>$users_data,]);
  }
  public function inactive_users(){
    user_infos::where('notify_status','=','0')->update([
      'notify_status'=> '1',
    ]);
    $users_data = user_infos::where('user_status',0)->orWhere('user_status',3)->get();

    return view("users.inactivelist",['users_list'=>$users_data,]);
  }
 
  public function denied_users(){
    $users_data = user_infos::where('user_status','3')->get();
    return view("users.deniedlist",['users_list'=>$users_data,]);
  }
  public function blocked_users(){
    $users_data = user_infos::where('user_status','-1')->get();
    return view("users.blockedlist",['users_list'=>$users_data,]);
  }
  public function inactives_users($fromdate,$todate){
      if($fromdate == $todate){
          $users_data = user_infos::where('user_status',0)->where('created_at', '>=', $fromdate.' 00:00:00')->get();
      }else{
          $users_data = user_infos::where('user_status',0)->whereDate('created_at','>=',$fromdate)->whereDate('created_at','<=',$todate)->get();
      }
      return view("users.inactivelist",['users_list'=>$users_data,]);
  }
  public function invalid_users(){
    $users_data = user_infos::where('user_status',3)->get();
    return view("users.invalid",['users_list'=>$users_data,]);
  }
  public function invalid_users_lists($fromdate,$todate){
      if($fromdate == $todate){
          $users_data = user_infos::where('user_status',2)->where('created_at', '>=', $fromdate.' 00:00:00')->get();
        }else{
              $users_data = user_infos::where('user_status',2)->whereDate('created_at','>=',$fromdate)->whereDate('created_at','<=',$todate)->get();
        }
    return view("users.invalid",['users_list'=>$users_data,]);
  }

  function verify_user(){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $cb = $result['user_id'];
    $identification_num = $result['identification_number'];
    $identification_type = $result['identification_type'];
    $gender = $result['gender'];
    $dob = $result['dob'];
    $nationality = $result['nationality'];

    user_infos::where('user_id','=',$cb)->update([
      'identification_num'=>"$identification_num",'identification_type'=>"$identification_type","gender"=>"$gender","dob"=>"$dob","nationality"=>"$nationality"
    ]);
     $user_infos = user_infos::where('user_id','=',$cb)->first();
     if($user_infos->identification_type == 2){
      user_infos::where('user_id','=',$cb)->update([
        'user_status'=>"1"
      ]);
      $userFind = user_infos::where('user_id',$cb)->first();
      $message = "Your Account Has Been Approved";
      if (!is_null($userFind->player_id)){
        $this->mobile_push_notification($message,$userFind->player_id);
      }
      $email = user_infos::where('user_id','=',$cb)->first();
      UserEmails::notifications($email->email);
      return response()->json(["message" => "User Verified","user_type"=>$email->user_type],200);
    }
    else{
        $dha_profile = Dha_profile::where('user_id','=',$cb)->first();
        if(!empty($dha_profile)){
          user_infos::where('user_id','=',$cb)->update([
           'user_status'=>"1"
          ]);
          $userFind = user_infos::where('user_id',$cb)->first();
          $message = "Your Account Has Been Approved";
          if (!is_null($userFind->player_id)){
            $this->mobile_push_notification($message,$userFind->player_id);
          }
          $email = user_infos::where('user_id','=',$cb)->first();
          UserEmails::notifications($email->email);
          return response()->json(["message" => "User Verified","user_type"=>$email->user_type],200);

        }
       
  
        else{

          $data_array = array();
          $data_array['Token'] = "9a88abd8-2f4a-4f6f-bbcf-22755254f89b";
          $data_array['Username'] = "Jynx";
          $data_array['Password'] = "Pass12345";
          $data_array['TransactionReference'] = "Your internal reference";
          $user_infos = user_infos::where('user_id','=',$cb)->first();
          $data_array['idNumber'] = $user_infos->identification_num;
          $result = json_decode(file_get_contents("php://input"), true);
          
          $make_call = json_decode($this->callCoreInfoAPI(json_encode($data_array)),true);
         
         
          if($make_call == null){
            user_infos::where('user_id','=',$cb)->update([
              'user_status'=>"3"
            ]);
            $userFind = user_infos::where('user_id',$cb)->first();
            $message = "Your Account Has Been Denied";
            if (!is_null($userFind->player_id)){
              $this->mobile_push_notification($message,$userFind->player_id);
            }
            $user = user_infos::where('user_id','=',$cb)->first();
            return response()->json(["message" => "Denied Verification","user_type"=>$user->user_type],200);

          }
          else{
            $dha_info = new Dha_profile;
          $dha_info->user_id              = $cb;
          $dha_info->identification_num   = $user_infos->identification_num;
          $dha_info->personName           = $make_call['personName'];
          $dha_info->personSurname        = $make_call['personSurname'];
          $dha_info->gender               = $make_call['gender'];
          $dha_info->dateOfBirth          = $make_call['dateOfBirth'];
          $dha_info->aliveStatus          = $make_call['aliveStatus'];
          $dha_info->dha_api_status       = $make_call['clientFeedback']['clientErrorInfo'];
          $dha_info->save();
          $dha_profile = Dha_profile::where('user_id','=',$cb)->first();
          if(!empty($dha_profile)){
            user_infos::where('user_id','=',$cb)->update([
              'user_status'=>"1"
            ]);
             $userFind = user_infos::where('user_id',$cb)->first();
          $message = "Your Account Has Been Approved";
          if (!is_null($userFind->player_id)){
            $this->mobile_push_notification($message,$userFind->player_id);
          }
            $email = user_infos::where('user_id','=',$cb)->first();
            UserEmails::notifications($email->email);
          }
          return response()->json(["message" => "User Verified","user_type"=>$email->user_type],200);

          }

        }
      }
  }
    
    
  
  function user_delete(){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $dj = user_infos::where('user_id', '=',$result['id'])->delete();
    return response()->json(["message" => "User Deleted"],200);
  }

  function multiple_approve(Request $req){
   
      // $s = $req->input('pass_checkedvalue');
      $s = $_POST['pass_checkedvalue'];
       
      // $string1 = implode(',',$s);
   
      $string = $s;
      $checkbox = explode(',', $string);
      
    
      if(!empty($checkbox)){
        
        foreach($checkbox as $cb){
          $dha_profile = Dha_profile::where('user_id','=',$cb)->first();
          if(!empty($dha_profile)){
            user_infos::where('user_id','=',$cb)->update([
              'user_status'=>"1"
            ]);
            $userFind = user_infos::where('user_id',$cb)->first();
            $message = "Your Account Has Been Approved";
            if (!is_null($userFind->player_id)){
              $this->mobile_push_notification($message,$userFind->player_id);
            }
            $email = user_infos::where('user_id','=',$cb)->first();
            UserEmails::notifications($email->email);
          }
         
    
          else{
            $user_infos = user_infos::where('user_id','=',$cb)->first();
              if($user_infos->identification_type == 2){
                user_infos::where('user_id','=',$cb)->update([
                  'user_status'=>"1"
                ]);
                $userFind = user_infos::where('user_id',$cb)->first();
                $message = "Your Account Has Been Approved";
                if (!is_null($userFind->player_id)){
                  $this->mobile_push_notification($message,$userFind->player_id);
                }
                $email = user_infos::where('user_id','=',$cb)->first();
                UserEmails::notifications($email->email);
              }
              else{
            $data_array = array();
            $data_array['Token'] = "9a88abd8-2f4a-4f6f-bbcf-22755254f89b";
            $data_array['Username'] = "Jynx";
            $data_array['Password'] = "Pass12345";
            $data_array['TransactionReference'] = "Your internal reference";
            
            $data_array['idNumber'] = $user_infos->identification_num;
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
           
            if(empty($make_call)){
              user_infos::where('user_id','=',$cb)->update([
                'user_status'=>"3"
              ]);
              $userFind = user_infos::where('user_id',$cb)->first();
              $message = "Your Account Has Been Denied";
              if (!is_null($userFind->player_id)){
                $this->mobile_push_notification($message,$userFind->player_id);
              }
            }
            else{
              $dha_info = new Dha_profile;
            $dha_info->user_id              = $cb;
            $dha_info->identification_num   = $user_infos->identification_num;
            $dha_info->personName           = $make_call['personName'];
            $dha_info->personSurname        = $make_call['personSurname'];
            $dha_info->gender               = $make_call['gender'];
            $dha_info->dateOfBirth          = $make_call['dateOfBirth'];
            $dha_info->aliveStatus          = $make_call['aliveStatus'];
            $dha_info->dha_api_status       = $make_call['clientFeedback']['clientErrorInfo'];
            $dha_info->save();
            $dha_profile = Dha_profile::where('user_id','=',$cb)->first();
            if(!empty($dha_profile)){
              user_infos::where('user_id','=',$cb)->update([
                'user_status'=>"1"
              ]);
               $userFind = user_infos::where('user_id',$cb)->first();
                $message = "Your Account Has Been Approved";
                if (!is_null($userFind->player_id)){
                  $this->mobile_push_notification($message,$userFind->player_id);
                }
              $email = user_infos::where('user_id','=',$cb)->first();
              UserEmails::notifications($email->email);
            }
           
            }
          }
          }
        }
      
      }
      $users_data = user_infos::where('user_status',0)->orWhere('user_status',3)->get();
     
      return view("users.inactivelist",['users_list'=>$users_data]);

  }
  public function delete_user_details ($id) {
    if(user_infos::where('user_id', $id)->exists()) {
       $user= user_infos::where('user_id', $id)->delete();
       $userWallet= user_wallets::where('user_id', $id)->delete();
       return redirect('/users_list')->with('success','User Deleted Successfully!');
    } else {
       return redirect('/users_list')->with('error','User Not Found');
    }
  }
  function multiple_approve_dj(Request $req){
    $type = "application/json";
    $checkbox = $req->input('checkbox');
  //  $checkbox = $req->djId;
    // print_r($checkbox);die();
    if(!empty($checkbox)){
      
      foreach($checkbox as $cb){
        $dha_profile = Dj_Dha_profile::where('dj_id','=',$cb)->first();
        if(!empty($dha_profile)){
          DjUser::where('id','=',$cb)->update([
            'dj_status'=>"1"
          ]);
           $userFind = DjUser::where('id',$cb)->first();
                $message = "Your Account Has Been Approved";
                if (!is_null($userFind->device_id)){
                  $this->mobile_push_notification($message,$userFind->device_id);
                }
          $email = DjUser::where('id','=',$cb)->first();
          UserEmails::notifications($email->email);
        }
      

        else{
          $user_infos = DjUser::where('id','=',$cb)->first();
          if($user_infos->passport_id != ""){
            $userFind = DjUser::where('id',$cb)->first();
            $message = "Your Account Has Been Approved";
            if (!is_null($userFind->device_id)){
              $this->mobile_push_notification($message,$userFind->device_id);
            }
              $email = DjUser::where('id','=',$cb)->first();
              UserEmails::notifications($email->email);
          }
          else{
          $data_array = array();
          $data_array['Token'] = "9a88abd8-2f4a-4f6f-bbcf-22755254f89b";
          $data_array['Username'] = "Jynx";
          $data_array['Password'] = "Pass12345";
          $data_array['TransactionReference'] = "Your internal reference";
         
          $data_array['idNumber'] = $user_infos->southAfrican_id;
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
        
          if(empty($make_call)){
            DjUser::where('id','=',$cb)->update([
              'dj_status'=>"3"
            ]);
            $userFind = DjUser::where('id',$cb)->first();
            $message = "Your Account Has Been Denied";
            if (!is_null($userFind->device_id)){
              $this->mobile_push_notification($message,$userFind->device_id);
            }
          }
          else{
            $dha_info = new Dj_Dha_profile;
          $dha_info->dj_id              = $cb;
          $dha_info->identification_num   = $user_infos->southAfrican_id;
          $dha_info->personName           = $make_call['personName'];
          $dha_info->personSurname        = $make_call['personSurname'];
          $dha_info->gender               = $make_call['gender'];
          $dha_info->dateOfBirth          = $make_call['dateOfBirth'];
          $dha_info->aliveStatus          = $make_call['aliveStatus'];
          $dha_info->dha_api_status       = $make_call['clientFeedback']['clientErrorInfo'];
          $dha_info->save();
          $dha_profile = Dj_Dha_profile::where('dj_id','=',$cb)->first();
          if(!empty($dha_profile)){
            DjUser::where('id','=',$cb)->update([
              'dj_status'=>"1"
            ]);
             $userFind = DjUser::where('id',$cb)->first();
                $message = "Your Account Has Been Approved";
                if (!is_null($userFind->device_id)){
                  $this->mobile_push_notification($message,$userFind->device_id);
                }
            $email = DjUser::where('id','=',$cb)->first();
            UserEmails::notifications($email->email);
          }
        
          }
        }
        }
      }
    
    }
    $users_data = DjUser::where('dj_status',0)->orWhere('dj_status',2)->orWhere('dj_status',1)->orWhere('dj_status',3)->get();
  
    return view("users.admindjlist",['dj_list'=>$users_data]);

}
  
  public function edit_user_details($id){
    $user_data = user_infos::where('user_id','=',$id)->get();
    $dha_profile = Dha_profile::where('user_id',$user_data->pluck('user_id'))->first();
    $dha_address = Dha_Address::where('user_id',$user_data->pluck('user_id'))->first();
    // dd($users_data);die();
    return view("users.userEdit",['user'=>$user_data,'dha_profile'=>$dha_profile,'dha_address'=>$dha_address]);

  }
 

  function update_user_db(Request $req){
    $validator = \Validator::make($req->all(), [
      'first_name'   => 'required|string|max:191',
      'last_name'    => 'required|string|max:191',
      'gender'   => 'required|string|max:191',
      'phone_number' => 'required|numeric',
      'email'        => 'required|email',
    ]);
    
    $id = $req->id;
    if(!empty($req->points)){
       $user_data = user_wallets::where('user_id','=',$id)->first();
       $points = $user_data->available_points + $req->points;
      $users_data = user_wallets::where('user_id','=',$id)->update([
    
        'available_points'      => $points,
      ]);
    }
    if(!empty($req->user_password)){
      $req->user_password  = Hash::make($req->user_password);
    }
    else{
      $data = user_infos::where('user_id','=',$id)->get();
      foreach($data as $user_data){
        $req->user_password = $user_data->password;
      }

    }
    $nums = 0;
    
    if (isset($req->user_image)) {
      $userPic             = time().$nums.'.'.$req->user_image->extension();  
      $req->user_image->move(public_path('image'), $userPic);
      
    }
    else{
      $userPic = $req->picture;
    }
    
    $users_data = user_infos::where('user_id','=',$id)->update([
    
    'first_name'      => $req->first_name,
    'last_name'       => $req->last_name,
    'gender'          => $req->user_gender,
    'email'           => $req->user_email,
    'phone_number'    => $req->phone_number,
      'password'      => $req->user_password,
      'identification_type'=> $req->identification_type,
      'nationality' => $req->nationality,
      'identification_num' => $req->identification_number,
      'picture'      =>  $userPic,
      'user_status' => $req->user_status,
  ]);
  
    return redirect('/users_list')->with('success',' User Updated Successfully!');
}

  function view_user_details(Request $req,$id){
    $result = json_decode(file_get_contents("php://input"), true);

    
    $user_data = user_infos::where('user_id','=',$id)->get();
    $dha_profile = Dha_profile::where('user_id',$user_data->pluck('user_id'))->first();
    $dha_address = Dha_Address::where('user_id',$user_data->pluck('user_id'))->first();
    return view("users.view",['users'=>$user_data,'dha_profile'=>$dha_profile,'dha_address'=>$dha_address]);
  }
  public function user_status_update(Request $req){
    user_infos::where('user_id','=',$req->id)->update([
      'user_status'=>"2"
    ]);
    return redirect('/users_list')->with('success','User Status Changed Successfully!');
  }
   public function wallet_points(Request $req){ 
    
    $user_id = $req->id;
    $purchase_coins = Purchase::where("user_id",$user_id)->where("redeemed_status","0")->sum('purchase.item_price');
    // $user_data = user_wallets::where('user_id','=',$user_id)->pluck('available_points');
    $user_data = user_wallets::where('user_id','=',$user_id)->first();
    $available_coins = $user_data->available_points - $purchase_coins;
    return response()->json(['available_coins' =>$available_coins, 'success' => true], 200);
  }
  
  // api functions for access tokens
  public function generate_token($user_id){
    $accessToken  = str::random(20);
    $tomorrow = date("Y-m-d H:i:s", strtotime('+1 day'));
    user_infos::where('user_id','=',$user_id)->update([
      'access_token'=> $accessToken,
      'token_expires_at'=> $tomorrow,
    ]);
    return response()->json(['token' =>$accessToken,'expires_at' =>$tomorrow, 'success' => true], 200);
  }
  public function verify_token($user_id,$token){
    $today = date("Y-m-d H:i:s");
    $verify = user_infos::where('user_id',$user_id)->where('access_token',$token)->whereDate('token_expires_at', '<=', $today)->first();
    if(!empty($verify)){
      return response()->json(['token' =>"Access Token Expired", 'error' => true], 201);
    }else{
      return response()->json(['token' =>"Access Granted", 'success' => true], 200);
    }
  }
  public function users_list_api(){
    $users = user_infos::where('user_status','1')->get();
    return response()->json(['users_list' =>$users, 'success' => true], 200);
  }
  public function user_select_list_api(){
    $users = DB::table('user_infos')->select('user_id', 'first_name','last_name','phone_number')->where('user_status','1')->get();
    return response()->json(['users_list' =>$users, 'success' => true], 200);
  }
  public function share_reward(Request $req){
    $reward = user_wallets::where('user_id',$req->user_id)->first();
    $users  = Hash::make($req->password);
    print_r($users);die();
    $share = AppShare::where('count_share','count_share')->first();
    AppShare::where('count_share','count_share')->update([
      'count_share'=> $share->count_share + 1,
    ]);
    if(!empty($reward)){
      user_wallets::where('user_id','=',$req->user_id)->update([
        'available_points'=> $reward->available_points+150,
      ]);
      
      return response()->json(['message' =>"Coins Reward Added Successfully!", 'success' => true], 200);
    }else{
      return response()->json(['message' =>"User Not Found", 'error' => true], 201);
    } 
  }
  
  public function profile_user($id){
      $users = user_infos::where('user_id',$id)->get();
      return ['code'=>'200','Status'=>'success','user'=>$users];
  }
  function update_profile(Request $req){
    $user  = user_infos::where('user_id',$req->id)->first();
    if ($req->has('new_password')) {
        if(!empty($req->new_password)){
           $password   = Hash::make($req->new_password);
        }else{
          $password    = $user->password;
        }
        user_infos::where('user_id','=',$req->id)->update([
          'password'=>$password,
        ]);
    }
    if ($req->hasFile('profile_image')) {
       $userPic             = time().'.'.$req->profile_image->extension();  
       $req->profile_image->move(public_path('image'), $userPic);
       $picture = $userPic;
        user_infos::where('user_id','=',$req->id)->update([
          'picture'=>$picture,
        ]);
    }
    if ($req->has('first_name')) {
        user_infos::where('user_id','=',$req->id)->update([
          'first_name'=>$req->first_name,
        ]);
    }
    if ($req->has('last_name')) {
        user_infos::where('user_id','=',$req->id)->update([
          'last_name'=>$req->last_name,
        ]);
    }
    if ($req->has('email')) {
        user_infos::where('user_id','=',$req->id)->update([
          'email'=>$req->email,
        ]);
    }
    if ($req->has('phone_number')) {
        user_infos::where('user_id','=',$req->id)->update([
          'phone_number'=>$req->phone_number,
        ]);
    }
    if ($req->has('identification_num')) {
        user_infos::where('user_id','=',$req->id)->update([
          'identification_num'=>$req->identification_num,
        ]);
    }
    if ($req->has('dob')) {
        user_infos::where('user_id','=',$req->id)->update([
          'dob'=>$req->dob,
        ]);
    }
    if ($req->has('nationality')) {
        user_infos::where('user_id','=',$req->id)->update([
          'nationality'=>$req->nationality,
        ]);
    }
    if ($req->has('gender')) {
        user_infos::where('user_id','=',$req->id)->update([
          'gender'=>$req->gender,
        ]);
    }
    if ($req->has('image_link')) {
        user_infos::where('user_id','=',$req->id)->update([
          'picture'=>$req->image_link,
        ]);
    }
    
    return response()->json(['message' =>"Profile Updated Successfully!",'image_url'=>'https://admin.4rizon.com/image/', 'success' => true], 200);
  }
  function update_profile_picture(Request $req){
     $result = json_decode(file_get_contents("php://input"), true);
    $user  = user_infos::where('user_id',$result['id'])->first();
    
    if (!empty($result['profile_image'])){
            $image = $result['profile_image'];
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);
            $pic             = time().'.'.'png';  
            file_put_contents(public_path('image')."/".$pic,$image );
            // $image->move(public_path('image'), $pic);
            $user->picture = $pic;
            
    }else{
        $pic = $user->picture; 
    }
 
     user_infos::where('user_id','=',$result['id'])->update([ 
      'picture'=> $pic
    ]);
    return response()->json(['message' =>"Profile Picture Updated Successfully!",'image_url'=>'https://admin.4rizon.com/image/'.$pic, 'success' => true], 200);
  }
  public function login_admin_user(Request $request){
      
        $validator = \Validator::make($request->all(), [
            'password' => 'required|string|max:191',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
        }
        try{
            $email=$request->email;
            $password=$request->password;
            $user_infos=DB::table('users')->select('name','email','app_remember_token','id','password')->where('email',$request->email)->first();
            if (empty($user_infos)) {
                return ['code'=>'201','status'=>'failed','message'=>'Invalid EMAIL'];
            }
            

            if(Hash::check($request->password,$user_infos->password)){
                
                $user_infos->app_remember_token=str::random(50);
                DB::table('users')->where('id',$user_infos->id)->update(['app_remember_token'=>$user_infos->app_remember_token]);
                $user_infos=DB::table('users')->select('name','email','app_remember_token','id')->where('email',$request->email)->first();
                return ['code'=>'200','Status'=>'success','message'=>'Success','user_info'=>$user_infos];    
            }else{
                return ['code'=>'201','status'=>'failed','message'=>'Invalid Password'];
            }
        }catch(\Exception $e){
            return response()->json(["status"=>"error", "code" => 201, "message"=> $e->getMessage()]);
        }
  }
  public function approve_user(Request $req)
  {
    user_infos::where('user_id','=',$req->id)->update([
      'user_status'=>"1"
    ]);
    $userFind = user_infos::where('user_id',$req->id)->first();
    $message = "Your Account Has Been Approved";
    if (!is_null($userFind->player_id)){
      $this->mobile_push_notification($message,$userFind->player_id);
    }
    return Redirect::to("view_user_details/".$req->id)->with('success','User Status Changed Successfully!');
    # code...
  }
  public function users_player_api(Request $req)
  {
    user_infos::where('user_id','=',$req->user_id)->update([
      'player_id'=>$req->player_id
    ]);
    return response()->json(['message' =>"Player Id Updated Successfully!", 'success' => true], 200);
  }
  public function email_verification(Request $req)
  {
      $emailUser = user_infos::where('email',$req->email)->first();
      if(!is_null($emailUser)){
        if($req->code == $emailUser->unique_id){
          user_infos::where('email','=',$req->email)->update([
              'user_status'=>'1'
            ]);
            return response()->json(['message' =>"User Status Updated Successfully!", 'success' => true], 200);
        }else{
            return response()->json(['message' =>"Code is not correct", 'success' => false], 201);
        }
      }else {
        return response()->json(['message' =>"EMAIL does not exist", 'success' => false], 404);
        
      }
    
    
  }
  public function block_user(Request $req)
  {
    user_infos::where('user_id','=',$req->id)->update([
      'user_status'=>"-1"
    ]);
    $userFind = user_infos::where('user_id',$req->id)->first();
    $message = "Your Account Approval Has Been Blocked";
    $this->mobile_push_notification($message,$userFind->player_id);
    return Redirect::to("view_user_details/".$req->id)->with('success','User Status Changed Successfully!');
    # code...
  }
  public function deny_user(Request $req)
  {
    user_infos::where('user_id','=',$req->id)->update([
      'user_status'=>"2"
    ]);
    $userFind = user_infos::where('user_id',$req->id)->first();
    $message = "Your Account Approval Has Been Denied";
    $this->mobile_push_notification($message,$userFind->player_id);
    return Redirect::to("view_user_details/".$req->id)->with('success','User Status Changed Successfully!');
    # code...
  }
  public function fetch_dha_profile(Request $req)
  {
    $dha_info = Dha_profile::where('user_id','=',$req->id)->get();
    if (sizeof($dha_info) == 0){
        $data_array = array();
        $data_array['Token'] = "9a88abd8-2f4a-4f6f-bbcf-22755254f89b";
        $data_array['Username'] = "Jynx";
        $data_array['Password'] = "Pass12345";
        $data_array['TransactionReference'] = "Your internal reference";
        $user_infos = user_infos::where('user_id','=',$req->id)->first();
        $data_array['idNumber'] = $user_infos->identification_num;
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
        if($make_call == null){
          return Redirect::to("view_user_details/".$req->id)->with('success','User DHA info not found!');
        }
        else{
          $dha_info = new Dha_profile;
        $dha_info->user_id              = $req->id;
        $dha_info->identification_num   = $user_infos->identification_num;
        $dha_info->personName           = $make_call['personName'];
        $dha_info->personSurname        = $make_call['personSurname'];
        $dha_info->gender               = $make_call['gender'];
        $dha_info->dateOfBirth          = $make_call['dateOfBirth'];
        $dha_info->aliveStatus          = $make_call['aliveStatus'];
        $dha_info->dha_api_status       = $make_call['clientFeedback']['clientErrorInfo'];
        $dha_info->save();

        // return redirect()->to('view_user_details/'.$req->id)->with('success','User Status Changed Successfully!');
        return Redirect::to("view_user_details/".$req->id)->with('success','User Status Changed Successfully!');
        }
        
    }
    else{            
        return Redirect::to("view_user_details/".$req->id)->with('success','Already Exists!');
    }
      # code...
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

        if($user_infos->southAfrican_id != null){
          $data_array['idNumber'] = $user_infos->southAfrican_id;
          // dd($user_infos);die();

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
        
        if($make_call == null){
          
          return Redirect::to("edit_djadmin_details/".$req->id)->with('success','User DHA info not found!');
        }
        else{
        
        $dha_info = new Dj_Dha_profile;
        $dha_info->dj_id              = $req->id;
        if($user_infos->southAfrican_id){
          $dha_info->identification_num = $user_infos->southAfrican_id;
          $dha_info->personName           = $make_call['personName'];
        $dha_info->personSurname        = $make_call['personSurname'];
        $dha_info->gender               = $make_call['gender'];
        $dha_info->dateOfBirth          = $make_call['dateOfBirth'];
        $dha_info->aliveStatus          = $make_call['aliveStatus'];
        $dha_info->dha_api_status       = $make_call['clientFeedback']['clientErrorInfo'];
        $dha_info->save();
       
        // return redirect()->to('view_user_details/'.$req->id)->with('success','User Status Changed Successfully!');
        return Redirect::to("edit_djadmin_details/".$req->id)->with('success','User Status Changed Successfully!');
        }
        else{
          $dha_info->identification_num = $user_infos->passport_id;
          $dha_info->personName           = $make_call['personName'];
        $dha_info->personSurname        = $make_call['personSurname'];
        $dha_info->gender               = $make_call['gender'];
        $dha_info->dateOfBirth          = $make_call['dateOfBirth'];
        $dha_info->aliveStatus          = $make_call['aliveStatus'];
        $dha_info->dha_api_status       = $make_call['clientFeedback']['clientErrorInfo'];
        $dha_info->save();
       
        // return redirect()->to('view_user_details/'.$req->id)->with('success','User Status Changed Successfully!');
        return Redirect::to("edit_djadmin_details/".$req->id)->with('success','User Status Changed Successfully!');
        }
        
      }
    }
    else{            
        return Redirect::to("edit_djadmin_details/".$req->id)->with('success','Already Exists!');
    }
      # code...
  }
  public function chargeApi($data){
    // Anonymous test key. Replace with your key.
    $secret_key = 'sk_test_960bfde0VBrLlpK098e4ffeb53e1';

    // Initialise the curl handle
    $ch = curl_init();

    // Setup curl
    curl_setopt($ch, CURLOPT_URL,"https://online.yoco.com/v1/charges/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);

    // Basic Authentication method
    // Specify the secret key using the CURLOPT_USERPWD option
    curl_setopt($ch, CURLOPT_USERPWD, $secret_key . ":");

    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    // send to yoco
    $result = curl_exec($ch);
    Log::debug(curl_getinfo($ch, CURLINFO_HTTP_CODE));

    // close the connection
    curl_close($ch);

    // convert response to a usable object
    $response = json_decode($result);
    return response()->json(['result' =>$response]);
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
		
		return $result;
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
