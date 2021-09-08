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

    public function pagition($table,$column,$param,$limit=50,$pag=10){
      return  DB::table($table)->where($column,$param)->limit($limit)->orderBy('id','desc')->paginate($pag);
    }
    
    public function getDataMontly($table,$column,$param,$month){
      return DB::table($table)->where($column,$param)->whereMonth('created_at',$month)->get();
    }

    public function changerole($request,$id){
      DB::table('tb_anggota')
      ->where('id_group',session('group')['id_group'])
      ->where('id_user',$id)
      ->update(['role'=>$request->role]);
    }
    public function insertData($table,$data){
     return  DB::table($table)->insertGetId($data);
    }
    public function insert($table,$data){
      return  DB::table($table)->insert($data);
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
    public function getPaginition(){
      return DB::table($table)->where($column,$param)->orderBy('id','desc')->paginate(15)->get();
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
    public function deleteTwoCondition($table,$param){
      DB::table($table)->where($param[0],$param[1])->where($param[2],$param[3])->delete();
    }
    public function getWhere($table,$column,$param){
      return DB::table($table)->where($column,$param)->get();
    }
    public function getOrder($table,$column,$param){
      return DB::table($table)->where($column,$param)->orderBy('id','desc')->get();
    }
    public function whereLimit($table,$column,$param,$limit=5){
      return DB::table($table)->where($column,$param)->latest()->limit($limit)->get();
    }
    public function getfristtoarray($table,$column,$param){
      return DB::table($table)->where($column,$param)->get()->toArray();
    }
    public function getToArray($table,$column,$param){
      return $data=DB::table($table)->where($column,$param)
      ->select('id_peserta')->get()
      ->map(function($data){
        return $data->id_peserta;
      })->toArray();
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

    // public function absenData($id){
    //   // $absen=$this->getWhere('tb_absen','id_hub',$id);

    //   $data=DB::table('tb_absen')
    //   ->where('id_hub',$id)
    //   ->get()
    //   ->map(function ($data){
    //     return [ 
          
    //     ];
    //   });
    // }
    
}
