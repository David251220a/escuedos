<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', $entidad->nombre ?? 'Sistema Escolar')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <link
        href="{{ asset('css/principal.css') }}"
        rel="stylesheet"
    >

    @stack('styles')
</head>

<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light menu-principal sticky-top">
        <div class="container">

            {{-- Logo y nombre de la institución --}}
            <a
                class="navbar-brand d-flex align-items-center gap-3"
                href="{{ url('/') }}"
            >
                @if(!empty($entidad?->logo))
                    <img
                        src="{{ asset('storage/' . $entidad->logo) }}"
                        alt="{{ $entidad->nombre }}"
                        class="logo-escuela"
                    >
                @else
                    <div class="logo-alternativo">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                @endif

                <div class="nombre-institucion">
                    <strong>
                        {{ $entidad->nombre ?? 'Nombre de la Escuela' }}
                    </strong>

                    @if(!empty($entidad?->lema))
                        <small>
                            {{ $entidad->lema }}
                        </small>
                    @endif
                </div>
            </a>

            {{-- Botón del menú móvil --}}
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menuPublico"
                aria-controls="menuPublico"
                aria-expanded="false"
                aria-label="Abrir menú"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Opciones del menú --}}
            <div
                class="collapse navbar-collapse"
                id="menuPublico"
            >
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ url('/') }}"
                        >
                            Inicio
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ url('/institucional') }}"
                        >
                            Institucional
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ url('/#noticias') }}"
                        >
                            Noticias
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ url('/#docentes') }}"
                        >
                            Docentes
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ url('/#contacto') }}"
                        >
                            Contacto
                        </a>
                    </li>

                    <li class="nav-item ms-lg-3">
                        @auth
                            <a
                                class="btn btn-acceso"
                                href="{{ url('/home') }}"
                            >
                                <i class="bi bi-speedometer2"></i>
                                Panel
                            </a>
                        @else
                            <a
                                class="btn btn-acceso"
                                href="{{ route('login') }}"
                            >
                                <i class="bi bi-person-circle"></i>
                                Ingresar
                            </a>
                        @endauth
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer
    class="pie-pagina"
    id="contacto"
>
    <div class="container">
        <div class="row g-4">

            {{-- Información institucional --}}
            <div class="col-lg-5">
                <div class="d-flex align-items-center gap-3 mb-3">
                    @if(!empty($entidad?->logo))
                        <img
                            src="{{ asset('storage/' . $entidad->logo) }}"
                            alt="{{ $entidad->nombre }}"
                            class="logo-footer"
                        >
                    @else
                        <div class="logo-alternativo">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                    @endif

                    <h5 class="mb-0">
                        {{ $entidad->nombre ?? 'Nombre de la Escuela' }}
                    </h5>
                </div>

                <p>
                    {{ $entidad->descripcion ?? 'Institución educativa comprometida con la formación integral de sus estudiantes.' }}
                </p>
            </div>

            {{-- Enlaces --}}
            <div class="col-md-6 col-lg-3">
                <h5>Enlaces</h5>

                <ul class="lista-footer">
                    <li>
                        <a href="{{ route('web.index') }}">
                            Inicio
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('web.institucional') }}">
                            Institucional
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('web.noticias') }}">
                            Noticias
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('web.docentes') }}">
                            Docentes
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('login') }}">
                            Acceso al sistema
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contacto --}}
            <div class="col-md-6 col-lg-4">
                <h5>Contacto</h5>

                @if(!empty($entidad?->direccion))
                    <p>
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        {{ $entidad->direccion }}
                    </p>
                @endif

                @if(!empty($entidad?->email))
                    <p>
                        <i class="bi bi-envelope-fill me-2"></i>

                        <a href="mailto:{{ $entidad->email }}">
                            {{ $entidad->email }}
                        </a>
                    </p>
                @endif

                @if(!empty($entidad?->celular))
                    <p>
                        <i class="bi bi-telephone-fill me-2"></i>
                        {{ $entidad->celular }}
                    </p>
                @endif

                {{-- Redes sociales --}}
                <div class="redes-footer mt-3">
                    @if(!empty($entidad?->facebook))
                        <a
                            href="{{ $entidad->facebook }}"
                            target="_blank"
                            rel="noopener"
                            aria-label="Facebook"
                        >
                            <i class="bi bi-facebook"></i>
                        </a>
                    @endif

                    @if(!empty($entidad?->instagram))
                        <a
                            href="{{ $entidad->instagram }}"
                            target="_blank"
                            rel="noopener"
                            aria-label="Instagram"
                        >
                            <i class="bi bi-instagram"></i>
                        </a>
                    @endif

                    @if(!empty($entidad?->x_url))
                        <a
                            href="{{ $entidad->x_url }}"
                            target="_blank"
                            rel="noopener"
                            aria-label="X"
                        >
                            <i class="bi bi-twitter-x"></i>
                        </a>
                    @endif

                    @if(!empty($entidad?->youtube))
                        <a
                            href="{{ $entidad->youtube }}"
                            target="_blank"
                            rel="noopener"
                            aria-label="YouTube"
                        >
                            <i class="bi bi-youtube"></i>
                        </a>
                    @endif
                </div>
            </div>

        </div>

        <div class="linea-footer"></div>

        <div class="text-center">
            © {{ date('Y') }}
            {{ $entidad->nombre ?? 'Nombre de la Escuela' }}.
            Todos los derechos reservados.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>
