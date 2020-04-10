<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mostajer extends Model
{

    protected $hidden = ['password'];

    public function chats() {
        return $this->hasMany('App\Chat');
    }

    public function mostajer_factors() {
        return $this->hasMany('App\MostajerFactor');
    }

    public function borj() {
        return $this->belongsTo('App\Borj');
    }
}
