@extends('layouts.layout')

@section('content')
<div class="sm:pr-0 sm:mb-2 md:mb-6 sm:pl-0 md:pr-10 md:pl-10 lg:pr-40 lg:pl-40" >

  
@if(isset($agendaEdit))
    <form method="POST" action="{{ url('/agenda/edit/'.$agendaEdit->id) }}">
        @csrf
             {{-- titile and description --}}
            <div class="card">
            <div class="card-body">
                
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Agenda</label>
                <input type="text" name="name" value="{{$agendaEdit->name}}" class="form-control" name="name" id="exampleFormControlInput1"
                placeholder="nama" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                <textarea placeholder="Deskipsikan agenda yang anda buat" name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$agendaEdit->desc}}</textarea>
              </div> 
    
            </div>    
            </div> 
        <br>
            
            {{-- agenda item --}}
            @foreach ($items as $item)
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{$item->step}}" name="{{"data".$item->id}}" placeholder="item agenda 1" id="myInput" >
                <a class="btn" style="background-color: #FECB4D" data-bs-toggle="collapse" href="{{"#collapseExampl".$item->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="bi bi-plus"></i>
                </a>
            </div>
            
            <div class="collapse" id="{{'collapseExampl'.$item->id}}" style="margin-bottom:10px">
                <textarea placeholder="deskripsi item agenda" name="{{'desc'.$item->id}}" class="form-control" id="exampleFormControlTextarea1" rows="2">{{$item->desc}}</textarea>
            </div>
            @endforeach
            {{-- end agenda item --}}
    
        <div id="form"></div>
        <button type="button" onclick="myFunction()" class="btn btn-outline-primary"
            style="border-style: dotted;width:48%">Tambah Item</button>
        <button type="submit" class="btn btn-warning" style="float:right;width:48%">Edit</button>
    </form>
<br>
<br>


@endif  
@if (!isset($agendaEdit) )
<form method="POST" action="{{ url('/agenda/add') }}">
    @csrf
         {{-- titile and description --}}
        <div class="card">
        <div class="card-body">
            
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama Agenda</label>
            <input type="text" name="name" class="form-control" name="name" id="exampleFormControlInput1"
            placeholder="nama" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
            <textarea placeholder="Deskipsikan agenda yang anda buat" name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
          </div> 

        </div>    
        </div> 
        <br>
        {{-- agenda item --}}
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="1" placeholder="item agenda 1" id="myInput" >
            <a class="btn" style="background-color: #FECB4D" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="bi bi-plus"></i>
            </a>
        </div>

        <div class="collapse" id="collapseExample" style="margin-bottom:10px">
                <textarea placeholder="deskripsi item agenda" name="descitem1" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
        </div>
        {{-- end agenda item --}}

    <div id="form"></div>
    <button type="button" onclick="myFunction()" class="btn btn-outline-primary"
        style="border-style: dotted;width:48%">Tambah Item</button>
    <button type="submit" class="btn btn-warning" style="float:right;width:48%">Buat</button>
</form>
@endif  
</div>
@endsection
@section('script')
    <script>
        var i = 2;

        function myFunction() {
            var form = document.getElementById("form");
            //buat input buttom
            var div = document.createElement("div");
            var input = document.createElement("input");
            var button= document.createElement("a")
            var iconbutton=document.createElement("i")
            //buat text area
            var div2= document.createElement("div")
            // var label= document.createElement("label")
            var textarea= document.createElement("textarea")
            
            //buat input buttom
            form.appendChild(div)
            div.appendChild(input)
            div.appendChild(button)
            button.appendChild(iconbutton)
            
            //buat text area
            form.appendChild(div2)
            // div2.appendChild(label)
            div2.appendChild(textarea)
             
            //buat input buttom 
            div.setAttribute('class', 'input-group mb-3')
            div.setAttribute('style', 'margin-bottom:10px')

            //buat input buttom
            input.setAttribute('class', 'form-control');
            input.setAttribute('name', i);
            input.setAttribute('placeholder', 'item agenda ' + i);

            //buat input buttom
            button.setAttribute('data-bs-toggle','collapse')
            button.setAttribute('href','#collapseExample'+i)
            button.setAttribute('aria-expanded','false')
            button.setAttribute('aria-controls','collapseExample'+i)
            button.setAttribute('class','btn')
            button.setAttribute('style','background-color: #FECB4D')
            iconbutton.setAttribute('class','bi bi-plus')
           
            //buat text area
            div2.setAttribute('class','collapse')
            div2.setAttribute('id','collapseExample'+i)
            div2.setAttribute('style','margin-bottom:10px')

            // label.setAttribute('for','exampleFormControlTextarea1')
            // label.setAttribute('class','form-label')
            
            textarea.setAttribute('class','form-control')
            textarea.setAttribute('row','2')
            textarea.setAttribute('name','descitem'+i)
            textarea.setAttribute('placeholder','deskripsi item agenda '+i)


            i++
        }
       
    </script>
@endsection