@extends('layout.admin')
@section('content')
    <h1>Editar cliente</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error}}</li>
            @endforeach
        </ul>
    </div>
        
    @endif
    <!-- mostramos el formulario-->
    <!--creamos una fila-->
    <div class="row">
        <!--creamos una columna-->
        <div class="col-12">
            <!--creamos el formulario-->

            <form action="{{ route('clients.update',$client->id) }}" method="POST" autocomplete="off" class="row g-3">
                @csrf
                @method('PUT')
                <!--creamos los campos-->
                    <!--creamos las columnas para que ocupe todo el espacio-->
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name',$client->name) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{ old('email',$client->email) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone',$client->phone) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="company" class="form-label">Companía</label>
                        <input type="text" class="form-control" name="company" id="company" value="{{ old('company',$client->company) }}">
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label">Notas</label>
                        <textarea name="notes" id="notes" class="form-control">{{ old('notes',$client->notes) }}</textarea>
                    </div>
                    <div class="col-12">
                        <a href="{{ route('clients.index')}}" class="btn btn-secondary">Regresar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
