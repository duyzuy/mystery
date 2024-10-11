<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Answer extends Model
{
    //
    use Translatable;
    
    protected $guards = [];

    protected $table = 'answers';

    protected $fillable = ['point', 'show_textarea', 'key'];

    
   
    public $translatedAttributes = ['answer'];

    public function answersTranslation(){
      
       return $this->hasMany('App\AnswerTranslation', 'answer_id', 'id');

    }



    public function question(){

        return $this->belongsTo('App\Question');

    }

    public function responses(){

        return $this->hasMany(SurveyResponse::class);

    }
}
