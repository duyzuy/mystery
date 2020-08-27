<?php

namespace App\Http\Controllers;

use App\Test;
use App\User;
use App\Question;
use App\Questionnaire;
use App\Exports\UsersExport;

use Illuminate\Http\Request;
use App\Components\FlashMessages;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\MailController;

use App\Survey;

class AdminController extends Controller
{
    //
    use FlashMessages;

    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('backend.dashboard');
    }


    // public function index(){
    //     return view('auth.user.index');
    // }

    public function edit(){
        self::warning('not permission yet');
        return redirect()->back();
    }

    public function listAll(){
        $users = User::all();
        return view('backend.users.index', compact(['users']));
    }

    public function show($id){
        $user = User::where('id', $id)->firstOrFail();
        
        return view('backend.users.show', compact(['user']));
    } 

    public function approvalUser(Request $request, $id){
     
        switch ($request->action) {
            case 'approve':
                $user = User::where('id', $id)->firstOrFail();

                if(!empty($request->password)){
                    $password = trim($request->password);
                } else {
                    $length = 10;
                    $keyspace = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $str = '';
                    $max = mb_strlen($keyspace, '8bit') - 1;
        
                    for($i = 0; $i < $length; ++$i){
                        $str .= $keyspace[random_int(0, $max)];
                    }
                    $password = $str;
                }

                $user->actived = 1;
                $user->password = Hash::make($password);
                $user->save();
                $link_survey = 'http://afg.huho.com.vn/vi/survey';

                MailController::sendVerifyedEmail($user->name, $user->email, $password, $link_survey, $user->token );

                self::success('Approval successfully');
              
                return redirect()->route('manage.user.list');
            break;
            case 'unapprove':
                $user = User::where('id', $id)->firstOrFail();
                $user->actived = 0;
                $user->save();
                self::success('Un-approval successfully');
                return redirect()->route('manage.user.list');
            break;
        }
    }

    public function filterUser(Request $request, $status){
        $users = User::all();

        switch($request->status){
            case 'actived' :
                $users = User::where('actived', 1)->get();
                return view('backend.users.index', compact(['users']));      
            break;
            case 'unactive' :
                $users = User::where('actived', 0)->get();
                return view('backend.users.index', compact(['users'])); 
            break;
        }
            
        return view('backend.users.index', compact(['users'])); 
    }

    public function questionnaireReport(){
        $questionnaires = Questionnaire::all();

        $questionnaires->load('questions.answers.responses');



        
        return view('backend.questionnaires.report', compact(['questionnaires']));
    }

    public function exportExcel(Request $request, $status){

        if($status == 'actived'){
            return Excel::download(new UsersExport('actived'), 'users-'.date("Y.m.d").'.xlsx');
        }elseif($status == 'unactive')
            return Excel::download(new UsersExport('unactive'), 'users-'.date("Y.m.d").'.xlsx');
        else{
            return Excel::download(new UsersExport, 'users-'.date("Y.m.d").'.xlsx');
        }
        
    }

   public function questionsFilter(Questionnaire $questionnaire, $filter){

        
        $questions = Question::where('questionnaire_id', $questionnaire->id)
            ->join('survey_responses', function($join){
                $join->on('questions.id', '=', 'survey_responses.question_id')
                    ->where('survey_responses.key', '=' , 'no');          
            })
            ->selectRaw('questions.*, COUNT(survey_responses.question_id) as resSum, survey_responses.key')
            ->groupBy('questions.id')
            ->orderBy('resSum', 'desc')->get();
            
            // $questions->load(['surveys' => function($q){

            //     $q->rightJoin('survey_responses', '')
            // }]);

            // $questionnaires = Questionnaire::all();
            // $questions = Question::where('questionnaire_id', $questionnaire->id)
            
            // $questionnaire->load(['questions' => function ($q) {
            //     $q->rightJoin('survey_responses', 'survey_responses.question_id', '=', 'questions.id')
            //             ->where('survey_responses.key', '=', 'yes')
            //              ->selectRaw('questions.*, COUNT(survey_responses.question_id) as resSum')
            //              ->groupBy('questions.id')
            //             ->orderBy('resSum', 'desc')->get();
            // }]);




            // dd($questions->all());
           
            return view('backend.questionnaires.reportFilter', compact(['questions', 'questionnaire']));
    }

    public function responses(){
       $surveys = Survey::all();

       return view('backend.questionnaires.surveys.index', compact(['surveys']));
    }

    public function responsesDetail($id){
        $survey = Survey::where('id', $id)->firstOrFail();
        $survey->viewed = 1;
        $survey->update();
        $survey->load('responses');
        return view('backend.questionnaires.surveys.detail', compact(['survey']));
    }



}
