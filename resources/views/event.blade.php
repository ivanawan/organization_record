@extends('layouts.layout')


@section('content')
<!-- <div class="container"> -->
    <!-- <div class="row justify-content-center"> -->
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header">
                 
                 <div style="float:right">
                 <button type="button" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#eventmodal">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg>
                </button>
               </div>
                </div>

                <div class="card-body">
                    @if ($data->isEmpty())
                        Empty event  let's create new event :v
                    @else
                        @foreach ($data as $item)
                            <div class="card">
                                <div card="body">

                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <br>
            
            {{-----------------------------------------modal --------------------------------}}
            <div class="modal fade" id="eventmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">add new Event</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('/event/add')}}" method="POST">
                            <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">neme Event</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">lokasi Event</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                          </div>
                          <div class="md-form mx-5 my-5">
                            <input placeholder="Waktu acara dimulai" type="text" data-open="picker2" class="form-control date-time picker-opener">
                            <input placeholder="Selected date" type="text" id="picker2"  class="form-control time-date-ghost">
                            <input placeholder="Selected time" data-open="picker2" type="text" class="form-control timepicker time-date-ghost">
                          </div>
                          
                          <div class="md-form mx-5 my-5">
                            <input placeholder="waktu acara berakhir" type="text" data-open="picker3" class="form-control date-time-2 picker-opener">
                            <input placeholder="Selected date" type="text" id="picker3"  class="form-control time-date-ghost">
                            <input placeholder="Selected time" data-open="picker3" type="text" class="form-control timepicker time-date-ghost">
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                          </div>
                        </form>
                        </div> 
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                  </div>
                </div>
              </div>
@endsection
