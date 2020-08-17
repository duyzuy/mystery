<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    //
    protected $table = 'setting_translation';

    protected $fillable = [
        'setting_id', 'setting_value',
    ];

    public $timestamps = false;

    public function setting(){
        return $this->belongsTo(Setting::class);
    }
}
