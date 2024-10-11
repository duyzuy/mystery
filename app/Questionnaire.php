<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Questionnaire extends Model
{
    //
    use Translatable;
    
     protected $guards = [];

    protected $fillable = ['user_id'];
    protected $table = 'questionnaires';
    
    public $translatedAttributes = ['title', 'description'];

    public function questionnairesTranslation(){
       
        return $this->hasMany('App\QuestionnaireTranslation', 'questionnaire_id', 'id');
    }

    public function questions(){
        return $this->hasMany('App\Question', 'questionnaire_id', 'id');
    }

    public function surveys(){
        return $this->hasMany(Survey::class);
    }

}
