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
}
