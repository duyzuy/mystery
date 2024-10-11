<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class QuestionGroup extends Model
{
    use Translatable;
    
    protected $guards = [];

    protected $fillable = ['sort'];

    protected $table = 'question_groups';
   
    public $translatedAttributes = ['title'];

    public function questionGroupsTranslation(){
      
       return $this->hasMany('App\QuestionGroupTranslation', 'question_group_id', 'id');
    }

    public function questions(){

       return $this->hasMany('App\Question', 'question_group_id', 'id');

    }

    public function responses(){
       return $this->hasMany(SurveyResponse::class, 'group_id', 'id');
    }

    public function groupAnswers(){
      return $this->hasManyThrough(
               Answer::class,
               Question::class,
               'question_group_id', // Foreign key on question table...
               'question_id', // Foreign key on answer table...
               'id', // Local key on group question table...
               'id' // Local key on question table...
      );
   }

   public function groupAnswersActual(){
      return $this->hasManyThrough(
               SurveyResponse::class,
               Question::class,
               'question_group_id', // Foreign key on question table...
               'question_id', // Foreign key on answer table...
               'id', // Local key on group question table...
               'id' // Local key on question table...
      );
   }

   public function groupSumPoint(){
      return $this->groupAnswers()->SUM('answers.point');
   }
   

   public function groupSumPointActual(){
      return $this->groupAnswersActual();
   }

}
