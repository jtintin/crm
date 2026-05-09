@extends('layout.admin')
@section('content')
<h3 class="my-3">Perfil de {{ $user->name}}</h3>
@if(@session('status'))
    <div class="alert alert-success">
        {{ session('status')}}
    </div>
    
@endif
<p><strong>Nombre:</strong> {{ $user->name}}</p>
<p><strong>Correo electrónico:</strong> {{ $user->email}}</p>
<a href="{{ route('profile.edit')}}" class="btn btn-warning">Editar Perfil</a>
<a href="{{ route('profile.password')}}" class="btn btn-secondary">Cambiar contraseña</a>

@endsection