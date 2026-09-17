@extends('layouts.admin')

@section('title', 'Docentes')

@section('styles')
<style>
    .foto-listado {
        width: 52px;
        height: 52px;
        overflow: hidden;
        background: #edf2f7;
        border-radius: 50%;
    }

    .foto-listado img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
    }

    .foto-vacia {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        color: #168bd2;
        font-size: 1.5rem;
    }

    .nombre-docente {
        color: #172033;
        font-weight: 700;
    }
</style>
@endsection

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex flex-wrap align-items-center
                justify-content-between gap-3 mb-4">

        <div>
            <h2 class="mb-1">
                Docentes
            </h2>

            <p class="text-muted mb-0">
                Administración del personal docente.
            </p>
        </div>

        <a href="{{ route('docente.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle me-1"></i>

            Nuevo docente
        </a>

    </div>

    @if(session('message'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('message') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form action="{{ route('docente.index') }}"
                  method="GET">

                <div class="row g-3 align-items-end">

                    <div class="col-md-7">

                        <label for="buscar"
                               class="form-label">

                            Buscar docente
                        </label>

                        <input type="text"
                               name="buscar"
                               id="buscar"
                               value="{{ $buscar }}"
                               class="form-control"
                               placeholder="Documento, nombre, apellido o correo">

                    </div>

                    <div class="col-md-3">

                        <label for="mostrar_principal"
                               class="form-label">

                            Página principal
                        </label>

                        <select name="mostrar_principal"
                                id="mostrar_principal"
                                class="form-select form-control">

                            <option value="">
                                Todos
                            </option>

                            <option value="1"
                                @selected((string) $mostrarPrincipal === '1')>

                                Mostrar en principal
                            </option>

                            <option value="0"
                                @selected((string) $mostrarPrincipal === '0')>

                                No mostrar
                            </option>

                        </select>

                    </div>

                    <div class="col-md-2">

                        <div class="d-grid">

                            <button type="submit"
                                    class="btn btn-secondary">

                                <i class="bi bi-search me-1"></i>

                                Buscar
                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>
                            <th class="text-center">
                                Foto
                            </th>

                            <th>
                                Docente
                            </th>

                            <th>
                                Documento
                            </th>

                            <th>
                                Contacto
                            </th>

                            <th class="text-center">
                                Principal
                            </th>

                            <th class="text-center">
                                Orden
                            </th>

                            <th class="text-center">
                                Acciones
                            </th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($data as $docente)

                            <tr>

                                <td class="text-center">

                                    <div class="foto-listado mx-auto">

                                        @if($docente->foto)

                                            <img src="{{
                                                    asset(
                                                        'storage/'
                                                        . $docente->foto
                                                    )
                                                 }}"
                                                 alt="{{
                                                    $docente->nombre
                                                 }}">

                                        @else

                                            <div class="foto-vacia">
                                                <i class="bi bi-person-fill"></i>
                                            </div>

                                        @endif

                                    </div>

                                </td>

                                <td>

                                    <div class="nombre-docente">
                                        {{ $docente->apellido }},
                                        {{ $docente->nombre }}
                                    </div>

                                    @if($docente->user)

                                        <small class="text-muted">
                                            Usuario:
                                            {{ $docente->user->username }}
                                        </small>

                                    @endif

                                </td>

                                <td>
                                    {{ $docente->documento ?: 'Sin documento' }}
                                </td>

                                <td>

                                    @if($docente->email)
                                        <div>
                                            <i class="bi bi-envelope me-1"></i>
                                            {{ $docente->email }}
                                        </div>
                                    @endif

                                    @if($docente->celular)
                                        <small class="text-muted">
                                            <i class="bi bi-phone me-1"></i>
                                            {{ $docente->celular }}
                                        </small>
                                    @endif

                                    @if(!$docente->email && !$docente->celular)
                                        <span class="text-muted">
                                            Sin contacto
                                        </span>
                                    @endif

                                </td>

                                <td class="text-center">

                                    @if($docente->mostrar_principal)

                                        <span class="badge bg-success">
                                            Sí
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            No
                                        </span>

                                    @endif

                                </td>

                                <td class="text-center">
                                    {{ $docente->orden }}
                                </td>

                                <td class="text-center">

                                    <div class="d-inline-flex gap-1">

                                        <a href="{{
                                                route(
                                                    'docente.edit',
                                                    $docente
                                                )
                                           }}"
                                           class="btn btn-sm btn-warning"
                                           title="Editar">

                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{
                                                route(
                                                    'docente.destroy',
                                                    $docente
                                                )
                                              }}"
                                              method="POST"
                                              onsubmit="return confirm(
                                                '¿Desea eliminar este docente?'
                                              )">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    title="Eliminar">

                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center py-5">

                                    <i class="bi bi-people
                                              fs-1 text-muted"></i>

                                    <p class="text-muted mt-2 mb-0">
                                        No se encontraron docentes.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        @if($data->hasPages())

            <div class="card-footer bg-white">
                {{ $data->links() }}
            </div>

        @endif

    </div>

</div>

@endsection
