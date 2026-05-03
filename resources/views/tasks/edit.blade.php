@extends('layout.admin')
@section('content')
    <h1>Modificar Tarea</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
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

            <form action="{{ route('tasks.update', $task) }}" method="POST" autocomplete="off" class="row g-3 mb-4">
                @csrf
                @method('PUT')
                <!--creamos los campos-->
                <!--creamos las columnas para que ocupe todo el espacio-->
                <div class="col-md-12">
                    <label for="title" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="title" id="title"
                        value="{{ old('title', $task->title) }}">
                </div>
                <div class="col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" required>{{ old('description', $task->description) }}</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="pendiente" {{ old('status', $task->status) == 'pendiente' ? 'selected' : '' }}>
                            Pendiente</option>
                        <option value="completado" {{ old('status', $task->status) == 'completado' ? 'selected' : '' }}>
                            Completado</option>
                        <option value="en_proceso" {{ old('status', $task->status) == 'en_proceso' ? 'selected' : '' }}>
                            En proceso</option>

                    </select>
                </div>

                <div class="col-md-12">
                    <label for="due_date" class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="due_date" id="due_date"
                        value="{{ old('due_date', $task->due_date) }}" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="client_id" class="form-label">Cliente</label>
                    <select name="client_id" id="client_id" class="form-control select2">
                        <option value="">No asignado</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}"
                                {{ old('client_id', $task->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select> <!-- ← FALTABA ESTO -->
                </div>
                <div class="col-12">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Regresar</a>
                    <button type="submit" class="btn btn-primary">Actualizzar</button>
                </div>

            </form>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#client_id').select2({
                placeholder: "Selecciona un cliente",
                allowClear: true
            });
        });
    </script>
@endpush
