@extends('layout.admin')
@section('content')
<h3 class="my-3">Editar Perfil de {{ $user->name}}</h3>
<form action="{{ route('profile.update')}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name',$user->name)}}" required>
    </div>
    <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input type="text" name="email" id="email" class="form-control" value="{{ old('email',$user->email)}}" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3" >Guardar cambios</button>
</form>
@endsection