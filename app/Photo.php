<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use Traits\BelongsToUser, Traits\Likable;

    public function get_user(){

        return $this->belongsTo(User::class);
        
    }

    public function mylikes(){
       
        {
            return $this->morphToMany(User::class, 'likable');
        }

    }

  

}
