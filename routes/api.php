<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('cityList', 'Api\CityController@cityList')->name('api.city.list');
Route::get('brandList', 'Api\CityController@brandList')->name('api.brand.list');
Route::get('restaurentList', 'Api\CityController@restaurentList')->name('api.restaurent.list');
Route::get('restaurantCode', 'Api\CityController@restaurantCode')->name('api.restaurant.code');
Route::get('restaurant/check&code={code}', 'Api\CityController@checkRestaurantCode')->name('api.restaurant.code.check');

Route::get('invitement&inviteId={id}', 'Api\InvitementController@invitementById')->name('api.invitement');
Route::post('invitement', 'Api\InvitementController@invitementConfirm')->name('api.invitement.confirm');