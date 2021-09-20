@extends('layouts.layout')


@section('content')
    <br>
    {{-- //bagian user --}}
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6" >
                    <div class="card" style="margin-bottom:10px">
                        <div class="card-body">
                    <h4 ># User</h4>
                    <div class="container">
                    <form action="{{url('/user/edit')}}" onsubmit="myFunction(this)" method="POST">
                     @csrf
                     @method('PUT')
                     <div class="mb-3">
                         <label for="exampleFormControlInput1" class="form-label">Username</label>
                         <input type="text" name="username" value="{{Auth::user()->name}}" class="form-control" id="exampleFormControlInput1">
                     </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-warning">edit</button>
                    </div>
                    </form>
                    </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                    <form action="{{url('/user/edit/pass')}}" method="POST">
                        @csrf   
                       <div class="mb-3">
                           <label for="exampleFormControlInput1" class="form-label">Password Lama</label>
                           <input type="password" name="old_password" class="form-control" id="exampleFormControlInput1">
                       </div>
                       <div class="mb-3">
                           <label for="exampleFormControlInput1" class="form-label">Password Baru</label>
                           <input type="password" name="new_password" value="" class="form-control" id="exampleFormControlInput1">
                       </div>
                       <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Confirm Password Baru</label>
                        <input type="password" name="confirim_pass" value="" class="form-control" id="exampleFormControlInput1">
                    </div>
                       <div class="mb-3">
                           <button type="submit" class="btn btn-warning">edit</button>
                           
                       </div>
                       </form>
                    </div>
                </div>
                </div>
            </div>
{{-- //bagian group --}}
<br>

        <div class="bs-callout bs-callout-warning" style="background-color:#fff ">
            <h5>Pengaturan Group</h5>
            <li>
               klik button <a class="btn btn-warning"><i  class="bi bi-box-arrow-right"></i><a> untuk keluar dari group jika didalam group hanya berisi anda seorang diri maka, 
               group akan dihapus beserta datanya, jika anda berperan sebagai ketua secara otomatis akan mengambil salah satu anggota sebagai ketua.  
            </li>
            <li>
                klik button <a class="btn btn-danger"><i class="bi bi-trash"></i><a> untuk menghapus group, 
                    secara otomatis jika anggota group tidak menpunyai group lain maka akan diarahkan ke page buat group. 
             </li>
             <li>
               klik button <a class="btn btn-primary">Tambah Group</a> untuk membuat group baru atau masuk kedalam group yang sudah ada dengan code group.
             </li>
        </div>
  
<br>
<div class="card">
    <div class="card-body">
        <a href="{{url('/new_group')}}" class="btn btn-primary" style="float:right">Tambah Group</a>
        <h4># Group</h4>
     @foreach (session('group_all') as $item)
        @php
        switch ($item['role']) {
            case '1':
                $callout = 'bs-callout-danger';
                $role = 'Ketua';
                break;
            case '2':
                $callout = 'bs-callout-warning';
                $role = 'Wakil Ketua';
                break;
            case '3':
                $callout = 'bs-callout-info';
                $role = 'Sekertaris';
                break;
            case '4':
                $callout = 'bs-callout-primary';
                $role = 'Bendahara';
                break;
        }
    @endphp
        <div class="bs-callout {{ $callout }}">
            <div class="row justify-content-between">
                <div class="col-4">
                    {{ $item['name'] }}
                </div>
                <div class="col-4">
                    {{ $role }}
                </div>
                <div class="col-4">
                   <a style="float:right;" href="{{url('/group/out/'.$item['id_group'].'/'.$item['role'])}}" class="btn btn-warning"> <i  class="bi bi-box-arrow-right"></i></a>
                   <a style="float:right;margin-right:3px" href="{{url('/group/delete/'.$item['id_group'].'/'.$item['role'])}}" class="btn btn-danger">  <i class="bi bi-trash"></i></a>
                </div>
            </div>
        </div>
         @endforeach
    </div>
</div>
@endsection
