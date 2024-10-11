<?php

namespace App\Helpers;
use App\Survey;
use App\Response;
use App\UserStore;
use Illuminate\Support\Facades\DB;



class UserCheck
{   
    public $user_id;
    public $questionnaire_id;
    public $index;


    public function __construct($user_id, $questionnaire_id, $index)
    {
        $this->user_id = $user_id;
        $this->questionnaire_id = $questionnaire_id;
        $this->index = $index;
      
    }

    public function is_Responsed(){

        // if(Survey::where([['questionnaire_id', $this->questionnaire_id], ['user_id', $this->user_id]])->exists()){
        //     return true;
        // }
        // return false;

        $userStore = UserStore::where([['user_id', $this->user_id], ['id', $this->index]])->firstOrFail();

        if(!$userStore->survey_id){
            return false;
        }
        return true;
    }

    // public function get_Response(){
    //     if($this->is_Responsed()){

    //         $survey = Survey::where([['questionnaire_id', $this->questionnaire_id], ['user_id', $this->user_id]])->firstOrFail();

    //         return $survey;
    //     }
    // }
    
    public function is_admin_confirmed(){

        $userStore = UserStore::where([['user_id', $this->user_id], ['id', $this->index]])->firstOrFail();

        if($userStore->confirmed == 1){
            return true;
        }

        return false;
    }


    public function email_response(){

        $userStore = UserStore::where([['user_id', $this->user_id], ['id', $this->index]])->firstOrFail();

        switch($userStore->response_status){
            case 'waiting': 
                return 'waiting';
            break;
            case 'cancel': 
                return 'canceled';
            break;
            case 'accept': 
                return 'accepted';
            break;
            case 'completed': 
                return 'completed';
            break;
        }
    }

    public function get_storeId_confirm(){
        $userStore = UserStore::where([['user_id', $this->user_id], ['id', $this->index]])->firstOrFail();

        return $userStore->store_id;

    }

    public function can_registration(){

        if(UserStore::where([
                ['user_id', $this->user_id], 
                ['response_status', 'completed']
            ])->orWhere([
                ['user_id', $this->user_id], 
                ['response_status', 'cancel']
            ])->exists()){


            return true;
        }
        return false;



    }

 
}