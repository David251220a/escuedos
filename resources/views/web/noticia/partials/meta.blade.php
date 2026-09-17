<div class="noticia-meta {{ $clasesMeta ?? '' }}">
    @if($noticia->fecha_publicacion)
        <span>
            {{ $noticia->fecha_publicacion
                ->translatedFormat('d \d\e F \d\e Y') }}
        </span>
    @endif

    @if($noticia->fecha_evento)
        <span aria-hidden="true">•</span>
        <span>
            Evento: {{ $noticia->fecha_evento->format('d/m/Y') }}
        </span>
    @endif
 </div>
