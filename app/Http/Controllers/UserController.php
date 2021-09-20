<?php

namespace App\Http\Controllers;
use App\Http\Controllers\logicController;
use App\Http\Controllers\QueryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{   
    public function __construct(Request $request)
    {
        $this->Query = new QueryController;
        $this->logic = new logicController;
    }
    public function index(){
    //  dd(Auth::user()->name);
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
        if(session('group')['id_group']==$id){
            session(['group'=>session('group_all')[0]]); 
        }
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
        if(session('group')['id_group']==$id){
            session(['group'=>session('group_all')[0]]); 
        }
        return redirect('/user')->with(['scc'=>'success delete group :D']);
    }

    public function userEdit(Request $request){
        if($request->username == Auth::user()->name and $request->email == Auth::user()->email){
         return redirect('/user')->with(['wrn'=>'email & name tidak di ubah']);
        }
        User::where('id',Auth::id())->update(['email'=>$request->email,'name'=>$request->username]);
        return redirect('/user')->with(['scc'=>'email & name berhasil di ubah ']);
    }

    public function changePassword(Request $request){
        $user = User::where('id', Auth::id())->first();  
        if($request->new_password != $request->confirim_pass){
            return redirect('/user')->with(['wrn'=>'password tidak sama coba lagi...']);
        }elseif (Hash::check($request->new_password, $user->password)) {
            return redirect('/user')->with(['wrn'=>'password tidak sama dengan database coba lagi...']);
        }
        User::where('id', Auth::id())->update(['password'=>Hash::make($request->new_password)]);
        return redirect('/user')->with(['scc'=>'password berhasil di ubah ']);
    }
}
