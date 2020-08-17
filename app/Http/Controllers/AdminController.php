<?php

namespace App\Http\Controllers;

use App\User;
use App\Questionnaire;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Components\FlashMessages;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\MailController;

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
                $link_survey = 'http://localhost/mystery/manage/users';

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

        // $questionnaires->load(['questions' => function ($q) {
        //     $q->rightJoin('survey_responses', 'survey_responses.question_id', '=', 'questions.id')
        //             ->where('survey_responses.key', '=', 'no')
        //             // ->selectRaw('questions.*, SUM(survey_responses.question_id) as resSum')
        //             // ->groupBy('questions.id')
        //             ->orderBy('question_id', 'desc')->get();
        // }]);



        // $category->load(['posts' => function ($q) {
        //     $q->leftJoin('votes', 'votes.post_id', '=', 'posts.id')
        //         ->selectRaw('posts.*, sum(votes.votes) as votesSum')
        //         ->groupBy('posts.id')
        //         ->orderBy('votesSum', 'desc');
        //  }]);
         
        
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


}
