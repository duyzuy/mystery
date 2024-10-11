<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerTranslation extends Model
{
    //
    protected $table = 'answers_translation';

    protected $fillable = [
   
        'answer'
    ];

    public function answer(){
        return $this->belongsTo('App\Questionn');
    }
}
