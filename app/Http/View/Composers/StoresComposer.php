<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Store;
use App\City;

class StoresComposer
{

    public function compose($view)
    {
        $view->with([
            'cities'    => City::all()->load('stores'),
            'stores'    =>  Store::all(),
            ]);
    }
    
}