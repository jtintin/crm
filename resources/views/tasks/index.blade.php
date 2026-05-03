@extends('layout.admin')
@include('sweetalert2::index')
@section('content')
    <h3>Tasks</h3>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Nueva Tarea</a>
    @if ($tasks->isEmpty())
        <p>No hay registros</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha Vencimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn.sm">Editar</a>
                        </td>
                        <td>

                            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                id="delete-task-{{ $task->id }}">

                                @csrf
                                @method('DELETE')

                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmDelete({{ $task->id }})">
                                    Eliminar
                                </button>

                            </form>
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
@push('script')
    <script>
        function confirmDelete(taskId) {
            Swal.fire({
                title: 'Eliminar tarea',
                text: '¿Estás seguro de que deseas eliminar esta tarea?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-task-' + taskId).submit();
                }
            });
        }
    </script>
@endpush
