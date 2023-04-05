<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Survey;
use App\Models\Questions;
use App\Models\Answers;
use App\Models\Survey_Status;
use App\Models\user_wallets;
use DB;
 
class SurveyController extends Controller
{
    function survey_list(){
    	$survey_data = Survey::all();
    	return view("survey.list",['survey_list'=>$survey_data,]);
    }
    function survey_users_answers_list(){
    	$survey_data = Survey_Status::all();
    	return view("survey.answerslist",['survey_list'=>$survey_data,]);
    }
    function edit_survey($id){
    	$survey = Survey::find($id);
    	return view("survey.edit",['survey'=>$survey,]);
    }
    function add_new_survey(){
    	return view("survey.add");
    }
    function create_survey(Request $req){
        $survey = new Survey;
        $survey->survey_name         = $req->survey_name;
        $survey->survey_price        = $req->survey_price;
        if ($req->hasFile('survey_image')) {
            $surveyPic             = time().'.'.$req->survey_image->extension();
            $req->survey_image->move('image', $surveyPic);
            $survey->survey_image = $surveyPic;
        }
        $survey->survey_description  = $req->survey_description;
        $survey->save();
        return redirect('/survey_list')->with('success','Survey Created Successfully!');
    }
    function survey_update(Request $req){
        $survey               		 = Survey::find($req->id);
        $survey->survey_name         = $req->survey_name;
        $survey->survey_price        = $req->survey_price;
        if ($req->hasFile('survey_image')) {
            $surveyPic             = time().'.'.$req->survey_image->extension();
            $req->survey_image->move('image', $surveyPic);
            $survey->survey_image = $surveyPic;
        }
        $survey->survey_description  = $req->survey_description;
        $survey->save();
        return redirect('/survey_list')->with('success','Survey Details Updated Successfully!');
    }
    public function delete_survey ($id) {
        if(Survey::where('id', $id)->exists()) {
            $survey= Survey::where('id', $id)->delete();
            return redirect('/survey_list')->with('success','Survey Deleted Successfully!');
        }else{
            return redirect('/survey_list')->with('error','Survey Not Found');
        }
    }

    // Qustions Cruds Of Survey
    function view_survey_questions($id){
    	$survey = Survey::find($id);
    	$question_data = Questions::where('survey_id',$id)->get();
    	return view("survey.question.list",['question_list'=>$question_data,'survey'=>$survey,]);
    }
    function add_new_question($id){
    	$survey = Survey::find($id);
    	return view("survey.question.add",['survey'=>$survey,]);
    }
    function create_question(Request $req){
        $answers = json_encode($req->answers);
        $question = new Questions;
        $question->survey_id         	        = $req->survey_id;
        $question->survey_question              = $req->survey_question;
        $question->answers                      = $answers;
        $question->survey_question_description  = $req->survey_question_description;
        $question->save();
        return redirect('view_survey_questions/'.$req->survey_id)->with('success','Question Created Successfully!');
    }
    function edit_question($id){
    	$question = Questions::find($id);
    	return view("survey.question.edit",['question'=>$question,]);
    }
    function update_question(Request $req){
        $answers = json_encode($req->answers);
        $question               		        = Questions::find($req->id);
        $question->survey_question              = $req->survey_question;
        $question->answers                      = $answers;
        $question->survey_question_description  = $req->survey_question_description;
        $question->save();
        return redirect('view_survey_questions/'.$req->survey_id)->with('success','Question Details Updated Successfully!');
    }
    public function delete_question ($id) {
        $question_id = Questions::where('id',$id)->first();
        $survey_id = $question_id->survey_id;
        if(Questions::where('id', $id)->exists()) {
            $event= Questions::where('id', $id)->delete();
            return redirect('view_survey_questions/'.$survey_id)->with('success','Question Details Deleted Successfully!');
        }else{
            return redirect('view_survey_questions/'.$survey_id)->with('error','Question Not Found');
        }
    }

    // Answers Cruds
    function view_survey_answers($id){
    	$question = Questions::find($id);
    	$answer_data = Answers::where('question_id',$id)->get();
    	return view("survey.answer.list",['answer_list'=>$answer_data,'question'=>$question,]);
    }
    function add_new_answer($id){
    	$question = Questions::find($id);
    	return view("survey.answer.add",['question'=>$question,]);
    }
    function create_answer(Request $req){
        $answer 			 = new Answers;
        $answer->question_id = $req->question_id;
        $answer->answer      = $req->answer;
        $answer->save();
        return redirect('view_survey_answers/'.$req->question_id)->with('success','Answer Created Successfully!');
    }
    function edit_answer($id){
    	$answer = Answers::find($id);
    	return view("survey.answer.edit",['answer'=>$answer,]);
    }
    function update_answer(Request $req){
        $answer               		 = Answers::find($req->id);
        $answer->answer              = $req->answer;
        $answer->save();
        return redirect('view_survey_answers/'.$req->question_id)->with('success','Answer Details Updated Successfully!');
    }


    // api's
    function survey_list_api(){
        $survey_data = Survey::all();
        return response()->json(['survey_list' =>$survey_data,'image_url'=>'https://admin.4rizon.com/image/', 'success' => true], 200);
    }
    function get_questions_against_survey($survey_id,$user_id){
        $check = Survey_Status::where('user_id',$user_id)->where('survey_id',$survey_id)->get();
        if($check !='[]'){
            return response()->json(['record' =>$check, 'success' => true], 200);
        }else{
            $questions = Questions::where('survey_id',$survey_id)->get();
            return response()->json(['record' => $questions, 'success' => true], 200);
        }
    }
    function survey_check($user_id,$survey_id){
        $check = Survey_Status::where('user_id',$user_id)->where('survey_id',$survey_id)->get();
        if($check !='[]'){
            return response()->json(['message' =>"Existed", 'success' => true], 200);
        }else{
            return response()->json(['message' => "Not Existed", 'success' => true], 201);
        }
    }
    function survey_completed(Request $req){
        $result = json_decode(file_get_contents("php://input"), true);
        if($result['status'] == 1){
            $decodes = json_encode($result['answers']);
            $surveyDetail = Survey::find($result['surveyId']);
            $survey = new Survey_Status;
            $survey->user_id                = $result['userId'];
            $survey->survey_id              = $result['surveyId'];
            $survey->status                 = $result['status'];
            $survey->user_answers           = $decodes;
            $survey->save();
            $user = user_wallets::where('user_id',$result['userId'])->first();
            $userNewCoin = $user->available_points+$surveyDetail->survey_price;
            user_wallets::where('user_id','=',$result['userId'])->update([
              'available_points'=> $userNewCoin
            ]);
            return response()->json(['message' => "Survey Record Generated Successfully", 'success' => true], 200);
        }else{
            return response()->json(['message' => "User Left The Survey", 'success' => true], 201);
        }
    }
}
