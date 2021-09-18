@extends('layouts.layout')

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
<h3> tunggu admin menambahkan anda kedalam group</h3>
                </div>
            </div>
</div>
            
          
@endsection
