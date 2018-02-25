<?php

use Illuminate\Http\Request;

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

//Route::get('', 'MainPageController@getIndex');
//Route::post('auth', 'LoginController');
//Route::post('register', 'RegisterController');

//Route::middleware('auth:api')->group(function () {
//
//    Route::prefix('chat')->group(function () {
//        Route::get('rooms', 'ChatController@getRooms');
//        Route::get('messages', 'ChatController@getMessages');
//        Route::post('send', 'ChatController@sendMessage');
//        Route::post('edit', 'ChatController@editMessage');
//        Route::post('delete', 'ChatController@deleteMessage');
//    });
//
//    Route::prefix('user')->group(function () {
//        Route::post('profile', 'UserProfileController@edit');
//        //Route::post('logout', 'LogoutConroller');
//    });
//
//});