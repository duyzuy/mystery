<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use App\Response;
use App\Survey;



class UserCheck
{   
    public $user_id;
    public $questionnaire_id;


    public function __construct($user_id, $questionnaire_id)
    {
        $this->user_id = $user_id;
        $this->questionnaire_id = $questionnaire_id;
      
    }

    public function is_Responsed(){

        if(Survey::where([['questionnaire_id', $this->questionnaire_id], ['user_id', $this->user_id]])->exists()){
            return true;
        }
        return false;

    }

    public function get_Response(){
        if($this->is_Responsed()){

            $survey = Survey::where([['questionnaire_id', $this->questionnaire_id], ['user_id', $this->user_id]])->firstOrFail();

            return $survey;
        }
    }

 
}