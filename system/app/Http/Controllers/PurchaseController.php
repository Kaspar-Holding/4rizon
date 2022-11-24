<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Purchase;
use App\Models\Notifications;
use App\Models\ItemCategory;
use App\Models\user_infos;
use App\Models\Item;
use Illuminate\Support\Str;
use DB;
 
class PurchaseController extends Controller
{
    // api's
    function purchase_item_api(Request $req){
        $purchase_id = str::random(30);
        $items    = Item::find($req->item_id);
        $category = ItemCategory::find($items->category_id);
        $purchase = new Purchase;
        $purchase->user_id            = $req->user_id;
        $purchase->purchase_id        = $purchase_id;
        $purchase->item_id            = $req->item_id;
        $purchase->quantity           = $req->quantity;
        $purchase->item_type          = $category->category_name;
        if($category->category_name == "Vouchers"){
        $purchase->usage_count        = $items->entries;
        }
        $purchase->item_price         = $items->item_price*$req->quantity;
        $purchase->save();
        $notification = new Notifications;
        $notification->user_id            = $req->user_id;
        $notification->notification_type  = "2";
        $notification->item_id            = $req->item_id;
        $notification->item_name          = $items->item_name;
        $notification->item_description   = $items->item_short_description;
        $notification->item_qr_code       = $purchase_id;
        $notification->save();
        $message = "Purchase Record Created Successfully";
        $userFind = user_infos::where('user_id',$req->user_id)->first();
        $messages = "Item Purchased Successfully.";
        $this->mobile_push_notification($messages,$userFind->player_id);
        return response()->json(['message' =>$message,'qr_code' =>$purchase_id,'image_url'=>'https://4rizon.com/image/', 'success' => true], 200);
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
