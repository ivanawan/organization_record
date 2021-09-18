@extends('layouts.layout')


@section('content')

    <div class="container" style="padding-left:20%;padding-right:20%">
        @if (!isset($kelompok))
            {{-- form add data --}}
            <form method="POST" action="{{ url('/group/addpeserta') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Kelompok</label>
                    <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                        placeholder="nama kelompok">
                </div>
                <div class="mb-3">
                    <input type="text" name="peserta1" class="form-control" id="exampleFormControlInput1"
                        placeholder="nama peserta 1">
                </div>
                <div id="form"></div>
                <button type="button" onclick="myFunction()" class="btn btn-outline-primary"
                    style="border-style: dotted;width:48%">Tambah Baris</button>
                <button type="submit" class="btn btn-warning" style="float:right;width:48%">Buat</button>
            </form>
        @else
            {{-- //form edit --}}
            <form method="POST" action="{{ url('/group/edit/peserta/' . $kelompok[0]->id) }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Kelompok</label>
                    <input type="text" class="form-control" name="name" value="{{ $kelompok[0]->name_k }}"
                        id="exampleFormControlInput1" placeholder="nama kelompok">
                </div>
                @php
                    $i = 1;
                @endphp
                @foreach ($peserta as $item)
                    <div class="mb-3">
                        <input type="text" name="{{ $item->id }}" value="{{ $item->name }}" class="form-control"
                            id="exampleFormControlInput1" placeholder="nama peserta 1">
                    </div>
                @endforeach
                <div id="form"></div>
                <button type="button" onclick="add()" class="btn btn-outline-primary"
                    style="border-style: dotted;width:48%">Tambah Baris</button>
                <button type="submit" class="btn btn-warning" style="float:right;width:48%">edit</button>
            </form>
        @endif
    </div>
@endsection
@section('script')
    <script>
        var i = 2;

        function myFunction() {
            var form = document.getElementById("form");
            var input = document.createElement("input");
            var div = document.createElement("div");
            //  var count=document.getElementById("count");
            form.appendChild(div)
            div.appendChild(input)

            div.setAttribute('class', 'mb-3')
            input.setAttribute('style', 'margin-bottom:10px')
            input.setAttribute('class', 'form-control');
            input.setAttribute('name', 'peserta' + i);
            input.setAttribute('placeholder', 'nama peserta ' + i);
            //  count.value=i;
            i++
        }
        var a = 1;

        function add() {
            var form = document.getElementById("form");
            var input = document.createElement("input");
            var div = document.createElement("div");
            //  var count=document.getElementById("count");
            form.appendChild(div)
            div.appendChild(input)

            div.setAttribute('class', 'mb-3')
            input.setAttribute('style', 'margin-bottom:10px')
            input.setAttribute('class', 'form-control');
            input.setAttribute('name', 'no' + a);
            input.setAttribute('placeholder', 'new peserta ' + a);
            //  count.value=i;
            a++
        }
    </script>
@endsection
