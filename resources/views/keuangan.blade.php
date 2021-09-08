@extends('layouts.layout')


@section('content')
<!-- <div class="container"> -->
    <!-- <div class="row justify-content-center"> -->
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header">
                 <h3 style="float: left">keuangan<h3>
                 <div style="float:right">
                  <div class="input-group mb-3">
                    @php
                        if($total==null){
                          $total=0;
                        }else{ $total = $total->total;}
                        @endphp
                    <input type="text" class="form-control" value="@uang($total)" aria-label="Example text with button addon" aria-describedby="button-addon1" disabled readonly>
                    <button class="btn" style="background-color: #FECB4D" type="button" id="button-addon1" data-bs-toggle="modal" data-bs-target="#eventmodal">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                      </svg>
                    </button>
                  </div>
                   
               </div>
                </div>
                <div class="card-body">
                  @foreach ($data as $item)
                      @if ($item->role==1)
                                                              
                  {{-- alert-p --}}
                  <a type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal" date="{{'dibuat pada '.Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y')}}" data-bs-whatever="{{$item->keterangan}}">
                    <div class="alert alert-primary" role="alert">
                      <p style="float: right;"> +@uang($item->jumlah)</p>
                      {{$item->name}}
                    </div>
                  </a> 
                  @else
                  {{-- alert-p --}}
                  <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" date="{{'dibuat pada '.Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y')}}" data-bs-whatever="{{$item->keterangan}}">
                    <div class="alert alert-danger" role="alert">
                      <p style="float: right; "> -@uang($item->jumlah)</p>
                      {{$item->name}} 
                    </div>
                  </a>
                  @endif
                  @endforeach
                </div>
            </div>
            <br>
            {{ $data->links('vendor.pagination.custom') }}
            
              {{-----------------------------------------modal  1--------------------------------}}
              <div class="modal fade" id="eventmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Tambah Pengeluaran/ Pemasukan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('/keuangan/add')}}" method="POST">
                          @csrf
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">nama</label>
                            <input type="text" class="form-control" name="name" id="exampleFormControlInput1" >
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">jumlah</label>
                            <input type="text"  class="form-control" name="jumlah" id="rupiah" >
                          </div>
                          <select class="form-select" name="role" aria-label="Default select example">
                            <option value="1" selected>Pemasukan</option>
                            <option value="0">Pengeluaran</option>
                          
                          </select>
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="3"></textarea>
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
@endsection
@section('script')
<script>
var exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  var  data = button.getAttribute('date')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var date = exampleModal.querySelector('.modal-body a')
  // var modalBodyInput = exampleModal.querySelector('.modal-body input')
  var text = exampleModal.querySelector('.modal-body p');
  // modalTitle.textContent = 'New message to ' + recipient
  date.textContent= data
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