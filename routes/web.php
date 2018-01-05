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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Auth\LoginController@showLogin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/** ============= Authentication ============= */
Route::group(['middleware' => 'web'], function() {
    Route::get('/auth/login', 'Auth\LoginController@showLogin');

    Route::post('/auth/signin', 'Auth\LoginController@doLogin');

    Route::get('/auth/logout', 'Auth\LoginController@doLogout');

    Route::get('/auth/register', 'Auth\RegisterController@register');

    Route::post('/auth/signup', 'Auth\RegisterController@create');
});

Route::group(['middleware' => ['web','auth']], function () {

    Route::get('/drape/list', 'VehicleController@index');

    Route::get('/drape/new', 'DriverController@index');
    

    Route::get('/reserve/new', 'ReservationController@create');

    Route::post('/reserve/add', 'ReservationController@store');

    Route::get('/reserve/list', 'ReservationController@index');

    Route::get('/reserve/cancel', 'ReservationController@cancel');

    Route::get('/reserve/calendar', 'ReservationController@calendar');

    Route::get('/reserve/ajaxcalendar/{sdate}/{edate}', 'ReservationController@ajaxcalendar');


    Route::get('/ajaxperson/{name}', 'UserController@ajaxperson');


    Route::get('/daily/received/list', 'DailyController@receivedlist');

    Route::get('/daily/received/form', 'DailyController@receivedform');

    Route::post('/daily/received/add', 'DailyController@receivedadd');


    Route::get('/daily/sentout/list', 'DailyController@sentoutlist');

    Route::get('/daily/sentout/form', 'DailyController@sentoutform');

    Route::post('/daily/sentout/add', 'DailyController@sentoutadd');


    Route::get('/daily/sentin/list', 'DailyController@sentinlist');

    Route::get('/daily/sentin/form', 'DailyController@sentinform');

    Route::post('/daily/sentin/add', 'DailyController@sentinadd');
});
