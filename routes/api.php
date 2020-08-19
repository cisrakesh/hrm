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

Route::any('', 'ApiController@index');
Route::post('create-schedule', 'ApiController@createScheduleInterview');
Route::get('get-schedule/{id}', 'ApiController@getSchedule');
Route::post('create-feedback', 'ApiController@createFeedback');
