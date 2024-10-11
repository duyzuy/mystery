<?php

namespace App\Http\Controllers;

use App\City;
use App\Test;
use App\User;
use App\Brand;
use App\Store;

use App\Region;
use App\Survey;
use App\Question;

use App\UserStore;
use Carbon\Carbon;
use App\QuestionGroup;

use App\Questionnaire;
use App\SignupResponse;
use App\SurveyResponse;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Components\FlashMessages;
use Illuminate\Support\Facades\DB;
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

    public function showResetPassword($id){
        $user = User::where('id', $id)->firstOrFail();
        return view('backend.users.resetpassword', compact(['user']));
    }
    public function resetPassword(Request $request){

        // return $request->all();
        $autoPassWord = $request->auto_password;
        $checkUser = User::where([
            ['id', $request->user_id],
            ['email', $request->user_email]
            ])->exists();

        if(!$checkUser){
            self::info('User is not valid');
            return redirect()->back();
        }

        $user = User::where([
            ['id', $request->user_id],
            ['email', $request->user_email]
        ])->firstOrFail();


        if(!$autoPassWord){
            $request->validate([
                'user_password' =>  'required|min:8',
                'user_password_confirm' =>  'required|same:user_password',
            ]);
            
            $password = $request->user_password;
            
        }else{
            $length = 10;
            $keyspace = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;
    
            for($i = 0; $i < $length; ++$i){
                $str .= $keyspace[random_int(0, $max)];
            }
            $password = $str;
        }



        $user->password = Hash::make($password);
        $user->save();
        

            MailController::UserResetPassword($user->name, $user->email, $user->locale, $password);

            self::success('Password was reseted and send to user succesful');
            return redirect()->route('manage.user.show', $user->id);
        
    }

    public function listAll(){
        $users = DB::table('users')->get();
        return view('backend.users.index', compact(['users']));
    }

    public function show($id){
        $user = User::where('id', $id)->firstOrFail();
        $userStores = UserStore::where('user_id', $id)->get();
        $signUpRespponses = SignupResponse::where('user_id', $id)->get();
        $storeRegistrations = [];
        foreach($userStores as $k => $userStore){

            $storeRegistrations[$k]['index'] = $userStore->id;
            $storeRegistrations[$k]['confirmed'] = $userStore->confirmed;
            $storeRegistrations[$k]['store_id'] = $userStore->store_id;
            $storeRegistrations[$k]['check_in'] = $userStore->check_in;
            $storeRegistrations[$k]['response_status'] = $userStore->response_status;

            foreach($userStore->stores as $key => $storeId){

                $storeRegistrations[$k]['stores'][$key] = Store::where('id', $storeId)->firstOrFail();

            }

        }   

        
        return view('backend.users.show', compact(['user', 'storeRegistrations', 'signUpRespponses']));
    } 

    // public function approvalUser(Request $request, $id){
     
    //     switch ($request->action) {
    //         case 'approve':
    //             $user = User::where('id', $id)->firstOrFail();

    //             if(!empty($request->password)){
    //                 $password = trim($request->password);
    //             } else {
    //                 $length = 10;
    //                 $keyspace = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //                 $str = '';
    //                 $max = mb_strlen($keyspace, '8bit') - 1;
        
    //                 for($i = 0; $i < $length; ++$i){
    //                     $str .= $keyspace[random_int(0, $max)];
    //                 }
    //                 $password = $str;
    //             }

    //             $user->actived = 1;
    //             $user->password = Hash::make($password);
    //             $user->save();
    //             $link_survey = 'http://afg.huho.com.vn/vi/user/login';
    //             if($user->locale == 'en'){
    //                 $link_survey = 'http://afg.huho.com.vn/en/user/login';
    //             }
               

    //             MailController::sendVerifyedEmail($user->name, $user->email, $password, $link_survey, $user->token, $user->locale );

    //             self::success('Approval successfully');
              
    //             return redirect()->route('manage.user.list');
    //         break;
    //         case 'unapprove':
    //             $user = User::where('id', $id)->firstOrFail();
    //             $user->actived = 0;
    //             $user->save();
    //             self::success('Un-approval successfully');
    //             return redirect()->route('manage.user.list');
    //         break;
    //     }
    // }

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
        $questionnaire = Questionnaire::where('id', 1)->firstOrFail();
        $questionnaire->load('questions.answers.responses');
        $regions = Region::all();
        $brands = Brand::all();
        $cities = City::all();

        return view('backend.questionnaires.report', compact(['questionnaire', 'regions', 'brands', 'cities']));
    }
    public function questionsReportFilter(Request $request){

        // return $request->all();
      

        $request->validate([
            'date'  =>  'required',
            'answer_type'   =>  'required',
        ]);
        $answerType = $request->answer_type;
        $date = explode("-", $request->date);
        $dateFrom =  Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[0]))->toDateString();
        $dateTo = Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[1]))->toDateString();

        $regionFilter = $request->region;
        $brandFilter = $request->brand;
        $restaurantFilter = $request->restaurant;

        $query = Survey::query();
        if($regionFilter != 'all'){
            $survey = $query->where('region_id', $regionFilter);
        }
        if($brandFilter != 'all'){
            $survey = $query->where('brand_id', $brandFilter);
        }
        if($restaurantFilter != 'all'){
            $survey = $query->where('store_id', $restaurantFilter);
        }

        $query->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
        $surveys = $query->select('id')->get();
        
        if(count($surveys) == 0){
            self::info('No have report select again');
            return redirect()->back();
        }

        $surveyId = array();
        foreach($surveys as $survey){
            $surveyId[] = $survey->id;
        }

        $questions = Question::where('questionnaire_id', 1)
        ->join('survey_responses', function($join) use ($surveyId, $answerType){
         
            $join->on('questions.id', '=', 'survey_responses.question_id')
                ->whereIn('survey_responses.survey_id', $surveyId)         
                ->where('survey_responses.key', '=' , $answerType);          
        })
        ->selectRaw('questions.*, COUNT(survey_responses.question_id) as resSum, survey_responses.key')
        ->groupBy('questions.id')
        ->orderBy('resSum', 'desc')->get();

        $questionnaire = Questionnaire::where('id', 1)->firstOrFail();
        $regions = Region::all();
        $brands = Brand::all();
        $cities = City::all();
  
        return view('backend.reports.questionReportYN', compact(['questionnaire', 'questions', 'regionFilter', 'brandFilter', 'restaurantFilter', 'dateFrom', 'dateTo', 'regions', 'brands', 'cities', 'answerType']));

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
            ->join('survey_responses', function($join) use ($filter){
                $join->on('questions.id', '=', 'survey_responses.question_id')
                    ->where('survey_responses.key', '=' , $filter);          
            })
            ->selectRaw('questions.*, COUNT(survey_responses.question_id) as resSum, survey_responses.key')
            ->groupBy('questions.id')
            ->orderBy('resSum', 'desc')->get();
            
            return view('backend.questionnaires.reportFilter', compact(['questions', 'questionnaire', 'filter']));
    }
    
    public function responses(){
       $surveys = Survey::all();
       $questionnaires = Questionnaire::all();
       $regions = Region::all();
       $cities = City::all();
       $brands = Brand::all();
       $restaurants = Store::all();
       return view('backend.questionnaires.surveys.index', compact(['surveys', 'cities', 'brands', 'restaurants', 'questionnaires', 'regions']));
    }
    public function responseFilter(Request $request){
        // return $request->all();
        $request->validate([
            'date'  =>  'required',
            'questionnaire' =>  'required',
        ]);

        $regionId = $request->region;
        $brandId = $request->brand;
        $restaurantId = $request->restaurant;
        $date = explode("-", $request->date);
        $dateFrom =  Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[0]))->toDateString();
        $dateTo = Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[1]))->toDateString();
        $questionnaireId = $request->questionnaire;

        $query = Survey::query();

        if($regionId != 'all'){
            $query->where('region_id', $regionId);
        }
        if($brandId != 'all'){
            $query->where('brand_id', $brandId);
        }
        if($restaurantId != 'all'){
            $query->where('store_id', $restaurantId);
        }
        $query->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
        $surveys = $query->get();
    
        if(count($surveys) == 0){
            self::info('No have report from' . $dateFrom . ' to ' . $dateTo);
            return redirect()->back();
        }

        $questionnaires = Questionnaire::all();
        $regions = Region::all();
        $cities = City::all();
        $brands = Brand::all();

        return view('backend.questionnaires.surveys.filter', compact(['surveys', 'cities', 'brands', 'questionnaires', 'regions', 'regionId', 'brandId', 'questionnaireId', 'restaurantId', 'dateFrom', 'dateTo']));
    }
    public function responsesDetail($id){
       
        $groupQuestions = QuestionGroup::whereHas('questions') 
               ->with(['questions' => function($question) use ($id){
                   $question->where([
                       ['questionnaire_id', '=', 1]
                   ])
                   ->select('questions.id', 'questions.question_group_id', 'questions.questionnaire_id', 'questions.type')
                   ->with(['questionMaxPoint'])
                   ->with(['responses' => function($response) use($id){
                       $response->where('survey_id', $id);
                   }]);
               }])
        ->get();
        $survey = Survey::where('id', $id)->firstOrFail();
        $survey->viewed = 1;
        $survey->update();
               
     
        return view('backend.questionnaires.surveys.detail', compact(['survey', 'groupQuestions']));
    }
    public function surveyEdit($userId, $surveyId){
        $user = User::where('id', $userId)->firstOrFail();
        $survey = Survey::where('id', $surveyId)->firstOrFail();
        return view('backend.questionnaires.surveys.edit', compact(['user', 'survey']));
    }
    public function userSurveyUpdate(Request $request, $userId, $surveyId){
        
        $request->validate([
            'name'      =>      'required',
            'email'     =>      'required',
            'phone_number'  =>      'required',
            'address'  =>      'required',
            'staff_name'  =>      'required',
            'manager_name'  =>      'required',
            'receipt_number'  =>      'required',
        ]);

        $user = User::where('id', $userId)->firstOrFail();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->save();

        $survey = Survey::where('id', $surveyId)->firstOrFail();
        $survey->staff_name = $request->staff_name;
        $survey->manager_name = $request->manager_name;
        $survey->receipt_number = $request->receipt_number;
        $survey->save();
       
        self::success('update success');
        return redirect()->route('manage.survey.response.detail', $surveyId);

    }
    //confirm store in admin 
    public function approvalUserStore(Request $request, $id, $index){

      
        $user = User::where('id', $id)->firstOrFail();

        if(!$user){
            return;
        }
        
        // if($user->actived === 0){

        //     self::info('User need to approval before send Email confirm');
        //     return redirect()->back();
        // }

        $request->validate([
            'registration_index'    =>      'required|exists:user_store,id',
            'store_id'              =>      'required|exists:stores,id',
            'check_in'              =>      'required',
        ]);

            $date = $request->check_in;
            // "Sunday, September 27th 2020, 10:44"
        

            $date = Carbon::create($date)->toDateTimeString();  //return 2020-10-31 23:10:00 format

            if($user->locale == 'vi'){
                $date_send = Carbon::parse($date)->locale('vi');
                $date_send =  $date_send->isoFormat('dddd - Do MMMM, YYYY');
            }else{
                $date_send = Carbon::parse($date)->locale('en');
                $date_send =  $date_send->isoFormat('dddd - MMMM Do, YYYY');
            }
        
           
        
            $userStore = UserStore::where([['user_id', $id], ['id', $index]])->firstOrFail(); 
            
            

            $userStore->store_id = $request->store_id;
            $userStore->confirmed = true;
            $userStore->check_in = $date;
            $userStore->token  =  Str::random(80);
            $userStore->save();


            $store = Store::where('id', $request->store_id)->firstOrFail();

            MailController::sendConfirmRegistrationRestaurent($user->name, $user->email, $date_send, $user->locale, $store, $userStore->token);

            self::success('Send confirm successful');
            return redirect()->back();
    }

    //Re invite old user
    public function reinvite($id){
        $userWaiting = UserStore::where([
            ['response_status', 'waiting'],
            ['user_id', $id]])->exists();

        if($userWaiting){
            self::success('you have to cancel the old invite with waiting status before send new invite to user');
            return redirect()->back();
        }

        $user = User::where('id', $id)->firstOrFail();
        $cities = City::all();
        $stores = Store::all();
        return view('backend.users.re-invite', compact(['user', 'stores', 'cities']));
    }

    public function cancelInvite(Request $request, $user_id, $invite_id){

       
        $register = UserStore::where([
                ['id', $invite_id],
                ['user_id', $user_id]
            ])->firstOrFail();
        
        if($register->response_status != 'waiting'){
            self::infor('Only cancel in "waiting" status');
            return redirect()->back();
        }
        $register->response_status = 'cancel';
        $register->token = null;
        $register->save();
        
        self::success('Cancel the invite successful');
        return redirect()->back();
    }

    public function sendInvite(Request $request, $id){

       
        if($id != $request->user_id){
            return;
        }
        $data_user = $this->validate( $request, [
          
            // 'stores'                             =>  'required|array',
            // 'stores.*'                           =>  'exists:stores,id',
            'store'            =>   'required',
            'store'            =>   'exists:stores,id',
            'check_in'              =>      'required',
        ]);

        $date = $request->check_in;
        // "Sunday, September 27th 2020, 10:44"
       
        $date = Carbon::create($date)->toDateTimeString();  //return 2020-10-31 23:10:00 format

        $user = User::where('id', $id)->firstOrFail();

        if($user->locale == 'vi'){
            $date_send = Carbon::parse($date)->locale('vi');
            $date_send =  $date_send->isoFormat('dddd - Do MMMM, YYYY');
        }else{
            $date_send = Carbon::parse($date)->locale('en');
            $date_send =  $date_send->isoFormat('dddd - MMMM Do, YYYY');
        }
    
 

     
        
        $userCompleted = UserStore::where('user_id', $id)->get();

      

            // if(count($userCompleted) >= 3){
            //     self::success('User already get 3 times survey');
            //     return redirect()->back();
            // }
       
            $storeRegistration = new UserStore();
            $storeRegistration->user_id = $request->user_id;
            $storeRegistration->stores = array($request->store);
            $storeRegistration->store_id = $request->store;
            $storeRegistration->token  =  Str::random(80);
            $storeRegistration->confirmed = true;
            $storeRegistration->check_in = $date;
            $storeRegistration->locale = $user->locale;
            $storeRegistration->response_status = 'waiting';
            $storeRegistration->save();

            $store = Store::where('id', $request->store)->firstOrFail();

            MailController::sendConfirmRegistrationRestaurent($user->name, $user->email, $date_send, $user->locale, $store, $storeRegistration->token);
           
            self::success('Invite successful');
    
            return redirect()->route('manage.user.show', $id);


        
    }

    //Custom report

    public function customReport(Request $request){
       
  
        $brands = Brand::all();
        $questionnaires = Questionnaire::all();
        $surveys = Survey::all();
        
        return view('backend.reports.monthly-report', compact(['brands', 'questionnaires', 'surveys']));
    }

    public function customReportFilter(Request $request){

        
        $request->validate([
            'date'  =>  'required',
            'questionnaire' =>  'required'
        ]);
       
      
        
        $questionnaireId = $request->questionnaire;
        $date = explode("-", $request->date);
       
        // return $date[0];

        $dateFrom =  Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[0]))->toDateString();
        $dateTo = Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[1]))->toDateString();
        
        $brands = Brand::all();
        $questionnaires = Questionnaire::all();

        $surveys = Survey::where([
            ['questionnaire_id', $request->questionnaire],
            
        ])->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo])
        ->get();
       
        // return $surveys;

        return view('backend.reports.monthly-report-date', compact(['brands', 'questionnaires', 'surveys', 'dateFrom', 'dateTo', 'questionnaireId']));
    }

    //view detail of report
    public function reportDetail(Request $request, $surveyId){
        
        $survey = Survey::where('id', $surveyId)->firstOrFail();
        
        $survey->load('responses');
       
        return view('backend.reports.detail', compact(['survey']));
    }
    public function customReportFilter2(){
        return 'oke';
    }

    public function guestCommentReport(){
        $brands = Brand::all();
        $questionnaires = Questionnaire::all();
        $regions = Region::all();
        $surveys = Survey::orderBy('id', 'desc')->paginate(20);
        return view('backend.reports.guestCommentReport', compact(['brands', 'questionnaires', 'surveys', 'regions']));
    }

    public function guestCommentReportFilter(Request $request){

       
        $request->validate([
            'brand' =>  'required',
            'date'  =>  'required',
            'questionnaire' =>  'required'
        ]);
        $questionnaireId = $request->questionnaire;
        $brandFilter = $request->brand;
        $regionFilter = $request->region;
        $regions = Region::all();
        $brands = Brand::all();
        $questionnaires = Questionnaire::all();
        $date = explode("-", $request->date);
        $dateFrom =  Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[0]))->toDateString();
        $dateTo = Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[1]))->toDateString();
        
     
        $query = Survey::query();
        $query->where('questionnaire_id', $request->questionnaire);
        
        if($brandFilter != 'all'){
            $query->where('brand_id', $brandFilter);
        }
        if($regionFilter != 'all'){
            $query->where('region_id', $regionFilter);
        }
        $query->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
        $surveys =  $query->get();

        return view('backend.reports.guestCommentReportDate', compact(['surveys', 'brands', 'regions', 'questionnaires', 'questionnaireId', 'brandFilter', 'regionFilter', 'dateFrom', 'dateTo']));
    }


    //report for monthly

    public function monthlyReport(){
        $questionnaires = Questionnaire::all();
        $surveys = Survey::all();
        $regions = Region::all();
        $cities = City::all();
        $brands = Brand::all();
        return view('backend.reports.monthlyReport', compact(['questionnaires', 'surveys', 'regions', 'brands', 'cities']));
    }
    public function monthlyReportShow(Request $request){

    
        $request->validate([
            'date'  =>  'required',
            'questionnaire' =>  'required',
            'answer_type'   =>  'required',
        ]);
        $answerType = $request->answer_type;
        $date = explode("-", $request->date);
        $dateFrom =  Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[0]))->toDateString();
        $dateTo = Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[1]))->toDateString();
        
        $regionFilter = $request->region;
        $brandFilter = $request->brand;
        $restaurantFilter = $request->restaurant;
        
        $questionnaireId = $request->questionnaire;
        $brandWithSurveys = Brand::whereHas('surveys', function($survey) use ($dateFrom, $dateTo, $brandFilter, $regionFilter, $restaurantFilter){
            
            $survey->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
            
            if($brandFilter != 'all'){
                $brand = Brand::where('id', $brandFilter)->firstOrFail();
                $survey->where([['brand_id', $brandFilter]]);
                
            }
            if($regionFilter != 'all'){

                $region = Region::where('id', $regionFilter)->firstOrFail();
                $survey->where([['region_id', $regionFilter]]);
               
            }

            if($restaurantFilter != 'all'){

                $store = Store::where('id', $restaurantFilter)->firstOrFail();
                $survey->where([['store_id', $restaurantFilter]]);
            }

        })->with(['surveys' => function($survey) use ($dateFrom, $dateTo, $brandFilter, $regionFilter, $restaurantFilter){
            $survey->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
            if($brandFilter != 'all'){
                $brand = Brand::where('id', $brandFilter)->firstOrFail();
                $survey->where([['brand_id', $brandFilter]]);
            }
            if($regionFilter != 'all'){

                $region = Region::where('id', $regionFilter)->firstOrFail();
                $survey->where([['region_id', $regionFilter]]);
            }

            if($restaurantFilter != 'all'){

                $store = Store::where('id', $restaurantFilter)->firstOrFail();
                $survey->where([['store_id', $restaurantFilter]]);
            }
        }])
        ->with(['stores' => function($store) use ($dateFrom, $dateTo, $brandFilter, $regionFilter, $restaurantFilter){
            $store->whereHas('surveys', function($survey) use ($dateFrom, $dateTo, $brandFilter, $regionFilter, $restaurantFilter){
                $survey->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
                if($brandFilter != 'all'){
                    $brand = Brand::where('id', $brandFilter)->firstOrFail();
                    $survey->where([['brand_id', $brandFilter]]);
                }
                if($regionFilter != 'all'){
    
                    $region = Region::where('id', $regionFilter)->firstOrFail();
                    $survey->where([['region_id', $regionFilter]]);
                }
    
                if($restaurantFilter != 'all'){
    
                    $store = Store::where('id', $restaurantFilter)->firstOrFail();
                    $survey->where([['store_id', $restaurantFilter]]);
                }
               
            })
            ->with(['surveys' => function($survey) use ($dateFrom, $dateTo, $brandFilter, $regionFilter, $restaurantFilter){
                $survey->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
                if($brandFilter != 'all'){
                    $brand = Brand::where('id', $brandFilter)->firstOrFail();
                    $survey->where([['brand_id', $brandFilter]]);
                }
                if($regionFilter != 'all'){
    
                    $region = Region::where('id', $regionFilter)->firstOrFail();
                    $survey->where([['region_id', $regionFilter]]);
                }
    
                if($restaurantFilter != 'all'){
    
                    $store = Store::where('id', $restaurantFilter)->firstOrFail();
                    $survey->where([['store_id', $restaurantFilter]]);
                }
            }])
            ->with(['surveyPointSum' => function($survey) use ($dateFrom, $dateTo, $brandFilter, $regionFilter, $restaurantFilter){
                $survey->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
                if($brandFilter != 'all'){
                    $brand = Brand::where('id', $brandFilter)->firstOrFail();
                    $survey->where([['brand_id', $brandFilter]]);
                }
                if($regionFilter != 'all'){
    
                    $region = Region::where('id', $regionFilter)->firstOrFail();
                    $survey->where([['region_id', $regionFilter]]);
                }
    
                if($restaurantFilter != 'all'){
                    $store = Store::where('id', $restaurantFilter)->firstOrFail();
                    $survey->where([['store_id', $restaurantFilter]]);
                }
            }]);
        }])
        ->get();

        // return $brandWithSurveys;
        
           //get question report by brand
        
        if(count($brandWithSurveys) == 0){
            self::info('No have report from' . $dateFrom . ' to ' . $dateTo);
            return redirect()->back();
        }
      
        foreach($brandWithSurveys as $key => $brand){
              
            foreach($brand->stores as $store){
                    foreach($store->surveys as $survey){
                        $brandSurvey[] = $survey->id;
                    }
               
            }
        }
            $groupQuestions = QuestionGroup::whereHas('questions') 
                ->with(['questions' => function($question) use ($brandSurvey, $key){
                    $question->where([
                       ['questionnaire_id', '=', 1]
                    ])
                    ->select('questions.id', 'questions.question_group_id', 'questions.questionnaire_id', 'questions.type')
                    ->with(['responses' => function($response) use($brandSurvey, $key){
                        $rawOrder = DB::raw(sprintf('FIELD(survey_id, %s)', implode(',', $brandSurvey)));
                        $response->whereIn('survey_id', $brandSurvey)->orderByRaw($rawOrder);
                    }]);
                }])
                ->get();

        
        $questionnaires = Questionnaire::all();
        $regions = Region::all();
        $brands = Brand::all();
        $cities = City::all();
        // return $brandWithSurveys;
       
        return view('backend.reports.monthlyReportShow', compact(['brandWithSurveys','questionnaireId', 'groupQuestions', 'answerType', 'questionnaires', 'dateFrom', 'dateTo', 'regionFilter', 'brandFilter', 'restaurantFilter', 'regions', 'brands', 'cities']));

    }

    public function invitementList(){
        
        
        $invites = UserStore::orderBy('id', 'desc')->paginate('20');
       
        $cities = City::all();
        return view('backend.invitement.show', compact(['invites', 'cities']));
    }

    public function invitementListFilter(Request $request){
    
        $storeId = $request->store;
        $status = $request->status;
        $cities = City::all();
        $date = explode("-", $request->date);
        $dateFrom =  Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[0]))->toDateString();
        $dateTo = Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[1]))->toDateString();

        $query = UserStore::query();
        if($status != 'all' && $status != 'notyet'){
            $query->where([['response_status', $status], ['confirmed', 1]]);
        }elseif($status == 'notyet'){
            $query->where([
                        ['response_status', 'waiting'], 
                        ['confirmed', 0]
                    ]);
        }
        if($storeId != 'all'){
            $query->whereJsonContains('stores', $storeId);
        }
        $query->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
        $invites = $query->get();

        return view('backend.invitement.showFilter', compact(['invites', 'dateFrom', 'dateTo', 'status', 'storeId', 'cities']));
    }

    public function brandReportYnShow(){

        $questionnaires = Questionnaire::all();
        $brands = Brand::all();
        $regions = Region::all();
        return view('backend.reports.brandReportYNShow', compact(['questionnaires', 'brands', 'regions']));
    }

    public function brandReportYnFilter(Request $request){

       
        $request->validate([
            'date'  =>  'required',
            'questionnaire' =>  'required',
            'brand'   =>  'required'
        ]);
        $brand_id = $request->brand;
        $regionFilter = $request->region;
        $date = explode("-", $request->date);
        $dateFrom =  Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[0]))->toDateString();
        $dateTo = Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[1]))->toDateString();
       
    
        $questionnaires = Questionnaire::all();
        $brands = Brand::all();
        $regions = Region::all();
        $questionnaireId = $request->questionnaire;
        
        
        $brandReport = Brand::where('id', $brand_id)->firstOrFail();
        $regionReport = [
            'id'    =>  0,
            'name'  => 'all'

        ];
        

        $query = Survey::query();
        $query->where('brand_id', $brand_id);
        if($regionFilter != 'all'){
            $query->where('region_id', $regionFilter);
            $regionReport = Region::where('id', $regionFilter)->firstOrFail();
        }
        $query->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
        $query->select('surveys.id', 'surveys.brand_id', 'surveys.region_id');
        $surveys = $query->get();
        


        // $surveys = Survey::where('brand_id', $brand_id)
        // ->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo])
        // ->select('surveys.id', 'surveys.brand_id')
        // ->get();
        
       
        $surveyIds = array();
        if(count($surveys) == 0){
            self::success('This brand has no response for this time');
            return redirect()->back();
        }
        foreach($surveys as $survey){
            $surveyIds[] = $survey->id;
        }
     

        $groupQuestions = QuestionGroup::whereHas('questions') 
        ->with(['questions' => function($question) use ($surveyIds){
            $question->where([
                ['questionnaire_id', '=', 1]
            ])
            ->select('questions.id', 'questions.question_group_id', 'questions.questionnaire_id', 'questions.type')
            ->with(['responseSum' => function($sum) use($surveyIds){
                $sum->whereIn('survey_id', $surveyIds);
            }]);
        }])
        ->get();
        // return $groupQuestions;
        return view('backend.reports.brandReportYN', compact(['questionnaires', 'questionnaireId', 'groupQuestions', 'brandReport', 'brands', 'dateFrom', 'dateTo', 'regions', 'regionFilter']));
    }

    public function registeredReport(){
        $questionnaires = Questionnaire::all();
     

        $users = User::whereHas('userRestaurents', function($user){
          
        })
        ->with('userRestaurents')
        ->get();
        $data = [];
        foreach($users as $key => $user){
            $data[$key]['user'] = $user;
            foreach($user->userRestaurents as $k => $userStore){
                $data[$key]['restaurants'][$k]['index'] = $userStore->id;
                $data[$key]['restaurants'][$k]['confirmed'] = $userStore->confirmed;
                $data[$key]['restaurants'][$k]['store_id'] = $userStore->store_id;
                $data[$key]['restaurants'][$k]['check_in'] = $userStore->check_in;
                $data[$key]['restaurants'][$k]['response_status'] = $userStore->response_status;
                $data[$key]['restaurants'][$k]['stores'] = $userStore->stores;
                $data[$key]['restaurants'][$k]['register_at'] = $userStore->created_at;
                foreach($userStore->stores as $s => $storeId){
    
                    $data[$key]['restaurants'][$k]['stores'][$s] = Store::where('id', $storeId)->firstOrFail();
    
                };   
            }
        }
        

        // return $data;
      
        return view('backend.reports.registeredReport', compact(['questionnaires', 'users', 'data']));
    }

    public function registeredReportDate(Request $request){
        $questionnaires = Questionnaire::all();

        $date = explode("-", $request->date);
        $dateFrom =  Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[0]))->toDateString();
        $dateTo = Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[1]))->toDateString();

   
        $users = User::whereHas('userRestaurents', function($user) use ($dateFrom, $dateTo){
            $user->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
        })
        ->with('userRestaurents')
        ->get();
        $data = [];
        foreach($users as $key => $user){
            $data[$key]['user'] = $user;
            foreach($user->userRestaurents as $k => $userStore){
                $data[$key]['restaurants'][$k]['index'] = $userStore->id;
                $data[$key]['restaurants'][$k]['confirmed'] = $userStore->confirmed;
                $data[$key]['restaurants'][$k]['store_id'] = $userStore->store_id;
                $data[$key]['restaurants'][$k]['check_in'] = $userStore->check_in;
                $data[$key]['restaurants'][$k]['response_status'] = $userStore->response_status;
                $data[$key]['restaurants'][$k]['stores'] = $userStore->stores;
                $data[$key]['restaurants'][$k]['register_at'] = $userStore->created_at;
                foreach($userStore->stores as $s => $storeId){
    
                    $data[$key]['restaurants'][$k]['stores'][$s] = Store::where('id', $storeId)->firstOrFail();
    
                }; 
            }
        }

        return view('backend.reports.registeredReportDate', compact(['questionnaires', 'users', 'data', 'dateFrom', 'dateTo']));
    }
    public function topRestaurantShow(){
        return view('backend.reports.showTopRestaurants');
    }
    public function topRestaurant(Request $request){
        $request->validate([
            'date'  =>  'required',
            'answer_type'   =>  'required',
        ]);
        $answerType = $request->answer_type;
        $date = explode("-", $request->date);
     
        $dateFrom =  Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[0]))->toDateString();
        $dateTo = Carbon::createFromFormat('d/m/Y', str_replace(' ', '', $date[1]))->toDateString();
       
        $restaurants = Store::whereHas('surveys', function($survey) use ($dateFrom, $dateTo, $answerType){
            $survey->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
        })
        ->join('surveys', function($join) use ($dateFrom, $dateTo, $answerType){
            $join->on('stores.id', '=', 'surveys.store_id')
                ->whereBetween(DB::raw('DATE(surveys.created_at)'), [$dateFrom, $dateTo]);

        })
        ->join('survey_responses', function($join) use ($answerType){
            $join->on('surveys.id', '=', 'survey_responses.survey_id')
              
                ->where('survey_responses.key', '=' , $answerType);          
        })
        ->selectRaw('stores.*, COUNT(survey_responses.survey_id) as resSum, survey_responses.key')
        ->groupBy('stores.id')
        ->orderBy('resSum', 'desc')
        ->take(10)
        ->get();


        return view('backend.reports.topRestaurants', compact(['restaurants', 'answerType', 'dateFrom', 'dateTo']));
    }
}

