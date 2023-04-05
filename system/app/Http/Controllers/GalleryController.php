<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\Event;
use App\Models\Bookings;
use App\Models\user_infos;
use Illuminate\Support\Str;
use DB;
 
class GalleryController extends Controller
{
    
    function gallery_list(){
    	$gallery_data = Gallery::all();
    	return view("gallery.list",['gallery_list'=>$gallery_data,]);
    }
    function edit_gallery($id){
    	$gallery = Gallery::find($id);
        $gallery_id = $gallery->unique_id;
        $gallery_images = GalleryImage::where("gallery_id",$gallery_id)->get();
    	$event_data = Event::all();
    	return view("gallery.edit",['gallery'=>$gallery,'events'=>$event_data,'gallery_images'=>$gallery_images]);
    }
    function add_new_gallery(){
        $event_data = Event::all();
    	return view("gallery.add",['events'=>$event_data,]);
    }
    function create_gallery(Request $req){
        $findUsersAttendedEvent = Bookings::where("event_id",$req->event_id)->whereNotNull("enter_at")->get();
        foreach($findUsersAttendedEvent as $attendUsers){
            $getUser = user_infos::where("user_id",$attendUsers->user_id)->first();
            $messages = "Gallery Uploaded Of Event Which You attended.";
            $this->mobile_push_notification($messages,$getUser->player_id);
        }
        $unique_id = str::random(15);
        $gallery = new Gallery;
        $gallery->event_id          = $req->event_id;
        $gallery->gallery_name      = $req->gallery_name;
        if ($req->hasFile('gallery_image')) {
            $galleryPic             = time().'.'.$req->gallery_image->extension();  
            $req->gallery_image->move(public_path('image'), $galleryPic);
            $gallery->gallery_image = $galleryPic;
        }
        $gallery->gallery_date      = $req->gallery_date;
        $gallery->unique_id         = $unique_id;
        $gallery->save();
        if($req->hasFile('gallery_images'))
        {
            $names = [];
            $nums = 0;
            foreach($req->file('gallery_images') as $image)
            {
                $gallery             = new GalleryImage;
                $gallery->gallery_id = $unique_id;
                $filename    = time().$nums.'.'.$image->extension();  
                $image->move(public_path('image'), $filename);
                $gallery->image = $filename;
                $gallery->save();
                $nums++;
            }
        }
        return redirect('/gallery_list')->with('success','gallery Created Successfully!');
    }
    function update_gallery(Request $req){
        $gallery                               = Gallery::find($req->id);
        $gallery->event_id                     =$req->id;
        $gallery->gallery_name                 = $req->gallery_name;
        $nums = 0;
        if ($req->hasFile('gallery_image')) {
            $galleryPic             = time().$nums.'.'.$req->gallery_image->extension();  
            $req->gallery_image->move(public_path('image'), $galleryPic);
            $gallery->gallery_image = $galleryPic;
        }
        $gallery->gallery_date  = $req->gallery_date;
        $gallery->save(); 
        if($req->hasFile('gallery_images'))
        {
            $nums = 0;
            $names = [];
            foreach($req->file('gallery_images') as $image)
            {
                $gallery                 = new GalleryImage;
                $gallery->gallery_id     = $req->unique_id;
                $filename    = time().'.'.$image->extension();  
                $image->move(public_path('image'), $filename);
                $gallery->image = $filename;
                $gallery->save();
                $nums++;
            }
        }
        return redirect('/gallery_list')->with('success','gallery Details Updated Successfully!');
    }
    public function delete_gallery ($id) {
        if(Gallery::where('id', $id)->exists()) {
            $gallery= Gallery::where('id', $id)->delete();
            return redirect('/gallery_list')->with('success','gallery Details Deleted Successfully!');
        }else{
            return redirect('/gallery_list')->with('error','gallery Not Found');
        }
    }

    // api's
    function gallery_list_api($id){
        $gallery_data = Gallery::all();
        $gallery_final_data = array();
        foreach ($gallery_data as $k => $v) {
    		$gallery_final_data[$k]['gallery_data'] = $v;
    		$value1 = GalleryImage::where("gallery_id",$v['unique_id'])->get();
    		$gallery_final_data[$k]['galler_images'] = $value1;
    		$value = Bookings::where("event_id",$v['event_id'])->where('user_id',$id)->whereNotNull('entered_by')->first();
    		if(!empty($value)){
    		    $gallery_final_data[$k]['bookings'] = "1";
    		}else{
    		    $gallery_final_data[$k]['bookings'] = "0";
    		}
    	}
        
        return response()->json(['gallery_list' =>$gallery_final_data,'image_url'=>'https://admin.4rizon.com/image/', 'success' => true], 200);
    }
    function single_gallery_api($id){
        $gallery = Gallery::find($id);
        $value1 = GalleryImage::where("gallery_id",$gallery->unique_id)->get();
        return response()->json(['gallery' =>$gallery,'gallery_images'=>$value1,'image_url'=>'https://admin.4rizon.com/image/', 'success' => true], 200);
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
