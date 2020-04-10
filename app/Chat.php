<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = [];

    protected $with = ['mostajer'];

    public function borj() {
        return $this->belongsTo('App\Borj');
    }
    public function mostajer() {
        return $this->belongsTo('App\Mostajer');
    }
}
