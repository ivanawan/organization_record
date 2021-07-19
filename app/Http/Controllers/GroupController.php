<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Http\Controllers\QueryController;
use  App\Http\Controllers\logicController;
class GroupController extends Controller
{
    public function __construct(Request $request)
    {   $this->Logic = new logicController;
        $this->Query = new QueryController;
        $this->middleware('auth');
        $this->session = session()->get('group');
    }

    public function index(){
       return view('group',['data'=>$this->Query->joinWaitinglist(),
       'anggota'=>$this->Query->joinanggota()]);
    }

    public function addtogroup($id){
       if($this->Query->cekGroup('tb_anggota',session('group')['id_group'],$id)==null){

           $this->Query->insertData('tb_anggota',
           ['id_group'=>session('group')['id_group'],'id_user'=>$id,'role'=>5]);
           $this->deletefromwaitinglist($id);
        }
           return redirect('/group');
    }

    public function deletefromwaitinglist($id){
        $this->Query->deleteData('tb_waitinglist','id_user',$id);
        return redirect('/group');
    }
    public function changerole(Request $request){
        $this->Query->updateData('tb_anggota','id_user',$request->id,['role'=>$request->role]);
        return redirect('/group');
    }
}
