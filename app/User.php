<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable
{
    use Notifiable;
    use HasPushSubscriptions;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
////        'name', 'email', 'password',
//    ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];

    public function borj() {
        return $this->belongsTo('App\Borj');
    }

    public function chats() {
        return $this->hasMany('App\Chat');
    }

    public function sharj() {
        return $this->hasOne('App\Sharj');
    }
}
