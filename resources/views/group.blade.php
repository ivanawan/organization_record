@extends('layouts.layout')


@section('content')
                   <div class="card">
                   <div class="card-header">
                     anggota Group
                   </div>
                   <div class="card-body">
                    <table class="table">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Jabatan</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($anggota as $item)
                        
                          @php
                           
                             switch ($item->role) {
                               case 1:
                                 $role = "ketua";
                                 break;
                                 case 2:
                                 $role = "wakil ketua";
                                 break;
                                 case 3:
                                 $role = "sekertaris";
                                 break;
                                 case 4:
                                 $role = "bendahara";
                                 break;
                                 case 5:
                                 $role = "anggota";
                                 break;
                             
                             }

                          @endphp
                          
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{$item->name}}</td>
                          <td>{{$role}}</td>
                          <td>  <a type="button" href="{{url('/group/addtogroup/'.$item->id_user)}}" class="btn btn-info">A</a>
                          </td>
                        </tr>
                        @endforeach
                       
                      </tbody>
                    </table>
                   </div>
                  </div>
     

           <br>

            <div class="card">
                <div class="card-header">
                Waitinglist
                 
                </div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                          @foreach ($data as $item)    
                          <tr>
                              
                              <td colspan="2">{{$item->name}}</td>
                              <td><a type="button" href="{{url('/group/addtogroup/'.$item->id_user)}}" class="btn btn-info">Add to group</a>|
                                <a type="button" href="{{url('/group/delete/'.$item->id_user)}}" class="btn btn-danger">Delete</a></td>
                          </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
          
           
           
@endsection
