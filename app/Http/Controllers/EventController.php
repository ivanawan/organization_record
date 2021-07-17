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
        return view('event',['data'=>$this->Query->getWhere('tb_acara'
        ,'id_group',session('group')['id_group'])]);
    }

    public function addEvent(Request $request){
        $request['waktu_awal'] = $request->date." ".$request->time;
        $request['waktu_akhir'] = $request->date." ".$request->time;
        $request['id_group']=session('group')['id_group'];
        $this->Query->insertData('tb_acara',$request->except(['_token','date','time']));
        return redirect('/event');
    }
    public function updateEvent(){

    }
    public function deleteEvent(){

    }
}
