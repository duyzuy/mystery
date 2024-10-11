<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {      
       
        if(in_array($request->language, config('app.locales_available'))){
            
   
            App::setLocale($request->language);
            return $next($request);
           
        }else{
          
            return redirect()->back();
        }
    }
}
