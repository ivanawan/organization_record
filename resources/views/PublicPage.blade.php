@extends('layouts.layout')


@section('content')
<div class="container">
    <button type="button" style="float:right; color:#fff" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#eventmodal">
        <i class="bi bi-sliders"></i>
   </button>
  {{-- grafik panel    --}}
  <br>
  <br>
 @if (!isset($grafik))    
 <div class="container">
    <div class="row row-cols-3">
      <div class="col">
        <div class="card">
            <div class="card-body">
                
            </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
            <div class="card-body">
                
            </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
            <div class="card-body">
                
            </div>
        </div>
      </div>
    </div>
  </div>
@endif   
{{-- grafik panel    --}}
{{-- new  event --}}
@if (isset($event))    
<div class="card">
    <div class="card-body">
        
    </div>
</div>
@endif
{{-- end new  event --}}
{{-- note group--}}
@if (isset($note))    
<div class="card">
    <div class="card-body">
        
    </div>
</div>
@endif

@if (isset($keuangan))    
<div class="card">
    <div class="card-body">
        
    </div>
</div>
@endif
@if (isset($keuangan))    
<div class="card">
    <div class="card-body">
        
    </div>
</div>
@endif
</div>
@endsection