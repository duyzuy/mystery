<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Survey;
class CheckApproval
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
       
        if(Auth::user()->actived == 1 && !Survey::where([['user_id', Auth::user()->id], ['questionnaire_id', $request->id]])->exists()){
            return $next($request);
        }
        
        return redirect()->back();
    }
}
