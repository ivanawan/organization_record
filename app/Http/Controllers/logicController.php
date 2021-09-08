<?php

namespace App\Http\Controllers;
// require_once "QueryController.php";
use  App\Http\Controllers\QueryController; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// $Query = new QueryController;

class logicController extends Controller
{  
    /**
     * randstring 
     * to     : make random string 
     * input  : length of random string 
     * output : random String 
     */

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
    
    function getPeserta(){
        $arr;
        $Query = new QueryController;
        $kelompok=$Query->getWhere('tb_kelompok','id_group',session('group')['id_group']);
        
        for($i=0;$i <= sizeof($kelompok)-1;$i++){
         $arr[]=[
             "id"=>$kelompok[$i]->id,
             "nama"=>$kelompok[$i]->name_k,
             "peserta"=>$Query->getWhere('tb_peserta','id_kelompok',$kelompok[$i]->id)         
            ];
        }
        dd($arr);
    }

    function insertDataAbsen($arrayInput,$arrayChecked,$idHub){
        $Query = new QueryController;

        for($i=0;$i<=count($arrayInput)-1;$i++){
            if(in_array($arrayInput[$i],$arrayChecked)){
               unset($arrayChecked[array_search($arrayInput[$i],$arrayChecked)]);
            }else{
                $arr[]=[
                    'id_hub'=>$idHub,
                    'id_peserta'=>$arrayInput[$i]               
                ];
            }
        }
        $Query->insert('tb_absen',$arr);
        $this->deleteUncheckData($arrayChecked,$idHub);       
    }
    
    function deleteUncheckData($arr,$idHub){
        $Query = new QueryController;
        for($i=0;$i<=count($arr)-1;$i++){
        $Query->deleteTwoCondition('tb_absen',['id_hub',$idHub,'id_peserta',$arr[$i]]);
        }

    }

    function sortir($arr,$dataold,$id_kelompok)
    {  
        $new_data=$this->getExsisData($arr,$dataold);
        $this->saveNewData($new_data,$id_kelompok);
    }


    /**
     * getExistData
     * to : 
     *     -filter olddata end new data
     *     -delete data if null 
     *     -edit data if has change
     *     -the data has prosesed has gone from $arr
     * input =[$arrayfromviewedit, $datafromtb_peserta]
     * output = $array only new data 
     *  */ 
    function getExsisData($arr,$dataFromDb){
        $Query = new QueryController;
        foreach($dataFromDb as $i){
            $arrayIndexI=$arr[$i->id];
                if($arrayIndexI==null){
                $Query->deleteData('tb_peserta','id',$i->id);
                }elseif($arrayIndexI !=$i->name){
                 $Query->updateData('tb_peserta','id',$i->id,['name'=>$arrayIndexI]);
                }
            unset($arr[$i->id]);
        }
        return $arr;
    }

    function saveNewData($arr,$id){
    $Query = new QueryController;
     foreach($arr as $a){
        if ($a != null){
            $Query->insertData('tb_peserta',[
                'name'=>$a,
                'id_kelompok'=>$id
            ]);
        }
     }

    }

    function getPengeluaranDanPemasukan(){
        $Query = new QueryController;
        date_default_timezone_set("Asia/Jakarta");
        $data=$Query->getDataMontly('tb_keuangan','id_group',session('group')['id_group'],date('m'));
        $arr= $this->sortirPengeluaranPemasukan($data);
        $arr[]=$Query->getLast('tb_keuangan','id_group',session('group')['id_group'])->total;
        return $arr;
    }
    
   function sortirPengeluaranPemasukan($arr){
    $pengeluaran=0;
    $pemasukan=0;
        foreach ($arr as $a){
            if($a->role==0){
                $pengeluaran+=$a->jumlah;
            }else{
                $pemasukan+=$a->jumlah;
            }
        }
     return[$pengeluaran,$pemasukan];
   }
        

}
