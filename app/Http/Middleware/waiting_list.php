<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use  App\Http\Controllers\logicController;
class waiting_list
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
        $query=new QueryController;
        if($query->checkData(['tb_anggota','id_user',Auth::id(),0])){
            return redirect('/home');
        }elseif($query->checkData(['tb_waitinglist','id_user',Auth::id(9),0])){
            return $next($request);
        }else{
            return redirect('/new_group');
        }
    }
}
