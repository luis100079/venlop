<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\User;
use App\Photo;
use App\Video;
use App\Post;

class StorageController extends Controller
{

    public function set_avatar(Request $request){

        $path = $request->file('avatar')->storeAs('avatars', $request->user()->id);

    }

    public function upload_photo(Request $request){

        $name = time().'_'.rand();

        $img = $request->file('img');

        $path = $img->storeAs('users/'. auth()->user()->email, $name.".jpg" );

        $db = new Photo;
        $db->name = $name;
        $db->user = auth()->user()->id;
        $db->save();

    }


    public function upload_video(Request $request){

        $path = $request->file('video')->storeAs('users_'. auth()->user()->id, time().'_'.random() );

        $db = new Video;
        $db->name = $request->name;
        $db->user = auth()->user()->id;
        $db->save();

    }

    public function create_blog(Request $request){

        $db = new Post;
        $db->title = $request->title;
        $db->content = $request->content;
        $db->user = auth()->user()->id;
        $db->save();

    }

}
