<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use  App\Http\Controllers\QueryController;
use  App\Http\Controllers\logicController;
use Illuminate\Http\Request;

class newUserController extends Controller
{
    public function __construct()
    { 
        $this->Query = new QueryController;
        $this->Logic = new logicController;
        
    }
     
    
    public function newGroup(Request $request){
        
        $request['code']=$this->Logic->randstring(20);
        $id=$this->Query->insertData('tb_group',$request->except(['_token']));
        $this->Query->insertData('tb_anggota',
        ['id_group'=>$id,'id_user'=>Auth::id(),'role'=>1]);
        return redirect('/home')->with('succ','Group Succesfull created!');
      }

    public function codeGroup(Request $request){
        
        if($data=$this->Query->checkData(['tb_group','code',$request->input('id_group'),1])){
          if($this->Query->cekGroup('tb_anggota',$data->id,Auth::id())==null){
            $this->Query->insertData('tb_waitinglist',['id_group'=>$data->id,'id_user'=> Auth::id()]);
              $msg=['scc'=>' successfull wait the admin add to group'];
            }else{
              $msg=['err'=>' your acount alrady register on this group'];
            }
        }else{
             $msg=['err'=>'token not found'];
          return redirect('/new_group')->with($msg);
        }

    return redirect('/waiting')->with($msg);
    }  
}
