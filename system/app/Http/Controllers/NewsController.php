<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\News;
use Illuminate\Support\Str;
use DB;
 
class NewsController extends Controller
{
    function news_list(){
    	$news_data = News::all();
    	return view("news.list",['news_list'=>$news_data,]);
    }
    function edit_news($id){
    	$news = News::find($id);
    	return view("news.edit",['news'=>$news,]);
    }
    function add_news(){
    	return view("news.add");
    }
    function create_news(Request $req){
        $news = new News;
        $news->news_title         = $req->news_title;
        $news->news_short_description        = $req->news_short_description;
        $news->news_description          = $req->news_description   ;
        if ($req->hasFile('news_image')) {
            $newsPic             = time().'.'.$req->news_image->extension();  
            $req->news_image->move(public_path('image'), $newsPic);
            $news->news_image = $newsPic;
        }
        $news->news_date  = $req->news_date;
        $news->save();
        return redirect('/news_list')->with('success','News Created Successfully!');
    }
    function update_news(Request $req){
        $news                            = News::find($req->id);
        $news->news_title         = $req->news_title;
        $news->news_short_description        = $req->news_short_description;
        $news->news_description          = $req->news_description   ;
        if ($req->hasFile('news_image')) {
            $newsPic             = time().'.'.$req->news_image->extension();  
            $req->news_image->move(public_path('image'), $newsPic);
            $news->news_image = $newsPic;
        }
        $news->news_date  = $req->news_date;
        $news->save();
        return redirect('/news_list')->with('success','News Details Updated Successfully!');
    }
    public function delete_news($id) {
        if(News::where('id', $id)->exists()) {
            $news= News::where('id', $id)->delete();
            return redirect('/news_list')->with('success','News Details Deleted Successfully!');
        }else{
            return redirect('/news_list')->with('error','News Not Found');
        }
    }

    // api's
    function news_list_api(){
        $news_data = News::all();
        return response()->json(['news_list' =>$news_data,'image_url'=>'https://admin.4rizon.com/image/', 'success' => true], 200);
    }
    function single_news_api($id){
        $news = News::find($id);
         return response()->json(['news' =>$news,'image_url'=>'https://admin.4rizon.com/image/', 'success' => true], 200);
    }
}
