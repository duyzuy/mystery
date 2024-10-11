<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $table = 'brands';
    //

    protected $fillable = [
        'name',
    ];

    public function stores(){

        return $this->hasMany(Store::class, 'brand_id', 'id');
    }
    
    public function surveys(){
        return $this->hasMany(Survey::class, 'brand_id', 'id');
    }

    public function responses(){
        return $this->hasManyThrough(
            SurveyResponse::class,
            Survey::class,
            'brand_id', // Foreign key on survey table...
            'survey_id', // Foreign key on survey_responses table...
            'id', // Local key on brand table...
            'id' // Local key on survey table...
        );
    }

    public function surveyPointSum(){
        return $this->hasMany(Survey::class, 'brand_id', 'id')->selectRaw('brand_id, SUM(surveys.total_point) as aggregate, COUNT(surveys.id) as totalSurvey')->groupBy('brand_id');
    }
    
    

}
