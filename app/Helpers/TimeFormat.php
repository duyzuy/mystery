<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use App\Response;
use App\Survey;
use Carbon\Carbon;



class TimeFormat
{   
    public $time;
  

    public function __construct($time = null){
        return $this->time = $time;
    }

  

    public function diffForHuman(){

    

        return  Carbon::createFromFormat('Y-m-d H:i:s', $this->time)->diffForHumans();

    }

    public function getTime(){
    
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->time)->isoFormat('D/MM/YYYY HH:mm');
    }
    

 
}