<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use  App\Http\Controllers\QueryController; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {   $this->session = session()->get('group');
        $this->Query = new QueryController;
        $this->middleware('auth');
        $this->hahah="hahah";
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  // dd($this->session);
        return view('home');
    }
   
    public function homeSet(){
       $data=$this->Query->getWhere('tb_anggota','id_user',Auth::id());
       dd($data);
       session(['group'=>$page]);
     return redirect('/home');
    }

    public function selectHome($page){
        if($data=$this->Query->checkData(['tb_group','id',$page,1])){
            session(['group' => $page]);
            return back()->withInput(['scc','chenge group to '.$data['name']]);
        }else{
            return back()->withInput(['err','cant change to page']);
        }
    }

}
