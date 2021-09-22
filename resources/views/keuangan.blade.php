@extends('layouts.layout')


@section('content')
  
    <div class="card">
        <div class="card-header">
            <h3 style="float: left">keuangan<h3>
                    <div style="float:right">
                        <div class="input-group mb-3">
                            @php
                                if ($last_data == null) {
                                    $total = 0;
                                }else {
                                   $total=$last_data->total;
                                }
                            @endphp
                            <input type="text" class="form-control" value="@uang($total)"
                                aria-label="Example text with button addon" aria-describedby="button-addon1" disabled
                                readonly>
                            <button class="btn" style="background-color: #FECB4D" type="button" id="button-addon1"
                                data-bs-toggle="modal" data-bs-target="#eventmodal">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>

                    </div>
        </div>
        <div class="card-body">
            @if($data->isEmpty())
            <div class="alert alert-primary" role="alert">
                no have Data to Preview
              </div>
            @endif
            @foreach ($data as $item)
                @if ($item->role == 1)

                    {{-- alert-p --}}
                    <a type="button" data-bs-toggle="modal" 
                    @if($last_data->id==$item->id)
                        data-bs-target="#editModal" 
                    @else
                         data-bs-target="#exampleModal"
                        date="{{ 'dibuat pada ' . Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y') }}"
                        data-bs-whatever="{{ $item->keterangan }}"
                    @endif
                    >
                        <div class="alert alert-primary" role="alert">
                            <p style="float: right;"> +@uang($item->jumlah)</p>
                            {{ Str::title($item->name) }}
                        </div>
                    </a>
                @else
                    {{-- alert-p --}}
                    <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        date="{{ 'dibuat pada ' . Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y') }}"
                        data-bs-whatever="{{ $item->keterangan }}">
                        <div class="alert alert-danger" role="alert">
                            <p style="float: right; "> -@uang($item->jumlah)</p>
                            {{ Str::title($item->name) }}
                        </div>
                    </a>
                @endif
             
            
            @endforeach
        </div>
    </div>
    <br>
    {{ $data->links('vendor.pagination.custom') }}

    {{-- ---------------------------------------modal  1------------------------------ --}}
    <div class="modal fade" id="eventmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Pengeluaran/ Pemasukan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/keuangan/add') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">nama</label>
                            <input type="text" class="form-control" name="name" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">jumlah</label>
                            <input type="text" class="form-control" name="jumlah" id="rupiah">
                        </div>
                        <select class="form-select" name="role" aria-label="Default select example">
                            <option value="1" selected>Pemasukan</option>
                            <option value="0">Pengeluaran</option>

                        </select>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1"
                                rows="3"></textarea>
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
                    <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a style="float: right;color:gray;font-size:13px" id="h"></a><br>
                    <p id="p" style="white-space: pre-wrap"></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

{{-- modal edit --}}
 @if (!$last_data==null)
     
 
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Pengeluaran/ Pemasukan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/keuangan/edit/'.$last_data->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">nama</label>
                        <input type="text" id="nama" value="{{$last_data->name}}" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">jumlah</label>
                        <input type="text"  class="form-control"  value="{{$last_data->jumlah}}"  name="jumlah" id="rupiah">
                    </div>
                    <select class="form-select" id="role" name="role" aria-label="Default select example">
                        <option value="1" @if($last_data->role==1)selected @endif>Pemasukan</option>
                        <option value="0" @if($last_data->role==0)selected @endif>Pengeluaran</option>

                    </select>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan"
                            rows="3">{{$last_data->keterangan}}</textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <a type="button"  href="{{ url('/keuangan/delete/'.$last_data->id) }}" class="btn btn-danger" >Delete</a>
                <button type="submit" class="btn btn-warning">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('script')
    <script>
        var exampleModal = document.getElementById('exampleModal')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-whatever')
            var data = button.getAttribute('date')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var date = exampleModal.querySelector('.modal-body a')
            // var modalBodyInput = exampleModal.querySelector('.modal-body input')
            var text = exampleModal.querySelector('.modal-body p');
            // modalTitle.textContent = 'New message to ' + recipient
            date.textContent = data
            text.textContent = recipient
            // modalBodyInput.value = recipient
        })

       
    
        var rupiah = document.getElementById("rupiah");
        rupiah.addEventListener("keyup", function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, "Rp. ");
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
    </script>
@endsection
