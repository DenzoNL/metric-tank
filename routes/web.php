<?php

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/metrics/data', 'MetricController@getData');

Route::get('games/data', 'GameController@getData');
Route::resource('games', 'GameController');

Route::get('categories/data', 'MetricCategoryController@getData');
Route::resource('categories', 'MetricCategoryController');

Route::get('platforms/data', 'PlatformController@getData');
Route::resource('platforms', 'PlatformController');