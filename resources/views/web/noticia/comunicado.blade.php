<article class="noticia-comunicado">
    <header class="noticia-comunicado-cabecera text-start">
        <span class="badge bg-primary mb-3">
            Comunicado institucional
        </span>

        <h1 class="noticia-titulo">
            {{ $noticia->titulo }}
        </h1>

        @include('web.noticia.partials.tags', [
            'clases' => 'mb-3 justify-content-start'
        ])

        @include('web.noticia.partials.meta')
    </header>

    {{-- En COMUNICADO también se muestra la portada cuando existe. --}}
    @if($noticia->imagen_portada)
        <div class="noticia-portada-wrap mb-4">
            <img src="{{ asset('storage/' . $noticia->imagen_portada) }}"
                 class="noticia-portada"
                 alt="{{ $noticia->titulo }}">
        </div>
    @endif

    @include('web.noticia.partials.contenido')

    @include('web.noticia.partials.imagenes-grid', [
        'tituloImagenes' => 'Imágenes adjuntas'
    ])
</article>
