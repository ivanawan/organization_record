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
        date_default_timezone_set("Asia/Jakarta");

        return view('home',[
            'group'=>$this->Query->getFrist('tb_group','id',session('group')['id_group']),
            'anggota'=>$this->Query->getAnggota(),
            'keuangan'=>$this->logic->getPengeluaranDanPemasukan(date('m')),
            'event' =>$this->Query->GetEvent('tb_acara','id_group',session('group')['id_group']),
            'grafik' =>$this->logic->getGrafik(),
            'list'=>$this->Query->keuangan('tb_keuangan','id_group',session('group')['id_group']),
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
