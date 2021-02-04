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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'home'], function() {
   Route::get('list', 'Api\HomeController@home');
   Route::get('mix', 'Api\HomeController@mixTape');
   Route::get('mixSong', 'Api\HomeController@mixTapeSong');
   Route::get('listHead', 'Api\HomeController@listOnHead');
   Route::get('community', 'Api\HomeController@community');
   Route::get('conversation', 'Api\HomeController@conversation');
   Route::get('conversation/detail/{id}', 'Api\HomeController@conversationDetail');
});

Route::get('word/{slug}', 'Api\WordController@getWord');
