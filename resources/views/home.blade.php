@extends('layouts.layout')


@section('content')

        {{-- panel group & pengurus --}}
        <div class="card sm:mb-3" >
            <div class="card-body">
                <h3 style="color: #39A2DB"> {{ Str::title($group->name) }} </h3>
                <br>
                <p>
                    <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                        aria-expanded="false" aria-controls="collapseExample">
                        Deskripsi
                    </a>
                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse" aria-expanded="false" aria-controls="collapseExample">
                        Anggota
                    </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="container" style="background-color: #d2e5ff;border-radius:15px">
                        {{ $group->desc }}
                    </div>
                </div>
                <div class="collapse" id="collapse">
                    <div class="container" id="callout">
                        @foreach ($anggota as $item)

                            @php
                                switch ($item->role) {
                                    case '1':
                                        $callout = 'bs-callout-danger';
                                        $role = 'Ketua';
                                        break;
                                    case '2':
                                        $callout = 'bs-callout-warning';
                                        $role = 'Wakil Ketua';
                                        break;
                                    case '3':
                                        $callout = 'bs-callout-info';
                                        $role = 'Sekertaris';
                                        break;
                                    case '4':
                                        $callout = 'bs-callout-primary';
                                        $role = 'Bendahara';
                                        break;
                                }
                            @endphp
                            <div class="bs-callout {{ $callout }}">
                                <div class="row justify-content-between">
                                    <div class="col-4">
                                        {{ $item->name }}
                                    </div>
                                    <div class="col-4">
                                        {{ $role }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- end panel group & pengurus --}}
                <br>
                <hr class="dropdown-divider" style="color:blue;height:2px">
                <br>
                {{-- panel  keuangan --}}
              

                    <h4 style="color: #39A2DB"># Grafik kuangan </h4>
                    <br>
                    {{-- grafik --}}
                   @if (isset($grafik))
                    {{--  <div class="card-body">  --}}
                        <canvas id="myChart" ></canvas>
                    {{--  </div>  --}}
                    @endif
                    {{-- end grafik --}}
                    <br>  
                    @if (isset($keuangan))
                    <h4 style="color: #39A2DB; float:right">Bulan {{ Carbon\Carbon::now()->isoFormat('MMMM') }}</h4>
                    <br>
                    <div class="row justify-content-start">
                        <div class="col-sm-1 col-md-2 col-lg-2">
                            <label class="label-form">Pengeluaran :</label>
                            <a class="btn btn-outline-danger">@uang($keuangan[0])</a>

                        </div>
                        <div class="col-sm-1 col-md-2 col-lg-2">
                            <label class="label-form">Pemasukan  :</label>
                            <a class="btn btn-outline-primary">@uang($keuangan[1])</a>

                        </div>
                        <div class="col-sm-1 col-md-2 col-lg-2">
                            <label class="label-form">Total      :</label><br>
                            <a class="btn btn-outline-warning">@uang($keuangan[2])</a>

                        </div>
                    </div>
                    <br>
                @endif
                {{-- panel  keuangan --}}
                
                {{-- list keuangan --}}
                {{-- @if (!$list) --}}

                    @foreach ($list as $item)
                        @if ($item->role == 1)

                            {{-- alert-p --}}
                            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                date="{{ 'dibuat pada ' . Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y') }}"
                                data-bs-whatever="{{ $item->keterangan }}">
                                <div class="alert alert-primary" role="alert">
                                    <p style="float: right;"> +@uang($item->jumlah)</p>
                                    {{ Str::title($item->name) }}
                                </div>
                            </a>
                        @else
                            {{-- alert-p --}}
                            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                date="{{ 'dibuat pada ' . Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y') }}"
                                data-bs-whatever="{{ $item->keterangan }}">
                                <div class="alert alert-danger" role="alert">
                                    <p style="float: right; "> -@uang($item->jumlah)</p>
                                    {{ Str::title($item->name) }}
                                </div>
                            </a>
                        @endif
                    @endforeach

                    {{-- end list keuangan --}}
                {{-- @endif --}}

                {{-- event list --}}
                @if (!$event->isEmpty())
                <br>
                <hr class="dropdown-divider" style="color:blue;height:2px">
                <br>
                  
                <h4 style="color: #39A2DB"># Acara Bulan {{ Carbon\Carbon::now()->isoFormat('MMMM') }}</h4>
                <br>
                @endif
                    @foreach ($event as $item)
                        <div class="card">
                            <div class="card-body">
                                <p style="float: right;color:gray;font-size:10px">
                                    Dibuat {{ Carbon\Carbon::parse($item->created_at)->isoFormat('D/ M/ Y') }}
                                </p>
                                <h5 class="card-title ">{{ Str::title($item->name) }}</h5><br>
                                <div class="container">
                                    <p class="card-text">
                                        <i class="bi bi-calendar-week"></i>
                                        {{ Carbon\Carbon::parse($item->tanggal)->isoFormat('dddd, D MMMM Y') }}
                                    </p>
                                    <p class="card-text" style="color: #1EA5FC;float:left;margin-right:18px"><i
                                            class="bi bi-geo-alt"></i> {{ $item->lokasi }}</p>
                                    @if ($item->waktu != null)
                                        <p class="card-text"> <i class="bi bi-clock"></i> {{ $item->waktu }}</p>
                                    @endif
                                </div>
                                <div class="container" style="float: left">
                                    <p class="card-text">

                                        @if (Str::length($item->deskripsi) >= 250)
                                            <span id="text1" hide="1">{{ Str::limit($item->deskripsi, 200, '....') }}</span>
                                            <span id="text2" style="display:none">{{ $item->deskripsi }}</span>
                                            <a style="color:#1EA5FC" id="button" onclick="readmore()">Read more</a>
                                        @else
                                            {{ $item->deskripsi }}
                                        @endif
                                    </p>
                                </div><br><br>

                            </div>
                        </div><br>
                    @endforeach
                    @if($agenda->isNotEmpty())
                    <hr class="dropdown-divider" style="color:blue;height:2px">
                    <br>
                    <h4 style="color: #39A2DB"># Agenda</h4>
                    <br>
                    @foreach ($agenda as $item)
                    <div class="alert alert-primary" role="alert">
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
                         </div>
                     </div>
                     </div>                               
                    @endforeach
                    @endif
            </div>
        </div>
        <br>
    
       
    {{-- </div> --}}
@endsection
@section('script')
    <script>
        function readmore(){
           var text1 = document.getElementById('text1')
           var text2 = document.getElementById('text2')
           var kondisi= text1.getAttribute('hide')
           var button = document.getElementById('button')
           
           if(kondisi==1){
            text2.setAttribute('style','')
            text1.setAttribute('style','display:none')
            text1.setAttribute('hide',0)
            button.innerHTML='Read less'
           }
           if(kondisi==0){
            text1.setAttribute('style','')
            text2.setAttribute('style','display:none')
            text1.setAttribute('hide',1)
            button.innerHTML='Read more'
           }
        }
        var labels = @json($grafik);
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels[0],
                datasets: [{
                        label: '# pengeluaran',
                        data: [labels[1][0], labels[2][0], labels[3][0], labels[4][0], labels[5][0], labels[6][
                            0], labels[7][0]],
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
                    },
                    {
                        label: '# pemasukan',
                        data: [labels[1][1], labels[2][1], labels[3][1], labels[4][1], labels[5][1], labels[6][
                            1], labels[7][1]],
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
                    }, {
                        label: '# total',
                        data: [labels[1][2], labels[2][2], labels[3][2], labels[4][2], labels[5][2], labels[6][
                            2], labels[7][2]],
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
                    }
                ]
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
{{-- @push('js')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>

{!! $usersChart->script() !!}
@endpush --}}
