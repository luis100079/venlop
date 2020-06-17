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

Route::get('/a', function(Request $request){
    $name = time().'_'.rand();

    $img = $request->file('img');

    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);

    $path = $data->storeAs('users/'. auth()->user()->email, $name.".jpg" );

    $db = new Photo;
    $db->name = $name;
    $db->user = auth()->user()->id;
    $db->save();


});


Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '[\/\w\.-]*')->middleware('auth');

