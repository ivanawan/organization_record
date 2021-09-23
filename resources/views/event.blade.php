@extends('layouts.layout')

@section('content')


    <div class=" flex justify-end">
        <button type="button "  class="btn btn-warning m-3" data-bs-toggle="modal"
            data-bs-target="#eventmodal">
            <i class="bi bi-plus-lg"></i>
        </button>
    </div>

    
    @forelse ($data as $item)
    
   
        <div class="card shadow-md">
            <div class="card-body">
                <div class="btn-group " style="float: right">
                    <a type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ url('/absen/' . $item->id) }}">Absen </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/absen/reset/' . $item->id) }}">Reset Absen </a>
                        </li>
                        <li>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-bs-namaEvent="{{ $item->name }}" data-bs-id="{{ $item->id }}"
                                data-bs-tanggal="{{ $item->tanggal }}" data-bs-waktu="{{ $item->waktu }}"
                                data-bs-lokasi="{{ $item->lokasi }}" data-bs-keterangan="{{ $item->deskripsi }}"
                                href="">Edit</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ url('/event/delete/' . $item->id) }}">Delete</a></li>
                    </ul>
                </div>
                <h5 class="card-title ">{{ Str::title($item->name) }}</h5><br>
                <div class="container">
                    <p class="card-text">
                        <i class="bi bi-calendar-week"></i>
                        {{ Carbon\Carbon::parse($item->tanggal)->isoFormat('dddd, D MMMM Y') }}
                    </p>
                    <p class="card-text" style="color: #1EA5FC;float:left;margin-right:18px"><i
                            class="bi bi-geo-alt"></i> {{ $item->lokasi }}</p>
                    @if ($item->waktu != null)
                        <p class="card-text"> <i class="bi bi-clock"></i> {{ $item->waktu }}</p>
                    @endif
                </div>
                <div class="container" style="float: left">
                    <p class="card-text">
                    @if (Str::length($item->deskripsi) >= 250)
                        <span id="text1" hide="1">{{ Str::limit($item->deskripsi, 200, '....') }}</span>
                        <span id="text2" style="display:none">{{ $item->deskripsi }}</span>
                        <a style="color:#1EA5FC" id="button" onclick="readmore()">Read more</a>
                    @else
                        {{ $item->deskripsi }}
                    @endif
                    </p>
                </div><br><br>
                <p style="float: right;color:gray;font-size:10px">
                    Dibuat {{ Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y') }}
                </p>

            </div>
        </div><br>
        @empty 
        <div class="card">
            <div class="card-body">
                <div class="alert alert-primary" role="alert">
                    no have Data to Preview
                  </div>
            </div>
        </div>
    @endforelse
    {{ $data->links('vendor.pagination.custom') }}


    <!-- Modal -->
    <div class="modal fade" id="eventmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/event/add') }}" method="POST">
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
                            <label>tangal dan waktu</label>
                            <div class="row">
                                <div class="col">
                                    <input type="date" name="tanggal" class="form-control" class="form-control"
                                        required />
                                </div>
                                <div class="col">
                                    <input type="text" name="waktu" timeformat="24h" class="form-control"
                                        class="form-control" required />
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Ketegarangan Tambahan
                                </label>
                                <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1"
                                    rows="3"></textarea>
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
                            <label>tangal dan waktu</label>
                            <div class="row">
                                <div class="col">
                                    <input type="date" name="tanggal" class="form-control" id="date"
                                        class="form-control" required />
                                </div>
                                <div class="col">
                                    <input type="text" name="waktu" timeformat="24h" class="form-control" id="time"
                                        class="form-control" required />
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function readmore(){
           var text1 = document.getElementById('text1')
           var text2 = document.getElementById('text2')
           var kondisi= text1.getAttribute('hide')
           var button = document.getElementById('button')
           
           if(kondisi==1){
            text2.setAttribute('style','')
            text1.setAttribute('style','display:none')
            text1.setAttribute('hide',0)
            button.innerHTML='Read less'
           }
           if(kondisi==0){
            text1.setAttribute('style','')
            text2.setAttribute('style','display:none')
            text1.setAttribute('hide',1)
            button.innerHTML='Read more'
           }
        }
        var exampleModal = document.getElementById('exampleModal')
        exampleModal.addEventListener('show.bs.modal', function(event) {
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
            var tanggal = exampleModal.querySelector('#date')
            var date = exampleModal.querySelector('#time')
            var lokasi = exampleModal.querySelector('#lokasi')
            var deskripsi = exampleModal.querySelector('.modal-body textarea');

            // modalTitle.textContent = 'New message to ' + recipient

            name.value = recipient
            lokasi.value = recipient1
            tanggal.value = recipient2
            date.value = recipient3
            form.setAttribute('action', "/event/edit/" + recipient4)
            deskripsi.value = recipient5
        })
    </script>
@endsection
