<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function photos(){
        return $this->hasMany(Photo::class, 'user');
    }

    public function videos(){
        return $this->hasMany(Video::class, 'user');
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function chat_received(){
        return $this->hasMany(Chat::class, 'to');
    }

    public function myFollowers(){
        return $this->hasMany(Follower::class, 'user');
    }

    public function following(){

        return $this->hasMany(Follower::class, 'follower');

    }



}
