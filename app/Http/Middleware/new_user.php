<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use  App\Http\Controllers\QueryController; 
use Closure;
use Illuminate\Http\Request;

class new_user
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
        $query=QueryController;
        if($query->checkData(['tb_anggota','id_user',Auth::id(),0])){
          return redirect('/home');
        }else{
            return $next($request);
        }

    }
}
