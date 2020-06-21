<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\User;
use App\Photo;
use App\Video;
use App\Post;
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

Route::get('/', function(){
    return view('home');
});


/*

Route::get('/search', function(Request $request){

    return User::where('name', 'like', '%'.$request->value.'%')->get();

});

*/
Route::get("aa", function(){ return "AA"; });

Route::get('/logout', function(){ Auth::logout(); });

/*
Route::post('search_user', 'GetController@search_user');
*/

/*
Route::get('/x', function(){

    return "<video controls src=".'/storage/users/'.auth()->user()->email.'/videos/1592393141_1914678878.mp4'.">";

});
*/
Route::get('{any?}', function () {
    return view('welcome');
})->where('any', '[\/\w\.-]*')->middleware('auth');


