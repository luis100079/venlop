<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\File;
use Illuminate\Support\Facades\File;
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
    public function delete_photo(Request $request){

        $photo = Photo::findOrFail($request->id);

        if( (int)$photo->user === (int)auth()->user()->id ){

            $photo->delete();
            File::delete('storage/photos/'.$photo->name);

        }

    }

    public function delete_video(Request $request){

        $video = Video::findOrFail($request->id);

        if( (int)$video->user === (int)auth()->user()->id ){

            $video->delete();
            File::delete('storage/videos/'.$video->name);

        }

    }

    public function delete_blog(Request $request){

        $blog = Post::findOrFail($request->id);

        if( (int)$blog->user_id === (int)auth()->user()->id ){

            $blog->delete();
            File::delete('storage/videos/'.$blog->thumbnail);

        }

    }


    public function upload_avatar(Request $request){

        $path = $request->file('avatar')->storeAs('public/avatars', $request->user()->id.".jpg");
        $user = User::find( auth()->user()->id );
        $user->avatar = 1;
        $user->save();

    }

    public function set_details(Request $request){

      request()->validate([ 'name' => ['required', 'max:50'] ]);

      $db = User::findOrFail( auth()->user()->id );

      if($request->gender == "Male"){ $request->gender = 1; }else if( $request->gender == "Female" ){ $request->gender == 0; }

      $db->name =  $request->name;
      $db->profession = $request->profession;
      $db->tel =  $request->tel;
      $db->country =  $request->country;
      $db->gender = $request->gender;
      $db->about_me = $request->about_me;

      $db->save();

    }

    public function upload_photo(Request $request){

//        request()->validate([ 'img' => ['mimes:jpg', 'file|size:3000'], ]);

        $name = time().'_'.rand().".jpg" ;
        $img = $request->file('img');
        $path = $img->storeAs('public/photos', $name);

        $db = new Photo;
        $db->name = $name;
        $db->description = $request->photo_description;
        $db->user = auth()->user()->id;
        $db->save();

    }


    public function upload_video(Request $request){


        $name = time().'_'.rand().".mp4";
        $img = $request->file('video');
        $path = $img->storeAs('public/videos', $name );

        $db = new Video;
        $db->name = $name;
        $db->description = $request->video_description;
        $db->user = auth()->user()->id;
        $db->save();

    }

    public function create_post(Request $request){

        request()->validate([ 'title' => ['required', 'max:50'] ]);

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

          $photo = Photo::findOrFail( $request->id );

          if( $photo->user !== auth()->user()->id ){

            Photo::findOrFail( $request->id )->like( auth()->user()->id );

            event( new React($user->id) );

            Notification::send( $user, new Activity( auth()->user(), $photo->name, "liked", "photo", auth()->user()->avatar ) );

          }

        }else {

            $like->delete();

        }

    }


    public function like_video(Request $request){

    //    $request->id = 1;

        $like = Likable::where('user_id', auth()->user()->id )->where('likable_id', $request->id )->where('likable_type', 'App\Video');

        if( count( $like->get() ) == 0 ){

          $user = Video::findOrFail( $request->id )->get_user;

          $video = Video::findOrFail( $request->id )->name;

          Video::findOrFail( $request->id )->like( auth()->user()->id );

        }else {

            $like->delete();

        }

    }



    public function like_blog(Request $request){


        $like = Likable::where('user_id', auth()->user()->id )->where('likable_id', $request->id )->where('likable_type', 'App\Post');

        if( count( $like->get() ) == 0 ){

          $user = Post::findOrFail( $request->id )->user;

          $blog = Post::findOrFail( $request->id );

          Post::findOrFail( $request->id )->like( auth()->user()->id );

          if( (int)$blog->user_id !== auth()->user()->id ){

            event( new React($user->id) );

            Notification::send( $user, new Activity( auth()->user(), $blog->thumbnail, "liked", "blog", auth()->user()->avatar ) );

          }

        }else {

            $like->delete();

        }

    }

    public function read_messages(Requesr $request){}



    public function comment_photo(Request $request){

        Photo::find($request->photo_id)->comment(auth()->user(), $request->comment);

        $photo = Photo::find($request->photo_id);

        if( (int)$photo->user !== auth()->user()->id ){

            event( new React($photo->user) );

            Notification::send( $photo->get_user, new Activity( auth()->user(), $photo->name, "commented", "photo", auth()->user()->avatar ) );

          }


    }

    public function comment_blog(Request $request){

        Post::find($request->blog_id)->comment(auth()->user(), $request->comment);

        $post = Post::find($request->blog_id);

        if( (int)$post->user_id !== auth()->user()->id ){

            event( new React($post->user_id) );

            Notification::send( $post->user, new Activity( auth()->user(), $post->thumbnail, "commented", "blog", auth()->user()->avatar ) );

          }

    }


    public function comment_video(Request $request){

        Video::find($request->video_id)->comment(auth()->user(), $request->comment);

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
