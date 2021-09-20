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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <!-- Favicon-->
        {{-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> --}}
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('css/style.css')}}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet"> 
    </head>
    <body style="background-color: #ecf8fc">
      <div id="page-container">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light border-bottom" style="background-color:#1EA5FC;font-family: 'Poppins', sans-serif;">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#" style="margin-right: 20% ; margin-left:5%;color:#fff">Navbar</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0" >
                          @if (Auth::check())
                            <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="{{url('/home')}}" style="color: #fff">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/group')}}" style="color: #fff">Group</a>
                              </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{url('/event')}}" style="color: #fff">Event</a>
                            </li>
                              <li class="nav-item">
                                <a class="nav-link" href="{{url('/keuangan')}}" style="color: #fff">Keuangan</a>
                              </li> 
                              <li class="nav-item">
                                <a class="nav-link" href="{{url('/agenda')}}" style="color: #fff">Agenda</a>
                              </li>   
                             @endif 
                          </ul>
                        </div>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0" >
                                 {{-- start --}}
                                 @guest
                                 @if (Route::has('login'))
                                 <li class="nav-item" >
                                     <a class="nav-link" style="color: #fff" href="{{ route('login') }}">{{ __('Login') }}</a>
                                 </li>
                                 @endif
 
                                 @if (Route::has('register'))
                                 <li class="nav-item">
                                     <a class="nav-link" style="color: #fff" href="{{ route('register') }}">{{ __('Register') }}</a>
                                 </li>
                                 @endif
                                 @else
                                 <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff"> {{ Auth::user()->name }}</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                      @if(session('group')!= null)
                                      @php
                                        $data=session('group');
                                        $all=session('group_all');
                                       
                                        switch ($data['role']) {
                                            case '1':
                                                $jabatan = "ketua";
                                                break;
                                                case '2':
                                                $jabatan ="wakil ketua";
                                                break;
                                                case '3':
                                                $jabatan = "bendahara";
                                                break;
                                                case '4':
                                                $jabatan = "sekertaris";
                                                break;
                                                case '5':
                                                $jabatan = "anggota";
                                                break;
                                            
                                        }

                                        @endphp
                                        <a class="dropdown-item" style="background-color:#DBF1FF" href="#!">{{$jabatan ?? ''}}</a>
                                        <div class="dropdown-divider"></div>
                                          {{-- ++++++++++++form cherck +++++++++++++++ --}}
                                          
                                          @foreach ($all as $item)
                                          <a class="dropdown-item" href="{{url('/group/role/'.$item['id_group'])}}" 
                                          @if($item['id_group']==$data['id_group']) style="background-color:#DBF1FF" @endif >
                                          {{Str::limit($item['name'],11) }}
                                          @if($item['id_group']==$data['id_group'])
                                          <i style="color:green" class="bi bi-check-lg">
                                          </i>
                                          @endif
                                          </a>
                                          @endforeach
                                    
                                          {{-- ++++++++++++form cherck +++++++++++++++ --}}
                                          <div class="dropdown-divider"></div>
                                          @endif
                                          <a class="dropdown-item text-decoration-none" href="{{url('/user')}}">
                                            <button class="btn"  style="background-color:#fc891e;width:100%;color:#fff" type="button">Setting</button>
                                          </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              
                                         <button class="btn " style="background-color:#1EA5FC;width:100%;color:#fff" type="button">{{ __('Logout') }}</button>
                                                                                 
                                        </a> 
                                    </a>
                                        </a> 

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    </div>
                                </li>{{--  end  --}}
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div  id="content-wrap" class="container" style="padding-top:25px">
                  @if($msg=Session::get('prm'))
                  <div class="alert alert-primary" role="alert">
                    {{$msg}}
                  </div>
                 @endif 
                 @if($msg=Session::get('scd'))
                  <div class="alert alert-secondary" role="alert">
                    {{$msg}}
                  </div>
                  @endif 
                  @if($msg=Session::get('scc'))
                  <div class="alert alert-success" role="alert">
                     {{$msg}}
                  </div>
                  @endif 
                  @if($msg=Session::get('err'))
                  <div class="alert alert-danger" role="alert">
                    {{$msg}}
                  </div>
                  @endif 
                  @if($msg=Session::get('wrn'))
                  <div class="alert alert-warning" role="alert">
                    {{$msg}}
                  </div>
                  @endif 
                  @if($msg=Session::get('info'))
                  <div class="alert alert-info" role="alert">
                    {{$msg}}
                  </div>
                  @endif
                  @yield('content')

                </div>
                <br>
                @php
                $year=date('Y');    
                @endphp
                {{-- <div id="footer" >  --}}
                  
                  <div id="footer" class="text-center"> <p>&copy; Copyright {{$year}}, Develop by <a href="http://ivanawan.github.io">ivan setiawan </a> </p> </div>
                </div>
                
                
        <!-- Bootstrap core JS-->
        <script src="{{asset('js/bootstrap.bundle.min.js')}}" ></script>
        <!-- Core theme JS-->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{asset('js/scripts.js')}}" ></script>
        
          @yield('script')
            
    </body>
</html>