@extends('layouts.www')

@section('title', ($entidad->nombre ?? 'Escuela') . ' - Inicio')

@section('styles')
<style>
    /* =====================================================
       PORTADA DE LA ESCUELA
    ===================================================== */

    .portada-principal {
        position: relative;
        overflow: hidden;
        color: #fff;
        background:
            linear-gradient(
                135deg,
                rgba(7, 58, 105, .96),
                rgba(22, 139, 210, .88)
            );
    }

    .portada-principal::before {
        position: absolute;
        top: -180px;
        right: -160px;
        width: 520px;
        height: 520px;
        content: "";
        background: rgba(255, 255, 255, .08);
        border-radius: 50%;
    }

    .portada-principal::after {
        position: absolute;
        bottom: -190px;
        left: -130px;
        width: 430px;
        height: 430px;
        content: "";
        background: rgba(255, 255, 255, .05);
        border-radius: 50%;
    }

    .portada-contenido {
        position: relative;
        z-index: 2;
        min-height: 520px;
        padding-top: 70px;
        padding-bottom: 70px;
    }

    .portada-etiqueta {
        display: inline-block;
        padding: 7px 15px;
        margin-bottom: 20px;
        color: #073a69;
        background: #fff;
        border-radius: 30px;
        font-size: .84rem;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .portada-titulo {
        max-width: 760px;
        margin-bottom: 18px;
        color: #fff;
        font-size: clamp(2.4rem, 5vw, 4.6rem);
        font-weight: 800;
        line-height: 1.08;
    }

    .portada-lema {
        max-width: 650px;
        margin-bottom: 30px;
        color: rgba(255, 255, 255, .9);
        font-size: 1.25rem;
        line-height: 1.7;
    }

    .portada-boton {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 12px 23px;
        color: #073a69;
        background: #fff;
        border: 2px solid #fff;
        border-radius: 30px;
        font-weight: 700;
        transition: all .2s ease;
    }

    .portada-boton:hover {
        color: #fff;
        background: transparent;
    }

    .portada-icono-contenedor {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 270px;
        height: 270px;
        margin: auto;
        color: #fff;
        background: rgba(255, 255, 255, .13);
        border: 2px solid rgba(255, 255, 255, .25);
        border-radius: 50%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .18);
        backdrop-filter: blur(8px);
    }

    .portada-icono {
        font-size: 8rem;
    }

    /* =====================================================
       TÍTULOS DE SECCIONES
    ===================================================== */

    .seccion-encabezado {
        margin-bottom: 38px;
        text-align: center;
    }

    .seccion-encabezado > span {
        display: block;
        margin-bottom: 8px;
        color: #168bd2;
        font-size: .82rem;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .seccion-encabezado h2 {
        margin-bottom: 12px;
        color: #073a69;
        font-size: clamp(2rem, 4vw, 2.8rem);
        font-weight: 800;
    }

    .linea-seccion {
        width: 70px;
        height: 4px;
        margin: 0 auto;
        background: #168bd2;
        border-radius: 5px;
    }

    .seccion-encabezado p {
        max-width: 720px;
        margin: 18px auto 0;
        color: #667085;
        line-height: 1.7;
    }

    /* =====================================================
       CARRUSEL DE NOTICIAS
    ===================================================== */

    .seccion-ultimas-noticias {
        padding: 75px 0;
        background: #f5f8fc;
    }

    .noticias-carousel {
        width: 100%;
        max-width: 1120px;
        margin: 0 auto;
        padding-bottom: 50px;
    }

    .noticia-slide {
        overflow: hidden;
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 22px;
        box-shadow: 0 16px 45px rgba(16, 24, 40, .1);
    }

    .noticia-slide-imagen-contenedor {
        position: relative;
        min-height: 430px;
        overflow: hidden;
        background: #dfe7f0;
    }

    .noticia-slide-imagen {
        display: block;
        width: 100%;
        height: 430px;
        object-fit: cover;
        object-position: center;
    }

    .noticia-slide-contenido {
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 430px;
        padding: clamp(28px, 5vw, 55px);
    }

    .noticia-slide-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin-bottom: 17px;
    }

    .noticia-slide-tag {
        display: inline-block;
        padding: 5px 11px;
        color: #fff;
        background: #168bd2;
        border-radius: 20px;
        font-size: .76rem;
        font-weight: 700;
    }

    .noticia-slide-fecha {
        margin-bottom: 13px;
        color: #667085;
        font-size: .9rem;
    }

    .noticia-slide-titulo {
        margin-bottom: 17px;
        color: #172033;
        font-size: clamp(1.7rem, 3vw, 2.6rem);
        font-weight: 800;
        line-height: 1.18;
    }

    .noticia-slide-resumen {
        margin-bottom: 25px;
        color: #475467;
        font-size: 1rem;
        line-height: 1.75;
    }

    .boton-leer-noticia {
        display: inline-flex;
        align-items: center;
        align-self: flex-start;
        gap: 9px;
        padding: 11px 21px;
        color: #fff;
        background: #168bd2;
        border: 2px solid #168bd2;
        border-radius: 30px;
        font-weight: 700;
        text-decoration: none;
        transition: all .2s ease;
    }

    .boton-leer-noticia:hover {
        color: #168bd2;
        background: #fff;
    }

    .noticias-carousel .carousel-control-prev,
    .noticias-carousel .carousel-control-next {
        top: 50%;
        bottom: auto;
        width: 46px;
        height: 46px;
        color: #fff;
        background: #073a69;
        border-radius: 50%;
        opacity: 1;
        transform: translateY(-50%);
    }

    .noticias-carousel .carousel-control-prev {
        left: -23px;
    }

    .noticias-carousel .carousel-control-next {
        right: -23px;
    }

    .noticias-carousel .carousel-control-prev-icon,
    .noticias-carousel .carousel-control-next-icon {
        width: 20px;
        height: 20px;
    }

    .noticias-carousel .carousel-indicators {
        bottom: 0;
        margin-bottom: 8px;
    }

    .noticias-carousel .carousel-indicators button {
        width: 10px;
        height: 10px;
        background-color: #168bd2;
        border: 0;
        border-radius: 50%;
    }

    .enlace-todas-noticias {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 25px;
        color: #073a69;
        font-weight: 700;
        text-decoration: none;
    }

    .enlace-todas-noticias:hover {
        color: #168bd2;
    }

    /* =====================================================
       CARRUSEL DE DOCENTES
    ===================================================== */

    .seccion-docentes {
        padding: 75px 0;
        background: #fff;
    }

    .docentes-carousel {
        padding: 5px 55px 55px;
    }

    .docentes-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 20px;
    }

    .docente-card {
        height: 100%;
        padding: 22px 14px;
        text-align: center;
        background: #fff;
        border: 1px solid #e4eaf2;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(16, 24, 40, .07);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .docente-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 32px rgba(16, 24, 40, .12);
    }

    .docente-foto-contenedor {
        width: 130px;
        height: 130px;
        margin: 0 auto 17px;
        overflow: hidden;
        background: #e8f2fa;
        border: 5px solid #edf6fc;
        border-radius: 50%;
    }

    .docente-foto {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
    }

    .docente-sin-foto {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        color: #168bd2;
        font-size: 3.2rem;
    }

    .docente-card h3 {
        margin-bottom: 6px;
        color: #172033;
        font-size: 1rem;
        font-weight: 700;
        line-height: 1.35;
    }

    .docente-card span {
        color: #168bd2;
        font-size: .86rem;
        font-weight: 600;
    }

    .docentes-carousel .carousel-control-prev,
    .docentes-carousel .carousel-control-next {
        top: 50%;
        bottom: auto;
        width: 42px;
        height: 42px;
        background: #168bd2;
        border-radius: 50%;
        opacity: 1;
        transform: translateY(-50%);
    }

    .docentes-carousel .carousel-control-prev {
        left: 0;
    }

    .docentes-carousel .carousel-control-next {
        right: 0;
    }

    .docentes-carousel .carousel-control-prev-icon,
    .docentes-carousel .carousel-control-next-icon {
        width: 18px;
        height: 18px;
    }

    .docentes-carousel .carousel-indicators {
        bottom: 0;
        margin-bottom: 5px;
    }

    .docentes-carousel .carousel-indicators button {
        width: 9px;
        height: 9px;
        background-color: #168bd2;
        border: 0;
        border-radius: 50%;
    }

    /* =====================================================
       SIN DATOS
    ===================================================== */

    .sin-contenido {
        padding: 50px 20px;
        color: #667085;
        text-align: center;
        background: #f8fafc;
        border: 1px dashed #cfd8e3;
        border-radius: 18px;
    }

    .sin-contenido i {
        display: block;
        margin-bottom: 13px;
        color: #168bd2;
        font-size: 3rem;
    }

    .sin-contenido h3 {
        color: #172033;
        font-size: 1.35rem;
    }

    /* =====================================================
       CONTACTO
    ===================================================== */

    .franja-contacto {
        padding: 55px 0;
        color: #fff;
        background: linear-gradient(135deg, #0758a6, #24a7df);
    }

    .franja-contacto h2 {
        margin-bottom: 8px;
        color: #fff;
        font-weight: 800;
    }

    .franja-contacto p {
        margin-bottom: 0;
        color: rgba(255, 255, 255, .9);
    }

    .btn-contacto {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        color: #0758a6;
        background: #fff;
        border: 2px solid #fff;
        border-radius: 30px;
        font-weight: 700;
    }

    .btn-contacto:hover {
        color: #fff;
        background: transparent;
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 1199.98px) {
        .docentes-grid {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }
    }

    @media (max-width: 991.98px) {
        .portada-contenido {
            min-height: 460px;
        }

        .noticia-slide-imagen-contenedor {
            min-height: 330px;
        }

        .noticia-slide-imagen {
            height: 330px;
        }

        .noticia-slide-contenido {
            min-height: auto;
        }

        .docentes-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .noticias-carousel .carousel-control-prev {
            left: 10px;
        }

        .noticias-carousel .carousel-control-next {
            right: 10px;
        }
    }

    @media (max-width: 767.98px) {
        .portada-contenido {
            min-height: 430px;
            padding-top: 55px;
            padding-bottom: 55px;
        }

        .portada-lema {
            font-size: 1.05rem;
        }

        .seccion-ultimas-noticias,
        .seccion-docentes {
            padding: 55px 0;
        }

        .noticia-slide-imagen-contenedor {
            min-height: 260px;
        }

        .noticia-slide-imagen {
            height: 260px;
        }

        .noticia-slide-contenido {
            padding: 28px 24px;
        }

        .docentes-carousel {
            padding-right: 45px;
            padding-left: 45px;
        }

        .docentes-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .docente-foto-contenedor {
            width: 105px;
            height: 105px;
        }
    }

    @media (max-width: 420px) {
        .docentes-carousel {
            padding-right: 40px;
            padding-left: 40px;
        }

        .docentes-grid {
            grid-template-columns: 1fr;
        }

        .docente-card {
            max-width: 240px;
            margin: 0 auto;
        }
    }

    @media (max-width: 767.98px) {
        .noticias-carousel .carousel-control-prev,
        .noticias-carousel .carousel-control-next {
            top: 130px;
            width: 40px;
            height: 40px;
            transform: translateY(-50%);
        }

        .noticias-carousel .carousel-control-prev {
            left: 12px;
        }

        .noticias-carousel .carousel-control-next {
            right: 12px;
        }
    }
</style>
@endsection

@section('content')

@php
    $ultimasNoticias = $ultimasNoticias ?? collect();
    $docentes = $docentes ?? collect();
@endphp

{{-- ========================================================= --}}
{{-- PORTADA PRINCIPAL DE LA ESCUELA --}}
{{-- ========================================================= --}}

<section class="portada-principal" id="inicio">

    <div class="container">

        <div class="row align-items-center portada-contenido">

            <div class="col-lg-7">

                <span class="portada-etiqueta">
                    Bienvenidos
                </span>

                <h1 class="portada-titulo">
                    {{ $entidad->nombre ?? 'Nombre de la Escuela' }}
                </h1>

                <p class="portada-lema">
                    {{ $entidad->lema
                        ?? 'Educando para construir un futuro mejor.' }}
                </p>

                <a href="#ultimas-noticias"
                   class="portada-boton">

                    Ver últimas noticias

                    <i class="bi bi-arrow-down"></i>
                </a>

            </div>

            <div class="col-lg-5 d-none d-lg-block">

                <div class="portada-icono-contenedor">
                    <i class="bi bi-mortarboard-fill portada-icono"></i>
                </div>

            </div>

        </div>

    </div>

</section>

{{-- ========================================================= --}}
{{-- CARRUSEL DE ÚLTIMAS NOTICIAS --}}
{{-- ========================================================= --}}

<section class="seccion-ultimas-noticias"
         id="ultimas-noticias">

    <div class="container">

        <div class="seccion-encabezado">

            <span>
                Información institucional
            </span>

            <h2>
                Últimas noticias
            </h2>

            <div class="linea-seccion"></div>

            <p>
                Conocé las novedades, actividades y comunicados
                de nuestra institución.
            </p>

        </div>

        @if($ultimasNoticias->isNotEmpty())

            <div id="carruselUltimasNoticias"
                 class="carousel slide noticias-carousel"
                 data-bs-ride="carousel"
                 data-bs-interval="7000">

                @if($ultimasNoticias->count() > 1)

                    <div class="carousel-indicators">

                        @foreach($ultimasNoticias as $noticia)

                            <button type="button"
                                    data-bs-target="#carruselUltimasNoticias"
                                    data-bs-slide-to="{{ $loop->index }}"
                                    class="{{ $loop->first ? 'active' : '' }}"
                                    aria-current="{{
                                        $loop->first ? 'true' : 'false'
                                    }}"
                                    aria-label="Noticia {{
                                        $loop->iteration
                                    }}">
                            </button>

                        @endforeach

                    </div>

                @endif

                <div class="carousel-inner">

                    @foreach($ultimasNoticias as $noticia)

                        @php
                            $rutaNoticia = $noticia->imagen_portada
                                ?: ($noticia->imagen ?? null);

                            if ($rutaNoticia) {
                                $rutaNoticia = ltrim(
                                    $rutaNoticia,
                                    '/'
                                );

                                if (
                                    Illuminate\Support\Str::startsWith(
                                        $rutaNoticia,
                                        ['http://', 'https://']
                                    )
                                ) {
                                    $imagenNoticia = $rutaNoticia;
                                } elseif (
                                    Illuminate\Support\Str::startsWith(
                                        $rutaNoticia,
                                        'storage/'
                                    )
                                ) {
                                    $imagenNoticia = asset(
                                        $rutaNoticia
                                    );
                                } else {
                                    $imagenNoticia = asset(
                                        'storage/' . $rutaNoticia
                                    );
                                }
                            } else {
                                $imagenNoticia = asset(
                                    'images/noticia-default.jpg'
                                );
                            }
                        @endphp

                        <div class="carousel-item
                            {{ $loop->first ? 'active' : '' }}">

                            <article class="noticia-slide">

                                <div class="row g-0">

                                    <div class="col-lg-6">

                                        <div class="noticia-slide-imagen-contenedor">

                                            <img src="{{ $imagenNoticia }}"
                                                 class="noticia-slide-imagen"
                                                 alt="{{ $noticia->titulo }}"
                                                 onerror="this.onerror=null;
                                                 this.src='{{
                                                    asset(
                                                        'images/noticia-default.jpg'
                                                    )
                                                 }}';">

                                        </div>

                                    </div>

                                    <div class="col-lg-6">

                                        <div class="noticia-slide-contenido">

                                            @if($noticia->tags->isNotEmpty())

                                                <div class="noticia-slide-tags">

                                                    @foreach(
                                                        $noticia->tags->take(3)
                                                        as $tag
                                                    )

                                                        <span class="noticia-slide-tag">
                                                            {{ $tag->nombre }}
                                                        </span>

                                                    @endforeach

                                                </div>

                                            @endif

                                            <div class="noticia-slide-fecha">

                                                <i class="bi bi-calendar3 me-1"></i>

                                                {{ $noticia->fecha_publicacion
                                                    ? $noticia
                                                        ->fecha_publicacion
                                                        ->format('d/m/Y')
                                                    : $noticia
                                                        ->created_at
                                                        ->format('d/m/Y') }}

                                            </div>

                                            <h3 class="noticia-slide-titulo">
                                                {{ $noticia->titulo }}
                                            </h3>

                                            @if($noticia->resumen)

                                                <p class="noticia-slide-resumen">

                                                    {{
                                                        Illuminate\Support\Str::limit(
                                                            $noticia->resumen,
                                                            190
                                                        )
                                                    }}

                                                </p>

                                            @endif

                                            <a href="{{
                                                    route(
                                                        'web.noticia',
                                                        $noticia
                                                    )
                                               }}"
                                               class="boton-leer-noticia">

                                                Leer noticia

                                                <i class="bi bi-arrow-right"></i>
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </article>

                        </div>

                    @endforeach

                </div>

                @if($ultimasNoticias->count() > 1)

                    <button class="carousel-control-prev"
                            type="button"
                            data-bs-target="#carruselUltimasNoticias"
                            data-bs-slide="prev">

                        <span class="carousel-control-prev-icon"
                              aria-hidden="true">
                        </span>

                        <span class="visually-hidden">
                            Anterior
                        </span>
                    </button>

                    <button class="carousel-control-next"
                            type="button"
                            data-bs-target="#carruselUltimasNoticias"
                            data-bs-slide="next">

                        <span class="carousel-control-next-icon"
                              aria-hidden="true">
                        </span>

                        <span class="visually-hidden">
                            Siguiente
                        </span>
                    </button>

                @endif

            </div>

            <div class="text-center">

                <a href="{{ route('web.noticias') }}"
                   class="enlace-todas-noticias">

                    Ver todas las noticias

                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        @else

            <div class="sin-contenido">

                <i class="bi bi-newspaper"></i>

                <h3>
                    Próximamente publicaremos novedades
                </h3>

                <p class="mb-0">
                    Todavía no existen noticias publicadas.
                </p>

            </div>

        @endif

    </div>

</section>

{{-- ========================================================= --}}
{{-- CARRUSEL DE DOCENTES --}}
{{-- ========================================================= --}}

<section class="seccion-docentes" id="docentes">

    <div class="container">

        <div class="seccion-encabezado">

            <span>
                Comunidad educativa
            </span>

            <h2>
                Nuestro personal docente
            </h2>

            <div class="linea-seccion"></div>

            <p>
                Conocé a los profesionales que acompañan la formación
                y el aprendizaje de nuestros estudiantes.
            </p>

        </div>

        @if($docentes->isNotEmpty())

            @php
                $gruposDocentes = $docentes->chunk(5);
            @endphp

            <div id="carruselDocentes"
                 class="carousel slide docentes-carousel"
                 data-bs-ride="carousel"
                 data-bs-interval="8000">

                @if($gruposDocentes->count() > 1)

                    <div class="carousel-indicators">

                        @foreach($gruposDocentes as $grupo)

                            <button type="button"
                                    data-bs-target="#carruselDocentes"
                                    data-bs-slide-to="{{ $loop->index }}"
                                    class="{{ $loop->first ? 'active' : '' }}"
                                    aria-current="{{
                                        $loop->first ? 'true' : 'false'
                                    }}"
                                    aria-label="Grupo {{
                                        $loop->iteration
                                    }}">
                            </button>

                        @endforeach

                    </div>

                @endif

                <div class="carousel-inner">

                    @foreach($gruposDocentes as $grupo)

                        <div class="carousel-item
                            {{ $loop->first ? 'active' : '' }}">

                            <div class="docentes-grid">

                                @foreach($grupo as $docente)

                                    <article class="docente-card">

                                        <div class="docente-foto-contenedor">

                                            @if($docente->foto)

                                                <img src="{{
                                                        asset(
                                                            'storage/'
                                                            . $docente->foto
                                                        )
                                                     }}"
                                                     alt="{{
                                                        $docente->nombre
                                                     }} {{
                                                        $docente->apellido
                                                     }}"
                                                     class="docente-foto">

                                            @else

                                                <div class="docente-sin-foto">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>

                                            @endif

                                        </div>

                                        <h3>
                                            {{ $docente->nombre }}
                                            {{ $docente->apellido }}
                                        </h3>

                                        <span>
                                            Docente
                                        </span>

                                    </article>

                                @endforeach

                            </div>

                        </div>

                    @endforeach

                </div>

                @if($gruposDocentes->count() > 1)

                    <button class="carousel-control-prev"
                            type="button"
                            data-bs-target="#carruselDocentes"
                            data-bs-slide="prev">

                        <span class="carousel-control-prev-icon"
                              aria-hidden="true">
                        </span>

                        <span class="visually-hidden">
                            Anterior
                        </span>
                    </button>

                    <button class="carousel-control-next"
                            type="button"
                            data-bs-target="#carruselDocentes"
                            data-bs-slide="next">

                        <span class="carousel-control-next-icon"
                              aria-hidden="true">
                        </span>

                        <span class="visually-hidden">
                            Siguiente
                        </span>
                    </button>

                @endif

            </div>

        @else

            <div class="sin-contenido">

                <i class="bi bi-people"></i>

                <h3>
                    Personal docente
                </h3>

                <p class="mb-0">
                    Próximamente publicaremos información
                    sobre nuestro equipo docente.
                </p>

            </div>

        @endif

    </div>

</section>

{{-- ========================================================= --}}
{{-- CONTACTO --}}
{{-- ========================================================= --}}

<section class="franja-contacto" id="contacto">

    <div class="container">

        <div class="row align-items-center g-4">

            <div class="col-lg-8">

                <h2>
                    Estamos para acompañar a nuestra comunidad educativa
                </h2>

                <p>
                    Comunicate con la institución para obtener
                    más información.
                </p>

            </div>

            <div class="col-lg-4 text-lg-end">

                @if(!empty($entidad?->whatsapp))

                    <a href="https://wa.me/{{
                            preg_replace(
                                '/[^0-9]/',
                                '',
                                $entidad->whatsapp
                            )
                       }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="btn btn-contacto">

                        <i class="bi bi-whatsapp"></i>

                        Contactar
                    </a>

                @elseif(!empty($entidad?->email))

                    <a href="mailto:{{ $entidad->email }}"
                       class="btn btn-contacto">

                        <i class="bi bi-envelope"></i>

                        Contactar
                    </a>

                @endif

            </div>

        </div>

    </div>

</section>

@endsection
