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


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"> --}}
        <!-- Core theme CSS (includes Bootstrap)-->
        {{-- <script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script> --}}
        {{-- <link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/> --}}

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
                                          {{-- ++++++++++++form cherck +++++++++++++++ --}}
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                              Default radio
                                            </label>
                                          </div>
                                          @php
                                              $arr=session('group_all');
                                          @endphp
                                          @foreach ($arr as $item)
                                          
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" value="{{$item['id_group']}}" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                              {{$item['name']}}
                                            </label>
                                          </div>
                                          @endforeach
                                          {{-- ++++++++++++form cherck +++++++++++++++ --}}
                                          
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
        
          @yield('script')
            
    </body>
</html>