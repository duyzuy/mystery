<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    //

    protected $guarded = [];

    protected $table = 'survey_responses';
    //

    protected $fillable = [
        'survey_id', 'descriptions', 'answer_id', 'question_id', 'group_id', 'point', 'key'
    ];


    public function survey(){

        return $this->belongsTo(Survey::class);
    }

    // public function answer(){

    //     return $this->belongsTo(Answer::class);
    // }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function answer(){
        return $this->belongsTo(Answer::class);
    }
    public function group(){
        return $this->belongsTo(QuestionGroup::class, 'group_id', 'id');
     }
    
}
