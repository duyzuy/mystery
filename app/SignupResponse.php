<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignupResponse extends Model
{
    //
     //
     protected $table = 'signup_response';

   

    protected $fillable = [
         'user_id',
         'signup_question_id',
         'answer'
    ];

    public function question(){
        return $this->belongsTo(SignupQuestion::class, 'signup_question_id', 'id');
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
     
}
