<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    protected $fillable = [
        'user_id', 'friend_id'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function post()
    {
        return $this->hasMany('App\Post');
    }
}
