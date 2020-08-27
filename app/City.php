<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class City extends Model implements TranslatableContract
{

    use Translatable;

    //
    protected $table = 'cities';
    //

    protected $fillable = [
        'city_name', 'region_id'
    ];

    public $translatedAttributes = ['name'];

    public function cityTranslation(){
       
        return $this->hasMany('App\CityTranslation', 'city_id', 'id');
    }

    public function stores(){

        return $this->hasMany('App\Store', 'city_id', 'id');
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }
    
    public function brands(){
        return $this->belongsTo(Store::class, 'city_id', 'brand_id' );
    }
}
