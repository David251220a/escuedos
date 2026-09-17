<article>
    <header class="noticia-cabecera text-start">
        <h1 class="noticia-titulo">
            {{ $noticia->titulo }}
        </h1>

        {{-- En NORMAL, los tags van inmediatamente debajo del título. --}}
        @include('web.noticia.partials.tags', [
            'clases' => 'mb-3 justify-content-start'
        ])

        @include('web.noticia.partials.meta')
    </header>

    @if($noticia->imagen_portada)
        <div class="noticia-portada-wrap mb-4">
            <img src="{{ asset('storage/' . $noticia->imagen_portada) }}"
                 class="noticia-portada"
                 alt="{{ $noticia->titulo }}">
        </div>
    @endif

    @include('web.noticia.partials.contenido')

    @include('web.noticia.partials.imagenes-grid', [
        'tituloImagenes' => 'Imágenes de la noticia'
    ])
</article>
