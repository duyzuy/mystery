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

}
