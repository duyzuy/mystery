<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStore extends Model
{
    //
    protected $table = 'user_store';

    protected $casts = [
        'stores'    =>  'array'
    ];

    protected $fillable = [
        'user_id', 
        'stores',
        'store_id',
        'confirmed',
        'check_in',
        'response_status',
        'response_id',
        'registration_count',
        'locale'

    ];

    public function storeRegistrations(){
     
         return $this->hasMany(Store::class, 'store_id', 'id');
    }

   public function survey(){
       return $this->hasOne(Survey::class, 'survey_id', 'id');
   }
   
   public function user(){
       return $this->belongsTo(User::class);
   }
   public function storeApproved(){
       return $this->belongsTo(Store::class, 'store_id', 'id');
   }

   public function stores()
    {
        return $this->belongsToJson(Store::class, 'stores', 'id');
    }
}
