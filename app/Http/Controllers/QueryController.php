<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{  
    public function checkData($arr){
       $getid=DB::table($arr[0])->where($arr[1],$arr[2])->first();
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
      DB::table($table)->insert($data);
    }
    public function updateData($table,$column,$param,$data){
      DB::table($table)->where($column,$param)->update($data);
    }
}
