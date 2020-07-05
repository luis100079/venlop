<?php

namespace App\Traits;

use App\User;

trait likable{

    public function like($user = null){


        return $this->likes()->attach( User::find( $user ) );

    }

    public function likes(){

        return $this->morphToMany(User::class, 'likable')->withTimestamps();

    }
}
