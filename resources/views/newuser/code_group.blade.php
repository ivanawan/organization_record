@extends('layouts.layout')

@section('content')
<div class="row justify-content-center">
            <div class="card" style="width:32rem">
                <div class="card-body">
                <form method="POST" action="{{ url('/code_group') }}">
                  @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Code</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="id_group" aria-describedby="emailHelp" required>
</div> 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
                </div>
            </div>
            
</div>
          
@endsection
