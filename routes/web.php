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

// 上映作品スケジュール
Route::get('/', 'SchedulesController@index')->name('schedules.index');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function() {
    // 作品情報登録
    Route::resource('movies', 'MoviesController', ['only'=>['create', 'store']]);
    // 上映スケジュール登録
    Route::resource('schedules', 'SchedulesController', ['only'=>['create', 'store']]);
    
    Route::group(['prefix'=>'reserves'], function() {
        // 予約(枚数選択)
        Route::get('count', 'ReservesController@showTicketCountForm') -> name('count.show');
        Route::get('select', 'ReservesController@showTicketSelectForm') -> name('select.show');
        Route::get('confirm', 'ReservesController@showTicketConfirmForm') -> name('confirm.show');
        Route::post('/', 'ReservesController@store') -> name('reserves.store');
    });
});

// 上映作品一覧
Route::get('movies', 'MoviesController@index')->name('movies.index');
// 映画館情報
Route::get('theaters/{id}', 'TheatersController@show')->name('theaters.show');
// 料金
Route::get('tickets/{id}', 'TicketsController@show')->name('tickets.show');
