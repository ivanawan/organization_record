<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use  App\Http\Controllers\QueryController; 
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
    {   $query=new QueryController;
        // dd('hello');
        // if($query->checkData(['tb_waitinglist','id_user',Auth::id(),0]) or
        //     return redirect('/new_group');
        //  $query->checkData(['tb_anggota','id_user',Auth::id(),0])){
        //     return redirect('/waiting');
        // }else{
        // }
        if(session('group')==null){
            $logic =new logicController;
            session(['group_all' => $logic->getallgroup()]);
            session(['group'=>session('group_all')[0]]);     
        }
        return $next($request);    
    
    }
}
