<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Video;
use App\Post;
use App\User;

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


    public function list_photos(){

        return Photo::all();

    }

    public function list_videos(){

        return Video::all();

    }

    public function list_posts(){

        $posts = Post::with('user:id,name')->get();
        return $posts;

    }


}
