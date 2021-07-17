@extends('layouts.layout')


@section('content')
<!-- <div class="container"> -->
    <!-- <div class="row justify-content-center"> -->
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header">
                 keuangan
                 <div style="float:right">
                  <div class="input-group mb-3">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon1" data-bs-toggle="modal" data-bs-target="#eventmodal">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                      </svg>
                    </button>
                    <input type="text" class="form-control" value="Rp-, 1000.000" aria-label="Example text with button addon" aria-describedby="button-addon1" disabled readonly>
                  </div>
                   
               </div>
                </div>
                <div class="card-body">
                 {{-- alert-p --}}
                  <a type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="makan">
                  <div class="alert alert-primary" role="alert">
                    <p style="float: right;color:rgb(108, 182, 108)">+100.000</p>
                     baut makan makan 
                  </div>
                  </a>
                   {{-- alert-p --}}
                   <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="makan">
                   <div class="alert alert-warning" role="alert">
                    <p style="float: right; color:rgb(182, 79, 79)">+100.000</p>
                     baut makan makan 
                  </div>
                </a>
                </div>
            </div>
            <br>
            
              {{-----------------------------------------modal  1--------------------------------}}
              <div class="modal fade" id="eventmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel"></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('/keuangan/add')}}" method="POST">
                          @csrf
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">nama</label>
                            <input type="text" class="form-control" name="nama" id="exampleFormControlInput1" >
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="exampleFormControlInput1" >
                          </div>
                          <select class="form-select" name="role" aria-label="Default select example">
                            <option value="1" selected>Masuk</option>
                            <option value="0">Keluar</option>
                          
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
                      <p id="p"></p>
                      
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
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  // var modalTitle = exampleModal.querySelector('.modal-title')
  // var modalBodyInput = exampleModal.querySelector('.modal-body input')
  var text = exampleModal.querySelector('.modal-body p');
  // modalTitle.textContent = 'New message to ' + recipient
  text.textContent = recipient 
  // modalBodyInput.value = recipient
})
</script>
@endsection