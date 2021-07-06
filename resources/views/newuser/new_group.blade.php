@extends('layouts.app')

@section('content')
<div class="container">
            <div class="card" style="width:32rem">
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
                  @csrf
  <a href="{{url('/resubmit')}}">resubmit code?</a>                
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nama Group</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
</div>
<div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Group</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
                </div>
            </div>
</div>
            
          
@endsection
