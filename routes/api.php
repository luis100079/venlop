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

    Route::post('user', 'GetController@user');

    Route::post('videos', 'GetController@videos');

    Route::post('photos', 'GetController@photos');

    Route::post('posts', 'GetController@posts');

});


Route::post('create_account', 'Auth\RegisterController@register');
