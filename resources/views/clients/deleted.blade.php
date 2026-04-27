@extends('layout.admin')
@section('content')
<h3>CLientes eliminados</h3>    
<!-- mostramos un botón nuevo-->
<!--creamos una fila-->
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
                            <th>ID</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client )
                            <tr>
                                <td>{{ $client->name}}</td>
                                <td>{{ $client->email}}</td>
                                <td>{{ $client->phone}}</td>
                                <td>{{ $client->id}}</td>
                                <td>
                                    <form action="{{ route('clients.activate',$client->id)}}" method="POST" 
                                        style="display:inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm" >Reingresar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
</div>
@endsection