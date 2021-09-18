<?php

namespace App\Http\Controllers;
use App\Http\Controllers\logicController;
use App\Http\Controllers\QueryController;
use Illuminate\Http\Request;

class UserController extends Controller
{   
    public function __construct(Request $request)
    {
        $this->Query = new QueryController;
        $this->logic = new logicController;
    }
    public function index(){
     
     return view('user');
    }
    /**  handle out from group
     *  -jika anggota group hanya satu maka group akan dihapus
     *  -jika user bukan ketua maka tidak merubah data yang lain 
     *  -jika user yang keluar adalah ketua, maka salah satu anggota akan dijadikan ketua
     *   dipilih berdasarkan role yang paling tinggi [2,3,4,5] 
     *  @param id = id_group 
     *  @param code = role user dari group yang ingin dihapus[ketua = 1,wakil_ketua = 2,sekertaris=3,bendahara=4,anggota=5] 
     *  @return void 
     */
    public function groupOut($id,$code){
        $getdata=$this->Query->getWhere('tb_anggota','id_group',$id);
        
        if(count($getdata)==1){
         $this->groupDelete($id,$code);
        }elseif($code!=1){
           $this->Query->deleteTwoCondition('tb_anggota',['id_group',$code,'id_user',Auth::id()]);  
        }else{
            if($getdata->where('role','2')->isNotEmpty()){

                $this->changeRole($getdata->where('role','2')->first()->id);

            }elseif($getdata->where('role','3')->isNotEmpty()){

                $this->changeRole($getdata->where('role','3')->first()->id);

            }elseif($getdata->where('role','4')->first()->isNotEmpty()){

                $this->changeRole($getdata->where('role','4')->first()->id);

            }elseif($getdata->where('role','5')->first()->isNotEmpty()){

                $this->changeRole($getdata->where('role','5')->first()->id);

            }
         
        }
        session(['group_all' => $this->logic->getallgroup()]);
        session(['group'=>session('group_all')[0]]); 
        return redirect('/user')->with(['scc'=>'success out from group :D']);
    }
    /** merubah role user pada tb_anggota menjadi ketua(1)
     * @param id = id_anggota pada tabel anggota
     * @return void  
     */
    public function changeRole($id){
        $this->Query->updateData('tb_anggota','id',$id,['role'=>1]);  
        return redirect('/user');
    }

    /** handele delete group 
     *  @param id = id_group yang ingin dihapus
     *  @return void
     */
    public function groupDelete($id){
        $this->Query->deleteData('tb_anggota','id_group',$id);  
        $this->Query->deleteData('tb_group','id',$id);
        session(['group_all' => $this->logic->getallgroup()]);
        session(['group'=>session('group_all')[0]]); 
        return redirect('/user')->with(['scc'=>'success delete group :D']);
    }
}
