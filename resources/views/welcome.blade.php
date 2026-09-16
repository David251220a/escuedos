@extends('layouts.www')

@section('title', ($entidad->nombre ?? 'Escuela') . ' - Inicio')

@section('content')

@php
    $noticiasCarrusel = $noticiasCarrusel ?? collect();
    $ultimasNoticias = $ultimasNoticias ?? collect();
    $docentes = $docentes ?? collect();
@endphp

{{-- ========================================================= --}}
{{-- PORTADA O CARRUSEL PRINCIPAL --}}
{{-- ========================================================= --}}

<section class="seccion-carrusel">

    @if($noticiasCarrusel->count() > 0)

        <div
            id="carruselPrincipal"
            class="carousel slide carousel-fade"
            data-bs-ride="carousel"
            data-bs-interval="6000"
        >

            {{-- Indicadores --}}
            <div class="carousel-indicators">
                @foreach($noticiasCarrusel as $noticia)
                    <button
                        type="button"
                        data-bs-target="#carruselPrincipal"
                        data-bs-slide-to="{{ $loop->index }}"
                        class="{{ $loop->first ? 'active' : '' }}"
                        aria-current="{{ $loop->first ? 'true' : 'false' }}"
                        aria-label="Noticia {{ $loop->iteration }}"
                    ></button>
                @endforeach
            </div>

            {{-- Contenido del carrusel --}}
            <div class="carousel-inner">

                @foreach($noticiasCarrusel as $noticia)

                    @php
                        $imagenCarrusel = $noticia->imagen_portada
                            ? asset('storage/' . $noticia->imagen_portada)
                            : asset('images/noticia-default.jpg');
                    @endphp

                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">

                        <img
                            src="{{ $imagenCarrusel }}"
                            class="imagen-carrusel"
                            alt="{{ $noticia->titulo }}"
                        >

                        <div class="capa-carrusel"></div>

                        <div class="carousel-caption contenido-carrusel">
                            <div class="container">
                                <div class="contenido-carrusel-interno">

                                    {{-- Tags --}}
                                    @foreach($noticia->tags->take(3) as $tag)
                                        <span class="tag-carrusel">
                                            {{ $tag->nombre }}
                                        </span>
                                    @endforeach

                                    <h1>
                                        {{ $noticia->titulo }}
                                    </h1>

                                    @if($noticia->resumen)
                                        <p>
                                            {{ Illuminate\Support\Str::limit(
                                                $noticia->resumen,
                                                170
                                            ) }}
                                        </p>
                                    @endif

                                    <a
                                        href="{{ url('/noticias/' . $noticia->slug) }}"
                                        class="btn btn-ver-noticia"
                                    >
                                        Leer noticia
                                        <i class="bi bi-arrow-right"></i>
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>

                @endforeach

            </div>

            {{-- Botón anterior --}}
            <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carruselPrincipal"
                data-bs-slide="prev"
            >
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Anterior</span>
            </button>

            {{-- Botón siguiente --}}
            <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carruselPrincipal"
                data-bs-slide="next"
            >
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>

        </div>

    @else

        {{-- Portada cuando todavía no hay noticias en el carrusel --}}
        <div class="portada-inicial">
            <div class="container">
                <div class="row align-items-center min-vh-portada">

                    <div class="col-lg-7">

                        <span class="etiqueta-bienvenida">
                            Bienvenidos
                        </span>

                        <h1>
                            {{ $entidad->nombre ?? 'Nombre de la Escuela' }}
                        </h1>

                        <p>
                            {{ $entidad->lema ?? 'Educando para construir un futuro mejor.' }}
                        </p>

                        <a
                            href="#noticias"
                            class="btn btn-ver-noticia"
                        >
                            Ver novedades
                            <i class="bi bi-arrow-down"></i>
                        </a>

                    </div>

                    <div class="col-lg-5 text-center d-none d-lg-block">
                        <i class="bi bi-mortarboard-fill icono-portada"></i>
                    </div>

                </div>
            </div>
        </div>

    @endif

</section>

{{-- ========================================================= --}}
{{-- ÚLTIMAS NOTICIAS --}}
{{-- ========================================================= --}}

<section
    class="seccion-noticias"
    id="noticias"
>
    <div class="container">

        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">

            <div class="encabezado-seccion">
                <span>Información institucional</span>

                <h2>Últimas noticias</h2>

                <div class="linea-titulo linea-izquierda"></div>
            </div>

            <a
                href="{{ url('/noticias') }}"
                class="enlace-ver-todas"
            >
                Ver todas las noticias
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>

        @if($ultimasNoticias->count() > 0)

            <div class="row g-4">

                @foreach($ultimasNoticias as $noticia)

                    @php
                        $imagenNoticia = $noticia->imagen_portada
                            ? asset('storage/' . $noticia->imagen_portada)
                            : asset('images/noticia-default.jpg');
                    @endphp

                    <div class="col-md-6 col-lg-4">

                        <article class="noticia-card">

                            {{-- Imagen --}}
                            <a href="{{ url('/noticias/' . $noticia->slug) }}">
                                <div class="contenedor-imagen-noticia">

                                    <img
                                        src="{{ $imagenNoticia }}"
                                        alt="{{ $noticia->titulo }}"
                                    >

                                    @if(
                                        $noticia->tipo_presentacion === 'CARRUSEL' ||
                                        $noticia->tipo_presentacion === 'GALERIA'
                                    )
                                        <span class="indicador-galeria">
                                            <i class="bi bi-images"></i>

                                            {{ $noticia->tipo_presentacion === 'CARRUSEL'
                                                ? 'Carrusel'
                                                : 'Galería' }}
                                        </span>
                                    @endif

                                </div>
                            </a>

                            {{-- Contenido --}}
                            <div class="contenido-noticia">

                                {{-- Tags --}}
                                @if($noticia->tags->count() > 0)
                                    <div class="tags-noticia">
                                        @foreach($noticia->tags->take(2) as $tag)
                                            <span>
                                                {{ $tag->nombre }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Fecha --}}
                                <div class="fecha-noticia">
                                    <i class="bi bi-calendar3"></i>

                                    {{ $noticia->fecha_publicacion
                                        ? $noticia->fecha_publicacion->format('d/m/Y')
                                        : $noticia->created_at->format('d/m/Y') }}
                                </div>

                                {{-- Título --}}
                                <h3>
                                    <a href="{{ url('/noticias/' . $noticia->slug) }}">
                                        {{ $noticia->titulo }}
                                    </a>
                                </h3>

                                {{-- Resumen --}}
                                @if($noticia->resumen)
                                    <p>
                                        {{ Illuminate\Support\Str::limit(
                                            $noticia->resumen,
                                            120
                                        ) }}
                                    </p>
                                @endif

                                <a
                                    href="{{ url('/noticias/' . $noticia->slug) }}"
                                    class="leer-mas"
                                >
                                    Leer más
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                            </div>

                        </article>

                    </div>

                @endforeach

            </div>

        @else

            <div class="sin-noticias">

                <i class="bi bi-newspaper"></i>

                <h3>
                    Próximamente publicaremos novedades
                </h3>

                <p>
                    En esta sección encontrarás noticias, eventos,
                    reuniones y comunicados institucionales.
                </p>

            </div>

        @endif

    </div>
</section>

{{-- ========================================================= --}}
{{-- PERSONAL DOCENTE --}}
{{-- ========================================================= --}}

<section
    class="seccion-docentes"
    id="docentes"
>
    <div class="container">

        <div class="encabezado-seccion text-center mb-5">

            <span>Comunidad educativa</span>

            <h2>Nuestro personal docente</h2>

            <div class="linea-titulo"></div>

            <p class="subtitulo-seccion">
                Conocé a los profesionales que acompañan la formación
                y el aprendizaje de nuestros estudiantes.
            </p>

        </div>

        @if($docentes->count() > 0)

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 justify-content-center">

                @foreach($docentes as $docente)

                    <div class="col">

                        <article class="docente-item">

                            <div class="foto-docente-contenedor">

                                @if($docente->foto)

                                    <img
                                        src="{{ asset('storage/' . $docente->foto) }}"
                                        alt="{{ $docente->nombre }} {{ $docente->apellido }}"
                                        class="foto-docente"
                                    >

                                @else

                                    <div class="foto-docente foto-docente-vacia">
                                        <i class="bi bi-person-fill"></i>
                                    </div>

                                @endif

                            </div>

                            <div class="informacion-docente">

                                <h3>
                                    {{ $docente->nombre }}
                                    {{ $docente->apellido }}
                                </h3>

                                <span>
                                    Docente
                                </span>

                            </div>

                        </article>

                    </div>

                @endforeach

            </div>

        @else

            <div class="sin-docentes">

                <i class="bi bi-people"></i>

                <h3>
                    Personal docente
                </h3>

                <p>
                    Próximamente publicaremos información sobre
                    nuestro equipo docente.
                </p>

            </div>

        @endif

    </div>
</section>

{{-- ========================================================= --}}
{{-- CONTACTO --}}
{{-- ========================================================= --}}

<section class="franja-contacto">
    <div class="container">

        <div class="row align-items-center g-4">

            <div class="col-lg-8">

                <h2>
                    Estamos para acompañar a nuestra comunidad educativa
                </h2>

                <p>
                    Comunicate con la institución para obtener más información.
                </p>

            </div>

            <div class="col-lg-4 text-lg-end">

                @if(!empty($entidad?->whatsapp))

                    <a
                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $entidad->whatsapp) }}"
                        target="_blank"
                        rel="noopener"
                        class="btn btn-contacto"
                    >
                        <i class="bi bi-whatsapp"></i>
                        Contactar
                    </a>

                @elseif(!empty($entidad?->email))

                    <a
                        href="mailto:{{ $entidad->email }}"
                        class="btn btn-contacto"
                    >
                        <i class="bi bi-envelope"></i>
                        Contactar
                    </a>

                @endif

            </div>

        </div>

    </div>
</section>

@endsection
