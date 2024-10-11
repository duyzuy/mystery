<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'questions', 'gender', 'phone_number'
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

    public function userRestaurents(){
        return $this->hasMany('App\UserStore', 'user_id', 'id');
    }

    public function userSignupRespone(){
        return $this->hasMany(SignupResponse::class, 'user_id', 'id');
    }

  
}
