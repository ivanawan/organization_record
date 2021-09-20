@extends('layouts.layout')

@section('content')
<a class="btn btn-warning" href="{{url('/agenda/add')}}" style="float: right"><i class="bi bi-plus-square"></i></a>
<br>
<br>
<div class="card">
    <div class="card-body">
        @foreach ($agenda as $item)
        <div class="alert alert-info" role="alert">
            <h6><a href="{{url('/agenda/view/'.$item->id)}}" style="text-decoration: none">{{$item->name}}</a></h6>

         <div class="conteiner" >
            <div class="row align-items-start">
                <div class="col">
                    <p style="font-size:10px;color:black">{{$item->finishtask.' / '.$item->alltask}}</p>
                     <div class="progress">
                        @php
                           if($item->finishtask==0){
                            $value=0;
                           }else { 
                               $value= $item->finishtask/$item->alltask;
                               $value=$value*100;  
                           }
                        @endphp
                        
                        <div class="progress-bar progress-bar-striped  bg-info" role="progressbar" style="{{'width:'.$value.'%'}}" aria-valuenow="{{$value}}" aria-valuemin="0" aria-valuemax="100"></div>
                        
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
         <div class="alert alert-primary" role="alert">
            no have Event to Preview
          </div>
         @endif
    </div>
</div>
    
@endsection
