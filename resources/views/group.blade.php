@extends('layouts.layout')


@section('content')
    <a type="button" style="float:right ; background-color:#1EA5FC;margin-left:15px; color:#fff" class="btn "
        href="{{ url('/group/addpeserta') }}">
        <i class="bi bi-people"></i>
    </a>

    <button type="button" style="float:right; color:#fff " class="btn btn-warning" data-bs-toggle="modal"
        data-bs-target="#staticBackdrop">
        <i class="bi bi-person-plus"></i>
    </button>
    <br><br>
    <div class="card">
        <div class="card-body">
       <form method="POST" action="{{url('/group/edit/eden')}}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <input type="text" name="name" class="form-control"   value="{{$group->name}}">
          </div>
          <div class="mb-3">
            <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" > {{$group->desc}}</textarea>
          </div>
          <button type="submit" class="btn btn-warning">Edit</button>
       </form>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <div style="float:right">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{$group->code }}" id="myInput" disabled readonly>
                    <button class="btn" style="background-color: #FECB4D" onclick="myFunction()">
                        <i class="bi bi-link"></i>
                    </button>
                </div>
            </div>
            <h3> Anggota Group</h3>
        </div>
        <div class="card-body" style="max-height: 80vh; overflow: auto;">

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
            <div class="card-header">
                Waitinglist

            </div>

            <div class="card-body" style="max-height: 80vh; overflow: auto;">

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
        <div class="card-header">
            Kelompok Peserta
        </div>
        <div class="card-body" style="max-height: 80vh; overflow: auto;">
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
@section('script')
    <script>
        function myFunction() {
            /* Get the text field */
            var copyText = document.getElementById("myInput");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            alert("Copied the text: " + copyText.value);
        }
    </script>
@endsection
