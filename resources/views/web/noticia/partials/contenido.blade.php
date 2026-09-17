@if($noticia->resumen)
    <div class="noticia-resumen">
        {{ $noticia->resumen }}
    </div>
@endif

<div class="noticia-texto">
    {!! nl2br(e($noticia->contenido)) !!}
</div>
