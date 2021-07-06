@extends('layouts.app')

@section('content')
<div class="container">
            <div class="card" style="width:32rem">
                <div class="card-body">
                <form method="POST" action="{{ url('/new_user') }}">
                  @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
</div>
<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Code Group</label>
    <div id="emailHelp" class="form-text">masukan code group jika punya jika tidak kosongkan</div>
    <input type="text" name="id_group" class="form-control" id="exampleInputPassword1">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
                </div>
            </div>
</div>
            
          
@endsection
