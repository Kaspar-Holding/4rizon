<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WeeklyLineup;
use DB;
 
class WeeklyLineupController extends Controller
{
    function weekly_lineup_list(){
    	$weekly_lineup_data = WeeklyLineup::all();
    	return view("weekly_lineup.list",['weekly_lineup_list'=>$weekly_lineup_data,]);
    }
    function edit_weekly_lineup($id){
    	$weekly_lineup = WeeklyLineup::find($id);
    	return view("weekly_lineup.edit",['weekly_lineup'=>$weekly_lineup,]);
    }
    function add_new_weekly_lineup(){
    	return view("weekly_lineup.add");
    }
    public function lineup_delete(Request $req)
    {
        
        
        $user_id = $req->id;
       
        WeeklyLineup::where('id',$user_id)->delete();
        return redirect('/weekly_lineup_list')->with('success','Weekly Lineup deleted successfully');   
    }
    function create_weekly_lineup(Request $req){
        $weekly_lineup = new WeeklyLineup;
        $weekly_lineup->name         = $req->name;
        $weekly_lineup->short_description        = $req->short_description;
        $weekly_lineup->description          = $req->description   ;
        if ($req->hasFile('weekly_lineup_image')) {
            $weekly_lineupPic             = time().'.'.$req->weekly_lineup_image->extension();  
            $req->weekly_lineup_image->move(public_path('image'), $weekly_lineupPic);
            $weekly_lineup->image = $weekly_lineupPic;
        }
        $weekly_lineup->date  = $req->date;
        $weekly_lineup->save();
        return redirect('/weekly_lineup_list')->with('success','Weekly Lineup Created Successfully!');
    }
    function update_weekly_lineup(Request $req){
        $weekly_lineup                             = WeeklyLineup::find($req->id);
        $weekly_lineup->name                 = $req->name;
        $weekly_lineup->short_description    = $req->short_description;
        $weekly_lineup->description          = $req->description   ;
        if ($req->hasFile('weekly_lineup_image')) {
            $weekly_lineupPic             = time().'.'.$req->weekly_lineup_image->extension();  
            $req->weekly_lineup_image->move(public_path('image'), $weekly_lineupPic);
            $weekly_lineup->image = $weekly_lineupPic;
        }
        $weekly_lineup->date  = $req->date;
        $weekly_lineup->save();
        return redirect('/weekly_lineup_list')->with('success','Weekly Lineup Details Updated Successfully!');
    }
    public function delete_weekly_lineup ($id) {
        if(WeeklyLineup::where('id', $id)->exists()) {
            $weekly_lineup= WeeklyLineup::where('id', $id)->delete();
            return redirect('/weekly_lineup_list')->with('success','Weekly Lineup Details Deleted Successfully!');
        }else{
            return redirect('/weekly_lineup_list')->with('error','Weekly Lineup Not Found');
        }
    }
}
