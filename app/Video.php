<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use Traits\BelongsToUser, Traits\Likable, Traits\Commentable;
}
