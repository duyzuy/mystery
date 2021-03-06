<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'store_id', 'phone_number', 'bank_name', 'bank_number', 'bank_address', 'actived', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function images(){
        return $this->morphMany('App\Image', 'imageable');
    }

    public function store(){
        return $this->belongsTo('App\Store');
       
    }

    public function surveys(){
        return $this->hasMany(Survey::class);
    }

    public function city(){
        return $this->belongsTo('App\City');
    }
    public function brand(){
        return $this->belongsTo('App\Brand');
    }
}
