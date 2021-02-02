<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Calendar;
use App\Http\Resources\CalendarResource;

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

Route::apiResource('report', 'API\ReportController');
Route::get('official_report', 'API\ReportController@official');
Route::get('mechanic_report', 'API\ReportController@mechanic');
Route::get('electronic_report', 'API\ReportController@electronic');
Route::get('programming_report', 'API\ReportController@programming');

Route::apiResource('calendar', 'API\CalendarController');
// Route::get('/calendar', function(){
//     return new CalendarResource(Calendar::all());
// });