<?php

namespace App;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    protected $guarded = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['created_at_shamsi', 'exp_date_shamsi'];

    public function mostajerFactors() {
        return $this->hasMany('App\MostajerFactor');
    }

    public function borj() {
        return $this->belongsTo('App\Borj');
    }

    public function getExpDateShamsiAttribute() {
        $v = verta($this->attributes['exp_date']);
        return $v->format('l، d F Y');
    }

    public function getCreatedAtShamsiAttribute() {
        $v = verta($this->attributes['created_at']);
        return $v->format('l، d F Y');
    }

    protected $casts = [
        'exp_date' => 'datetime',
    ];
}
