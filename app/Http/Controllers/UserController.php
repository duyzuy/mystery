<?php

namespace App\Http\Controllers;

use App\User;
use App\Answer;
use App\Survey;
use App\Question;
use App\QuestionGroup;
use App\Questionnaire;
use App\SurveyResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //

    public function _construct() {

        $this->middleware('auth:web');
    }

    public function index(){
        return view('auth.user.index');
    }

    public function getProfile(){
        $questionnaires = Questionnaire::all();

        
      
        return view('frontend.user.profile', compact(['questionnaires']));
    }

    // public function survey(){
    //     $questionnaires = Questionnaire::all();
    //     // $questionnaires->load('questions');

    //     // $groups = QuestionGroup::all();

    //     // $questions = Question::leftJoin('question_groups', 'questions.question_group_id', '=', '')->get();

    //     return view('frontend.user.profile', compact('questionnaires',));
    // }

    public function surveyDetail($language, $id, $slug){
       
        $questionnaire = Questionnaire::where('id', $id)->firstOrFail();
        // dd(Str::slug($questionnaire->translate($language)->title));
        if($questionnaire){
            $groups = QuestionGroup::all();
            $allQuestions = [];
            foreach($groups as $key => $group){
                $questions = Question::where([
                    ['questionnaire_id', '=', $id],
                    ['question_group_id', '=', $group->id]
                ])->get();
                if( Question::where([['questionnaire_id', '=', $id],['question_group_id', '=', $group->id]])->exists() ){
                    $allQuestions[$key]['group'] = $group;
                    $allQuestions[$key]['questions'] = $questions;
                }
            
            
            }
        
            return view('frontend.survey.show', compact(['allQuestions', 'questionnaire']));
        }
        else{
            return view('errors.404');
        }
    }

    public function store(Request $request, $lang, $questionnaire, $slug){
        
        $request->validate([
            'responses.*.answer_id'         =>  'required',
            'responses.*.question_id'       =>  'required',
            'responses.*.group_id'          =>  'required',
            'restaurent'                    =>  'required',
            'address'                       =>  'required',
            'time'                          =>  'required',
            'manage_name'                   =>  'required',
            'staff_name'                    =>  'required',
        ]); 
        // $published = Carbon::now();
        // $post->published_at = $published->format('Y-m-d H:i:s');
  
        $responses = $request->responses;
        
        $total = 0;
        foreach($responses as $key => $response){
            $answer = Answer::where([
                                    ['id', $response['answer_id']], 
                                    ['question_id', $response['question_id']]
                                    ])->firstOrFail();
            $responses[$key]['point'] = $answer->point;
            $responses[$key]['key'] = $answer->key;

            $total += $answer->point;
        }
        

        $survey = new Survey();
        $survey->user_id            = Auth::user()->id;
        $survey->questionnaire_id   = $questionnaire;
        $survey->store_id           = $request->restaurent;
        $survey->dinner_time        = $request->time;
        $survey->total_point        = $total;
        $survey->address	        = $request->address;
        $survey->staff_name         = $request->staff_name;
        $survey->manager_name       = $request->manage_name;
        $survey->feedback           = $request->user_feedback;
        
        $survey->save();

        $survey->responses()->createMany($responses);
        $request->session()->flash('success', 'Answer success');
        return redirect()->route('user.profile', app()->getLocale());

    }
   

}
