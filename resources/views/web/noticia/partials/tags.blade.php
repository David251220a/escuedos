@if($noticia->tags->isNotEmpty())
    <div class="d-flex flex-wrap gap-2 {{ $clases ?? 'mb-3' }}">
        @foreach($noticia->tags as $tag)
            <span class="badge rounded-pill"
                  style="background-color: {{ $tag->color ?: '#6c757d' }}">
                {{ $tag->nombre }}
            </span>
        @endforeach
    </div>
@endif
