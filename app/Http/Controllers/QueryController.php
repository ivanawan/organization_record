<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{  
    public function checkData($arr){
      //  $getid=DB::table($arr[0])->where($arr[1],$arr[2])->first();
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
      $id=DB::table($table)->insertGetId($data);
      return $id;
    }
    public function updateData($table,$column,$param,$data){
      DB::table($table)->where($column,$param)->update($data);
    }
    public function getFrist($table,$column,$param){
       $d=DB::table($table)->where($column,$param)->first();
       return $d;
    }
    public function deleteData($table,$param){
      DB::table($table)->where('id',$param)->delete();
    }
    public function getWhere($table,$column,$param){
      return DB::table($table)->where($column,$param)->get();
    }
}
