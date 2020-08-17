<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Store;
use App\User;
use App\Survey;

class DashboardComposer
{

    public function compose($view)
    {
        $view->with([
            'user_active'       => User::where('actived', 1)->get(),
            'user_notactive'    => User::where('actived', 0)->get(),
            'user_response'     =>  Survey::all(),
        ]);
    }
    
}