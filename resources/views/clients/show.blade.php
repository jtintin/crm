@extends('layout.admin')
@section('content')
    <h3 class="mt-3">Cliente: {{ $client->name }}</h3>
    <p><strong>Email:</strong> {{ $client->email }}</p>
    <p><strong>Teléfono:</strong> {{ $client->phone }}</p>
    <p><strong>Empresa:</strong> {{ $client->company }}</p>

    <hr>
    <div class="text-center">
        <div class="btn-group">
            <a href="#" class="btn btn-primary active">Contactos</a>
            <a href="{{ route('clients.followups.index', $client) }}" class="btn btn-outline-primary">Seguimientos</a>
        </div>
    </div>

    <div class="p-3 m-4 bg-light">
        <h4>Contactos</h4>
        <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#createContactModal">
            Nuevo Contacto</button>
        @if ($client->contacts->isEmpty())
            <p>NO hay contactos disponibles</p>
        @else
            <!-- mostramos la tabla de contactos-->
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
                                <th>Cargo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($client->contacts as $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->position }}</td>

                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm edit-contact-btn"
                                            data-id="{{ $contact->id }}"
                                            data-url="{{ route('clients.contacts.edit', [$client, $contact]) }}"
                                            data-bs-toggle="modal" data-bs-target="#editContactModal">
                                            Editar
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm delete-contact-btn"
                                            data-id="{{ $contact->id }}"
                                            data-url="{{ route('clients.contacts.destroy', [$client, $contact]) }}"
                                            data-bs-toggle="modal" data-bs-target="#deleteContactModal">
                                            Eliminar
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--paginación-->
                    {{-- {!! $client->links() !!} --}}
                </div>
            </div>
        @endif

    </div>
    @include('clients.contacts.create')
    @include('clients.contacts.edit')
    @include('clients.contacts.delete')
    <script>
        // Espera a que todo el DOM esté cargado antes de ejecutar el código
        document.addEventListener('DOMContentLoaded', function() {

            // Selecciona todos los botones que tengan la clase .edit-contact-btn
            const editBtn = document.querySelectorAll('.edit-contact-btn')

            // Recorre cada botón encontrado
            editBtn.forEach(btn => {
                // Añade un evento click a cada botón
                btn.addEventListener('click', () => {

                    // Obtiene la URL desde el atributo data-url del botón
                    const url = btn.dataset.url;

                    // Hace una petición HTTP GET a esa URL
                    fetch(url)
                        // Convierte la respuesta en JSON
                        .then(res => res.json())
                        // Cuando llega la data, la usa para llenar el formulario
                        .then(data => {
                            // Busca el formulario con id editFormContact
                            const form = document.getElementById('editFormContact')

                            // Cambia la acción del formulario para que apunte a la URL sin "/edit"
                            form.action = url.replace('/edit', '');

                            // Rellena los campos del formulario con los datos recibidos
                            form.querySelector('[name=name]').value = data.name;
                            form.querySelector('[name=email]').value = data.email;
                            form.querySelector('[name=phone]').value = data.phone;
                            form.querySelector('[name=position]').value = data.position;
                            form.querySelector('[name=notes]').value = data.notes;
                        });

                });
            });
            //delete
            // Obtiene el formulario que se usará para enviar el DELETE
            const deleteForm = document.getElementById('deleteContactForm');

            // Obtiene el modal de confirmación
            const deleteModal = document.getElementById('deleteContactModal')

            // Escucha el evento cuando el modal se va a mostrar
            deleteModal.addEventListener('show.bs.modal', function(event) {
                // El botón que disparó la apertura del modal
                const button = event.relatedTarget;

                // Obtiene el id del contacto desde el atributo data-id del botón
                const contactId = button.getAttribute('data-id');

                // Obtiene la URL de borrado desde el atributo data-url del botón
                const deleteUrl = button.getAttribute('data-url');

                // Actualiza la acción del formulario para que apunte a esa URL
                deleteForm.action = deleteUrl;
            });

        });
    </script>

@endsection
