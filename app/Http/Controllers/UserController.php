<?php

namespace App\Http\Controllers;

use App\User;
use App\Store;
use App\Answer;
use App\Survey;
use App\Question;
use App\UserStore;
use Carbon\Carbon;
use App\QuestionGroup;
use App\Questionnaire;
use App\SurveyResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Components\FlashMessages;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MailController;
use App\Http\Requests\StoreSurveyResponse;

class UserController extends Controller
{
    //
    use FlashMessages;

    public function _construct() {

        $this->middleware('auth:web');
    }

    public function index(){
        return view('auth.user.index');
    }

    public function getProfile(){
        $questionnaires = Questionnaire::all();

        $userStores = Auth::user()->userRestaurents;

        $storeRegistrations = [];
        foreach($userStores as $k => $userStore){

            $storeRegistrations[$k]['index'] = $userStore->id;
            $storeRegistrations[$k]['status'] = $userStore->confirmed;
            $storeRegistrations[$k]['store_id'] = $userStore->store_id;
            $storeRegistrations[$k]['check_in'] = $userStore->check_in;

            foreach($userStore->stores as $key => $storeId){

                $storeRegistrations[$k]['stores'][$key] = Store::where('id', $storeId)->firstOrFail();

            }

        }   
        
      
        return view('frontend.user.profile', compact(['questionnaires', 'storeRegistrations']));
    }

    // public function survey(){
    //     $questionnaires = Questionnaire::all();
    //     // $questionnaires->load('questions');

    //     // $groups = QuestionGroup::all();

    //     // $questions = Question::leftJoin('question_groups', 'questions.question_group_id', '=', '')->get();

    //     return view('frontend.user.profile', compact('questionnaires',));
    // }

    public function surveyDetail($language, $id, $slug, $index){
        
        
        
        $questionnaire = Questionnaire::where('id', $id)->firstOrFail();
        // dd(Str::slug($questionnaire->translate($language)->title));
        $user_id =  Auth::user()->id;
        
        $userStore = UserStore::where([['user_id', $user_id], ['id', $index]])->firstOrFail();

 
        if(!$userStore || $userStore->survey_id != null){
            return view('errors.404');
        }

        $restaurent = Store::where('id', $userStore->store_id)->firstOrFail();
        
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
        
            return view('frontend.survey.show', compact(['allQuestions', 'questionnaire', 'restaurent', 'index']));
        }
        else{
            return view('errors.404');
        }
    }

    public function store(StoreSurveyResponse $request, $lang, $questionnaire, $slug, $index){
        
        // StoreSurveyResponse

    //    $date = $request->raw_time;
    //    // Thu Oct 08 2020 00:00:00 GMT+0700 (Giờ Đông Dương)
      
    //    $date = Carbon::create($date)->toDateTimeString();  //return 2020-10-31 23:10:00 format

    //    return ($date);
        // return ($request->all());
        $request->validated();  
     
        $store = Store::where('id', $request->restaurent)->firstOrFail();

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
        $survey->dinner_time        = $request->restaurent_time;
        $survey->region_id          = $store->city->region->id;
        $survey->city_id            = $store->city_id;
        $survey->brand_id           = $store->brand_id;
        $survey->total_point        = $total;
        $survey->staff_name         = $request->staff_name;
        $survey->manager_name       = $request->manage_name;
        $survey->bank_name          = $request->bank_name;
        $survey->beneficiary        = $request->bank_account;
        $survey->bank_number        = $request->card_number;
        $survey->bank_address       = $request->bank_address;
        $survey->viewed             = 0;
        $survey->receipt_number     = $request->receipt;
        $survey->feedback           = $request->user_feedback;
        
        $survey->save();

        //update Userstore after given survey
        $userStore = UserStore::where([['user_id', Auth::user()->id], ['id', $index]])->firstOrFail();
        $userStore->response_status = 'completed';
        $userStore->survey_id = $survey->id;
        $userStore->save();

        $survey->responses()->createMany($responses);
        //send email to user after completed survey
        MailController::sendResponeCompleted(Auth::user()->name, Auth::user()->email, $lang);

        //send notify to admin
        MailController::sendAdminRsponse(Auth::user()->name, Auth::user()->email, $store);
        
        self::success('Thanks for your response');



        return redirect()->route('user.profile', app()->getLocale());

    }



    /*
    *
    * User response From email
    */

    public function userResponseEmail($lang, $token, $resq){
        
     
        $userStore = UserStore::where('token', $token)->firstOrFail();
        
        $store = Store::where('id', $userStore->store_id)->firstOrFail();
       
        $user = User::where('id', $userStore->user_id)->firstOrFail();

        //check time expire from email send to email confirm.(Add 2 day)

        //create new password each registration for user
        $length = 10;
        $keyspace = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        $max = mb_strlen($keyspace, '8bit') - 1;

        for($i = 0; $i < $length; ++$i){
            $password .= $keyspace[random_int(0, $max)];
        }

        $user->password = Hash::make($password);
        $user->save();
       

        if(!$userStore){
            return redirect()->back();
        }

        $userStore->token = null;
        $userStore->response_status = $resq;

        $userStore->update();

        //send email notify admin
        MailController::sendUserConfirmEmail($user->name, $user->email, $resq, $store);


        //send Email confirm to user
        MailController::sendUserConfirmed($user->name, $user->email, $password, $user->locale, $resq);

        self::success('Thanks for your confirmation');

        return redirect()->route('home', $lang);
    }

    // public function registrationNew(Request $request, $lang){

    //     $data_user = $this->validate( $request, [
          
    //         'store'                             =>  'required|array',
    //         'store.*'                           =>  'exists:stores,id',
    //     ]);

    //     $user = User::where('id', Auth::user()->id)->firstORFail();
        
    //     $userCompleted = UserStore::where([['user_id', Auth::user()->id], ['response_status', 'completed']])->get();
        
            
    //     if($user && $user->actived == 1){
            
    //         if(count($userCompleted) >= 3){
    //             return redirect()->back();
    //         }
       
    //         $storeRegistration = new UserStore();
    //         $storeRegistration->user_id = Auth::user()->id;
    //         $storeRegistration->stores = $data_user['store'];
    //         $storeRegistration->locale = App::getLocale();
    //         $storeRegistration->response_status = 'waiting';
    //         $storeRegistration->save();
    
    //         //send email notify to user registration and admin.
    //         MailController::sendSignupEmail($user->name, $user->email, $user->token );
           
    //         self::success('Register success');
    
    //         return redirect()->back();

    //     }

      

    // }
   

}
