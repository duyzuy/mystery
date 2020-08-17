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
        
    ];


    public function survey(){

        return $this->belongsTo(Survey::class);
    }

    // public function answer(){

    //     return $this->belongsTo(Answer::class);
    // }
    
}
