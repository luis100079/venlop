<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Traits\BelongsToUser;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
