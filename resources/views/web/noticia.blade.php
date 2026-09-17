@extends('layouts.www')

@section('title', $noticia->titulo)

@section('styles')
<style>
    .noticia-show {
        padding: 45px 0 60px;
        background: #f8fafc;
    }

    .noticia-contenedor {
        width: 100%;
        max-width: 1120px;
        margin: 0 auto;
    }

    .noticia-cabecera {
        max-width: 900px;
        margin-bottom: 28px;
    }

    .noticia-titulo {
        margin-bottom: 14px;
        color: #172033;
        font-size: clamp(2rem, 4vw, 3.35rem);
        font-weight: 800;
        line-height: 1.12;
    }

    .noticia-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
        color: #667085;
        font-size: .92rem;
    }

    .noticia-resumen {
        margin-bottom: 22px;
        color: #344054;
        font-size: 1.16rem;
        font-weight: 500;
        line-height: 1.7;
    }

    .noticia-texto {
        padding: clamp(24px, 4vw, 48px);
        color: #344054;
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 18px;
        box-shadow: 0 8px 26px rgba(16, 24, 40, .06);
        font-size: 1.02rem;
        line-height: 1.9;
        overflow-wrap: anywhere;
    }

    .noticia-portada-wrap,
    .noticia-imagen-wrap,
    .noticia-carousel-wrap {
        overflow: hidden;
        background: #e9eef5;
        border-radius: 18px;
    }

    .noticia-portada {
        display: block;
        width: 100%;
        height: clamp(280px, 45vw, 520px);
        object-fit: cover;
    }

    .noticia-grid-imagen {
        display: block;
        width: 100%;
        height: 260px;
        object-fit: cover;
        transition: transform .25s ease;
    }

    .noticia-imagen-wrap:hover .noticia-grid-imagen {
        transform: scale(1.025);
    }

    .noticia-imagen-titulo {
        margin: 9px 2px 0;
        color: #667085;
        font-size: .88rem;
    }

    .noticia-hero {
        position: relative;
        display: flex;
        align-items: flex-end;
        min-height: 540px;
        margin-bottom: 35px;
        overflow: hidden;
        color: #fff;
        background-color: #0b3b68;
        background-position: center;
        background-size: cover;
        border-radius: 24px;
        box-shadow: 0 18px 42px rgba(16, 24, 40, .18);
    }

    .noticia-hero::before {
        position: absolute;
        inset: 0;
        content: "";
        background: linear-gradient(
            180deg,
            rgba(4, 20, 38, .08) 18%,
            rgba(4, 20, 38, .86) 100%
        );
    }

    .noticia-hero-sin-portada {
        background: linear-gradient(135deg, #0b3b68, #168bd2);
    }

    .noticia-hero-contenido {
        position: relative;
        z-index: 1;
        width: 100%;
        padding: clamp(28px, 6vw, 65px);
    }

    .noticia-hero .noticia-titulo {
        max-width: 900px;
        margin-bottom: 16px;
        color: #fff;
        font-size: clamp(2.2rem, 5vw, 4.4rem);
    }

    .noticia-hero .noticia-meta {
        color: rgba(255, 255, 255, .88);
    }

    .noticia-carousel-wrap {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto 35px;
        overflow: hidden;
        background-color: #0b1f33;
        border-radius: 20px;
        box-shadow: 0 18px 40px rgba(16, 24, 40, .20);
    }

    .noticia-carousel-wrap .carousel-inner {
        width: 100%;
        height: 520px;
    }

    .noticia-carousel-wrap .carousel-item {
        width: 100%;
        height: 520px;
    }

    .noticia-carousel-imagen {
        display: block;
        width: 100% !important;
        height: 520px !important;
        object-fit: cover;
        object-position: center;
    }

    .noticia-carousel-wrap .carousel-control-prev,
    .noticia-carousel-wrap .carousel-control-next {
        width: 9%;
    }

    .noticia-carousel-wrap .carousel-control-prev-icon,
    .noticia-carousel-wrap .carousel-control-next-icon {
        width: 42px;
        height: 42px;
        padding: 10px;
        background-color: rgba(0, 0, 0, .55);
        background-size: 55%;
        border-radius: 50%;
    }

    .noticia-carousel-wrap .carousel-indicators {
        margin-bottom: 15px;
    }

    .noticia-carousel-wrap .carousel-indicators button {
        width: 9px;
        height: 9px;
        margin: 0 5px;
        border: 0;
        border-radius: 50%;
    }

    .noticia-carousel-wrap .carousel-caption {
        right: 8%;
        bottom: 25px;
        left: 8%;
    }

    .noticia-carousel-titulo {
        display: inline-block;
        margin: 0;
        padding: 9px 16px;
        color: #fff;
        background-color: rgba(0, 0, 0, .68);
        border-radius: 8px;
    }

    @media (max-width: 767.98px) {
        .noticia-carousel-wrap .carousel-inner,
        .noticia-carousel-wrap .carousel-item,
        .noticia-carousel-imagen {
            height: 320px !important;
        }
    }

    @media (max-width: 480px) {
        .noticia-carousel-wrap .carousel-inner,
        .noticia-carousel-wrap .carousel-item,
        .noticia-carousel-imagen {
            height: 260px !important;
        }
    }

    .noticia-comunicado {
        max-width: 920px;
        margin: 0 auto;
        padding: clamp(24px, 5vw, 52px);
        background: #fff;
        border-top: 6px solid #168bd2;
        border-radius: 14px;
        box-shadow: 0 14px 38px rgba(16, 24, 40, .1);
    }

    .noticia-comunicado-cabecera {
        padding-bottom: 22px;
        margin-bottom: 26px;
        border-bottom: 1px solid #e4e7ec;
    }

    .noticia-comunicado .noticia-texto {
        padding: 0;
        border: 0;
        border-radius: 0;
        box-shadow: none;
    }

    @media (max-width: 767.98px) {
        .noticia-show {
            padding: 28px 0 40px;
        }

        .noticia-portada {
            height: 300px;
        }

        .noticia-grid-imagen {
            height: 220px;
        }

        .noticia-carousel-imagen {
            height: 310px;
        }

        .noticia-hero {
            min-height: 390px;
            border-radius: 16px;
        }
    }

    @media (max-width: 480px) {
        .noticia-portada,
        .noticia-carousel-imagen {
            height: 260px;
        }

        .noticia-grid-imagen {
            height: 200px;
        }
    }
</style>
@endsection

@section('content')
<section class="noticia-show">
    <div class="container">
        <div class="noticia-contenedor">

            <div class="mb-4">
                <a href="{{ route('web.noticias') }}"
                   class="btn btn-outline-secondary btn-sm">
                    &larr; Volver a noticias
                </a>
            </div>

            @auth
                @if($noticia->estado !== 'PUBLICADA')
                    <div class="alert alert-warning">
                        Vista previa: esta noticia se encuentra en estado
                        <strong>{{ $noticia->estado }}</strong>.
                    </div>
                @endif
            @endauth

            @switch($noticia->tipo_presentacion)
                @case('DESTACADA')
                    @include('web.noticia.destacada')
                    @break

                @case('CARRUSEL')
                    @include('web.noticia.carrusel')
                    @break

                @case('GALERIA')
                    @include('web.noticia.galeria')
                    @break

                @case('COMUNICADO')
                    @include('web.noticia.comunicado')
                    @break

                @default
                    @include('web.noticia.normal')
            @endswitch

        </div>
    </div>
</section>

<script>
    window.addEventListener('load', function () {
        const elemento = document.getElementById('carouselNoticia');

        if (elemento && window.bootstrap) {
            bootstrap.Carousel.getOrCreateInstance(elemento, {
                interval: 10000,
                ride: 'carousel',
                pause: 'hover',
                wrap: true
            });
        }
    });
</script>
@endsection
