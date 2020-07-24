<?php

namespace App\Traits;

use App\User;

trait Commentable{

    public function comment($user = null, $comment = null){

        return $this->comments()->attach( User::find( $user), ['comment' => $comment] );

    }

    public function comments(){

        return $this->morphToMany(User::class, 'commentable')->withTimestamps();

    }

    public function mycomments(){

        {
            return $this->morphToMany(User::class, 'commentable')->withPivot('comment');
        }

    }

}
