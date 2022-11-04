<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Coupons;
use App\Models\CouponUsage;
use App\Models\PasswordReset;
use App\Models\Permissions;
use Illuminate\Support\Facades\Hash;
use App\Models\user_infos;
use App\Models\TestUser;
use Illuminate\Support\Str;
use DB;
 
class CouponController extends Controller
{
    function create_coupon(Request $req){
        $result = json_decode(file_get_contents("php://input"), true);
        
            $coupon = new Coupons;
            $coupon->user_id = $result['user_id'];
            $coupon->coupon  = str::random(5);
            if(!empty($result['limit'])){
              $coupon->coupon_limit = $result['limit'];
            }
            else{
              $coupon->coupon_limit = 5;
            }
            $coupon->save();
            $last_coupon = DB::table('coupons')->latest()->first();

            return response()->json(["Coupon" => $last_coupon,'code'=>'200'], 200);
        
      }
      function validate_coupon(Request $req){
        $result = json_decode(file_get_contents("php://input"), true);
        $coupon  = Coupons::where('coupon','=',$result['coupon'])->get();
        if (sizeof($coupon) > 0){
            return response()->json(["message" => "Verified","Coupon Details" => $coupon], 200);
          }
          else{
            return response()->json(["message" => "Coupon Not Found!"], 201);   
          }
      }
      function coupon_usage(Request $req){
        $result = json_decode(file_get_contents("php://input"), true);
        $coupon  = Coupons::where('coupon_id','=',$result['coupon_id'])->first();
        $coupon_limit = $coupon->coupon_limit;
        $coupon_used = CouponUsage::where('coupon_id','=',$result['coupon_id'])->get();
        $count = count($coupon_used);
       
        if($count > $coupon_limit){
          return response()->json(["message" => 'coupon limit has reached','code'=>'201'], 201);
        }
        else{
          $coupon_add = new CouponUsage;
          $coupon_add->user_id = $result['user_id'];
          $coupon_add->coupon_id  = $result['coupon_id'];
          $coupon_add->coupon_usage = 1;
          $coupon_add->coupon_limit = $result['coupon_limit'];
         
          $coupon_add->save();
          return response()->json(["message" => 'coupon has been added','code'=>'200'], 200);
        }
      }
}