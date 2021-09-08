@extends('layouts.layout')


@section('content')
<div class="container" style="padding-left:20%;padding-right:20%">
  @if (!isset($list))
  {{-- absen --}}
<form method="POST"  action="{{url('/event/absen/'.$id)}}">
                @csrf

                @php
                 $i=0;
                 $check=count($checked);
                 $all=count($data);
                @endphp
                <div class="card">
                  <div class="card-header">
                    <button type="button" style="float: right" class="btn btn-outline-primary">{{$check.'/'.$all}}</button> 
                Absensi peserta 
                  </div>
                  <div class="card-body" style="height: 60vh; overflow: auto;">
                    
      @foreach ($data as $item)
      <div class="row">
        <div class="col-11">
          <div  class="alert alert-success" role="alert">
            {{$item->name}}
          </div>
        </div>
<div class="col-1">
  <div class="form-check">
    @if (in_array($item->id,$checked))
    <input style="margin-top:4vh" class="form-check-input" type="checkbox" name="{{'checkbox'.$i++}}" value="{{$item->id}}" id="flexCheckDefault" checked>
    @else
    <input style="margin-top:4vh" class="form-check-input" type="checkbox" name="{{'checkbox'.$i++}}" value="{{$item->id}}" id="flexCheckDefault">
    @endif
  </div>
</div>
      </div>
      @endforeach
      
                  </div>
                  <div class="card-footer">
                    <button type="submit" style="float: right" class="btn btn-success">submit</button>
                  </div>
                </div>
              </form>
              @else
              {{-- memilih kelompok   --}}
              <form method="POST" action="/event/kelompok/{{$id}}">
                @csrf
                <div class="card">
                  <div class="card-header">
                 pilih Kelompok Peserta
                  </div>
                  <div class="card-body" style="height: 60vh; overflow: auto;">
      @foreach ($list as $item)
      <div class="row">
        <div class="col-11">
          <div  class="alert alert-primary" role="alert">
            {{$item->name_k}}
          </div>
        </div>
<div class="col-1">
  <div class="form-check">
    <input style="margin-top:4vh" class="form-check-input" type="radio" name="radio" id="flexRadioDefault1" value="{{$item->id}}">
  </div>
</div>
      </div>
      @endforeach
      
                  </div>
                  <div class="card-footer">
                    <button type="submit" style="float: right" class="btn btn-primary">next</button>
                  </div>
                </div>
              </form>
              @endif
            </div>
@endsection