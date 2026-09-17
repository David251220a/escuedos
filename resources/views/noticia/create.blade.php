@extends('layouts.admin')

@section('styles')
    <style>
        .tipo-presentacion {
            cursor: pointer;
        }

        .tipo-presentacion input {
            position: absolute;
            opacity: 0;
        }

        .tipo-presentacion .card {
            height: 100%;
            transition: .2s ease;
        }

        .tipo-presentacion input:checked + .card {
            border-color: var(--bs-primary);
            background-color: rgba(13, 110, 253, .05);
            box-shadow: 0 0 0 2px rgba(13, 110, 253, .15);
        }

        .vista-imagen {
            width: 90px;
            height: 70px;
            object-fit: cover;
            border-radius: 6px;
        }
    </style>
@endsection

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Nueva noticia</h4>
            <p class="text-muted mb-0">
                Complete la información para registrar la noticia.
            </p>
        </div>

        <a href="{{ route('noticia.index') }}"
           class="btn btn-outline-secondary">
            Volver
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Verifique los siguientes datos:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('noticia.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="row">

            {{-- Información principal --}}
            <div class="col-lg-8">

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Información de la noticia</h5>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label for="titulo" class="form-label">
                                Título <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="titulo"
                                   id="titulo"
                                   value="{{ old('titulo') }}"
                                   class="form-control @error('titulo') is-invalid @enderror"
                                   maxlength="255"
                                   required>

                            @error('titulo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="resumen" class="form-label">
                                Resumen
                            </label>

                            <textarea name="resumen"
                                      id="resumen"
                                      rows="3"
                                      maxlength="500"
                                      class="form-control @error('resumen') is-invalid @enderror"
                                      placeholder="Resumen breve que aparecerá en la tarjeta">{{ old('resumen') }}</textarea>

                            <div class="form-text">
                                Se mostrará debajo del título en el listado público.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="contenido" class="form-label">
                                Contenido <span class="text-danger">*</span>
                            </label>

                            <textarea name="contenido"
                                      id="contenido"
                                      rows="12"
                                      class="form-control @error('contenido') is-invalid @enderror"
                                      required>{{ old('contenido') }}</textarea>

                            @error('contenido')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fecha_evento" class="form-label">
                                    Fecha del evento
                                </label>

                                <input type="date"
                                       name="fecha_evento"
                                       id="fecha_evento"
                                       value="{{ old('fecha_evento') }}"
                                       class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fecha_publicacion" class="form-label">
                                    Fecha de publicación
                                </label>

                                <input type="datetime-local"
                                       name="fecha_publicacion"
                                       id="fecha_publicacion"
                                       value="{{ old('fecha_publicacion') }}"
                                       class="form-control">
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Tipo de presentación --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Forma de presentación</h5>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-info py-2">
                            <small>
                                Esta opción solamente define el diseño de la noticia.
                                Todas las noticias publicadas aparecerán automáticamente
                                en la página principal.
                            </small>
                        </div>

                        <div class="row g-3">

                            <div class="col-md-6 col-xl-4">
                                <label class="tipo-presentacion d-block">
                                    <input type="radio"
                                           name="tipo_presentacion"
                                           value="NORMAL"
                                           {{ old('tipo_presentacion', 'NORMAL') === 'NORMAL' ? 'checked' : '' }}>

                                    <div class="card">
                                        <div class="card-body">
                                            <h6>Normal</h6>
                                            <small class="text-muted">
                                                Tarjeta común con portada, fecha,
                                                título y resumen.
                                            </small>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <label class="tipo-presentacion d-block">
                                    <input type="radio"
                                           name="tipo_presentacion"
                                           value="DESTACADA"
                                           {{ old('tipo_presentacion') === 'DESTACADA' ? 'checked' : '' }}>

                                    <div class="card">
                                        <div class="card-body">
                                            <h6>Destacada</h6>
                                            <small class="text-muted">
                                                Utiliza un diseño más amplio y llamativo.
                                                No modifica el orden de publicación.
                                            </small>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <label class="tipo-presentacion d-block">
                                    <input type="radio"
                                           name="tipo_presentacion"
                                           value="CARRUSEL"
                                           {{ old('tipo_presentacion') === 'CARRUSEL' ? 'checked' : '' }}>

                                    <div class="card">
                                        <div class="card-body">
                                            <h6>Carrusel de imágenes</h6>
                                            <small class="text-muted">
                                                Las imágenes adicionales se mostrarán como
                                                un carrusel dentro del detalle de la noticia.
                                            </small>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <label class="tipo-presentacion d-block">
                                    <input type="radio"
                                           name="tipo_presentacion"
                                           value="GALERIA"
                                           {{ old('tipo_presentacion') === 'GALERIA' ? 'checked' : '' }}>

                                    <div class="card">
                                        <div class="card-body">
                                            <h6>Galería</h6>
                                            <small class="text-muted">
                                                Las imágenes se mostrarán en una
                                                galería.
                                            </small>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <label class="tipo-presentacion d-block">
                                    <input type="radio"
                                           name="tipo_presentacion"
                                           value="COMUNICADO"
                                           {{ old('tipo_presentacion') === 'COMUNICADO' ? 'checked' : '' }}>

                                    <div class="card">
                                        <div class="card-body">
                                            <h6>Comunicado</h6>
                                            <small class="text-muted">
                                                Diseño formal para avisos y
                                                comunicados institucionales.
                                            </small>
                                        </div>
                                    </div>
                                </label>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Imágenes adicionales --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">Imágenes adicionales</h5>
                            <small class="text-muted">
                                Puede agregar varias imágenes.
                            </small>
                        </div>

                        <button type="button"
                                class="btn btn-sm btn-outline-primary"
                                id="agregarImagen">
                            Agregar imagen
                        </button>
                    </div>

                    <div class="card-body">
                        <div id="contenedorImagenes">

                            <div class="imagen-item border rounded p-3 mb-3">
                                <div class="row align-items-end g-3">

                                    <div class="col-md-4">
                                        <label class="form-label">
                                            Imagen
                                        </label>

                                        <input type="file"
                                               name="imagenes[]"
                                               class="form-control input-imagen"
                                               accept=".jpg,.jpeg,.png,.webp">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">
                                            Título
                                        </label>

                                        <input type="text"
                                               name="titulos_imagen[]"
                                               class="form-control"
                                               maxlength="255">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">
                                            Texto alternativo
                                        </label>

                                        <input type="text"
                                               name="textos_alternativos[]"
                                               class="form-control"
                                               maxlength="255">
                                    </div>

                                    <div class="col-md-2">
                                        <button type="button"
                                                class="btn btn-outline-danger w-100 btn-eliminar-imagen">
                                            Quitar
                                        </button>
                                    </div>

                                    <div class="col-12 contenedor-vista d-none">
                                        <img src=""
                                             class="vista-imagen"
                                             alt="Vista previa">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            {{-- Configuración lateral --}}
            <div class="col-lg-4">

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Publicación</h5>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label for="estado" class="form-label">
                                Estado
                            </label>

                            <select name="estado" id="estado" class="form-select form-control" required>

                                <option value="BORRADOR"
                                    {{ old('estado') === 'BORRADOR' ? 'selected' : '' }}>
                                    Borrador
                                </option>

                                <option value="PUBLICADA"
                                    {{ old('estado') === 'PUBLICADA' ? 'selected' : '' }}>
                                    Publicada
                                </option>
                            </select>
                        </div>

                        <button type="submit"
                                class="btn btn-primary w-100">
                            Guardar noticia
                        </button>

                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Imagen de portada</h5>
                    </div>

                    <div class="card-body">
                        <input type="file"
                               name="imagen_portada"
                               id="imagen_portada"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.webp">

                        <div class="form-text">
                            Formatos permitidos: JPG, PNG y WEBP. Máximo 5 MB.
                        </div>

                        <img id="vistaPortada"
                             src=""
                             class="img-fluid rounded mt-3 d-none"
                             alt="Vista previa de la portada">
                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Etiquetas</h5>
                    </div>

                    <div class="card-body">

                        @forelse($tags as $tag)
                            <div class="form-check mb-2">
                                <input type="checkbox"
                                       name="tags[]"
                                       value="{{ $tag->id }}"
                                       id="tag_{{ $tag->id }}"
                                       class="form-check-input"
                                       {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>

                                <label for="tag_{{ $tag->id }}"
                                       class="form-check-label">
                                    {{ $tag->nombre }}
                                </label>
                            </div>
                        @empty
                            <p class="text-muted mb-0">
                                No hay etiquetas disponibles.
                            </p>
                        @endforelse

                    </div>
                </div>

            </div>

        </div>
    </form>

</div>

@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const contenedor = document.getElementById('contenedorImagenes');
        const botonAgregar = document.getElementById('agregarImagen');
        const inputPortada = document.getElementById('imagen_portada');
        const vistaPortada = document.getElementById('vistaPortada');

        botonAgregar.addEventListener('click', function () {
            const item = document.createElement('div');

            item.className = 'imagen-item border rounded p-3 mb-3';

            item.innerHTML = `
                <div class="row align-items-end g-3">
                    <div class="col-md-4">
                        <label class="form-label">Imagen</label>
                        <input type="file"
                               name="imagenes[]"
                               class="form-control input-imagen"
                               accept=".jpg,.jpeg,.png,.webp">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Título</label>
                        <input type="text"
                               name="titulos_imagen[]"
                               class="form-control"
                               maxlength="255">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">
                            Texto alternativo
                        </label>
                        <input type="text"
                               name="textos_alternativos[]"
                               class="form-control"
                               maxlength="255">
                    </div>

                    <div class="col-md-2">
                        <button type="button"
                                class="btn btn-outline-danger w-100 btn-eliminar-imagen">
                            Quitar
                        </button>
                    </div>

                    <div class="col-12 contenedor-vista d-none">
                        <img src=""
                             class="vista-imagen"
                             alt="Vista previa">
                    </div>
                </div>
            `;

            contenedor.appendChild(item);
        });

        contenedor.addEventListener('click', function (event) {
            if (!event.target.classList.contains('btn-eliminar-imagen')) {
                return;
            }

            const items = contenedor.querySelectorAll('.imagen-item');

            if (items.length === 1) {
                const item = event.target.closest('.imagen-item');

                item.querySelectorAll('input').forEach(function (input) {
                    input.value = '';
                });

                item.querySelector('.contenedor-vista')
                    .classList.add('d-none');

                return;
            }

            event.target.closest('.imagen-item').remove();
        });

        contenedor.addEventListener('change', function (event) {
            if (!event.target.classList.contains('input-imagen')) {
                return;
            }

            const archivo = event.target.files[0];

            if (!archivo) {
                return;
            }

            const item = event.target.closest('.imagen-item');
            const contenedorVista = item.querySelector('.contenedor-vista');
            const imagen = item.querySelector('.vista-imagen');
            const lector = new FileReader();

            lector.onload = function (e) {
                imagen.src = e.target.result;
                contenedorVista.classList.remove('d-none');
            };

            lector.readAsDataURL(archivo);
        });

        inputPortada.addEventListener('change', function () {
            const archivo = this.files[0];

            if (!archivo) {
                vistaPortada.src = '';
                vistaPortada.classList.add('d-none');
                return;
            }

            const lector = new FileReader();

            lector.onload = function (e) {
                vistaPortada.src = e.target.result;
                vistaPortada.classList.remove('d-none');
            };

            lector.readAsDataURL(archivo);
        });
    });
</script>
@endsection
