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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('report', 'API\ReportController');
Route::apiResource('official_report', 'API\OfficialReportController');
Route::apiResource('mechanic_report', 'API\MechanicReportController');
Route::apiResource('electronic_report', 'API\ElectronicReportController');
Route::apiResource('programming_report', 'API\ProgrammingReportController');
