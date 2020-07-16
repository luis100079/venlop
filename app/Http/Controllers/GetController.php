<?php

namespace App\Http\Controllers;

use App\Events\sendMessage;
use Illuminate\Http\Request;
use App\Photo;
use App\Video;
use App\Post;
use App\User;
use App\Chat;


class GetController extends Controller
{
    public function photos(){
        return  Photo::all();
    }

    public function videos(){
        return Video::all();
    }

    public function posts(){
        return Post::all();
    }

    public function user(){

        return auth()->user();

    }

    public function search_users(Request $request){

      return ($request->value === null) ? '' :  User::where('name', 'like', '%'.$request->value.'%')->get();

    }

    public function search_user(Request $request){

        return  User::findOrFail($request->value);

    }

    public function search_user_photos(Request $request){

        $user = User::findOrFail($request->value);

        return $user->photos;
    }

    public function search_user_videos(Request $request){

        $user = User::findOrFail($request->value);

        return $user->videos;

    }

    public function search_user_posts(Request $request){

        $user = User::findOrFail($request->value);

        return $user->posts;

    }



    public function get_post_data(Request $request){

     return Post::findOrFail($request->value);

  //      return [ "data" => $post, "author_name" $post->user->name, "author_id" => $post->user->id ];

    }


    public function list_photos(Request $request){

        $list = array();

        for( $i = ( $request->num + 1 ); $i <= ($request->num + 10 ); $i ++ ){ array_push($list, $i); }

        return Photo::with('myLikes', 'myComments')->find($list);

        return $posts;

    }

    public function list_videos(){

        return Video::all();

    }

    public function list_posts(){

        $posts = Post::with('user:id,name')->get();
        return $posts;

    }

    public function get_related(){

        $x = array();

        $num =  count( auth()->user()->myFollowers );

        foreach( auth()->user()->myFollowers as $z){ array_push($x, User::findOrFail($z->follower) ); }

        return $x;

    //    return User::findOrFail( auth()->user()->myFollowers[0]->follower );


    }

    public function messages(Request $request){

        $num = $request->id;

        return Chat::where(function ($query) use ($num) { $query->where('from', auth()->user()->id )->where('to', $num); })->orWhere(function ($query) use ($num) { $query->where('from', $num)->where('to', auth()->user()->id ); })->where('from', $num)->get();

    //    return User::findOrFail( $request->id )->chat_received->where('from', auth()->user()->id );


    }

    public function notifications(Request $request){

        return tap( auth()->user()->unreadNotifications )->markAsRead();

    }


}
