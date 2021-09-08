@extends('layouts.layout')


@section('content')
  <a type="button" style="float:right ; background-color:#1EA5FC;margin-left:15px; color:#fff" class="btn " href="{{url('/group/addpeserta')}}"  >
    <i class="bi bi-people"></i>
  </a>
 
 <button type="button"  style="float:right; color:#fff " class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  <i class="bi bi-person-plus"></i>
</button>
<br><br>
                   <div class="card">
                   <div class="card-header">
                     <div style="float:right">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{session('code')}}" id="myInput" disabled readonly>
                        <button class="btn" style="background-color: #FECB4D" onclick="myFunction()">
                          <i class="bi bi-link"></i>
                        </button>
                      </div>
                    </div>
                    <h3> Anggota Group</h3>
                   </div>
                   <div class="card-body" style="height: 80vh; overflow: auto;">
                    
                        @foreach ($anggota as $item)
                        

                                                 
                        @if ($item->role==1)
                            <div class="bs-callout bs-callout-danger">
                          <div class="row ">
                            <div class="col">
                              {{$item->name}}
                            </div>
                            <div class="col">                              
                              ketua
                            </div>
                            <div class="col">
                              @if (session('group')['role']==1 or session('group')['role']==2)
                              <div class="dropdown">
                              <div  style="float: right">
                                <a href="{{url('/group/delete/anggota'.$item->id)}}" class="btn" style="color:red"><i class="bi bi-trash"></i></a>
                              <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                                </svg>           
                              </a>
                           
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form action="{{url('/group/changerole/'.$item->id_user)}}" method="POST">
                                  @csrf
                                  @if (session('group')['role']==1)
                                  <li>
                                    <div class="form-check">
                                      <input class="form-check-input" value="1" type="radio" name="role" id="flexRadioDefault1" checked>
                                      <label class="form-check-label" for="flexRadioDefault1">
                                        ketua
                                      </label>
                                    </div>
                                  </li>
                                  @endif
                                  <li>
                                    <div class="form-check">
                                      <input class="form-check-input" value="2" type="radio" name="role" id="flexRadioDefault1" >
                                      <label class="form-check-label" for="flexRadioDefault1">
                                        wakil ketua
                                      </label>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="form-check">
                                      <input class="form-check-input" value="3" type="radio" name="role" id="flexRadioDefault1">
                                      <label class="form-check-label" for="flexRadioDefault1">
                                        sekertaris
                                      </label>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="form-check">
                                      <input class="form-check-input" value="4" type="radio" name="role" id="flexRadioDefault1">
                                      <label class="form-check-label" for="flexRadioDefault1">
                                        bendahara
                                      </label>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="form-check">
                                      <input class="form-check-input" value="5" type="radio" name="role" id="flexRadioDefault1">
                                      <label class="form-check-label" for="flexRadioDefault1">
                                        anggota
                                      </label>
                                    </div>
                                  </li>
                                <li><button type="submit" style="width: 100%" class="btn btn-warning">save</button></li>
                                </form>
                              </ul>
                            </div>
                            </div>
                              @endif
                            </div>
                          </div>
                        </div>
                        @endif
                        @if ($item->role==2)
                        <div class="bs-callout bs-callout-warning">
                      <div class="row ">
                        <div class="col">
                          {{$item->name}}
                        </div>
                        <div class="col">                              
                          wakil ketua
                        </div>
                        <div class="col">
                          @if (session('group')['role']==1 or session('group')['role']==2)
                          <div class="dropdown">
                            <div  style="float: right">
                            <a href="{{url('/group/delete/anggota'.$item->id)}}" class="btn" style="color:red"><i class="bi bi-trash"></i></a>
                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" >
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                              </svg>           
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <form action="{{url('/group/changerole/'.$item->id_user)}}" method="POST">
                                @csrf
                                @if (session('group')['role']==1)
                              <li>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" value="1" name="role" id="flexRadioDefault1" >
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    ketua
                                  </label>
                                </div>
                              </li>
                              @endif
                              <li>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="role" value="2" id="flexRadioDefault1" checked>
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    wakil ketua
                                  </label>
                                </div>
                              </li>
                              <li>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="role" value="3" id="flexRadioDefault1">
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    sekertaris
                                  </label>
                                </div>
                              </li>
                              <li>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="role" value="4" id="flexRadioDefault1">
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    bendahara
                                  </label>
                                </div>
                              </li>
                              <li>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="role" value="5" id="flexRadioDefault1">
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    anggota
                                  </label>
                                </div>
                              </li>
                              <li><button type="submit" style="width: 100%" class="btn btn-warning">save</button></li>
                              </form>
                            </ul>
                          </div>
                          </div>
                          @endif
                        </div>
                      </div>
                    </div>
                    @endif
                    @if ($item->role==3)
                    <div class="bs-callout bs-callout-primary">
                  <div class="row ">
                    <div class="col">
                      {{$item->name}}
                    </div>
                    <div class="col">                              
                      sekertaris
                    </div>
                    <div class="col">
                      @if (session('group')['role']==1 or session('group')['role']==2)
                      <div class="dropdown">
                        <div  style="float: right">
                          <a href="{{url('/group/delete/anggota'.$item->id)}}" class="btn" style="color:red"><i class="bi bi-trash"></i></a>
                          <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                          </svg>           
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <form action="{{url('/group/changerole/'.$item->id_user)}}" method="POST">
                            @csrf
                            @if (session('group')['role']==1)
                            <li>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" value="1" id="flexRadioDefault1" >
                                <label class="form-check-label" for="flexRadioDefault1">
                                  ketua
                                </label>
                              </div>
                            </li>
                            @endif
                            <li>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" value="2" id="flexRadioDefault1" >
                                <label class="form-check-label" for="flexRadioDefault1">
                                  wakil ketua
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" value="3" id="flexRadioDefault1" checked="checked">
                                <label class="form-check-label" for="flexRadioDefault1">
                                  sekertaris
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" value="4" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                  bendahara
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" value="5" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                  anggota
                                </label>
                              </div>
                            </li>
                          <li><button type="submit" style="width: 100%" class="btn btn-warning">save</button></li>
                          </form>
                        </ul>
                      </div>
                    </div>
                      @endif
                    </div>
                  </div>
                </div>
                @endif
                @if ($item->role==4)
                <div class="bs-callout bs-callout-info">
              <div class="row ">
                <div class="col">
                  {{$item->name}}
                </div>
                <div class="col">                              
                  bendahara
                </div>
                <div class="col">
                  @if (session('group')['role']==1 or session('group')['role']==2)
                  <div class="dropdown">
                    <div  style="float: right">
                      <a href="{{url('/group/delete/anggota'.$item->id)}}" class="btn" style="color:red"><i class="bi bi-trash"></i></a>
                      <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" >
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                      </svg>           
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <form action="{{url('/group/changerole/'.$item->id_user)}}" method="POST">
                        @csrf
                        @if (session('group')['role']==1)
                        <li>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="1" id="flexRadioDefault1" >
                            <label class="form-check-label" for="flexRadioDefault1">
                              ketua
                            </label>
                          </div>
                        </li>
                        @endif
                        <li>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="2" id="flexRadioDefault1" >
                            <label class="form-check-label" for="flexRadioDefault1">
                              wakil ketua
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="3" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                              sekertaris
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="4" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                              bendahara
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="5" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                              anggota
                            </label>
                          </div>
                        </li>
                      <li><button type="submit" style="width: 100%" class="btn btn-warning">save</button></li>
                      </form>
                    </ul>
                  </div>
                  </div>
                  @endif
                </div>
              </div>
            </div>
            @endif
            @if ($item->role==5)
            <div class="bs-callout bs-callout-secondary">
          <div class="row ">
            <div class="col">
              {{$item->name}}
            </div>
            <div class="col">                              
              anggota
            </div>
            <div class="col">
              @if (session('group')['role']==1 or session('group')['role']==2)
              <div class="dropdown">
                <div  style="float: right">
                  <a href="{{url('/group/delete/anggota'.$item->id)}}" class="btn" style="color:red"><i class="bi bi-trash"></i></a>
                  <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" >
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                  </svg>           
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <form action="{{url('/group/changerole/'.$item->id_user)}}" method="POST">
                    @csrf
                    @if (session('group')['role']==1)
                    <li>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" value="1" id="flexRadioDefault1" >
                        <label class="form-check-label" for="flexRadioDefault1">
                          ketua
                        </label>
                      </div>
                    </li>
                    @endif
                    <li>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" value="2" id="flexRadioDefault1" >
                        <label class="form-check-label" for="flexRadioDefault1">
                          wakil ketua
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" value="3" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          sekertaris
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" value="4" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          bendahara
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" value="5" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                          anggota
                        </label>
                      </div>
                    </li>
                  <li><button type="submit" style="width: 100%" class="btn btn-warning">save</button></li>
                  </form>
                </ul>
              </div>
              </div>
              @endif
            </div>
          </div>
        </div>
        @endif
                        
                        @endforeach
                   </div>
                  </div>
                  <br>
    {{-- card buat peserta --}}
   
                  

           <br>
            @if ($data->empty())   
         
            <div class="card">
                <div class="card-header">
                Waitinglist
                 
                </div>

                <div class="card-body" style="height: 80vh; overflow: auto;">
                    
                          @foreach ($data as $item)    
                       

                          <div class="bs-callout bs-callout-light">
                            <div class="row justify-content-between">
                              <div class="col">
                                {{$item->name}}
                              </div>
                              
                              <div class="col">
                                <div style="float: right">
                                <a type="button" href="{{url('/group/addtogroup/'.$item->id_user)}}" class="btn btn-info" data-bs-toggle="popover" data-bs-content="tambahkan ke dalam group? ">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                </svg></a>
                                <a type="button" href="{{url('/group/delete/'.$item->id_user)}}" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg></a>
                              </div>
                                </div>
                            </div>
                          </div>
                            @endforeach
                </div>
            </div>
          @endif
          {{-- card tabel peserta  --}}
          <br>
          <div class="card">
            <div class="card-header">
            Kelompok Peserta
            </div>
            <div class="card-body" style="height: 80vh; overflow: auto;">
@foreach ($peserta as $item)
<a href="{{url('/peserta/'.$item->id)}}" style="text-decoration: none">
    <div  class="alert alert-primary" role="alert">
      {{$item->name_k}}
    </div>
  </a>  
@endforeach

            </div>
          </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{url('/group/add/anggota')}}">
                  @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1"  class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" required>
                  </div>
                  <select class="form-select" name="role" aria-label="Default select example">
                    <option value="5" selected>anggota</option>
                    <option value="4">bendahara</option>
                    <option value="3">sekertaris</option>
                    <option value="2">wakil ketua</option>
                  </select>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
           
@endsection
@section('script')
<script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
} </script>
@endsection