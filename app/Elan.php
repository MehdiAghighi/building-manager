<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elan extends Model
{
    protected $guarded = [];

    public function borj() {
        return $this->belongsTo('App\Borj');
    }

    protected $casts = [
        'exp_date' => 'datetime',
    ];
}
