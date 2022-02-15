<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class DCAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        if(Auth::user()->role == 1){
            return redirect()->route('home');
        }
        if(Auth::user()->role == 2){
            return redirect()->route('unit-manager/request-form-is');
        }
        if(Auth::user()->role == 3){
            return redirect()->route('dc-manager/request-form-dc');
        }
        if(Auth::user()->role == 4){
            return redirect()->route('inf-director/request-form-inf');
        }
        if(Auth::user()->role == 6){
            return redirect()->route('dc-reception/approved-requests');
        }
       
        if (Auth::user()->role == 5) {
            return $next($request);
        }
    }
}
