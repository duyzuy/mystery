<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionTranslation extends Model
{
    //
    protected $table = 'regions_translation';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function region(){
        return $this->belongsTo(Region::class);
    }
}
