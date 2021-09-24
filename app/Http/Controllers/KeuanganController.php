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
        // dd(date('20y-m-d h:m:s'));
        return view('keuangan',
        ['data'=>$data=$this->Query->pagition('tb_keuangan','id_group',session('group')['id_group']),
         'last_data'=>$data->first()

    ]);
    }
    //get dataa from request then 
    public function add(Request $request,$total){
        $request['jumlah'] = preg_replace('/[^0-9.]+/', '', $request->jumlah);
        $request['jumlah'] =str_replace(".", "", $request->jumlah);
        
        if($request->role == 1){
            $request['total']=$total + $request->jumlah;
        }else{
            $request['total']=$total - $request->jumlah;
        }
        $request['created_at']=now();
        $request['id_group']=session('group')['id_group'];
        $this->Query->insertData('tb_keuangan',$request->except('_token'));
        return back();
    }

    public function update(Request $request,$id){
        $data_awal=$this->Query->getFrist('tb_keuangan','id',$id);
                if($data_awal->role==1){
                    $total=$data_awal->total - $data_awal->jumlah;
                }else{
                    $total=$data_awal->total + $data_awal->jumlah;
                }
                if($request->role == 1){
                    $request['total']=$total + $request->jumlah;
                }else{
                    $request['total']=$total - $request->jumlah;
                }
            
        $this->Query->updateData('tb_keuangan','id',$id,$request->except('_token'));
        return back()->with(['wrn'=>'data berhasil di edit']);
    }
    public function delete($id){
        $this->Query->deleteData('tb_keuangan','id',$id);
        return back()->with(['wrn'=>'data berhasil di hapus']);
    }
}
