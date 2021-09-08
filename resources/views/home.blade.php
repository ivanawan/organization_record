@extends('layouts.layout')


@section('content')
<div class="container">
    <button type="button" style="float:right; color:#fff" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#eventmodal">
        <i class="bi bi-sliders"></i>
   </button>
  {{-- grafik panel    --}}
  <br>
  <br>
 @if (isset($keuangan))    
 <div class="container">
     <label>keuangan bulan</label>
    <div class="row row-cols-3">
      <div class="col">
        <div class="card">
            <div class="card-body">
              Pengeluaran: @uang($keuangan[0])
            </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
            <div class="card-body">
               Pemasukan: @uang($keuangan[1])
            </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
            <div class="card-body">
             Total: @uang($keuangan[2])
            </div>
        </div>
      </div>
    </div>
  </div>
@endif   
{{-- grafik panel    --}}
{{-- new  event --}}
@if (isset($event))    
<div class="card">
    <div class="card-body">
        
    </div>
</div>
@endif
{{-- end new  event --}}
{{-- note group--}}
@if (isset($note))    
<div class="card">
    <div class="card-body">
        
    </div>
</div>
@endif

@if (isset($hh))    
<div class="card">
    <div class="card-body">
        
    </div>
</div>
@endif
@if (isset($not))    
<div class="card">
    <div class="card-body">
        
    </div>
</div>
@endif
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