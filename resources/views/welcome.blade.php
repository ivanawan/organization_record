@extends('layouts.layout')


@section('content')

<div class="container mx-auto mt-5 sm:mb-4">
  <div class="grid lg:grid-cols-3 sm:grid-cols-1 md:grid-cols-2 gap-6">
    <div class="flex justify-center shadow-md hover:bg-blue-200  bg-gray-50 rounded-md p-6 ">
      <div class="flex flex-col ">
        <div class=" p-1" >
          <img class="block m-auto p-5" src="{{asset('img/akun.svg')}}"/>
        </div>
        <div>
          <p class="text-3xl mt-4">User <span class="text-indigo-400">160</span></p>
        </div>
      </div>
    </div> 
     {{-- card --}}
    <div class="flex justify-center shadow-md hover:bg-blue-200  bg-gray-50 rounded-md p-6 ">
      <div class="flex flex-col ">
        <div class=" p-1" >
          <img class="block m-auto p-3" src="{{asset('img/group.svg')}}"/>
        </div>
        <div>
          <p class="text-3xl mt-9">Group <span class="text-green-400">160</span> </p>
        </div>
      </div>
    </div>
     {{-- card --}}
     <div class="flex justify-center shadow-md hover:bg-blue-200  bg-gray-50 rounded-md p-6 ">
      <div class="flex flex-col ">
        <div class=" p-1" >
          <img class="block m-auto " src="{{asset('img/web.svg')}}"/>
        </div>
        <div class="mt-8 dropdown">
          <button class="text-3xl  hover:bg-yellow-500 inline-block py-2 px-3 rounded-lg  text-black hover:text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Public Page</button>
            <div class="dropdown-menu input-group mb-3" aria-labelledby="dropdownMenuButton1"> 
            <form  action="{{url('/jhjhdj')}}" method="get">
          <input  class="ml-3 mt-2" placeholder="Enter Code Group" />
          <button  class="btn float-right mr-3 bg-blue-600" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </form>
        </div>
        </div>
      </div>
    </div>
     {{-- card --}}
     <div class="flex justify-center shadow-md hover:bg-blue-200  bg-gray-50 rounded-md p-6 ">
      <div class="flex flex-col ">
        <div class=" p-1" >
          <img class="block m-auto " src="{{asset('img/version.svg')}}"/>
        </div>
        <div class="mt-8">
          <a href="https://github.com/ivanawan/organization_record" class="text-3xl  hover:bg-yellow-500 inline-block py-2 px-3 rounded-lg  text-black hover:text-white" style="text-decoration: none">Source Code</a>
        </div>
      </div>
    </div> 
     {{-- card --}}
    <div class="flex justify-center shadow-md hover:bg-blue-200  bg-gray-50 rounded-md p-6 ">
      <div class="flex flex-col ">
        <div class=" p-1" >
          <img class="block m-auto " src="{{asset('img/other.svg')}}"/>
        </div>
        <div class="mt-32">
          <a href="http://ivanawan.github.io" class="text-3xl  hover:bg-yellow-500 inline-block py-2 px-3 rounded-lg  text-black hover:text-white" style="text-decoration: none">About Me</a>
        </div>
      </div>
    </div>
    {{-- card --}}
    <div class="flex justify-center shadow-md hover:bg-blue-200  bg-gray-50 rounded-md p-6 ">
      <div class="flex flex-col ">
        <div class=" p-1" >
          <img class="block m-auto " src="{{asset('img/file.svg')}}"/>
        </div>
        <div class="mt-8">
          <a class="text-3xl  hover:bg-yellow-500 inline-block py-2 px-3 rounded-lg  text-black hover:text-white" style="text-decoration: none">Dokumentasi</a>
        </div>
      </div>
    </div>
     {{-- card --}}
  </div>
</div>
<br>
<br>
@endsection   