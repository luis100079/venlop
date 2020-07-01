<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{

    public function sent_from(){
        return $this->belongsTo(User::class, 'to');
    }

    public function sent_to(){
        return $this->belongsTo(User::class, 'to');
    }

}
