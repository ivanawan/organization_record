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
    {   
        // dd(session(group));
        dd($this->Query->whereLimit('tb_acara','id_group',session('group')['id_group']));
        return view('home',[
            'keuangan'=>$this->logic->getPengeluaranDanPemasukan(),
            'event' =>$this->Query->whereLimit('tb_acara','id_kelompok',session('group')['id_kelompok'])
        ]);
    }
   

    public function homechange($index){
     if(sizeof(session('group_all')>$index)){
        session(['group'=>session('group_all')[$index]]);
     }else{
         return back();
     }
    }
    
}
