<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Notification;

use App\Events\sendMessage;
use App\Events\React;
use App\Notifications\Activity;

use App\User;
use App\Photo;
use App\Video;
use App\Post;
use App\Chat;
use App\Likable;
use App\Follower;


class StorageController extends Controller
{

    public function upload_avatar(Request $request){

        $path = $request->file('avatar')->storeAs('public/avatars', $request->user()->id.".jpg");
        $user = User::find( auth()->user()->id );
        $user->photo = 1;
        $user->save();


    }

    public function set_details(Request $request){

      $db = User::findOrFail( auth()->user()->id );

      if($request->gender == "Male"){ $request->gender = 1; }else if( $request->gender == "Female" ){ $request->gender == 0; }

      $db->name = $request->name;
      $db->profession = $request->profession;
      $db->tel = $request->tel;
      $db->country = $request->country;
      $db->gender = $request->gender;
      $db->about_me = $request->about_me;


      $db->save();

    }

    public function upload_photo(Request $request){

        $name = time().'_'.rand().".jpg" ;
        $img = $request->file('img');
        $path = $img->storeAs('public/photos', $name);

        $db = new Photo;
        $db->name = $name;
        $db->user = auth()->user()->id;
        $db->save();

    }


    public function upload_video(Request $request){


        $name = time().'_'.rand().".mp4";
        $img = $request->file('video');
        $path = $img->storeAs('public/videos', $name );

        $db = new Video;
        $db->name = $name;
        $db->user = auth()->user()->id;
        $db->save();

    }

    public function create_post(Request $request){

        $name = time().'_'.rand().".jpg";
        $img = $request->file('thumbnail');
        $path = $img->storeAs('public/photos', $name );

        $db = new Post;
        $db->title = $request->title;
        $db->content = $request->content;
        $db->user_id = auth()->user()->id;
        $db->thumbnail = $name;
        $db->save();

    }

    public function like_photo(Request $request){

        $like = Likable::where('user_id', auth()->user()->id )->where('likable_id', $request->id )->where('likable_type', 'App\Photo');

        if( count( $like->get() ) == 0 ){

          $user = Photo::findOrFail( $request->id )->get_user;

          $photo = Photo::findOrFail( $request->id )->name;

          Photo::findOrFail( $request->id )->like( auth()->user()->id );

          event( new React($user->id) );

          Notification::send( $user, new Activity( auth()->user(), $photo ) );

        //  request()->user()->notify(new Activity());

        }else {

            $like->delete();

        }

    }

    public function comment_photo(Request $request){

        Photo::find($request->photo_id)->comment(auth()->user(), $request->comment);

    }

    public function sendMessage(Request $request){

        $chat = new Chat;
        $chat->from = auth()->user()->id;
        $chat->to = $request->to;
        $chat->message = $request->text;
        $chat->save();

        $relation1 = Follower::where( 'user', auth()->user()->id )->where('follower', $request->to )->get();
        $relation2 = Follower::where( 'user', $request->to )->where('follower', auth()->user()->id )->get();

        if( $relation1->first() === null ){ Follower::create( ['user' => auth()->user()->id, 'follower' => $request->to] ); }
        if( $relation2->first() === null ){ Follower::create( ['user' =>  $request->to, 'follower' => auth()->user()->id ] ); }

        event( new sendMessage($chat) );

    }

}
