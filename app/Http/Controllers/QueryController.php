<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class QueryController extends Controller
{  
    public function checkData($arr){
      $getid=$this->getFrist($arr[0],$arr[1],$arr[2]);
       if ($arr[3]==1) {
         return $getid;
       }
       elseif($getid==null){
           return false;
       }else{
           return true;
       }
    }
    
    public function insertData($table,$data){
     return  DB::table($table)->insertGetId($data);
    }
    public function updateData($table,$column,$param,$data){
      DB::table($table)->where($column,$param)->update($data);
    }
    public function getFrist($table,$column,$param){
      return DB::table($table)->where($column,$param)->first();
    }
    public function getLast($table,$column,$param){
      return DB::table($table)->where($column,$param)->latest()->first();
    }
    public function cekGroup($table,$id_group,$id){
      return DB::table($table)->where('id_group',$id_group)->where('id_user',$id)->first();
    }
    public function getDataDsc($table,$column,$param){
      return DB::table($table)->where($column,$param)->latest()->get();
    } 
    public function deleteData($table,$column,$param){
      DB::table($table)->where($column,$param)->delete();
    }
    public function getWhere($table,$column,$param){
      return DB::table($table)->where($column,$param)->get();
    }
    public function getfristtoarray($table,$column,$param){
      return DB::table($table)->where($column,$param)->get()->toArray();
    }
    public function joinWaitinglist(){
      return  DB::table('tb_waitinglist')
      ->where('tb_waitinglist.id_group',session('group')['id_group'])
      ->join('users', 'tb_waitinglist.id_user', '=', 'users.id')
      ->select('tb_waitinglist.*', 'users.name')
      ->get();
    }
    public function joinanggota(){
      return DB::table('tb_anggota')
      ->where('tb_anggota.id_group',session('group')['id_group'])
      ->join('users', 'tb_anggota.id_user', '=', 'users.id')
      ->select('tb_anggota.*', 'users.name')
      ->get();
    } 

    
}
