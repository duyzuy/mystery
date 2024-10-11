<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    //
    protected $table = 'cities_translations';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function city(){
        return $this->belongsTo('App\City');
    }
}
