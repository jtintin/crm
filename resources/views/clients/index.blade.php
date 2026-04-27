@extends('layout.admin')
@section('content')
<h3>CLientes</h3>    
@if (session('success'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<!-- mostramos un botón nuevo-->
<!--creamos una fila-->
<div class="row mb-3">
    <!--creamos una columna-->
    <div class="col-xl-3 col-md-6">
        <!--creamos un enlace para nuevo-->
        <a href="{{ route('clients.create')}}" class="btn btn-primary">Nuevo</a> |
        <a href="{{ route('clients.deleted')}}" class="btn btn-primary">Historial</a>
    </div>
</div>
<!-- mostramos la tabla de clientes-->
<!--creamos una fila-->
<div class="row">
        <!--creamos una columna-->
        <div class="col-12">
                <!--creamos una tabla-->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Nombre usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client )
                            <tr>
                                <td>{{ $client->name}}</td>
                                <td>{{ $client->email}}</td>
                                <td>{{ $client->phone}}</td>
                                <td>{{ $client->user->name}}</td>
                                <td>
                                    <a href="{{ route('clients.edit',$client->id)}}" class="btn btn-warning btn-sm">
                                    Editar
                                    </a>
                                    <form action="{{ route('clients.destroy',$client->id)}}" method="POST" 
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" >Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
</div>
@endsection