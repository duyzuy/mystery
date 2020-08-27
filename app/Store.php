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
        'store_website', 'store_image', 'city_id', 'brand_id', 'lat', 'lang'
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
}
