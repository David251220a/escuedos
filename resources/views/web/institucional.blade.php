@extends('layouts.www')

@section('title', 'Institucional - ' . ($entidad->nombre ?? 'Escuela'))

@section('content')

{{-- Portada institucional --}}
<section class="institucional-portada">
    <div class="institucional-circulo circulo-uno"></div>
    <div class="institucional-circulo circulo-dos"></div>

    <div class="container position-relative">
        <div class="institucional-portada-contenido">

            <span class="institucional-etiqueta">
                Nuestra institución
            </span>

            <h1>Conocé quiénes somos</h1>

            <p>
                Nuestra identidad, propósito y compromiso con la formación
                de toda la comunidad educativa.
            </p>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb institucional-breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">
                            Inicio
                        </a>
                    </li>

                    <li
                        class="breadcrumb-item active"
                        aria-current="page"
                    >
                        Institucional
                    </li>
                </ol>
            </nav>

        </div>
    </div>
</section>

{{-- Contenido institucional --}}
<section class="institucional-contenido">
    <div class="container">

        {{-- Presentación --}}
        <div class="institucional-presentacion">

            <div class="institucional-icono-principal">
                <i class="bi bi-mortarboard-fill"></i>
            </div>

            <span class="institucional-subtitulo">
                {{ $entidad->nombre ?? 'Nombre de la Escuela' }}
            </span>

            <h2>
                {{ $entidad->lema ?? 'Educando para construir un futuro mejor' }}
            </h2>

            <div class="institucional-linea"></div>

            <p>
                {{ $entidad->descripcion
                    ?? 'Institución educativa comprometida con la formación integral de sus estudiantes, promoviendo el conocimiento, los valores y la participación de toda la comunidad educativa.' }}
            </p>

        </div>

        {{-- Misión y visión --}}
        <div class="row g-4 institucional-tarjetas">

            {{-- Misión --}}
            <div class="col-lg-6">
                <article class="institucional-card">

                    <span class="institucional-numero">
                        01
                    </span>

                    <div class="institucional-card-icono">
                        <i class="bi bi-bullseye"></i>
                    </div>

                    <div class="institucional-card-contenido">

                        <span>Nuestro propósito</span>

                        <h3>Misión</h3>

                        <p>
                            {{ $entidad->mision
                                ?? 'La misión institucional será publicada próximamente.' }}
                        </p>

                    </div>

                </article>
            </div>

            {{-- Visión --}}
            <div class="col-lg-6">
                <article class="institucional-card">

                    <span class="institucional-numero">
                        02
                    </span>

                    <div class="institucional-card-icono">
                        <i class="bi bi-eye-fill"></i>
                    </div>

                    <div class="institucional-card-contenido">

                        <span>Mirando al futuro</span>

                        <h3>Visión</h3>

                        <p>
                            {{ $entidad->vision
                                ?? 'La visión institucional será publicada próximamente.' }}
                        </p>

                    </div>

                </article>
            </div>

        </div>

    </div>
</section>

{{-- Franja final --}}
<section class="institucional-final">
    <div class="container">

        <div class="row align-items-center g-4">

            <div class="col-lg-8">

                <span>Comunidad educativa</span>

                <h2>
                    Educación, valores y compromiso
                </h2>

                <p>
                    Acompañamos el crecimiento académico y personal
                    de nuestros estudiantes.
                </p>

            </div>

            <div class="col-lg-4 text-lg-end">

                <a
                    href="{{ url('/') }}"
                    class="institucional-boton"
                >
                    <i class="bi bi-arrow-left"></i>
                    Volver al inicio
                </a>

            </div>

        </div>

    </div>
</section>

@endsection
