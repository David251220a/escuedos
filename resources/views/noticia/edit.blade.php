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

    .imagen-existente {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }

    .vista-imagen {
        width: 100px;
        height: 75px;
        object-fit: cover;
        border-radius: 6px;
    }
</style>
@endsection

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Editar noticia</h4>
            <p class="text-muted mb-0">
                Modifique la información de la noticia.
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

    <form action="{{ route('noticia.update', $noticia) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="row">

            <div class="col-lg-8">

                {{-- Información --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Información de la noticia</h5>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label for="titulo" class="form-label">
                                Título
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="titulo"
                                   id="titulo"
                                   value="{{ old('titulo', $noticia->titulo) }}"
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
                                      class="form-control">{{ old('resumen', $noticia->resumen) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="contenido" class="form-label">
                                Contenido
                                <span class="text-danger">*</span>
                            </label>

                            <textarea name="contenido"
                                      id="contenido"
                                      rows="12"
                                      class="form-control @error('contenido') is-invalid @enderror"
                                      required>{{ old('contenido', $noticia->contenido) }}</textarea>

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
                                       value="{{ old(
                                            'fecha_evento',
                                            optional($noticia->fecha_evento)->format('Y-m-d')
                                       ) }}"
                                       class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fecha_publicacion"
                                       class="form-label">
                                    Fecha de publicación
                                </label>

                                <input type="datetime-local" name="fecha_publicacion" id="fecha_publicacion" value="{{ old('fecha_publicacion', $noticia->fecha_publicacion) }}" class="form-control">
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Presentación --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Forma de presentación</h5>
                    </div>

                    <div class="card-body">

                        <div class="alert alert-info py-2">
                            <small>
                                Esta opción solamente define el diseño.
                                Todas las noticias publicadas aparecen
                                automáticamente en el portal.
                            </small>
                        </div>

                        @php
                            $tipoActual = old(
                                'tipo_presentacion',
                                $noticia->tipo_presentacion
                            );

                            $tipos = [
                                'NORMAL' => [
                                    'nombre' => 'Normal',
                                    'descripcion' => 'Presentación estándar.'
                                ],
                                'DESTACADA' => [
                                    'nombre' => 'Destacada',
                                    'descripcion' => 'Diseño más amplio y llamativo.'
                                ],
                                'CARRUSEL' => [
                                    'nombre' => 'Carrusel',
                                    'descripcion' => 'Imágenes en carrusel dentro de la noticia.'
                                ],
                                'GALERIA' => [
                                    'nombre' => 'Galería',
                                    'descripcion' => 'Imágenes mostradas en cuadrícula.'
                                ],
                                'COMUNICADO' => [
                                    'nombre' => 'Comunicado',
                                    'descripcion' => 'Diseño formal institucional.'
                                ],
                            ];
                        @endphp

                        <div class="row g-3">
                            @foreach($tipos as $valor => $tipo)
                                <div class="col-md-6 col-xl-4">
                                    <label class="tipo-presentacion d-block">
                                        <input type="radio"
                                               name="tipo_presentacion"
                                               value="{{ $valor }}"
                                               {{ $tipoActual === $valor
                                                    ? 'checked'
                                                    : '' }}>

                                        <div class="card">
                                            <div class="card-body">
                                                <h6>{{ $tipo['nombre'] }}</h6>

                                                <small class="text-muted">
                                                    {{ $tipo['descripcion'] }}
                                                </small>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                {{-- Imágenes existentes --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Imágenes actuales</h5>
                    </div>

                    <div class="card-body">

                        @forelse($noticia->imagenes as $imagen)
                            <div class="border rounded p-3 mb-3">
                                <div class="row align-items-center g-3">

                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/' . $imagen->imagen) }}"
                                             class="imagen-existente rounded"
                                             alt="{{ $imagen->texto_alternativo }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">
                                            Título
                                        </label>

                                        <input type="text"
                                               name="imagenes_existentes[{{ $imagen->id }}][titulo]"
                                               value="{{ old(
                                                    'imagenes_existentes.' . $imagen->id . '.titulo',
                                                    $imagen->titulo
                                               ) }}"
                                               class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">
                                            Texto alternativo
                                        </label>

                                        <input type="text"
                                               name="imagenes_existentes[{{ $imagen->id }}][texto_alternativo]"
                                               value="{{ old(
                                                    'imagenes_existentes.' . $imagen->id . '.texto_alternativo',
                                                    $imagen->texto_alternativo
                                               ) }}"
                                               class="form-control">
                                    </div>

                                    <div class="col-md-1 text-center">
                                        <div class="form-check">
                                            <input type="checkbox"
                                                   name="imagenes_eliminar[]"
                                                   value="{{ $imagen->id }}"
                                                   id="eliminar_{{ $imagen->id }}"
                                                   class="form-check-input">

                                            <label for="eliminar_{{ $imagen->id }}"
                                                   class="form-check-label text-danger">
                                                Quitar
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <p class="text-muted mb-0">
                                Esta noticia no tiene imágenes adicionales.
                            </p>
                        @endforelse

                    </div>
                </div>

                {{-- Nuevas imágenes --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white d-flex justify-content-between">
                        <div>
                            <h5 class="mb-0">Agregar imágenes</h5>
                            <small class="text-muted">
                                Puede agregar nuevas imágenes.
                            </small>
                        </div>

                        <button type="button"
                                id="agregarImagen"
                                class="btn btn-sm btn-outline-primary">
                            Agregar imagen
                        </button>
                    </div>

                    <div class="card-body">
                        <div id="contenedorImagenes"></div>
                    </div>
                </div>

            </div>

            {{-- Columna derecha --}}
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

                            <select name="estado" id="estado"class="form-select form-control">
                                <option value="BORRADOR" {{ old('estado', $noticia->estado) === 'BORRADOR' ? 'selected' : '' }}>
                                    Borrador
                                </option>

                                <option value="PUBLICADA" {{ old('estado', $noticia->estado) === 'PUBLICADA' ? 'selected' : '' }}>
                                    Publicada
                                </option>
                            </select>
                        </div>

                        <button type="submit"
                                class="btn btn-primary w-100">
                            Guardar cambios
                        </button>
                    </div>
                </div>

                {{-- Portada --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Imagen de portada</h5>
                    </div>

                    <div class="card-body">

                        @if($noticia->imagen_portada)
                            <img src="{{ asset('storage/' . $noticia->imagen_portada) }}"
                                 id="vistaPortada"
                                 class="img-fluid rounded mb-3"
                                 alt="Portada">

                            <div class="form-check mb-3">
                                <input type="checkbox"
                                       name="eliminar_portada"
                                       value="1"
                                       id="eliminar_portada"
                                       class="form-check-input">

                                <label for="eliminar_portada"
                                       class="form-check-label text-danger">
                                    Eliminar portada actual
                                </label>
                            </div>
                        @else
                            <img src=""
                                 id="vistaPortada"
                                 class="img-fluid rounded mb-3 d-none"
                                 alt="Vista previa">
                        @endif

                        <label for="imagen_portada" class="form-label">
                            Reemplazar portada
                        </label>

                        <input type="file"
                               name="imagen_portada"
                               id="imagen_portada"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.webp">
                    </div>
                </div>

                {{-- Etiquetas --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Etiquetas</h5>
                    </div>

                    <div class="card-body">
                        @php
                            $tagsSeleccionados = old(
                                'tags',
                                $noticia->tags->pluck('id')->toArray()
                            );
                        @endphp

                        @forelse($tags as $tag)
                            <div class="form-check mb-2">
                                <input type="checkbox"
                                       name="tags[]"
                                       value="{{ $tag->id }}"
                                       id="tag_{{ $tag->id }}"
                                       class="form-check-input"
                                       {{ in_array(
                                            $tag->id,
                                            $tagsSeleccionados
                                       ) ? 'checked' : '' }}>

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
        const agregar = document.getElementById('agregarImagen');
        const portada = document.getElementById('imagen_portada');
        const vistaPortada = document.getElementById('vistaPortada');

        agregar.addEventListener('click', function () {
            const item = document.createElement('div');

            item.className = 'imagen-item border rounded p-3 mb-3';

            item.innerHTML = `
                <div class="row align-items-end g-3">
                    <div class="col-md-4">
                        <label class="form-label">Imagen</label>

                        <input type="file"
                            name="imagenes[]"
                            class="form-control input-imagen"
                            accept=".jpg,.jpeg,.png,.webp"
                            required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Título</label>

                        <input type="text"
                            name="titulos_imagen[]"
                            class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">
                            Texto alternativo
                        </label>

                        <input type="text"
                            name="textos_alternativos[]"
                            class="form-control">
                    </div>

                    <div class="col-md-2">
                        <button type="button"
                                class="btn btn-outline-danger w-100 btn-quitar">
                            Quitar
                        </button>
                    </div>

                    <div class="col-12 vista-contenedor d-none">
                        <img src=""
                            class="vista-imagen"
                            alt="Vista previa">
                    </div>
                </div>
            `;

            contenedor.appendChild(item);
        });

        contenedor.addEventListener('click', function (event) {
            if (event.target.classList.contains('btn-quitar')) {
                event.target.closest('.imagen-item').remove();
            }
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
            const contenedorVista = item.querySelector('.vista-contenedor');
            const imagen = item.querySelector('.vista-imagen');
            const lector = new FileReader();

            lector.onload = function (e) {
                imagen.src = e.target.result;
                contenedorVista.classList.remove('d-none');
            };

            lector.readAsDataURL(archivo);
        });

        portada.addEventListener('change', function () {
            const archivo = this.files[0];

            if (!archivo) {
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
