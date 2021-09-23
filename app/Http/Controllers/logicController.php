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
    $Query->updateData('tb_agenda','id',$id,['alltask'=>count($newdata),'finishtask'=>0]);

   }
 
   function editAgenda($arr,$id){
   $Query = new QueryController;
   $item_agenda=$Query->getWhere('tb_agendaitems','id_agenda',$id);
   $new_data=$this->getNewData($arr,$item_agenda);
   $insertData=$this->formatdata($new_data[0],$id);
   $Query->insert('tb_agendaitems',$insertData);
   $Query->updateData('tb_agenda','id',$id,[
                                        'name'=>$arr['name'],
                                        'desc'=>$arr['desc'],
                                        'alltask'=>count($insertData)+$new_data[1]]);

   }

   function formatdata($arr,$id){
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

   public function getNewData($arr,$item_agenda){
   $Query = new QueryController;
     $min=0;
     $total=count($item_agenda);
     foreach($item_agenda as $i){
     $con1= $i->step != $arr['data'.$i->id];
     $con2 = $i->desc != $arr['desc'.$i->id];
        if($arr['data'.$i->id]== null){
            $min++;
            $Query->deleteData('tb_agendaitems','id',$i->id);
        }elseif($con1 or $con2){
         $Query->updateData('tb_agendaitems','id',$i->id,[
             "step"=>$arr['data'.$i->id],
             "desc"=>$arr['desc'.$i->id]]);
        } 
     unset($arr['data'.$i->id]);
     unset( $arr['desc'.$i->id]);    
    }  

    return [$arr,$total-$min];
   }

   function checkList($arr,$id)
   { 
     $Query = new QueryController;
     $check =$Query->getTwoCondition('tb_agendaitems',['id_agenda',$id,'finish','1']);
     
     if($check->isEmpty()){
         $this->updateData($arr,$id);
         $Query->updateData('tb_agenda','id',$id,['finishtask'=>count($arr)]);
     }else{
         $data=$this->sortirData($arr,$id,$check);
         $this->updateData($data[0],$id);
         $Query->updateData('tb_agenda','id',$id,['finishtask'=>$data[1]+count($data[0])]);
     }
   }

   public function updateData($arr ,$id){
   $Query = new QueryController;
       
       foreach($arr as $a=>$b){
        $Query->updateData('tb_agendaitems','id',$a,['finish'=>$b])  ;       
       }
   }

   public function sortirData($arr,$id,$data){
    $Query = new QueryController;
    $finis_data=0;
        foreach($data as $d){
            if(!isset($arr[$d->id])){
                $Query->updateData('tb_agendaitems','id',$d->id,['finish'=>0])  ;
            }else{
                unset($arr[$d->id]);
                $finis_data++;
            }
        }
        return [$arr,$finis_data];
   }

   
}
