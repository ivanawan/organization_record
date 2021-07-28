@extends('layouts.layout')


@section('content')

            <div class="container" style="padding-left:20%;padding-right:20%">
                <form method="POST"  action="{{url('/group/addpeserta')}}">
                    @csrf
                      {{-- <input type="text" name="count" value="1" style="visibility: hidden" id="count"> --}}
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Kelompok</label>
                        <input type="text"  class="form-control" name="name" id="exampleFormControlInput1" placeholder="nama kelompok">
                      </div>
                      <div class="mb-3">
                      <input type="text" name="peserta1" class="form-control" id="exampleFormControlInput1" placeholder="nama peserta 1">
                      </div>                 
                      <div id="form"></div>
                      <button type="button" onclick="myFunction()" class="btn btn-outline-primary" style="border-style: dotted;width:48%">Tambah Baris</button>
                      <button type="submit" class="btn btn-warning" style="float:right;width:48%">Buat</button>
                    </form>
            </div>
@endsection
@section('script')
    <script>
        var i = 2;
    function myFunction(){
     var form=document.getElementById("form");
     var input=document.createElement("input");
     var div=document.createElement("div");
    //  var count=document.getElementById("count");
     form.appendChild(div)
     div.appendChild(input)
 
     div.setAttribute('class','mb-3')
     input.setAttribute('style','margin-bottom:10px')
     input.setAttribute('class','form-control');
     input.setAttribute('name','peserta'+i);
     input.setAttribute('placeholder','nama peserta '+i);
    //  count.value=i;
     i++
    }
    </script>
@endsection
