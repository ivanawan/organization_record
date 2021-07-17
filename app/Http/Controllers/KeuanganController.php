<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Http\Controllers\QueryController;
use  App\Http\Controllers\logicController;
class KeuanganController extends Controller
{
    public function __construct(Request $request)
    {   $this->Logic = new logicController;
        $this->Query = new QueryController;
        $this->middleware('auth');
        $this->session = session()->get('group');
    }
    public function index(){
        return view('keuangan');
    }
    public function add(Request $request){
        $data=$this->Query->getFrist('tb_keuangan','id_group',session('group')['id_group']);
        if($data != null ){
           $request['total']=$data->total + $request->jumlah;
        }else{
           $request['total']=$request->jumlah;
        }
        $request['id_group']=session('group')['id_group'];
        // dd($request->all());
        $this->Query->insertData('tb_keuangan',$request->except('_token'));
        return back();
    }
}
