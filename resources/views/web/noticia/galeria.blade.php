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

    {{-- La portada se presenta grande y separada de la galería. --}}
    @if($noticia->imagen_portada)
        <div class="noticia-portada-wrap mb-4">
            <img src="{{ asset('storage/' . $noticia->imagen_portada) }}"
                 class="noticia-portada"
                 alt="{{ $noticia->titulo }}">
        </div>
    @endif

    @include('web.noticia.partials.contenido')

    {{-- g-4 separa correctamente todas las imágenes adicionales. --}}
    @include('web.noticia.partials.imagenes-grid', [
        'tituloImagenes' => 'Galería de imágenes'
    ])
</article>
