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
        <div class="mt-8">
          <a class="text-3xl  hover:bg-yellow-500 inline-block py-2 px-3 rounded-lg  text-black hover:text-white" style="text-decoration: none">Public Page</a>
        </div>
      </div>
    </div>
     {{-- card --}}
     <div class="flex justify-center shadow-md hover:bg-blue-200  bg-gray-50 rounded-md p-6 ">
      <div class="flex flex-col ">
        <div class=" p-1" >
          <img class="block m-auto " src="{{asset('img/version.svg')}}"/>
        </div>
        <div>
          <p class="text-3xl mt-8">Source Code</p>
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
          <p class="text-3xl ">About Me</p>
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