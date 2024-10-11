<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionTranslation extends Model
{
    //
    protected $table = 'questions_translation';

    protected $fillable = [
   
        'question'
    ];

    public function question(){
        return $this->belongsTo('App\Question', 'question_id');
    }

}
