@extends('layouts.layout')

@section('content')
<a class="btn btn-warning" href="{{url('/agenda/add')}}" style="float: right"><i class="bi bi-plus-square"></i></a>
<br>
<br>
<div class="card">
    <div class="card-body">
        @foreach ($agenda as $item)
        <div class="alert alert-success" role="alert">
            <h5><a>{{$item->name}}</a></h5>

         <div class="conteiner" >
            <div class="row align-items-start">
                <div class="col">
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                   </div>
                </div>
                <div class="col">
                  <a style="float: right;" href="{{url('/agenda/edit/'.$item->id)}}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                  <a style="float: right;margin-right:10px" href="{{url('/agenda/delete/'.$item->id)}}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>   
                </div>
                
             </div>
         </div>
         </div>        
         @endforeach
         @if($agenda->isEmpty())
         <div class="alert alert-success" role="alert">
             <p>Empty Data</p>
         </div>
         @endif
    </div>
</div>
    
@endsection
