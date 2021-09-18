<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Http\Controllers\logicController;
use  App\Http\Controllers\QueryController;

class session
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    { $query=new QueryController;
      $logic=new LogicController; 
        if(!Auth::check()){ //check auth
            return redirect('/login');
        }elseif(session('group')==null){ //session == null  get data
            if( $query->checkData(['tb_anggota','id_user',Auth::id(),0])){
                $logic =new logicController;
                session(['group_all' => $logic->getallgroup()]);
                session(['group'=>session('group_all')[0]]); 
            }elseif($query->checkData(['tb_waitinglist','id_user',Auth::id(),0])){
                return redirect('/waiting');
            }else{
                return redirect('/new_group');
            }          
        }
        return $next($request);
    }
}
