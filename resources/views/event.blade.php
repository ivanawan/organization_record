@extends('layouts.layout')

@section('content')
            
                 
                 <div class="container">
                 <button type="button" style="float:right; color:#fff" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#eventmodal">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg>
                </button>
               </div>
              
                 <br>
                 <br>
                 @foreach ( $data as $item)
                     
                 
                 <div class="card">
                  <div class="card-body">
                    <div class="btn-group" style="float: right">
                    <a  type="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                      <i class="bi bi-three-dots-vertical"></i>
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item"  href="{{url('/absen/'.$item->id)}}">Absen </a></li>
                      <li>
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" 
                        data-bs-namaEvent="{{$item->name}}" data-bs-id="{{$item->id}}" data-bs-tanggal="{{$item->tanggal}}" 
                        data-bs-waktu="{{$item->waktu}}" data-bs-lokasi="{{$item->lokasi}}" data-bs-keterangan="{{$item->deskripsi}}" href="">Edit</a>
                      </li>
                      <li><a class="dropdown-item" href="{{url('/event/delete/'.$item->id)}}">Delete</a></li>
                    </ul>
                    </div>
                    <h5 class="card-title ">{{Str::title($item->name) }}</h5><br>
                    <div class="container">
                      <p class="card-text">
                        <i class="bi bi-calendar-week"></i>
                        {{Carbon\Carbon::parse($item->tanggal)->isoFormat('dddd, D MMMM Y')}}
                      </p>  
                    <p class="card-text" style="color: #1EA5FC;float:left;margin-right:18px" ><i class="bi bi-geo-alt"></i> {{$item->lokasi}}</p>
                    @if ($item->waktu != null)
                    <p class="card-text"> <i class="bi bi-clock"></i> {{$item->waktu}}</p>
                    @endif
                    </div>
                    <div class="container" style="float: left">
                      <p class="card-text">
                        {{$item->deskripsi}}
                      </p>
                     </div><br><br>
                     <h8 style="float: right;color:gray;font-size:10px" > 
                      Dibuat {{ Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y') }}
                    </h8>
                           
                </div>
              </div><br>
              @endforeach
              {{ $data->links('vendor.pagination.custom') }}


<!-- Modal -->
<div class="modal fade" id="eventmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{url('/event/add')}}" method="POST">
          @csrf
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama Event</label>
            <input type="text" class="form-control" name="name" id="exampleFormControlInput1" required>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Lokasi Event</label>
            <input type="text" class="form-control" name="lokasi" id="exampleFormControlInput1" required>
          </div>
          <div class='mb-3'>
              <label >tangal dan waktu</label>
              <div class="row">
                <div class="col">
                  <input type="date"  name="tanggal" class="form-control" class="form-control" required />
                </div>
                <div class="col">
                  <input type="text" name="waktu" timeformat="24h" class="form-control" class="form-control" required/>
                </div>
              </div>
          <br>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Ketegarangan Tambahan </label>
            <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">save</button>
                        </form>
      </div>
    </div>
  </div>
</div>
{{-- modal 2 --}}

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id="form">
          @csrf
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" name="name" class="form-control" id="name">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Lokasi:</label>
            <input type="text" name="lokasi" class="form-control" id="lokasi">
          </div>
          {{-- //////////// --}}
          <div class='mb-3'>
            <label >tangal dan waktu</label>
            <div class="row">
              <div class="col">
                <input type="date"  name="tanggal" class="form-control" id="date" class="form-control" required />
              </div>
              <div class="col">
                <input type="text" name="waktu" timeformat="24h" class="form-control" id="time" class="form-control" required/>
              </div>
            </div>
          </div>
          {{-- //////////// --}}
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Deskripsi:</label>
            <textarea class="form-control" name="deskripsi" id="message-text"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection 
@section('script')
<script>
var exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-namaEvent')
  var recipient1 = button.getAttribute('data-bs-lokasi')
  var recipient2 = button.getAttribute('data-bs-tanggal')
  var recipient3 = button.getAttribute('data-bs-waktu')
  var recipient4 = button.getAttribute('data-bs-id')
  var recipient5 = button.getAttribute('data-bs-keterangan')


  // var  data = button.getAttribute('date')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var form = exampleModal.querySelector('#form')
  var name = exampleModal.querySelector('#name')
  var tanggal=exampleModal.querySelector('#date')
  var date = exampleModal.querySelector('#time')
  var lokasi = exampleModal.querySelector('#lokasi')
  var deskripsi = exampleModal.querySelector('.modal-body textarea');
  
  // modalTitle.textContent = 'New message to ' + recipient
  
  name.value= recipient
  lokasi.value = recipient1
  tanggal.value =recipient2
  date.value= recipient3
  form.setAttribute('action',"/event/edit/"+recipient4)
  deskripsi.value = recipient5
})


</script>
@endsection