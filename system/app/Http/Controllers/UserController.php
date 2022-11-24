<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\PasswordReset;
use App\Models\Permissions;
use Illuminate\Support\Facades\Hash;
use App\Models\user_infos;
use App\Models\TestUser;
use Illuminate\Support\Str;
use App\Models\user_wallets;
use App\Models\Purchase;
use App\UserEmails;
use App\Models\DjUser;
use App\Models\Dj_Dha_Address;
use App\Models\Dj_Dha_profile;
use App\Models\EventAttend;
use App\Models\Dha_profile;
use App\Models\Dha_Address;
use DB;
 
class UserController extends Controller
{
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
                    if($user_infos->user_status == '0'){
                        return ['code'=>'201','status'=>'failed','message'=>'Your Account Is In Pending State Wait For The Account Approval'];
                    }elseif($user_infos->user_status == '1'){
                        $user_infos->remember_token=str::random(50);
                        DB::table('user_infos')->where('user_id',$user_infos->user_id)->update(['remember_token'=>$user_infos->remember_token]);
                        // $sendT = UserEmails::signUpEmail($request->email, $user_infos->user_id);
                        return ['code'=>'200','Status'=>'success','image_url'=>'https://4rizon.com/image/','user_info'=>$user_infos]; 
                    }elseif($user_infos->user_status == '2'){
                        return ['code'=>'201','status'=>'failed','message'=>'Your Account Is Invalid Due To Email Verification.'];
                    }elseif($user_infos->user_status == '-1'){
                        return ['code'=>'201','status'=>'failed','message'=>'Your Account Is Blocked By Admin.'];
                    }
                       
                }else{
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
                user_infos::where('user_id','=',$user->id)->update([
                  'password'=>Hash::make($req->password),
                ]);
            }
       }
          return response()->json(["message" => "Password Updated Successfully"], 200);
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
    public function dj_forget_password_api(Request $req){
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

  function add_new_user(){
    return view("users.add_user");
  }
  function register_new_user(){
    return view("users.register_user");
  }
  function reset_password(){
    return view("reset_password");
  }
  function dj_reset_password(){
    return view("dj_reset_password");
  }
  function update_password(Request $request){
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
    
    return view("reset_password");
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
      $user_infos->user_status      = "1";
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
  function create(Request $req){
    $users_data        = User::where('email','=',$req->user_email)->get();
    if (sizeof($users_data) > 0){
        return redirect('/admin_list')->with('error','Email already exists!');
    }else{
        $users = new User;
        $users->name       = $req->name;
        $users->email      = $req->user_email;
        $users->password   = Hash::make($req->user_password);
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
    $users_data = user_infos::where('user_status',0)->get();
    return view("users.inactivelist",['users_list'=>$users_data,]);
  }
  public function denied_users(){
    $users_data = user_infos::where('user_status','2')->get();
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
    $users_data = user_infos::where('user_status',2)->get();
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
  function user_delete(){
    $type = "application/json";
    $result = json_decode(file_get_contents("php://input"), true);
    $dj = user_infos::where('user_id', '=',$result['id'])->delete();
    return response()->json(["message" => "User Deleted"],200);
  }
  function view_user_details(Request $req){
    $id = $req->id;
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
    
    return response()->json(['message' =>"Profile Updated Successfully!",'image_url'=>'https://4rizon.com/image/', 'success' => true], 200);
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
    return response()->json(['message' =>"Profile Picture Updated Successfully!",'image_url'=>'https://4rizon.com/image/'.$pic, 'success' => true], 200);
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
    $message = "Your Account Approval Has Been Approved";
    $this->mobile_push_notification($message,$userFind->player_id);
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
        return Redirect::to("edit_djadmin_details/".$req->id)->with('success','User Status Changed Successfully!');
    }
    else{            
        return Redirect::to("edit_djadmin_details/".$req->id)->with('success','Already Exists!');
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
