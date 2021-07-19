@extends('layouts.layout')

@section('content')
            
                 
                 <div class="container">
                 <button type="button" style="float:right" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#eventmodal">
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
                    <p style="float: right; " > 
                      <i class="bi bi-calendar-week"></i>
                      {{ Carbon\Carbon::parse($item->waktu_awal)->isoFormat('dddd, D MMMM Y') }}
                    </p>
                    <h5 class="card-title">{{$item->name}}</h5>
                    <div class="container">
                    {{-- <div class="col-2"> --}}
                    <p class="card-text" style="color: #1EA5FC;float:left;margin-right:18px" ><i class="bi bi-geo-alt"></i> {{$item->lokasi}}</p>
                    {{-- </div> --}}
                    {{-- <div class="col-2" style="margin-bottom: 5px"> --}}
                    <p class="card-text"> <i class="bi bi-clock"></i> 8.00-20.00</p>
                    {{-- </div>  --}}
                    </div>
                    <div class="container" style="float: left">
                      <p class="card-text">
                        {{$item->deskripsi}}
                      </p>
                    </div>
                </div>
                </div><br>
                @endforeach


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
            <input type="text" class="form-control" name="name" id="exampleFormControlInput1" >
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Lokasi Event</label>
            <input type="text" class="form-control" name="lokasi" id="exampleFormControlInput1" >
          </div>
          <div class='mb-3'>
              <label >Date and Time</label>
              <div class="row">
                <div class="col">
                  <input type="date"  name="date" class="form-control" class="form-control" />
                </div>
                <div class="col">
                  <input type="text" name="time" timeformat="24h" class="form-control" class="form-control" />
                </div>
              </div>
              <label >Date and Time 2</label>
              <div class="row">
                <div class="col">
                  <input type="date"  name="date" class="form-control" class="form-control" />
                </div>
                <div class="col">
                  <input type="text" name="time" timeformat="24h" class="form-control" class="form-control" />
                </div>
              </div>
           
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
@endsection 
