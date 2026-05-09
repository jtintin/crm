@extends('layout.admin')
@section('content')
    <div class="row my-3">
        <div class="col-8">
            <div id="calendar">
            </div>
        </div>
    </div>
    <!-- añado modal -->
    <div class="modal fade" id="taskModal" tabindex="-1">
        <div class="modal-dialog">


            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="task_title" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="task_title" readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="task_description" class="form-label">task_Description</label>
                        <textarea name="task_description" id="task_description" class="form-control" readonly>{{ old('task_description') }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="task_status"  value="{{ old('task_status') }}"readonly> 
                    </div>

                    <div class="col-md-12">
                        <label for="task_due_date" class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="task_due_date" id="task_due_date"
                            value="{{ old('task_due_date') }}" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="task_client_id" class="form-label">Cliente</label>
                        <input type="text" class="form-control" id="task_client_id"  value="{{ old('client_id') }}"readonly>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>

        </div>
    </div>

    <!-- fin modal-->
@endsection
@push('script')
    <script src="{{ asset('js/index.global.min.js') }}"></script>
    <script src="{{ asset('js/es.global.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar: {
                    left: 'prev,next,today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: {
                    url: "{{ route('tasks.events') }}",
                    method: 'GET',
                    failure: function() {
                        alert("No se cargaron las tareas");
                    }
                },
                eventClick: function(info) {
                    console.log('Evento clickeado:', info.event.title);
                    // abrir modal directamente
                    // var modal = new bootstrap.Modal(document.getElementById('taskModel'));
                    // modal.show();
                    const taskId = info.event.extendedProps.id || info.event.id;
                    const url = `tasks/${taskId}`;
                    fetch(url,{
                        headers: {
                            'Accept': 'application/json'
                        }
                    }).then(res => {
                        if(!res.ok) throw new Error("No se puede obtener la tarea")
                        return res.json();
                    }).then (data => {
                        document.getElementById('task_title').value=data.title || '';
                        document.getElementById('task_description').value=data.description || '';
                        document.getElementById('task_status').value=data.status || '';
                        document.getElementById('task_due_date').value=data.due_date || '';
                        document.getElementById('task_client_id').value=data.client ? data.client.name : '';

                        const modal = new bootstrap.Modal(document.getElementById('taskModal'));
                        modal.show(); 
                    }).catch(err => {
                        alert("Error al obtener los detalles de la tarea"); 
                    });
                }
            });
            calendar.render();
        });
    </script>
@endpush
