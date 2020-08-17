<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireTranslation extends Model
{
    //
    protected $table = 'questionnaires_translation';

    protected $fillable = [
        'title',
        'description'
    ];

    public function questionnaire(){
        return $this->belongsTo('App\Questionnaire', 'questionnaires_id');
    }
}
