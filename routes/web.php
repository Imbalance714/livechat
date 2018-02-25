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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@getUser');

Route::get('profile', 'UserController@index')->name('profile');
Route::post('profile', 'UserController@edit')->name('profile');

Route::get('rooms', 'RoomsController@index')->name('rooms');

Route::get('messages', 'ChatController@getAllMessages')->name('messages');
Route::get('online-users', 'ChatController@getOnlineUsers')->name('messages');