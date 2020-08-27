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
    
    public function cities(){
        return $this->belongsTo(Store::class, 'brand_id', 'city_id' );
    }

}
