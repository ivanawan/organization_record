@extends('layouts.layout')

@section('content')
<div class="sm:pr-0 sm:mb-2 md:mb-6 sm:pl-0 md:pr-10 md:pl-10 lg:pr-40 lg:pl-40">

    @csrf
    {{-- titile and description --}}
    <div class="card">
        <div class="card-body">
            <h4>{{$agendaView->name}}</h4>
            <p>
                {{$agendaView->desc}}
            </p>
        </div>    
    </div> 
    <br>
    {{-- agenda item --}} 
    @guest
    <div class="accordion accordion-flush" id="accordionFlushExample">
      @foreach ($items as $item)
          <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="{{'#collapseTwo'.$item->id}}" aria-expanded="false" aria-controls="collapseTwo">
                          {{$item->step}} 
                        </button>
                </div>
              </h2>
              <div id="{{'collapseTwo'.$item->id}}" class="accordion-collapse collapse" style="background-color: #e8eefc" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                 {{$item->desc}}
              </div>
              
            </div>
            @endforeach
          </div>
    @else
    
    <form method="POST" action="{{ url('/agenda/view/'.$agendaView->id) }}">
        @csrf
    <div class="accordion accordion-flush" id="accordionFlushExample">
    @foreach ($items as $item)
        <div class="accordion-item ">
            <h2 class="accordion-header" id="headingTwo">
              <div class="row">
                  <div class="col-11">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="{{'#collapseTwo'.$item->id}}" aria-expanded="false" aria-controls="collapseTwo">
                        {{$item->step}} 
                      </button>
                  </div>
                  <div class="col-1 p-0">
                    @if($item->finish==0)
                        <input class="form-check-input" name="{{$item->id}}" type="checkbox" value="1" id="flexCheckDefault">
                    @else
                       <input class="form-check-input"  name="{{$item->id}}" type="checkbox" value="1" id="flexCheckChecked" checked>
                    @endif
                  </div>
              </div>
            </h2>
            <div id="{{'collapseTwo'.$item->id}}" class="accordion-collapse collapse" style="background-color: #e8eefc" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
               {{$item->desc}}
            </div>
            </div>
          </div>
          @endforeach
        </div>
        <br>

          <button type="submit" class="btn btn-warning" style="float:right;width:48%">Go</button>
        
    </form>
        
    @endguest
  
        
        {{-- end agenda item --}}
</div>
    @endsection