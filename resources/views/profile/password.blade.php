@extends('layout.admin')
@section('content')
<h3 class="my-3">Editar Password de {{ $user->name}}</h3>
@if($errors->any())
<div class="alert alert-warning" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error}}</li>
        @endforeach
    </ul>

</div>
@endif
<form action="{{ route('profile.password.update')}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="current_password">Contraseña Actual</label>|
        <input type="password" name="current_password" id="current_password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Nueva Contraseña</label>|
        <input type="password" name="password" id="password" class="form-control"  required>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirmar nueva contraseña</label>|
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"  required>
    </div>
    <button type="submit" class="btn btn-primary mt-3" >Guardar cambios</button>
</form>
@endsection