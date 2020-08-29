<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Illuminate\Http\File;
use Illuminate\Support\Facades\File;
use App\User;
use App\Events\sendMessage;

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

// Route::get('event', function(){ $chat = App\Chat::find(1); event( new sendMessage( $chat ) ); });

// Route::get('/', function(){ return view('home'); });

Route::get('{any?}', function () {

    return view('welcome');

})->where('any', '[\/\w\.-]*')->middleware('auth');
