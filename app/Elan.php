<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elan extends Model
{
    protected $guarded = [];

    protected $appends = ['created_at_shamsi'];

    public function borj() {
        return $this->belongsTo('App\Borj');
    }

    public function getCreatedAtShamsiAttribute() {
        $v = verta($this->attributes['created_at']);
        return $v->format('l، d F Y');
    }

    protected $casts = [
        'exp_date' => 'datetime',
    ];
}
