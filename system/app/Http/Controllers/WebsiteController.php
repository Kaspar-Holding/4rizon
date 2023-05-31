<?php

namespace App\Http\Controllers;
use App\Http\Redirect;
use Carbon\Carbon;
use App\UserEmails;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\GalleryImage;
use App\Models\User;
use App\Models\user_infos;
use App\Models\AccessCtrl;
use App\Models\Bookings;
use App\Models\VipPkg;
use App\Models\VipBookings;
use App\Models\Web_Users;
use Illuminate\Support\Facades\Hash;
use DB;
 
class WebsiteController extends Controller
{
    function get_data(){
        return view("home");
    }
    function get_data_homepage(){
        $gallery1 = GalleryImage::orderBy('id' , 'desc')->take(1)->get();
        $gallery2 = GalleryImage::orderBy('id' , 'desc')->take(2)->get();
        $gallery3 = GalleryImage::orderBy('id' , 'desc')->take(3)->get();
        $gallery4 = GalleryImage::orderBy('id' , 'desc')->take(4)->get();
        $gallery5 = GalleryImage::orderBy('id' , 'desc')->take(5)->get();

        $event_data = Event::take(2)->orderBy('id','DESC')->get();
        return view("homepage",['event_list'=>$event_data, 'gallery1'=>$gallery1, 'gallery2'=>$gallery2, 'gallery3'=>$gallery3, 'gallery4'=>$gallery4, 'gallery5'=>$gallery5]);
    }
    function get_about_us(){
        return view("about-us");
    }
    function register(){
        return view("register");
    }
    function web_registration(Request $req){
        $type = "application/json";
        $user_infos_email = user_infos::where('email','=',$req->email)->first();
        $user_infos_phone = user_infos::where('phone_number','=',$req->phone_no)->first();
        if( preg_match( "/^\+27[0-9]{9}$/", $req->phone_no ) ){
            // echo "Valid number";
          
     
        if (!empty($user_infos_email)){
            // return response()->json(["message" => "Email already exists!",'code'=>'201'], 201);}
            return back()->with('error', 'Email already exists!');}
            // return Redirect::to('/')->with('message', 'Email already exists');        }
        elseif(!empty($user_infos_phone)){
            // return Redirect::to('/')->with('message', 'Email already exists');
            return back()->with('error', 'Phone No already exists!');}
        
        else{
          
          $validator = \Validator::make($req->all(), [
            'first_name'   => 'required|string|max:191',
            'last_name'    => 'required|string|max:191',
            'phone_no' => 'required',
            'email'        => 'required',
            'password'     => 'required',
            'c_password'   => 'required'
          ]);
          if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr);
          }
          if ($req->password == $req->c_password) {
            $req->password  = Hash::make($req->password);
            $web_users = new user_infos;
            $web_users->first_name = $req->first_name;
            $web_users->last_name = $req->last_name;
            $web_users->email = $req->email;
            $web_users->password = $req->password;
            $web_users->phone_number = $req->phone_no;
            $web_users->save();
            $unique_id =  random_int(100,100000); 
            user_infos::where('email','=',$req->email)->update(['unique_id'=>$unique_id]);       
            $queryStatus;
            try {
              $query = UserEmails::signUpEmail($req->email, $unique_id);
                $queryStatus = "Successful";
            } catch(Exception $e) {
                $queryStatus = "Not success";
            }
            return view("otpSuccess",["email" => $req->email,]);

            // return back()->with('error', 'The error message here!');
            // return response()->json(["message" => "Registration Successfull" ,'code'=>'200'], 200);
          }
          else{
            return back()->with('error', 'Confirmation password does not match!');
          }
        }
        }else{
            return back()->with('error', 'Phone number is not correct!');
        } 
        
    }
    function web_form(Request $req){
        $type = "application/json";
        $result = json_decode(file_get_contents("php://input"), true);
        $user_infos_email = user_infos::where('email','=',$result['email'])->first();
        $user_infos_phone = user_infos::where('phone_number','=',$result['phone_no'])->first();
        
            // echo "Valid number";
          
     
        if (!empty($user_infos_email)){
            // return response()->json(["message" => "Email already exists!",'code'=>'201'], 201);}
            return response()->json(['error'=> 'Email already exists!'],400);
        }
            // return Redirect::to('/')->with('message', 'Email already exists');        }
        elseif(!empty($user_infos_phone)){
            // return Redirect::to('/')->with('message', 'Email already exists');
            return response()->json(['error'=> 'Phone No already exists!'],400);
        }
        
        else{
          
        //   $validator = \Validator::make($result, [
        //     'first_name'   => 'required|string|max:191',
        //     'last_name'    => 'required|string|max:191',
        //     'phone_no' => 'required',
        //     'email'        => 'required',
        //     'password'     => 'required',
        //     'c_password'   => 'required'
        //   ]);
        //   if ($validator->fails()) {
        //     $responseArr['message'] = $validator->errors();
        //     return response()->json($responseArr, 400);
        //   }
            if ($result['password'] == $result['c_password']) {
                $result['password']  = Hash::make($result['password']);
                $web_users = new Web_Users;
                $web_users->first_name = $result['first_name'];
                $web_users->last_name = $result['last_name'];
                $web_users->email = $result['email'];
                $web_users->password = $result['password'];
                $web_users->phone_no = $result['phone_no'];
                $web_users->save();
                $unique_id =  random_int(100,100000); 
                Web_Users::where('email','=',$result['email'])->update(['unique_id'=>$unique_id]);       
                $queryStatus;
                try {
                    $query = UserEmails::signUpEmail($result['email'], $unique_id);
                    $queryStatus = "Successfully registered, OTP was sent your email.";
                    return response()->json(['message'=> $queryStatus],201);
                } catch(Exception $e) {
                    $queryStatus = "Not success";
                    return response()->json(['message'=> $queryStatus],400);
                }
            
            // return back()->with('error', 'The error message here!');
            // return response()->json(["message" => "Registration Successfull" ,'code'=>'200'], 200);
          }
          else{
            return response()->json(['error'=> 'Confirmation password does not match'],400);
          }
        }
        
        
    }
    function resend_otp(Request $req){
        $type = "application/json";
        $user_infos_email = user_infos::where('email','=',$req->email)->first();
       
            $unique_id =  random_int(100,100000); 
            user_infos::where('email','=',$req->email)->update(['unique_id'=>$unique_id]);       
            $queryStatus;
            try {
              $query = UserEmails::signUpEmail($req->email, $unique_id);
                $queryStatus = "Successful";
            } catch(Exception $e) {
                $queryStatus = "Not success";
            }
            return view("otpSuccess",["email" => $req->email,]);

            // return back()->with('error', 'The error message here!');
            // return response()->json(["message" => "Registration Successfull" ,'code'=>'200'], 200);
        }
      
    
    public function web_email_verify(Request $req){
        $type = "application/json";
        $result = json_decode(file_get_contents("php://input"), true);
        $user_infos = user_infos::where('unique_id','=',$req->otp)->first();
        if (!empty($user_infos)){
            $user = user_infos::where('email','=',$user_infos->email);
            $user->update(['web_status'=>1]);
            UserEmails::welcomeEmail($user->first()->email);
            return view("register_success");
        }else{
            return back()->with('error', 'Otp is invalid!');}
        
    }
    public function web_otp(Request $req){
        $type = "application/json";
        $result = json_decode(file_get_contents("php://input"), true);
        // return response()->json(['message'=> $result['otp'] ],200);
        $user = Web_Users::where('unique_id','=',$result['otp'])->first();
        if (!empty($user)){
            // return response()->json(['message'=> $user],200);
            $web_users = new user_infos;
            $web_users->first_name = $user->first_name;
            $web_users->last_name = $user->last_name;
            $web_users->email = $user->email;
            $web_users->password = $user->password;
            $web_users->phone_number = $user->phone_no;
            $web_users->save();
            $delete = Web_Users::where('unique_id','=',$result['otp'])->delete();
            return response()->json(['message'=> 'Successfully registered!'],200);
            // return view("register_success");
        }else{
            return response()->json(['error'=> 'Otp is invalid!'],400);
        }
        
    }
    function get_book_event(){
        return view("book-event");
    }
    function get_contact_us(){
        return view("contact-us");
    }
    function event_page(){
        //     $event_data1 = Event::select("*")->whereBetween('event_date', 
        //     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
        // )->orderBy('event_date','DESC')->get();
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(7);
        $event_data = Event::whereBetween('event_date', [$startDate, $endDate])->get();
        // $event_data = Event::where('event_date','>=', $startDate)->get();
    
        // return  response()->json(['events'=>$event_data]);
            return view("event-page",['event_list'=>$event_data,]);
        }
    function get_event_page(){
    //     $event_data1 = Event::select("*")->whereBetween('event_date', 
    //     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
    // )->orderBy('event_date','DESC')->get();
    $startDate = Carbon::today();
    $endDate = Carbon::today()->addDays(7);
    $event_data = Event::whereBetween('event_date', [$startDate, $endDate])->get();
    // $event_data = Event::where('event_date','>=', $startDate)->get();

    return  response()->json(['events'=>$event_data]);
        // return view("event-page",['event_list'=>$event_data,]);
    }
   
    function get_gallery1(){
        $gallery = GalleryImage::get();
              
        return  response()->json(['events'=>$gallery]);
        // return view("gallery1",['gallery'=>$gallery]);
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
    function payment_gateway(){
        $type = "application/json";
        $bookings = Bookings::where('booking_id','=','EcEOFV0iwqTf0VUFHURUzI66KCWY8A')->first();
        $booking_id = "EcEOFV0iwqTf0VUFHURUzI66KCWY8A";
        $event_id = $bookings->event_id;
        $event = Event::where('id','=',$event_id)->first();
        $event_name = $event->event_name;
        $vip = VipPkg::where('id','=',$bookings->vip_booth_id)->first();
        $price = $vip->pkg_price * 100;
        // return response()->json(["booking"=>$bookings,"price" => $vip->pkg_price,'code'=>'200'], 200);
        return view("payment_gateway",["price" => $price,"booking"=>$bookings,"event"=>$event_name]);
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
