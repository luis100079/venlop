<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use Traits\BelongsToUser;

    public function get_user(){
        return $this->belongsTo(User::class);
    }
}
