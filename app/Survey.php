<?php

namespace App;

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

}
