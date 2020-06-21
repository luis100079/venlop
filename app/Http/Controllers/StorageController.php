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

    public function upload_avatar(Request $request){

        $path = $request->file('avatar')->storeAs('public/avatars', $request->user()->id.".jpg");

    }

    public function set_details(Request $request){

      $db = User::findOrFail( auth()->user()->id );


      $db->name = $request->name;

      $db->tel = $request->tel;
      $db->age = $request->age;
      $db->height = $request->height;
      $db->weight = $request->weight;
      $db->country = $request->country;
      $db->gender = $request->gender;
      $db->address = $request->address;
      $db->m_status = $request->m_status;
      $db->interested_in = $request->interested_in;
      $db->about_me = $request->about_me;

      $db->save();

    $db->name;
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

}
