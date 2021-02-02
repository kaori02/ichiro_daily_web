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

Auth::routes(['register' => false, 'reset' => false, 'confirm' => false]);

Route::get('/', 'PagesController@index');
Route::get('/achievement', 'PagesController@achievement');
Route::get('/contact', 'PagesController@contact');
Route::get('/research', 'PagesController@research');
Route::get('/robots', 'PagesController@robots');
Route::get('/sponsors', 'PagesController@sponsors');
Route::get('/teams', 'PagesController@teams');

// Route::get('{path}', 'HomeController@index')->where('path', '([A-z\/_.\d-]+)?');
Route::get('/home', 'HomeController@index');
Route::get('/dashboard', 'HomeController@index');
Route::get('/calendar', 'HomeController@index');
Route::get('/reports', 'HomeController@index');
