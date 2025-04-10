<?php

namespace App\Http\Controllers;

use App\City;
use App\User;
use App\Brand;
use App\Store;
use App\Region;
use App\Survey;
use App\Question;
use App\UserStore;
use App\QuestionGroup;
use App\Questionnaire;
use App\SignupResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\topQuestionView;
use App\Exports\UserAllBillView;
use App\Components\FlashMessages;
use App\Exports\BrandReportYnView;
use App\Exports\MonthlyReportView;
use App\Exports\topRestaurantView;
use Illuminate\Support\Facades\DB;
use App\Exports\ResponseExportView;
use App\Exports\userBillFilterView;
use App\Exports\questionsFilterView;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserProfileDetailView;
use App\Exports\GuestCommentReportView;
use App\Exports\RegistrationReportView;


class AdminExportController extends Controller
{
    use FlashMessages;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function monthlyExport($questionnaireId, $regionFilter, $brandFilter, $restaurantFilter, $dateFrom, $dateTo, $answerType)
    {

        $brandName = 'all';
        $regionName = 'all';
        $restaurantName = 'all';
        if ($regionFilter != 'all') {

            $region = Region::where('id', $regionFilter)->firstOrFail();
            $regionName = $region->name;
        }

        if ($brandFilter != 'all') {

            $brand = Brand::where('id', $brandFilter)->firstOrFail();
            $brandName = $brand->name;
        }
        if ($restaurantFilter != 'all') {

            $restaurant = Store::where('id', $restaurantFilter)->firstOrFail();
            $restaurantName = $restaurant->translate()->store_name;
        }



        $brandWithSurveys = Brand::whereHas('surveys', function ($survey) use ($dateFrom, $dateTo, $brandFilter, $regionFilter, $restaurantFilter) {
            $survey->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
            if ($brandFilter != 'all') {
                $brand = Brand::where('id', $brandFilter)->firstOrFail();
                $survey->where([['brand_id', $brandFilter]]);
            }
            if ($regionFilter != 'all') {

                $region = Region::where('id', $regionFilter)->firstOrFail();
                $survey->where([['region_id', $regionFilter]]);
            }

            if ($restaurantFilter != 'all') {

                $store = Store::where('id', $restaurantFilter)->firstOrFail();
                $survey->where([['store_id', $restaurantFilter]]);
            }
        })->with(['surveys' => function ($survey) use ($dateFrom, $dateTo, $brandFilter, $regionFilter, $restaurantFilter) {
            $survey->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
            if ($brandFilter != 'all') {
                $brand = Brand::where('id', $brandFilter)->firstOrFail();
                $survey->where([['brand_id', $brandFilter]]);
            }
            if ($regionFilter != 'all') {

                $region = Region::where('id', $regionFilter)->firstOrFail();
                $survey->where([['region_id', $regionFilter]]);
            }

            if ($restaurantFilter != 'all') {

                $store = Store::where('id', $restaurantFilter)->firstOrFail();
                $survey->where([['store_id', $restaurantFilter]]);
            }
        }])
            ->with(['stores' => function ($store) use ($dateFrom, $dateTo, $brandFilter, $regionFilter, $restaurantFilter) {
                $store->whereHas('surveys', function ($survey) use ($dateFrom, $dateTo, $brandFilter, $regionFilter, $restaurantFilter) {
                    $survey->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
                    if ($brandFilter != 'all') {
                        $brand = Brand::where('id', $brandFilter)->firstOrFail();
                        $survey->where([['brand_id', $brandFilter]]);
                    }
                    if ($regionFilter != 'all') {

                        $region = Region::where('id', $regionFilter)->firstOrFail();
                        $survey->where([['region_id', $regionFilter]]);
                    }

                    if ($restaurantFilter != 'all') {

                        $store = Store::where('id', $restaurantFilter)->firstOrFail();
                        $survey->where([['store_id', $restaurantFilter]]);
                    }
                })
                    ->with(['surveys' => function ($survey) use ($dateFrom, $dateTo, $brandFilter, $regionFilter, $restaurantFilter) {
                        $survey->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
                        if ($brandFilter != 'all') {
                            $brand = Brand::where('id', $brandFilter)->firstOrFail();
                            $survey->where([['brand_id', $brandFilter]]);
                        }
                        if ($regionFilter != 'all') {

                            $region = Region::where('id', $regionFilter)->firstOrFail();
                            $survey->where([['region_id', $regionFilter]]);
                        }

                        if ($restaurantFilter != 'all') {

                            $store = Store::where('id', $restaurantFilter)->firstOrFail();
                            $survey->where([['store_id', $restaurantFilter]]);
                        }
                    }])
                    ->with(['surveyPointSum' => function ($survey) use ($dateFrom, $dateTo, $brandFilter, $regionFilter, $restaurantFilter) {
                        $survey->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
                        if ($brandFilter != 'all') {
                            $brand = Brand::where('id', $brandFilter)->firstOrFail();
                            $survey->where([['brand_id', $brandFilter]]);
                        }
                        if ($regionFilter != 'all') {

                            $region = Region::where('id', $regionFilter)->firstOrFail();
                            $survey->where([['region_id', $regionFilter]]);
                        }

                        if ($restaurantFilter != 'all') {
                            $store = Store::where('id', $restaurantFilter)->firstOrFail();
                            $survey->where([['store_id', $restaurantFilter]]);
                        }
                    }]);
            }])
            ->get();

        foreach ($brandWithSurveys as $key => $brand) {

            foreach ($brand->surveys as $survey) {
                $brandSurvey[] = $survey->id;
            }
        }
        $groupQuestions = QuestionGroup::whereHas('questions')
            ->with(['questions' => function ($question) use ($brandSurvey, $key) {
                $question->where([
                    ['questionnaire_id', '=', 1]
                ])
                    ->select('questions.id', 'questions.question_group_id', 'questions.questionnaire_id', 'questions.type')
                    ->with(['responses' => function ($response) use ($brandSurvey, $key) {
                        $rawOrder = DB::raw(sprintf('FIELD(survey_id, %s)', implode(',', $brandSurvey)));
                        $response->whereIn('survey_id', $brandSurvey)->orderByRaw($rawOrder);
                    }]);
            }])
            ->get();


        return Excel::download(new MonthlyReportView("backend.exports.monthly", $brandWithSurveys, $groupQuestions, $answerType, $regionName, $brandName, $restaurantName, $dateFrom, $dateTo), $dateFrom . $dateTo . $answerType . '.xlsx');
    }

    public function responseExport($surveyId)
    {

        $groupQuestions = QuestionGroup::whereHas('questions')
            ->with(['questions' => function ($question) use ($surveyId) {
                $question->where([
                    ['questionnaire_id', '=', 1]
                ])
                    ->select('questions.id', 'questions.question_group_id', 'questions.questionnaire_id', 'questions.type')
                    ->with(['questionMaxPoint'])
                    ->with(['responses' => function ($response) use ($surveyId) {
                        $response->where('survey_id', $surveyId);
                    }]);
            }])
            ->get();


        $survey = Survey::where('id', $surveyId)->firstOrFail();

        return Excel::download(new ResponseExportView("backend.exports.response", $groupQuestions, $survey), $survey->user->name . '.xlsx');
    }

    public function guestCommentExportAll()
    {

        $surveys = Survey::orderBy('id', 'desc')->get();
        return Excel::download(new GuestCommentReportView("backend.exports.guestComment", $surveys), 'guest-comment-all.xlsx');
    }
    public function guestCommentExport($region, $brand, $dateFrom, $dateTo)
    {

        $query = Survey::query();

        if ($brand != 'all') {
            $query->where('brand_id', $brand);
        }
        if ($region != 'all') {
            $query->where('region_id', $region);
        }
        $query->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
        $surveys =  $query->get();


        return Excel::download(new GuestCommentReportView("backend.exports.guestComment", $surveys), $dateFrom . '-' . $dateTo . '-guest-comment.xlsx');
    }

    public function brandYnExport($region, $brand, $dateFrom, $dateTo)
    {


        $brandReport = Brand::where('id', $brand)->firstOrFail();


        $query = Survey::query();
        $query->where('brand_id', $brand);
        if ($region != 'all') {
            $query->where('region_id', $region);
        }
        $query->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
        $query->select('surveys.id', 'surveys.brand_id', 'surveys.region_id');
        $surveys = $query->get();

        $surveyIds = array();
        foreach ($surveys as $survey) {
            $surveyIds[] = $survey->id;
        }

        $groupQuestions = QuestionGroup::whereHas('questions')
            ->with(['questions' => function ($question) use ($surveyIds) {
                $question->where([
                    ['questionnaire_id', '=', 1]
                ])
                    ->select('questions.id', 'questions.question_group_id', 'questions.questionnaire_id', 'questions.type')
                    ->with(['responseSum' => function ($sum) use ($surveyIds) {
                        $sum->whereIn('survey_id', $surveyIds);
                    }]);
            }])
            ->get();

        return Excel::download(new BrandReportYnView("backend.exports.brandYn", $brandReport, $groupQuestions, $dateFrom, $dateTo), $brandReport->name . '-' . $dateFrom . '-' . $dateTo . '-guest-comment.xlsx');
    }


    public function userProfileDetail($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $userStores = UserStore::where('user_id', $id)->get();
        $signUpRespponses = SignupResponse::where('user_id', $id)->get();
        $storeRegistrations = [];
        foreach ($userStores as $k => $userStore) {

            $storeRegistrations[$k]['index'] = $userStore->id;
            $storeRegistrations[$k]['confirmed'] = $userStore->confirmed;
            $storeRegistrations[$k]['store_id'] = $userStore->store_id;
            $storeRegistrations[$k]['check_in'] = $userStore->check_in;
            $storeRegistrations[$k]['response_status'] = $userStore->response_status;
            $storeRegistrations[$k]['stores'] = $userStore->stores;
            $storeRegistrations[$k]['register_at'] = $userStore->created_at;
            foreach ($userStore->stores as $key => $storeId) {

                $storeRegistrations[$k]['stores'][$key] = Store::where('id', $storeId)->firstOrFail();
            }
        }

        return Excel::download(new UserProfileDetailView("backend.exports.userProfileDetail", $user, $storeRegistrations, $signUpRespponses), $user->name . '.xlsx');
    }
    public function userAllBill()
    {
        $surveys = Survey::all();
        $surveys->load("user");

        return Excel::download(new UserAllBillView("backend.exports.userAllBill", $surveys), 'all-bill.xlsx');
    }

    public function topQuestion($questionnaire, $filter)
    {

        $questions = Question::where('questionnaire_id', $questionnaire)
            ->join('survey_responses', function ($join) use ($filter) {
                $join->on('questions.id', '=', 'survey_responses.question_id')
                    ->where('survey_responses.key', '=', $filter);
            })
            ->selectRaw('questions.*, COUNT(survey_responses.question_id) as resSum, survey_responses.key')
            ->groupBy('questions.id')
            ->orderBy('resSum', 'desc')->get();

        return Excel::download(new topQuestionView("backend.exports.topQuestion", $questions, $filter), 'top-question-by-' . $filter . '.xlsx');
    }

    public function registrations()
    {

        $questionnaires = Questionnaire::all();


        $users = User::whereHas('userRestaurents', function ($user) {})
            ->with('userRestaurents')
            ->get();
        $data = [];
        foreach ($users as $key => $user) {
            $data[$key]['user'] = $user;
            foreach ($user->userRestaurents as $k => $userStore) {
                $data[$key]['restaurants'][$k]['index'] = $userStore->id;
                $data[$key]['restaurants'][$k]['confirmed'] = $userStore->confirmed;
                $data[$key]['restaurants'][$k]['store_id'] = $userStore->store_id;
                $data[$key]['restaurants'][$k]['check_in'] = $userStore->check_in;
                $data[$key]['restaurants'][$k]['response_status'] = $userStore->response_status;
                $data[$key]['restaurants'][$k]['stores'] = $userStore->stores;
                $data[$key]['restaurants'][$k]['register_at'] = $userStore->created_at;
                foreach ($userStore->stores as $s => $storeId) {

                    $data[$key]['restaurants'][$k]['stores'][$s] = Store::where('id', $storeId)->firstOrFail();
                };
            }
        }
        return Excel::download(new RegistrationReportView("backend.exports.registrations", $data), 'allRegistrations.xlsx');
    }
    public function registrationsDate($dateFrom, $dateTo)
    {

        $questionnaires = Questionnaire::all();
        $users = User::whereHas('userRestaurents', function ($user) use ($dateFrom, $dateTo) {
            $user->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
        })
            ->with('userRestaurents')
            ->get();
        $data = [];
        foreach ($users as $key => $user) {
            $data[$key]['user'] = $user;
            foreach ($user->userRestaurents as $k => $userStore) {
                $data[$key]['restaurants'][$k]['index'] = $userStore->id;
                $data[$key]['restaurants'][$k]['confirmed'] = $userStore->confirmed;
                $data[$key]['restaurants'][$k]['store_id'] = $userStore->store_id;
                $data[$key]['restaurants'][$k]['check_in'] = $userStore->check_in;
                $data[$key]['restaurants'][$k]['response_status'] = $userStore->response_status;
                $data[$key]['restaurants'][$k]['stores'] = $userStore->stores;
                $data[$key]['restaurants'][$k]['register_at'] = $userStore->created_at;
                foreach ($userStore->stores as $s => $storeId) {

                    $data[$key]['restaurants'][$k]['stores'][$s] = Store::where('id', $storeId)->firstOrFail();
                };
            }
        }

        return Excel::download(new RegistrationReportView("backend.exports.registrations", $data), 'registration' . $dateFrom . $dateTo . '.xlsx');
    }

    public function topRestaurant($dateFrom, $dateTo, $answerType)
    {



        $restaurants = Store::whereHas('surveys', function ($survey) use ($dateFrom, $dateTo, $answerType) {
            $survey->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
        })
            ->join('surveys', function ($join) use ($dateFrom, $dateTo, $answerType) {
                $join->on('stores.id', '=', 'surveys.store_id')
                    ->whereBetween(DB::raw('DATE(surveys.created_at)'), [$dateFrom, $dateTo]);
            })
            ->join('survey_responses', function ($join) use ($answerType) {
                $join->on('surveys.id', '=', 'survey_responses.survey_id')

                    ->where('survey_responses.key', '=', $answerType);
            })
            ->selectRaw('stores.*, COUNT(survey_responses.survey_id) as resSum, survey_responses.key')
            ->groupBy('stores.id')
            ->orderBy('resSum', 'desc')
            ->take(10)
            ->get();


        return Excel::download(new topRestaurantView("backend.exports.topRestaurants", $restaurants, $answerType, $dateFrom, $dateTo), 'toprestaurant-say' . $answerType . '.xlsx');
    }

    public function userBillFilter($regionId, $brandId, $restaurantId, $dateFrom, $dateTo)
    {

        $brandName = 'all';
        $regionName = 'all';
        $restaurantName = 'all';

        $query = Survey::query();
        if ($regionId != 'all') {
            $query->where('region_id', $regionId);
            $region = Region::where('id', $regionId)->firstOrFail();
            $regionName = $region->name;
        }

        if ($brandId != 'all') {
            $query->where('brand_id', $brandId);
            $brand = Brand::where('id', $brandId)->firstOrFail();
            $brandName = $brand->name;
        }

        if ($restaurantId != 'all') {
            $query->where('store_id', $restaurantId);
            $restaurant = Store::where('id', $restaurantId)->firstOrFail();

            $restaurantName = $restaurant->translate()->store_name;
        }

        $query->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
        $surveys = $query->get();

        return Excel::download(new userBillFilterView("backend.exports.userBillFilter", $surveys, $regionName, $brandName, $restaurantName, $dateFrom, $dateTo), 'userBill-' . $regionName . '.xlsx');
    }

    public function questionsFilterExport($regionFilter, $brandFilter, $restaurantFilter, $dateFrom, $dateTo, $answerType)
    {

        $brandName = 'all';
        $regionName = 'all';
        $restaurantName = 'all';

        $query = Survey::query();
        if ($regionFilter != 'all') {
            $query->where('region_id', $regionFilter);
            $region = Region::where('id', $regionFilter)->firstOrFail();
            $regionName = $region->name;
        }

        if ($brandFilter != 'all') {
            $query->where('brand_id', $brandFilter);
            $brand = Brand::where('id', $brandFilter)->firstOrFail();
            $brandName = $brand->name;
        }

        if ($restaurantFilter != 'all') {
            $query->where('store_id', $restaurantFilter);
            $restaurant = Store::where('id', $restaurantFilter)->firstOrFail();
            $restaurantName = $restaurant->translate()->store_name;
        }

        $query->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);
        $surveys = $query->select('id')->get();

        $surveyId = array();
        foreach ($surveys as $survey) {
            $surveyId[] = $survey->id;
        }

        $questions = Question::where('questionnaire_id', 1)
            ->join('survey_responses', function ($join) use ($surveyId, $answerType) {

                $join->on('questions.id', '=', 'survey_responses.question_id')
                    ->whereIn('survey_responses.survey_id', $surveyId)
                    ->where('survey_responses.key', '=', $answerType);
            })
            ->selectRaw('questions.*, COUNT(survey_responses.question_id) as resSum, survey_responses.key')
            ->groupBy('questions.id')
            ->orderBy('resSum', 'desc')->get();
        $questionnaire = Questionnaire::where('id', 1)->firstOrFail();
        $questionnaireName = $questionnaire->translate('en')->title;

        return Excel::download(new questionsFilterView("backend.exports.questionsFilter", $questionnaireName, $questions, $regionName, $brandName, $restaurantName, $dateFrom, $dateTo, $answerType), 'topquestion-' . $regionName . '.xlsx');
    }
}
