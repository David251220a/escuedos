<article>
    <header class="noticia-cabecera text-start">
        <h1 class="noticia-titulo">
            {{ $noticia->titulo }}
        </h1>

        @include('web.noticia.partials.tags', [
            'clases' => 'mb-3 justify-content-start'
        ])

        @include('web.noticia.partials.meta')
    </header>

    @php
        $cantidadImagenes = $noticia->imagenes->count() + ($noticia->imagen_portada ? 1 : 0);
    @endphp

    @if($cantidadImagenes > 0)
        <div id="carouselNoticia"
            class="carousel slide noticia-carousel-wrap"
            data-bs-ride="carousel"
            data-bs-interval="10000">

            @if($cantidadImagenes > 1)
                <div class="carousel-indicators">
                    @if($noticia->imagen_portada)
                        <button type="button"
                                data-bs-target="#carouselNoticia"
                                data-bs-slide-to="0"
                                class="active"
                                aria-current="true"
                                aria-label="Imagen de portada">
                        </button>
                    @endif

                    @foreach($noticia->imagenes as $imagen)
                        @php
                            $indice = $loop->index
                                + ($noticia->imagen_portada ? 1 : 0);
                        @endphp

                        <button type="button"
                                data-bs-target="#carouselNoticia"
                                data-bs-slide-to="{{ $indice }}"
                                class="{{ !$noticia->imagen_portada &&
                                    $loop->first ? 'active' : '' }}"
                                aria-current="{{ !$noticia->imagen_portada &&
                                    $loop->first ? 'true' : 'false' }}"
                                aria-label="Imagen {{ $indice + 1 }}">
                        </button>
                    @endforeach
                </div>
            @endif

            <div class="carousel-inner">
                @if($noticia->imagen_portada)
                    <div class="carousel-item active"
                         data-bs-interval="10000">
                        <img src="{{ asset(
                                'storage/' . $noticia->imagen_portada
                             ) }}"
                             class="noticia-carousel-imagen"
                             alt="{{ $noticia->titulo }}">
                    </div>
                @endif

                @foreach($noticia->imagenes as $imagen)
                    <div class="carousel-item
                        {{ !$noticia->imagen_portada && $loop->first
                            ? 'active'
                            : '' }}"
                         data-bs-interval="10000">

                        <img src="{{ asset('storage/' . $imagen->imagen) }}"
                             class="noticia-carousel-imagen"
                             alt="{{ $imagen->texto_alternativo
                                ?: $imagen->titulo
                                ?: $noticia->titulo }}">

                        @if($imagen->titulo)
                            <div class="carousel-caption">
                                <p class="noticia-carousel-titulo">
                                    {{ $imagen->titulo }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            @if($cantidadImagenes > 1)
                <button class="carousel-control-prev"
                        type="button"
                        data-bs-target="#carouselNoticia"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>

                <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#carouselNoticia"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            @endif
        </div>
    @endif

    @include('web.noticia.partials.contenido')
</article>
