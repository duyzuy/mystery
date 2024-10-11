<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionGroupTranslation extends Model
{
    //
    protected $table = 'question_groups_translation';

    protected $fillable = [
   
        'title'
    ];

    public function question(){
        return $this->belongsTo('App\QuestionGroup', 'question_group_id');
    }

}
