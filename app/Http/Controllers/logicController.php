<?php

namespace App\Http\Controllers;

use  App\Http\Controllers\QueryController; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class logicController extends Controller
{  
    

    function randstring($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    }
    
    function getallgroup(){
        $Query = new QueryController;
        $data=$Query->getWhere('tb_anggota','id_user',Auth::id());
        $arr=[];
           for($x=0;$x<=sizeof($data)-1;$x++){
            $group=$Query->getFrist('tb_group','id',$data[$x]->id_group);
            $arr[$x]=['role'=>$data[$x]->role,'id_group'=>$data[$x]->id_group,'name'=>$group->name];

            }
        return $arr;
    }

    function addpeserta($arr){
        $Query = new QueryController;
        $id=$Query->insertData('tb_kelompok',['id_group'=>session('group')['id_group'],"name_k"=>$arr['name']]);
        for($i=1;$i<=sizeof($arr)-1;$i++){
            $name="peserta".$i;
            $Query->insertData('tb_peserta',["name"=>$arr[$name],"id_kelompok"=> $id]);
        }
        return redirect('/group');
    }
      
}
