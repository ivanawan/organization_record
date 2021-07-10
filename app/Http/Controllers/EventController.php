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
    //     $data=$this->Query->getWhere('tb_acara'
    //     ,'id_group',session('group')['id_group']);
    //    dd($data->isEmpty());
        return view('event',['data'=>$this->Query->getWhere('tb_acara'
        ,'id_group',session('group')['id_group'])]);
    }

    public function updateEvent(){

    }
    public function deleteEvent(){

    }
}
