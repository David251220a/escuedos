@if($noticia->imagenes->isNotEmpty())
    <section class="mt-4 mb-2">
        @if(!empty($tituloImagenes))
            <h2 class="h5 mb-3">{{ $tituloImagenes }}</h2>
        @endif

        <div class="row g-4">
            @foreach($noticia->imagenes as $imagen)
                <div class="col-12 col-md-6">
                    <figure class="mb-0">
                        <div class="noticia-imagen-wrap">
                            <img src="{{ asset('storage/' . $imagen->imagen) }}"
                                 class="noticia-grid-imagen"
                                 alt="{{ $imagen->texto_alternativo
                                    ?: $imagen->titulo
                                    ?: $noticia->titulo }}">
                        </div>

                        @if($imagen->titulo)
                            <figcaption class="noticia-imagen-titulo">
                                {{ $imagen->titulo }}
                            </figcaption>
                        @endif
                    </figure>
                </div>
            @endforeach
        </div>
    </section>
@endif
