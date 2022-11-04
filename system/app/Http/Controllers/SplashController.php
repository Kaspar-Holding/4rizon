<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Splash;
use Illuminate\Support\Str;
use DB;
 
class SplashController extends Controller
{
    function splash_list(){
    	$splash_data = Splash::all();
    	return view("splash.list",['splash_list'=>$splash_data,]);
    }
    function edit_splash($id){
    	$splash = Splash::find($id);
    	return view("splash.edit",['splash'=>$splash,]);
    }
    function add_new_splash(){
    	return view("splash.add");
    }
    function create_splash(Request $req){
        $splash = new Splash;
        $splash->splash_name                = $req->splash_name;
        if ($req->hasFile('splash_image')) {
            $splashPic             = time().'.'.$req->splash_image->extension();  
            $req->splash_image->move(public_path('image'), $splashPic);
            $splash->splash_image = $splashPic;
        }
        $splash->splash_short_description   = $req->splash_short_description;
        $splash->splash_description         = $req->splash_description   ;
        $splash->save();
        return redirect('/splash_list')->with('success','Splash Created Successfully!');
    }
    function update_gallery(Request $req){
        $splash                               = Splash::find($req->id);
        $splash->splash_name                  = $req->splash_name;
        if ($req->hasFile('splash_image')) {
            $splashPic             = time().'.'.$req->splash_image->extension();  
            $req->splash_image->move(public_path('image'), $splashPic);
            $splash->splash_image = $splashPic;
        }
        $splash->splash_short_description    = $req->splash_short_description;
        $splash->splash_description          = $req->splash_description   ;        
        $splash->save();
        return redirect('/splash_list')->with('success','Splash Details Updated Successfully!');
    }
    function update_splash(Request $req){
        $splash                               = Splash::find($req->id);
        $splash->splash_name                  = $req->splash_name;
        if ($req->hasFile('splash_image')) {
            $splashPic             = time().'.'.$req->splash_image->extension();  
            $req->splash_image->move(public_path('image'), $splashPic);
            $splash->splash_image = $splashPic;
        }
        $splash->splash_short_description    = $req->splash_short_description;
        $splash->splash_description          = $req->splash_description   ;        
        $splash->save();
        return redirect('/splash_list')->with('success','Splash Details Updated Successfully!');
    }
    public function delete_splash ($id) {
        if(Splash::where('id', $id)->exists()) {
            $splash= Splash::where('id', $id)->delete();
            return redirect('/splash_list')->with('success','Splash Details Deleted Successfully!');
        }else{
            return redirect('/splash_list')->with('error','Splash Not Found');
        }
    }

    // api's
    function splash_list_api(){
        $splash_data = Splash::all();
        return response()->json(['splash_list' =>$splash_data,'image_url'=>'https://www.4rizon.com/image/', 'success' => true], 200);
    }
    function single_splash_api($id){
        $splash = Splash::find($id);
        return response()->json(['splash' =>$splash,'image_url'=>'https://www.4rizon.com/image/', 'success' => true], 200);
    }
}
