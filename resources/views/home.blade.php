@extends('layouts.layout')


@section('content')

            <div class="container">
                <div class="card">
                    <div class="card-body">
                <canvas id="myChart" width="100%" height="50vh"></canvas>
                </div>
                </div>
            </div>

            <br>
            {{-- buat event --}}
            <div class="card">
                <div class="card-body">
                    <h4 style="color:rgb(140, 214, 171)">#Event</h4>

                    <div class="card w-50">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                          <a href="#" class="btn btn-primary">Button</a>
                        </div>
                      </div>

                      <div class="card w-50">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                          <a href="#" class="btn btn-primary">Button</a>
                        </div>
                      </div>

                      <div class="card w-50">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                          <a href="#" class="btn btn-primary">Button</a>
                        </div>
                      </div>

                      <div class="card w-50">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                          <a href="#" class="btn btn-primary">Button</a>
                        </div>
                      </div>


                </div>
            </div>
       {{-- event end --}}


            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        Menu 
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



            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        Menu 
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
@endsection
