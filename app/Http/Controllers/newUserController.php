<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use  App\Http\Controllers\QueryController; 
use Illuminate\Http\Request;

class newUserController extends Controller
{
    public function __construct()
    { 
        $this->Query = new QueryController;
        $this->middleware('auth');
    }
    
    public function new_user(Request $request){
        $request['id_user']=Auth::id();   
        $this->Query->insertData('tb_anggota',$request->except(['_token']));
        if($request->input('id_group') != null){
            if($this->Query->checkData(['tb_group','id',$request['id_group'],0])) {
               $this->Query->updateData('tb_anggota','id_user',$request->only(['id_user','id_group']));
               return redirect('/home');
              }else{
                  $msg=["err"=>"code group yang anda masukan invalid"];
              }
        }else{ 
            $msg =["scc"=>"kamu tidak mempunyai group, buat grup baru?"];
          }
      return redirect('/new_group')->with($msg);
      }
   
      public function newGroup(Request $request){
  
      }
}
