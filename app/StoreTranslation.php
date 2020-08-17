<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreTranslation extends Model
{
    //
    protected $table = 'stores_translation';

    protected $fillable = [
        'store_id', 'store_name', 'store_address', 'store_description'
    ];

    public $timestamps = false;

    public function store(){
        return $this->belongsTo('App\Store');
    }
}
