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

    Route::get('/drape/list', 'DrapeController@index');
    Route::get('/drape/gen/list', 'DrapeController@genlist');
    Route::get('/drape/vip/list', 'DrapeController@viplist');
    Route::get('/drape/baby/list', 'DrapeController@babylist');
    Route::get('/drape/or/list', 'DrapeController@orlist');
    Route::get('/drape/lr/list', 'DrapeController@lrlist');
    Route::get('/drape/den/list', 'DrapeController@denlist');
    Route::get('/drape/sup/list', 'DrapeController@suplist');
    Route::get('/drape/off/list', 'DrapeController@offlist');
    Route::get('/drape/bag/list', 'DrapeController@baglist');
    Route::get('/drape/oth/list', 'DrapeController@othlist');
    

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
    Route::get('/daily/sentout/edit/{id}', 'DailyController@sentoutEdit');
    Route::post('/daily/sentout/update', 'DailyController@sentoutUpdate');
    Route::post('/daily/sentout/ajaxpostdetailitems', 'DailyController@ajaxpostdetailitems');


    Route::get('/daily/sentin/list', 'DailyController@sentinlist');
    Route::get('/daily/sentin/form', 'DailyController@sentinform');
    Route::get('/daily/sentin/form2/{id}', 'DailyController@sentinform2');
    Route::get('/daily/sentin/stock', 'DailyController@sentinstock');
    Route::post('/daily/sentin/add', 'DailyController@sentinadd');
    Route::post('/daily/sentin/add2', 'DailyController@sentinadd2');
    
    // OR
    Route::get('/daily/setdrape/list', 'DailyController@setdrapelist');
    Route::get('/daily/setdrape/form', 'DailyController@setdrapeform'); //ส่งเบิกเซต
    Route::post('/daily/setdrape/add', 'DailyController@setdrapeadd');
    Route::get('/daily/setdrape/form2/{_stock}/{id}', 'DailyController@setdrapeform2'); //จ่ายเซต
    Route::post('/daily/setdrape/add2', 'DailyController@setdrapeadd2');
    // LR
    Route::get('/daily/setdrape/list', 'DailyController@setdrapelist');
    Route::get('/daily/setdrape/form', 'DailyController@setdrapeform'); //ส่งเบิกเซต
    Route::post('/daily/setdrape/add', 'DailyController@setdrapeadd');
    Route::get('/daily/setdrape/form2/{stock}/{id}/{isnew}', 'DailyController@setdrapeform2'); //จ่ายเซต
    Route::post('/daily/setdrape/dispense1', 'DailyController@setdrapedispense1');
    Route::post('/daily/setdrape/dispense2', 'DailyController@setdrapedispense2');
    // Route::post('/daily/setdrape/update', 'DailyController@setdrapeupdate');


    Route::get('/drape/ajaxdrape', 'DrapeController@ajaxdrape');
    Route::get('/drape/ajaxdrapeforstock/{substock}', 'DrapeController@ajaxdrapeforstock');

    
    Route::get('/set/ajaxsetforstock/{substock}', 'SetController@ajaxsetforstock');
    
    // Service
    Route::get('/service/or', 'ServiceController@orperday');
    Route::get('/service/ip/{_day}', 'ServiceController@ipperday');

    // Stock card
    Route::get('/stock/gen/list/{drape}', 'StockController@genlist');
    Route::get('/stock/or/list/{drape}', 'StockController@orlist');
});
