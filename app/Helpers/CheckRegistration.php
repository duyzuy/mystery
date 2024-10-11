<?php

namespace App\Helpers;
use App\Survey;
use App\Response;
use App\UserStore;
use Illuminate\Support\Facades\DB;



class CheckRegistration
{   
    public $user_id;
   


    public function __construct($user_id)
    {
        $this->user_id = $user_id;
      
      
    }

    public function can_registration(){

        if(UserStore::where([
                ['user_id', $this->user_id], 
                ['response_status', 'waiting']
            ])->orWhere([
                ['user_id', $this->user_id], 
                ['response_status', 'accept']
            ])->exists()){


            return false;

        }

        return true;



    }

    public function is_out_of_registration(){

        $completed = UserStore::where([['user_id', $this->user_id],['response_status', 'completed']])->get();

        if( count($completed) === 3){
            return true;
        }
        return false;
        

    

    }
 
}