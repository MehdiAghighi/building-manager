<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = [];

    protected $appends = ['created_at_shamsi'];

    protected $with = ['mostajer'];

    public function borj() {
        return $this->belongsTo('App\Borj');
    }
    public function mostajer() {
        return $this->belongsTo('App\Mostajer');
    }

    public function getCreatedAtShamsiAttribute() {
        $v = verta($this->attributes['created_at']);
        return $v->format('l، d F Y');
    }
}
