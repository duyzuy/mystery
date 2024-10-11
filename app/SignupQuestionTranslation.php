<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignupQuestionTranslation extends Model
{
    //
    protected $table = 'signup_questions_translation';

    protected $fillable = [
        'questions'
    ];

    public function signupQuestion(){
        return $this->belongsTo('App\SignupQuestion', 'signup_question_id');
    }

}
