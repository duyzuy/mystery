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



Route::prefix('manage')->group(function() {

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

        //store
        Route::resource('stores', 'StoreController');

        //user
        Route::get('users', 'AdminController@listAll')->name('manage.user.list');
        Route::get('user/{id}/edit', 'AdminController@edit')->name('manage.user.edit');
        Route::match(['put', 'patch'], 'user/{id}', 'UserController@update')->name('manage.user.update');
        Route::get('user/{id}', 'AdminController@show')->name('manage.user.show');
        Route::post('approval/{id}/action/{action}', 'AdminController@approvalUser')->name('manage.user.approval');

        Route::get('user&status={status}', 'AdminController@filterUser')->name('manage.user.filter');

        //Questionnaires

        Route::get('questionnaire', 'QuestionnaireController@index')->name('manage.questionnaire.index');
        Route::get('questionnaire/{questionnaire_id}/edit', 'QuestionnaireController@edit')->name('manage.questionnaire.edit');
        Route::match(['put', 'patch'], 'questionnaire/{questionnaire_id}', 'QuestionnaireController@update')->name('manage.questionnaire.update');
        Route::post('questionnaire', 'QuestionnaireController@store')->name('manage.questionnaire.store');


        //Report
        Route::get('report/questionnaires', 'AdminController@questionnaireReport')->name('manage.questionnaire.report');
        

        //export


        Route::get('user/export/exportList&user={status}', 'AdminController@exportExcel')->name('manage.user.export');



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
    });
   



});

Route::redirect('/', '/mystery/vi');

Route::group(['prefix' => '{language}'], function (){

    Route::middleware(['language'])->group(function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('home');

        Route::prefix('user')->group(function(){
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
                Route::get('survey/{id}-{slug}', 'UserController@surveyDetail')->name('user.survey.detail');

                Route::post('survey/{id}-{slug}', 'UserController@store')->name('user.survey.store');

               
            });

            Route::get('profile', 'UserController@getProfile')->name('user.profile');

        });

        Route::get('thank-you&token={token}', 'Auth\UserRegisterController@thankyou')->name('user.thankyou');
    });
});