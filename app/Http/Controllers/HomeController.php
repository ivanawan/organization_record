<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use  App\Http\Controllers\QueryController; 
use  App\Http\Controllers\logicController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {   
        $this->Query = new QueryController;
        $this->middleware('auth');
        $this->middleware('user_new');
        $this->logic= new logicController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   if( session('group') ? null : $this->homeSet());
        // dd(session('group'));
        return view('home');
    }
   
    public function homeSet(){
        session(['group_all' =>  $this->logic->getallgroup()]);
        session(['group'=>session('group_all')[0]]);
    }

    public function homechange($index){
     if(sizeof(session('group_all')>$index)){
        session(['group'=>session('group_all')[$index]]);
     }else{
         return back();
     }
    }
    
}
