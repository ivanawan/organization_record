<?php

namespace App\Http\Controllers;

use App\Http\Controllers\logicController;
use App\Http\Controllers\QueryController;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function __construct()
    {$this->Logic = new logicController;
        $this->Query = new QueryController;
        $this->session = session()->get('group');
    }

    public function index()
    {    
        return view('group', [
            'data' => $this->Query->joinWaitinglist(),
            'anggota' => $this->Query->joinanggota(),
            'peserta' => $this->Query->getWhere('tb_kelompok', 'id_group', session('group')['id_group']),
            'group'=>$this->Query->getFrist('tb_group','id',session('group')),
        ]);
    }

    public function addtogroup($id)
    {
        if ($this->Query->cekGroup('tb_anggota', session('group')['id_group'], $id) == null) {

            $this->Query->insertData('tb_anggota', [
                'id_group' => session('group')['id_group'],
                'id_user' => $id, 'role' => 5,
            ]);
            $this->deletefromwaitinglist($id);
        }
        return redirect('/group');
    }

    public function deletefromwaitinglist($id)
    {
        $this->Query->deleteData('tb_waitinglist', 'id_user', $id);
        return redirect('/group');
    }
    public function changerole(Request $request, $id)
    {
        $this->Query->changerole($request, $id);
        return redirect('/group');
    }
    public function tambahAnggota(Request $request)
    {
        $this->Query->insertData('tb_anggota', [
            'id_group' => session('group')['id_group'],
            'id_user' => $this->Query->insertData('users', $request->only(['name', 'email', 'password'])),
            'role' => $request->role]);
        return redirect('/group');

    }

    public function tambahpeserta(Request $request)
    {
        $this->Logic->addpeserta($request->except('_token'));
        return redirect('/group');
    }

    public function getPeserta($id)
    {
        return view('addpeserta', [
            'kelompok' => $this->Query->getWhere('tb_kelompok', 'id', $id),
            'peserta' => $this->Query->getWhere('tb_peserta', 'id_kelompok', $id),
        ]);
    }

    public function editData(Request $request, $id)
    {
        $this->Logic->sortir(
            $request->except('_token', 'name'),
            $this->Query->getWhere('tb_peserta', 'id_kelompok', $id),
            $id
        );
        return redirect('/group');
    }

    public function editNameAndDesc(Request $request){
        $this->Query->updateData(
            'tb_group',
            'id',
            session('group')['id_group'],
            $request->except('_token','_method'),
        ); 
        return redirect('/group');       
    }

    public function roleGroup($id){
    $all=session('group_all');
    
    foreach($all as $a){
       if($a['id_group']==$id){
        session(['group'=>$a]); 
       }
    }
     return back();
    }

    public function deletePeserta($id){
     $this->Query->deleteData('tb_kelompok','id',$id);
     $this->Query->deleteData('tb_peserta','id_kelompok',$id);
     $this->Query->deleteData('tb_hub','id_kelompok',$id);
     return back()->with(['scc'=>"delete data berhasil "]); 
    }
}
