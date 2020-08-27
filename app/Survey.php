<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    //
    protected $guarded = [];

    protected $table = 'surveys';
    //

    protected $fillable = [
        'store_website', 'store_image', 'city_id'
    ];


    public function questionnaire(){

        return $this->belongsTo(Questionnaire::class);
    }

    public function responses(){
        return $this->hasMany(SurveyResponse::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function questions(){
        return $this->belongsToMany(Question::class, 'survey_responses', 'survey_id', 'question_id');
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }
}
