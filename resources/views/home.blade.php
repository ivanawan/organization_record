@extends('layouts.layout')

@section('content')
<!-- <div class="container"> -->
    <!-- <div class="row justify-content-center"> -->
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header">
                 Pengurus
                 <div style="float:right">
                 <button type="button" class="btn btn-warning">Warning</button>
                 <button type="button" class="btn btn-info">Info</button> 
               </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <br>
            
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        Menu 
                    </div>
                <!-- <div style="float:right">
                 <button type="button" class="btn btn-warning">Warning</button>
                 <button type="button" class="btn btn-info">Info</button> 
               </div> -->
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        <!-- </div> -->
    <!-- </div> -->
<!-- </div> -->
@endsection
