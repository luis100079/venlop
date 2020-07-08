<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;


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


/*

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

*/

Route::middleware('auth:api')->group(function(){

    Route::post('upload_avatar', 'StorageController@set_avatar');

    Route::post('set_details', 'StorageController@set_details');

    Route::post('upload_photo', 'StorageController@upload_photo');

    Route::post('upload_video', 'StorageController@upload_video');

    Route::post('create_post', 'StorageController@create_post');

    Route::post('logout', 'Auth\LoginController@logout');

    Route::post('upload_avatar', 'StorageController@upload_avatar');


    Route::post('user', 'GetController@user');

    Route::post('videos', 'GetController@videos');

    Route::post('photos', 'GetController@photos');

    Route::post('posts', 'GetController@posts');

    Route::post('search', 'GetController@search_users');


    Route::post('search_user', 'GetController@search_user');

    Route::post('search_user_photos', 'GetController@search_user_photos');

    Route::post('search_user_videos', 'GetController@search_user_videos');

    Route::post('search_user_posts', 'GetController@search_user_posts');


    Route::post('get_post_data', 'GetController@get_post_data');


    Route::post('list_photos', 'GetController@list_photos');
    Route::post('list_videos', 'GetController@list_videos');
    Route::post('list_posts', 'GetController@list_posts');

    Route::post('try', 'GetController@try');

    Route::post('like', 'StorageController@like');

    Route::post('get_related', 'GetController@get_related');

    Route::post('sendMessage', 'StorageController@sendMessage');

    Route::post('messages', 'GetController@messages');

    Route::post('/logout', function(){ Auth::logout(); });

});
