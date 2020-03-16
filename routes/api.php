<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login','ApiController@login');
Route::post('get_schedule_today','ApiController@get_schedule_today');

Route::post('get_schedule_week','ApiController@get_schedule_week');
Route::post('get_schedule','ApiController@get_schedule');

Route::post('notification','ApiController@notification');

Route::post('cancel_schedule','ApiController@cancle_schedule');

Route::post('update_firebase_token','ApiController@update_firebase_token');

Route::post('update_image','ApiController@update_image');

Route::post('update_profile','ApiController@update_profile');
Route::post('nurse_start','ApiController@nurse_start');
Route::post('nurse_finish','ApiController@nurse_finish');

Route::post('nurse_current_distance_update','ApiController@nurse_current_distance_update');

Route::post('get_status','ApiController@get_status');

Route::post('submit_nurse_form','ApiController@submit_nurse_form');

Route::post('submit_nurse_form_not_available','ApiController@submit_nurse_form_not_available');

