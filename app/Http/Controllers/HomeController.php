<?php

namespace App\Http\Controllers;

use App\Http\Controllers\logicController;
use App\Http\Controllers\QueryController;
use Illuminate\Http\Request;

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
        $this->logic = new logicController;
    }

    /**
     * Show the application dashboard.
     *
     * @return Array
     */
    public function index()
    {   
        date_default_timezone_set("Asia/Jakarta");
        return view('home', [
            'group' => $this->Query->getFrist('tb_group', 'id', session('group')['id_group']),
            'anggota' => $this->Query->getAnggota(),
            'keuangan' => $this->logic->getPengeluaranDanPemasukan(date('m')),
            'event' => $this->Query->GetEvent('tb_acara', 'id_group', session('group')['id_group']),
            'grafik' => $this->logic->getGrafik(),
            'list' => $this->Query->keuangan('tb_keuangan', 'id_group', session('group')['id_group']),
            'agenda'=>$this->Query->getWhere('tb_agenda','id_group',session('group')['id_group'])
        ]);
    }

    public function homechange($index)
    {
        if (sizeof(session('group_all') > $index)) {
            session(['group' => session('group_all')[$index]]);
        } else {
            return back();
        }
    }

    public function publicPage(Request $request,$code){
        $data=$this->Query->getFrist('tb_group','code',$code);
        // set session
        if($data==null){
            return view('empty')->with(['scc'=>'success out from group :D']);
        }
        session(['group'=>[
                           'id_group'=>$data->id,
                           'name'=>$data->name
                           ]]);
       date_default_timezone_set("Asia/Jakarta");
        $group=$this->Query->getFrist('tb_group', 'id', session('group')['id_group']);
        $anggota= $this->Query->getAnggota();
        $keuangan = $this->logic->getPengeluaranDanPemasukan(date('m'));
        $event = $this->Query->GetEvent('tb_acara', 'id_group', session('group')['id_group']);
        $grafik = $this->logic->getGrafik();
        $list = $this->Query->keuangan('tb_keuangan', 'id_group', session('group')['id_group']);
        $agenda=$this->Query->getWhere('tb_agenda','id_group',session('group')['id_group']);
        $request->session()->forget('group');
        return view('home', [
            'group' => $group,
            'anggota' => $anggota,
            'keuangan' => $keuangan,
            'event' => $event,
            'grafik' => $grafik,
            'list' => $list,
            'agenda'=>$agenda
        ]);
    }

    public function public_page(Request $request){
     return redirect('/group/'.$request->code);
    }
}
