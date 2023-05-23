<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ItemCategory;
use App\Models\ItemAttributes;
use App\Models\ItemAttributesValues;
use App\Models\Item;
use Illuminate\Support\Str;
use DB; 
 
class ItemController extends Controller
{
    function item_list(){
    	$item_data = Item::all();
    	return view("item.list",['item_list'=>$item_data,]);
    }
    function edit_item($id){
    	$item = Item::find($id);
        $item_category = ItemCategory::all();
        $attribute_data = ItemAttributes::all();
        $attributes_final_data = array();
        foreach ($attribute_data as $k => $v) {
    		$attributes_final_data[$k]['attribute_data'] = $v;

    		$value = ItemAttributesValues::where("attribute_parent_id",$v['id'])->get();

    		$attributes_final_data[$k]['attribute_value'] = $value;
    	}
    	return view("item.edit",['item'=>$item,'item_category'=>$item_category,'attributes'=>$attributes_final_data]);
    }
    public function item_delete(Request $req)
    {
        // Need to find all addresses with the contacdt Id and delete them.
        
        $user_id = $req->id;
       
        Item::where('id',$user_id)->delete();
        return redirect('/item_list')->with('success','Item deleted successfully');   
    }
    function add_item(){
        $attribute_data = ItemAttributes::all();
        $attributes_final_data = array();
        foreach ($attribute_data as $k => $v) {
    		$attributes_final_data[$k]['attribute_data'] = $v;

    		$value = ItemAttributesValues::where("attribute_parent_id",$v['id'])->get();

    		$attributes_final_data[$k]['attribute_value'] = $value;
    	}
        $item_data = ItemCategory::all();
    	return view("item.add",['item_category'=>$item_data,'attributes'=>$attributes_final_data]);
    }
    function create_item(Request $req){
        $item = new Item;
        $item->category_id              = $req->category_id;
        $item->item_name                = $req->item_name;
        $item->item_short_description   = $req->item_short_description;
        $item->item_description         = $req->item_description;
        if ($req->hasFile('item_image')) {
            $itemPic             = time().'.'.$req->item_image->extension();  
            $req->item_image->move(public_path('image'), $itemPic);
            $item->item_image = $itemPic;
        }
        $item->item_price               = $req->item_price;
        $item->attribute_value_id       = json_encode($req->attributes_value_id);
        if ($req->has('entries')) {
            $item->entries               = $req->entries;
        }
        $item->save();
        return redirect('/item_list')->with('success','Item Created Successfully!');
    }
    function update_item(Request $req){
        $item                           = Item::find($req->id);
        $item->category_id              = $req->category_id;
        $item->item_name                = $req->item_name;
        $item->item_short_description   = $req->item_short_description;
        $item->item_description         = $req->item_description;
        if ($req->hasFile('item_image')) {
            $itemPic             = time().'.'.$req->item_image->extension();  
            $req->item_image->move(public_path('image'), $itemPic);
            $item->item_image = $itemPic;
        }
        $item->item_price               = $req->item_price;
        $item->attribute_value_id       = json_encode($req->attributes_value_id);
        if ($req->has('entries')) {
            $item->entries               = $req->entries;
        }
        $item->save();
        return redirect('/item_list')->with('success','Item Details Updated Successfully!');
    }
    public function delete_item($id) {
        if(Item::where('id', $id)->exists()) {
            $itemy= Item::where('id', $id)->delete();
            return redirect('/item_list')->with('success','Item Details Deleted Successfully!');
        }else{
            return redirect('/item_list')->with('error','Item Not Found');
        }
    }
    
    // api's
    function item_list_api(){
        $category_data = ItemCategory::all();
        $items_data = Item::all();
        return response()->json(['item_list' =>$items_data,'item_category_list' =>$category_data,'image_url'=>'https://admin.4rizon.com/image/', 'success' => true], 200);
    }
    function single_item_api($id){
        $item_data = Item::find($id);
        return response()->json(['item' =>$item_data,'image_url'=>'https://admin.4rizon.com/image/', 'success' => true], 200);
    }
    function get_attributes_and_values_api(){
        $attribute_data = ItemAttributes::all();
        $attributes_final_data = array();
        foreach ($attribute_data as $k => $v) {
    		$attributes_final_data[$k]['attribute_data'] = $v;

    		$value = ItemAttributesValues::where("attribute_parent_id",$v['id'])->get();

    		$attributes_final_data[$k]['attribute_value'] = $value;
    	}
        return response()->json(['list' =>$attributes_final_data, 'success' => true], 200);
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
