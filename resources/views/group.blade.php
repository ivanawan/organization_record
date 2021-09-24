@extends('layouts.layout')


@section('content')
   <div class=" flex justify-end">
    <a type="button" style=";margin-left:15px; color:#fff" class="btn btn-warning m-3"
    href="{{ url('/group/'.$group->code) }}">
    <i class="bi bi-file-earmark-code"></i>
    </a>

    <a type="button" style=" background-color:#1EA5FC;margin-left:15px; color:#fff" class="btn  m-3"
        href="{{ url('/group/addpeserta') }}">
        <i class="bi bi-people"></i>
    </a>

    <button type="button" style=" color:#fff " class="btn btn-warning  m-3"  data-bs-toggle="modal"
        data-bs-target="#staticBackdrop">
        <i class="bi bi-person-plus"></i>
    </button>
    </div>
    <div class="bs-callout bs-callout-primary bg-white">
        <li>
           klik button <a class="btn btn-warning"> <i class="bi bi-person-plus"></i><a> untuk membuat akun anggota baru dan otomatis
              akan dimasukan kedalam group.
        </li>
        <li>
            klik button <a class="btn" style="background-color:#1EA5FC;"> <i class="bi bi-people"></i><a> untuk membuat kelompok peserta, 
                yang nantinya kelompok ini akan dunakan untuk absensi event. 
         </li>
         <li>
           klik button <a class="btn btn-warning"><i class="bi bi-file-earmark-code"></i></a> untuk memasuki public page,
            public page adalah halaman dashboard yang dapat dikunjungi tanpa login / register akun. 
         </li>
    </div>
    <div class="card shadow-md">
        <div class="card-body">
       <form method="POST" action="{{url('/group/edit/eden')}}">
        @csrf
        @method('PUT')
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">code group</span>
            <input type="text" class="form-control" value="{{$group->code}}" id="basic-url" aria-describedby="basic-addon3" readonly>
          </div>
        <div class="mb-3">
            <input type="text" name="name" class="form-control"   value="{{$group->name}}" required>
          </div>
          <div class="mb-3">
            <textarea class="form-control"  name="desc" id="exampleFormControlTextarea1"  required> {{$group->desc}}</textarea>
          </div>
          <button type="submit" class="btn btn-warning">Edit</button>
       </form>
        </div>
    </div>
    <br>
    <div class="card shadow-md">
      
            <div class="card-body" style="max-height: 80vh; overflow: auto;">
            <h3 class="text-yellow-400"> # Anggota Group</h3>

            @foreach ($anggota as $item)

            @php
            switch ($item->role) {
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
            <div class="row">
                <div class="col">
                  {{ $item->name }}
                </div>
                <div class="col">
                  {{ $role }}
                </div>
                <div class="col">
                  <a style="color: red" class="float-right " href="{{ url('/group/delete/anggota' . $item->id) }}">
                    <i class="bi bi-trash"></i>
                  </a>
                    <a role="button" class="float-right mr-1" style="color: rgb(11, 56, 255)" id="dropdownMenuLink" data-bs-toggle="dropdown"
                    aria-expanded="false">
                        <i class="bi bi-gear"></i>
                    </a> 
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <form action="{{ url('/group/changerole/' . $item->id_user) }}" method="POST">
                            @csrf
                            @if (session('group')['role'] == 1)
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" value="1" type="radio"
                                            name="role" id="flexRadioDefault1" @if($item->role==1)checked @endif>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            ketua
                                        </label>
                                    </div>
                                </li>
                            @endif
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" value="2" type="radio"
                                        name="role" id="flexRadioDefault1" @if($item->role==2)checked @endif>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        wakil ketua
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" value="3" type="radio"
                                        name="role" id="flexRadioDefault1" @if($item->role==3)checked @endif>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        sekertaris
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" value="4" type="radio"
                                        name="role" id="flexRadioDefault1" @if($item->role==4)checked @endif>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        bendahara
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" value="5" type="radio"
                                        name="role" id="flexRadioDefault1" @if($item->role==5)checked @endif>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        anggota
                                    </label>
                                </div>
                            </li>
                            <li><button type="submit" style="width: 100%"
                                    class="btn btn-warning">save</button></li>
                        </form>
                    </ul>
                </div>
              </div>
        </div>


            @endforeach
        </div>
    </div>
    <br>
    {{-- card buat peserta --}}



    <br>
    @if (!$data->isEmpty())

        <div class="card">
            {{--  <div class="card-header">
                

            </div>  --}}

            <div class="card-body" style="max-height: 80vh; overflow: auto;">
            <h3 class=" text-yellow-400"># Waitinglist</h3>
                @foreach ($data as $item)


                    <div class="bs-callout bs-callout-light">
                        <div class="row justify-content-between">
                            <div class="col">
                                {{ $item->name }}
                            </div>

                            <div class="col">
                                <div style="float: right">
                                    <a type="button" href="{{ url('/group/addtogroup/' . $item->id_user) }}"
                                        class="btn btn-info" data-bs-toggle="popover"
                                        data-bs-content="tambahkan ke dalam group? ">
                                        <i class="bi bi-person-plus-fill"></i>    
                                    </a>
                                    <a type="button" href="{{ url('/group/delete/' . $item->id_user) }}"
                                        class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    {{-- card tabel peserta --}}
    <br>
    @if(!$peserta->isEmpty())
    <div class="card">
        
        <div class="card-body" style="max-height: 80vh; overflow: auto;">
            <h3 class="mb-4 text-yellow-400"># Kelompok Peserta</h3>
            @foreach ($peserta as $item)
            <div class="alert alert-primary" role="alert">
                <a href="{{ url('/peserta/delete/' . $item->id) }}">
                <i style="float: right;color:red" class="bi bi-trash"></i></a>
                <a href="{{ url('/peserta/' . $item->id) }}" style="text-decoration: none">
                        {{ $item->name_k }}
                    </a>
                    </div>
            @endforeach

        </div>
    </div>
    <br>
    
    @endif
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/group/add/anggota') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                                required>
                        </div>
                        <select class="form-select" name="role" aria-label="Default select example">
                            <option value="5" selected>anggota</option>
                            <option value="4">bendahara</option>
                            <option value="3">sekertaris</option>
                            <option value="2">wakil ketua</option>
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection