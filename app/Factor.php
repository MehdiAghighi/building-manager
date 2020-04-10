<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class factor extends Model
{
    protected $guarded = [];

    public function mostajerFactors() {
        return $this->hasMany('App\MostajerFactor');
    }

    public function borj() {
        return $this->belongsTo('App\Borj');
    }

    protected $casts = [
        'exp_date' => 'datetime',
    ];
}
