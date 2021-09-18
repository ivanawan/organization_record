@extends('layouts.layout')

@section('content')
<div class="col d-flex justify-content-center">

            <div class="card" style="width:32rem; ">
                <div class="card-body">
                @if ($msg=Session::get('scc'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{$msg}}</strong>
</div>
@endif

@if ($msg = Session::get('err'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $msg }}</strong>
</div>
@endif
<form method="POST" action="{{ url('/new_group') }}">
                  @csrf
                  
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nama Group</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp" required>
</div>
<div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Group</label>
    <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3" required></textarea>
  </div>
  <a href="{{url('/code_group')}}" class="btn btn-primary">code group</a>
  <button type="submit" class="btn btn-primary">Create</button>
</form>
                </div>
            </div>
</div>            
          
@endsection
