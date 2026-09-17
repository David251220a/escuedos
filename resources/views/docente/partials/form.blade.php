<div class="row g-4">

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white py-3">
                <h5 class="mb-0">
                    Datos del docente
                </h5>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-4">

                        <label for="documento"
                               class="form-label">

                            Documento
                        </label>

                        <input type="text"
                               name="documento"
                               id="documento"
                               value="{{
                                    old(
                                        'documento',
                                        $docente->documento
                                    )
                               }}"
                               maxlength="30"
                               class="form-control
                               @error('documento') is-invalid @enderror">

                        @error('documento')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-4">

                        <label for="nombre"
                               class="form-label">

                            Nombre
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="nombre"
                               id="nombre"
                               value="{{
                                    old(
                                        'nombre',
                                        $docente->nombre
                                    )
                               }}"
                               maxlength="255"
                               required
                               class="form-control
                               @error('nombre') is-invalid @enderror">

                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-4">

                        <label for="apellido"
                               class="form-label">

                            Apellido
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="apellido"
                               id="apellido"
                               value="{{
                                    old(
                                        'apellido',
                                        $docente->apellido
                                    )
                               }}"
                               maxlength="255"
                               required
                               class="form-control
                               @error('apellido') is-invalid @enderror">

                        @error('apellido')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-4">

                        <label for="fecha_nacimiento"
                               class="form-label">

                            Fecha de nacimiento
                        </label>

                        <input type="date"
                               name="fecha_nacimiento"
                               id="fecha_nacimiento"
                               value="{{
                                    old(
                                        'fecha_nacimiento',
                                        optional(
                                            $docente->fecha_nacimiento
                                        )->format('Y-m-d')
                                    )
                               }}"
                               class="form-control
                               @error('fecha_nacimiento')
                                   is-invalid
                               @enderror">

                        @error('fecha_nacimiento')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-4">

                        <label for="fecha_ingreso"
                               class="form-label">

                            Fecha de ingreso
                        </label>

                        <input type="date"
                               name="fecha_ingreso"
                               id="fecha_ingreso"
                               value="{{
                                    old(
                                        'fecha_ingreso',
                                        optional(
                                            $docente->fecha_ingreso
                                        )->format('Y-m-d')
                                    )
                               }}"
                               class="form-control
                               @error('fecha_ingreso')
                                   is-invalid
                               @enderror">

                        @error('fecha_ingreso')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-4">

                        <label for="orden"
                               class="form-label">

                            Orden
                            <span class="text-danger">*</span>
                        </label>

                        <input type="number"
                               name="orden"
                               id="orden"
                               value="{{
                                    old(
                                        'orden',
                                        $docente->orden ?? 0
                                    )
                               }}"
                               min="0"
                               max="9999"
                               required
                               class="form-control
                               @error('orden') is-invalid @enderror">

                        @error('orden')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label for="email"
                               class="form-label">

                            Correo electrónico
                        </label>

                        <input type="email"
                               name="email"
                               id="email"
                               value="{{
                                    old(
                                        'email',
                                        $docente->email
                                    )
                               }}"
                               maxlength="255"
                               class="form-control
                               @error('email') is-invalid @enderror">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label for="celular"
                               class="form-label">

                            Celular
                        </label>

                        <input type="text"
                               name="celular"
                               id="celular"
                               value="{{
                                    old(
                                        'celular',
                                        $docente->celular
                                    )
                               }}"
                               maxlength="30"
                               class="form-control
                               @error('celular') is-invalid @enderror">

                        @error('celular')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-12">

                        <label for="direccion"
                               class="form-label">

                            Dirección
                        </label>

                        <input type="text"
                               name="direccion"
                               id="direccion"
                               value="{{
                                    old(
                                        'direccion',
                                        $docente->direccion
                                    )
                               }}"
                               maxlength="255"
                               class="form-control
                               @error('direccion') is-invalid @enderror">

                        @error('direccion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-12">

                        <label for="user_id"
                               class="form-label">

                            Usuario vinculado
                        </label>

                        <select name="user_id"
                                id="user_id"
                                class="form-select
                                @error('user_id') is-invalid @enderror">

                            <option value="">
                                Sin usuario vinculado
                            </option>

                            @foreach($usuarios as $usuario)

                                <option value="{{ $usuario->id }}"
                                    @selected(
                                        (string) old(
                                            'user_id',
                                            $docente->user_id
                                        ) === (string) $usuario->id
                                    )>

                                    {{ $usuario->name }}
                                    {{ $usuario->lastname }}
                                    — {{ $usuario->username }}

                                </option>

                            @endforeach

                        </select>

                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="text-muted">
                            Es opcional. Permite relacionar al docente
                            con un usuario del sistema.
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white py-3">
                <h5 class="mb-0">
                    Fotografía
                </h5>
            </div>

            <div class="card-body text-center">

                <div class="mb-3">

                    <img id="vistaPreviaFoto"
                         src="{{
                            $docente->foto
                                ? asset(
                                    'storage/' . $docente->foto
                                )
                                : ''
                         }}"
                         alt="Vista previa"
                         class="rounded-circle border
                                object-fit-cover
                                {{ $docente->foto ? '' : 'd-none' }}"
                         style="width: 170px;
                                height: 170px;
                                object-position: center top;">

                    <div id="fotoVacia"
                         class="rounded-circle bg-light
                                text-primary mx-auto
                                d-flex align-items-center
                                justify-content-center
                                {{ $docente->foto ? 'd-none' : '' }}"
                         style="width: 170px;
                                height: 170px;
                                font-size: 4rem;">

                        <i class="bi bi-person-fill"></i>
                    </div>

                </div>

                <input type="file"
                       name="foto"
                       id="foto"
                       accept=".jpg,.jpeg,.png,.webp"
                       class="form-control
                       @error('foto') is-invalid @enderror">

                @error('foto')
                    <div class="invalid-feedback text-start">
                        {{ $message }}
                    </div>
                @enderror

                <small class="text-muted d-block mt-2">
                    JPG, PNG o WEBP. Máximo 5 MB.
                </small>

                @if($docente->exists && $docente->foto)

                    <div class="form-check text-start mt-3">

                        <input type="checkbox"
                               name="eliminar_foto"
                               value="1"
                               id="eliminar_foto"
                               class="form-check-input">

                        <label for="eliminar_foto"
                               class="form-check-label text-danger">

                            Eliminar fotografía actual
                        </label>

                    </div>

                @endif

            </div>

        </div>

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white py-3">
                <h5 class="mb-0">
                    Visualización
                </h5>
            </div>

            <div class="card-body">

                <div class="form-check form-switch">

                    <input type="checkbox"
                           name="mostrar_principal"
                           id="mostrar_principal"
                           value="1"
                           class="form-check-input"
                           @checked(
                                old(
                                    'mostrar_principal',
                                    $docente->mostrar_principal
                                )
                           )>

                    <label for="mostrar_principal"
                           class="form-check-label">

                        Mostrar en la página principal
                    </label>

                </div>

                <small class="text-muted d-block mt-2">
                    Si está habilitado, aparecerá en el carrusel
                    de docentes del sitio web.
                </small>

            </div>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputFoto = document.getElementById('foto');
        const vistaPrevia = document.getElementById('vistaPreviaFoto');
        const fotoVacia = document.getElementById('fotoVacia');

        inputFoto.addEventListener('change', function (event) {
            const archivo = event.target.files[0];

            if (!archivo) {
                return;
            }

            vistaPrevia.src = URL.createObjectURL(archivo);
            vistaPrevia.classList.remove('d-none');
            fotoVacia.classList.add('d-none');
        });
    });
</script>
