<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mostajer extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public $timestamps = false;

    protected $hidden = ['password'];

    protected $guarded = [];

    public function chats() {
        return $this->hasMany('App\Chat');
    }

    public function mostajer_factors() {
        return $this->hasMany('App\MostajerFactor');
    }

    public function borj() {
        return $this->belongsTo('App\Borj');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'id' => $this->id,
            'username' => $this->username
        ];
    }
}
