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
    return view('welcome');
});

//Auth::routes();
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/redirect', 'SocialAuthTwitterController@redirect');
Route::get('/callback', 'SocialAuthTwitterController@callback');
Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('location')->group(function () {
    Route::get('/', 'LocationController@index');
    Route::get('create', 'LocationController@create');
    Route::post('store', 'LocationController@store');
    Route::get('{location}/edit', 'LocationController@edit');
    Route::post('update/{location}', 'LocationController@update');
    Route::delete('delete/{location}', 'LocationController@destroy');
});


Route::prefix('ticket')->group(function () {
    Route::get('/', 'TicketController@index');
    Route::get('create', 'TicketController@create');
    Route::post('store', 'TicketController@store');
    Route::get('{ticket}/edit', 'TicketController@edit');
    Route::post('update/{ticket}', 'TicketController@update');
    Route::delete('delete/{ticket}', 'TicketController@destroy');
});

Route::prefix('event')->group(function () {
    Route::get('/', 'EventController@index');
    Route::get('create', 'EventController@create');
    Route::post('store', 'EventController@store');
    Route::get('{event}/edit', 'EventController@edit');
    Route::post('update/{event}', 'EventController@update');
    Route::get('show/{event}', 'EventController@show');
    Route::delete('delete/{event}', 'EventController@destroy');
    Route::get('post-twitter/{event}', 'EventController@postTwitter');
    Route::get('detail/{event}','DetailEventController@show');
});