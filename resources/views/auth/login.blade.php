<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Iniciar sesión | {{ $entidad->nombre ?? 'Sistema Escolar' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <main class="login-page">
        <section class="login-panel login-left" aria-label="Información institucional">
            <div class="decor decor-one"></div>
            <div class="decor decor-two"></div>

            <div class="institution">
                <div class="brand-logo">
                    @if (!empty($entidad?->logo))
                        <img src="{{ asset($entidad->logo) }}"
                             alt="Logo de {{ $entidad->nombre ?? 'la institución' }}">
                    @else
                        <svg viewBox="0 0 64 64" role="img" aria-label="Logo escolar">
                            <path d="M32 7 5 21l27 14 22-11.4V43h5V21L32 7Z" fill="currentColor"/>
                            <path d="M16 31v13c6 8 26 8 32 0V31l-16 8-16-8Z" fill="currentColor" opacity=".82"/>
                        </svg>
                    @endif
                </div>

                <p class="eyebrow">Plataforma educativa</p>
                <h1>{{ $entidad->nombre ?? 'Sistema Escolar' }}</h1>
                <p class="institution-message">
                    {{ $entidad->lema ?? 'Gestión académica simple, organizada y segura.' }}
                </p>
            </div>

            <div class="welcome-copy">
                <h2>Bienvenido de nuevo</h2>
                <p>Acceda al sistema para consultar y administrar la información académica.</p>
            </div>

            <p class="copyright">
                &copy; {{ date('Y') }} {{ $entidad->nombre ?? 'Sistema Escolar' }}
            </p>
        </section>

        <section class="login-panel login-right">
            <div class="mobile-brand">
                <div class="mobile-logo">
                    @if (!empty($entidad?->logo))
                        <img src="{{ asset($entidad->logo) }}" alt="Logo institucional">
                    @else
                        <svg viewBox="0 0 64 64" aria-hidden="true">
                            <path d="M32 7 5 21l27 14 22-11.4V43h5V21L32 7Z" fill="currentColor"/>
                            <path d="M16 31v13c6 8 26 8 32 0V31l-16 8-16-8Z" fill="currentColor" opacity=".82"/>
                        </svg>
                    @endif
                </div>
                <span>{{ $entidad->nombre ?? 'Sistema Escolar' }}</span>
            </div>

            <div class="login-box">
                <div class="login-heading">
                    <span class="section-label">Acceso al sistema</span>
                    <h2>Iniciar sesión</h2>
                    <p>Ingrese sus credenciales para continuar.</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->has('username') || $errors->has('password'))
                    <div class="alert alert-danger" role="alert">
                        El usuario o la contraseña ingresados no son correctos.
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="username">Usuario</label>
                        <div class="input-wrap @error('username') has-error @enderror">
                            <span class="input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 8a7 7 0 0 0-14 0"/>
                                </svg>
                            </span>
                            <input
                                id="username"
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="Ingrese su usuario"
                                autocomplete="username"
                                autofocus
                                required>
                        </div>
                        @error('username')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="label-row">
                            <label for="password">Contraseña</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">¿Olvidó su contraseña?</a>
                            @endif
                        </div>

                        <div class="input-wrap @error('password') has-error @enderror">
                            <span class="input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">
                                    <rect x="5" y="10" width="14" height="10" rx="2"/>
                                    <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                                </svg>
                            </span>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Ingrese su contraseña"
                                autocomplete="current-password"
                                required>
                            <button class="password-toggle" type="button"
                                    id="togglePassword" aria-label="Mostrar contraseña"
                                    aria-pressed="false">
                                <svg class="eye-open" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"/>
                                    <circle cx="12" cy="12" r="2.5"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <label class="remember">
                        <input type="checkbox" name="remember" value="1"
                               {{ old('remember') ? 'checked' : '' }}>
                        <span>Recordar mi sesión</span>
                    </label>

                    <button class="login-button" type="submit">
                        <span>Ingresar</span>
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m9 18 6-6-6-6M4 12h11"/>
                        </svg>
                    </button>
                </form>

                <p class="support-text">
                    Si tiene inconvenientes para ingresar, comuníquese con el administrador.
                </p>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const button = document.getElementById('togglePassword');
            const input = document.getElementById('password');

            button.addEventListener('click', function () {
                const showPassword = input.type === 'password';
                input.type = showPassword ? 'text' : 'password';
                button.setAttribute('aria-pressed', showPassword ? 'true' : 'false');
                button.setAttribute('aria-label', showPassword ? 'Ocultar contraseña' : 'Mostrar contraseña');
            });
        });
    </script>
</body>
</html>
