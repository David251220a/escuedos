<article>
    <header class="noticia-hero {{ !$noticia->imagen_portada
        ? 'noticia-hero-sin-portada'
        : '' }}"
        @if($noticia->imagen_portada)
            style="background-image: url('{{ asset(
                'storage/' . $noticia->imagen_portada
            ) }}');"
        @endif>

        <div class="noticia-hero-contenido">
            @include('web.noticia.partials.tags', [
                'clases' => 'mb-3 justify-content-start'
            ])

            <h1 class="noticia-titulo">
                {{ $noticia->titulo }}
            </h1>

            @include('web.noticia.partials.meta', [
                'clasesMeta' => 'text-white'
            ])
        </div>
    </header>

    @include('web.noticia.partials.contenido')

    @include('web.noticia.partials.imagenes-grid', [
        'tituloImagenes' => 'Imágenes de la noticia'
    ])
</article>
