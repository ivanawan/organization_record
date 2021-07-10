<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Organization Record</title>
        {{-- font --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
 
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('css/style.css')}}" rel="stylesheet"
        <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet"> 
    </head>
    <body style="background-color: #ecf8fc">
       
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light border-bottom" style="background-color:#1EA5FC;font-family: 'Poppins', sans-serif;">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#" style="margin-right: 20% ; margin-left:5%;color:#fff">Navbar</a>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0" >
                            <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="{{url('/home')}}" style="color: #fff">Home</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{url('/event')}}" style="color: #fff">Event</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/group')}}" style="color: #fff">Group</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="{{url('/keuangan')}}" style="color: #fff">Keuangan</a>
                              </li>  
                              <li class="nav-item">
                                <a class="nav-link" href="{{url('/agenda')}}" style="color: #fff">Agenda</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="{{url('/task')}}" style="color: #fff">Task</a>
                              </li>
                          </ul>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff"> {{ Auth::user()->name }}</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @php
                                        $data=session('group');
                                        $all=session('group_all');
                                       
                                        switch ($data['role']) {
                                            case '1':
                                                $jabatan= "ketua";
                                                break;
                                                case '2':
                                                $jabatan="wakil ketua";
                                                break;
                                                case '3':
                                                $jabatan= "bendahara";
                                                break;
                                                case '4':
                                                $jabatan= "sekertaris";
                                                break;
                                                case '1':
                                                $jabatan= "anggota";
                                                break;
                                            
                                        }

                                        @endphp
                                        <a class="dropdown-item" style="background-color:#DBF1FF" href="#!">{{$jabatan}}</a>
                                        <a class="dropdown-item" href="#!">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        
                                         <button class="btn " style="background-color:#1EA5FC;width:100%;color:#fff" type="button">{{ __('Logout') }}</button>
                                                                                 
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container" style="padding-top:25px">
                  @yield('content')

                </div>
            
        <!-- Bootstrap core JS-->
        <script src="{{asset('js/bootstrap.bundle.min.js')}}" ></script>
        <!-- Core theme JS-->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{asset('js/scripts.js')}}" ></script>
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
    </body>
</html>