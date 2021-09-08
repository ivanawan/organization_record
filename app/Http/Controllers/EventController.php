<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Http\Controllers\QueryController;
use  App\Http\Controllers\logicController;
class EventController extends Controller
{
    public function __construct(Request $request)
    {   $this->Logic = new logicController;
        $this->Query = new QueryController;
        $this->middleware('auth');
        $this->session = session()->get('group');
    }

    public function index(){
 
        //  dd($this->Query->pagition('tb_acara'
        //  ,'id_group',session('group')['id_group']));        
        return view('event',['data'=>$this->Query->pagition('tb_acara'
        ,'id_group',session('group')['id_group'])]);
    }

    public function addEvent(Request $request){
        $request['id_group']=session('group')['id_group'];
        $this->Query->insertData('tb_acara',$request->except(['_token']));
        return redirect('/event');
    }

    public function absenEvent($id){
        if($id_hub=$this->Query->checkData(['tb_hub','id_acara',$id,1])){  
            return view('absen',[
            'id'=>$id,
            'data'=>$this->Query->getWhere('tb_peserta','id_kelompok',$id_hub->id_kelompok),
            'checked'=> $this->Query->getToArray('tb_absen','id_hub',$id_hub->id)
           ]);
        }else{
           return view('absen',[
            'id'=>$id,  
            'list'=>$this->Query->getWhere('tb_kelompok','id_group',session('group')['id_group'])
           ]);     
        }  
    }

    public function pilihKelompok(Request $request, $id){
        $this->Query->insertData('tb_hub',
        [
            'id_acara'=>$id,
            'id_kelompok'=>$request->radio
        ]);
        return redirect('/absen/'.$id);
    }

    public function absenEventData(Request $request, $id){
        unset($request['_token']);
        $id_hub=$this->Query->checkData(['tb_hub','id_acara',$id,1]);
        $array=$this->Query->getToArray('tb_absen','id_hub',$id_hub->id);
        $this->Logic->insertDataAbsen(array_values($request->toArray()),$array,$id_hub->id);
        return redirect('/event');
    }

    public function editEvent(Request $request,$id){
        $this->Query->updateData('tb_acara','id',$id,$request->except('_token'));
        return redirect('/event');
    }
    public function deleteEvent($id){
       $this->Query->deleteData('tb_acara','id',$id);
       return redirect('/event');
    }
}
