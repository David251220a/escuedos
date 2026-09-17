@php
    $noticiaActiva = request()->routeIs('noticia.*');
    $parametro_general = request()->routeIs('usuario.*', 'role.*');
    $usuarioActiva = request()->routeIs('user.*');
    $rolActiva = request()->routeIs('role.*');
    $docenteActiva = request()->routeIs('docente.*');
@endphp

<nav id="sidebar">
    <div class="shadow-bottom"></div>
    <ul class="list-unstyled menu-categories" id="accordionExample">

        <li class="menu">
            <a href="{{route('home')}}" aria-expanded="false" class="dropdown-toggle" @if(Str::startsWith(Route::currentRouteName(), 'home')) data-active="true" @endif>
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    <span>Home</span>
                </div>
            </a>
        </li>

        @can('noticia.index')
            <li class="menu">
                <a href="{{ route('noticia.index') }}"
                aria-expanded="false"
                class="dropdown-toggle"
                @if($noticiaActiva) data-active="true" @endif>

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-file-text">

                            <path d="M4 4h16v16H4z"></path>
                            <path d="M8 8h8"></path>
                            <path d="M8 12h8"></path>
                            <path d="M8 16h5"></path>
                        </svg>

                        <span>Noticias</span>
                    </div>
                </a>
            </li>
        @endcan

        @can('docente.index')

            <li class="menu">

                <a href="{{ route('docente.index') }}"
                aria-expanded="false"
                class="dropdown-toggle"
                @if(request()->routeIs('docente.*'))
                    data-active="true"
                @endif>

                    <div>

                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">

                            <path d="M2 10l10-5 10 5-10 5-10-5z"></path>

                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>

                            <path d="M22 10v6"></path>

                        </svg>

                        <span>Docentes</span>

                    </div>

                </a>

            </li>

        @endcan

        @can('parametro_general')
            <li class="menu">
                <a href="#parametro_general" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-settings"
                        >
                            <circle cx="12" cy="12" r="3"></circle>

                            <path
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06
                                a2 2 0 1 1-2.83 2.83l-.06-.06
                                a1.65 1.65 0 0 0-1.82-.33
                                1.65 1.65 0 0 0-1 1.51V21
                                a2 2 0 1 1-4 0v-.09
                                a1.65 1.65 0 0 0-1.08-1.51
                                1.65 1.65 0 0 0-1.82.33l-.06.06
                                a2 2 0 1 1-2.83-2.83l.06-.06
                                A1.65 1.65 0 0 0 4.6 15
                                1.65 1.65 0 0 0 3.09 14H3
                                a2 2 0 1 1 0-4h.09
                                A1.65 1.65 0 0 0 4.6 9
                                a1.65 1.65 0 0 0-.33-1.82l-.06-.06
                                a2 2 0 1 1 2.83-2.83l.06.06
                                A1.65 1.65 0 0 0 9 4.6h.08
                                A1.65 1.65 0 0 0 10 3.09V3
                                a2 2 0 1 1 4 0v.09
                                a1.65 1.65 0 0 0 1 1.51
                                1.65 1.65 0 0 0 1.82-.33l.06-.06
                                a2 2 0 1 1 2.83 2.83l-.06.06
                                a1.65 1.65 0 0 0-.33 1.82V9
                                c.12.6.6 1.08 1.2 1.2H21
                                a2 2 0 1 1 0 4h-.09
                                a1.65 1.65 0 0 0-1.51 1z"
                            ></path>
                        </svg>
                        <span>Param General</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $parametro_general ? 'show' : '' }}" id="parametro_general" data-parent="#accordionExample">
                    @can('usuario.index')
                        <li class="{{ $usuarioActiva ? 'active' : '' }}">
                            <a href="{{route('user.index')}}" >
                                <span>Usuario</span>
                            </a>
                        </li>
                    @endcan
                    @can('rol.index')
                        <li class="{{ $rolActiva ? 'active' : '' }}">
                            <a href="{{route('role.index')}}" >
                                <span>Roles</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        {{-- <li class="menu">
            <a href="{{route('user.cambiar_contrase')}}" aria-expanded="false" class="dropdown-toggle" @if($contrasActiva) data-active="true" @endif>
                <div class="">
                    <svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-unlock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                    </svg>
                    <span>Contraseña</span>
                </div>
            </a>
        </li> --}}

    </ul>

</nav>
