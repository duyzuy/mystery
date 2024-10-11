<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Store extends Model
{
    //
    use Translatable;

    //
    protected $table = 'stores';
    //

    protected $fillable = [
        'store_website', 'store_image', 'city_id', 'brand_id', 'lat', 'lang', 'code'
    ];

    public $translatedAttributes = ['store_name', 'store_address', 'store_description'];

    public function storeTranslation(){
       
        return $this->hasMany('App\StoreTranslation', 'store_id', 'id');
    }

    public function city(){
        return $this->belongsTo('App\City');
    }

    public function users(){
        return $this->hasMany('App\User');
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function surveys(){
        return $this->hasMany(Survey::class, 'store_id', 'id'); 
    }

    public function surveyPointSum(){
        return $this->hasMany(Survey::class, 'store_id', 'id')->selectRaw('store_id, SUM(surveys.total_point) as aggregate, COUNT(surveys.id) as totalSurvey')->groupBy('store_id');
    }

    public function userStores()
    {
       return $this->hasManyJson(UserStore::class, 'stores');
    }

}
