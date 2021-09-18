<?php

namespace App\Http\Controllers;
// require_once "QueryController.php";
use  App\Http\Controllers\QueryController; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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
        foreach($data as $i){
            $group=$Query->getFrist('tb_group','id',$i->id_group);
            $arr[]=[ 'role'=>$i->role,
                     'id_group'=>$i->id_group,
                     'name'=>$group->name];
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

    function getPengeluaranDanPemasukan($date){
        $Query = new QueryController;
        $data=$Query->getDataMontly('tb_keuangan','id_group',session('group')['id_group'],$date);
        $arr= $this->sortirPengeluaranPemasukan($data);
        $keuangan=$Query->getLastMont('tb_keuangan','id_group',session('group')['id_group'],$date);
        if($keuangan !=  null){
            $arr[]=$keuangan->total;
        }else{
            $arr[]=0;
        }
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

   function getGrafik(){
    date_default_timezone_set("Asia/Jakarta");
    $date=date('m');
    $month=["Januari","Febuari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
    $arr[]=[$month[$date-7],$month[$date-6],$month[$date-5],
           $month[$date-5],$month[$date-3],$month[$date-2],
           $month[$date-1]];
    $arr[]=$this->getPengeluaranDanPemasukan($date-6);
    $arr[]=$this->getPengeluaranDanPemasukan($date-5);
    $arr[]=$this->getPengeluaranDanPemasukan($date-4);
    $arr[]=$this->getPengeluaranDanPemasukan($date-3);
    $arr[]=$this->getPengeluaranDanPemasukan($date-2);
    $arr[]=$this->getPengeluaranDanPemasukan($date-1);
    $arr[]=$this->getPengeluaranDanPemasukan($date);

    return $arr;
   }
   
   function storeAgenda($data){
    $Query = new QueryController;
 
    $id=$Query->insertData('tb_agenda',[
        'id_group'=>session('group')['id_group'],
        'name'=>$data['name'],
        'desc'=>$data['desc']    
    ]);
    $newdata=$this->formatdata($data,$id);
    $Query->insert('tb_agendaitems',$newdata);
    $Query->updatedata('tb_agenda','id',$id,['alltask'=>count($newdata),'finishtask'=>0]);

   }

   function formatdata($arr,$id=1){
       unset($arr['name'],$arr['desc']);
       
       foreach($arr as $a => $x){
           if(gettype($a)== "integer"){
               if(isset($arr['descitem'.$a])) {
                  $new[]=[
                      'id_agenda'=>$id,
                      'step'=>$x,
                      'desc'=>$arr['descitem'.$a],
                      'finish'=>0
                    ];
               }else{
                   $new[]=[
                  'id_agenda'=>$id,
                  'step'=>$x,
                  'desc'=>null,
                  'finish'=>0
                ];
               }
           }
           
       }
       
       return $new;

   }

}
