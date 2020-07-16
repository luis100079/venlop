<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use Traits\BelongsToUser, Traits\Likable, Traits\Commentable;

    public function get_user(){

        return $this->belongsTo(User::class, 'user');

    }

    public function mylikes(){

        {
            return $this->morphToMany(User::class, 'likable');
        }

    }

    public function mycomments(){

        {
            return $this->morphToMany(User::class, 'commentable')->withPivot('comment');
        }

    }

}
