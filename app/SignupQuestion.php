<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class SignupQuestion extends Model
{
    //
    use Translatable;

    //
    protected $table = 'signup_questions';
    //

    public $translatedAttributes = ['questions'];

    public function singupQuestionTranslations(){
       
        return $this->hasMany('App\SignupQuestionTranslation', 'signup_question_id', 'id');
    }
    
    public function signupResponses(){
        return $this->hasMany(SignupResponse::class, 'signup_question_id', 'id');
    }

}
