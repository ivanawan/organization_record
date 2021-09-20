<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function __construct(Request $request)
    {
        $this->Query = new QueryController;
        $this->logic = new logicController;
    }
    public function index(){
     return view('Agenda',["agenda"=>$this->Query->getWhere(
         'tb_agenda','id_group',session('group')['id_group'])]);
    }

    public function store(Request $request){
    $this->logic->storeAgenda($request->except('_token'));
    return redirect('/agenda')->with(['scc'=>'agenda baru ditambahkan']);
    }
    public function viewEdit($id){
      return view('agendaCrud',[
          'agendaEdit'=>$this->Query->getFrist('tb_agenda','id',$id),
          'items'=>$this->Query->getWhere('tb_agendaitems','id_agenda',$id)
        ]);
    }

    public function delete($id){  
    $this->Query->deleteData('tb_agenda','id',$id);
    $this->Query->deleteData('tb_agendaitems','id_agenda',$id);
    return redirect('/agenda')->with(['wrn'=>'data berhasil di hapus']);       
    }
    public function edit(Request $request,$id){
     $this->logic->editAgenda($request->except('_token'),$id);
    return redirect('/agenda')->with(['prm'=>'data berhasil di Edit']);       
    } 

    public function viewAgenda($id){
        return view('agendaView',[
            'agendaView'=>$this->Query->getFrist('tb_agenda','id',$id),
            'items'=>$this->Query->getWhere('tb_agendaitems','id_agenda',$id)
          ]);
    }

    public function checkList(Request $request,$id){
        $this->logic->checkList($request->except('_token'),$id);     
        return redirect('/agenda')->with(['scc'=>'data change']);
    }

}
