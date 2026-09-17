@extends('layouts.admin')

@section('title', 'Nuevo docente')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex flex-wrap align-items-center
                justify-content-between gap-3 mb-4">

        <div>
            <h2 class="mb-1">
                Nuevo docente
            </h2>

            <p class="text-muted mb-0">
                Complete los datos del personal docente.
            </p>
        </div>

        <a href="{{ route('docente.index') }}"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left me-1"></i>

            Volver
        </a>

    </div>

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Verifique los datos ingresados:
            </strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif

    <form action="{{ route('docente.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @include('docente.partials.form')

        <div class="d-flex justify-content-end gap-2 mt-4">

            <a href="{{ route('docente.index') }}"
               class="btn btn-outline-secondary">

                Cancelar
            </a>

            <button type="submit"
                    class="btn btn-primary">

                <i class="bi bi-save me-1"></i>

                Registrar docente
            </button>

        </div>

    </form>

</div>

@endsection
