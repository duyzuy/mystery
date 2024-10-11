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
        'store_website', 'store_image', 'city_id',
        'questionnaire_id'
    ];


    public function questionnaire(){

        return $this->belongsTo(Questionnaire::class);
    }

    public function responses(){
        return $this->hasMany(SurveyResponse::class);
    }


    // public function responseSum()
    // {
    //     return $this->hasMany(SurveyResponse::class)->selectRaw('survey_id, sum(survey_responses.point) as aggregate')->groupBy('question_id');
    // }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function questions(){
        return $this->belongsToMany(Question::class, 'survey_responses', 'survey_id', 'question_id');
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
}
