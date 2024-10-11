<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserProfileDetailView implements FromView
{
   
    public $view;
    public $user;
    public $storeRegistrations;
    public $signUpRespponses;


    public function __construct($view, $user = "", $storeRegistrations = "", $signUpRespponses)
    {
        $this->view = $view;
        $this->user = $user;
        $this->storeRegistrations = $storeRegistrations;
        $this->signUpRespponses = $signUpRespponses;
    
    }

    public function view(): View
    {
      

        return view($this->view, [
                'user' => $this->user, 
                'storeRegistrations' => $this->storeRegistrations,
                'signUpRespponses'  =>  $this->signUpRespponses,
            ]
        );
    }
}
