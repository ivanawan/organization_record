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
        $this->session = session()->get('group');
    }
    public function index(){  
        return view('keuangan',
        ['data'=>$data=$this->Query->pagition('tb_keuangan','id_group',session('group')['id_group']),
        //  'total'=>$data->get(0)->total,
        //  'last_id'=>$data->get(0)->id,
         'last_data'=>$data->first()

    ]);
    }
    //get dataa from request then 
    public function add(Request $request){
        $request['jumlah'] = preg_replace('/[^0-9.]+/', '', $request->jumlah);
        $request['jumlah'] =str_replace(".", "", $request->jumlah);
        
        $data=$this->Query->getLast('tb_keuangan','id_group',session('group')['id_group']);
        if($data == null ){
             $data= 0;
        }else{
            $data=$data->total;
        }
        if($request->role == 1){
            $request['total']=$data + $request->jumlah;
        }else{
            $request['total']=$data - $request->jumlah;
        }
        $request['id_group']=session('group')['id_group'];
        $this->Query->insertData('tb_keuangan',$request->except('_token'));
        return back();
    }

    public function update(Request $request,$id){
        $this->Query->updateData('tb_keuangan','id',$id,$request->except('_token'));
        return back()->with(['wrn'=>'data berhasil di edit']);
    }
    public function delete($id){
        $this->Query->deleteData('tb_keuangan','id',$id);
        return back()->with(['wrn'=>'data berhasil di hapus']);
    }
}
