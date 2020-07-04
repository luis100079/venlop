<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Redis;
use App\Events\UserSignedUp;
use App\Events\OrderStatusUpdate;
use App\Events\sendMessage;

use App\User;
use App\Photo;
use App\Video;
use App\Post;
use App\Chat;

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

Route::get('/order', function(){
    OrderStatusUpdate::dispatch();
});

/*

Route::get('redis', function(){

    Redis::publish('test-channel', json_encode( 'aaaa' ));

    return 'Sent';

/*
    event( new UserSignedUp('Luis') );


});

/*

Route::get('/', function(){
    return view('home');
});

*/


Route::get('get_related', function(){

    $x = array();

    $num =  count( auth()->user()->myFollowers );

    foreach( auth()->user()->myFollowers as $z){

        array_push($x, User::findOrFail($z->follower) );

    }

    return $x;

//    return User::findOrFail( auth()->user()->myFollowers[0]->follower );

});

Route::post('sendMessage', function(Request $request){

  $chat = new Chat;
  $chat->from = auth()->user()->id;
  $chat->to = $request->to;
  $chat->message = $request->text;
  $chat->save();

  event( new sendMessage($chat) );

});


Route::post('messages', function(Request $request){

    $num = $request->id;

    return Chat::where(function ($query) use ($num) { $query->where('from', auth()->user()->id )->where('to', $num); })->orWhere(function ($query) use ($num) { $query->where('from', $num)->where('to', auth()->user()->id ); })->where('from', $num)->get();

//    return User::findOrFail( $request->id )->chat_received->where('from', auth()->user()->id );




});



Route::get('try', function(){




//    return App\Chat::with('sent_to:id,name')->where('from', auth()->user()->id)->get();

    $user = App\User::findOrFail(1);

//    return App\User::findOrFail($user->myFollowers[0]->follower)->chat_received->where('from', '1');

//  return $user->myFollowers->with('chat_received:id,message');

    $user = App\User::find(1);

    /*

    foreach( $user->myFollowers as $x){

        echo  json_encode(  array('user' => App\User::find( $x->follower )->name)  ) ."<br>";
    }

    */


 //   return App\User::findOrFail($user->myFollowers[0]->follower)->chat_received->where('from', '1');

/*

    foreach( $user->myFollowers as $x ){

        return json_encode( array($x->follower => App\User::findOrFail($x->follower)->chat_received->where('from', '1') ) );

    }

*/

//    return view('chat',['me' => $me ]);

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
