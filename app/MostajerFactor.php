<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MostajerFactor extends Model
{
    protected $guarded = [];

    protected $appends = ['created_at_shamsi'];

    public function factor() {
        return $this->belongsTo('App\Factor');
    }

    public function mostajer() {
        return $this->belongsTo('App\Mostajer');
    }

    public function getCreatedAtShamsiAttribute() {
        $v = verta($this->attributes['created_at']);
        return $v->format('l، d F Y');
    }

    protected $casts = [
        'pay_date' => 'datetime'
    ];
}
