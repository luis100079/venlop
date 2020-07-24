<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use Traits\BelongsToUser, Traits\Likable, Traits\Commentable;



}
