@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Gestión de Servicios</h2>

    {{-- BOTONES --}}
    <div class="mb-3 d-flex gap-2 flex-wrap">
        <button class="btn btn-primary" onclick="showForm('crear')">Crear Servicio</button>
        <button class="btn btn-warning" onclick="showForm('editar_lista')">Editar Servicio</button>
        <button class="btn btn-danger" onclick="showForm('eliminar_lista')">Eliminar Servicio</button>
        <button class="btn btn-info" onclick="showForm('ver')">Ver Servicios</button>
        <a href="{{ url('/admin') }}" class="btn btn-secondary">Volver al Panel</a>
    </div>

    {{-- ===================== --}}
    {{-- FORM CREAR --}}
    {{-- ===================== --}}
    <div id="crear" class="card p-3 form-box">

        <h4>Crear Servicio</h4>

        <form method="POST" action="{{ route('servicio.store') }}" enctype="multipart/form-data">
            @csrf

            <label class="text-dark">Nombre del Servicio</label>
            <input type="text" name="nombresServicio" class="form-control mb-2" required>

            <label class="text-dark">Descripción</label>
            <textarea name="descripcion" class="form-control mb-2"></textarea>

            <label class="text-dark">Duración (Minutos)</label>
            <input type="number" name="duracionMinuto" class="form-control mb-2" required>

            <label class="text-dark">Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control mb-2" required>

            <label class="text-dark">Imagen</label>
            <input type="file" name="imagen" class="form-control mb-3" accept="image/*">

            <button class="btn btn-success">Guardar</button>
        </form>

    </div>

    {{-- ===================== --}}
    {{-- LISTA EDITAR --}}
    {{-- ===================== --}}
    <div id="editar_lista" class="card p-3 form-box" style="display:none;">

        <h4>Seleccione Servicio para Editar</h4>

        <div class="list-group">
            @forelse($servicios as $s)
                <button type="button"
                        class="list-group-item list-group-item-action"
                        onclick='cargarEdicion(@json($s))'>
                    {{ $s->idServicio }} - {{ $s->nombresServicio }} (${{ $s->precio }})
                </button>
            @empty
                <p>No hay servicios registrados.</p>
            @endforelse
        </div>

    </div>

    {{-- ===================== --}}
    {{-- FORM EDITAR --}}
    {{-- ===================== --}}
    <div id="editar_form" class="card p-3 form-box" style="display:none;">

        <h4>Editar Servicio</h4>

        <form id="form-actualizar" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label>Nombre</label>
            <input type="text" name="nombresServicio" id="edit-nombre" class="form-control mb-2" required>

            <label>Descripción</label>
            <textarea name="descripcion" id="edit-descripcion" class="form-control mb-2"></textarea>

            <label>Duración</label>
            <input type="number" name="duracionMinuto" id="edit-duracion" class="form-control mb-2" required>

            <label>Precio</label>
            <input type="number" step="0.01" name="precio" id="edit-precio" class="form-control mb-2" required>

            <label>Imagen</label>
            <input type="file" name="imagen" class="form-control mb-3" accept="image/*">

            <button class="btn btn-warning text-white">Actualizar</button>
            <button type="button" class="btn btn-secondary" onclick="showForm('editar_lista')">Cancelar</button>
        </form>

    </div>

    {{-- ===================== --}}
    {{-- ELIMINAR --}}
    {{-- ===================== --}}
    <div id="eliminar_lista" class="card p-3 form-box" style="display:none;">

        <h4>Eliminar Servicio</h4>

        @foreach($servicios as $s)
            <div class="d-flex justify-content-between border p-2 mb-2">
                <span>{{ $s->nombresServicio }}</span>

                <form action="{{ route('servicio.destroy', $s->idServicio) }}" method="POST"
                      onsubmit="return confirm('¿Eliminar este servicio?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </div>
        @endforeach

    </div>

    {{-- ===================== --}}
    {{-- VER --}}
    {{-- ===================== --}}
    <div id="ver" class="card p-3 form-box" style="display:none;">

        <h4>Servicios Registrados</h4>

        <div class="table-responsive">
            <table class="table table-bordered text-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Duración</th>
                        <th>Precio</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($servicios as $s)
                        <tr>
                            <td>{{ $s->idServicio }}</td>

                            <td>
                                @if($s->imagen)
                                    <img src="{{ asset('servicios/' . $s->imagen) }}"
                                         style="height:50px; border-radius:5px;">
                                @else
                                    <span class="text-muted">Sin imagen</span>
                                @endif
                            </td>

                            <td>{{ $s->nombresServicio }}</td>
                            <td>{{ $s->descripcion }}</td>
                            <td>{{ $s->duracionMinuto }} min</td>
                            <td>${{ number_format($s->precio, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

</div>

<style>
.form-box {
    background: #fff;
    color: #000;
    border-radius: 10px;
}
</style>

<script>
function showForm(id) {
    document.querySelectorAll('.form-box').forEach(el => el.style.display = 'none');
    document.getElementById(id).style.display = 'block';
}

function cargarEdicion(s) {
    showForm('editar_form');

    document.getElementById('form-actualizar').action = "/admin/servicio/" + s.idServicio;
    document.getElementById('edit-nombre').value = s.nombresServicio;
    document.getElementById('edit-descripcion').value = s.descripcion;
    document.getElementById('edit-duracion').value = s.duracionMinuto;
    document.getElementById('edit-precio').value = s.precio;
}
</script>

@endsection