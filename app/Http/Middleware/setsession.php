<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use  App\Http\Controllers\logicController;
class setsession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {  
        if(session('group')==null){
            $query =new logicController;
            session(['group_all' => $query->getallgroup()]);
            session(['group'=>session('group_all')[0]]);     
        }
        return $next($request);    
    
    }
}
