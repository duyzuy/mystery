<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');



Route::prefix('manage')->group(function () {

    //admin login form
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    //Admin register route
    Route::get('register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
    Route::post('register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');

    //admin logout 
    Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    //Admin middleware
    Route::middleware(['auth:admin'])->group(function () {

        Route::get('dashboard', 'AdminController@index')->name('manage.dashboard');

        Route::get('admin/resetpassword', 'Auth\ForgotPasswordController@resetpassword')->name('admin.resetpassword');
        Route::post('admin/resetpassword', 'Auth\ForgotPasswordController@updatePassword')->name('admin.password.update');
        //Homepage config
        Route::get('homecontent', 'SettingController@homepageIndex')->name('manage.homepage.index');
        Route::post('homecontent', 'SettingController@homepageStore')->name('manage.homepage.store');


        //slider
        Route::get('homepage/slider', 'SettingController@sliderIndex')->name('manage.slider.index');
        Route::post('homepage/slider', 'SettingController@sliderCreate')->name('manage.slider.create');
        Route::get('homepage/slider/{slider}/edit', 'SettingController@sliderEdit')->name('manage.slider.edit');
        Route::match(['PUT', 'PATCH'], 'homepage/slider/{slider}', 'SettingController@sliderUpdate')->name('manage.slider.update');

        Route::delete('homepage/slider/{id}', 'SettingController@sliderDelete')->name('manage.slider.delete');


        //city
        Route::get('cities', 'CitiesController@index')->name('manage.cities');
        Route::post('cities', 'CitiesController@store')->name('manage.city.store');
        Route::get('cities/{id}/edit', 'CitiesController@edit')->name('manage.city.edit');
        Route::match(['put', 'patch'], 'city/{id}', 'CitiesController@update')->name('manage.city.update');
        Route::delete('cities/{id}', 'CitiesController@destroy')->name('manage.city.delete');

        // Brand
        Route::resource('brands', 'BrandController', ['except' => ['brands.update', 'brands.index', 'brands.edit', 'brands.store']]);
        //store
        Route::resource('stores', 'StoreController', ['except' => ['stores.update', 'stores.index', 'stores.edit', 'stores.store']]);

        //user
        Route::get('users', 'AdminController@listAll')->name('manage.user.list');
        Route::get('user/{id}/edit', 'AdminController@edit')->name('manage.user.edit');
        Route::get('user/{id}/resetpassword', 'AdminController@showResetPassword')->name('manage.user.show.resetpassword');
        Route::post('user/{id}/resetpassword', 'AdminController@resetPassword')->name('manage.user.resetpassword');
        Route::match(['put', 'patch'], 'user/{id}', 'UserController@update')->name('manage.user.update');
        Route::get('user/{id}', 'AdminController@show')->name('manage.user.show');
        Route::get('user/{id}/reinvite', 'AdminController@reinvite')->name('manage.user.reinvite');
        Route::post('user/{id}/reinvite', 'AdminController@sendInvite')->name('manage.user.sendinvite');
        Route::post('approval/{id}/action/{action}', 'AdminController@approvalUser')->name('manage.user.approval');

        Route::get('user&status={status}', 'AdminController@filterUser')->name('manage.user.filter');
        Route::post('user/{user_id}/invite/{invite_id}/cancel', 'AdminController@cancelInvite')->name('manage.user.cancel.invite');
        Route::get('invitement', 'AdminController@invitementList')->name('manage.invitement.list');
        Route::post('invitement', 'AdminController@invitementListFilter')->name('manage.invitement.listFilter');


        //approveal user store
        Route::post('approval/user/{id}/index/{index}', 'AdminController@approvalUserStore')->name('manage.user.approval.store');

        //Questionnaires

        Route::get('questionnaire', 'QuestionnaireController@index')->name('manage.questionnaire.index');
        Route::get('questionnaire/{questionnaire_id}/edit', 'QuestionnaireController@edit')->name('manage.questionnaire.edit');
        Route::match(['put', 'patch'], 'questionnaire/{questionnaire_id}', 'QuestionnaireController@update')->name('manage.questionnaire.update');
        Route::post('questionnaire', 'QuestionnaireController@store')->name('manage.questionnaire.store');


        //Report
        Route::get('report/questionnaires', 'AdminController@questionnaireReport')->name('manage.questionnaire.report');
        Route::get('report/questionnaires/{questionnaire}/questions&filter={filter}', 'AdminController@questionsFilter')->name('manage.questionnaire.report.filter');

        Route::get('report/responses', 'AdminController@responses')->name('manage.survey.responses');
        Route::get('report/responses/{id}', 'AdminController@responsesDetail')->name('manage.survey.response.detail');
        Route::get('report/responses/edit/user/{userId}/survey/{surveyId}', 'AdminController@surveyEdit')->name('manage.survey.edit');
        Route::match(['put', 'patch'], 'report/responses/user/{userId}/survey/{surveyId}', 'AdminController@userSurveyUpdate')->name('manage.survey.update');
        Route::post('report/responses', 'AdminController@responseFilter')->name('manage.survey.response.filter');
        Route::post('report/questions', 'AdminController@questionsReportFilter')->name('manage.questions.report.filter');
        //export


        Route::get('user/export/exportList&user={status}', 'AdminController@exportExcel')->name('manage.user.export');
        Route::get('report/manage-report', 'AdminController@customReport')->name('manage.report');
        Route::post('report/manage-report/filter', 'AdminController@customReportFilter')->name('manage.report.filter.post');
        Route::post('report/manage-report/filter&q={questionnaireId}&from={dateFrom}&to={dateTo}', 'AdminController@customReportFilter')->name('manage.report.filter');
        Route::get('report/manage-report/detail/{surveyId}/', 'AdminController@reportDetail')->name('manage.report.detail');

        Route::get('export/monthly&qid={questionnaireId}&region={regionFilter}&brand={brandFilter}&restaurant={restaurantFilter}&df={dateFrom}&dt={dateTo}&at={answerType}', 'AdminExportController@monthlyExport')->name('manage.export.monthly');
        Route::get('export/response&resId={surveyId}', 'AdminExportController@responseExport')->name('manage.export.response');

        Route::get('report/guest-comment', 'AdminController@guestCommentReport')->name('manage.report.guestComment');
        Route::post('report/guest-comment', 'AdminController@guestCommentReportFilter')->name('manage.report.guestComment.filter');
        // Route::post('report/guest-comment/filter&q={questionnaireId}&b={brandId}&from={dateFrom}&to={dateTo}', 'AdminController@guestCommentReportFilter')->name('manage.report.guestComment.filter.date');

        Route::get('report/monthly-report', 'AdminController@monthlyReport')->name('manage.report.monthly');
        Route::post('report/monthly-report', 'AdminController@monthlyReportShow')->name('manage.report.monthly.show');

        Route::get('export/guest-comment/all', 'AdminExportController@guestCommentExportAll')->name('manage.export.guestcomment.all');
        Route::get('export/guest-comment&region={region}&brand={brand}&from={dateFrom}&to={dateTo}', 'AdminExportController@guestCommentExport')->name('manage.export.guestcomment');

        Route::get('report/brand-yn', 'AdminController@brandReportYnShow')->name('manage.report.brand.yn.show');
        Route::post('report/brand-yn', 'AdminController@brandReportYnFilter')->name('manage.report.brand.yn.filter');
        Route::get('export/brand-yn&region={region}&brand={brand}&from={dateFrom}&to={dateTo}', 'AdminExportController@brandYnExport')->name('manage.export.brandYn');
        Route::get('export/user-profile/{id}', 'AdminExportController@userProfileDetail')->name('manage.export.userprofile');
        Route::get('export/user-bill', 'AdminExportController@userAllBill')->name('manage.export.user.all.bill');
        Route::get('export/topquestion&questionnaire={questionnaire}&filter={filter}', 'AdminExportController@topQuestion')->name('manage.export.top.question');
        Route::get('export/registrations', 'AdminExportController@registrations')->name('manage.export.registrations');
        Route::get('export/registrations&from={dateFrom}&to={dateTo}', 'AdminExportController@registrationsDate')->name('manage.export.registrations.date');
        Route::get('export/userbill&region={regionId}&brand={brandId}&restaurant={restaurantId}&dFrom={dateFrom}&dTo={dateTo}', 'AdminExportController@userBillFilter')->name('manage.export.user.filter.bill');
        Route::get('export/questionsfilter&region={regionFilter}&brand={brandFilter}&restaurant={restaurantFilter}&dFrom={dateFrom}&dTo={dateTo}&type={answerType}', 'AdminExportController@questionsFilterExport')->name('manage.export.questions.filter');
        //Questions Group 
        Route::get('questiongroup', 'QuestionGroupsController@index')->name('manage.questiongroup.index');
        Route::post('questiongroup', 'QuestionGroupsController@store')->name('manage.questiongroup.store');
        Route::get('questiongroup/{group}/edit', 'QuestionGroupsController@edit')->name('manage.questiongroup.edit');
        Route::match(['PUT', 'PATCH'], 'questiongroup/{group}', 'QuestionGroupsController@update')->name('manage.questiongroup.update');
        Route::delete('questiongroup/{group}', 'QuestionGroupsController@destroy')->name('manage.questiongroup.delete');


        //Questions
        Route::get('questionnaire/{questionnaire_id}/questions/create', 'QuestionController@create')->name('manage.questions.create');
        Route::post('questionnaire/{questionnaire_id}/questions', 'QuestionController@store')->name('manage.questions.store');
        Route::get('questionnaire/{questionnaire_id}/questions', 'QuestionController@index')->name('manage.questions.index');
        Route::get('questionnaire/{questionnaire}/questions/{id}', 'QuestionController@show')->name('manage.questions.show');
        Route::get('questionnaire/{questionnaire}/questions/{id}/edit', 'QuestionController@edit')->name('manage.questions.edit');

        Route::match(['put', 'patch'], 'questionnaire/{questionnaire}/questions/{id}', 'QuestionController@update')->name('manage.questions.update');

        Route::get('top-store', 'AdminController@topStore')->name('manage.top.store');
        Route::get('report/registered', 'AdminController@registeredReport')->name('manage.registered.report');
        Route::post('report/registered', 'AdminController@registeredReportDate')->name('manage.registered.date.report');
        Route::get('report/top-restaurant', 'AdminController@topRestaurantShow')->name('manage.top.restaurant.show');
        Route::post('report/top-resturant', 'AdminController@topRestaurant')->name('manage.top.restaurant');
        Route::get('export/top-restaurant&dFrom={dateFrom}&dTo={dateTo}&type={answerType}', 'AdminExportController@topRestaurant')->name('manage.export.top.restaurant');
    });
});

Route::redirect('/', '/vi');

// Route::get('/clear-cache-all', function () {
//     Artisan::call('cache:clear');

//     dd("Cache Clear All");
// });
// Route::get('/view-clear', function () {
//     $exitCode = Artisan::call('view:clear');
//     return 'View cache cleared';
// });

Route::group(['prefix' => '{language}'], function () {

    Route::middleware(['language'])->group(function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('home');


        Route::prefix('user')->group(function () {
            //user Login
            Route::get('login', 'Auth\UserLoginController@showLoginForm')->name('user.login');
            Route::post('login', 'Auth\UserLoginController@login')->name('user.login.submit');

            //user register
            Route::get('register', 'Auth\UserRegisterController@showRegisterForm')->name('user.register');
            Route::post('register', 'Auth\UserRegisterController@register')->name('user.register.submit');

            //user logout 
            Route::post('logout', 'Auth\UserLoginController@logout')->name('user.logout');
        });

        Route::middleware(['auth:web'])->group(function () {

            Route::middleware(['approved'])->group(function () {
                // Route::get('survey', 'UserController@survey')->name('user.survey');
                // Route::get('survey/{id}-{slug}/{index}', 'UserController@surveyDetail')->name('user.survey.detail');

                // Route::post('survey/{id}-{slug}/{index}', 'UserController@store')->name('user.survey.store');


            });
            Route::get('survey/{id}-{slug}/{index}', 'UserController@surveyDetail')->name('user.survey.detail');

            Route::post('survey/{id}-{slug}/{index}', 'UserController@store')->name('user.survey.store');

            Route::get('profile', 'UserController@getProfile')->name('user.profile');

            Route::post('profile/newregistration', 'UserController@registrationNew')->name('user.profile.registration');
        });

        Route::get('user-confirm&token={token}', 'UserController@userConfirmation')->name('user.page.confirmation');
        Route::post('user-confirm&token={token}', 'UserController@userResponseEmail')->name('user.made.confirmation');

        Route::get('thank-you&token={token}', 'Auth\UserRegisterController@thankyou')->name('user.thankyou');
    });
});
