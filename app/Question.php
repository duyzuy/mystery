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

        return $this->belongsTo(QuestionGroup::class, 'question_group_id', 'id');

    }

    public function responses(){
        return $this->hasMany(SurveyResponse::class);
    }

    public function responseSum()
    {
        return $this->hasMany(SurveyResponse::class)->selectRaw("
                        question_id, 
                        COUNT(case when survey_responses.key = 'answer_1' then 1 end) as answer1_count, 
                        COUNT(case when survey_responses.key = 'answer_2' then 1 end) as answer2_count, 
                        COUNT(case when survey_responses.key = 'answer_3' then 1 end) as answer3_count, 
                        COUNT(case when survey_responses.key = 'yes' then 1 end) as yes_count, 
                        COUNT(case when survey_responses.key = 'no' then 1 end) as no_count, 
                        COUNT(survey_responses.survey_id) as total_count ")
                        ->groupBy('question_id');
    }

    public function surveys(){
        return $this->belongsToMany(Survey::class, 'survey_responses', 'question_id', 'survey_id');
    }

    public function questionMaxPoint(){
        return $this->hasMany(Answer::class)->selectRaw("question_id, SUM(answers.point) AS max_point")->groupBy('question_id');
        
    }

    public function brandSum()
    {
       return $this->hasManyThrough(
            Brand::class,
            Survey::class,
            'brand_id', // Foreign key on survey table...
            'survey_id', // Foreign key on survey_responses table...
            'id', // Local key on brand table...
            'id' // Local key on survey table...
       );
        
    }


}
