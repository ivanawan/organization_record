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
@section('script')
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});   
</script>
@endsection