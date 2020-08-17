<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Setting extends Model
{
    //
    use Translatable;

    //
    protected $table = 'settings';
    //

    protected $fillable = [
        'setting_name',
    ];

    public $translatedAttributes = ['setting_value'];

    public function settingTranslation(){
       
        return $this->hasMany(SettingTranslation::class, 'setting_id', 'id');
    }

}
