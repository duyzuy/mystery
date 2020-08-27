<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Question extends Model
{
    //
    use Translatable;
    
    protected $guards = [];

    protected $fillable = ['sort', 'type', 'question_group_id', 'questionnaire_id'];

    protected $table = 'questions';
    
    public $translatedAttributes = ['question'];

    public function questionsTranslation(){
        
        return $this->hasMany('App\QuestionTranslation', 'question_id', 'id');
    }

    public function answers(){

        return $this->hasMany('App\Answer');

    }

    public function questionnaire(){

            return $this->belongsTo('App\Questionnaire');

    }

    public function group(){

        return $this->belongsTo('App\QuestionGroup');

    }

    public function responses(){
        return $this->hasMany(SurveyResponse::class);
    }
    // public function resSum()
    // {
    //     return $this->hasOne('survey_responses')->selectRaw('question_id, sum(responses) as aggregate')->groupBy('question_id');
    // }

    public function surveys(){
        return $this->belongsToMany(Survey::class, 'survey_responses', 'question_id', 'survey_id');
    }


}
