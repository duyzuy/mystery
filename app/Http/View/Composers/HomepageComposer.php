<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Store;
use App\City;
use App\Slider;
use App\Setting;

class HomepageComposer
{
 
    public function compose($view)
    {
        $view->with([
            'sliders'       =>  Slider::orderBy('sort')->get(),
            'section1'      =>  Setting::where('setting_name', 'section_1')->firstOrFail(),
            'footer'        =>  Setting::where('setting_name', 'footer')->firstOrFail(),
            'cities'        =>  City::all(),
            ]);
    }
    
}