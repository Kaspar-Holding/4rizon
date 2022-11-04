<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DJ_Questionnaire;
use App\Models\DJQuestions;
use App\Models\Answers;
use App\Models\DJ_Questionnaire_Status;
use App\Models\user_wallets;

class DJQuestionnaireController extends Controller
{
    function dj_questionnaire_list(){
    	$questionnaire_data = DJ_Questionnaire::all();
    	return view("dj_questionnaire.list",['dj_questionnaire_list'=>$questionnaire_data,]);
    }
    function questionnaire_users_answers_list(){
    	$questionnaire_data = DJ_Questionnaire_Status::all();
    	return view("dj_questionnaire.answerslist",['questionnaire_list'=>$questionnaire_data,]);
    }
    function edit_dj_questionnaire($id){
    	$questionnaire = DJ_Questionnaire::find($id);
    	return view("dj_questionnaire.edit",['dj_questionnaire'=>$questionnaire,]);
    }
    function add_new_dj_questionnaire(){
    	return view("dj_questionnaire.add");
    }
    function create_dj_questionnaire(Request $req){
        $questionnaire = new DJ_Questionnaire;
        $questionnaire->questionnaire_name         = $req->questionnaire_name;
        $questionnaire->questionnaire_description  = $req->questionnaire_description;
        $questionnaire->save();
        return redirect('/dj_questionnaire')->with('success','Questionnaire Created Successfully!');
    }
    function dj_questionnaire_update(Request $req){
        $questionnaire               		 = DJ_Questionnaire::find($req->id);
        $questionnaire->questionnaire_name         = $req->questionnaire_name;
        $questionnaire->questionnaire_description  = $req->questionnaire_description;
        $questionnaire->save();
        return redirect('/dj_questionnaire')->with('success','Questionnaire Details Updated Successfully!');
    }
    public function delete_questionnaire ($id) {
        if(DJ_Questionnaire::where('id', $id)->exists()) {
            $questionnaire= DJ_Questionnaire::where('id', $id)->delete();
            return redirect('/questionnaire_list')->with('success','questionnaire Deleted Successfully!');
        }else{
            return redirect('/questionnaire_list')->with('error','questionnaire Not Found');
        }
    }

    // Qustions Cruds Of questionnaire
    function view_dj_questionnaire_questions($id){
    	$questionnaire = DJ_Questionnaire::find($id);
    	$question_data = DJQuestions::where('dj_questionnaire_id',$id)->get();
    	return view("dj_questionnaire.question.list",['question_list'=>$question_data,'questionnaire'=>$questionnaire,]);
    }
    function add_new_dj_questionnaire_question($id){
    	$questionnaire = DJ_Questionnaire::find($id);
    	return view("dj_questionnaire.question.add",['questionnaire'=>$questionnaire,]);
    }
    function create_dj_questionnaire_question(Request $req){
        $answers = json_encode($req->answers);
        $question = new DJQuestions;
        $question->dj_questionnaire_id         	        = $req->questionnaire_id;
        $question->dj_questionnaire_question              = $req->questionnaire_question;
        $question->answers                      = $answers;
        // $question->dj_questionnaire_description  = $req->questionnaire_question_description;
        $question->save();
        return redirect('view_dj_questionnaire_questions/'.$req->questionnaire_id)->with('success','Question Created Successfully!');
    }
    function edit_dj_questionnaire_question($id){
    	$question = DJQuestions::find($id);
    	return view("dj_questionnaire.question.edit",['question'=>$question,]);
    }
    function update_dj_questionnaire_question(Request $req){
        $answers = json_encode($req->answers);
        $question               		        = DJQuestions::find($req->id);
        $question->dj_questionnaire_id          = $req->dj_questionnaire_id;
        $question->dj_questionnaire_question    = $req->dj_questionnaire_question;
        $question->answers                      = $answers;
        // $question->dj_questionnaire_description = $req->dj_questionnaire_question_description;
        $question->save();
        return redirect('view_dj_questionnaire_questions/'.$req->questionnaire_id)->with('success','Question Details Updated Successfully!');
    }
    public function delete_dj_questionnaire_question ($id) {
        $question_id = DJQuestions::where('id',$id)->first();
        $questionnaire_id = $question_id->dj_questionnaire_id;
        if(DJQuestions::where('id', $id)->exists()) {
            $event= DJQuestions::where('id', $id)->delete();
            return redirect('view_dj_questionnaire_questions/'.$questionnaire_id)->with('success','Question Details Deleted Successfully!');
        }else{
            return redirect('view_dj_questionnaire_questions/'.$questionnaire_id)->with('error','Question Not Found');
        }
    }

    // api's
    function questionnaire_list_api(){
        $questionnaire_data = DJ_Questionnaire::all();
        return response()->json(['questionnaire_list' =>$questionnaire_data,'image_url'=>'http://kaspar.eastus.cloudapp.azure.com/jynx_testing/image/', 'success' => true], 200);
    }
    function get_dj_questionnaire_questions(Request $req){
        $questions = DJQuestions::where('dj_questionnaire_id',12)->get();
        return response()->json(['record' => $questions, 'success' => true], 200);
    }
    // function get_questions_against_questionnaire($questionnaire_id,$user_id){
    //     $check = DJ_Questionnaire_Status::where('user_id',$user_id)->where('questionnaire_id',$questionnaire_id)->get();
    //     if($check !='[]'){
    //         return response()->json(['record' =>$check, 'success' => true], 200);
    //     }else{
    //         $questions = DJQuestions::where('questionnaire_id',$questionnaire_id)->get();
    //         return response()->json(['record' => $questions, 'success' => true], 200);
    //     }
    // }
    function questionnaire_check($user_id,$questionnaire_id){
        $check = DJ_Questionnaire_Status::where('user_id',$user_id)->where('questionnaire_id',$questionnaire_id)->get();
        if($check !='[]'){
            return response()->json(['message' =>"Existed", 'success' => true], 200);
        }else{
            return response()->json(['message' => "Not Existed", 'success' => true], 201);
        }
    }
    function questionnaire_completed(Request $req){
        $result = json_decode(file_get_contents("php://input"), true);
        if($result['status'] == 1){
            $decodes = json_encode($result['answers']);
            $questionnaireDetail = DJ_Questionnaire::find($result['questionnaireId']);
            $questionnaire = new DJ_Questionnaire_Status;
            $questionnaire->user_id                = $result['userId'];
            $questionnaire->questionnaire_id              = $result['questionnaireId'];
            $questionnaire->status                 = $result['status'];
            $questionnaire->user_answers           = $decodes;
            $questionnaire->save();
            $user = user_wallets::where('user_id',$result['userId'])->first();
            $userNewCoin = $user->available_points+$questionnaireDetail->questionnaire_price;
            user_wallets::where('user_id','=',$result['userId'])->update([
              'available_points'=> $userNewCoin
            ]);
            return response()->json(['message' => "questionnaire Record Generated Successfully", 'success' => true], 200);
        }else{
            return response()->json(['message' => "User Left The questionnaire", 'success' => true], 201);
        }
    }
}
