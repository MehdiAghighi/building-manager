<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MostajerFactor extends Model
{
    protected $guarded = [];

    public function factor() {
        return $this->belongsTo('App\Factor');
    }

    public function mostajer() {
        return $this->belongsTo('App\Mostajer');
    }

    protected $casts = [
        'pay_date' => 'datetime'
    ];
}
