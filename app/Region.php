<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Region extends Model implements TranslatableContract
{
    //
    use Translatable;

    //
    protected $table = 'regions';
    //

    protected $fillable = [
        'code'
    ];

    public $translatedAttributes = ['name'];

    public function regionTranslation(){
       
        return $this->hasMany(RegionTranslation::class, 'region_id', 'id');
    }

  
    
}
