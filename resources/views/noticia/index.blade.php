@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Noticias</h4>
            <p class="text-muted mb-0">
                Listado de noticias registradas.
            </p>
        </div>

        <a href="{{ route('noticia.create') }}"
           class="btn btn-primary">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="18"
                 height="18"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 class="me-1">

                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>

            Nueva noticia
        </a>
    </div>

    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar">
            </button>
        </div>
    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 80px;">N.º</th>
                            <th>Título</th>
                            <th style="width: 150px;">Fecha</th>
                            <th style="width: 120px;">Estado</th>
                            <th style="width: 100px;" class="text-center">
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $noticia)
                            <tr>
                                <td>
                                    {{ $data->firstItem() + $loop->index }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $noticia->titulo }}
                                </td>

                                <td>
                                    {{ $noticia->created_at ? $noticia->created_at->format('d/m/Y') : 'Sin fecha' }}
                                </td>

                                <td>
                                    @if($noticia->activo)
                                        <span class="badge bg-success">
                                            Activo
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="btn-group">

                                        {{-- Ver --}}
                                        <a href="{{ route('web.noticia', $noticia) }}"
                                        class="btn btn-sm btn-info text-white"
                                        title="Ver noticia"
                                        target="_blank">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round">

                                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a>

                                        {{-- Editar --}}
                                        <a href="{{ route('noticia.edit', $noticia) }}"
                                        class="btn btn-sm btn-warning"
                                        title="Editar noticia">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round">

                                                <path d="M12 20h9"></path>
                                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"></path>
                                            </svg>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="text-center text-muted py-4">
                                    No existen noticias registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @if($data->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $data->links() }}
        </div>
    @endif

</div>

@endsection
