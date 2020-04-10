<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borj extends Model
{
    protected $guarded = [];
    public function user() {
        return $this->hasOne('App\User');
    }
    public function chats() {
        return $this->hasMany('App\Chat');
    }
    public function mostajers() {
        return $this->hasMany('App\Mostajer');
    }
    public function elans() {
        return $this->hasMany('App\Elan');
    }
    public function factors() {
        return $this->hasMany('App\Factor');
    }
}
